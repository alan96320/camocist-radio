<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Filters;
use App\Models\LyricsStore;
use App\Models\News;
use App\Models\NewsLabel;
use App\Models\Post;
use App\Models\SongsStore;
use App\Models\Timebelt;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use \stdClass;
use Log;

class HomeController extends Controller
{
    public function GetChannel($channel)
    {
        $channel = strtoupper($channel);
        $original_channel = $channel;
        $url = 'https://np.tritondigital.com/public/nowplaying?mountName=' . $channel . '&numberToFetch=1&eventType=track';
        $client = new Client();
        $request = $client->request('GET', $url);

        $xml_one = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOBLANKS);
        $xml_one_json = json_encode($xml_one);
        $xml_one_arr = json_decode($xml_one_json, true);

        $xml = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
        $xmlJson = json_encode($xml);
        $xmlArr = json_decode($xmlJson, true);
        $arrayName = array(
            'xmlArr' => $xmlArr['nowplaying-info']['property'],
            'xml_one_arr'=> $xml_one_arr,
        );
        return $arrayName;
    }
    public function responseGetChannel($channel)
    {
        // $channel = strtoupper($channel);
        // $original_channel = $channel;
        // $url = 'https://np.tritondigital.com/public/nowplaying?mountName=' . $channel . '&numberToFetch=1&eventType=track';
        // $client = new Client();
        // $request = $client->request('GET', $url);

        // $xml_one = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOBLANKS);
        // $xml_one_json = json_encode($xml_one);
        // $xml_one_arr = json_decode($xml_one_json, true);

        // $xml = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
        // $xmlJson = json_encode($xml);
        // $xmlArr = json_decode($xmlJson, true);
        $datax = $this->GetChannel($channel);
        $nowPlaying = $datax['xmlArr'];
        $xml_one_arr = $datax['xml_one_arr'];

        $artist_name = $nowPlaying[4];

        if ($xml_one_arr['nowplaying-info']['property'][3]['@attributes']['name'] == 'track_artist_name') {
            $artist_name = $nowPlaying[3];
        }

        if (!ctype_digit($nowPlaying[0])) {
            $nowPlaying[0] = $this->timestrToSec($nowPlaying[0]);
        } else {
            $nowPlaying[0] = $nowPlaying[0] / 1000;
        }

        /**
         * START ALGORITHM
         */

        // time zone just to make it easier to read from where I work
        // in fact if you change to any time zone it still does the same logic

        date_default_timezone_set('Asia/Jakarta');

        $readable_time_start = date('Y-m-d H:i:s', $nowPlaying[1] / 1000);
        $readable_now = date('Y-m-d H:i:s');

        $time_start = $nowPlaying[1] / 1000;
        $now = time();
        $now_in_miliseconds = round(microtime(true) * 1000);

        $request_in = (float) $nowPlaying[0] - ($now - $time_start);
        $time_spend_in_second = floor($now - $time_start);
        $time_spend_in_milisecond = floor(($now - $time_start) * 1000);

        $time_end_in_second = floor($nowPlaying[0]);
        $time_end_in_milisecond = $nowPlaying[0] * 1000;

        $ads = false;

        // if ads exist then request in every 5 seconds
        if ($time_spend_in_second > $time_end_in_second) {
            $ads = true;
            $request_in = 10;
        }

        /**
         * END ALGORITHM
         */

        $data = [
            'time_duration' => (float) $nowPlaying[0],
            'time_start' => $nowPlaying[1],
            'title' => $nowPlaying[2],
            'program_id' => $nowPlaying[3],
            'artist_name' => $artist_name,
            'image' => '',
            'cover_art' => '/img/frontend/new/' . $channel . '.png',
            'algorithm' => [
                'request_in' => $request_in,
                'readable_time_start' => $readable_time_start,
                'readable_now' => $readable_now,
                'time_start' => $time_start,
                'now' => $now,
                'now_in_miliseconds' => $now_in_miliseconds,
                'time_spend_in_second' => ($time_spend_in_second - 10),
                'time_spend_in_milisecond' => $time_spend_in_milisecond,
                'time_end_in_second' => $time_end_in_second,
                'time_end_in_milisecond' => $time_end_in_milisecond,
                'ads' => $ads,
            ],
        ];

        $now = Carbon::now('Asia/Singapore');
        $nowTime = $now->hour . ':' . $now->minute;

        $today_day = Carbon::now('Asia/Singapore')->format('l');

        if ($channel == 'POWER98_LOVESONGS') {
            $channel = 'POWER98 LOVE SONGS';
        } else if ($channel == 'JIA_WEBHITS_S01') {
            $channel = '883JIA WEBHITS';
        } else if ($channel == 'JIA_KPOP_S01') {
            $channel = '883JIA KPOP';
        } else if ($channel == 'POWER_98_RAW_S01') {
            $channel = 'POWER98 RAW';
        } else if ($channel == 'POWER_98_HITS_S01') {
            $channel = 'POWER98 HITS';
        }

        $timebelts = Timebelt::wherePlayerName($channel)->whereIsActive(1)->whereIsDefault(0)->get();

        foreach ($timebelts as $timebelt) {

            $start_time = $timebelt->start_time;
            $end_time = $timebelt->end_time;

            // Days
            $days = $timebelt->days;
            $days_array = explode(',', $days);

            foreach ($days_array as $day) {

                if ($day == $today_day) {
                    if (strtotime($nowTime) > strtotime($start_time) && strtotime($nowTime) < strtotime($end_time)) {
                        $image = $timebelt->banner_image;
                        $data['image'] = '/upload/timebelt/1200_800_' . $image;
                    }
                }
            }
        }

        if ($data['image'] == '') {
            $timebelt_image = Timebelt::wherePlayerName($channel)->whereIsActive(1)->whereIsDefault(1)->first();
            $data['image'] = '/upload/timebelt/1200_800_' . $timebelt_image->banner_image;
        }

        $type = 'lyric';

        $get_lyric_responce = $this->isLyricsFound($data['artist_name'], $data['title'], $data['time_start'], $type);
        $data['hide_btn'] = $get_lyric_responce;

        $itune_api = 'https://itunes.apple.com/search?term=' . $data['title'] . '+' . $data['artist_name'] . '&country=sg&
    media=music&entity=song&limit=1&lang=en_us&explicit=Yes&version=2';

        $client_itunes = new Client();
        $request_itunes = $client_itunes->request('GET', $itune_api);
        $data_itunes = json_decode($request_itunes->getBody(), true);

        if (count($data_itunes['results']) > 0) {
            $cover_art = $data_itunes['results'][0]['artworkUrl100'];
            $data['cover_art'] = $cover_art;
        }

        // if ($data['algorithm']['ads']) {
        //     $data['title'] = '?';
        //     $data['artist_name'] = '?';
        //     $data['cover_art'] = '/img/frontend/new/' . $original_channel . '.png';
        // }

        return response()->json($data, 200);
    }

    public function timestrToSec($timestr)
    {
        $parts = explode(':', $timestr);
        return ($parts[0] * 3600) + ($parts[1] * 60) + (+$parts[2]);
    }

    public function index(Request $request)
    {
        $allNews = News::orderBy('ordering', 'ASC')->get();
        $newsLabel = NewsLabel::first();
        $filters = Filters::where('active', 1)->pluck('name')->toArray();
        $categories = Category::where('type', 'post')->get();
        $featuredPosts = Post::where('featured', 1)->orderBy('date', 'DESC')->limit(3)->get();
        $posts = Post::where('featured', 0)->orderBy('date', 'DESC')->get();

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false) {
            $is_ie11 = true;
        } else {
            $is_ie11 = false;
        }

        return view('frontend.index', compact('is_ie11', 'allNews', 'posts', 'newsLabel', 'featuredPosts', 'categories', 'filters'));
    }

    public function getFiltredPosts(Request $request)
    {
        $sort = $request->sort ?? 'DESC';
        $object = new stdClass;

        if ($request->category) {
            $object->featuredPosts = Post::with('category')->where('featured', 1)->where('category_id', $request->category)->orderBy('date', $sort)->get();
            $object->posts = Post::with('category')->where('featured', 0)->where('category_id', $request->category)->orderBy('date', $sort)->get();
        } else {
            $object->featuredPosts = Post::with('category')->where('featured', 1)->orderBy('date', $sort)->get();
            $object->posts = Post::with('category')->where('featured', 0)->orderBy('date', $sort)->get();
        }

        foreach ($object->posts as &$post) {
            $post->date = $post->getFormattedDate($post->date);
        }
        unset($post);

        foreach ($object->featuredPosts as &$featuredPosts) {
            $featuredPosts->date = $featuredPosts->getFormattedDate($featuredPosts->date);
        }
        unset($featuredPosts);

        return response()->json($object, 200);
    }

    public function showPost($title)
    {
        $allNews = News::orderBy('ordering', 'ASC')->get();
        $newsLabel = NewsLabel::first();
        //$replacedTitle = str_replace('-', ' ', $title);
        $replacedTitle = $title;
        $post = Post::where('url', $replacedTitle)->firstOrFail();

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false) {
            $is_ie11 = true;
        } else {
            $is_ie11 = false;
        }

        return view('frontend.single-post', compact('is_ie11', 'allNews', 'post', 'newsLabel'));
    }

    public function faq()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false) {
            $is_ie11 = true;
        } else {
            $is_ie11 = false;
        }
        return view('frontend.faq', compact('is_ie11'));
    }

    public function info_883jia()
    {

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false) {
            $is_ie11 = true;
        } else {
            $is_ie11 = false;
        }
        return view('frontend.883jia', compact('is_ie11'));
    }

    public function info_power98()
    {

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false) {
            $is_ie11 = true;
        } else {
            $is_ie11 = false;
        }

        return view('frontend.power98', compact('is_ie11'));
    }

    public function music_drama()
    {

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false) {
            $is_ie11 = true;
        } else {
            $is_ie11 = false;
        }

        return view('frontend.music_drama', compact('is_ie11'));
    }

    public function about_us()
    {

        return view('frontend.about_us');
    }

    public function isLyricsFound($artistName, $song_title, $time_start, $type)
    {
        $artistName = trim(str_replace("-", "", $artistName));
        if ($type == 'lyric') {
            $client = new Client();
            $request = $client->request('POST', 'https://api.lyricfind.com/lyric.do?apikey=ac0974dcf282f1c67c64342159e42c05&output=json&trackid=artistname:' . $artistName . ',trackname:' . $song_title . '&reqtype=default&territory=SG&lrckey=d829393a83c0c0434cef9d451310be4b&format=lrc,clean&useragent=x');
            $data_a = json_decode($request->getBody(), true);
            $result = $data_a['response']['code'];
            $lrc = '';
        } else {
            $client = new Client();
            $request = $client->request('POST', 'https://api.lyricfind.com/lyric.do?apikey=ac0974dcf282f1c67c64342159e42c05&output=json&trackid=artistname:' . $artistName . ',trackname:' . $song_title . '&reqtype=default&territory=SG&lrckey=d829393a83c0c0434cef9d451310be4b&format=lrc,clean&useragent=x');
            $data_a = json_decode($request->getBody(), true);
            $result = $data_a['response']['code'];
            $lrc = ($result == '101' || $result == '111' || (!empty($data_a['track']['lrc']))) ? $data_a['track']['lrc'] : '';
        }

        $hide = true;
        if ($result == '101' || $result == '111' || (!empty($data_a['track']['lrc']))) {
            $hide = false;
        }
        return $hide;
    }

    public function get_songs_lyrics($channel,Request $request)
    {
        // if ($request->ads) {
        //     $data = [
        //         'message' => 'success',
        //         'lyrics' => 'Lyrics not found',
        //         'type' => $request->type,
        //         'jsons' => '',
        //         'duration' => '',
        //         'time_start' => $request->time_start,
        //         'status' => false,
        //     ];

        //     return response()->json($data);
        // }
        $datax = $this->GetChannel($channel);
        $now = time();
        $artistName = trim(str_replace("-", "", $request->artist_name));
        $songsstore = SongsStore::where('cue_title', $request->song_title)
            ->first();
        // $songsstore = SongsStore::whereProgramId($request->program_id)->first();
        Log::debug($request);
        Log::debug($songsstore);
        if ($songsstore) {

            $lyricsstore = LyricsStore::whereSongstoreId($songsstore->id)->first();
  
            if ($lyricsstore) {

                $data = [
                    'message' => 'success',
                    'lyrics' => !empty($lyricsstore->lyrics) ? $lyricsstore->lyrics : 'Lyrics not found',
                    'type' => $request->type,
                    'jsons' => !empty($lyricsstore->lrc) ? json_decode($lyricsstore->lrc, true) : 'lyrics not sync',
                    'duration' => $lyricsstore->duration,
                    'time_start' => $datax['xmlArr'][1]/1000,
                    'status' => !empty($lyricsstore->lyrics) ? true : false,
                    'now'=> $now,
                ];

                return response()->json($data);
            }
        } else {

            $data = [
                'message' => 'success',
                'lyrics' => 'Lyrics not found',
                'type' => $request->type,
                'jsons' => '',
                'duration' => '',
                'time_start' => $datax['xmlArr'][1]/1000,
                'status' => false,
                'now' => $now
            ];

            return response()->json($data);
        }
    }
    public function get_lyrics(Request $request)
    {
        //dd($request);
        $artistName = trim(str_replace("-", "", $request->artist_name));
        $song_title = $request->song_title;
        $time_start = $request->time_start;
        $type = $request->type;
        if ($request->type == 'lyric') {
            $client = new Client();
            $request = $client->request('POST', 'https://api.lyricfind.com/lyric.do?apikey=ac0974dcf282f1c67c64342159e42c05&output=json&trackid=artistname:' . $artistName . ',trackname:' . $request->song_title . '&reqtype=default&territory=SG&lrckey=d829393a83c0c0434cef9d451310be4b&format=lrc,clean&useragent=x');
            $data_a = json_decode($request->getBody(), true);
            $result = $data_a['response']['code'];
            $lrc = '';
        } else {
            $client = new Client();
            $request = $client->request('POST', 'https://api.lyricfind.com/lyric.do?apikey=ac0974dcf282f1c67c64342159e42c05&output=json&trackid=artistname:' . $artistName . ',trackname:' . $request->song_title . '&reqtype=default&territory=SG&lrckey=d829393a83c0c0434cef9d451310be4b&format=lrc,clean&useragent=x');
            $data_a = json_decode($request->getBody(), true);
            $result = $data_a['response']['code'];
            $lrc = ($result == '101' || $result == '111' || (!empty($data_a['track']['lrc']))) ? $data_a['track']['lrc'] : '';
        }

        if ($result == '101' || $result == '111') {
            $data = [
                'message' => 'success',
                'lyrics' => $data_a['track']['lyrics'],
                'type' => $type,
                'jsons' => $lrc,
                'duration' => $data_a['track']['duration'],
                'time_start' => $time_start,

            ];
//die('sample');
            return response()->json($data, 200);
        } else {
            $client = new Client();
            $request = $client->request('GET', 'https://api.camokakis.sg/chineselyrics?track.title=' . urlencode($song_title) . '&track.artists.name=' . urlencode($artistName));
            $data_b = json_decode($request->getBody(), true);
            //dd(urlencode($song_title), urlencode($artistName), $song_title, $artistName, $data_b);
            //dd($data_b);
            if (!empty($data_b)) {
                $result = $data_b[0]['response']['code'];
                $lrc = $data_b[0]['track']['lrc'];
                //dd($data_b[0]);
                if ($result == '101' || $result == '111') {
                    $data = [
                        'message' => 'success',
                        'lyrics' => $data_b[0]['track']['lyrics'],
                        'type' => $type,
                        'jsons' => $lrc,
                        'duration' => '4:15',
                        'time_start' => $time_start,
                    ];
//die('sample');
                    return response()->json($data, 200);
                }
            } else {
                $data = [
                    'message' => 'error',

                ];
//die('sample');
                return response()->json($data, 200);
            }
        }
    }

    // public function index(){

    //     if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false) {
    //         $is_ie11  = true;
    //     }
    //     else{
    //         $is_ie11 = false;
    //     }

    //     return view('frontend.index-old',compact('is_ie11'));
    // }

