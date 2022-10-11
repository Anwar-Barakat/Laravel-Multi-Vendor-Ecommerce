<?php

namespace App\Http\Livewire\Front;

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
        $data['products']   = Product::with(['category', 'brand'])
            ->where('status', 1)
            ->search(trim($this->search))
            ->orderBy($this->ordering, $this->sortBy)
            ->paginate($this->perPage);

        return view('livewire.front.shop-page', $data)->layout('front.layouts.master');
    }
}
