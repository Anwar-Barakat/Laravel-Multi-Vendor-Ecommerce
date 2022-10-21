<?php

namespace App\Http\Livewire\Front\Detail;

use App\Models\Product;
use Livewire\Component;

class ProductDetailPage extends Component
{
    public $productId;

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function render()
    {
        $product    = Product::with(['category'])->findOrFail($this->productId);
        return view('livewire.front.detail.product-detail-page', ['product' => $product])->layout('front.layouts.master');
    }
}