//     public function response_883jia_test()
    //     {
    //         $client = new Client();
    //         $request = $client->request('GET', 'https://np.tritondigital.com/public/nowplaying?mountName=883JIA&numberToFetch=1&eventType=track');

//         $data1 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOBLANKS);
    //         $string = json_encode($data1);
    //         $data_a = json_decode($string, true);

//         $data2 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
    //         $string2 = json_encode($data2);
    //         $data_a2 = json_decode($string2, true);

//         $title = $data_a2['nowplaying-info']['property'][2];
    //         $time_start = $data_a2['nowplaying-info']['property'][1];

//         $data = array();
    //         $data['title'] = $title;

//         if ($data_a['nowplaying-info']['property'][3]['@attributes']['name'] == 'track_artist_name') {
    //             $artist_name = $data_a2['nowplaying-info']['property'][3];
    //         } else {
    //             $artist_name = $data_a2['nowplaying-info']['property'][4];
    //         }

//         $now = Carbon::now('Asia/Singapore');
    //         $nowTime = $now->hour . ':' . $now->minute;

//         $today_day = Carbon::now('Asia/Singapore')->format('l');

//         $timebelts = Timebelt::where('player_name', '883JIA')->where('is_active', 1)->where('is_default', 0)->get();
    //         $data = array();
    //         $data['image'] = '';
    //         foreach ($timebelts as $timebelt) {

