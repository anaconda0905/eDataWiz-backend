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
use Storage;
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
                if($user->verified){
                    return redirect('dashboard');
                }
                else{
                    $token = $user->api_token;
                    return redirect()->route('verify', ['token'=>$token]);
                }
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
            $fullname = explode(" ", $userSocial->name);
            if(count($fullname) == 2){
                $user->first_name = $fullname[0];
                $user->last_name = $fullname[1];
            }
            else{
                $user->first_name = $fullname[0];
                $user->last_name = $fullname[0];
            }
            $user->email = $userSocial->email;
            $user->password = bcrypt(str_random());
            $user->api_token = str_random(60);
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
        return redirect('/dashboard');
    }

    protected function logout()
    {
        $user=Sentinel::getUser();
        $user->api_token = str_random(60);
        $user->save();
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
