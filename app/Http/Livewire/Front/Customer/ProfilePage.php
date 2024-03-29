<?php

namespace App\Http\Livewire\Front\Customer;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProfilePage extends Component
{
    public $name,
        $email,
        $address,
        $mobile,
        $city,
        $state,
        $country_id,
        $pincode;

    protected $rules =  [
        'name'          => ['required', 'string', 'min:3', 'max:30'],
        'address'       => ['required', 'min:3', 'max:30'],
        'mobile'        => ['required', 'min:3', 'max:30'],
        'city'          => ['required', 'min:3', 'max:30'],
        'state'         => ['required', 'min:3', 'max:30'],
        'country_id'    => ['required'],
        'pincode'       => ['required', 'min:6'],
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function mount()
    {
        $this->name         = Auth::user()->name;
        $this->email        = Auth::user()->email;
        $this->address      = Auth::user()->address;
        $this->mobile       = Auth::user()->mobile;
        $this->city         = Auth::user()->city;
        $this->state        = Auth::user()->state;
        $this->country_id   = Auth::user()->country->id;
        $this->pincode      = Auth::user()->pincode;
    }


    public function storeCustomer()
    {
        $this->validate();
        try {
            $customer = User::findOrFail(Auth::user()->id);
            $customer->update([
                'name'          => $this->name,
                'address'       => $this->address,
                'mobile'        => $this->mobile,
                'city'          => $this->city,
                'state'         => $this->state,
                'country_id'    => $this->country_id,
                'pincode'       => $this->pincode,
            ]);

            toastr()->success('Profile Has Been Updated Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }



    public function render()
    {
        return view('livewire.front.customer.profile-page')->layout('front.layouts.master');
    }
}