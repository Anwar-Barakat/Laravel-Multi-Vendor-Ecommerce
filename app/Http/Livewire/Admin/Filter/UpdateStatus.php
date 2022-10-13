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
        if ($filter->status == '1') :
            $filter->update(['status' => '0']);
        else :
            $filter->update(['status' => '1']);
        endif;
        $this->status   = $filter->status;
    }

    public function render()
    {
        return view('livewire.admin.filter.update-status');
    }
}