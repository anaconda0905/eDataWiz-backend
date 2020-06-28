<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\Category1;
use App\Category2;
use App\Category3;
use App\Category4;
use App\Category5;
use App\Category6;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class CategoryAPIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function productlist(Request $request){
        $category1_id = $request->cat1;
        $category2_id = $request->cat2;
        $category3_id = $request->cat3;
        $category4_id = $request->cat4;
        $category5_id = $request->cat5;
        $category6_id = $request->cat6;
        $data = Product::get()
            ->where('category1_id', $category1_id)
            ->where('category2_id', $category2_id)
            ->where('category3_id', $category3_id)
            ->where('category4_id', $category4_id)
            ->where('category5_id', $category5_id)
            ->where('category6_id', $category6_id);

        return response()->json([
            'success' => true,
            'data'    => $data,
            'message' => 'Category lists #1 retrived successfully.',
        ]);
    }

    public function getCatgory1(Request $request){
        $cat1 = Category1::all();
        return response()->json([
            'success' => true,
            'data'    => $cat1,
            'message' => 'Category lists #1 retrived successfully.',
        ]);
    }

    public function getCatgory2(Request $request){
        $cat = Category2::where(['parent_id' => $request->input('parent_id')])->first();
        if (!$cat) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ]);
        }
        $cat2 = Category2::get()->where('parent_id', $request->parent_id);
        $data = array();
        foreach ($cat2 as $key => $value) {
            # code...
            array_push($data, $value);
        }
        return response()->json([
            'success' => true,
            'data'    => $data,
            'message' => 'Category lists #2 retrived successfully.',
        ]);
    }
    public function getCatgory3(Request $request){
        $cat = Category3::where(['parent_id' => $request->input('parent_id')])->first();
        if (!$cat) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ]);
        }
        $cat3 = Category3::get()->where('parent_id', $request->parent_id);
        $data = array();
        foreach ($cat3 as $key => $value) {
            # code...
            array_push($data, $value);
        }
        return response()->json([
            'success' => true,
            'data'    => $data,
            'message' => 'Category lists #3 retrived successfully.',
        ]);
    }
    public function getCatgory4(Request $request){
        $cat = Category4::where(['parent_id' => $request->input('parent_id')])->first();
        if (!$cat) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ]);
        }
        $cat4 = Category4::get()->where('parent_id', $request->parent_id);
        $data = array();
        foreach ($cat4 as $key => $value) {
            # code...
            array_push($data, $value);
        }
        return response()->json([
            'success' => true,
            'data'    => $data,
            'message' => 'Category lists #4 retrived successfully.',
        ]);
    }
    public function getCatgory5(Request $request){
        $cat = Category5::where(['parent_id' => $request->input('parent_id')])->first();
        if (!$cat) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ]);
        }
        $cat5 = Category5::get()->where('parent_id', $request->parent_id);
        $data = array();
        foreach ($cat5 as $key => $value) {
            # code...
            array_push($data, $value);
        }
        return response()->json([
            'success' => true,
            'data'    => $data,
            'message' => 'Category lists #5 retrived successfully.',
        ]);
    }
    public function getCatgory6(Request $request){
        $cat = Category6::where(['parent_id' => $request->input('parent_id')])->first();
        if (!$cat) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ]);
        }
        $cat6 = Category6::get()->where('parent_id', $request->parent_id);
        $data = array();
        foreach ($cat6 as $key => $value) {
            # code...
            array_push($data, $value);
        }
        return response()->json([
            'success' => true,
            'data'    => $data,
            'message' => 'Category lists #6 retrived successfully.',
        ]);
    }
}