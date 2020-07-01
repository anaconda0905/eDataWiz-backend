<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        $path = $path . $request->input('path');

        try{
            
            // Our PHP representation of the filesystem
            // for the supplied directory and its descendant.
            $data = [];
            $pattern = "~[^\/]+$~";
            $direcotires = Storage::disk('s3')->directories($path);
            $files = Storage::disk('s3')->files($path);
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
            
            if (!$data) {
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
}
