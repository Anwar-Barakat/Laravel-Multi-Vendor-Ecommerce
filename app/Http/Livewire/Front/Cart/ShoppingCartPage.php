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
    public $couponCode, $discount, $subTotalAfterDiscount, $gstAfterDiscount, $totalAfterDiscount;
    public $final_price, $totalWeight, $productsGST, $finalGST = 0;

    public function mount()
    {
        $this->final_price      =   (float) str_replace(',', '', Cart::instance('cart')->subtotal());

        foreach (Cart::instance('cart')->content() as $item) {
            $this->productsGST  += Product::findOrFail($item->id)->gst;
            $this->finalGST     = round(($this->final_price * $this->productsGST) / 100, 2);
        }
    }

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
        $this->finalGST     = 0;
    }

    public function updateHeader()
    {
        $this->final_price  = Cart::instance('cart')->subtotal();
        $this->emit('updateCardAmount', Cart::instance('cart')->count());
        $this->emit('updateCardTotal', $this->final_price);
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

                // if (!in_array(Auth::user()->id, $usersArr)) {
                //     toastr()->info('This Coupon Code is not for you!');
                // }


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
                    toastr()->success('This Coupon Code has been applied successfully');
                endif;
            }
        } else {
            toastr()->info('You Have to Login to Apply Coupon Code, Thanks');
        }
    }

    public function calcDiscount()
    {
        $final_price = (float) str_replace(',', '', Cart::instance('cart')->subtotal());
        if (session()->get('coupon')['coupon_type'] == 'fixed')
            $this->discount     = session()->get('coupon')['amount'];
        else
            $this->discount     = ($final_price  * session()->get('coupon')['amount']) / 100;


        $this->subTotalAfterDiscount    = $final_price - $this->discount;
        $this->gstAfterDiscount         = ($this->subTotalAfterDiscount * $this->productsGST) / 100;
        $this->totalAfterDiscount       = $this->subTotalAfterDiscount + $this->gstAfterDiscount;
    }

    public function proccedToCheckout()
    {
        if (Cart::instance('cart')->count() == 0) :
            toastr()->info("You Don't have any Item yet in The Cart");
        elseif (!Auth::check()) :
            toastr()->info('You Have to Login to Move to Checkout Page, Thanks');
        else :
            return redirect()->route('front.checkout');
        endif;
    }

    public function render()
    {
        if (session()->has('coupon') && Auth::check())
            $this->calcDiscount();

        return view('livewire.front.cart.shopping-cart-page')->layout('front.layouts.master');
    }
}