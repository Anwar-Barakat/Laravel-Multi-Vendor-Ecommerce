<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\UpdateVendorBusinessRequest;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateVendorBusinessController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateVendorBusinessRequest $request)
    {
        try {
            if ($request->isMethod('put')) {
                $data = $request->all();

                $admin          = Admin::where('id', Auth::guard('admin')->user()->id)->first();
                $vendorBusiness = $admin->vendor->businessAccount;

                if ($request->hasFile('address_proof_image') && $request->file('address_proof_image')->isValid()) {
                    $vendorBusiness->clearMediaCollection('vendor_address_proof_images');
                    $vendorBusiness->addMediaFromRequest('address_proof_image')->toMediaCollection('vendor_address_proof_images');
                }

                $vendorBusiness->update($data);

                toastr()->success('Vendor Business Info Has Been Updated Successfully');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}
