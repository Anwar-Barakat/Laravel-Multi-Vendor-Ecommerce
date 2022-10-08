<?php

namespace App\Http\Livewire\Admin;

use App\Models\Section;
use Livewire\Component;

class UpdateSectionStatus extends Component
{
    public $status;
    public $section_id;

    public function updateStatus($section_id)
    {
        $section =  Section::findOrFail($section_id);
        if ($section->status == '1') :
            $section->update(['status' => '0']);
        else :
            $section->update(['status' => '1']);
        endif;
        $this->status = $section->status;
    }

    public function render()
    {
        return view('livewire.admin.update-section-status');
    }
}