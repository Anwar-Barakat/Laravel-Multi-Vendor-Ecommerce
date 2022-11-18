<?php

namespace App\Http\Livewire\Front\Wishlist;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishlistPage extends Component
{
    public function remove($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        $this->emit('updateWishListCount', Cart::instance('wishlist')->count());
        toastr()->info('Item Has Been Deleted');
    }
    public function render()
    {
        return view('livewire.front.wishlist.wishlist-page')->layout('front.layouts.master');
    }
}