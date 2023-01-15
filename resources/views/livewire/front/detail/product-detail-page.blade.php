<div>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Details</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    Product Details
                </ul>
            </div>
        </div>
    </div>
    <div class="page-detail u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- Product-zoom-area -->
                    <div class="zoom-area">
                        @if ($product->getFirstMediaUrl('main_img_of_product', 'midium'))
                            <img id="zoom-pro" class="img-fluid" src="{{ $product->getFirstMediaUrl('main_img_of_product', 'midium') }}" data-zoom-image="{{ $product->getFirstMediaUrl('main_img_of_product', 'large') }}" alt="{{ ucwords($product->name) }}">

                            <div id="gallery" class="u-s-m-t-10">
                                <a class="" data-image="{{ $product->getFirstMediaUrl('main_img_of_product', 'large') }}" data-zoom-image="{{ $product->getFirstMediaUrl('main_img_of_product', 'large') }}">
                                    <img src="{{ $product->getFirstMediaUrl('main_img_of_product', 'midium') }}" alt="{{ ucwords($product->name) }}">
                                </a>
                                @if ($product->getMedia('product_attachments'))
                                    @foreach ($product->getMedia('product_attachments') as $image)
                                        <a class="" data-image="{{ $image->getUrl('large') }}" data-zoom-image="{{ $image->getUrl('large') }}">
                                            <img src="{{ $image->getUrl('midium') }}" alt="Product">
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        @else
                            <img id="zoom-pro" class="img-fluid" src="{{ asset('front/images/product/product@4x.jpg') }}" data-zoom-image="{{ asset('front/images/product/product@4x.jpg') }}" alt="{{ ucwords($product->name) }}">
                        @endif
                    </div>
                    <!-- Product-zoom-area /- -->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- Product-details -->
                    <div class="all-information-wrapper">
                        <div class="section-1-title-breadcrumb-rating u-s-p-y-14">
                            <div class="product-title">
                                <h1>
                                    <a href="single-product.html">{{ ucwords($product->name) }}</a>
                                </h1>
                            </div>
                            <ul class="bread-crumb">
                                <li class="has-separator">
                                    <a href="{{ route('front.home') }}">Home</a>
                                </li>
                                <li class="has-separator">
                                    <a href="javascript:;">{{ $product->section->name }}</a>
                                </li>
                                @if ($product->category->parent_id == '0')
                                    <li class="is-marked">
                                        <a href="{{ route('front.shop.category.products', $product->category->url) }}">
                                            {{ $product->category->name }}
                                        </a>
                                    </li>
                                @else
                                    @php
                                        $parent = $product->category->parentCategory;
                                    @endphp
                                    <li class='has-separator'>
                                        <a href="{{ route('front.shop.category.products', $parent->url) }}">
                                            {{ $parent->name }}
                                        </a>
                                    </li>
                                    <li class='is-marked'>
                                        <a href="{{ route('front.shop.category.products', $product->category->url) }}">
                                            {{ $product->category->name }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            @if ($rating_count > 0)
                                <div class="product-rating">
                                    <div class="inline-block" title="4.5 out of 5 - based on 23 Reviews">
                                        @php
                                            $star = 1;
                                        @endphp
                                        @while ($star <= $average_star_rating)
                                            <span class="text-yellow-500 font-bold text-lg">&#9733;</span>
                                            @php
                                                $star++;
                                            @endphp
                                        @endwhile
                                    </div>
                                    <span>({{ $average_rating }})</span>
                                </div>
                            @endif

                        </div>
                        <div class="section-3-price-original-discount u-s-p-y-14">
                            <div class="price">
                                <h4>${{ $final_price }}</h4>
                            </div>
                            @if ($discount > 0)
                                <div class="original-price">
                                    <span>Original Price:</span>
                                    <span>${{ $original_price }}</span>
                                </div>
                                <div class="discount-price">
                                    <span>Discount:</span>
                                    <span>{{ $discount }}%</span>
                                </div>
                                <div class="total-save">
                                    <span>Save:</span>
                                    <span>${{ $original_price - $final_price }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="section-3-price-original-discount u-s-p-y-14 table-wrapper ">
                            <h6 class="information-heading u-s-m-b-8">Currencies Coverted:</h6>
                            <table id="currencies-table">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Exchange Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (App\Models\Currency::active()->get() as $currency)
                                        <tr>
                                            <td>
                                                <div class="cart-price">
                                                    {{ $currency->code }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cart-price">
                                                    ${{ round($final_price / $currency->exchange_rate, 2) }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="section-4-sku-information u-s-p-y-14">
                            <h6 class="information-heading u-s-m-b-8">Sku Information:</h6>
                            <div class="availability">
                                <span>Availability:</span>
                                @if ($totalStock > 0)
                                    <span class="text-green-600 font-bold">In Stock</span>
                                @else
                                    <span class="text-red-600 font-bold">Out of Stock</span>
                                @endif
                            </div>
                            @if ($totalStock > 0)
                                <div class="left">
                                    <span>Only:</span>
                                    <span>{{ $totalStock }} left</span>
                                </div>
                            @endif
                            @if (!is_null($product->admin->vendor))
                                <p class="text-xs mt-3 text-capitalize">
                                    sold by :
                                    <a href="{{ route('vendor.products', $product->admin->id) }}" class="underline hover:underline hover:font-bold transition ">
                                        {{ $product->admin->vendor->businessInfo->shop_name }}
                                    </a>
                                </p>
                            @endif
                        </div>

                        <div class="section-5-product-variants u-s-p-y-14">
                            <h6 class="information-heading u-s-m-b-8">Product Variants:</h6>
                            <div class="color u-s-m-b-11">
                                @isset($groupProducts)
                                    <div class="flex gap-2">
                                        @foreach ($groupProducts as $product)
                                            <a href="{{ route('front.product.detail', $product->id) }}">
                                                <img src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}" alt="{{ $product->name }}" width="80" class="img img-thumbnail shadow-sm">
                                            </a>
                                        @endforeach
                                    </div>
                                @endisset
                            </div>
                            @if (count($product->attributes) > 0)
                                <div class="sizes u-s-m-b-11">
                                    <span>Available Size:</span>
                                    <div class="size-variant select-box-wrapper">
                                        <select class="select-box product-size" wire:model="size">
                                            @foreach ($product->attributes as $attr)
                                                <option value="{{ $attr->size }}">{{ ucwords($attr->size) }} ({{ $attr->stock }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            @if (Cart::instance('cart')->content()->where('id', $product->id)->count() > 0)
                                <span class="text-sm font-bold">
                                    Exists
                                    <span class="text-green-600 font-bold">In Cart</span>
                                </span>
                            @endif
                        </div>
                        <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                            <form class="post-form">
                                <div class="quick-social-media-wrapper u-s-m-b-22">
                                    <span>Share:</span>
                                    <ul class="social-media-list">
                                        <li>
                                            <a href="#">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fab fa-google-plus-g"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fas fa-rss"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fab fa-pinterest"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="quantity-wrapper u-s-m-b-22">
                                    <span>Quantity:</span>
                                    <div class="quantity">
                                        <input type="number" class="quantity-text-field" min="1" max="1000" wire:model="qty">

                                    </div>
                                </div>
                                <div>
                                    <button class="button button-outline-secondary" wire:click.prevent="addToCart({{ $product->id }},'{{ $product->name }}',{{ $qty }},{{ $final_price }},'{{ $size }}','{{ $product->code }}','{{ $product->color }}')">
                                        Add to cart
                                    </button>
                                    <button class="button button-outline-secondary far fa-heart u-s-m-l-6"></button>
                                    <button class="button button-outline-secondary far fa-envelope u-s-m-l-6"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Product-details /- -->
                </div>
            </div>
            <!-- Product-Detail /- -->
            <!-- Detail-Tabs -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="detail-tabs-wrapper u-s-p-t-80">
                        <div class="detail-nav-wrapper u-s-m-b-30">
                            <ul class="nav single-product-nav justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#specification">Specifications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#review">Reviews (15)</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <!-- Description-Tab -->
                            <div class="tab-pane fade active show" id="description">
                                <div class="description-whole-container">
                                    <p class="desc-p u-s-m-b-26">
                                        {{ $product->description }}
                                    </p>
                                    @if ($product->getFirstMediaUrl('main_video_of_product'))
                                        <video width="700" class="img img-thumbnail mb-4 admin-image" controls>
                                            <source src="{{ $product->getFirstMediaUrl('main_video_of_product') }}" type="video/mp4" class="img img-thumbnail img-activity">
                                            <source src="{{ $product->getFirstMediaUrl('main_video_of_product') }}" type="video/ogg" class="img img-thumbnail img-activity">
                                            {{ __('msgs.browser_error') }}
                                        </video>
                                    @endif
                                </div>
                            </div>
                            <!-- Description-Tab /- -->
                            <!-- Specifications-Tab -->
                            @if (count($filters) > 0)
                                <div class="tab-pane fade" id="specification">
                                    <div class="specification-whole-container">
                                        <div class="spec-table u-s-m-b-50">
                                            <h4 class="spec-heading">Product Information</h4>
                                            <table>
                                                @foreach ($filters as $filter)
                                                    @if (in_array($product->category_id, explode(',', $filter->category_ids)))
                                                        <tr>
                                                            <td>{{ ucwords($filter->filter_name) }}</td>
                                                            <td>
                                                                @foreach ($filter->filterValues as $filterValue)
                                                                    @if ($product[$filter->filter_column] == $filterValue->filter_value)
                                                                        {{ ucwords(str_replace('-', ' ', $filterValue->filter_value)) }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- Specifications-Tab /- -->
                            <!-- Reviews-Tab -->
                            {{-- @livewire('front.detail.rating-product-section', ['product_id' => $product->id]) --}}
                            <!-- Reviews-Tab /- -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Detail-Tabs /- -->
            <!-- Different-Product-Section -->
            <div class="detail-different-product-section u-s-p-t-80">
                {{-- @livewire('front.detail.similar-product-section', ['product_id' => $product->id]) --}}
                {{-- @livewire('front.detail.most-viewed-product-section', ['product_id' => $product->id]) --}}
            </div>
            <!-- Different-Product-Section /- -->
        </div>
    </div>
</div>
