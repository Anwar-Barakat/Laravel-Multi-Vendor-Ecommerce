<?php

namespace App\Http\Livewire\Front\Vendor;

use App\Models\Product;
use App\Models\Vendor;
use Livewire\Component;
use Livewire\WithPagination;

class VendorProducts extends Component
{
    use WithPagination;

    public $vendor_id;

    public function mount($vendor_id)
    {
        $this->vendor_id = $vendor_id;
    }

    public function render()
    {
        $vendor     = Vendor::findOrFail($this->vendor_id);
        $products   = Product::where('admin_id', $vendor->id)->paginate(9);

        return view('livewire.front.vendor.vendor-products', [
            'vendor'        => $vendor,
            'products'      => $products,
        ])->layout('front.layouts.master');
    }
}