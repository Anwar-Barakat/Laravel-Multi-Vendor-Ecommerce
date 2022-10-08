<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $status;
    public $category_id;

    public function updateStatus($category_id)
    {
        $category =  Category::findOrFail($category_id);
        if ($category->status == '1') :
            $category->update(['status' => '0']);
        else :
            $category->update(['status' => '1']);
        endif;
        $this->status = $category->status;
    }

    public function render()
    {
        return view('livewire.admin.category.update-status');
    }
}