//             $start_time = $timebelt->start_time;
    //             $end_time = $timebelt->end_time;

//             // Days
    //             $days = $timebelt->days;
    //             $days_array = explode(',', $days);

//             foreach ($days_array as $day) {

//                 if ($day == $today_day) {
    //                     if (strtotime($nowTime) > strtotime($start_time) && strtotime($nowTime) < strtotime($end_time)) {
    //                         $image = $timebelt->banner_image;
    //                         $data['image'] = $image;

//                     }
    //                 }
    //             }
    //         }

//         if ($data['image'] == '') {
    //             $timebelt_image = Timebelt::where('player_name', '883JIA')->where('is_active', 1)->where('is_default', 1)->first();
    //             $data['default_image'] = $timebelt_image->banner_image;
    //         }
    //         $data['title'] = $title;
    //         $data['artist_name'] = $artist_name;
    //         $data['time_start'] = $time_start;
    //         $type = 'lyric';

//         $get_lyric_responce = $this->isLyricsFound($artist_name, $title, $time_start, $type);
    //         $data['hide_btn'] = $get_lyric_responce;

//         $itune_api = 'https://itunes.apple.com/search?term=' . $title . '+' . $artist_name . '&country=sg&
    //     media=music&entity=song&limit=1&lang=en_us&explicit=Yes&version=2';

