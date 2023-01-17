<?php

namespace App\Http\Livewire\Admin\Banner;

use App\Models\Banner;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $status;
    public $banner_id;

    public function updateStatus($banner_id)
    {
        $banner =  Banner::findOrFail($banner_id);
        $banner->update(['status' => !$this->status]);
        $this->status = $banner->status;
    }

    public function render()
    {
        return view('livewire.admin.banner.update-status');
    }
}