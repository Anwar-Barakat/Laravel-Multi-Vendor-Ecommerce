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
    public $orderId, $reason, $product_info, $comment;
    public $return_exchange, $return_exchange_text = 'Return / Exchange';
    public $prodAttr, $required_size;

    protected $rules =  [
        'reason'    => ['required'],
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
        try {
            DB::beginTransaction();
            $order  = Order::where(['id' => $this->orderId, 'user_id' => Auth::user()->id])->first();

            if ($order) {
                $order->update(['order_status' => 'Cancelled']);
                OrderLog::create([
                    'order_id'      => $order->id,
                    'status'        => 'Cancelled',
                    'reason'        => $this->reason,
                    'updated_by'    => 'Customer'
                ]);
            } else
                abort(404);

            DB::commit();
            toastr()->info('Order Has Been Cancelled Successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    public function returnOrExchangeRequest()
    {
        try {
            $order  = Order::where(['id' => $this->orderId, 'user_id' => Auth::user()->id])->first();
            if ($order) {

                $productInfo    = explode('-', $this->product_info); // 0 => product code & 1 => product size
                $prod = OrderProduct::where(['order_id' => $this->orderId, 'product_code' => $productInfo[0], 'product_size' => $productInfo[1]])->first();
                if ($this->return_exchange_text == 'return') {
                    DB::beginTransaction();


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
                    DB::commit();

                    $this->reset(['return_exchange',  'product_info', 'reason', 'comment']);
                } elseif ($this->return_exchange_text == 'exchange') {

                    DB::beginTransaction();

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
                    DB::commit();

                    $this->reset(['required_size', 'return_exchange', 'product_info', 'prodAttr', 'reason', 'comment',]);
                } else
                    abort(404);
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