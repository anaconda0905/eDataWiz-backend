<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return View('backEnd.products.create');
    }

    public function store(Request $request){

        Session::flash('message', 'Success! Product is created successfully.');
        Session::flash('status', 'success');

        return redirect('product');
    }
}
