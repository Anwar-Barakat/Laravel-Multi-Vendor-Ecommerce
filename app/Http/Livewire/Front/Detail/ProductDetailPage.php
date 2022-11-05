<?php

namespace App\Http\Livewire\Front\Detail;

use App\Models\Attribute;
use App\Models\Filter;
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

        if ($product->discount > 0)
            $this->final_price      = Product::discountingPrice($product->price, $product->discount);
        elseif ($product->category->discount > 0)
            $this->final_price      =  Product::discountingPrice($product->price, $product->category->discount);
        else
            $this->final_price      = $product->price;

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
            $this->final_price      = Product::discountingPrice($proAttr->price, $product->discount);
            $this->discount         = $product->discount;
        elseif ($product->category->discount > 0) :
            $this->final_price      = Product::discountingPrice($proAttr->price, $product->category->discount);
            $this->discount         = $product->category->discount;
        else :
            $this->final_price      = $proAttr->price;
            $this->discount         = 0.00;
        endif;

        $this->original_price       = $proAttr->price;
    }


    public function render()
    {
        $product    = Product::with([
            'section', 'category', 'brand',
            'attributes' => fn ($q) => $q->where('stock', '>', 0)->where('status', '1')
        ])->findOrFail($this->productId);


        return view('livewire.front.detail.product-detail-page', [
            'product'       => $product,
            'totalStock'    => Attribute::where(['product_id' => $product->id, 'status' => '1'])->sum('stock'),
            'filters'       => Filter::with(['filterValues'])->active()->get(),
        ])->layout('front.layouts.master');
    }
}