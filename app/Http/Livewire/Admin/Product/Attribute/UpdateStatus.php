<?php

namespace App\Http\Livewire\Admin\Product\Attribute;

use App\Models\Attribute;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $status;
    public $attribute_id;

    public function updateStatus($attribute_id)
    {
        $attribute =  Attribute::findOrFail($attribute_id);
        if ($attribute->status == '1') :
            $attribute->update(['status' => '0']);
        else :
            $attribute->update(['status' => '1']);
        endif;
        $this->status = $attribute->status;
    }

    public function render()
    {
        return view('livewire.admin.product.attribute.update-status');
    }
}