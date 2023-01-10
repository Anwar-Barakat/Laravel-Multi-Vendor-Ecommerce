<?php

namespace App\Http\Livewire\Front\Detail;

use Livewire\Component;

class RatingProductSection extends Component
{
    public $product_id;

    public function render()
    {
        return view('livewire.front.detail.rating-product-section');
    }
}