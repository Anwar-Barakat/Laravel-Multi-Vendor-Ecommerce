<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use App\Models\Section;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;

class EditCoupon extends Component
{
    public $coupon_option,
        $coupon_id,
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

    public function mount($coupon_id)
    {
        $this->coupon_id = $coupon_id;
        $coupon                 = Coupon::findOrFail($coupon_id);
        $this->coupon_option    = $coupon->coupon_option;
        $this->coupon_code      = $coupon->coupon_code;
        $this->categories       = explode(',', $coupon->categories);
        $this->users            = explode(',', $coupon->users);
        $this->coupon_type      = $coupon->coupon_type;
        $this->amount_type      = $coupon->amount_type;
        $this->amount           = $coupon->amount;
        $this->expiry_date      = $coupon->expiry_date;
    }

    public function updatedCouponOption()
    {
        $this->available = $this->coupon_option == 'manual' ? true : false;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $this->validate();
        try {
            $categories     = implode(',', $this->categories);
            $users          = implode(',', $this->users);

            $coupon         = Coupon::findOrFail($this->coupon_id);
            $coupon->coupon_option  = $this->coupon_option;
            $coupon->coupon_code    = $this->coupon_code ?? $coupon->coupon_code;
            $coupon->categories     = $categories;
            $coupon->users          = $users;
            $coupon->coupon_type    = $this->coupon_type;
            $coupon->amount_type    = $this->amount_type;
            $coupon->amount         = $this->amount;
            $coupon->expiry_date         = $this->expiry_date;
            $coupon->save();

            toastr()->success('Coupon Has Been Updated Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function render()
    {
        $sections       = Section::with('categories')->active()->get();
        $activeUsers    = User::active()->get();
        return view('livewire.admin.coupon.edit-coupon', ['sections' => $sections, 'activeUsers' => $activeUsers]);
    }
}