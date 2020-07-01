<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use App\Brand;
use App\Classification;
use App\General;
use App\Header;
use App\PdList;
use File;
use Exception;



class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('general','classification','header','pdList','brand')->latest()->get();
        return view('backEnd.question.index',compact('questions'));
    }
    public function create()
    {
        $generals = General::all();
        $classifications = Classification::all();
        $headers = Header::all();
        $pdLists = PdList::all();
        $brands = Brand::all();
        return view('backEnd.question.create', compact('generals','classifications','headers','pdLists','brands'));
    }
    public function store(Request $request)
    {
        try{
            $question = new Question();
                $question->pd_general = $request->general;
                $question->pd_classification = $request->classification;
                $question->pd_header = $request->header;
                $question->pd_list = $request->list;
                $question->pd_brand = $request->brand;
                
                
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $brandName = Brand::find($request->brand)->pd_brand;
                $brandName = str_replace(' ', '-', $brandName); 
                $brandName = preg_replace('/[^A-Za-z0-9\-]/', '', $brandName);
                $fileName = $brandName.".pdf";
                $file->move(public_path().'/pd_files/', $fileName);
                $question->pd_filename = $fileName;
            }else{
                $question->pd_filename = "  ";
            }

            $question->save();
            return back()->with('success','Datasheet created successfully.');
        }catch (Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }
     public function show(Question $question)
    {
        return view('backEnd.question.show',compact('question'));
    }

     public function edit(Question $question)
    {
        $generals = General::all();
        $classifications = Classification::all();
        $headers = Header::all();
        $pdLists = PdList::all();
        $brands = Brand::all();
        return view('backEnd.question.edit', compact('generals','classifications','headers','pdLists','brands','question'));
    }
     public function updateQuestion(Request $request)
    {
        try{
            $question = Question::find($request->id);
            $question->pd_general = $request->general;
            $question->pd_classification = $request->classification;
            $question->pd_header = $request->header;
            $question->pd_list = $request->list;
            $question->pd_brand = $request->brand;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = Brand::find($request->brand)->pd_brand.".pdf";
                $file->move(public_path().'/pd_files/', $fileName);
                $question->pd_filename = $fileName;
            }
            $question->save();
            return back()->with('success','Datasheet updated successfully.');
        }catch (Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }
    public function deleteQuestion(Request $request)
    {
        $question = Question::find($request->input('id'));
        $question->delete();
        return back()->with('success','Datasheet deleted successfully.');
    }

}
