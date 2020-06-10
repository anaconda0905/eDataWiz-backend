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
use Redirect;
use Session;
use Illuminate\Support\Facades\Input;
use Mail;
use Carbon\Carbon;
use Mailchimp;
use App\ZipCode;
use Socialite;
use Activation;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;

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

    function register(Request $request)
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

            $user = new User;
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->email = $request->input('email');
            $user->company = $request->input('company');
            $user->phone = $request->input('phone');

            $user->api_token = str_random(60);
            
            $user->save();
            $activation = Activation::create($user);
            $activation = Activation::complete($user, $activation->code);
            $user->roles()->sync([2]);
            
            return response()->json([
                'success' => true,
                'data'    => $user,
                'message' => 'User created successfully.'
            ]);
     
        } catch (\Exception $e) {
            return response()->json($e, 401);
        }
    }

}
