<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Section;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class MainHeader extends Component
{
    public $search = '', $card_amount, $total_price, $wishlistCount;

    protected $listeners    = ['updateCardAmount' => 'updateCardAmount', 'updateCardTotal' => 'updateCardTotal', 'updateWishListCount' => 'updateWishListCount'];

    public function mount()
    {
        $this->card_amount      = Cart::instance('cart')->count();
        $this->wishlistCount    = Cart::instance('wishlist')->count();
        $this->total_price      = Cart::instance('cart')->total();
    }

    public function updateCardAmount($count)
    {
        $this->card_amount      = $count;
    }

    public function updateCardTotal($total)
    {
        $this->total_price      = $total;
    }

    public function updateWishListCount($count)
    {
        $this->wishlistCount    = $count;
    }

    public function render()
    {
        $searchResults      = [];
        if (strlen($this->search) >= 1)
            $data['searchResults'] = Product::where('name', 'LIKE', '%' . $this->search . '%')
                ->inRandomOrder()->take(7)->get();

        $data['sections'] = Section::activeSections();
        return view('livewire.front.main-header', $data);
    }
}
