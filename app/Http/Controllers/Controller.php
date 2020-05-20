<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class Controller.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getImage($request, $path)
    {
        $newImage = $request->hasFile('image') ? time().$request->file('image')->getClientOriginalName() : null;

        if($newImage) {
            $request->file('image')->move(public_path($path), $newImage);
        }

        return $newImage;
    }
}
