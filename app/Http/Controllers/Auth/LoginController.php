<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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

    protected function redirectTo()
    {
        // redirect to admin dashboard
        if (auth()->user()->role == 'admin') {
            return '/admin/home';
        }
        // redirect to super admin dashboard
        elseif (auth()->user()->role == 'super_admin') {
            return '/super-admin/home';
        }
        // redirect to patient dashboard
        elseif (auth()->user()->role == 'patient') {
            return '/patient/home';
        }
        // redirect to doctor dashboard
        elseif (auth()->user()->role == 'doctor') {
            return '/doctor/home';
        }
        // redirect to consultant dashboard
        elseif (auth()->user()->role == 'compounder') {
            return '/coordinator/home';
        } elseif (auth()->user()->role == 'accountant') {
            return '/accountant/home';
        }
        // redirect to therapist dashboard
        elseif (auth()->user()->role == 'therapist') {
            return '/therapist/home';
        } else {
            return '/login';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
