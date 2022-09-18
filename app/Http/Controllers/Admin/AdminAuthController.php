<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
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

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                return redirect()->route('admin.dashboard');
            } else {

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