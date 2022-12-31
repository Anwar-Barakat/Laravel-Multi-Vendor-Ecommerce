<?php

namespace App\Http\Livewire\Front\Checkout;

use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CheckoutPage extends Component
{
    public $couponCode, $discount, $subTotalAfterDiscount, $taxAfterDiscount, $totalAfterDiscount;

    public $deliveryAddressId, $payment_gateway;


    protected $rules =  [
        'deliveryAddressId'     => ['required'],
        'payment_gateway'       => ['required'],
    ];



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


    public function deleteDeliveryAddress($id)
    {
        DeliveryAddress::findOrFail($id)->delete();
        toastr()->info('Delivery Address Has Been Deleted');
    }

    public function placeToOrder()
    {
        $this->validate();
        try {
            $deliveryAddress    = DeliveryAddress::findOrFail($this->deliveryAddressId);

            DB::beginTransaction();

            Order::create([
                'user_id'               => Auth::user()->id,
                'name'                  => $deliveryAddress->name,
                'address'               => $deliveryAddress->address,
                'city'                  => $deliveryAddress->city,
                'state'                 => $deliveryAddress->state,
                'country_id'            => $deliveryAddress->country_id,
                'email'                 => Auth::user()->email,
                'mobile'                => $deliveryAddress->mobile,
                'shipping_charges'      => 0,
                'coupon_code'           => session()->get('coupon')['coupon_code'] ?? null,
                'coupon_amount'         => session()->get('coupon')['coupon_amount'] ?? null,
                'order_status'          => "New",
                'paymeny_method'        => $this->payment_gateway,
                'paymeny_gateway'       => $this->payment_gateway == 'COD' ? 'COD' : 'Prepaid',
                'grand_total'           => Cart::instance('cart')->total(),
            ]);
            $orderId            = DB::getPdo()->lastInsertId();




            foreach (Cart::instance('cart')->content() as $item) {
                $product    = Product::findOrFail($item->id);
                OrderProduct::create([
                    'order_id'          => $orderId,
                    'user_id'           => Auth::user()->id,
                    'product_id'        => $item->model->id,
                    'product_code'      => $item->model->code,
                    'product_name'      => $item->model->name,
                    'product_color'     => $product->color,
                    'product_size'      => $item->model->code,
                    'product_price'     => Product::applyDiscount($item->model->id),
                    'product_qty'       => $item->qty,
                ]);
            }

            session()->put('orderId', $orderId);
            session()->put('grandTotal', Cart::instance('cart')->total());

            DB::commit();
            toastr()->success('Order Has Been Placed Successfully');


            if ($this->payment_gateway == 'COD') {
                Cart::instance('cart')->destroy();
                return redirect()->route('front.thanks');
            } else
                echo "Prepaid Method Coming Soon!, thanks";
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function render()
    {
        if (session()->has('coupon') && Auth::check())
            $this->calcDiscount();

        return view('livewire.front.checkout.checkout-page')->layout('front.layouts.master');
    }
}