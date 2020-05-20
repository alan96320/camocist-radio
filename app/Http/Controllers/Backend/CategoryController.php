<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('backend.categories.index')->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if ($request->isMethod('post')) {

            $result = Category::create([
                'name' => $request->name,
                'type' => $request->type,
                'color' =>  $request->color
            ]);

            $status = ($result) ? ['info'=>'success', 'message'=>'Category was added!'] : ['info'=>'error', 'message'=>'Category was not added!'];
            return redirect()->route('admin.categories.index')->with($status['info'], $status['message']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.categories.edit')->with(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        if ($request->isMethod('put')) {

            $category = Category::findOrFail($id);
            
            $category->name = $request->name;
            $category->type = $request->type;
            $category->color = $request->color;
            $result = $category->save();

            $status = ($result) ? ['info'=>'success', 'message'=>'Category was edited!'] : ['info'=>'error', 'message'=>'Category was not edited!'];
            return redirect()->route('admin.categories.index')->with($status['info'], $status['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $result = $category->delete();
        $status = ($result) ? ['info'=>'success', 'message'=>'Category was deleted!'] : ['info'=>'error', 'message'=>'Category was not deleted!'];
            return redirect()->route('admin.categories.index')->with($status['info'], $status['message']);
    }
}
