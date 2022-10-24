<?php

namespace App\Http\Livewire\Front\Vendor;

use App\Models\Admin;
use App\Models\Vendor;
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
            $this->validate($this->rules);
            DB::beginTransaction();

            Vendor::create([
                'name'      => $this->name,
                'mobile'    => $this->mobile,
                'email'     => $this->email,
                'status'    => false,
            ]);
            Admin::create([
                'name'      => $this->name,
                'type'      => 'vendor',
                'mobile'    => $this->mobile,
                'email'     => $this->email,
                'password'  => bcrypt($this->password),
                'status'    => false,
                'vendor_id' => DB::getPdo()->lastInsertId(),
            ]);
            DB::commit();

            toastr()->success('Thanks for registering as a vendor, We will comfirm by email once your account is approved');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.front.vendor.register-page')->layout('front.layouts.master');
    }
}