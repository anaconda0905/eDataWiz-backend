<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category1;
use App\Category2;
use App\Category3;
use App\Category4;
use App\Category5;
use App\Category6;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Route;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $parent_id1 = 0;
        $parent_id2 = 0;
        $parent_id3 = 0;
        $parent_id4 = 0;
        $parent_id5 = 0;
        $parent_id6 = 0;
        
        $temp = Category1::get()->first();
        if($temp) $parent_id1 = $temp->id;
        $temp = Category2::get()->where('parent_id', $parent_id1)->first();
        if($temp) $parent_id2 = $temp->id;
        $temp = Category3::get()->where('parent_id', $parent_id2)->first();
        if($temp) $parent_id3 = $temp->id;
        $temp = Category4::get()->where('parent_id', $parent_id3)->first();
        if($temp) $parent_id4 = $temp->id;
        $temp = Category5::get()->where('parent_id', $parent_id4)->first();
        if($temp) $parent_id5 = $temp->id;
        $temp = Category6::get()->where('parent_id', $parent_id5)->first();
        if($temp) $parent_id6 = $temp->id;

        $categories1 = Category1::get()->pluck('name', 'id');
        $categories2 = Category2::get()->where('parent_id', $parent_id1)->pluck('name', 'id');
        $categories3 = Category3::get()->where('parent_id', $parent_id2)->pluck('name', 'id');
        $categories4 = Category4::get()->where('parent_id', $parent_id3)->pluck('name', 'id');
        $categories5 = Category5::get()->where('parent_id', $parent_id4)->pluck('name', 'id');
        $categories6 = Category6::get()->where('parent_id', $parent_id5)->pluck('name', 'id');

        return View('backEnd.products.create',
            compact('categories1','categories2','categories3', 'categories4', 'categories5','categories6'));
    }

    public function ajax_update1(Request $request)
    {
        $parent_id1 = 0;
        $parent_id2 = 0;
        $parent_id3 = 0;
        $parent_id4 = 0;
        $parent_id5 = 0;
        $parent_id6 = 0;

        $parent_id1 = $request->cat1;
        $temp = Category2::get()->where('parent_id', $parent_id1)->first();
        if($temp) $parent_id2 = $temp->id;
        $temp = Category3::get()->where('parent_id', $parent_id2)->first();
        if($temp) $parent_id3 = $temp->id;
        $temp = Category4::get()->where('parent_id', $parent_id3)->first();
        if($temp) $parent_id4 = $temp->id;
        $temp = Category5::get()->where('parent_id', $parent_id4)->first();
        if($temp) $parent_id5 = $temp->id;
        $temp = Category6::get()->where('parent_id', $parent_id5)->first();
        if($temp) $parent_id6 = $temp->id;

        $categories1 = Category1::get()->pluck('name', 'id');
        $categories2 = Category2::get()->where('parent_id', $parent_id1)->pluck('name', 'id');
        $categories3 = Category3::get()->where('parent_id', $parent_id2)->pluck('name', 'id');
        $categories4 = Category4::get()->where('parent_id', $parent_id3)->pluck('name', 'id');
        $categories5 = Category5::get()->where('parent_id', $parent_id4)->pluck('name', 'id');
        $categories6 = Category6::get()->where('parent_id', $parent_id5)->pluck('name', 'id');
        $html = View('backEnd.products.table', compact('categories1','categories2','categories3', 'categories4', 'categories5','categories6'))->render();

        return response()->json(compact('html'));
    }

    public function ajax_update2(Request $request)
    {
        $parent_id1 = 0;
        $parent_id2 = 0;
        $parent_id3 = 0;
        $parent_id4 = 0;
        $parent_id5 = 0;
        $parent_id6 = 0;

        $parent_id1 = $request->cat1;
        $parent_id2 = $request->cat2;
        $temp = Category3::get()->where('parent_id', $parent_id2)->first();
        if($temp) $parent_id3 = $temp->id;
        $temp = Category4::get()->where('parent_id', $parent_id3)->first();
        if($temp) $parent_id4 = $temp->id;
        $temp = Category5::get()->where('parent_id', $parent_id4)->first();
        if($temp) $parent_id5 = $temp->id;
        $temp = Category6::get()->where('parent_id', $parent_id5)->first();
        if($temp) $parent_id6 = $temp->id;

        $categories1 = Category1::get()->pluck('name', 'id');
        $categories2 = Category2::get()->where('parent_id', $parent_id1)->pluck('name', 'id');
        $categories3 = Category3::get()->where('parent_id', $parent_id2)->pluck('name', 'id');
        $categories4 = Category4::get()->where('parent_id', $parent_id3)->pluck('name', 'id');
        $categories5 = Category5::get()->where('parent_id', $parent_id4)->pluck('name', 'id');
        $categories6 = Category6::get()->where('parent_id', $parent_id5)->pluck('name', 'id');
        $html = View('backEnd.products.table', compact('categories1','categories2','categories3', 'categories4', 'categories5','categories6'))->render();

        return response()->json(compact('html'));
    }

    public function ajax_update3(Request $request)
    {
        $parent_id1 = 0;
        $parent_id2 = 0;
        $parent_id3 = 0;
        $parent_id4 = 0;
        $parent_id5 = 0;
        $parent_id6 = 0;

        $parent_id1 = $request->cat1;
        $parent_id2 = $request->cat2;
        $parent_id3 = $request->cat3;
        $temp = Category4::get()->where('parent_id', $parent_id3)->first();
        if($temp) $parent_id4 = $temp->id;
        $temp = Category5::get()->where('parent_id', $parent_id4)->first();
        if($temp) $parent_id5 = $temp->id;
        $temp = Category6::get()->where('parent_id', $parent_id5)->first();
        if($temp) $parent_id6 = $temp->id;

        $categories1 = Category1::get()->pluck('name', 'id');
        $categories2 = Category2::get()->where('parent_id', $parent_id1)->pluck('name', 'id');
        $categories3 = Category3::get()->where('parent_id', $parent_id2)->pluck('name', 'id');
        $categories4 = Category4::get()->where('parent_id', $parent_id3)->pluck('name', 'id');
        $categories5 = Category5::get()->where('parent_id', $parent_id4)->pluck('name', 'id');
        $categories6 = Category6::get()->where('parent_id', $parent_id5)->pluck('name', 'id');
        $html = View('backEnd.products.table', compact('categories1','categories2','categories3', 'categories4', 'categories5','categories6'))->render();

        return response()->json(compact('html'));
    }

    public function ajax_update4(Request $request)
    {
        $parent_id1 = 0;
        $parent_id2 = 0;
        $parent_id3 = 0;
        $parent_id4 = 0;
        $parent_id5 = 0;
        $parent_id6 = 0;

        $parent_id1 = $request->cat1;
        $parent_id2 = $request->cat2;
        $parent_id3 = $request->cat3;
        $parent_id4 = $request->cat4;
        $temp = Category5::get()->where('parent_id', $parent_id4)->first();
        if($temp) $parent_id5 = $temp->id;
        $temp = Category6::get()->where('parent_id', $parent_id5)->first();
        if($temp) $parent_id6 = $temp->id;

        $categories1 = Category1::get()->pluck('name', 'id');
        $categories2 = Category2::get()->where('parent_id', $parent_id1)->pluck('name', 'id');
        $categories3 = Category3::get()->where('parent_id', $parent_id2)->pluck('name', 'id');
        $categories4 = Category4::get()->where('parent_id', $parent_id3)->pluck('name', 'id');
        $categories5 = Category5::get()->where('parent_id', $parent_id4)->pluck('name', 'id');
        $categories6 = Category6::get()->where('parent_id', $parent_id5)->pluck('name', 'id');
        $html = View('backEnd.products.table', compact('categories1','categories2','categories3', 'categories4', 'categories5','categories6'))->render();

        return response()->json(compact('html'));
    }

    public function ajax_update5(Request $request)
    {
        $parent_id1 = 0;
        $parent_id2 = 0;
        $parent_id3 = 0;
        $parent_id4 = 0;
        $parent_id5 = 0;
        $parent_id6 = 0;

        $parent_id1 = $request->cat1;
        $parent_id2 = $request->cat2;
        $parent_id3 = $request->cat3;
        $parent_id4 = $request->cat4;
        $parent_id5 = $request->cat5;
        $temp = Category6::get()->where('parent_id', $parent_id5)->first();
        if($temp) $parent_id6 = $temp->id;

        $categories1 = Category1::get()->pluck('name', 'id');
        $categories2 = Category2::get()->where('parent_id', $parent_id1)->pluck('name', 'id');
        $categories3 = Category3::get()->where('parent_id', $parent_id2)->pluck('name', 'id');
        $categories4 = Category4::get()->where('parent_id', $parent_id3)->pluck('name', 'id');
        $categories5 = Category5::get()->where('parent_id', $parent_id4)->pluck('name', 'id');
        $categories6 = Category6::get()->where('parent_id', $parent_id5)->pluck('name', 'id');
        $html = View('backEnd.products.table', compact('categories1','categories2','categories3', 'categories4', 'categories5','categories6'))->render();

        return response()->json(compact('html'));
    }

    public function store(Request $request){

        Session::flash('message', 'Success! Product is created successfully.');
        Session::flash('status', 'success');

        return redirect('product');
    }
}
