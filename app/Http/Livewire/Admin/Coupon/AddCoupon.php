<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use App\Models\Section;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;

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
        $expiry_date;

    protected $rules =  [
        'coupon_option'     => ['required', 'string', 'min:3', 'max:30'],
        'coupon_type'       => ['required', 'in:single,multiple'],
        'categories'        => ['required', 'array'],
        'users'             => ['required', 'array'],
        'amount'            => ['required'],
        'amount_type'       => ['required', 'in:fixed,percentage'],
        'expiry_date'       => ['required', 'date'],
    ];


    public function updatedCouponOption()
    {
        $this->available = $this->coupon_option == 'manual' ? true : false;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }


    public function store()
    {
        $this->validate();
        try {
            $categories     = implode(',', $this->categories);
            $users          = implode(',', $this->users);
            $code           = $this->coupon_option == 'automatic' ? Str::random(8) : $this->coupon_code;

            Coupon::create([
                'coupon_option'     => $this->coupon_option,
                'coupon_code'       => $code,
                'categories'        => $categories,
                'users'             => $users,
                'coupon_type'       => $this->coupon_type,
                'amount_type'       => $this->amount_type,
                'amount'            => $this->amount,
                'expiry_date'       => $this->expiry_date,
                'status'            => true,
            ]);

            toastr()->success('Coupon Has Been Added Successfully');
            $this->reset();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        $sections       = Section::with('categories')->active()->get();
        $activeUsers    = User::active()->get();
        return view('livewire.admin.coupon.add-coupon', ['sections' => $sections, 'activeUsers' => $activeUsers]);
    }
}