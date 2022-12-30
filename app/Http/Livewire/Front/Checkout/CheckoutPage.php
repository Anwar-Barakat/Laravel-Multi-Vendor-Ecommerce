<?php

namespace App\Http\Livewire\Front\Checkout;

use App\Models\DeliveryAddress;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CheckoutPage extends Component
{
    public $couponCode, $discount, $subTotalAfterDiscount, $taxAfterDiscount, $totalAfterDiscount;

    public $deliveryAddress;

    public function calcDiscount()
    {
        if (session()->get('coupon')['coupon_type'] == 'fixed')
            $this->discount     = session()->get('coupon')['amount'];
        else
            $this->discount     = (Cart::instance('cart')->subtotal()  * session()->get('coupon')['amount']) / 100;


        $this->subTotalAfterDiscount    = Cart::instance('cart')->subtotal() - $this->discount;
        $this->taxAfterDiscount         = ($this->subTotalAfterDiscount * config('cart.tax')) / 100;
        $this->totalAfterDiscount       = $this->subTotalAfterDiscount + $this->taxAfterDiscount;
    }

    public function getDeliveryAddressId($id)
    {
        $this->deliveryAddress = $id;
        dd($this->deliveryAddress);
    }

    public function deleteDeliveryAddress($id)
    {
        DeliveryAddress::findOrFail($id)->delete();
        toastr()->info('Delivery Address Has Been Deleted');
    }

    public function render()
    {
        if (session()->has('coupon') && Auth::check())
            $this->calcDiscount();

        return view('livewire.front.checkout.checkout-page')->layout('front.layouts.master');
    }
}