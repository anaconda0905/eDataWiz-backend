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
use Illuminate\Support\Facades\Log;
use Mail;
use Sentinel;
use Validator;
use View;
use Storage;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;

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
            
            if($user->verified){
                return response()->json([
                    'success' => true,
                    'data' => $user,
                    'message' => 'User retrieved successfully.',
                ]);
            }
            else{
                return response()->json([
                    'success' => true,
                    'data' => $user,
                    'message' => 'This account hasn not verified yet.',
                ]);
            }
            
        } catch (NotActivatedException $e) {
            return response()->json([
                'success' => false,
                'message' => 'This user is not activated.',
            ]);
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            return response()->json([
                'success' => false,
                'message' => 'You are temporary susspended' . ' ' . $delay . ' seconds',
            ]);
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

            $test = User::where(['email' => $request->input('email')])->first();
            if($test){
                return response()->json([
                    'success' => false,
                    'message' => 'This email is already used.',
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
            $user->verified = 0;
            $user->save();
            $activation = Activation::create($user);
            $activation = Activation::complete($user, $activation->code);
            $user->roles()->sync([2]);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Commercial', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Other', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Customer Service', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Financial', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Material-Store', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Project', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Production-Construction', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Purchasing', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/QA-QC', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/HSE', 0775, true);
            
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/', 0775, true);
            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'User created successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
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
                $message->to($data['email'], $data['name'])
                ->subject('Verify your email address');
            });
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Reset code was sent successfully.',
        ]);
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
            $user->verified = true;
            $user->save();
            $activation = Activation::create($user);
            $activation = Activation::complete($user, $activation->code);
            $user->roles()->sync([2]);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Commercial', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Other', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Customer Service', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Financial', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Material-Store', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Project', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Production-Construction', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/Purchasing', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/QA-QC', 0775, true);
            Storage::disk('s3')->makeDirectory('/files/' . $user->id . '/HSE', 0775, true);
        }
        Sentinel::login($user);
        
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'User retrieved successfully.',
        ]);
    }

    public function sendVerifyAccountCodeEmail(Request $request)
    {
        $user = User::where(['api_token' => $request->input('api_token')])->first();
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
            Mail::send('emails.verifyaccount', $data, function ($message) use($data) {
                $message->to($data['email'], $data['name'])
                ->subject('Verify your account');
            });
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Verification code was sent successfully.',
        ]);
    }

    public function VerifyAccount(Request $request)
    {
        $user = User::where(['api_token' => $request->input('api_token')])->first();
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
        $user->verified = 1;
        $user->save();
        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Account successfully Verified',
        ]);
    }
}