<div>
    <header>
        <div class="full-layer-outer-header">
            <div class="container clearfix">
                <nav>
                    <ul class="primary-nav g-nav">
                        <li>
                            <a href="tel:+111222333">
                                <i class="fas fa-phone u-c-brand u-s-m-r-9"></i>
                                Telephone:+111-222-333</a>
                        </li>
                        <li>
                            <a href="mailto:info@sitemakers.in">
                                <i class="fas fa-envelope u-c-brand u-s-m-r-9"></i>
                                E-mail: info@sitemakers.in
                            </a>
                        </li>
                    </ul>
                </nav>
                <nav>
                    <ul class="secondary-nav g-nav">
                        <li>
                            <a>My Account
                                <i class="fas fa-chevron-down u-s-m-l-9"></i>
                            </a>
                            <ul class="g-dropdown" style="width:200px">
                                <li>
                                    <a href="cart.html">
                                        <i class="fas fa-cog u-s-m-r-9"></i>
                                        My Cart</a>
                                </li>
                                <li>
                                    <a href="wishlist.html">
                                        <i class="far fa-heart u-s-m-r-9"></i>
                                        My Wishlist</a>
                                </li>
                                <li>
                                    <a href="checkout.html">
                                        <i class="far fa-check-circle u-s-m-r-9"></i>
                                        Checkout</a>
                                </li>
                                <li>
                                    <a href="account.html">
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        Customer Login</a>
                                </li>
                                <li>
                                    <a href="account.html">
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        Vendor Login</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a>USD
                                <i class="fas fa-chevron-down u-s-m-l-9"></i>
                            </a>
                            <ul class="g-dropdown" style="width:90px">
                                <li>
                                    <a href="#" class="u-c-brand">($) USD</a>
                                </li>
                                <li>
                                    <a href="#">(£) GBP</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a>ENG
                                <i class="fas fa-chevron-down u-s-m-l-9"></i>
                            </a>
                            <ul class="g-dropdown" style="width:70px">
                                <li>
                                    <a href="#" class="u-c-brand">ENG</a>
                                </li>
                                <li>
                                    <a href="#">ARB</a>
                                </li>
                            </ul>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="full-layer-mid-header">
            <div class="container">
                <div class="row clearfix align-items-center">
                    <div class="col-lg-3 col-md-9 col-sm-6">
                        <div class="brand-logo text-lg-center">
                            <a href="{{ route('front.home') }}" class="logo d-flex align-items-center " target="_blank">
                                <img src="https://i.postimg.cc/QCyRWB1P/IMG-20220826-172957-743-removebg-preview.png"
                                    alt="IMG-20220826-172957-743-removebg-preview" class="app-brand-logo" />
                                <p>
                                    <span>Multi Vendor</span>
                                    <span>Store</span>
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-4 mt-4">
                        <form class="form-searchbox relative" x-data="{ isOpen: false }" @click.away="isOpen=false">
                            <input type="text" class="text-field" placeholder="Press / To Search .."
                                wire:model.debounce.350ms="search" @focus="isOpen=true"
                                @keydown.escape.window="isOpen=false" @keydown.shift.tap="isOpen=false" x-ref="search"
                                @keydown.tab="isOpen=false"
                                @keydown.window="
                                if(event.keyCode == 191){
                                    event.preventDefault();
                                    $refs.search.focus();
                                }
                            ">
                            <div class="absolute  w-full search-dropdown" x-show.transition.opacity="isOpen">
                                @if (isset($searchResults) && $searchResults != '')
                                    <ul class="mb-0">
                                        @forelse ($searchResults as $product)
                                            <li
                                                class="border-b border-gray-500 bg-white hover:bg-gray-300 transition ease-in-out px-4 py-2">
                                                <a href="" class=" flex items-center gap-4">
                                                    @if ($product->getFirstMediaUrl('main_img_of_product', 'small'))
                                                        <img src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}"
                                                            alt="{{ ucwords($product->name) }}" class="w-8">
                                                    @else
                                                        <img src="{{ asset('assets/img/6.jpg') }}"
                                                            alt="{{ ucwords($product->name) }}" class="w-8">
                                                    @endif
                                                    <span>{{ ucwords($product->name) }}</span>
                                                </a>
                                            </li>
                                        @empty
                                            <li class="border-b border-gray-500 bg-white hover:bg-gray-300 transition ease-in-out px-4 py-2"
                                                <a href="javascript:void(0);" class=" flex items-center justify-center">
                                                <span>No Results Found</span>
                                                </a>
                                            </li>
                                        @endforelse
                                    </ul>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <nav>
                            <ul class="mid-nav g-nav">
                                <li class="u-d-none-lg">
                                    <a href="index.html">
                                        <i class="ion ion-md-home u-c-brand"></i>
                                    </a>
                                </li>
                                <li class="u-d-none-lg">
                                    <a href="wishlist.html">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a id="mini-cart-trigger" href="{{ route('front.shopping.cart') }}">
                                        <i class="ion ion-md-basket"></i>
                                        <span class="item-counter">{{ Cart::count() ?? 0 }}</span>
                                        <span class="item-price">${{ number_format(Cart::total(), 2) ?? 0.0 }}</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed-responsive-container">
            <div class="fixed-responsive-wrapper">
                <button type="button" class="button fas fa-search" id="responsive-search"></button>
            </div>
            <div class="fixed-responsive-wrapper">
                <a href="wishlist.html">
                    <i class="far fa-heart"></i>
                    <span class="fixed-item-counter">4</span>
                </a>
            </div>
        </div>
        <div class="mini-cart-wrapper">
            <div class="mini-cart">
                <div class="mini-cart-header">
                    YOUR CART
                    <button type="button" class="button ion ion-md-close" id="mini-cart-close"></button>
                </div>
                <ul class="mini-cart-list">
                    <li class="clearfix">
                        <a href="single-product.html">
                            <img src="{{ asset('front/images/product/product@1x.jpg') }}" alt="Product">
                            <span class="mini-item-name">Product name</span>
                            <span class="mini-item-price">$100.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="single-product.html">
                            <img src="{{ asset('front/images/product/product@1x.jpg') }}" alt="Product">
                            <span class="mini-item-name">Product name</span>
                            <span class="mini-item-price">$100.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="single-product.html">
                            <img src="{{ asset('front/images/product/product@1x.jpg') }}" alt="Product">
                            <span class="mini-item-name">Product name</span>
                            <span class="mini-item-price">$100.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="single-product.html">
                            <img src="{{ asset('front/images/product/product@1x.jpg') }}" alt="Product">
                            <span class="mini-item-name">Product name</span>
                            <span class="mini-item-price">$100.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                </ul>
                <div class="mini-shop-total clearfix">
                    <span class="mini-total-heading float-left">Total:</span>
                    <span class="mini-total-price float-right">$400.00</span>
                </div>
                <div class="mini-action-anchors">
                    <a href="cart.html" class="cart-anchor">View Cart</a>
                    <a href="checkout.html" class="checkout-anchor">Checkout</a>
                </div>
            </div>
        </div>
        <!-- Mini Cart /- -->
        <!-- Bottom-Header -->
        <div class="full-layer-bottom-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="v-menu v-close">
                            <span class="v-title">
                                <i class="ion ion-md-menu"></i>
                                All Categories
                                <i class="fas fa-angle-down"></i>
                            </span>
                            <nav>
                                <div class="v-wrapper">
                                    <ul class="v-list animated fadeIn">
                                        @foreach ($sections as $section)
                                            <li class="js-backdrop">
                                                <a href="javascript:void(0);">
                                                    <i class="ion-ios-add-circle"></i>
                                                    {{ ucwords($section->name) }}
                                                    <i class="ion ion-ios-arrow-forward"></i>
                                                </a>
                                                <button class="v-button ion ion-md-add"></button>
                                                @if ($section->categories->count() > 0)
                                                    <div class="v-drop-right" style="width: 700px;">
                                                        <div class="row">
                                                            @foreach ($section->categories as $category)
                                                                <div class="col-lg-4">
                                                                    <ul class="v-level-2">
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('front.shop.category.products', ['url' => $category->url]) }}">
                                                                                {{ ucwords(str_replace('-', ' ', $category->name)) }}</a>
                                                                            <ul>
                                                                                @foreach ($category->subCategories as $sub)
                                                                                    <li>
                                                                                        <a
                                                                                            href="{{ route('front.shop.category.products', ['url' => $sub->url]) }}">
                                                                                            {{ ucwords(str_replace('-', ' ', $sub->name)) }}
                                                                                        </a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                        <li>
                                            <a class="v-more">
                                                <i class="ion ion-md-add"></i>
                                                <span>View More</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <ul class="bottom-nav g-nav u-d-none-lg">
                            <li>
                                <a href="listing-without-filters.html">New Arrivals
                                    <span class="superscript-label-new">NEW</span>
                                </a>
                            </li>
                            <li>
                                <a href="listing-without-filters.html">Best Seller
                                    <span class="superscript-label-hot">HOT</span>
                                </a>
                            </li>
                            <li>
                                <a href="listing-without-filters.html">Featured
                                </a>
                            </li>
                            <li>
                                <a href="listing-without-filters.html">Discounted
                                    <span class="superscript-label-discount">-30%</span>
                                </a>
                            </li>
                            <li class="mega-position">
                                <a>More
                                    <i class="fas fa-chevron-down u-s-m-l-9"></i>
                                </a>
                                <div class="mega-menu mega-3-colm">
                                    <ul>
                                        <li class="menu-title">COMPANY</li>
                                        <li>
                                            <a href="about.html" class="u-c-brand">About Us</a>
                                        </li>
                                        <li>
                                            <a href="contact.html">Contact Us</a>
                                        </li>
                                        <li>
                                            <a href="faq.html">FAQ</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="menu-title">COLLECTION</li>
                                        <li>
                                            <a href="cart.html">Men Clothing</a>
                                        </li>
                                        <li>
                                            <a href="checkout.html">Women Clothing</a>
                                        </li>
                                        <li>
                                            <a href="account.html">Kids Clothing</a>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="menu-title">ACCOUNT</li>
                                        <li>
                                            <a href="#">My Account</a>
                                        </li>
                                        <li>
                                            <a href="#">My Profile</a>
                                        </li>
                                        <li>
                                            <a href="listing.html">My Orders</a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom-Header /- -->
    </header>

</div>
