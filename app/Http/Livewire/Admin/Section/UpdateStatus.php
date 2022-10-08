<?php

namespace App\Http\Livewire\Admin\Section;

use App\Models\Section;
use Livewire\Component;

class UpdateStatus extends Component
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
        return view('livewire.admin.section.update-status');
    }
}