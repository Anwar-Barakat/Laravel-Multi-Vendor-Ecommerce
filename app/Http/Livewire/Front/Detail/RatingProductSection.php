<?php

namespace App\Http\Livewire\Front\Detail;

use App\Models\ProductRating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RatingProductSection extends Component
{
    use WithPagination;


    public $product_id;
    public $name, $email, $rating, $review;
    public $reviews;


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
        if (Auth::check()) {
            // $this->validate();

            $ratingExists   = ProductRating::where(['user_id' => Auth::user()->id, 'product_id' => $this->product_id])->count();
            if ($ratingExists > 0) {
                toastr()->info('Your Rating Already Exists For This Product');
                $this->reset();
            } else {
                ProductRating::create([
                    'user_id'       => Auth::user()->id,
                    'product_id'    => $this->product_id,
                    'review'        => $this->review,
                    'rating'        => $this->rating,
                ]);
                toastr()->success('Rating Has Been Added Successfully to This Product');
                $this->reset(['rating', 'review']);
            }
        } else {
            toastr()->info('Login First, Then Add Your Rating');
        }
    }

    public function render()
    {
        $data['rating_count']   = ProductRating::where('product_id', $this->product_id)->count();

        if ($data['rating_count'] > 0) {
            $data['rating_sum']     = ProductRating::ratingProduct($this->product_id)->sum('rating');
            $data['average_rating'] = round($data['rating_sum'] / $data['rating_count'], 2);
        } else {
            $data['average_rating'] = 0;
        }

        $this->reviews  =   ProductRating::where('product_id', $this->product_id)->get();

        return view('livewire.front.detail.rating-product-section', $data);
    }
}