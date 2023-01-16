<div>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>{{ ucwords($vendor->businessInfo->shop_name) }}</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    {{ ucwords($vendor->businessInfo->shop_name) }}
                </ul>
            </div>
        </div>
    </div>
    <div class="page-shop pt-4">
        <div class="container">
            <div class="row ">
                <div class="col-sm-12">
                    <div class="page-bar clearfix">
                        <div class="shop-settings">
                            <a id="list-anchor">
                                <i class="fas fa-th-list"></i>
                            </a>
                            <a id="grid-anchor" class="active">
                                <i class="fas fa-th"></i>
                            </a>
                        </div>
                    </div>
                    <div class="row product-container grid-style">
                        @forelse ($products as $product)
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
                                                <a href="{{ route('front.product.detail', ['product' => $product]) }}">{{ ucwords($product->name) }}</a>
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
                                        @elseif ($product->created_at > date('Y-m-d', strtotime('-8 days')) && $product->created_at < date('Y-m-d'))
                                            <div class="tag new">
                                                <span>New</span>
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
