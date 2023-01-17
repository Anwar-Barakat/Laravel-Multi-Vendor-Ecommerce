<?php

namespace App\Http\Livewire\Admin\Section;

use App\Models\Section;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $status, $section_id;

    public function updateStatus($section_id)
    {
        $section =  Section::findOrFail($section_id);
        $section->update(['status' => !$this->status]);
        $this->status = $section->status;
    }

    public function render()
    {
        return view('livewire.admin.section.update-status');
    }
}