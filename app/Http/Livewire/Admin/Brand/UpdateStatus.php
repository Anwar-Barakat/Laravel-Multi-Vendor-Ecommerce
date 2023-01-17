<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $status;
    public $brand_id;

    public function updateStatus($brand_id)
    {
        $brand =  Brand::findOrFail($brand_id);
        $brand->update(['status' => !$this->status]);
        $this->status = $brand->status;
    }

    public function render()
    {
        return view('livewire.admin.brand.update-status');
    }
}