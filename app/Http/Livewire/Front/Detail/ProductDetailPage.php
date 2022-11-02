<?php

namespace App\Http\Livewire\Front\Detail;

use App\Models\Attribute;
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
        $product    = Product::with(['section', 'category', 'attributes', 'brand'])->findOrFail($this->productId);
        $totalStock = Attribute::where('product_id', $product->id)->sum('stock');


        return view('livewire.front.detail.product-detail-page', [
            'product'       => $product,
            'totalStock'    => $totalStock
        ])->layout('front.layouts.master');
    }
}