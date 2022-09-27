<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\UpdateVendorBankRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateVendorBankController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateVendorBankRequest $request)
    {
        try {
            if ($request->isMethod('put')) {
                $data = $request->only(['account_holder_name', 'bank_name', 'account_number', 'bank_ifsc_code']);

                $admin          = Admin::where('id', Auth::guard('admin')->user()->id)->first();
                $vendorBank     = $admin->vendor->bankInfo;

                $vendorBank->update($data);

                toastr()->success('Vendor Bank Info Has Been Updated Successfully');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}