<div>
    @if (count($similar_products) > 0)
        <section class="section-maker">
            <div class="container">
                <div class="sec-maker-header text-center">
                    <h3 class="sec-maker-h3">Similar Products</h3>
                </div>
                <div class="slider-fouc">
                    <div class="products-slider owl-carousel" data-item="4">
                        @foreach ($similar_products as $product)
                            <x-product-block :product="$product" type="similar" />
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
