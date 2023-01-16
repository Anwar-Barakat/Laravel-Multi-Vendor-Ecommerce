<?php

namespace App\Http\Controllers\Front\Detail;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function index(Product $product)
    {
        $filters    = Filter::with(['filterValues'])->active()->get();
        return view('front.details.index', ['product' => $product, 'filters' => $filters]);
    }
}