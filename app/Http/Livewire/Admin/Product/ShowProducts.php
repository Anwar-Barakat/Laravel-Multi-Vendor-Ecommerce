<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts extends Component
{
    use WithPagination;

    public $bySection = null,
        $byCategory = null,
        $byBrand = null,
        $byAdmin = null,
        $search,
        $byOrder = 'name',
        $BySort = 'asc';
    public function render()
    {
        $data['sections']   = Section::activeSections();
        $data['brands']     = Brand::active()->get();
        $data['admins']     = Admin::active()->get();

        $data['products']   = Product::when($this->bySection, fn ($q) => $q->where('section_id', $this->bySection))
            ->when($this->byCategory, fn ($q) => $q->where('category_id', $this->byCategory))
            ->when($this->byBrand, fn ($q) => $q->where('brand_id', $this->byBrand))
            ->when($this->byAdmin, fn ($q) => $q->where('admin_id', $this->byAdmin))
            ->search(trim($this->search))
            ->active()
            ->orderBy($this->byOrder, $this->BySort)
            ->paginate(9);

        return view('livewire.admin.product.show-products', $data);
    }
}