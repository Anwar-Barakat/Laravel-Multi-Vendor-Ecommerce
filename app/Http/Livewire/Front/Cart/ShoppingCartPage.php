<?php

namespace App\Http\Livewire\Front\Cart;

use App\Models\Attribute;
use App\Models\Coupon;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShoppingCartPage extends Component
{
    public $couponCode, $discount, $subTotalAfterDiscount, $taxAfterDiscount, $totalAfterDiscount;

    public function increaseQty($rowId)
    {
        $product    = Cart::instance('cart')->get($rowId);
        $prodAttr   = Attribute::where(['product_id' => $product->id, 'size' => $product->options->size])->first();

        if ($prodAttr->stock > 0) {
            $qty        = $product->qty + 1;
            Cart::instance('cart')->update($rowId, $qty);
            $prodAttr->update(['stock' => $prodAttr->stock - 1]);
            $this->updateHeader();
        } else {
            toastr()->info('Product Quntity is out of Stock');
        }
    }

    public function decreaseQty($rowId)
    {
        $product    = Cart::instance('cart')->get($rowId);
        $prodAttr   = Attribute::where(['product_id' => $product->id, 'size' => $product->options->size])->first();
        $qty        = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $prodAttr->update(['stock' => $prodAttr->stock + 1]);
        $this->updateHeader();
    }

    public function deleteItem($rowId)
    {
        $product    = Cart::instance('cart')->get($rowId);
        $prodAttr   = Attribute::where(['product_id' => $product->id, 'size' => $product->options->size])->first();
        Cart::instance('cart')->remove($rowId);
        $prodAttr->update(['stock' => $prodAttr->stock + $product->qty]);
        $this->updateHeader();
        toastr()->info('Item Has Been Deleted');
    }

    public function updateHeader()
    {
        $this->emit('updateCardAmount', Cart::instance('cart')->count());
        $this->emit('updateCardTotal', Cart::instance('cart')->total());
    }

    public function applyCouponCode()
    {

        if (Auth::check()) {
            $coupon = Coupon::where('coupon_code', $this->couponCode)->first();
            if (!$coupon)
                toastr()->info('This Coupon Code is not Valid !');
            else {

                $catArr     = explode(',', $coupon->categories);
                $usersArr   = explode(',', $coupon->users);


                if ($coupon->status == 0) :
                    toastr()->info('This Coupon Code is not Active !');
                elseif (date('Y-m-d') > $coupon->expiry_date) :
                    toastr()->info(date('Y-m-d'), $coupon->expiry_date);
                endif;


                foreach (Cart::instance('cart')->content() as  $item) {
                    $product        = Product::select('category_id')->findOrFail($item->id);
                    if (!in_array($product->category_id, $catArr)) {
                        toastr()->info('This Coupon Code is not for one of the selected products !');
                    }
                }

                if (!in_array(Auth::user()->id, $usersArr)) {
                    toastr()->info('This Coupon Code is not for you!');
                }


                if (session()->has('coupon')) :
                    $this->calcDiscount();
                else :
                    session()->put('coupon', [
                        'coupon_option'     => $coupon->coupon_option,
                        'coupon_code'       => $coupon->coupon_code,
                        'coupon_type'       => $coupon->coupon_type,
                        'amount_type'       => $coupon->amount_type,
                        'amount'            => $coupon->amount
                    ]);
                    toastr()->info('This Coupon Code has been applied successfully');
                endif;
            }
        } else {
            toastr()->info('You Have to Loing to Apply Coupon Code, Thanks');
        }
    }

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

    public function render()
    {
        if (session()->has('coupon') && Auth::check())
            $this->calcDiscount();

        return view('livewire.front.cart.shopping-cart-page')->layout('front.layouts.master');
    }
}