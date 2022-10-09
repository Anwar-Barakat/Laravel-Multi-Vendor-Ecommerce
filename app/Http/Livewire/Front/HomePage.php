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
        return view('livewire.front.home-page')->layout('front.layouts.master');
    }
}