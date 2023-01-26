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
    public $size = 'small', $qty = 1, $original_price, $final_price, $discount, $totalStock;
    public $currencies;
    public $average_rating, $average_rating_star;

    protected $listeners    = ['updateAverageRating', 'updateAverageRatingStar'];

    public function updateAverageRating($count)
    {
        $this->average_rating       = $count;
    }

    public function updateAverageRatingStar($total)
    {
        $this->average_rating_star  = $total;
    }

    public function mount($productId)
    {
        $this->productId            = $productId;
        $product                    = Product::findOrFail($productId);
        $this->getPrices($productId, $product->price);
        $this->totalStock           = $this->getTotalStock($productId);
    }

    public function getPrices($id, $price)
    {
        $this->original_price       = Product::applyDiscount($id, $price)['original_price'];
        $this->final_price          = Product::applyDiscount($id, $price)['final_price'];
        $this->discount             = Product::applyDiscount($id, $price)['discount'];
    }

    public function updatedSize()
    {
        $proAttr                    = Attribute::where(['product_id' => $this->productId, 'size' => $this->size])->first();
        $this->getPrices($this->productId, $proAttr->price);
    }

    public function addToCart($id, $name, $qty, $price, $size, $code, $color)
    {
        if (!Auth::check()) {
            toastr()->info('Please Login to add Item to Your card');
        } else {
            $proAttr        = Attribute::where(['product_id' => $id, 'size' => $size])->first();
            $proAttrStock   = $proAttr->stock;

            if ($proAttrStock >= $qty) {
                $proAttrStock       -= $qty;
                $this->totalStock   -= $qty;
                $proAttr->update(['stock' => $proAttrStock]);
                Cart::instance('cart')->add($id, $name, $qty, $price,  ['size' => $size, 'code' => $code, 'color' => $color])->associate('App\Models\Product');
                $this->updateHeader();
                toastr()->success('Product Has Been Added Successfully to Cart');
            } else
                toastr()->info('Product Quntity is out of Stock');
        }
    }

    public function updateHeader()
    {
        $this->emit('updateCardAmount', Cart::instance('cart')->count());
        $this->emit('updateCardTotal', Cart::instance('cart')->total());
    }

    public function getTotalStock($productId)
    {
        return Attribute::where(['product_id' => $productId, 'status' => '1'])->sum('stock');
    }


    public function getProductGroup($product)
    {
        if ($product->group_code != '')
            return Product::where('group_code', $product->group_code)->where('id', '!=', $product->id)->active()->inRandomOrder()->take(3)->get();
    }

    public function addToWishList($id, $name, $qty, $price)
    {
        Cart::instance('wishlist')->add($id, $name, 1, $price)->associate('App\Models\Product');
        $this->emit('updateWishListCount', Cart::instance('wishlist')->count());
        toastr()->success('Product Has Been Added Successfully to Cart');
    }

    public function render()
    {
        $data['product']            = Product::with(['section', 'category', 'brand', 'admin'])->findOrFail($this->productId);
        $data['attributes']     = Attribute::where('product_id', $data['product']->id)->where('stock', '>', 0)->where('status', '1')->get();

        $data['groupProducts']      = $this->getProductGroup($data['product']);

        $data['rating_count']           = ProductRating::ratingProduct($data['product']->id)->count();
        if ($data['rating_count'] > 0) {
            $data['rating_sum']             = ProductRating::ratingProduct($data['product']->id)->sum('rating');
            $this->average_rating           = round($data['rating_sum'] / $data['rating_count'], 1);
            $this->average_rating_star      = round($data['rating_sum'] / $data['rating_count']);
        }

        return view('livewire.front.detail.product-detail-page', $data)->layout('front.layouts.master');
    }
}