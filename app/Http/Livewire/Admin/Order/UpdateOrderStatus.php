<?php

namespace App\Http\Livewire\Admin\Order;

use App\Events\UpdateOrderStatus as EventsUpdateOrderStatus;
use App\Models\Order;
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
        $order  = Order::findOrFail($this->order_id);
        $order->update(['order_status' => $this->status]);
        toastr()->success('Order Status Has Been Updated');


        event(new EventsUpdateOrderStatus($order));
    }

    public function render()
    {

        return view('livewire.admin.order.update-order-status');
    }
}