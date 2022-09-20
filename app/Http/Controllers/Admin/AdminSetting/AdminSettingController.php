<?php

namespace App\Http\Controllers\Admin\AdminSetting;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return view('admin.profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        if ($request->isMethod('put')) {

            if ($request->has('old_password') && $request->has('password')) {
                // Update Password :
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
                } else
                    toastr()->error('Current Password Is not True !!');


                // Update Details :
            } else {
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
            }
            return redirect()->route('admin.admin-setting.show', 'test');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}