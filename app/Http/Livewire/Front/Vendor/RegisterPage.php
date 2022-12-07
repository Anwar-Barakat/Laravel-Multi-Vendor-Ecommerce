<?php

namespace App\Http\Livewire\Front\Vendor;

use App\Events\VendorRegistered;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorBankDetail;
use App\Models\VendorBusinessDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RegisterPage extends Component
{
    public $name, $email, $mobile, $password, $accept;

    protected $rules =  [
        'name'          => ['required', 'min:3', 'max:30'],
        'email'         => ['required', 'email', 'unique:vendors,email', 'unique:admins,email'],
        'mobile'        => ['required', 'numeric', 'min:10', 'unique:vendors,mobile', 'unique:admins,mobile'],
        'password'      => ['required', 'min:8'],
        'accept'        => ['required']
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function storeVendor()
    {
        try {
            DB::beginTransaction();

            $vendor = Vendor::create([
                'name'      => $this->name,
                'mobile'    => $this->mobile,
                'email'     => $this->email,
                'status'    => false,
            ]);

            $vendor_id = DB::table('vendors')->orderByDesc('id')->first()->id;

            Admin::create([
                'name'      => $this->name,
                'type'      => 'vendor',
                'mobile'    => $this->mobile,
                'email'     => $this->email,
                'password'  => bcrypt($this->password),
                'status'    => false,
                'vendor_id' => $vendor_id,
            ]);

            VendorBankDetail::create(['vendor_id' => $vendor_id]);
            VendorBusinessDetail::create(['vendor_id' => $vendor_id]);
            DB::commit();

            event(new VendorRegistered($vendor));

            toastr()->success('Thanks for registering as a vendor, We will comfirm by email once your account is approved');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {

        return view('livewire.front.vendor.register-page')->layout('front.layouts.master');
    }
}