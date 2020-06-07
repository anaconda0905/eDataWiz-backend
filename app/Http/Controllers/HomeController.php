<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home($value='')
    {
    	return view('welcome');
    }
    public function about($value='')
    {
    	return view('about');
    }
    public function solution($value='')
    {
    	return view('solution');
    }
    public function contact($value='')
    {
    	return view('contact');
    }
    public function demo($value='')
    {
    	return view('demo');
    }
    public function YourhomePage($value='')
    {
    	return view('home');
    }
    public function dashboard($value='')
    {
    	return view('backEnd.dashboard');
    }
}
