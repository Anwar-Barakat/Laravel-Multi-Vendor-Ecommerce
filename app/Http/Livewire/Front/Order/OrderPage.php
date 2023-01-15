<?php

namespace App\Http\Livewire\Front\Order;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OrderPage extends Component
{
    use WithPagination;

    public function render()
    {
        $orders = Order::with('orderProducts')->where('user_id', Auth::user()->id)->latest()->paginate(10);

        return view('livewire.front.order.order-page', ['orders' => $orders])->layout('front.layouts.master');
    }
}