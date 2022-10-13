<?php

namespace App\Http\Livewire\Admin\Product\FilterValue;

use App\Models\FilterValue;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $status, $filter_value_id;

    public function updateStatus($filter_value_id)
    {
        $filter_value           =  FilterValue::findOrFail($filter_value_id);
        if ($filter_value->status == '1') :
            $filter_value->update(['status' => '0']);
        else :
            $filter_value->update(['status' => '1']);
        endif;
        $this->status           = $filter_value->status;
    }

    public function render()
    {
        return view('livewire.admin.product.filter-value.update-status');
    }
}