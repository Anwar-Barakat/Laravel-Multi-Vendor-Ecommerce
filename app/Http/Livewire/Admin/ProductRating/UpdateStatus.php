<?php

namespace App\Http\Livewire\Admin\ProductRating;

use App\Models\ProductRating;
use Livewire\Component;

class UpdateStatus extends Component
{
    public $status, $review_id;

    public function updateStatus($review_id)
    {
        $rating         =  ProductRating::findOrFail($review_id);
        $rating->update(['status' => !$this->status]);
        $this->status   = $rating->status;
    }


    public function render()
    {
        return view('livewire.admin.product-rating.update-status');
    }
}