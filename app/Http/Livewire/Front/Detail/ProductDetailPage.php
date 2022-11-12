<?php

namespace App\Http\Livewire\Front\Detail;

use App\Models\Attribute;
use App\Models\Filter;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Cart;

class ProductDetailPage extends Component
{
    public $productId;

    public $size = 'small', $qty = 1, $discount, $final_price, $original_price;

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

    public function addToCart($id, $name, $qty, $price, $product_size)
    {
        Cart::destroy();
        Cart::add($id, $name, $qty, $price,  ['size' => $product_size])->associate('App\Models\Product');
        $this->emit('updateCardAmount', Cart::count());
        $this->emit('updateCardTotal', Cart::total());
        toastr()->success('Product Has Been Added Successfully to Cart');
    }

    public function render()
    {
        $data['product']            = Product::with([
            'section', 'category', 'brand', 'admin',
            'attributes'            => fn ($q)  => $q->where('stock', '>', 0)->where('status', '1')
        ])->findOrFail($this->productId);

        $data['totalStock']         = Attribute::where(['product_id' => $data['product']->id, 'status' => '1'])->sum('stock');
        $data['similar_products']   = Product::where('category_id', $data['product']->category_id)->where('id', '!=', $data['product']->id)->inRandomOrder()->limit(5)->get();
        $data['filters']            = Filter::with(['filterValues'])->active()->get();

        // get recently viewed products:
        if (empty(Session::get('session_id')))
            $session_id             = md5(uniqid(rand(), true));
        else
            $session_id             = Session::get('session_id');

        $data['ProductViewers']     = DB::table('product_views')->where(['product_id' => $data['product']->id, 'session_id' => $session_id])->count();
        if ($data['ProductViewers'] == 0)
            DB::table('product_views')->insert(['product_id' => $data['product']->id, 'session_id' => $session_id]);

        Session::put('session_id', $session_id);

        $viewedProductsIds          =  DB::table('product_views')->where('product_id', '!=', $data['product']->id)->where('session_id', $session_id)->inRandomOrder()->take(5)->pluck('product_id');
        if ($viewedProductsIds->count() > 0)
            $data['viewProducts']       = Product::whereIn('id', $viewedProductsIds)->get();

        // get group products :
        if ($data['product']->group_code != '')
            $data['groupProducts']      = Product::where('group_code', $data['product']->group_code)->where('id', '!=', $data['product']->id)->active()->inRandomOrder()->take(3)->get();

        return view('livewire.front.detail.product-detail-page', $data)->layout('front.layouts.master');
    }
}