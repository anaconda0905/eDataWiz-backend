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
use App\DPdList;
use File;
use Session;
use Validator;
use Sentinel;
use Route;
use Storage;
use App\User;
use Exception;

class QuestionController extends Controller
{
    protected function validator(Request $request, $id = '')
    {
        return Validator::make($request->all(), [
            'general' => 'required',
            'classification' => 'required',
            'header' => 'required',
            'fileselect' => 'required',
        ]);
    }

    public function index()
    {
        $questions = Question::with('general','classification','header','pdList','dpdList','brand')->latest()->get();
        return view('backEnd.question.index',compact('questions'));
    }
    public function create()
    {
        $generals = General::all();
        $classifications = Classification::all();
        $headers = Header::all();
        $pdLists = PdList::all();
        $dpdLists = DPdList::all();
        $brands = Brand::all();
        return view('backEnd.question.create', compact('generals','classifications','headers','pdLists','dpdLists','brands'));
    }
    public function store(Request $request)
    {
        if ($this->validator($request, Sentinel::getUser()->id)->fails()) {
            return redirect()->back()
                ->withErrors($this->validator($request))
                ->withInput();
        }
        try{
            $file = $request->file('fileselect');
            $fileName = Sentinel::getUser()->id . '_' . time() . '_' . $file->getClientOriginalName();
            $path = "PDF/".$fileName;
            $f = Storage::disk('s31')->put($path, file_get_contents($file), 'public');
            $absolute_path = Storage::disk('s31')->url($path);
            $filedate = Storage::disk('s31')->lastModified($path);

            $question = new Question();
            $question->pd_general = $request->general;
            $question->pd_classification = $request->classification;
            $question->pd_header = $request->header;
            $question->pd_list = $request->list;
            $question->dpd_list = $request->dlist;
            $question->pd_brand = $request->brand;
            $question->filename = $file->getClientOriginalName();
            $question->filetype = $file->getMimeType();
            $question->filepath = $absolute_path;
            $question->filesize = $file->getSize();
            $question->filedate = $filedate;

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
        $dpdLists = DPdList::all();
        $brands = Brand::all();
        return view('backEnd.question.edit', compact('generals','classifications','headers','pdLists','dpdLists','brands','question'));
    }

    public function updateQuestion(Request $request)
    {
        try{
            $question = Question::find($request->id);

            $question->pd_general = $request->general;
            $question->pd_classification = $request->classification;
            $question->pd_header = $request->header;
            $question->pd_list = $request->list;
            $question->dpd_list = $request->dlist;
            $question->pd_brand = $request->brand;
            
            if ($request->hasFile('fileselect')) {
                $file = $request->file('fileselect');
                $fileName = Sentinel::getUser()->id . '_' . time() . '_' . $file->getClientOriginalName();
                $path = "PDF/".$fileName;
                $f = Storage::disk('s31')->put($path, file_get_contents($file), 'public');
                $absolute_path = Storage::disk('s31')->url($path);
                $filedate = Storage::disk('s31')->lastModified($path);

                $question->filename = $file->getClientOriginalName();
                $question->filetype = $file->getMimeType();
                $question->filepath = $absolute_path;
                $question->filesize = $file->getSize();
                $question->filedate = $filedate;
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

    public function searchProduct(Request $request)
    {
        $pd_general_id = $request["pd_general"];
        $pd_classification_id = $request["pd_classification"];
        $pd_header_id = $request["pd_header"];
        $pd_pdlist_id = $request["pd_list"];
        $dpd_pdlist_id = $request["dpd_list"];
        $pd_brand_id = $request["pd_brand"];
        if(!$pd_pdlist_id)
            $questions = Question::where('pd_general', $pd_general_id)->where('pd_classification', $pd_classification_id)->where('pd_header', $pd_header_id)->get();
        else if(!$dpd_pdlist_id)
            $questions = Question::where('pd_general', $pd_general_id)->where('pd_classification', $pd_classification_id)->where('pd_header', $pd_header_id)->where('pd_list', $pd_pdlist_id)->get();
        else if(!$pd_brand_id)
            $questions = Question::where('pd_general', $pd_general_id)->where('pd_classification', $pd_classification_id)->where('pd_header', $pd_header_id)->where('pd_list', $pd_pdlist_id)->where('dpd_list', $dpd_pdlist_id)->get();
        else
            $questions = Question::where('pd_general', $pd_general_id)->where('pd_classification', $pd_classification_id)->where('pd_header', $pd_header_id)->where('pd_list', $pd_pdlist_id)->where('dpd_list', $dpd_pdlist_id)->where('pd_brand', $pd_brand_id)->get();
        
        $html = View('backEnd.categories.table', compact('questions'))->render();
        
        if($questions){
            return response()->json(compact('html'));
        }else{
            return response()->json([
                'status' => 'false',
                'message' => 'There is no results.' 
            ]);
        }
    }
}
