<div>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Shop</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    All Products
                </ul>
            </div>
        </div>
    </div>
    <div class="page-shop pt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="fetch-categories img-thumbnail filtering-padding">
                        <h3 class="title-name">Browse Categories</h3>
                        @foreach ($categories as $category)
                            <h3 class="fetch-mark-category">
                                <a href="{{ route('front.shop.category.products', ['url' => $category->url]) }}">{{ ucwords($category->name) }}
                                    <span class="total-fetch-items">({{ $category->products_count }})</span>
                                </a>
                            </h3>
                            <ul>
                                @foreach ($category->subCategories as $sub)
                                    @if ($sub->products_count > 0)
                                        <li>
                                            <a href="{{ route('front.shop.category.products', ['url' => $sub->url]) }}">
                                                <i class="fas fa-chevron-circle-right"></i> &nbsp;
                                                {{ ucwords($sub->name) }}
                                                <span class="total-fetch-items">({{ $sub->products_count }})</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                    <div class="facet-filter-associates img-thumbnail filtering-padding">
                        <h3 class="title-name">Brand</h3>

                        <div class="associate-wrapper">
                            @foreach ($brands as $brand)
                                @if ($brand->products_count > 0)
                                    <input type="checkbox" class="check-box" id="cbs-{{ $brand->id }}"
                                        value="{{ $brand->id }}" wire:model="brandInputs">
                                    <label class="label-text" for="cbs-{{ $brand->id }}">{{ ucwords($brand->name) }}
                                        <span class="total-fetch-items">({{ $brand->products_count }})</span>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @if ($filters)
                        @foreach ($filters as $filter)
                            <div class="facet-filter-associates img-thumbnail filtering-padding">
                                <h3 class="title-name">{{ ucwords($filter->filter_name) }}</h3>
                                <div class="associate-wrapper">
                                    @foreach ($filter->filterValues as $filterValue)
                                        <input type="checkbox" class="check-box" id="filter{{ $filterValue->id }}"
                                            value="{{ $filterValue->id }}">
                                        <label class="label-text" for="filter{{ $filterValue->id }}">
                                            {{ $filterValue->filter_value }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="facet-filter-by-price">
                        <h3 class="title-name">Price</h3>
                        <form class="facet-form" action="#" method="post">
                            <!-- Final-Result -->
                            <div class="amount-result clearfix">
                                <div class="price-from">$0</div>
                                <div class="price-to">$3000</div>
                            </div>
                            <!-- Final-Result /- -->
                            <!-- Range-Slider  -->
                            <div class="price-filter"></div>
                            <!-- Range-Slider /- -->
                            <!-- Range-Manipulator -->
                            <div class="price-slider-range" data-min="0" data-max="5000" data-default-low="0"
                                data-default-high="3000" data-currency="$"></div>
                            <!-- Range-Manipulator /- -->
                            <button type="submit" class="button button-primary">Filter</button>
                        </form>
                    </div>
                    <div class="facet-filter-by-shipping">
                        <h3 class="title-name">Shipping</h3>
                        <form class="facet-form" action="#" method="post">
                            <input type="checkbox" class="check-box" id="cb-free-ship">
                            <label class="label-text" for="cb-free-ship">Free Shipping</label>
                        </form>
                    </div>
                    <div class="facet-filter-by-rating">
                        <h3 class="title-name">Rating</h3>
                        <div class="facet-form">
                            <!-- 5 Stars -->
                            <div class="facet-link">
                                <div class="item-stars">
                                    <div class='star'>
                                        <span style='width:76px'></span>
                                    </div>
                                </div>
                                <span class="total-fetch-items">(0)</span>
                            </div>
                            <!-- 5 Stars /- -->
                            <!-- 4 & Up Stars -->
                            <div class="facet-link">
                                <div class="item-stars">
                                    <div class='star'>
                                        <span style='width:60px'></span>
                                    </div>
                                </div>
                                <span class="total-fetch-items">& Up (5)</span>
                            </div>
                            <!-- 4 & Up Stars /- -->
                            <!-- 3 & Up Stars -->
                            <div class="facet-link">
                                <div class="item-stars">
                                    <div class='star'>
                                        <span style='width:45px'></span>
                                    </div>
                                </div>
                                <span class="total-fetch-items">& Up (0)</span>
                            </div>
                            <!-- 3 & Up Stars /- -->
                            <!-- 2 & Up Stars -->
                            <div class="facet-link">
                                <div class="item-stars">
                                    <div class='star'>
                                        <span style='width:30px'></span>
                                    </div>
                                </div>
                                <span class="total-fetch-items">& Up (0)</span>
                            </div>
                            <!-- 2 & Up Stars /- -->
                            <!-- 1 & Up Stars -->
                            <div class="facet-link">
                                <div class="item-stars">
                                    <div class='star'>
                                        <span style='width:15px'></span>
                                    </div>
                                </div>
                                <span class="total-fetch-items">& Up (0)</span>
                            </div>
                            <!-- 1 & Up Stars /- -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div>
                        <img src="{{ asset('assets/img/banners/banner-default.jpg') }}" alt=""
                            class="img img-thumbnail category-shadow" height="300">
                    </div>
                    <div class="shop-intro">
                        <ul class="bread-crumb">
                            All Products
                        </ul>
                        <p class="text-xs color-gray-400 mt-1">{{ $category->description }}</p>
                        @if ($clearFilter)
                            <button wire:click="clearFiltering"
                                class="text-sm bg-red-700 text-white px-4 py-1 rounded shadow-md focus:border-none focus:outline-none">
                                Clear
                                Filters</button>
                        @endif
                    </div>
                    <div class="page-bar clearfix">
                        <div class="shop-settings">
                            <a id="list-anchor" class="active">
                                <i class="fas fa-th-list"></i>
                            </a>
                            <a id="grid-anchor">
                                <i class="fas fa-th"></i>
                            </a>
                        </div>
                        <div class="flex lg:justify-end flex-wrap justify-between" style="gap: 1rem">
                            <div class="toolbar-sorter">
                                <div class="select-box-wrapper">
                                    <label class="sr-only" for="sort-by">Order By</label>
                                    <select class="select-box" id="sort-by" wire:model="ordering"
                                        wire:change="showClearFilters">
                                        <option value="name" selected>Order By : Name</option>
                                        <option value="price">Order By : Price</option>
                                        <option value="is_best_seller">Order By : Is Best Saller</option>
                                        <option value="created_at">Order By : Latest</option>
                                    </select>
                                </div>
                            </div>
                            <div class="toolbar-sorter-2">
                                <div class="select-box-wrapper">
                                    <label class="sr-only" for="show-records">Show Records Per Page</label>
                                    <select class="select-box" id="show-records" wire:model="perPage"
                                        wire:change="showClearFilters">
                                        <option value="3" selected>Show: 9</option>
                                        <option value="12">Show: 12</option>
                                        <option value="16">Show: 16</option>
                                        <option value="20">Show: 20</option>
                                    </select>
                                </div>
                            </div>
                            <div class="toolbar-sorter-2">
                                <div class="select-box-wrapper">
                                    <label class="sr-only" for="show-records">Search</label>
                                    <input type="search" class="select-box" placeholder="Search..."
                                        wire:model.debounce.350ms="search" wire:keyup="showClearFilters">
                                </div>
                            </div>
                            <div class="toolbar-sorter-2">
                                <div class="select-box-wrapper">
                                    <label class="sr-only" for="show-records">Sort By</label>
                                    <select class="select-box" id="show-records" wire:model="sortBy"
                                        wire:change="showClearFilters">
                                        <option value="asc" selected>Sort By: ASC</option>
                                        <option value="desc">Sort By: DESC</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-container list-style">
                        @forelse ($products as $product)
                            <div class="product-item col-lg-4 col-md-6 col-sm-6">
                                <div class="item main-shadow">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="single-product.html">
                                            <img class="img-fluid"
                                                src="{{ $product->getFirstMediaUrl('main_img_of_product') }}"
                                                alt="{{ ucwords($product->name) }}">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick
                                                Look</a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                            <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="what-product-is">
                                            <ul class="bread-crumb">
                                                <li class="has-separator">{{ $product->code }}</li>
                                                <li class="has-separator">{{ ucwords($product->color) }}</li>
                                                <li>{{ ucwords($product->brand->name) }}</li>
                                            </ul>
                                            <h6 class="text-gray-500 text-xs">{{ $product->created_at }}</h6>
                                            <h6 class="item-title">
                                                <a href="single-product.html">{{ ucwords($product->name) }}</a>
                                            </h6>
                                            <div class="item-description">
                                                <p>{{ $product->description }} </p>
                                            </div>
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
                                    <div>
                                        @if ($product->discount > 0 || $product->category->discount)
                                            <div class="tag discount">
                                                <span>-%{{ $product->discount > 0 ? $product->discount : $product->category->discount }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="product-item col-12 text-center">
                                <h1 style="var(--main-color)">No Items Found !!</h1>
                            </div>
                        @endforelse
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
