<?php

namespace App\Http\Livewire\Front\Wishlist;

use Livewire\Component;

class WishlistPage extends Component
{
    public function render()
    {
        return view('livewire.front.wishlist.wishlist-page')->layout('front.layouts.master');
    }
}