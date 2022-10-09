<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;

    public function render()
    {
        $section = Section::with(['allCategories'])->get();
        return view('livewire.front.home-page', ['section' => $section])->layout('front.layouts.master');
    }
}