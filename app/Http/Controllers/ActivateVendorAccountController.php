<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ActivateVendorAccountController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($email)
    {
        $email      = base64_decode($email);

        $is_exists  = Vendor::where('email', $email)->count();

        if ($is_exists > 0) :
            $vendorDetails  = Vendor::where('email', $email)->first();

            if ($vendorDetails->status == '1') {
                toastr()->info('Your Vendor Account Is Already Activated Before, You Can Login');
                return redirect()->route('vendor.login.form');
            } else {
                $vendorDetails->update(['status' => '1']);
                Admin::where('email', $email)->update(['status' => '1']);
                toastr()->success('Your Vendor Account Is Activated, You Can Login Now.');
                return redirect()->route('vendor.login.form');
            }
        else :
            abort('404');
        endif;
    }
}