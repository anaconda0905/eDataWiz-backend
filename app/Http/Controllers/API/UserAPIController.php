<?php

namespace App\Http\Controllers\API;

use Activation;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Response;
use Mail;
use Sentinel;
use Validator;

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

    public function login(Request $request)
    {
        try {
            // Validation
            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validation->fails()) {
                // return response()->json($validation->errors(), 422);
                return response()->json([
                    'success' => false,
                    'data' => $validation->errors(),
                    'message' => 'The given data was invalid.',
                ]);
            }
            $user = Sentinel::authenticate($request->all(), true);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Either email or password is incorrect.',
                ]);
            }
            $user->api_token = str_random(60);
            $user->save();

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User retrieved successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json($e, 401);
        }
    }

    public function changepassword(Request $request)
    {
        $user = User::where(['api_token' => $request->input('api_token')])->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ]);
        }
        $data["email"] = $user->email;
        $data["password"] = $request->input('old_password');
        $user1 = Sentinel::authenticate($data, true);
        if (!$user1) {
            return response()->json([
                'success' => false,
                'message' => "Old password doesn't match.",
            ]);
        }
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully.',
        ]);
    }

    public function logout(Request $request)
    {
        $user = User::where(['api_token' => $request->input('api_token')])->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ]);
        }

        try {
            Sentinel::logout();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
        $user->api_token = str_random(60);
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user->email,
            'message' => 'User logout successfully.',
        ]);
    }

    public function register(Request $request)
    {
        try {
            // Validation
            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validation->fails()) {
                // return response()->json($validation->errors(), 422);
                return response()->json([
                    'success' => false,
                    'data' => $validation->errors(),
                    'message' => 'The given data was invalid.',
                ]);
            }

            $user = new User;
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->company = $request->input('company');
            $user->phone = $request->input('phone');
            $user->api_token = str_random(60);

            $user->save();
            $activation = Activation::create($user);
            $activation = Activation::complete($user, $activation->code);
            $user->roles()->sync([2]);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User created successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json($e, 401);
        }
    }
    
    public function verifyCode(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validation->errors(),
                'message' => 'The given data was invalid.',
            ]);
        }
        $user = User::where(['email' => $request->input('email')])->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ]);
        }
        if(Hash::check($request->input('code'), $user->device_token) == false){
            return response()->json([
                'success' => false,
                'message' => 'Invalid code',
            ]);
        }
        $user->remember_token = str_random(60);
        $user->save();
        return response()->json([
            'success' => true,
            'remember_token' => $user->remember_token,
            'message' => 'verfied',
        ]);
    }

    public function resetpassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validation->errors(),
                'message' => 'The given data was invalid.',
            ]);
        }
        $user = User::where(['email' => $request->input('email')])->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ]);
        }
        if( $request->input('remember_token') != $user->remember_token){
            return response()->json([
                'success' => false,
                'message' => 'Sorry. Try again. Token is invalid',
            ]);
        }
        $user->password = Hash::make($request->input('new_password'));
        $user->remember_token=str_random(60);
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully',
        ]);
    }

    public function sendResetCodeEmail(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => $validation->errors(),
                'message' => 'The given data was invalid.',
            ]);
        }
        $user = User::where(['email' => $request->input('email')])->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ]);
        }
        $token = rand(100000, 999999);
        $user->device_token = Hash::make($token);
        $user->save();
        $data = array(
            'code' => $token,
            'name' => $user->first_name.' '.$user->last_name, 
            'email'=> $user->email);
        try{
            Mail::send('emails.welcome', $data, function ($message) use($data) {
                $message->to($data['email'], $data['name'])->subject
                    ('Verify your email address');
                $message->from('support@edatawiz.com', 'eDataWiz');
            });
            return response()->json([
                'success' => true,
                'message' => 'Reset code was sent successfully.',
            ]);
        }
        catch (\Exception $e) {
            return response()->json($e, 401);
        }
    }

    public function socialLogin($social, Request $request)
    {

        $user = User::where(['email' => $request->input('email')])->first();

        if (!$user) {
            $user = new User;
            $fullname = explode(" ", $request->input('name'));
            if (count($fullname) == 2) {
                $user->first_name = $fullname[0];
                $user->last_name = $fullname[1];
            } else {
                $user->first_name = $fullname[0];
                $user->last_name = $fullname[0];
            }
            $user->email = $request->input('email');
            $user->password = bcrypt(str_random());
            $user->api_token = str_random(60);
            $user->save();
            $activation = Activation::create($user);
            $activation = Activation::complete($user, $activation->code);
            $user->roles()->sync([2]);
        }
        Sentinel::login($user);
        $user->api_token = str_random(60);
        $user->save();
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User retrieved successfully.',
        ]);
    }
}
