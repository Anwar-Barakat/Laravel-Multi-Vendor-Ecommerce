<?php

namespace App\Http\Controllers\Admin\AdminSetting;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateDetailController extends Controller
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
            $InfoData       = $request->only(['name', 'about_me', 'avatar']);

            $validated = $request->validate([
                'name'          => 'required|min:3|regex:/^[\pL\s\-]+$/u',
                'about_me'      => 'required|min:10',
                'avatar'        => 'required|mimes:png,jpg,jpeg|image|max:2048',
            ]);

            $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();
            $admin->update($InfoData);


            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                $admin->clearMediaCollection('avatars');
                $admin->addMediaFromRequest('avatar')->toMediaCollection('avatars');
            }

            toastr()->success('Admin Details has been updated successfully');
            return redirect()->route('admin.profile');
        }
    }
}