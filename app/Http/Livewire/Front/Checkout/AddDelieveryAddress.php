<?php

namespace App\Http\Livewire\Front\Checkout;

use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddDelieveryAddress extends Component
{
    public $name,
        $address,
        $mobile,
        $city,
        $state,
        $country_id,
        $pincode;

    protected $rules =  [
        'name'          => ['required', 'string', 'min:3', 'max:30'],
        'address'       => ['required', 'min:3', 'max:30'],
        'mobile'        => ['required', 'min:10', 'max:10'],
        'city'          => ['required', 'min:3', 'max:30'],
        'state'         => ['required', 'min:3', 'max:30'],
        'country_id'    => ['required'],
        'pincode'       => ['required', 'min:6'],
    ];


    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function storeDeliveryAddress()
    {
        $validations            = $this->validate();
        $validations['user_id'] = Auth::user()->id;
        try {
            DeliveryAddress::create($validations);

            toastr()->success('Delivery Address Has Been Added Successfully');
            $this->reset();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.front.checkout.add-delievery-address')->layout('front.layouts.master');
    }
}