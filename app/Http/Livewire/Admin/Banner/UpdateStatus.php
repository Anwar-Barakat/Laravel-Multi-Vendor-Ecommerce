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
        if ($banner->status == '1') :
            $banner->update(['status' => '0']);
        else :
            $banner->update(['status' => '1']);
        endif;
        $this->status = $banner->status;
    }

    public function render()
    {
        return view('livewire.admin.banner.update-status');
    }
}