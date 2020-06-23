<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Route;
class CategoryController extends Controller
{
    //
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {   $categories = Category::get()->pluck('name', 'id');
        return View('backEnd.categories.create',compact('categories'));
    }
}
