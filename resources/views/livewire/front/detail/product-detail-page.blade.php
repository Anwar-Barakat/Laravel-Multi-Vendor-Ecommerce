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
