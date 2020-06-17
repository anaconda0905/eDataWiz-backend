<?php

namespace App\Http\Controllers\Auth;

use Activation;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Sentinel;
use Session;
use Storage;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validation->fails()) {
            return Redirect::back()->withErrors($validation)->withInput();
        }

        $user = Sentinel::register($request->all());
        $user->api_token = str_random(60);
        $user->phone = $request['phone'];
        $user->company = $request['company'];
        $user->save();

        //Activate the user **
        $activation = Activation::create($user);
        $activation = Activation::complete($user, $activation->code);
        //End activation
        Storage::makeDirectory('public/files/' . $user->id, 444, true);
        Storage::makeDirectory('public/files/' . $user->id . '/Commercial', 0775, true);
        Storage::makeDirectory('public/files/' . $user->id . '/etc', 0775, true);
        Storage::makeDirectory('public/files/' . $user->id . '/Customer Service', 0775, true);
        Storage::makeDirectory('public/files/' . $user->id . '/Financial', 0775, true);
        Storage::makeDirectory('public/files/' . $user->id . '/Material-Store', 0775, true);
        Storage::makeDirectory('public/files/' . $user->id . '/Project', 0775, true);
        Storage::makeDirectory('public/files/' . $user->id . '/Production-Construction', 0775, true);
        Storage::makeDirectory('public/files/' . $user->id . '/Purchasing', 0775, true);
        Storage::makeDirectory('public/files/' . $user->id . '/QA-QC', 0775, true);
        Storage::makeDirectory('public/files/' . $user->id . '/HSE', 0775, true);
        if ($user) {
            $user->roles()->sync([2]); // 2 = client
            Session::flash('message', 'Registration is completed');
            Session::flash('status', 'success');
            return redirect('/dashboard');
        }
        Session::flash('message', 'There was an error with the registration');
        Session::flash('status', 'error');
        return Redirect::back();
    }
}