//         $client_itunes = new Client();
    //         $request_itunes = $client_itunes->request('GET', $itune_api);

//         $data_itunes = json_decode($request_itunes->getBody(), true);

//         //echo $data1;
    //         // dd($data_itunes);
    //         $data['cover_art'] = '';
    //         //foreach ($data_itunes['results'] as $result) {

//         //if(strtoupper($result['trackName']) == $title  && strtoupper($result['artistName'])  == $artist_name){
    //         if (count($data_itunes['results']) > 0) {
    //             $cover_art = $data_itunes['results'][0]['artworkUrl100'];
    //             $data['cover_art'] = $cover_art;
    //         }
    //         //}
    //         //}

//         // dd($data);
    //         // $data = mb_convert_encoding($data, 'UTF-8', 'UTF-8');
    //         return response()->json($data, 200);

//     }
    //     public function response_883jia()
    //     {

//         $client = new Client();
    //         $request = $client->request('GET', 'https://np.tritondigital.com/public/nowplaying?mountName=883JIA&numberToFetch=1&eventType=track');

//         $data1 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOBLANKS);
    //         $string = json_encode($data1);
    //         $data_a = json_decode($string, true);

//         $data2 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
    //         $string2 = json_encode($data2);
    //         $data_a2 = json_decode($string2, true);

