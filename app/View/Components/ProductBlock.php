<?php

namespace App\View\Components;

use App\Models\ProductRating;
use Illuminate\View\Component;

class ProductBlock extends Component
{
    public $product, $type;

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
        $data   = ProductRating::getAverageRating($this->product->id);
        return view('components.product-block', $data);
    }
}