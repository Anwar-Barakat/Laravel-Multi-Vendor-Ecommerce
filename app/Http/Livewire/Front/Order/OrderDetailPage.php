<?php

namespace App\Http\Livewire\Front\Order;

use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderProduct;
use App\Models\ReturnRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderDetailPage extends Component
{
    public $orderId, $reason, $product_info, $comment;

    protected $rules =  [
        'reason'    => ['required'],
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function mount($id)
    {
        $this->orderId  = $id;
    }

    public function orderCancel()
    {
        // $this->validate();
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

    public function orderReturn()
    {
        try {
            $order  = Order::where(['id' => $this->orderId, 'user_id' => Auth::user()->id])->first();

            if ($order) {
                DB::beginTransaction();
                $productInfo    = explode('-', $this->product_info); // 0 => product code & 1 => product size

                // Update Item Status
                $prod = OrderProduct::where(['order_id' => $this->orderId, 'product_code' => $productInfo[0], 'product_size' => $productInfo[1]])->first();
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
                $this->reset(['reason', 'comment']);
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