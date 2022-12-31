<?php

namespace App\Http\Livewire\Front\Order;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderPage extends Component
{
    public function render()
    {
        $orders = Order::with('orderProducts')->where('user_id', Auth::user()->id)->get();

        return view('livewire.front.order.order-page', ['orders' => $orders])->layout('front.layouts.master');
    }
}