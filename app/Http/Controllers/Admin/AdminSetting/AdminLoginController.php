<?php

namespace App\Http\Controllers\Admin\AdminSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }


    public function loginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data   = $request->only(['email', 'password']);

            $validated = $request->validate([
                'email'     => 'required|email|max:255',
                'password'  => 'required|min:8'
            ]);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) :

                if (Auth::guard('admin')->user()->type == 'vendor') :

                    if (Auth::guard('admin')->user()->status == 0) :
                        toastr()->warning("Your Vendor Account Must Be Active To Login, Please Check Your Email");
                        return redirect()->back();
                    else :
                        toastr()->success("Welcome Back in Vendor Dashboard");
                        return redirect()->route('admin.dashboard');
                    endif;

                elseif (Auth::guard('admin')->user()->type == 'admin' || Auth::guard('admin')->user()->type == 'super-admin') :
                    toastr()->success("Welcome Back in Admin Dashboard");
                    return redirect()->route('admin.dashboard');
                else :
                    return redirect()->back();
                endif;
            else :
                toastr()->error('Email or Password is Invalid');
                return redirect()->back();
            endif;
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login.form');
    }
}
