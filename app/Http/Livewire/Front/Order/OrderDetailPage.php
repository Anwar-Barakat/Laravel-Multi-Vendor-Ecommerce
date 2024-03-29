<?php

namespace App\Http\Livewire\Front\Order;

use App\Models\Attribute;
use App\Models\ExchangeRequest;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ReturnRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderDetailPage extends Component
{
    public $orderId, $cancelled_reason,
        $reason, $product_info, $comment,
        $return_exchange, $return_exchange_text = 'Return / Exchange',
        $prodAttr, $required_size;

    protected $rules =  [
        'reason'            => ['required'],
        'comment'           => ['required', 'min:10'],
        'return_exchange'   => ['required', 'in:return,exchange'],
        'product_info'      => ['required']
    ];

    public function mount($id)
    {
        $this->orderId  = $id;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function updatedReturnExchange()
    {
        $this->return_exchange_text     = $this->return_exchange;
    }

    // get required sizies 
    public function updatedProductInfo()
    {
        $productInfo    = explode('-', $this->product_info); // 0 => product code & 1 => product size
        $product        = Product::where(['code' => $productInfo[0]])->first();
        $this->prodAttr = Attribute::where('product_id', $product->id)->where('size', '!=', $productInfo[1])->where('stock', '!=', 0)->pluck('size');
    }

    public function orderCancel()
    {
        $this->validate([
            'cancelled_reason' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $order  = Order::where(['id' => $this->orderId, 'user_id' => Auth::user()->id])->first();

            if ($order) {
                $order->update(['order_status' => 'Cancelled']);
                OrderLog::create([
                    'order_id'          => $order->id,
                    'status'            => 'Cancelled',
                    'reason'            => $this->cancelled_reason,
                    'updated_by'        => 'Customer'
                ]);
                $this->reset(['cancelled_reason']);
                toastr()->info('Order Has Been Cancelled Successfully');
            } else
                abort(404);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function returnOrExchangeRequest()
    {
        $this->validate();
        try {
            $order  = Order::where(['id' => $this->orderId, 'user_id' => Auth::user()->id])->first();
            if ($order) {

                $productInfo    = explode('-', $this->product_info); // 0 => product code & 1 => product size
                $prod = OrderProduct::where(['order_id' => $this->orderId, 'product_code' => $productInfo[0], 'product_size' => $productInfo[1]])->first();
                DB::beginTransaction();

                if ($this->return_exchange_text == 'return') {
                    // Update Item Status
                    $prod->update(['product_status' => 'Return Initiated']);

                    // Add a new return request 
                    ReturnRequest::create([
                        'order_id'      => $this->orderId,
                        'user_id'       => Auth::user()->id,
                        'product_code'  => $productInfo[0],
                        'product_size'  => $productInfo[1],
                        'reason'        => $this->reason,
                        'status'        => 'Pending',
                        'comment'       => $this->comment,
                    ]);
                    toastr()->success('Order Has Been Returned Successfully');

                    $this->reset(['return_exchange',  'product_info', 'reason', 'comment']);
                } elseif ($this->return_exchange_text == 'exchange') {
                    $this->validate(['required_size' => 'required']);
                    // Update Item Status
                    $prod->update(['product_status' => 'Exchange Initiated']);

                    // Add a new exchange request 
                    ExchangeRequest::create([
                        'order_id'      => $this->orderId,
                        'user_id'       => Auth::user()->id,
                        'product_code'  => $productInfo[0],
                        'product_size'  => $productInfo[1],
                        'required_size' => $this->required_size,
                        'reason'        => $this->reason,
                        'status'        => 'Pending',
                        'comment'       => $this->comment,
                    ]);
                    toastr()->success('Order Has Been Exchanged Successfully');

                    $this->reset(['required_size', 'return_exchange', 'product_info', 'prodAttr', 'reason', 'comment',]);
                } else
                    abort(404);

                DB::commit();
            } else
                abort(404);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function render()
    {
        $order  =   Order::with(['orderProducts'])->where(['id' => $this->orderId, 'user_id' => Auth::user()->id])->first();
        if (!$order)
            abort(404);
        return view('livewire.front.order.order-detail-page', ['order' => $order])->layout('front.layouts.master');
    }
}