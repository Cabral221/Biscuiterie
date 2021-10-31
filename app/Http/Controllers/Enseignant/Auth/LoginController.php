<?php

namespace App\Http\Controllers\Enseignant\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('enseignant.auth.login');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool|null
     */
    public function attemptLogin(Request $request) : ?bool
    {
        $user = User::where($this->username(), $request->email)->first();
        if($user == null) return null;

        if($user->classe === null){
            $this->sendFailedLoginResponseByActivate();
        }
        
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the failed login response instance.
     *
     * @return  void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponseByActivate() : void
    {
        throw ValidationException::withMessages([
            $this->username() => 'Vous ne disposez pas de classe pour vous connecter !',
        ]);
    }
}
