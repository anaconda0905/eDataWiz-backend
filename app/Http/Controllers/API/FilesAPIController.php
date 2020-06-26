<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\Category;
use App\SubCategory;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
class FilesAPIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*
     * Converts a filesystem tree to a PHP array.
     */
    public function dir_to_array($dir)
    {
        
        if (!Storage::disk('s3')->has($dir)) {
            // If the user supplies a wrong path we inform him.
            return 0;
        }
        
        // Our PHP representation of the filesystem
        // for the supplied directory and its descendant.
        $data = [];
        $pattern = "~[^\/]+$~";
        $direcotires = Storage::disk('s3')->directories($dir);
        $files = Storage::disk('s3')->files($dir);
        foreach ($direcotires as $d) {
            preg_match_all($pattern, $d, $matches);
            $name = implode($matches[0]);
            if ($name == 'thumbs') {
                continue;
            }
            $data[] = [
                'type' => 'dir',
                'name' => $name
            ];
        }
        foreach ($files as $f) {
            preg_match_all($pattern, $f, $matches);
            $name = implode($matches[0]);
            $path_parts = pathinfo($name);
            $absolute_path = Storage::disk('s3')->url($f);
            $file_size = Storage::disk('s3')->size($f);
            $file_date = Storage::disk('s3')->lastModified($f);
            
            $data[] = [
                'type' => 'file',
                'file' => $name,
                'name' => $path_parts['filename'],
                'ext' => $path_parts['extension'],
                'link' => $absolute_path,
                'modified_at' => $file_date,
                'size' => $file_size,
            ];
        }
        return $data;
    }

    /*
     * Converts a filesystem tree to a JSON representation.
     */
    public function dir_to_json($dir)
    {
        try{
            $data = FilesAPIController::dir_to_array($dir);
            if ($data == 0) {
                return response()->json([
                    'success' => false,
                    'data'    => null,
                    'message' => 'Url is incorrect.',
                ]);
            }
            elseif (!$data) {
                return response()->json([
                    'success' => true,
                    'data'    => $data,
                    'message' => 'Folder is Empty',
                ]);
            }
            return response()->json([
                'success' => true,
                'data'    => $data,
                'message' => 'Folders and Files are successfully found.',
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
            ]);
        }
    }
    public function getList(Request $request)
    {
        $user = User::where(['api_token' => $request->input('api_token')])->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ]);
        }
        $path = "files/";
        if ($user->roles()->first()->id == 2) {
            $path = $path . $user->id;
        }
        $path = $path .$request->input('path');
        return FilesAPIController::dir_to_json($path);
    }

    public function getListModule1(Request $request)
    {
        $user = User::where(['api_token' => $request->input('api_token')])->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission.',
            ]);
        }
        $products = Product::all();
        $data = array();
        $request_categories = json_decode($request->categories);
        try{
            foreach ($products as $product) {
                $product_categories = json_decode($product->categories);
                $flag = true;
                foreach ($request_categories as $request_category_key => $value) {
                    if($value == 0) 
                    {
                        $flag = true;
                        continue;
                    }
                    if($product_categories->$request_category_key != $value){
                        $flag = false;
                        break;
                    } 
                }
                if($flag) 
                    array_push($data, $product);    
            }
            
            return response()->json([
                'success' => true,
                'data'    => $data,
                'message' => 'All products retrieved successfully.',
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function getCategories(Request $request)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $data = array();
        foreach ($categories as $category) {
            $subitem = array();
            foreach($subcategories as $subcategory)
            {
                if($category->id == $subcategory->category){
                    array_push($subitem, $subcategory);
                }
            }
            $category->subcategory = $subitem;
        }
        return response()->json([
            'success' => true,
            'data'    => $categories,
            'message' => 'All categories retrieved successfully.',
        ]);
    }
}
