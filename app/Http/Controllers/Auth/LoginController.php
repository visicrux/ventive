<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use View;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller {
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /**
     * View of login page
     * @return type
     * @author Vijay Vyas <vijayvyas365@gmail.com>
     */
    public function login() {
        return view("Admin::login");
    }

    /**
     * check authentication
     * @param \App\Http\Controllers\Auth\Request $request
     * @return type
     * @author Vijay Vyas <vijayvyas365@gmail.com>
     */
    public function handleLogin(Request $request) {
        $email = $request->input("email");
            $password = $request->input("password");
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return Redirect::route("product.index");
            }

            return redirect('login')
                            ->withInput()
                            ->withErrors(['email' => "Invalid Email Id/Password"]);
        
        try {
            
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('error_message', "Oops! Something went wrong. Please contact to administrator.");
            return redirect('login');
        } catch (\Exception $ex) {
            Session::flash('error_message', "Oops! Something went wrong. Please contact to administrator.");
            return redirect('login');
        }
    }

    /**
     * Logout 
     * @return type
     * @author Vijay Vyas <vijayvyas365@gmail.com>
     */
    public function logout() {
        Auth::logout();
        Session::flush();
        Session::flash('flash_message', "You have successfully logged out");
        return redirect('login');
    }

}