//         $title = $data_a2['nowplaying-info']['property'][2];
    //         $time_start = $data_a2['nowplaying-info']['property'][1];

//         $data = array();
    //         $data['title'] = $title;

// // dd($title);

//         if ($data_a['nowplaying-info']['property'][3]['@attributes']['name'] == 'track_artist_name') {
    //             $artist_name = $data_a2['nowplaying-info']['property'][3];
    //         } else {
    //             $artist_name = $data_a2['nowplaying-info']['property'][4];
    //         }

//         $now = Carbon::now('Asia/Singapore');
    //         $nowTime = $now->hour . ':' . $now->minute;

//         $today_day = Carbon::now('Asia/Singapore')->format('l');

//         $timebelts = Timebelt::where('player_name', '883JIA')->where('is_active', 1)->where('is_default', 0)->get();
    //         $data = array();
    //         $data['image'] = '';
    //         foreach ($timebelts as $timebelt) {

//             $start_time = $timebelt->start_time;
    //             $end_time = $timebelt->end_time;

//             // Days
    //             $days = $timebelt->days;
    //             $days_array = explode(',', $days);

//             foreach ($days_array as $day) {

//                 if ($day == $today_day) {
    //                     if (strtotime($nowTime) > strtotime($start_time) && strtotime($nowTime) < strtotime($end_time)) {
    //                         $image = $timebelt->banner_image;
    //                         $data['image'] = $image;

//                     }
    //                 }
    //             }
    //         }

//         if ($data['image'] == '') {
    //             $timebelt_image = Timebelt::where('player_name', '883JIA')->where('is_active', 1)->where('is_default', 1)->first();
    //             $data['default_image'] = $timebelt_image->banner_image;
    //         }
    //         $data['title'] = $title;
    //         $data['artist_name'] = $artist_name;
    //         $data['time_start'] = $time_start;
    //         $type = 'lyric';

//         $get_lyric_responce = $this->isLyricsFound($artist_name, $title, $time_start, $type);
    //         $data['hide_btn'] = $get_lyric_responce;

//         $itune_api = 'https://itunes.apple.com/search?term=' . $title . '+' . $artist_name . '&country=sg&
    //     media=music&entity=song&limit=1&lang=en_us&explicit=Yes&version=2';

//         $client_itunes = new Client();
    //         $request_itunes = $client_itunes->request('GET', $itune_api);

//         $data_itunes = json_decode($request_itunes->getBody(), true);
    //         //echo $data1;
    //         // dd($data_itunes);
    //         $data['cover_art'] = '';
    //         //foreach ($data_itunes['results'] as $result) {

//         //if(strtoupper($result['trackName']) == $title  && strtoupper($result['artistName'])  == $artist_name){
    //         if (count($data_itunes['results']) > 0) {
    //             $cover_art = $data_itunes['results'][0]['artworkUrl100'];
    //             $data['cover_art'] = $cover_art;
    //         }
    //         //}
    //         //}

//         // $data = mb_convert_encoding($data, 'UTF-8', 'UTF-8');
    //         return response()->json($data, 200);

//     }

//     public function response_883jia_2()
    //     {

