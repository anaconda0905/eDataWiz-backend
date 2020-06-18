<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QrCode;

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
    public function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
    public function ajax_update(Request $request)
    {
        $data ="data:image/png;base64,". base64_encode(QrCode::format('png')->color(38, 38, 38, 0.85)->backgroundColor(255, 255, 255, 0.82)->size(200)->generate(HomeController::base64url_encode($request->message)));
        $response = array(
            'status' => 'success',
            'msg' => $data,
        );
        return response()->json($response);
    }
}