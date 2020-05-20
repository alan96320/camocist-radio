<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\News;
use App\Models\NewsLabel;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\NewsRequest;
use File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('ordering', 'ASC')->get();
        $newsLabel = NewsLabel::first();
        return view('backend.news.index')->with(compact('news', 'newsLabel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('type', 'news')->get();
        return view('backend.news.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        if ($request->isMethod('post')) {

            $image = $this->getImage($request, 'images/news/');
            $allNews = News::get();

            foreach ($allNews as $news) {
                $news->ordering = $news->ordering + 1;
                $news->save();
            }

            $result = News::create([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' =>  $request->category_id,
                'date' =>  $request->date,
                'image_url' =>  $image,
                'external_url' => $request->external_url,
                'ordering' => 1,
            ]);

            $status = ($result) ? ['info'=>'success', 'message'=>'News was added!'] : ['info'=>'error', 'message'=>'News was not added!'];
            return redirect()->route('admin.news.index')->with($status['info'], $status['message']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = Category::where('type', 'news')->get();
        return view('backend.news.edit')->with(compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        if ($request->isMethod('put')) {

            $news = News::findOrFail($id);
            
            $image = $this->getImage($request, 'images/news/');

            if($image) {
                $news->image_url = $image;
            }

            $news->title = $request->title;
            $news->description = $request->description;
            $news->category_id = $request->category_id;
            $news->date = $request->date;
            $news->external_url = $request->external_url;
            $result = $news->save();

            $status = ($result) ? ['info'=>'success', 'message'=>'News was edited!'] : ['info'=>'error', 'message'=>'News was not edited!'];
            return redirect()->route('admin.news.index')->with($status['info'], $status['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $image_path = app_path().'/images/news/'.$news->image_url;
        $allNews = News::where('ordering', '>', $news->ordering)->orderBy('ordering', 'ASC')->get();

        if(File::exists($image_path))
        {
            File::delete($image_path);
            //unlink($image_path);
        }
        $result = $news->delete();

        if ($result) {
            foreach ($allNews as $singleNews) {
                $singleNews->ordering = $singleNews->ordering - 1;
                $singleNews->save();
            }
        }
        $status = ($result) ? ['info'=>'success', 'message'=>'News was deleted!'] : ['info'=>'error', 'message'=>'News was not deleted!'];
            return redirect()->route('admin.news.index')->with($status['info'], $status['message']);
    }

    public function updateNewsLabel(Request $request) {
        $newsLabel = NewsLabel::first();

        if ($newsLabel == null) {
            $newsLabel = new NewsLabel();
        }
        $newsLabel->name = $request->label;
        $result = $newsLabel->saveOrFail();

        $status = ($result) ? ['info'=>'success', 'message'=>'News Label was udpated!'] : ['info'=>'error', 'message'=>'News Label was not updated!'];
            return redirect()->route('admin.news.index')->with($status['info'], $status['message']);
    }

    public function updateNewsOrdering(Request $request) {
        try {
            foreach ($request->newsData as $singleNewsData) {
                $news = News::findOrFail($singleNewsData['id']);
                $news->ordering = $singleNewsData['ordering'];
                $news->save();
            } 
            $data['status'] = 'success';
            $data ['message'] = 'News ordering updated successfully!';
            return response()->json($data);
        } catch (Exception $e) {
            $data['status'] = 'error';
            $data ['message'] = $e->getMessage();
            return response()->json($data);
        }
    }
}