//         $client = new Client();
    //         $request = $client->request('GET', 'https://np.tritondigital.com/public/nowplaying?mountName=JIA_WEBHITS_S01&numberToFetch=1&eventType=track');

//         $data1 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOBLANKS);
    //         $string = json_encode($data1);
    //         $data_a = json_decode($string, true);

//         $data2 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
    //         $string2 = json_encode($data2);
    //         $data_a2 = json_decode($string2, true);

//         $title = $data_a2['nowplaying-info']['property'][2];
    //         $time_start = $data_a2['nowplaying-info']['property'][1];

//         $timebelt_image = Timebelt::where('player_name', '883JIA WEBHITS')->where('is_active', 1)->where('is_default', 1)->first();

//         $data = array();
    //         $data['default_image'] = $timebelt_image->banner_image;

//         if ($data_a['nowplaying-info']['property'][3]['@attributes']['name'] == 'track_artist_name') {
    //             $artist_name = $data_a2['nowplaying-info']['property'][3];
    //         } else {
    //             $artist_name = $data_a2['nowplaying-info']['property'][4];
    //         }

//         $data['title'] = $title;
    //         $data['artist_name'] = $artist_name;
    //         $data['time_start'] = $time_start;

//         $type = 'lyric';
    //         $get_lyric_responce = $this->isLyricsFound($artist_name, $title, $time_start, $type);
    //         $data['hide_btn'] = $get_lyric_responce;
    //         $itune_api = 'https://itunes.apple.com/search?term=' . $title . '+' . $artist_name . '&country=sg&
    //     media=music&entity=song&limit=1&lang=en_us&explicit=Yes&version=2';

//         $client_itunes = new Client();
    //         $request_itunes = $client_itunes->request('GET', $itune_api);

//         $data_itunes = json_decode($request_itunes->getBody(), true);

//         $data['cover_art'] = '';
    //         //foreach ($data_itunes['results'] as $result) {

//         //if(strtoupper($result['trackName']) == $title  && strtoupper($result['artistName'])  == $artist_name){
    //         if (count($data_itunes['results']) > 0) {
    //             $cover_art = $data_itunes['results'][0]['artworkUrl100'];
    //             $data['cover_art'] = $cover_art;
    //         }
    //         //}
    //         //}

//         // $data = mb_convert_encoding($data, 'UTF-8', 'UTF-8');
    //         return response()->json($data, 200);
    //     }

//     public function response_883jia_3()
    //     {

//         $client = new Client();
    //         $request = $client->request('GET', 'https://np.tritondigital.com/public/nowplaying?mountName=JIA_KPOP_S01&numberToFetch=1&eventType=track');

//         $data1 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOBLANKS);
    //         $string = json_encode($data1);
    //         $data_a = json_decode($string, true);

//         $data2 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
    //         $string2 = json_encode($data2);
    //         $data_a2 = json_decode($string2, true);

//         $title = $data_a2['nowplaying-info']['property'][2];
    //         $time_start = $data_a2['nowplaying-info']['property'][1];
    //         $timebelt_image = Timebelt::where('player_name', '883JIA KPOP')->where('is_active', 1)->where('is_default', 1)->first();

//         $data = array();
    //         $data['default_image'] = $timebelt_image->banner_image;

//         if ($data_a['nowplaying-info']['property'][3]['@attributes']['name'] == 'track_artist_name') {
    //             $artist_name = $data_a2['nowplaying-info']['property'][3];
    //         } elseif ($data_a['nowplaying-info']['property'][5]['@attributes']['name'] == 'track_artist_name') {
    //             $artist_name = $data_a2['nowplaying-info']['property'][5];
    //         } else {
    //             $artist_name = $data_a2['nowplaying-info']['property'][4];
    //         }
    //         $data['title'] = $title;
    //         $data['artist_name'] = $artist_name;
    //         $data['time_start'] = $time_start;

//         $type = 'lyric';
    //         $get_lyric_responce = $this->isLyricsFound($artist_name, $title, $time_start, $type);
    //         $data['hide_btn'] = $get_lyric_responce;

//         $itune_api = 'https://itunes.apple.com/search?term=' . $title . '+' . $artist_name . '&country=sg&
    //     media=music&entity=song&limit=1&lang=en_us&explicit=Yes&version=2';

//         $client_itunes = new Client();
    //         $request_itunes = $client_itunes->request('GET', $itune_api);

//         $data_itunes = json_decode($request_itunes->getBody(), true);

//         $data['cover_art'] = '';
    //         //foreach ($data_itunes['results'] as $result) {

