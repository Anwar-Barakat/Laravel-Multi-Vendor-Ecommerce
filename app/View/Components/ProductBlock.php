<?php

namespace App\View\Components;

use App\Models\ProductRating;
use Illuminate\View\Component;

class ProductBlock extends Component
{
    public $product, $type;
    public $rating_count,
        $rating_sum,
        $average_rating,
        $average_rating_star;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product, $type)
    {
        $this->product  = $product;
        $this->type     = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->rating_count         = ProductRating::where('product_id', $this->product->id)->count();
        if ($this->rating_count > 0) {
            $this->rating_sum       = ProductRating::ratingProduct($this->product->id)->sum('rating');
            $this->average_rating   = round($this->rating_sum / $this->rating_count, 1);
            $this->average_rating_star  = round($this->rating_sum / $this->rating_count, 1);
        } else
            $this->average_rating   = 0;

        return view('components.product-block');
    }
}