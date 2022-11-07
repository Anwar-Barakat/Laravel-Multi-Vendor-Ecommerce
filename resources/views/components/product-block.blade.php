<div class="item">
    <div class="image-container">
        <a class="item-img-wrapper-link" href="{{ route('front.product.detail', $product->id) }}">
            <img class="img-fluid" src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}"
                alt="{{ ucwords($product->name) }}">
        </a>
        <div class="item-action-behaviors">
            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick
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
                    <a href="shop-v1-root-category.html">{{ $product->code }}</a>
                </li>
            </ul>
            <h6 class="item-title">
                <a href="{{ route('front.product.detail', $product->id) }}">{{ ucwords($product->name) }}</a>
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
    @if ($type == 'best_sale')
        <div class="tag sale">
            <span>SALE</span>
        </div>
    @elseif($type == 'featured')
        <div class="tag hot">
            <span>HOT</span>
        </div>
    @elseif ($type == 'discount' || $product->discount > 0 || $product->category->discount > 0)
        <div class="tag discount">
            <span>-%{{ $product->discount > 0 ? $product->discount : $product->category->discount }}</span>
        </div>
    @elseif ($type == 'latest' ||
        ($product->created_at > date('Y-m-d', strtotime('-8 days')) && $product->created_at < date('Y-m-d')))
        <div class="tag new">
            <span>New</span>
        </div>
    @endif
</div>
