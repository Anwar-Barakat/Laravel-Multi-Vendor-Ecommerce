<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\UpdateVendorDetailRequest;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateVendorDetailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateVendorDetailRequest $request)
    {
        DB::beginTransaction();
        try {
            if ($request->isMethod('put')) {
                $data   = $request->only(['name', 'address', 'city', 'state', 'country_id', 'pincode', 'mobile', 'about_me', 'avatar']);

                $admin  = Admin::where('id', Auth::guard('admin')->user()->id)->first();
                $admin->update($data);

                $vendor = $admin->vendor->update($data);

                if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                    $admin->clearMediaCollection('avatars');
                    $admin->addMediaFromRequest('avatar')->toMediaCollection('avatars');
                }

                DB::commit();

                toastr()->success('Vendor Detail Info Has Been Updated Successfully');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}