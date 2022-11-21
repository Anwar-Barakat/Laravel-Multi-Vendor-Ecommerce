<?php

namespace App\Http\Livewire\Front\Cart;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ShoppingCartPage extends Component
{

    public function increaseQty($rowId)
    {
        $product    = Cart::instance('cart')->get($rowId);
        $qty        = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->updateHeader();
    }

    public function decreaseQty($rowId)
    {
        $product    = Cart::instance('cart')->get($rowId);
        $qty        = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->updateHeader();
    }

    public function deleteItem($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->updateHeader();
        toastr()->info('Item Has Been Deleted');
    }

    public function updateHeader()
    {
        $this->emit('updateCardAmount', Cart::instance('cart')->count());
        $this->emit('updateCardTotal', Cart::instance('cart')->total());
    }

    public function render()
    {
        return view('livewire.front.cart.shopping-cart-page')->layout('front.layouts.master');
    }
}