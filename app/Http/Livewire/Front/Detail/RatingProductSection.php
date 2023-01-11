<?php

namespace App\Http\Livewire\Front\Detail;

use App\Models\ProductRating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RatingProductSection extends Component
{
    public $product_id;
    public $name, $email, $rating, $review;

    protected $rules = [
        'rating'    => 'required',
        'review'    => 'required|min:10',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addRating()
    {
        $this->validate([
            'rating'    => 'required',
            'review'    => 'required|min:10',
        ]);
        if (Auth::check()) {
            $this->validate();

            $ratingExists   = ProductRating::where(['user_id' => Auth::user()->id, 'product_id' => $this->product_id])->first();
            if ($ratingExists->count() > 0)
                toastr()->info('Your Rating Already Exists For This Product');
            else {
                ProductRating::create([
                    'user_id'       => Auth::user()->id,
                    'product_id'    => $this->product_id,
                    'review'        => $this->review,
                    'rating'        => $this->rating,
                ]);
                toastr()->success('Rating Has Been Added Successfully to This Product');
            }
        } else {
            toastr()->info('Login First, Then Add Your Rating');
        }
    }

    public function render()
    {
        return view('livewire.front.detail.rating-product-section');
    }
}