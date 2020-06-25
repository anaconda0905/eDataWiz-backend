<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\SubCategory;
use App\Product;
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
        $categories = Category::all();
        $subcategories = SubCategory::orderBy('updated_at', 'desc')->get();
        return View('backEnd.products.create',compact('categories', 'subcategories'));
    }

    public function store(Request $request){
        // $json_categories = json_decode($request->categories);
        Product::create([
            'user_id'       => Sentinel::getUser()->id,
            'categories'    => $request->categories,
        ]);

        Session::flash('message', 'Success! Product is created successfully.');
        Session::flash('status', 'success');

        return redirect('product');
    }
}
