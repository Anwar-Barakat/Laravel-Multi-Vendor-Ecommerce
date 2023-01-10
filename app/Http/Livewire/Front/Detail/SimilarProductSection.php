<?php

namespace App\Http\Livewire\Front\Detail;

use App\Models\Product;
use Livewire\Component;

class SimilarProductSection extends Component
{
    public $product_id;

    public function getSimilarProducts()
    {
        $product    = Product::findOrFail($this->product_id);
        return Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->inRandomOrder()->limit(5)->get();
    }

    public function render()
    {
        $data['similar_products']   = $this->getSimilarProducts();
        return view('livewire.front.detail.similar-product-section', $data);
    }
}