<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
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
                'dir' => [],
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
                'file' => $name,
                'name' => $path_parts['filename'],
                'type' => $path_parts['extension'],
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
}
