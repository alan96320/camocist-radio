<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\Filters;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\PostRequest;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get();
        $filters = Filters::get();
        // dd($filters);
        return view('backend.posts.index')->with(compact('posts', 'filters'));
    }
	
	public function deleteimage(Request $request){
		$post = Post::findOrFail($request->id);
                $post->image_url ='';
            $result = $post->save();
		if($result){
		return response()->json(array('status'=> true), 200);
		}else{
		return response()->json(array('status'=> false), 200);
		}
	}

    public function upload(Request $request) {
        $fullPath = null;
        $image = $request->hasFile('file') ? time().$request->file('file')->getClientOriginalName() : null;

        if($image) {
            $request->file('file')->move(public_path('images/posts/content'), $image);
            $fullPath = asset('images/posts/content').'/'.$image;
        }
        return response()->json(['location' => $fullPath], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('type', 'post')->get();
        return view('backend.posts.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if ($request->isMethod('post')) {
 		if ($request->video!='' && $request->hasFile('image')=='') {
                $value = explode("embed/", $request->video);
                $videoId = $value[1];
                $image = "https://img.youtube.com/vi/".$videoId."/hqdefault.jpg";
            }else{
            $image = $this->getImage($request, 'images/posts/');
	 }
            $result = Post::create([
                'title' => $request->title,
				'url' => $this->clean($request->title),
                'description' => $request->description,
                'category_id' =>  $request->category_id,
				'video' => $request->video,
                'date' =>  $request->date,
                'content' =>  $request->content,
                'featured' =>  $request->featured ? 1 : 0,
                'image_url' =>  $image,
            ]);

            $status = ($result) ? ['info'=>'success', 'message'=>'Post was added!'] : ['info'=>'error', 'message'=>'Post was not added!'];
            return redirect()->route('admin.posts.index')->with($status['info'], $status['message']);
        }
    }
	public function clean($string, $separator = '-') {
		$array = array('@','#',';',':','$','%','^','&','*','\\','!','>','<');
		for($a=1;$a<=count($array);$a++){
		$string = str_replace(@$array[$a],"",$string);
		}
		$re = "/(\\s|\\".$separator.")+/mu";
    $str = @trim($string);
    $subst = $separator;
    $result = preg_replace($re, $subst, $str);
    return $result;
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::where('type', 'post')->get();
        return view('backend.posts.edit')->with(compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        if ($request->isMethod('put')) {

            $post = Post::findOrFail($id);
     if ($post->video!='' && $request->hasFile('image')=='') {
		 		if(strpos($post->image_url,'youtube') || $post->image_url==''){
                $value = explode("embed/", $post->video);
                $videoId = $value[1];
                $image = "https://img.youtube.com/vi/".$videoId."/hqdefault.jpg";
				}
		 else{
            $image = $this->getImage($request, 'images/posts/');
	       } 
            }else{
            $image = $this->getImage($request, 'images/posts/');
	       } 
      
            if($image) {
                $post->image_url = $image;
            }

            $post->title = $request->title;
			$post->url = $this->clean($request->title);
            $post->description = $request->description;
            $post->category_id = $request->category_id;
			$post->video = $request->video;
            $post->date = $request->date;
            $post->content = $request->content;
            $post->featured =  $request->featured ? 1 : 0;
            $result = $post->save();

            $status = ($result) ? ['info'=>'success', 'message'=>'Post was edited!'] : ['info'=>'error', 'message'=>'Post was not edited!'];
            return redirect()->route('admin.posts.index')->with($status['info'], $status['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $image_path = app_path().'/images/posts/'.$post->image_url;

        if(File::exists($image_path))
        {
            File::delete($image_path);
            //unlink($image_path);
        }
        $result = $post->delete();
        $status = ($result) ? ['info'=>'success', 'message'=>'Post was deleted!'] : ['info'=>'error', 'message'=>'Post was not deleted!'];
            return redirect()->route('admin.posts.index')->with($status['info'], $status['message']);
    }

    public function updateFilters(Request $request) {
        $filters = Filters::get();
        foreach($filters as $filter) {
            if(array_key_exists($filter->id, $request->all())) {
                $filter->active = 1;
            } else {
                $filter->active = 0;
            }
            $filter->save();
        }
        return redirect()->back();
    }
}
