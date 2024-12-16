<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//tener en cuenta que tengo el paquete intervention/image-laravel

class CkeditorController extends Controller
{
    public function upload(Request $req)
    {

        //return 1;

        if($req->hasFile('upload')):

            $image=$req->file('upload');
            $ext=$image->extension();
            $file=time().'.'.$ext;
            $image->move('uploads/',$file);
            $url = asset('uploads/'.$file);
            return response()->json(['fileName'=>$file,'uploaded'=>1,'url'=>$url]);

        endif;


    }

}
