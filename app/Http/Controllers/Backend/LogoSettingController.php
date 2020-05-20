<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LogoSetting;
use App\Models\Timebelt;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as IM;

class LogoSettingController extends Controller
{
    public function index()
    {
    	$logo_settings = LogoSetting::orderby('id','desc')->paginate(10);
        return view('backend.logo_setting.index',compact('logo_settings'));
    }

    public function create()
    {
        return view('backend.logo_setting.create');
    }

    public function store(Request $request)
    {
       
    	$logo_setting         = new LogoSetting();
    	$logo_setting->key    = $request->key;
        $logo_setting->status = $request->status;
      

    	if ($request->hasFile('logo_image')) {

            $file = $request->file('logo_image');
         
            $name = $file->getClientOriginalName();

            //get file extension
            $extension = $file->getClientOriginalExtension();
            $main_filename = 'logo_image_'.time().'.'.$extension;

            $logo_setting->logo_image = $main_filename;
           
           // $store_name = Store::where('admin_id',1)->where('active',1)->first();
            $path = public_path() . '/upload/Logo_Images/';
            File::exists($path) or File::makeDirectory($path,0777,true);
            
            $filenametostore = '289_56_'.$main_filename;
            //Resize image
            $img_path = public_path('/upload/Logo_Images/'.$filenametostore);
            $file_img = IM::make($file->getRealPath())->resize(289, 56)->save($img_path,80);
            
            $file->move($path, 'thumb-'.$main_filename);
            
        }
        $logo_setting->save();

        return redirect()->route('admin.logo_setting.index')->withFlashSuccess('Logo created succesfully!');
    }

    public function edit($id)
    {
    	$logo_setting = LogoSetting::find($id);
       
        return view('backend.logo_setting.edit',compact('logo_setting'));
    }

    public function update(Request $request, $id)
    {
        $logo_setting         = LogoSetting::find($id);
    	$logo_setting->key    = $request->key;
        $logo_setting->status = $request->status;

    	if ($request->hasFile('logo_image')) {

            $file = $request->file('logo_image');
         
            $name = $file->getClientOriginalName();

            //get file extension
            $extension = $file->getClientOriginalExtension();
            $main_filename = 'banner_image_'.time().'.'.$extension;

            $logo_setting->logo_image = $main_filename;
           
           // $store_name = Store::where('admin_id',1)->where('active',1)->first();
            $path = public_path() . '/upload/Logo_Images/';
            File::exists($path) or File::makeDirectory($path,0777,true);
            
            $filenametostore = '289_56_'.$main_filename;
            //Resize image
            $img_path = public_path('/upload/Logo_Images/'.$filenametostore);
            $file_img = IM::make($file->getRealPath())->resize(289, 56)->save($img_path,80);
            
            $file->move($path, 'thumb-'.$main_filename);
            
        }

    	$logo_setting->save();
       
        return redirect()->route('admin.logo_setting.index')->withFlashSuccess('Logo Updated Successfully!!');
    }

    public function delete($id){

    	$logo_setting = LogoSetting::find($id);
    	$logo_setting->delete();

		return redirect()->route('admin.logo_setting.index')->withFlashSuccess('Logo Deleted Successfully!!');
    }
}
