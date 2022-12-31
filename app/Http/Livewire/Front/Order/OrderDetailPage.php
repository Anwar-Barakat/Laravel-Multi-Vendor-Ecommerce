<?php

namespace App\Http\Livewire\Front\Order;

use App\Models\Order;
use Livewire\Component;

class OrderDetailPage extends Component
{
    public $orderId;

    public function mount($id)
    {
        $this->orderId  = $id;
    }

    public function render()
    {
        $order  = Order::with(['orderProducts'])->findOrFail($this->orderId);

        return view('livewire.front.order.order-detail-page', ['order' => $order])->layout('front.layouts.master');
    }
}