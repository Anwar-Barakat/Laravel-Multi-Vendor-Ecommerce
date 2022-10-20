<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Section;
use Livewire\Component;

class MainHeader extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults      = [];
        if (strlen($this->search) >= 1)
            $data['searchResults'] = Product::where('name', 'LIKE', '%' . $this->search . '%')
                ->inRandomOrder()->take(7)->get();

        $data['sections'] = Section::activeSections();
        return view('livewire.front.main-header', $data);
    }
}