<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users  = User::all();
        return response()->json(['users' => $users]);
    }

    public function create(Request $request)
    {
        $rules =  [
            'name'      => ['required', 'max:255', 'min:2'],
            'email'     => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'  => ['required', 'min:8'],
        ];


        if ($request->isMethod('post')) {
            $data   = $request->only(['name', 'email', 'password']);
            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return $validator->errors();
            } else {
                User::create($data);
                return response()->json(['message' => 'Users Have Been Added Successfully']);
            }

            $data['password'] = bcrypt($request->password);
            User::create($data);
            return response()->json(['message' => 'User Has Been Added Successfully']);
        }
    }

    public function show($id)
    {
        $user   = User::findOrFail($id);
        return response()->json(['user' => $user]);
    }
}