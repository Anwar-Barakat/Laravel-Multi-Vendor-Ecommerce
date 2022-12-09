<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Section;
use App\Models\User;
use Livewire\Component;

class AddCoupon extends Component
{

    public $coupon_option,
        $coupon_code,
        $available = false,
        $categories = [],
        $users = [],
        $amount = 0;


    public function updatedCouponOption()
    {
        $this->available = $this->coupon_option == 'manual' ? true : false;
    }

    public function render()
    {
        $sections   = Section::with('categories')->active()->get();
        $users      = User::active()->get();

        return view('livewire.admin.coupon.add-coupon', ['sections' => $sections, 'users' => $users]);
    }
}