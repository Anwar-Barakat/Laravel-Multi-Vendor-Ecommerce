<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Filter;
use App\Models\Section;
use Livewire\Component;

class GetCategoryFilters extends Component
{
    public $category, $selectedCategoryId, $allFilters, $filter_id;

    public $product;

    public function updatedCategory($category_id)
    {
        $this->allFilters           = Filter::with(['filterValues'])->active()->get();
        $this->selectedCategoryId   = $category_id;
    }

    public function render()
    {
        $data['sections']       = Section::with(['categories'])->get();
        return view('livewire.admin.product.get-category-filters', $data);
    }
}
