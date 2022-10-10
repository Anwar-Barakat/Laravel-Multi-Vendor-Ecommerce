<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;

    public function render()
    {
        $products   = Product::where('status', 1)->inRandomOrder()->limit(8)->get();
        return view('livewire.front.home-page', [
            'products'  => $products,
        ])->layout('front.layouts.master');
    }
}