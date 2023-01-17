<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $status;
    public $coupon_id;

    public function updateStatus($coupon_id)
    {
        $coupon =  Coupon::findOrFail($coupon_id);
        $coupon->update(['status' => !$this->status]);
        $this->status = $coupon->status;
    }

    public function render()
    {
        return view('livewire.admin.coupon.update-status');
    }
}