<?php

namespace App\Http\Livewire\Front\Checkout;

use App\Events\CustomerOrderPlaced;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ShippingCharges;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CheckoutPage extends Component
{

    public $couponCode, $discount, $subTotalAfterDiscount, $gstAfterDiscount, $totalAfterDiscount;
    public $deliveryAddressId, $payment_gateway;
    public $totalWeight, $shippingChargesValue = 0, $productsGST, $finalGST;
    public $final_price;


    protected $rules =  [
        'deliveryAddressId'     => ['required'],
        'payment_gateway'       => ['required'],
    ];

    public function mount()
    {
        $this->final_price      =   (float) str_replace(',', '', Cart::instance('cart')->subtotal());

        foreach (Cart::instance('cart')->content() as $item) {
            $this->productsGST  += Product::findOrFail($item->id)->gst;
            $this->finalGST     = round(($this->final_price * $this->productsGST) / 100, 2);
        }
    }

    public function updatedDeliveryAddressId()
    {
        $deliveryAddress            = DeliveryAddress::findOrFail($this->deliveryAddressId);
        $shippingCharges            = ShippingCharges::where('country_id', $deliveryAddress->country_id)->first();

        foreach (Cart::instance('cart')->content() as $item)
            $this->totalWeight  += Product::findOrFail($item->id)->weight;


        $this->shippingChargesValue =  $this->getShippingCharges($shippingCharges->id, $this->totalWeight);
    }



    public function calcDiscount()
    {
        if (session()->get('coupon')['coupon_type'] == 'fixed')
            $this->discount     = session()->get('coupon')['amount'];
        else
            $this->discount     = (Cart::instance('cart')->subtotal()  * session()->get('coupon')['amount']) / 100;


        $this->subTotalAfterDiscount    = Cart::instance('cart')->subtotal() - $this->discount;
        $this->gstAfterDiscount         = ($this->subTotalAfterDiscount * $this->productsGST) / 100;
        $this->totalAfterDiscount       = $this->subTotalAfterDiscount + $this->gstAfterDiscount;
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

            // Check if there is a discount => get the price after discounting
            if (session()->has('coupon') && Auth::check()) :
                $subTotalAfterDiscount  = $this->subTotalAfterDiscount;
                $finalPrice    =   $subTotalAfterDiscount  + $this->shippingChargesValue + $this->finalGST;
            else :
                $finalPrice    =   $this->final_price  + $this->shippingChargesValue + $this->finalGST;
            endif;


            $order =  Order::create([
                'user_id'               => Auth::user()->id,
                'name'                  => $deliveryAddress->name,
                'address'               => $deliveryAddress->address,
                'city'                  => $deliveryAddress->city,
                'state'                 => $deliveryAddress->state,
                'country_id'            => $deliveryAddress->country_id,
                'email'                 => Auth::user()->email,
                'mobile'                => $deliveryAddress->mobile,
                'shipping_charges'      => $this->shippingChargesValue,
                'coupon_code'           => session()->get('coupon')['coupon_code'] ?? null,
                'coupon_amount'         => session()->get('coupon')['coupon_amount'] ?? null,
                'order_status'          => "New",
                'paymeny_method'        => $this->payment_gateway,
                'paymeny_gateway'       => $this->payment_gateway == 'COD' ? 'COD' : 'Prepaid',
                'final_price'           => $finalPrice,
            ]);

            $orderId            = DB::getPdo()->lastInsertId();


            foreach (Cart::instance('cart')->content() as $item) {
                OrderProduct::create([
                    'order_id'          => $orderId,
                    'user_id'           => Auth::user()->id,
                    'product_id'        => $item->model->id,
                    'product_code'      => $item->model->code,
                    'product_name'      => $item->model->name,
                    'product_color'     => $item->model->color,
                    'product_size'      => $item->options->size,
                    'product_price'     => Product::applyDiscount($item->model->id, $item->model->price)['final_price'],
                    'product_qty'       => $item->qty,
                ]);
            }


            session()->put('orderId', $orderId);
            session()->put('finalPrice', $finalPrice);

            DB::commit();

            if ($this->payment_gateway == 'COD') {
                // event(new CustomerOrderPlaced($order));
                Cart::instance('cart')->destroy();
                toastr()->success('Order Has Been Placed Successfully');
                return redirect()->route('front.thanks');
            } else
                echo "Prepaid Method Coming Soon!, thanks";
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function getShippingCharges($id, $w)
    {
        $s      = ShippingCharges::findOrFail($id);
        $value  = 0;

        if ($w > 0) :
            if ($w > 0 && $w <= 500) :
                $value  = $s['zero_500g'];
            elseif ($w > 500 && $w <= 1000) :
                $value  = $s['_501_1000g'];
            elseif ($w > 1000 && $w <= 2000) :
                $value  = $s['_1001_2000g'];
            elseif ($w > 2000 && $w <= 5000) :
                $value  = $s['_2001_5000g'];
            elseif ($w > 5000) :
                $value  = $s['above_5000g'];
            endif;
        else :
            $value = 0;
        endif;

        return $value;
    }

    public function render()
    {
        if (session()->has('coupon') && Auth::check()) {
            $this->calcDiscount();
        }

        return view('livewire.front.checkout.checkout-page')->layout('front.layouts.master');
    }
}