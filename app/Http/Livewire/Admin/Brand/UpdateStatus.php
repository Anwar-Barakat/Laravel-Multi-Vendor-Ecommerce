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
        if ($brand->status == '1') :
            $brand->update(['status' => '0']);
        else :
            $brand->update(['status' => '1']);
        endif;
        $this->status = $brand->status;
    }

    public function render()
    {
        return view('livewire.admin.brand.update-status');
    }
}