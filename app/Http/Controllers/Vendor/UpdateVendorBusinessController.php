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

                $admin  = Admin::where('id', Auth::guard('admin')->user()->id)->first();
                $vendor = $admin->vendor;

                if ($request->hasFile('address_proof_image') && $request->file('address_proof_image')->isValid()) {
                    $admin->clearMediaCollection('address_proof_images');
                    $admin->addMediaFromRequest('address_proof_image')->toMediaCollection('address_proof_images');
                }

                Vendor::where('id', Auth::guard('admin')->user()->id)->first();

                return $vendor;
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}