<?php

namespace App\Http\Livewire\Front;

use App\Models\Product;
use App\Models\Section;
use Livewire\Component;
use Cart;

class MainHeader extends Component
{
    public $search = '', $card_amount, $total_price;

    protected $listeners    = ['updateCardAmount' => 'updateCardAmount', 'updateCardTotal' => 'updateCardTotal'];

    public function mount()
    {
        $this->card_amount  = Cart::count();
        $this->total_price  = Cart::total();
    }

    public function updateCardAmount($count)
    {
        $this->card_amount  = $count;
    }

    public function updateCardTotal($total)
    {
        $this->total_price  = $total;
    }

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