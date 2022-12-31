<?php

namespace App\Http\Livewire\Front\Thanks;

use Livewire\Component;

class ThanksPage extends Component
{
    public function mount()
    {
        if (!session()->has('orderId'))
            return redirect()->route('front.shopping.cart');
    }
    public function render()
    {
        return view('livewire.front.thanks.thanks-page')->layout('front.layouts.master');
    }
}