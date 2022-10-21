<?php

namespace App\Http\Livewire\Front\Shop;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Filter;
use App\Models\FilterValue;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopPage extends Component
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

    public function render()
    {

        $data['categories'] = Category::with(['subCategories'])->withCount('products')->parent()->get();

        $data['brands']     = Brand::withCount('products')->active()->get();

        $data['filters']    = Filter::with(['filterValues'])->active()->get();

        $data['products']   = Product::with('brand')->active()
            ->when($this->brandInputs, fn ($q)      => $q->whereIn('brand_id', $this->brandInputs))
            ->when($this->color, fn ($q)            => $q->where('color', $this->color))
            ->when($this->filter_column, fn ($q)    => $q->where($this->filter_column, $this->filter_value))
            ->whereBetween('price', [$this->min_price, $this->max_price])
            ->search(trim($this->search))
            ->orderBy($this->ordering, $this->sortBy)
            ->paginate($this->perPage);

        return view('livewire.front.shop.shop-page', $data)->layout('front.layouts.master');
    }
}