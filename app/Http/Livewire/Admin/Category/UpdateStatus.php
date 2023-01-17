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
        $category->update(['status' => !$this->status]);
        $this->status = $category->status;
    }

    public function render()
    {
        return view('livewire.admin.category.update-status');
    }
}