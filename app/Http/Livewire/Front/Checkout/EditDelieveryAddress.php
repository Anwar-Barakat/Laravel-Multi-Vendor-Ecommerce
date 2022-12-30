<?php

namespace App\Http\Livewire\Front\Checkout;

use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditDelieveryAddress extends Component
{
    public $name,
        $address,
        $mobile,
        $city,
        $state,
        $country_id,
        $pincode,
        $deliveryAddressId;

    protected $rules =  [
        'name'          => ['required', 'string', 'min:3', 'max:30'],
        'address'       => ['required', 'min:3', 'max:30'],
        'mobile'        => ['required', 'min:3', 'max:30'],
        'city'          => ['required', 'min:3', 'max:30'],
        'state'         => ['required', 'min:3', 'max:30'],
        'country_id'    => ['required'],
        'pincode'       => ['required', 'min:6'],
    ];

    public function mount($id)
    {
        $this->deliveryAddressId    = $id;
        $deliveryAddress    = DeliveryAddress::findOrFail($id);
        $this->name         =  $deliveryAddress->name;
        $this->email        =  $deliveryAddress->email;
        $this->address      =  $deliveryAddress->address;
        $this->mobile       =  $deliveryAddress->mobile;
        $this->city         =  $deliveryAddress->city;
        $this->state        =  $deliveryAddress->state;
        $this->country_id   =  $deliveryAddress->country->id;
        $this->pincode      =  $deliveryAddress->pincode;
    }

    public function updateDeliveryAddress()
    {
        $this->validate();
        try {
            $deliveryAddress    = DeliveryAddress::findOrFail($this->deliveryAddressId);
            $deliveryAddress->update([
                'user_id'       => Auth::user()->id,
                'name'          => $this->name,
                'address'       => $this->address,
                'mobile'        => $this->mobile,
                'city'          => $this->city,
                'state'         => $this->state,
                'country_id'    => $this->country_id,
                'pincode'       => $this->pincode,
            ]);

            toastr()->success('Delivery Address Has Been Updated Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.front.checkout.edit-delievery-address')->layout('front.layouts.master');
    }
}