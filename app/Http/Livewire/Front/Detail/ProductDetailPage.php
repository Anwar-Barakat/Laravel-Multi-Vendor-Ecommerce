<?php

namespace App\Http\Livewire\Front\Detail;

use App\Models\Attribute;
use App\Models\Currency;
use App\Models\Filter;
use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class ProductDetailPage extends Component
{
    public $productId;

    public $size = 'small', $qty = 1, $discount, $final_price, $original_price, $totalStock;

    public $currencies;


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
        $this->totalStock           = $this->getTotalStock($product);
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

    public function addToCart($id, $name, $qty, $price, $size, $code, $color)
    {
        if (!Auth::check()) {
            toastr()->info('Please Login to add Item to Your card');
        } else {
            $proAttr        = Attribute::where(['product_id' => $id, 'size' => $size])->first();
            $proAttrStock   = $proAttr->stock;

            if ($proAttrStock > $qty) {
                $proAttrStock       -= $qty;
                $this->totalStock   -= $qty;
                $proAttr->update(['stock' => $proAttrStock]);
                Cart::instance('cart')->add($id, $name, $qty, $price,  ['size' => $size, 'code' => $code, 'color' => $color])->associate('App\Models\Product');
                $this->updateHeader();
                toastr()->success('Product Has Been Added Successfully to Cart');
            } else {
                toastr()->info('Product Quntity is out of Stock');
            }
        }
    }

    public function updateHeader()
    {
        $this->emit('updateCardAmount', Cart::instance('cart')->count());
        $this->emit('updateCardTotal', Cart::instance('cart')->total());
    }

    public function getTotalStock($product)
    {
        return Attribute::where(['product_id' => $product->id, 'status' => '1'])->sum('stock');
    }


    public function getProductGroup($product)
    {
        if ($product->group_code != '')
            return Product::where('group_code', $product->group_code)->where('id', '!=', $product->id)->active()->inRandomOrder()->take(3)->get();
    }


    public function render()
    {
        $data['product']            = Product::with([
            'section', 'category', 'brand', 'admin',
            'attributes'            => fn ($q)  => $q->where('stock', '>', 0)->where('status', '1')
        ])->findOrFail($this->productId);

        $data['filters']            = Filter::with(['filterValues'])->active()->get();

        $data['groupProducts']      = $this->getProductGroup($data['product']);

        $data['rating_count']           = ProductRating::ratingProduct($data['product']->id)->count();
        if ($data['rating_count'] > 0) {
            $data['rating_sum']             = ProductRating::ratingProduct($data['product']->id)->sum('rating');
            $data['average_rating']         = round($data['rating_sum'] / $data['rating_count'], 2);
            $data['average_star_rating']    = round($data['rating_sum'] / $data['rating_count']);
        }

        return view('livewire.front.detail.product-detail-page', $data)->layout('front.layouts.master');
    }
}