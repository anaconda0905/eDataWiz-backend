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
use Storage;
use App\User;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $category1 = Category1::all();
        $category2 = Category2::all();
        $category3 = Category3::all();
        $category4 = Category4::all();
        $category5 = Category5::all();
        $category6 = Category6::all();
        $products = Product::all();
        $users = User::all();
        return View('backEnd.products.index', 
            compact('products', 'category1', 'category2', 'category3', 'category4', 'category5', 'category6', "users"));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        Session::flash('message', 'Success! Role is deleted successfully.');
        Session::flash('status', 'success');

        return redirect('product');
    }

    protected function validator(Request $request, $id = '')
    {
        return Validator::make($request->all(), [
            'category1' => 'required',
            'category2' => 'required',
            'category3' => 'required',
            'category4' => 'required',
            'category5' => 'required',
            'category6' => 'required',
            'fileselect' => 'required',
        ]);
    }

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
        
        // if ($this->validator($request, Sentinel::getUser()->id)->fails()) {

        //     return redirect()->back()
        //         ->withErrors($this->validator($request))
        //         ->withInput();
        // }
        $json_categories = json_decode($request->categories);
        $file = $request->file('fileselect');
        $fileName = Sentinel::getUser()->id . '_' . time() . '_' . $file->getClientOriginalName();
        $path = "PDF/".$fileName;
        $f = Storage::disk('s31')->put($path, file_get_contents($file), 'public');
        $absolute_path = Storage::disk('s31')->url($path);
        Product::create([
            'user_id'         => Sentinel::getUser()->id,
            'category1_id'    => $json_categories->category1,
            'category2_id'    => $json_categories->category2,
            'category3_id'    => $json_categories->category3,
            'category4_id'    => $json_categories->category4,
            'category5_id'    => $json_categories->category5,
            'category6_id'    => $json_categories->category6,
            'aws_path'        => 'PDF/'.$fileName,
            'filepath'        => $absolute_path,
            'filename'        => $file->getClientOriginalName(),
        ]);
        
        Session::flash('message', 'Success! Product is created successfully.');
        Session::flash('status', 'success');

        return redirect('product');
    }
}