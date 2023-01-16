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
        $this->reviews  = ProductRating::where('product_id', $this->product_id)->orderBy('rating', $this->sortBy)->latest()->get();
        $data           = ProductRating::getAverageRating($this->product_id);
        $this->emit('updateAverageRating', $data['average_rating']);

        return view('livewire.front.detail.rating-product-section', $data);
    }
}