//         //if(strtoupper($result['trackName']) == $title  && strtoupper($result['artistName'])  == $artist_name){
    //         if (count($data_itunes['results']) > 0) {
    //             $cover_art = $data_itunes['results'][0]['artworkUrl100'];
    //             $data['cover_art'] = $cover_art;
    //         }
    //         //}
    //         //}
    //         $data = mb_convert_encoding($data, 'UTF-8', 'UTF-8');
    //         return response()->json($data, 200);
    //     }

//     public function response_power_98()
    //     {

//         $client = new Client();
    //         $request = $client->request('GET', 'https://np.tritondigital.com/public/nowplaying?mountName=POWER_98_RAW_S01&numberToFetch=1&eventType=track');

//         $data1 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOBLANKS);
    //         $string = json_encode($data1);
    //         $data_a = json_decode($string, true);

//         $data2 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
    //         $string2 = json_encode($data2);
    //         $data_a2 = json_decode($string2, true);

//         $title = $data_a2['nowplaying-info']['property'][2];
    //         $time_start = $data_a2['nowplaying-info']['property'][1];
    //         $data = array();
    //         $data['title'] = $title;

//         if ($data_a['nowplaying-info']['property'][3]['@attributes']['name'] == 'track_artist_name') {
    //             $artist_name = $data_a2['nowplaying-info']['property'][3];
    //         } else {
    //             $artist_name = $data_a2['nowplaying-info']['property'][4];
    //         }

//         $now = Carbon::now('Asia/Singapore');
    //         $nowTime = $now->hour . ':' . $now->minute;

//         $today_day = Carbon::now('Asia/Singapore')->format('l');

//         $timebelts = Timebelt::where('player_name', 'POWER98 RAW')->where('is_active', 1)->where('is_default', 0)->get();

//         $data = array();
    //         $data['image'] = '';
    //         foreach ($timebelts as $timebelt) {

//             $start_time = $timebelt->start_time;
    //             $end_time = $timebelt->end_time;

//             // Days
    //             $days = $timebelt->days;
    //             $days_array = explode(',', $days);

//             foreach ($days_array as $day) {

//                 if ($day == $today_day) {
    //                     if (strtotime($nowTime) > strtotime($start_time) && strtotime($nowTime) < strtotime($end_time)) {
    //                         $image = $timebelt->banner_image;
    //                         $data['image'] = $image;
    //                     }
    //                 }
    //             }
    //         }
    //         if ($data['image'] == '') {
    //             $timebelt_image = Timebelt::where('player_name', 'POWER98 RAW')->where('is_active', 1)->where('is_default', 1)->first();
    //             $data['default_image'] = $timebelt_image->banner_image;
    //         }
    //         $data['title'] = $title;
    //         $data['artist_name'] = $artist_name;
    //         $data['time_start'] = $time_start;

//         $type = 'lyric';
    //         $get_lyric_responce = $this->isLyricsFound($artist_name, $title, $time_start, $type);
    //         $data['hide_btn'] = $get_lyric_responce;

//         $itune_api = 'https://itunes.apple.com/search?term=' . $title . '+' . $artist_name . '&country=sg&
    //     media=music&entity=song&limit=1&lang=en_us&explicit=Yes&version=2';

//         $client_itunes = new Client();
    //         $request_itunes = $client_itunes->request('GET', $itune_api);

//         $data_itunes = json_decode($request_itunes->getBody(), true);

//         $data['cover_art'] = '';
    //         //foreach ($data_itunes['results'] as $result) {

//         //if(strtoupper($result['trackName']) == $title  && strtoupper($result['artistName'])  == $artist_name){
    //         if (count($data_itunes['results']) > 0) {
    //             $cover_art = $data_itunes['results'][0]['artworkUrl100'];
    //             $data['cover_art'] = $cover_art;
    //         }
    //         //}
    //         //}

//         return response()->json($data, 200);
    //     }

//     public function response_power_98_hits()
    //     {

//         $client = new Client();
    //         $request = $client->request('GET', 'https://np.tritondigital.com/public/nowplaying?mountName=POWER_98_HITS_S01&numberToFetch=1&eventType=track');

//         $data1 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOBLANKS);
    //         $string = json_encode($data1);
    //         $data_a = json_decode($string, true);

//         $data2 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
    //         $string2 = json_encode($data2);
    //         $data_a2 = json_decode($string2, true);

//         $title = $data_a2['nowplaying-info']['property'][2];
    //         $time_start = $data_a2['nowplaying-info']['property'][1];
    //         $timebelt_image = Timebelt::where('player_name', 'POWER98 HITS')->where('is_active', 1)->where('is_default', 1)->first();

//         $data = array();
    //         $data['default_image'] = $timebelt_image->banner_image;

//         if ($data_a['nowplaying-info']['property'][3]['@attributes']['name'] == 'track_artist_name') {
    //             $artist_name = $data_a2['nowplaying-info']['property'][3];
    //         } else {
    //             $artist_name = $data_a2['nowplaying-info']['property'][4];
    //         }
    //         $data['title'] = $title;
    //         $data['artist_name'] = $artist_name;
    //         $data['time_start'] = $time_start;

