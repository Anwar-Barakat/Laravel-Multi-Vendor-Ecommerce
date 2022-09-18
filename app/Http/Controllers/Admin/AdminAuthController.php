<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
