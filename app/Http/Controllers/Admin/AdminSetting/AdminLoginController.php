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

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                toastr()->success("Welcome Back !! ");
                return redirect()->route('admin.dashboard');
            } else {
                toastr()->error('Email or Password is Invalid');
                return redirect()->back();
            }
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login.form');
    }
}