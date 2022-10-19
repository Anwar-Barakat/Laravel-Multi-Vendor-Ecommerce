<?php

namespace App\Http\Livewire\Front\Shop;

use App\Models\Category;
use App\Models\Filter;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryProducts extends Component
{
    use WithPagination;

    public $clearFilter = false;

    public $perPage = 3, $ordering = 'name', $sortBy = 'asc', $search;

    public $url;

    public function mount($url)
    {
        $this->url = $url;
    }


    public function render()
    {
        $category           = Category::where(['url'    => $this->url])->active()->count();
        $category > 0       ? $data['categoryDetails']  = Category::categoryDetails($this->url) : abort(404);
        $data['selectedCategory']   = $data['categoryDetails']['category'];

        $data['products']   = Product::whereIn('category_id', $data['categoryDetails']['catIds'])
            ->active()
            ->search(trim($this->search))
            ->orderBy($this->ordering, $this->sortBy)
            ->paginate($this->perPage);

        $data['categories'] = Category::with(['subCategories'])->withCount('products')->parent()->get();

        $data['filters']    = Filter::with(['filterValues'])->active()->get();


        return view('livewire.front.shop.category-products', $data)->layout('front.layouts.master');
    }

    public function showClearFilters()
    {
        $this->clearFilter = true;
    }

    public function clearFiltering()
    {
        $this->reset(['search', 'ordering', 'sortBy', 'perPage']);
        $this->clearFilter = false;
    }
}