//         $type = 'lyric';
    //         $get_lyric_responce = $this->isLyricsFound($artist_name, $title, $time_start, $type);
    //         $data['hide_btn'] = $get_lyric_responce;

//         $itune_api = 'https://itunes.apple.com/search?term=' . $title . '+' . $artist_name . '&country=sg&
    //     media=music&entity=song&limit=1&lang=en_us&explicit=Yes&version=2';

//         $client_itunes = new Client();
    //         $request_itunes = $client_itunes->request('GET', $itune_api);

//         $data_itunes = json_decode($request_itunes->getBody(), true);
    //         //echo $data1;
    //         $data['cover_art'] = '';
    //         //foreach ($data_itunes['results'] as $result) {

//         //if(strtoupper($result['trackName']) == $title  && strtoupper($result['artistName'])  == $artist_name){
    //         if (count($data_itunes['results']) > 0) {
    //             $cover_art = $data_itunes['results'][0]['artworkUrl100'];
    //             $data['cover_art'] = $cover_art;
    //         }
    //         //}
    //         //}

//         return response()->json($data, 200);
    //     }

//     public function response_power_98_ls()
    //     {
    //         $client = new Client();
    //         $request = $client->request('GET', 'https://np.tritondigital.com/public/nowplaying?mountName=POWER98_LOVESONGS&numberToFetch=1&eventType=track');

//         $data1 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOBLANKS);
    //         $string = json_encode($data1);
    //         $data_a = json_decode($string, true);

//         $data2 = simplexml_load_string($request->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS);
    //         $string2 = json_encode($data2);
    //         $data_a2 = json_decode($string2, true);

//         $title = $data_a2['nowplaying-info']['property'][2];
    //         $time_start = $data_a2['nowplaying-info']['property'][1];
    //         $now = Carbon::now('Asia/Singapore');
    //         $nowTime = $now->hour . ':' . $now->minute;

//         $today_day = Carbon::now('Asia/Singapore')->format('l');

//         $timebelts = Timebelt::where('player_name', 'POWER98 LOVE SONGS')->where('is_active', 1)->where('is_default', 0)->get();
    //         $data = array();
    //         $data['image'] = '';
    //         foreach ($timebelts as $timebelt) {

//             $start_time = $timebelt->start_time;
    //             $end_time = $timebelt->end_time;

//             // Days
    //             $days = $timebelt->days;
    //             $days_array = explode(',', $days);

//             foreach ($days_array as $day) {

//                 if ($day == $today_day) {
    //                     if (strtotime($nowTime) > strtotime($start_time) && strtotime($nowTime) < strtotime($end_time)) {
    //                         $image = $timebelt->banner_image;
    //                         $data['image'] = $image;

//                     }
    //                 }
    //             }
    //         }
    //         if ($data['image'] == '') {
    //             $timebelt_image = Timebelt::where('player_name', 'POWER98 LOVE SONGS')->where('is_active', 1)->where('is_default', 1)->first();
    //             $data['default_image'] = $timebelt_image->banner_image;
    //         }

//         if ($data_a['nowplaying-info']['property'][3]['@attributes']['name'] == 'track_artist_name') {
    //             $artist_name = $data_a2['nowplaying-info']['property'][3];
    //         } else {
    //             $artist_name = $data_a2['nowplaying-info']['property'][4];
    //         }
    //         $data['title'] = $title;
    //         $data['artist_name'] = $artist_name;

//         $data['time_start'] = $time_start;

//         $type = 'lyric';
    //         $get_lyric_responce = $this->isLyricsFound($artist_name[0], $title[0], $time_start, $type);
    //         $data['hide_btn'] = $get_lyric_responce;

//         $itune_api = 'https://itunes.apple.com/search?term=' . $title[0] . '+' . $artist_name[0] . '&country=sg&
    //     media=music&entity=song&limit=1&lang=en_us&explicit=Yes&version=2';

//         $client_itunes = new Client();
    //         $request_itunes = $client_itunes->request('GET', $itune_api);

//         $data_itunes = json_decode($request_itunes->getBody(), true);

//         $data['cover_art'] = '';
    //         //foreach ($data_itunes['results'] as $result) {

//         //if(strtoupper($result['trackName']) == $title  && strtoupper($result['artistName'])  == $artist_name){
    //         if (count($data_itunes['results']) > 0) {
    //             $cover_art = $data_itunes['results'][0]['artworkUrl100'];
    //             $data['cover_art'] = $cover_art;
    //         }
    //         //}
    //         //}

//         return response()->json($data, 200);
    //     }
}
