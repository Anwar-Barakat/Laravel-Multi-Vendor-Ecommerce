<div>
    <div class="default-height ph-item">
        <div class="slider-main owl-carousel">
            @forelse ($banners as $banner)
                <div class="bg-image">
                    <div class="slide-content">
                        <h1><img src="{{ $banner->getFirstMediaUrl('banners', 'slider') }}"></h1>
                        <h2>{{ ucwords($banner->title) }}</h2>
                    </div>
                </div>
            @empty
                <div class="bg-image">
                    <div class="slide-content">
                        <h1><img src="{{ asset('assets/img/media/banner-default.jpg') }}"></h1>
                        <h2>{{ ucwords($banner->title) }}</h2>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="banner-layer">
        <div class="container">
            <div class="image-banner">
                @php
                    $randomBanner = App\Models\Banner::where('status', 1)
                        ->inRandomOrder()
                        ->first();
                @endphp
                @if ($randomBanner)
                    <a target="_blank" rel="nofollow" href="{{ $randomBanner->link }}"
                        class="mx-auto banner-hover effect-dark-opacity">
                        <img class="img-fluid" src="{{ $randomBanner->getFirstMediaUrl('banners', 'slider') }}"
                            alt="{{ $randomBanner->title }}">
                    </a>
                @else
                    <a target="_blank" rel="nofollow" href="javascript:void(0);"
                        class="mx-auto banner-hover effect-dark-opacity">
                        <img class="img-fluid" src="{{ asset('assets/img/media/banner-default.jpg') }}" alt="">
                    </a>
                @endif
            </div>
        </div>
    </div>
    <section class="section-maker">
        <div class="container">
            <div class="sec-maker-header text-center">
                <h3 class="sec-maker-h3">TOP COLLECTION</h3>
                <ul class="nav tab-nav-style-1-a justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#men-latest-products">New Arrivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#men-best-selling-products">Best Sellers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#discounted-products">Discounted Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#men-featured-products">Featured Products</a>
                    </li>
                </ul>
            </div>

            <div class="wrapper-content">
                <div class="outer-area-tab">
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="men-latest-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    @foreach ($new_arrivals as $product)
                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link"
                                                    href="{{ route('front.product.detail', $product->id) }}">
                                                    <img class="img-fluid"
                                                        src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}"
                                                        alt="{{ ucwords($product->name) }}">
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal"
                                                        href="#quick-view">Quick
                                                        Look
                                                    </a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to
                                                        Wishlist</a>
                                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a
                                                                href="shop-v1-root-category.html">{{ $product->code }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a
                                                            href="{{ route('front.product.detail', $product->id) }}">{{ ucwords($product->name) }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                            <span style='width:67px'></span>
                                                        </div>
                                                        <span>(23)</span>
                                                    </div>
                                                </div>
                                                <div class="price-template">
                                                    @php
                                                        $final_price = App\Models\Product::applyDiscount($product->id);
                                                    @endphp
                                                    @if ($final_price > 0)
                                                        <div class="item-new-price">
                                                            ${{ $final_price }}
                                                        </div>
                                                        <div class="item-old-price">
                                                            ${{ $product->price }}
                                                        </div>
                                                    @else
                                                        <div class="item-new-price">
                                                            ${{ $product->price }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="tag new">
                                                <span>NEW</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane show fade" id="men-best-selling-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    @foreach ($best_sellers as $product)
                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link"
                                                    href="{{ route('front.product.detail', $product->id) }}">
                                                    <img class="img-fluid"
                                                        src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}"
                                                        alt="{{ ucwords($product->name) }}">
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal"
                                                        href="#quick-view">Quick
                                                        Look
                                                    </a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to
                                                        Wishlist</a>
                                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a
                                                                href="shop-v1-root-category.html">{{ $product->code }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a
                                                            href="{{ route('front.product.detail', $product->id) }}">{{ ucwords($product->name) }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star'
                                                            title="4.5 out of 5 - based on 23 Reviews">
                                                            <span style='width:67px'></span>
                                                        </div>
                                                        <span>(23)</span>
                                                    </div>
                                                </div>
                                                <div class="price-template">
                                                    @php
                                                        $final_price = App\Models\Product::applyDiscount($product->id);
                                                    @endphp
                                                    @if ($final_price > 0)
                                                        <div class="item-new-price">
                                                            ${{ $final_price }}
                                                        </div>
                                                        <div class="item-old-price">
                                                            ${{ $product->price }}
                                                        </div>
                                                    @else
                                                        <div class="item-new-price">
                                                            ${{ $product->price }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="tag sale">
                                                <span>SALE</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="discounted-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    @foreach ($discounted as $product)
                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link"
                                                    href="{{ route('front.product.detail', $product->id) }}">
                                                    <img class="img-fluid"
                                                        src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}"
                                                        alt="{{ ucwords($product->name) }}">
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal"
                                                        href="#quick-view">Quick
                                                        Look
                                                    </a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to
                                                        Wishlist</a>
                                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a
                                                                href="shop-v1-root-category.html">{{ $product->code }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a
                                                            href="{{ route('front.product.detail', $product->id) }}">{{ ucwords($product->name) }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star'
                                                            title="4.5 out of 5 - based on 23 Reviews">
                                                            <span style='width:67px'></span>
                                                        </div>
                                                        <span>(23)</span>
                                                    </div>
                                                </div>
                                                <div class="price-template">
                                                    @php
                                                        $final_price = App\Models\Product::applyDiscount($product->id);
                                                    @endphp
                                                    @if ($final_price > 0)
                                                        <div class="item-new-price">
                                                            ${{ $final_price }}
                                                        </div>
                                                        <div class="item-old-price">
                                                            ${{ $product->price }}
                                                        </div>
                                                    @else
                                                        <div class="item-new-price">
                                                            ${{ $product->price }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="tag discount">
                                                <span>-%{{ $product->discount > 0 ? $product->discount : $product->category->discount }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="men-featured-products">
                            <div class="slider-fouc">
                                <div class="products-slider owl-carousel" data-item="4">
                                    @foreach ($featured as $product)
                                        <div class="item">
                                            <div class="image-container">
                                                <a class="item-img-wrapper-link"
                                                    href="{{ route('front.product.detail', $product->id) }}">
                                                    <img class="img-fluid"
                                                        src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}"
                                                        alt="{{ ucwords($product->name) }}">
                                                </a>
                                                <div class="item-action-behaviors">
                                                    <a class="item-quick-look" data-toggle="modal"
                                                        href="#quick-view">Quick
                                                        Look
                                                    </a>
                                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                    <a class="item-addwishlist" href="javascript:void(0)">Add to
                                                        Wishlist</a>
                                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="item-content">
                                                <div class="what-product-is">
                                                    <ul class="bread-crumb">
                                                        <li>
                                                            <a
                                                                href="shop-v1-root-category.html">{{ $product->code }}</a>
                                                        </li>
                                                    </ul>
                                                    <h6 class="item-title">
                                                        <a
                                                            href="{{ route('front.product.detail', $product->id) }}">{{ ucwords($product->name) }}</a>
                                                    </h6>
                                                    <div class="item-stars">
                                                        <div class='star'
                                                            title="4.5 out of 5 - based on 23 Reviews">
                                                            <span style='width:67px'></span>
                                                        </div>
                                                        <span>(23)</span>
                                                    </div>
                                                </div>
                                                <div class="price-template">
                                                    @php
                                                        $final_price = App\Models\Product::applyDiscount($product->id);
                                                    @endphp
                                                    @if ($final_price > 0)
                                                        <div class="item-new-price">
                                                            ${{ $final_price }}
                                                        </div>
                                                        <div class="item-old-price">
                                                            ${{ $product->price }}
                                                        </div>
                                                    @else
                                                        <div class="item-new-price">
                                                            ${{ $product->price }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="tag discount">
                                                <span>-%{{ $product->discount > 0 ? $product->discount : $product->category->discount }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="banner-layer">
        <div class="container">
            <div class="image-banner">
                @php
                    $randomBanner = App\Models\Banner::where('status', 1)
                        ->inRandomOrder()
                        ->first();
                @endphp
                @if ($randomBanner)
                    <a target="_blank" rel="nofollow" href="{{ $randomBanner->link }}"
                        class="mx-auto banner-hover effect-dark-opacity">
                        <img class="img-fluid" src="{{ $randomBanner->getFirstMediaUrl('banners', 'slider') }}"
                            alt="{{ $randomBanner->title }}">
                    </a>
                @else
                    <a target="_blank" rel="nofollow" href="javascript:void(0);"
                        class="mx-auto banner-hover effect-dark-opacity">
                        <img class="img-fluid" src="{{ asset('assets/img/media/banner-default.jpg') }}"
                            alt="">
                    </a>
                @endif
            </div>
        </div>
    </div>
    <section class="app-priority">
        <div class="container">
            <div class="priority-wrapper u-s-p-b-80">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-star"></i>
                            </div>
                            <h2>
                                Great Value
                            </h2>
                            <p>We offer competitive prices on our 100 million plus product range</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-cash"></i>
                            </div>
                            <h2>
                                Shop with Confidence
                            </h2>
                            <p>Our Protection covers your purchase from click to delivery</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-ios-card"></i>
                            </div>
                            <h2>
                                Safe Payment
                            </h2>
                            <p>Pay with the world’s most popular and secure payment methods</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="single-item-wrapper">
                            <div class="single-item-icon">
                                <i class="ion ion-md-contacts"></i>
                            </div>
                            <h2>
                                24/7 Help Center
                            </h2>
                            <p>Round-the-clock assistance for a smooth shopping experience</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
