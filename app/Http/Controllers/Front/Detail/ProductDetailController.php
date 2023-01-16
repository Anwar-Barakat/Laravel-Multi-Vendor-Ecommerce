<?php

namespace App\Http\Controllers\Front\Detail;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function index(Product $product)
    {
        $data['product']        = $product;
        $data['filters']        = Filter::with(['filterValues'])->active()->get();
        $data['reviewsCount']   = ProductRating::where(['product_id' => $product->id])->active()->count();
        return view('front.details.index', $data);
    }
}