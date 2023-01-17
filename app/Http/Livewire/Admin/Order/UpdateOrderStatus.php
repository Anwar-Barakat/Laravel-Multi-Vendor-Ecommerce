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

    public $courier_name, $tracking_number, $courierAndTracking;


    protected $rules =  [
        'courier_name'      => ['required', 'min:3', 'max:30'],
        'tracking_number'   => ['required', 'min:3', 'max:30'],
    ];

    public function mount()
    {
        $order              = Order::findOrFail($this->order_id);
        $this->status       = $order->order_status;

        $this->updatedStatus();
        if ($this->status == 'Shipped') {
            $this->courier_name     = $order->courier_name;
            $this->tracking_number  = $order->tracking_number;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function updatedStatus()
    {
        if ($this->status == 'Shipped')
            $this->courierAndTracking = true;
        else
            $this->courierAndTracking = false;
    }

    public function updateOrderStatus()
    {
        try {
            $order  = Order::findOrFail($this->order_id);
            DB::beginTransaction();


            if ($this->status == 'Shipped') {
                $this->validate();
                if ($this->courier_name != '' && $this->tracking_number != '') {
                    $order->update([
                        'order_status'      => $this->status,
                        'courier_name'      => $this->courier_name,
                        'tracking_number'   => $this->tracking_number,
                    ]);
                }
            } else {
                $order->update(['order_status'  => $this->status]);
            }

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