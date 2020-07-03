<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;
use App\Classification;
use App\General;
use App\Header;
use App\PdList;
use App\DPdList;
use App\Question;
use Exception;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $generals = General::all();
        $classifications = Classification::all();
        $headers = Header::all();
        $pdLists = PdList::all();
        $dpdLists = DPdList::all();
        $brands = Brand::all();
        $questions = [];
        return view('backEnd.categories.index',compact('generals','classifications','headers','pdLists','dpdLists','brands','questions'));
    }
    public function createGeneral(Request $request){
        try{
            $general = new General();
            $general->pd_general = $request->input('general');
            $general->save();
            return response()->json(['general'=>$general]);
        }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function editGeneral(Request $request){
        try{
            $general = General::find($request->input('id'));
            $general->pd_general = $request->input('general');
            $general->save();
            return response()->json(['general'=>$general]);
         }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function deleteGeneral(Request $request){
        try{
            $general = General::find($request->input('id'));
            $general->delete();
            return response()->json(['general'=>$general]);
        }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function createClassification(Request $request){
        try{
            $classification = new Classification();
            $classification->pd_general_id = $request->input('general');
            $classification->pd_classification = $request->input('classification');
            $classification->save();
            return response()->json(['classification'=>$classification]);
        }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }   
    }
    public function editClassification(Request $request){
        try{
            $classification =  Classification::find($request->input('id'));
            $classification->pd_classification = $request->input('classification');
            $classification->save();
            return response()->json(['classification'=>$classification]);
        }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function deleteClassification(Request $request){
        $classification =  Classification::find($request->input('id'));
        $classification->delete();
        return response()->json(['classification'=>$classification]);;
    }
    public function createHeader(Request $request){
        try{
            $header = new Header();
            $header->pd_classification_id = $request->input('classification');
            $header->pd_header = $request->input('header');
            $header->save();
            return response()->json(['header'=>$header]);
        }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function editHeader(Request $request){
        try{
            $header = Header::find($request->input('id'));
            $header->pd_header = $request->input('header');
            $header->save();
            return response()->json(['header'=>$header]);
        }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function deleteHeader(Request $request){
        $header = Header::find($request->input('id'));
        $header->delete();
        return response()->json(['header'=>$header]);
    }

    public function createList(Request $request){
        try{
            $list = new PdList();
            $list->pd_header_id = $request->input('header');
            $list->pd_list = $request->input('list');
            $list->save();
            return response()->json(['list'=>$list]);
        }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function editList(Request $request){
        try{
            $list = PdList::find($request->input('id'));
            $list->pd_list = $request->input('list');
            $list->save();
            return response()->json(['list'=>$list]);
        }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function deleteList(Request $request){
        $list = PdList::find($request->input('id'));
        $list->delete();
        return response()->json(['list'=>$list]);
    }

    public function createDList(Request $request){
        try{
            $dlist = new DPdList();
            $dlist->pd_lists_id = $request->input('list');
            $dlist->dpd_list = $request->input('dlist');
            $dlist->save();
            return response()->json(['dlist'=>$dlist]);
        }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function editDList(Request $request){
        try{
            $dlist = DPdList::find($request->input('id'));
            $dlist->dpd_list = $request->input('dlist');
            $dlist->save();
            return response()->json(['dlist'=>$dlist]);
        }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function deleteDList(Request $request){
        $dlist = DPdList::find($request->input('id'));
        $dlist->delete();
        return response()->json(['dlist'=>$dlist]);
    }

    public function createBrand(Request $request){
        try{
            $brand = new Brand();
            $brand->dpd_list_id = $request->input('dlist');
            $brand->pd_brand = $request->input('brand');
            $brand->save();
            return response()->json(['brand'=>$brand]);
        }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }

    public function editBrand(Request $request){
        try{
            $brand = Brand::find($request->input('id'));
            $brand->pd_brand = $request->input('brand');
            $brand->save();
            return response()->json(['brand'=>$brand]);
        }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function deleteBrand(Request $request){
        $brand = Brand::find($request->input('id'));
        $brand->delete();
        return response()->json(['brand'=>$brand]);
    }
    //Backend...............
    public function getGeneral()
    {
        try{
            $generals = General::all();
            $classifications = Classification::all();
            $headers = Header::all();
            $pdLists = PdList::all();
            $dpdLists = DPdList::all();
            $brands = Brand::all();
            if($generals){
                return response()->json([
                 'status' => 'true',
                 'data' => $generals,
                 'data1' => $classifications,
                 'data2' => $headers,
                 'data3' => $pdLists,
                 'data4' => $dpdLists,
                 'data5' => $brands,
                 ]);
            }else{
                return response()->json([
                 'status' => 'false',
                 'message' => 'There is no results.' ]);
            }
        }catch (Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
        
    }
   
    public function getClassification(Request $request)
    {
        $id = $request["id"];
        $classfication = Classification::where('pd_general_id', $id)->get();
        if($classfication){
            return response()->json([
             'status' => 'true',
             'message' => 'There are results.',
             'data' => $classfication 
            ]);
        }else{
            return response()->json([
             'status' => 'false',
             'message' => 'There is no results.' ]);
        }
        
    }
    public function getHeader(Request $request)
    {
        $id = $request["id"];
        $classfication = Header::where('pd_classification_id', $id)->get();
        if($classfication){
            return response()->json([
             'status' => 'true',
             'message' => 'There are results.',
             'data' => $classfication 
            ]);
        }else{
            return response()->json([
             'status' => 'false',
             'message' => 'There is no results.' ]);
        }
        
    }
    public function getPdList(Request $request)
    {
        $id = $request["id"];
        $classfication = PdList::where('pd_header_id', $id)->get();
        if($classfication){
            return response()->json([
             'status' => 'true',
             'message' => 'There are results.',
             'data' => $classfication 
            ]);
        }else{
            return response()->json([
             'status' => 'false',
             'message' => 'There is no results.' ]);
        }
    }
    public function getDPdList(Request $request)
    {
        $id = $request["id"];
        $classfication = DPdList::where('pd_lists_id', $id)->get();
        if($classfication){
            return response()->json([
             'status' => 'true',
             'message' => 'There are results.',
             'data' => $classfication 
            ]);
        }else{
            return response()->json([
             'status' => 'false',
             'message' => 'There is no results.' ]);
        }
    }

    public function getBrandList(Request $request)
    {
        $id = $request["id"];
        $classfication = Brand::where('dpd_list_id', $id)->get();
        if($classfication){
            return response()->json([
             'status' => 'true',
             'message' => 'There are results.',
             'data' => $classfication 
            ]);
        }else{
            return response()->json([
             'status' => 'false',
             'message' => 'There is no results.' ]);
        }
    }

    public function getProduct(Request $request)
    {
        $pd_general_id = $request["pd_general"];
        $pd_classification_id = $request["pd_classification"];
        $pd_header_id = $request["pd_header"];
        $pd_pdlist_id = $request["pd_list"];
        $dpd_pdlist_id = $request["dpd_list"];
        $pd_brand_id = $request["pd_brand"];
        $classfication = Question::where('pd_general', $pd_general_id)->where('pd_classification', $pd_classification_id)->where('pd_header', $pd_header_id)->where('pd_list', $pd_pdlist_id)->where('dpd_list', $dpd_pdlist_id)->where('pd_brand', $pd_brand_id)->get();
        if($classfication){
            return response()->json([
             'status' => 'true',
             'message' => 'There are results.',
             'data' => $classfication
            ]);
        }else{
            return response()->json([
             'status' => 'false',
             'message' => 'There is no results.' ]);
        }
    }
}
