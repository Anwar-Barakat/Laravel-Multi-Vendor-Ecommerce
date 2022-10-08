<?php

namespace App\Http\Livewire\Admin\Admin;

use App\Models\Admin;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $status;
    public $admin_id;

    public function updateStatus($admin_id)
    {
        $admin =  Admin::findOrFail($admin_id);
        if ($admin->status == '1') :
            $admin->update(['status' => '0']);
        else :
            $admin->update(['status' => '1']);
        endif;
        $this->status = $admin->status;
    }

    public function render()
    {
        return view('livewire.admin.admin.update-status');
    }
}