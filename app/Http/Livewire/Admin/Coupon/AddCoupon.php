<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use App\Models\Section;
use App\Models\User;
use Livewire\Component;

class AddCoupon extends Component
{

    public $coupon_option,
        $coupon_code,
        $coupon_type,
        $available = false,
        $categories = [],
        $users = [],
        $amount,
        $amount_type,
        $expiry_date,
        $activeUsers;

    protected $rules =  [
        'coupon_option'     => ['required', 'string', 'min:3', 'max:30'],
        'coupon_code'       => ['min:6'],
        'coupon_type'       => ['required', 'in:single,multiple'],
        'categories'        => ['required', 'array'],
        'users'             => ['required', 'array'],
        'amount'            => ['required'],
        'amount_type'       => ['required', 'in:fixed,percentage'],
        'expiry_date'       => ['required'],
    ];

    public function mount()
    {
        $this->activeUsers = User::active()->get();
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function updatedCouponOption()
    {
        $this->available = $this->coupon_option == 'manual' ? true : false;
    }

    public function store()
    {
        $this->validate();
        try {
            Coupon::create();
        } catch (\Throwable $th) {
        }
    }

    public function render()
    {
        $sections   = Section::with('categories')->active()->get();


        return view('livewire.admin.coupon.add-coupon', ['sections' => $sections]);
    }
}