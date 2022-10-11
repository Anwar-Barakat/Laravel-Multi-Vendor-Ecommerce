<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;

use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class ShopPage extends Component
{
    use WithPagination;
    public function render()
    {
        Paginator::useTailwind();
        $data['products']   = Product::with(['category', 'brand'])->where('status', 1)->paginate(6);
        return view('livewire.front.shop-page', $data)->layout('front.layouts.master');
    }
}
