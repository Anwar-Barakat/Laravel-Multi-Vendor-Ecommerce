<?php

namespace App\Http\Livewire\Front\Shop;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryProducts extends Component
{
    use WithPagination;

    public $clearFilter = false;
    public $perPage = 9, $ordering = 'name', $sortBy = 'asc', $search;
    public $url;
    public $brandInputs  = [];
    protected $queryString = [
        'brandInputs'   => ['except' => '', 'as' => 'brand'],
        'color'         => ['except' => '', 'as' => 'color'],
        'filter_column' => ['except' => '', 'as' => 'filter']
    ];
    public $min_price = 1, $max_price = 1000, $color = '';
    public $filter_column, $filter_value;

    public function mount($url)
    {
        $this->url = $url;
    }

    public function showClearFilters()
    {
        $this->clearFilter = true;
    }

    public function clearFiltering()
    {
        $this->reset([
            'search', 'ordering', 'sortBy', 'perPage',
            'brandInputs', 'min_price', 'max_price', 'color',
            'filter_column', 'filter_value'
        ]);
        $this->clearFilter = false;
    }

    public function filtering($filter_column, $filter_value)
    {
        $this->filter_column    = $filter_column;
        $this->filter_value     = $filter_value;
    }


    public function addToWishList($id, $name, $qty = 1, $price)
    {
        Cart::instance('wishlist')->add($id, $name, 1, $price)->associate('App\Models\Product');
        $this->emit('updateWishListCount', Cart::instance('wishlist')->count());
        toastr()->success('Product Has Been Added Successfully to Cart');
    }

    public function render()
    {
        $category                   = Category::where(['url'    => $this->url])->active()->count();
        $category > 0               ? $data['categoryDetails']  = Category::categoryDetails($this->url) : abort(404);
        $data['selectedCategory']   = $data['categoryDetails']['category'];

        $data['categories']         = Category::with(['subCategories'])->withCount('products')->parent()->get();

        $data['filters']            = Filter::with(['filterValues'])->active()->get();

        $data['products']           = Product::with('brand')
            ->whereIn('category_id', $data['categoryDetails']['catIds'])
            ->when($this->color, fn ($q)                    => $q->where('color', $this->color))
            ->when($this->filter_column, fn ($q)            => $q->where($this->filter_column, $this->filter_value))
            ->whereBetween('price', [$this->min_price, $this->max_price])
            ->active()
            ->when($this->brandInputs, fn ($q)              => $q->whereIn('brand_id', $this->brandInputs))
            ->search(trim($this->search))
            ->orderBy($this->ordering, $this->sortBy)
            ->paginate($this->perPage);

        $data['brands']             = [];
        $categoryProducts           = Product::whereIn('category_id', $data['categoryDetails']['catIds'])->get();
        foreach ($categoryProducts as $product) {
            if (!in_array($product->brand, $data['brands'])) {
                $data['brands'][]   = $product->brand;
            }
        }

        return view('livewire.front.shop.category-products', $data)->layout('front.layouts.master');
    }
}