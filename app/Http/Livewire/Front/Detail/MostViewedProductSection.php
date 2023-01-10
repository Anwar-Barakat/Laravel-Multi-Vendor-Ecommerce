<?php

namespace App\Http\Livewire\Front\Detail;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class MostViewedProductSection extends Component
{
    public $product_id;
    public $viewProducts;


    public function getRecentViewed()
    {
        $id         = $this->product_id;

        $session_id = empty(Session::get('session_id')) ? md5(uniqid(rand(), true)) : Session::get('session_id');

        $data['ProductViewers']     = DB::table('product_views')->where(['product_id' => $id, 'session_id' => $session_id])->count();
        if ($data['ProductViewers'] == 0)
            DB::table('product_views')->insert(['product_id' => $id, 'session_id' => $session_id]);

        Session::put('session_id', $session_id);

        $viewedProductsIds          = DB::table('product_views')->where('product_id', '!=', $id)->where('session_id', $session_id)->inRandomOrder()->take(5)->pluck('product_id');
        if ($viewedProductsIds->count() > 0)
            return $this->viewProducts          = Product::whereIn('id', $viewedProductsIds)->get();
    }

    public function render()
    {
        $this->getRecentViewed();

        return view('livewire.front.detail.most-viewed-product-section');
    }
}