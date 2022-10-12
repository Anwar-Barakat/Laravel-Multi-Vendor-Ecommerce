<?php

namespace App\Http\Livewire\Front;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class ShopPage extends Component
{
    use WithPagination;

    public $perPage = 9,
        $ordering = 'name',
        $sortBy = 'asc',
        $search;

    public function render()
    {
        Paginator::useTailwind();
        $data['products']   = Product::with(['brand'])
            ->where('status', 1)
            ->search(trim($this->search))
            ->orderBy($this->ordering, $this->sortBy)
            ->paginate($this->perPage);

        $data['categories'] = Category::with(['subCategories'])->withCount('products')->parent()->get();

        return view('livewire.front.shop-page', $data)->layout('front.layouts.master');
    }
}