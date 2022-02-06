<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $uri = $request->path();
        $uri = explode("/", $uri);
        if ($uri[0] == 'employee') {
            return $next($request);
        }
        // admin dashboard
        if ($request->user()->role == 'admin') {
            if ($uri[0] == 'admin') {
                return $next($request);
            } else {
                return redirect('admin/home');
            }
        }
        // super admin dashboard
        elseif ($request->user()->role == 'super_admin') {
            if ($uri[0] == 'super-admin') {
                return $next($request);
            } else {
                return redirect('super-admin/home');
            }
        }
        // patient dashboard
        elseif ($request->user()->role == 'patient') {
            if ($uri[0] == 'patient') {
                return $next($request);
            } else {
                return redirect('patient/home');
            }
        }
        // consultant dashboard
        elseif ($request->user()->role == 'compounder') {
            if ($uri[0] == 'coordinator') {
                return $next($request);
            } else {
                return redirect('coordinator/home');
            }
        } elseif ($request->user()->role == 'therapist') {
            if ($uri[0] == 'therapist') {
                return $next($request);
            } else {
                return redirect('therapist/home');
            }
        } elseif ($request->user()->role == 'accountant') {
            if ($uri[0] == 'accountant') {
                return $next($request);
            } else {
                return redirect('accountant/home');
            }
        }

        // doctor dashboard
        elseif ($request->user()->role == 'doctor') {
            if ($uri[0] == 'doctor') {
                return $next($request);
            } else {
                return redirect('doctor/home');
            }
        }
        // employee dashboard
        elseif ($request->user()->role == 'employee') {
            if ($uri[0] == 'employee') {
                return $next($request);
            } else {
                return redirect('employee/home');
            }
        } else {
            return redirect('/login')->with('error', "Please login first.");
        }
    }
}
