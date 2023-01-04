<?php

namespace App\Http\Livewire\Admin\Order;

use App\Events\UpdateOrderStatus as EventsUpdateOrderStatus;
use App\Models\Order;
use App\Models\OrderLog;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UpdateOrderStatus extends Component
{
    public $order_id, $status;

    public function mount()
    {
        $order              = Order::findOrFail($this->order_id);
        $this->status       = $order->order_status;
    }

    public function updateStatus()
    {
        try {
            $order  = Order::findOrFail($this->order_id);
            DB::beginTransaction();

            $order->update(['order_status'  => $this->status]);
            OrderLog::create(['order_id'    => $order->id, 'status' =>  $this->status,]);

            DB::commit();

            event(new EventsUpdateOrderStatus($order));
            toastr()->success('Order Status Has Been Updated');
        } catch (\Throwable $th) {
        }
    }

    public function render()
    {

        return view('livewire.admin.order.update-order-status');
    }
}