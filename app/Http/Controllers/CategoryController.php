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
    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|max:35|min:2|string',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        return View('backEnd.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {   $categories = Category::get()->pluck('name', 'id');
        return View('backEnd.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request){
        if ($this->validator($request)->fails()) {
            return redirect()->back()
                        ->withErrors($this->validator($request))
                        ->withInput();
        }
         
        Category::create($request->all());
        Session::flash('message', 'Success! Category is created successfully.');
        Session::flash('status', 'success');

        return redirect('role');
    }
}
