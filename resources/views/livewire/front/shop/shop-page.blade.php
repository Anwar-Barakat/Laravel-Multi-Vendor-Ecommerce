@push('styles')
    <!-- noUiSlider  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.css">
    <!-- custome colors -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom/colors.css') }}">
@endpush

@section('title', 'Shop Page')
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
            <div class="row ">
                <div class="col-lg-3 col-md-3 col-sm-12 shop-filter-menu">
                    <div class="fetch-categories img-thumbnail filtering-padding">
                        <h3 class="title-name">Browse Categories</h3>
                        @foreach ($categories as $category)
                            @php
                                $catProductsCount = App\Models\Category::categoryProductsCount($category->id);
                            @endphp
                            @if ($catProductsCount > 0)
                                <h3 class="fetch-mark-category">
                                    <a href="{{ route('front.shop.category.products', ['url' => $category->url]) }}">
                                        {{ ucwords($category->name) }}
                                        ({{ $catProductsCount }})
                                        <span class="total-fetch-items"></span>
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
                            @endif
                        @endforeach
                    </div>
                    <div class="facet-filter-associates img-thumbnail filtering-padding">
                        <h3 class="title-name">Brand</h3>
                        <div class="associate-wrapper">
                            @foreach ($brands as $brand)
                                @if ($brand->products_count > 0)
                                    <input type="checkbox" class="check-box" id="cbs-{{ $brand->id }}" value="{{ $brand->id }}" wire:model="brandInputs" wire:change="showClearFilters">
                                    <label class="label-text" for="cbs-{{ $brand->id }}">{{ ucwords($brand->name) }}
                                        <span class="total-fetch-items">({{ $brand->products_count }})</span>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="facet-filter-associates img-thumbnail filtering-padding">
                        <h3 class="title-name">Colors</h3>
                        <div class="associate-wrapper colors">
                            @foreach (App\Models\Product::COLORS as $item)
                                <input type="radio" name="color" id="{{ $item }}" value="{{ $item }}" wire:model="color" wire:change="showClearFilters" />
                                <label for="{{ $item }}"><span class="{{ $item }}"></span></label>
                            @endforeach
                        </div>
                    </div>
                    <div class="facet-filter-by-price p-2">
                        <h3 class="title-name">
                            Price : &nbsp;
                            <span class="text-blue-600">
                                ${{ $min_price }} - ${{ $max_price }}</span>
                        </h3>
                        <div id="slider" wire:ignore wire:change="showClearFilters">

                        </div>
                    </div>
                    <br>
                    @if ($filters)
                        @foreach ($filters as $filter)
                            <div class="facet-filter-associates img-thumbnail filtering-padding">
                                <h3 class="title-name">{{ ucwords($filter->filter_name) }}</h3>
                                <div class="associate-wrapper">
                                    @foreach ($filter->filterValues as $filterValue)
                                        <input type="radio" class="check-box" id="filter{{ $filterValue->id }}" value="{{ $filterValue->id }}" wire:click="filtering('{{ $filter->filter_column }}','{{ $filterValue->filter_value }}')" wire:change="showClearFilters">
                                        <label class="label-text" for="filter{{ $filterValue->id }}">
                                            {{ $filterValue->filter_value }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div>
                        <img src="{{ asset('assets/img/banners/shop.jpg') }}" alt="" class="img img-thumbnail category-shadow object-cover" width="100%`" style="max-height: 315px; object-fit: cover">
                    </div>
                    <div class="shop-intro">
                        <ul class="bread-crumb">
                            All Products
                        </ul>
                        <p class="text-xs color-gray-400 mt-1">{{ $category->description }}</p>
                        @if ($clearFilter)
                            <button wire:click="clearFiltering" class="clear-filters text-sm bg-red-700 text-white px-4 py-1 rounded shadow-md focus:border-none focus:outline-none">
                                Clear Filters</button>
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
                                    <select class="select-box" id="sort-by" wire:model="ordering" wire:change="showClearFilters">
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
                                    <select class="select-box" id="show-records" wire:model="perPage" wire:change="showClearFilters">
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
                                    <input type="search" class="select-box" placeholder="Search..." wire:model.debounce.350ms="search" wire:keyup="showClearFilters">
                                </div>
                            </div>
                            <div class="toolbar-sorter-2">
                                <div class="select-box-wrapper">
                                    <label class="sr-only" for="show-records">Sort By</label>
                                    <select class="select-box" id="show-records" wire:model="sortBy" wire:change="showClearFilters">
                                        <option value="asc" selected>Sort By: ASC</option>
                                        <option value="desc">Sort By: DESC</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-container list-style">
                        @php
                            $wishItems = Cart::instance('wishlist')
                                ->content()
                                ->pluck('id');
                        @endphp
                        @forelse ($products as $product)
                            @php
                                $dataPrices = App\Models\Product::applyDiscount($product->id, $product->price);
                            @endphp
                            <div class="product-item col-lg-4 col-md-6 col-sm-6">
                                <div class="item main-shadow">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="{{ route('front.product.detail', ['product' => $product]) }}">
                                            <img class="img-fluid" src="{{ $product->getFirstMediaUrl('main_img_of_product') }}" alt="{{ ucwords($product->name) }}">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick
                                                Look</a>
                                            <a class="item-mail" href="javascript:void(0)">Mail</a>
                                            @if ($wishItems->contains($product->id))
                                                <a class="item-addwishlist active" href="{{ route('front.wishlist') }}">
                                                    Add to
                                                    Wishlist</a>
                                            @else
                                                <a class="item-addwishlist" href="#" wire:click.prevent="addToWishList({{ $product->id }},'{{ $product->name }}',1,{{ $dataPrices['final_price'] }})">Add
                                                    to
                                                    Wishlist</a>
                                            @endif
                                            <a class="item-addCart" href="{{ route('front.product.detail', ['product' => $product]) }}">Add
                                                to Cart</a>
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
                                                <a href="{{ route('front.product.detail', ['product' => $product]) }}">{{ ucwords($product->name) }}</a>
                                            </h6>
                                            <div class="item-description">
                                                <p>{{ $product->description }} </p>
                                            </div>
                                            @php
                                                $data = App\Models\ProductRating::getAverageRating($product->id);
                                            @endphp
                                            <div class="item-stars">
                                                @if ($data['rating_count'] > 0)
                                                    <div title="{{ $data['average_rating'] }} out of 5 - based on {{ $data['rating_count'] }} Reviews" class="flex items-center gap-1">
                                                        @php
                                                            $star = 1;
                                                        @endphp
                                                        @while ($star <= $data['average_rating_star'])
                                                            <span class="text-yellow-500 font-bold text-lg">&#9733;</span>
                                                            @php
                                                                $star++;
                                                            @endphp
                                                        @endwhile
                                                        <span>({{ $data['average_rating'] }})</span>
                                                    </div>
                                                @else
                                                    <div title="0 out of 5 - based on 0 Reviews" class="flex items-center gap-1">
                                                        <span class="font-bold text-lg">&star;</span>
                                                        <span>(0)</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="price-template">
                                            <div class="item-new-price">
                                                ${{ $dataPrices['final_price'] }}
                                            </div>
                                            @if ($dataPrices['discount'] > 0)
                                                <div class="item-old-price">
                                                    ${{ $product->price }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        @if ($product->is_best_seller)
                                            <div class="tag sale">
                                                <span>SALE</span>
                                            </div>
                                        @elseif($product->is_featured)
                                            <div class="tag hot">
                                                <span>HOT</span>
                                            </div>
                                        @elseif ($product->discount > 0 && $product->category->discount > 0)
                                            <div class="tag discount">
                                                <span>-%{{ $product->discount > 0 ? $product->discount : $product->category->discount }}</span>
                                            </div>
                                        @elseif ($product->created_at > date('Y-m-d', strtotime('-8 days')) && $product->created_at < date('Y-m-d'))
                                            <div class="tag new">
                                                <span>New</span>
                                            </div>
                                        @else
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


@push('scripts')
    <!-- noUiSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.js"></script>

    <script>
        var slider = document.getElementById('slider')
        noUiSlider.create(slider, {
            start: [1, 1000],
            connect: true,
            range: {
                'min': 1,
                'max': 1000
            },
            pips: {
                mode: 'steps',
                stepped: true,
                density: 4
            }
        });
        slider.noUiSlider.on('update', function(value) {
            @this.set('min_price', value[0]);
            @this.set('max_price', value[1]);
        });
    </script>
@endpush
