<?php

namespace App\Http\Livewire\Admin\Admin;

use App\Mail\Admin\ApprovedVendorAccountt;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $status;
    public $admin_id;

    public function updateStatus($admin_id)
    {
        $admin =  Admin::findOrFail($admin_id);
        if ($admin->status == '1') :
            Mail::to($admin->email)->send(new ApprovedVendorAccountt($admin));
            $admin->update(['status' => '0']);
            $admin->vendor->update(['status' => '0']);

        else :
            $admin->update(['status' => '1']);
            $admin->vendor->update(['status' => '1']);
        endif;
        $this->status = $admin->status;
    }

    public function render()
    {
        return view('livewire.admin.admin.update-status');
    }
}