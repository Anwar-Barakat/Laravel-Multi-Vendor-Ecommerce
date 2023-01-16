<div class="item main-shadow">
    <div class="image-container">
        <a class="item-img-wrapper-link" href="{{ route('front.product.detail', ['product' => $product]) }}">
            <img class="img-fluid" src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}" alt="{{ ucwords($product->name) }}">
        </a>
        <div class="item-action-behaviors">
            <a class="item-addCart" href="{{ route('front.product.detail', ['product' => $product]) }}">Add to Cart</a>
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
                <a href="{{ route('front.product.detail', ['product' => $product]) }}">{{ ucwords($product->name) }}</a>
            </h6>
            <div class="item-stars">
                @if ($rating_count > 0)
                    <div title="{{ $average_rating }} out of 5 - based on {{ $rating_count }} Reviews" class="flex items-center gap-1">
                        @php
                            $star = 1;
                        @endphp
                        @while ($star <= $average_rating_star)
                            <span class="text-yellow-500 font-bold text-lg">&#9733;</span>
                            @php
                                $star++;
                            @endphp
                        @endwhile
                        <span>({{ $average_rating }})</span>
                    </div>
                @else
                    <div title="0 out of 5 - based on 0 Reviews" class="flex items-center gap-1">
                        <i class="far fa-star"></i>
                        <span>(0)</span>
                    </div>
                @endif
                <span class="block text-xm mt-1">{{ $product->created_at }}</span>
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
    @elseif ($type == 'discount' && $product->discount > 0 && $product->category->discount > 0)
        <div class="tag discount">
            <span>-%{{ $product->discount > 0 ? $product->discount : $product->category->discount }}</span>
        </div>
    @elseif ($type == 'latest' && $product->created_at > date('Y-m-d', strtotime('-8 days')) && $product->created_at < date('Y-m-d'))
        <div class="tag new">
            <span>New</span>
        </div>
    @else
    @endif
</div>
