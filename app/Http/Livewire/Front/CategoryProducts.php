<?php

namespace App\Http\Livewire\Front;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryProducts extends Component
{
    use WithPagination;

    public $perPage = 9,
        $ordering = 'name',
        $sortBy = 'asc',
        $search;

    public $url;

    public function mount($url)
    {
        $this->url = $url;
    }

    public function render()
    {
        $category   = Category::where(['url' => $this->url])->active()->count();
        $category > 0 ? $categoryDetails = Category::categoryDetails($this->url) : abort(404);

        $data['products']   = Product::whereIn('category_id', $categoryDetails['catIds'])
            ->active()
            ->search(trim($this->search))
            ->orderBy($this->ordering, $this->sortBy)
            ->paginate($this->perPage);

        $data['categories'] = Category::with(['subCategories'])->withCount('products')->parent()->get();

        return view('livewire.front.shop-page', $data)->layout('front.layouts.master');
    }
}
