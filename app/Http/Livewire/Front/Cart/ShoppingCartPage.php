<?php

namespace App\Http\Livewire\Front\Cart;

use Livewire\Component;

class ShoppingCartPage extends Component
{
    public function render()
    {
        return view('livewire.front.cart.shopping-cart-page')->layout('front.layouts.master');
    }
}