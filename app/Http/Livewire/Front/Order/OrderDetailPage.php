<?php

namespace App\Http\Livewire\Front\Order;

use App\Models\Order;
use App\Models\OrderLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderDetailPage extends Component
{
    public $orderId, $reason, $product_info;

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
        $this->validate();
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

    public function render()
    {
        $order  =   Order::with(['orderProducts'])->where(['id' => $this->orderId, 'user_id' => Auth::user()->id])->first();
        if (!$order)
            abort(404);
        return view('livewire.front.order.order-detail-page', ['order' => $order])->layout('front.layouts.master');
    }
}