<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Timebelt;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as IM;

class TimebeltController extends Controller
{
    public function index()
    {
    	$timebelts = Timebelt::orderby('id','desc')->paginate(10);
        return view('backend.timebelt.index',compact('timebelts'));
    }

    public function create()
    {
        return view('backend.timebelt.create');
    }

    public function store(Request $request)
    {
        $days = implode(',', $request->days);

    	$timebelt               = new Timebelt();
    	$timebelt->start_time   = $request->start_time;
    	$timebelt->end_time     = $request->end_time;
    	$timebelt->is_active    = $request->is_active;
        $timebelt->days         = $days;
        $timebelt->player_name  = $request->player_name;
        $timebelt->is_default  = $request->is_default;

    	if ($request->hasFile('banner_image')) {

            $file = $request->file('banner_image');
         
            $name = $file->getClientOriginalName();

            //get file extension
            $extension = $file->getClientOriginalExtension();
            $main_filename = 'banner_image_'.time().'.'.$extension;

            $timebelt->banner_image = $main_filename;
           
           // $store_name = Store::where('admin_id',1)->where('active',1)->first();
            $path = public_path() . '/upload/timebelt/';
            File::exists($path) or File::makeDirectory($path,0777,true);
            
            $filenametostore = '1200_800_'.$main_filename;
            //Resize image
            $img_path = public_path('/upload/timebelt/'.$filenametostore);
          //  $file_img = IM::make($file->getRealPath())->resize(425, 130)->save($img_path,80);
            
            $file->move($path, $filenametostore);
            
        }

        $timebelt->save();

        return redirect()->route('admin.timebelt.index')->withFlashSuccess('Timebelt created succesfully!');
    }

    public function edit($id)
    {
    	$timebelt = Timebelt::find($id);
        $days = $timebelt->days;
        $days_array = explode(',', $days);

        return view('backend.timebelt.edit',compact('timebelt','days_array'));
    }

    public function update(Request $request, $id)
    {
        $days = implode(',', $request->days);

    	$timebelt = Timebelt::find($id);
    	$timebelt->start_time = $request->start_time;
    	$timebelt->end_time   = $request->end_time;
    	$timebelt->is_active  = $request->is_active;
        $timebelt->days       = $days;
        $timebelt->player_name  = $request->player_name;
        $timebelt->is_default  = $request->is_default;

    	if ($request->hasFile('banner_image')) {

            $file = $request->file('banner_image');
         
            $name = $file->getClientOriginalName();

            //get file extension
            $extension = $file->getClientOriginalExtension();
            $main_filename = 'banner_image_'.time().'.'.$extension;

            $timebelt->banner_image = $main_filename;
           
           // $store_name = Store::where('admin_id',1)->where('active',1)->first();
            $path = public_path() . '/upload/timebelt/';
            File::exists($path) or File::makeDirectory($path,0777,true);
            
            $filenametostore = '1200_800_'.$main_filename;
            //Resize image
            $img_path = public_path('/upload/timebelt/'.$filenametostore);
            //$file_img = IM::make($file->getRealPath())->resize(425, 130)->save($img_path,80);
            
            $file->move($path, $filenametostore);
            
        }

    	$timebelt->save();
       
        return redirect()->route('admin.timebelt.index')->withFlashSuccess('Timebelt Updated Successfully!!');
    }

    public function delete($id){

    	$timebelt = Timebelt::find($id);
    	$timebelt->delete();

		return redirect()->route('admin.timebelt.index')->withFlashSuccess('Timebelt Deleted Successfully!!');
    }
}