<?php

namespace App\Http\Livewire\Front\Cart;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ShoppingCartPage extends Component
{

    public function increaseQty($rowId)
    {
        $product    = Cart::get($rowId);
        $qty        = $product->qty + 1;
        Cart::update($rowId, $qty);
        $this->updateHeader();
    }

    public function decreaseQty($rowId)
    {
        $product    = Cart::get($rowId);
        $qty        = $product->qty - 1;
        Cart::update($rowId, $qty);
        $this->updateHeader();
    }

    public function deleteItem($rowId)
    {
        Cart::remove($rowId);
        $this->updateHeader();
        toastr()->info('Item Has Been Deleted Successfully');
    }

    public function updateHeader()
    {
        $this->emit('updateCardAmount', Cart::count());
        $this->emit('updateCardTotal', Cart::total());
    }

    public function render()
    {
        return view('livewire.front.cart.shopping-cart-page')->layout('front.layouts.master');
    }
}