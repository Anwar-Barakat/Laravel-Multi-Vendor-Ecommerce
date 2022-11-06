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
        $data['product']            = Product::with([
            'section', 'category', 'brand', 'admin',
            'attributes' => fn ($q) => $q->where('stock', '>', 0)->where('status', '1')
        ])->findOrFail($this->productId);

        $data['totalStock']         = Attribute::where(['product_id' => $data['product']->id, 'status' => '1'])->sum('stock');
        $data['similar_products']   = Product::where('category_id', $data['product']->category_id)->where('id', '!=', $data['product']->id)->inRandomOrder()->limit(5)->get();
        $data['filters']            = Filter::with(['filterValues'])->active()->get();


        return view('livewire.front.detail.product-detail-page', $data)->layout('front.layouts.master');
    }
}