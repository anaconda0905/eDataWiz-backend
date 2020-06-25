<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QrCode;
use App\SubCategory;
use App\Category;

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

    public function create(Request $request){
        $category = Category::findOrFail($request->message);
        SubCategory::create([
            'category'  => $category->id,
            'name'      => $request->name
        ]);
        $response = array(
            'status' => 'success',
        );
        return response()->json($response);
    }

    public function update(Request $request){
        $subcategory = SubCategory::findOrFail($request->id);
        $subcategory->update([
            'id'        => $subcategory->id,
            'name'      => $request->name
        ]);
        $response = array(
            'status' => 'success',
        );
        return response()->json($response);
    }

    public function destroy(Request $request){
        $subcategory = SubCategory::findOrFail($request->message);
        $subcategory->delete();
        
        $response = array(
            'status' => 'success',
        );
        return response()->json($response);
    }
    public function ajax_update(Request $request)
    {
        $data ="data:image/png;base64,". base64_encode(QrCode::format('png')->color(38, 38, 38, 0.85)->backgroundColor(255, 255, 255, 0.82)->size($request->dimension)->generate($request->message));
        $response = array(
            'status' => 'success',
            'msg' => $data,
        );
        return response()->json($response);
    }
}