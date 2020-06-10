<?php

namespace App\Http\Controllers\API;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Sentinel;
use Illuminate\Http\Request;
use Activation;
use Redirect;
use Session;
use Illuminate\Support\Facades\Input;
use Mail;
use Carbon\Carbon;
use Mailchimp;
use App\ZipCode;
use Socialite;
use Illuminate\Support\Facades\Response;

class UserAPIController extends Controller
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

    function login(Request $request)
    {
        try {
            // Validation
            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);
            
            if ($validation->fails()) {
                // return response()->json($validation->errors(), 422);
                return response()->json([
                    'success' => false,
                    'data'    => $validation->errors(),
                    'message' => 'The given data was invalid.'
                ]);
            }
            $user = Sentinel::authenticate($request->all(), true);
            $user->device_token = $request->input('device_token', '');
            $user->save();
            return response()->json([
                'success' => true,
                'data'    => $user,
                'message' => 'User retrieved successfully.'
            ]);
     
        } catch (\Exception $e) {
            return response()->json($e, 401);
        }
    }
}
