<?php

namespace App\Http\Livewire\Admin\FilterValue;

use App\Models\FilterValue;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $status, $filter_value_id;

    public function updateStatus($filter_value_id)
    {
        $filter_value           =  FilterValue::findOrFail($filter_value_id);
        $filter_value->update(['status' => !$this->status]);
        $this->status           = $filter_value->status;
    }

    public function render()
    {
        return view('livewire.admin.filter-value.update-status');
    }
}