<?php

namespace App\Http\Livewire\Front;

use App\Models\Section;
use Livewire\Component;

class MainHeader extends Component
{
    public function render()
    {
        $data['sections'] = Section::activeSections();
        return view('livewire.front.main-header', $data);
    }
}