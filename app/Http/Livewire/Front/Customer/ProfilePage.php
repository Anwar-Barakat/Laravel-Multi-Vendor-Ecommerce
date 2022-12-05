<?php

namespace App\Http\Livewire\Front\Customer;

use Livewire\Component;

class ProfilePage extends Component
{
    public function render()
    {
        return view('livewire.front.customer.profile-page')->layout('front.layouts.master');
    }
}