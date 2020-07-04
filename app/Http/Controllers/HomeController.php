<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QrCode;
use App\SubCategory;
use App\Category;
use Activation;
use App\Role;
use App\User;
use Route;
use Sentinel;
use Session;
use Storage;
use Validator;

class HomeController extends Controller
{
    public function home($value = '')
    {
        return view('welcome');
    }
    public function about($value = '')
    {
        return view('about');
    }
    public function solution($value = '')
    {
        return view('solution');
    }
    public function contact($value = '')
    {
        return view('contact');
    }
    public function demo($value = '')
    {
        return view('demo');
    }
    public function YourhomePage($value = '')
    {
        return view('home');
    }
    public function dashboard($value = '')
    {
        return view('backEnd.dashboard');
    }

    public function verify(Request $request)
    {
        return view('auth.verify');
    }
    
    public function ajax_update_copy(Request $request){
        $response = array(
            'status' => 'success',
            'msg' => $request->dest_url,
        );
        return response()->json($response);
    }

    public function ajax_update(Request $request)
    {
        // Create image (base64) from some text
        $string = $request->filename;  
        $string1 = substr($string, 0, 16); 
        $string2 = substr($string, 16, 16); 
        $string3 = substr($string, 32, 16); 
        $width  = $request->dimension;
        $height = $request->dimension;
        $im = @imagecreate ($width, $height);
        $text_color = imagecolorallocate ($im, 0, 0, 120); //black text
        // white background
        // $background_color = imagecolorallocate ($im, 255, 255, 255);
        // transparent background
        $transparent = imagecolorallocatealpha($im, 0, 0, 0, 127);
        imagefill($im, 0, 0, $transparent);
        imagesavealpha($im, true);
        imagestring ($im, 30, ($request->dimension -140)/2, $request->dimension - 40, $string1, $text_color);
        imagestring ($im, 30, ($request->dimension -140)/2, $request->dimension - 27, $string2, $text_color);
        imagestring ($im, 30, ($request->dimension -140)/2, $request->dimension - 14, $string3, $text_color);
        ob_start();
        imagepng($im);
        $imstr = base64_encode(ob_get_clean());
        imagedestroy($im);
        // Save Image in folder from string base64
        $image_base64 = base64_decode($imstr);
        Storage::disk('local')->put('images/qrcode.png', $image_base64, 'public');

        $data ="data:image/png;base64,". base64_encode(QrCode::format('png')->margin(10)->merge(storage_path()."/app/images/qrcode.png",1,true)->color(38, 38, 38, 0.85)->backgroundColor(255, 255, 255, 0.82)->size($request->dimension)->generate($request->message));
        $response = array(
            'status' => 'success',
            'msg' => $data,
        );
        return response()->json($response);
    }
}