<?php

namespace App\Http\Controllers\Admin\AdminSetting;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->isMethod('put')) {
            $passwordData   = $request->only(['old_password', 'password', 'confirmation_password']);
            if (Hash::check($passwordData['old_password'], Auth::guard('admin')->user()->password)) {

                $validated = $request->validate([
                    'password'                  => 'required|min:8',
                    'confirmation_password'     => 'required|min:8|same:password'
                ]);

                Admin::where('id', Auth::guard('admin')->user()->id)->update([
                    'password' => Hash::make($passwordData['password'])
                ]);
                toastr()->success('Password has been updated successfully');
                return redirect()->route('admin.profile');
            } else
                toastr()->error('Current Password Is not True !!');
        }
    }
}