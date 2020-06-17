<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

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
    public function human_filesize($bytes, $decimals = 2)
    {
        $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    /*
     * Converts a filesystem tree to a PHP array.
     */
    public function dir_to_array($dir)
    {
        if (!is_dir($dir)) {
            // If the user supplies a wrong path we inform him.
            return null;
        }

        // Our PHP representation of the filesystem
        // for the supplied directory and its descendant.
        $data = [];

        foreach (new \DirectoryIterator($dir) as $f) {
            if ($f->isDot()) {
                // Dot files like '.' and '..' must be skipped.
                continue;
            }

            $path = $f->getPathname();
            $name = $f->getFilename();
            $path_parts = pathinfo($name);
            $pattern_path = '~[\\\/]files[\\\/][\w\W]+~';

            preg_match_all($pattern_path, $path, $matches);
            $path = 'storage' . implode($matches[0]);
            if ($f->isFile()) {
                $data[] = [
                    'file' => $name,
                    'path' => $path,
                    'filename' => $path_parts['filename'],
                    'type' => $path_parts['extension'],
                    'QRcode' => FilesAPIController::base64url_encode($path),
                    'size' => FilesAPIController::human_filesize(filesize($path)),
                    'actual_size' => filesize($path),
                ];

            } else {
                // Process the content of the directory.
                $files = FilesAPIController::dir_to_array($path);
                if ($name == 'thumbs') {
                    continue;
                }

                $data[] = ['dir' => $files,
                    'name' => $name];
                // A directory has a 'name' attribute
                // to be able to retrieve its name.
                // In case it is not needed, just delete it.
            }
        }

        // Sorts files and directories if they are not on your system.
        \usort($data, function ($a, $b) {
            $aa = isset($a['file']) ? $a['file'] : $a['name'];
            $bb = isset($b['file']) ? $b['file'] : $b['name'];

            return \strcmp($aa, $bb);
        });

        return $data;
    }

    /*
     * Converts a filesystem tree to a JSON representation.
     */
    public function dir_to_json($dir)
    {
        $data = FilesAPIController::dir_to_array($dir);
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Folders and Files are successfully found.',
        ]);
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
        $user_path = storage_path() . '\\app\\public\\files';

        if ($user->roles()->first()->id == 2) {
            $user_path = $user_path . '\\' . $user->id;
        }
        return FilesAPIController::dir_to_json($user_path);
    }
    public function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}
