<?php

namespace App\Http\Livewire\Front\Detail;

use App\Models\Attribute;
use App\Models\Product;
use Livewire\Component;

class ProductDetailPage extends Component
{
    public $productId;

    public $size, $quantity = 1, $discount, $final_price, $original_price;

    public function mount($productId)
    {
        $this->productId    = $productId;

        $product                    = Product::findOrFail($this->productId);
        $this->original_price       = $product->price;

        if ($product->discount > 0) :
            $this->final_price      = $product->price - ($product->price * $product->discount / 100);
        elseif ($product->category->discount > 0) :
            $this->final_price      = $product->price - ($product->price * $product->category->discount / 100);
        else :
            $this->final_price      = $product->price;
        endif;

        $this->original_price       = $product->price;
        $this->discount             = Product::applyDiscount($this->productId);
    }

    public function updatedQuantity()
    {
        dd($this->quantity);
    }

    public function updatedSize()
    {
        $product                    = Product::with('category')->select('price', 'discount', 'category_id')->findOrFail($this->productId);
        $proAttr                    = Attribute::where(['product_id' => $this->productId, 'size' => $this->size])->first();

        if ($product->discount > 0) :
            $final_price            = $proAttr->price - ($proAttr->price * $product->discount / 100);
            $this->discount         = $product->discount;

        elseif ($product->category->discount > 0) :
            $final_price            = $proAttr->price - ($proAttr->price * $product->category->discount / 100);
            $this->discount         = $product->category->discount;
        else :
            $final_price            = $proAttr->price;
            $this->discount         = 0.00;
        endif;

        $this->original_price       = $proAttr->price;
        $this->final_price          = $final_price;
    }


    public function render()
    {
        $product    = Product::with([
            'section', 'category', 'brand',
            'attributes' => fn ($q) => $q->where('stock', '>', 0)->where('status', '1')
        ])->findOrFail($this->productId);

        $totalStock = Attribute::where(['product_id' => $product->id, 'status' => '1'])->sum('stock');

        return view('livewire.front.detail.product-detail-page', [
            'product'       => $product,
            'totalStock'    => $totalStock
        ])->layout('front.layouts.master');
    }
}