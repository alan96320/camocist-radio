<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LyricsStore;
use App\Models\SongsStore;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class ApiController extends Controller
{
    // public function apiPostChannel(Request $request)
    // {
    //     $url = 'https://np.tritondigital.com/public/nowplaying?mountName=' . $request->channel . '&numberToFetch=5&eventType=track';

    //     $response = Curl::to($url)->get();
    //     $xml = simplexml_load_string(
    //         $response
    //     );
    //     dd($xml);
    //     for ($i = 0; $i <= (count($xml->{'nowplaying-info'}) - 1); $i++) {
    //         foreach ($xml->{'nowplaying-info'}[$i]->property as $key => $property) {
    //             dd($property);
    //             if ($property->attributes() == 'cue_time_duration') {

    //                 if (ctype_digit($property)) {
    //                     $duration = $property / 1000;
    //                     $property = $this->formatSeconds($duration);
    //                 }

    //                 $cue_time_duration = $property;
    //             }
    //             if ($property->attributes() == 'cue_title') {
    //                 $cue_title = $property;
    //             }
    //             if ($property->attributes() == 'track_artist_name') {
    //                 $track_artist_name = $property;
    //             }
    //             if ($property->attributes() == 'track_id') {
    //                 $track_id = $property;
    //             }
    //             if ($property->attributes() == 'cue_time_start') {
    //                 $cue_time_start = $property;
    //             }

    //         }
    //         $songsstore = SongsStore::where('program_id', $track_id)->first();
    //         if (!$songsstore) {

    //             $result = SongsStore::create([
    //                 'channel' => $request->channel,
    //                 'cue_time_duration' => $cue_time_duration,
    //                 'cue_time_start' => $cue_time_start,
    //                 'cue_title' => $cue_title,
    //                 'program_id' => $track_id,
    //                 'track_artist_name' => $track_artist_name,
    //             ]);

    //             dd($result);

    //             $this->api_lyrics($result->id, $track_artist_name, $cue_title);
    //         }
    //     }

    //     return response()->json("success", 200);
    // }

    public function apiPostChannel(Request $request)
    {
        $url = 'https://np.tritondigital.com/public/nowplaying?mountName=' . $request->channel . '&numberToFetch=1&eventType=track';

        $response = Curl::to($url)->get();

        $xml_one = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOBLANKS);
        $xml_one_json = json_encode($xml_one);
        $xml_one_arr = json_decode($xml_one_json, true);

        $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
        $xmlJson = json_encode($xml);
        $xmlArr = json_decode($xmlJson, true);

        $nowPlaying = $xmlArr['nowplaying-info']['property'];

        $artist_name = $nowPlaying[4];

        if ($xml_one_arr['nowplaying-info']['property'][3]['@attributes']['name'] == 'track_artist_name') {
            $artist_name = $nowPlaying[3];
        }

        if (ctype_digit($nowPlaying[0])) {
            $duration = $nowPlaying[0] / 1000;
            $nowPlaying[0] = $this->formatSeconds($duration);
        }

        $data = [
            'channel' => $request->channel,
            'cue_time_duration' => $nowPlaying[0],
            'cue_time_start' => $nowPlaying[1],
            'cue_title' => $nowPlaying[2],
            'program_id' => $nowPlaying[3],
            'track_artist_name' => $artist_name,
        ];

        $songsstore = SongsStore::whereProgramId($data['program_id'])->first();

        if (!$songsstore) {
            $result = SongsStore::create($data);
            $this->api_lyrics($result->id, $data['track_artist_name'], $data['cue_title']);
        }

        return response()->json("success", 200);
    }

    public function api_lyrics($refid, $artist, $trackname)
    {
        $artist = str_replace(" ", "+", $artist);
        $trackname = str_replace(" ", "+", $trackname);

        $songresponse = Curl::to('https://api.lyricfind.com/lyric.do?apikey=ac0974dcf282f1c67c64342159e42c05&output=json&trackid=artistname:' . $artist . ',trackname:' . $trackname . '&reqtype=default&territory=SG&lrckey=d829393a83c0c0434cef9d451310be4b&format=lrc&useragent=x')
            ->get();

        $arraysongresponse = json_decode($songresponse, true);
        if (@$arraysongresponse['response']['code'] == '101' || @$arraysongresponse['response']['code'] == '111') {

            $result = LyricsStore::create([
                'songstore_id' => $refid,
                'lfid' => @$arraysongresponse['track']['lfid'],
                'instrumental' => @$arraysongresponse['track']['instrumental'],
                'viewable' => @$arraysongresponse['track']['viewable'],
                'has_lrc' => @$arraysongresponse['track']['has_lrc'],
                'lrc_verified' => @$arraysongresponse['track']['lrc_verified'],
                'title' => @$arraysongresponse['track']['title'],
                'duration' => @$arraysongresponse['track']['duration'],
                'artists' => json_encode(@$arraysongresponse['track']['artists']),
                'artist' => json_encode(@$arraysongresponse['track']['artist']),
                'last_update' => @$arraysongresponse['track']['last_update'],
                'lyrics' => @$arraysongresponse['track']['lyrics'],
                'lrc_version' => @$arraysongresponse['track']['lrc_version'],
                'lrc' => json_encode(@$arraysongresponse['track']['lrc']),
                'api_url' => 'https://api.lyricfind.com/lyric.do?apikey=ac0974dcf282f1c67c64342159e42c05&output=json&trackid=artistname:' . $artist . ',trackname:' . $trackname . '&reqtype=default&territory=SG&lrckey=d829393a83c0c0434cef9d451310be4b&format=lrc&useragent=x',
            ]);

        } else {
            $chinesesongresponse = Curl::to('https://api.camokakis.sg/chineselyrics?track.title=' . urlencode($trackname) . '&track.artists.name=' . urlencode($artist) . '')
                ->get();

            $arraychinesesongresponse = json_decode($chinesesongresponse, true);
            $result = LyricsStore::create([
                'songstore_id' => $refid,
                'lfid' => @$arraychinesesongresponse[0]['track']['lfid'],
                'instrumental' => 'yes',
                'viewable' => @$arraychinesesongresponse[0]['track']['viewable'],
                'has_lrc' => @$arraychinesesongresponse[0]['track']['has_lrc'],
                'lrc_verified' => @$arraychinesesongresponse[0]['track']['lrc_verified'],
                'title' => @$arraychinesesongresponse[0]['track']['title'],
                'duration' => @$arraychinesesongresponse[0]['track']['duration'],
                'artists' => @$arraychinesesongresponse[0]['track']['artists'][0]['name'],
                'artist' => @$arraychinesesongresponse[0]['track']['artist'][0]['romanized_name'],
                'last_update' => @$arraychinesesongresponse[0]['changed_log']['modified_date'],
                'lyrics' => @$arraychinesesongresponse[0]['track']['lyrics'],
                'lrc_version' => @$arraychinesesongresponse[0]['track']['lrc_version'],
                'lrc' => json_encode(@$arraychinesesongresponse[0]['track']['lrc']),
                'api_url' => 'https://api.camokakis.sg/chineselyrics?track.title=' . urlencode($trackname) . '&track.artists.name=' . urlencode($artist) . '',
            ]);
        }
    }

    public function formatSeconds($seconds)
    {
        $hours = 0;
        $milliseconds = str_replace("0.", '', $seconds - floor($seconds));

        if ($seconds > 3600) {
            $hours = floor($seconds / 3600);
        }
        $seconds = $seconds % 3600;

        return str_pad($hours, 2, '0', STR_PAD_LEFT)
        . gmdate(':i:s', $seconds)
            . ($milliseconds ? ".$milliseconds" : '')
        ;
    }

    // public function api_POWER98_LOVESONGS(Request $request)
    // {
    //     $response = Curl::to('https://np.tritondigital.com/public/nowplaying?mountName=POWER98_LOVESONGS&numberToFetch=1&eventType=track')
    //         ->get();

    //     $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
    //     $xmlJson = json_encode($xml);
    //     $xmlArr = json_decode($xmlJson, true);

    //     $nowPlaying = $xmlArr['nowplaying-info']['property'];

    //     $data = [
    //         'channel' => 'POWER98_LOVESONGS',
    //         'cue_time_duration' => $nowPlaying[0],
    //         'cue_time_start' => $nowPlaying[1],
    //         'cue_title' => $nowPlaying[2],
    //         'program_id' => $nowPlaying[3],
    //         'track_artist_name' => $nowPlaying[4],
    //     ];

    //     $songsstore = SongsStore::whereProgramId($data['program_id'])->first();

    //     if (!$songsstore) {
    //         $result = SongsStore::create($data);
    //         $this->api_lyrics($result->id, $data['track_artist_name'], $data['cue_title']);
    //     }

    //     return response()->json("success", 200);
    // }

    // public function api_883JIA(Request $request)
    // {
    //     $response = Curl::to('https://np.tritondigital.com/public/nowplaying?mountName=883JIA&numberToFetch=5&eventType=track')
    //         ->get();

    //     $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
    //     $xmlJson = json_encode($xml);
    //     $xmlArr = json_decode($xmlJson, true);

    //     $nowPlaying = $xmlArr['nowplaying-info']['property'];

    //     $data = [
    //         'channel' => '883JIA',
    //         'cue_time_duration' => $nowPlaying[0],
    //         'cue_time_start' => $nowPlaying[1],
    //         'cue_title' => $nowPlaying[2],
    //         'program_id' => $nowPlaying[3],
    //         'track_artist_name' => $nowPlaying[4],
    //     ];

    //     $songsstore = SongsStore::whereProgramId($data['program_id'])->first();

    //     if (!$songsstore) {
    //         $result = SongsStore::create($data);
    //         $this->api_lyrics($result->id, $data['track_artist_name'], $data['cue_title']);
    //     }

    //     return response()->json("success", 200);
    // }

    // public function api_JIA_KPOP_S01(Request $request)
    // {
    //     $response = Curl::to('https://np.tritondigital.com/public/nowplaying?mountName=JIA_KPOP_S01&numberToFetch=5&eventType=track')
    //         ->get();

    //     $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
    //     $xmlJson = json_encode($xml);
    //     $xmlArr = json_decode($xmlJson, true);

    //     $nowPlaying = $xmlArr['nowplaying-info']['property'];

    //     $data = [
    //         'channel' => 'JIA_KPOP_S01',
    //         'cue_time_duration' => $nowPlaying[0],
    //         'cue_time_start' => $nowPlaying[1],
    //         'cue_title' => $nowPlaying[2],
    //         'program_id' => $nowPlaying[3],
    //         'track_artist_name' => $nowPlaying[4],
    //     ];

    //     $songsstore = SongsStore::whereProgramId($data['program_id'])->first();

    //     if (!$songsstore) {
    //         $result = SongsStore::create($data);
    //         $this->api_lyrics($result->id, $data['track_artist_name'], $data['cue_title']);
    //     }

    //     return response()->json("success", 200);
    // }

    // public function api_POWER_98_RAW_S01(Request $request)
    // {
    //     $channel = $request['channel'];
    //     $response = Curl::to('https://np.tritondigital.com/public/nowplaying?mountName=POWER_98_RAW_S01&numberToFetch=5&eventType=track')
    //         ->get();
    //     $xml = simplexml_load_string(
    //         $response
    //     );

    //     for ($i = 0; $i <= (count($xml->{'nowplaying-info'}) - 1); $i++) {
    //         foreach ($xml->{'nowplaying-info'}[$i]->property as $key => $property) {
    //             if ($property->attributes() == 'cue_time_duration') {
    //                 $cue_time_duration = $property;
    //             }
    //             if ($property->attributes() == 'cue_title') {
    //                 $cue_title = $property;
    //             }
    //             if ($property->attributes() == 'track_artist_name') {
    //                 $track_artist_name = $property;
    //             }
    //             if ($property->attributes() == 'track_id') {
    //                 $track_id = $property;
    //             }
    //             if ($property->attributes() == 'cue_time_start') {
    //                 $cue_time_start = $property;
    //             }

    //         }
    //         $songsstore = SongsStore::where('program_id', $track_id)->first();
    //         if (!$songsstore) {

    //             $result = SongsStore::create([
    //                 'channel' => 'POWER_98_RAW_S01',
    //                 'cue_time_duration' => $cue_time_duration,
    //                 'cue_time_start' => $cue_time_start,
    //                 'cue_title' => $cue_title,
    //                 'program_id' => $track_id,
    //                 'track_artist_name' => $track_artist_name,
    //             ]);
    //             $this->api_lyrics($result->id, $track_artist_name, $cue_title);
    //         }
    //     }
    //     return response()->json("success", 200);
    // }

    // public function api_POWER_98_HITS_S01(Request $request)
    // {
    //     $channel = $request['channel'];
    //     $response = Curl::to('https://np.tritondigital.com/public/nowplaying?mountName=POWER_98_HITS_S01&numberToFetch=5&eventType=track')
    //         ->get();
    //     $xml = simplexml_load_string(
    //         $response
    //     );

    //     for ($i = 0; $i <= (count($xml->{'nowplaying-info'}) - 1); $i++) {
    //         foreach ($xml->{'nowplaying-info'}[$i]->property as $key => $property) {
    //             if ($property->attributes() == 'cue_time_duration') {
    //                 $cue_time_duration = $property;
    //             }
    //             if ($property->attributes() == 'cue_title') {
    //                 $cue_title = $property;
    //             }
    //             if ($property->attributes() == 'track_artist_name') {
    //                 $track_artist_name = $property;
    //             }
    //             if ($property->attributes() == 'track_id') {
    //                 $track_id = $property;
    //             }
    //             if ($property->attributes() == 'cue_time_start') {
    //                 $cue_time_start = $property;
    //             }

    //         }
    //         $songsstore = SongsStore::where('program_id', $track_id)->first();
    //         if (!$songsstore) {

    //             $result = SongsStore::create([
    //                 'channel' => 'POWER_98_HITS_S01',
    //                 'cue_time_duration' => $cue_time_duration,
    //                 'cue_time_start' => $cue_time_start,
    //                 'cue_title' => $cue_title,
    //                 'program_id' => $track_id,
    //                 'track_artist_name' => $track_artist_name,
    //             ]);
    //             $this->api_lyrics($result->id, $track_artist_name, $cue_title);
    //         }
    //     }
    //     return response()->json("success", 200);
    // }

    // public function api_JIA_WEBHITS_S01(Request $request)
    // {

    //     $channel = $request['channel'];
    //     $response = Curl::to('https://np.tritondigital.com/public/nowplaying?mountName=JIA_WEBHITS_S01&numberToFetch=5&eventType=track')
    //         ->get();
    //     $xml = simplexml_load_string(
    //         $response
    //     );

    //     for ($i = 0; $i <= (count($xml->{'nowplaying-info'}) - 1); $i++) {
    //         foreach ($xml->{'nowplaying-info'}[$i]->property as $key => $property) {
    //             if ($property->attributes() == 'cue_time_duration') {
    //                 $cue_time_duration = $property;
    //             }
    //             if ($property->attributes() == 'cue_title') {
    //                 $cue_title = $property;
    //             }
    //             if ($property->attributes() == 'track_artist_name') {
    //                 $track_artist_name = $property;
    //             }
    //             if ($property->attributes() == 'track_id') {
    //                 $track_id = $property;
    //             }
    //             if ($property->attributes() == 'cue_time_start') {
    //                 $cue_time_start = $property;
    //             }

    //         }
    //         $songsstore = SongsStore::where('program_id', $track_id)->first();
    //         if (!$songsstore) {

    //             $result = SongsStore::create([
    //                 'channel' => 'JIA_WEBHITS_S01',
    //                 'cue_time_duration' => $cue_time_duration,
    //                 'cue_time_start' => $cue_time_start,
    //                 'cue_title' => $cue_title,
    //                 'program_id' => $track_id,
    //                 'track_artist_name' => $track_artist_name,
    //             ]);
    //             $this->api_lyrics($result->id, $track_artist_name, $cue_title);
    //         }
    //     }
    //     return response()->json("success", 200);
    // }
}
