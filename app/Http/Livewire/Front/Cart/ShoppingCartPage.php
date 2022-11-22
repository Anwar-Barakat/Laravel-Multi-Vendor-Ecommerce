<?php

namespace App\Http\Livewire\Front\Cart;

use App\Models\Attribute;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ShoppingCartPage extends Component
{

    public function increaseQty($rowId)
    {
        $product    = Cart::instance('cart')->get($rowId);
        $prodAttr   = Attribute::where(['product_id' => $product->id, 'size' => $product->options->size])->first();

        if ($prodAttr->stock > 0) {
            $qty        = $product->qty + 1;
            Cart::instance('cart')->update($rowId, $qty);
            $prodAttr->update(['stock' => $prodAttr->stock - 1]);
            $this->updateHeader();
        } else {
            toastr()->info('Product Quntity is out of Stock');
        }
    }

    public function decreaseQty($rowId)
    {
        $product    = Cart::instance('cart')->get($rowId);
        $prodAttr   = Attribute::where(['product_id' => $product->id, 'size' => $product->options->size])->first();
        $qty        = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $prodAttr->update(['stock' => $prodAttr->stock + 1]);
        $this->updateHeader();
    }

    public function deleteItem($rowId)
    {
        $product    = Cart::instance('cart')->get($rowId);
        $prodAttr   = Attribute::where(['product_id' => $product->id, 'size' => $product->options->size])->first();
        Cart::instance('cart')->remove($rowId);
        $prodAttr->update(['stock' => $prodAttr->stock + $product->qty]);
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