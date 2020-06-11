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
use Illuminate\Support\Facades\Password;

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
            if(!$user){
                return response()->json([
                    'success' => false,
                    'message' => 'User does not exist.'
                ]);
            }
            $user->api_token = str_random(60);
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

    function logout(Request $request)
    {
        
        $user = User::where(['api_token' => $request->input('api_token')])->first();
        

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ]);
        }

        try {
            Sentinel::logout();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ]);
        }
        $user->api_token = '';
        $user->save();
        return response()->json([
            'success' => true,
            'data'    => $user->email,
            'message' => 'User logout successfully.'
        ]);
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

    function sendResetLinkEmail(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        $response = Password::broker()->sendResetLink(
            $request->only('email')
        );

        if ($response == Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => 'Reset link was sent successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Reset link not sent.'
            ]);
        }
    }

    function socialLogin($social)
    {
        try{
            $url = Socialite::driver($social)->stateless()->redirect()->getTargetUrl();
            
            return response()->json([
                'success' => true,
                'data'    => $url,
                'message' => 'Social login successfully redirected.'
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }
    public function handleProviderCallback($social, Request $request)
    {
        $userSocial = Socialite::driver($social)->stateless()->user();
        // $user = User::where(['email' => $userSocial->getEmail()])->first();
        // if(!$user){
        //     $user = new User;
        //     $user->first_name = $userSocial->name;
        //     $user->email = $userSocial->email;
        //     $user->password = bcrypt(str_random());
        //     $user->api_token = str_random(60);
        //     $user->save();
        //     $activation = Activation::create($user);
        //     $activation = Activation::complete($user, $activation->code);
        //     $user->roles()->sync([2]);
        // }
        return response()->json([
            'success' => true,
            'data'    => $request->has('code'),
            'message' => 'User retrieved successfully.'
        ]);
    }
}
