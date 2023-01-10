<div>
    @if ($viewProducts)
        <section class="section-maker">
            <div class="container">
                <div class="sec-maker-header text-center">
                    <h3 class="sec-maker-h3">Recently View</h3>
                </div>
                <div class="slider-fouc">
                    <div class="products-slider owl-carousel" data-item="4">
                        @foreach ($viewProducts as $product)
                            <x-product-block :product="$product" type="discount" />
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
