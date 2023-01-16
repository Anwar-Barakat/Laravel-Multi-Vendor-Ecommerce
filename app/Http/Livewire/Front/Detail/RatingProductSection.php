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
    public $rating, $review;
    public $reviews;
    public $rating_count, $rating_sum, $average_rating;
    public  $sortBy  = 'asc';


    protected $rules = [
        'rating'    => 'required',
        'review'    => 'required|min:10',
    ];

    public function mount()
    {
        $this->reviews  =   ProductRating::where('product_id', $this->product_id)->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addRating()
    {
        if (Auth::check()) {
            $this->validate();

            $ratingExists   = ProductRating::where(['user_id' => Auth::user()->id, 'product_id' => $this->product_id])->count();
            if ($ratingExists > 0) {
                toastr()->info('Your Rating Already Exists For This Product');
                $this->reset(['rating', 'review']);
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

        $this->getReviews();
        return view('livewire.front.detail.rating-product-section');
    }

    public function getReviews()
    {
        $this->reviews          = ProductRating::where('product_id', $this->product_id)->orderBy('rating', $this->sortBy)->latest()->get();
        $this->rating_count     = ProductRating::where('product_id', $this->product_id)->count();

        if ($this->rating_count > 0) {
            $this->rating_sum   = ProductRating::ratingProduct($this->product_id)->sum('rating');
            $this->average_rating   = round($this->rating_sum / $this->rating_count, 2);
        } else {
            $this->average_rating   = 0;
        }
    }
}