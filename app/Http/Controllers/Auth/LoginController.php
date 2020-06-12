<?php

namespace App\Http\Controllers\Auth;

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

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use  ThrottlesLogins;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }


    protected function login(Request $request)
    {
        try {
            // Validation
            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validation->fails()) {
                return Redirect::back()->withErrors($validation)->withInput();
            }
            $remember = (Input::get('remember') == 'on') ? true : false;
            if ($user = Sentinel::authenticate($request->all(), $remember)) {

                return redirect('dashboard');
            }
            return Redirect::back()->withErrors(['global' => 'Invalid password or this user does not exist']);
        } catch (NotActivatedException $e) {
            return Redirect::back()->withErrors(['global' => 'This user is not activated', 'activate_contact' => 1]);
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            return Redirect::back()->withErrors(['global' => 'You are temporary susspended' . ' ' . $delay . ' seconds', 'activate_contact' => 1]);
        }

        return Redirect::back()->withErrors(['global' => 'Login problem please contact the administrator']);
    }

    /**
     * Handle Social login request
     *
     * @return response
     */
    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    /**
     * Obtain the user information from Social Logged in.
     * @param $social
     * @return Response
     */
    public function handleProviderCallback($social, Request $request)
    {
        if (!$request->has('code')) {
            return redirect('/');
        }
        $userSocial = Socialite::driver($social)->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        if (!$user) {
            $user = new User;
            $user->first_name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt(str_random());
            $user->api_token = str_random(60);
            $user->save();
            $activation = Activation::create($user);
            $activation = Activation::complete($user, $activation->code);
            $user->roles()->sync([2]);
        }

        Sentinel::login($user);
        return redirect('/dashboard');
    }

    protected function logout()
    {
        Sentinel::logout();
        return redirect('/');
    }
    protected function activate($id)
    {
        $user = Sentinel::findById($id);

        $activation = Activation::create($user);
        $activation = Activation::complete($user, $activation->code);
        Session::flash('message', trans('messages.activation'));
        Session::flash('status', 'success');
        return redirect('login');
    }
}
