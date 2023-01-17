<?php

namespace App\Http\Livewire\Admin\Filter;

use App\Models\Filter;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $status, $filter_id;

    public function updateStatus($filter_id)
    {
        $filter         =  Filter::findOrFail($filter_id);
        $filter->update(['status' => !$this->status]);
        $this->status   = $filter->status;
    }

    public function render()
    {
        return view('livewire.admin.filter.update-status');
    }
}