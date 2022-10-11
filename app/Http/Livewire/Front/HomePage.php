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
        $data['new_arrivals']   = Product::where('status', 1)->latest()->limit(8)->get();
        $data['best_sellers']   = Product::where(['status' => 1, 'is_best_seller' => 1])->limit(5)->get();
        $data['discounted']     = Product::where('status', 1)->where('discount', '>', '0')->limit(5)->get();
        $data['featured']       = Product::where(['status' => 1, 'is_featured' => 1])->limit(5)->get();

        return view('livewire.front.home-page', $data)->layout('front.layouts.master');
    }
}