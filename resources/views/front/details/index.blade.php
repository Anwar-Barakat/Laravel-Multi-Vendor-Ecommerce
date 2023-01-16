<x-master-layout>
    @section('title', 'Details | ' . $product->name)
    @push('styles')
        <link rel="stylesheet" href="{{ asset('front/css/rating.css') }}">
    @endpush

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
                    @livewire('front.detail.product-detail-page', ['productId' => $product->id])
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
                                        <a class="nav-link" data-toggle="tab" href="#rating">Reviews ({{ $reviewsCount }})</a>
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
                                @livewire('front.detail.rating-product-section', ['product_id' => $product->id])
                                <!-- Reviews-Tab /- -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Detail-Tabs /- -->
                <!-- Different-Product-Section -->
                <div class="detail-different-product-section u-s-p-t-80">
                    @livewire('front.detail.similar-product-section', ['product_id' => $product->id])
                    @livewire('front.detail.most-viewed-product-section', ['product_id' => $product->id])
                </div>
                <!-- Different-Product-Section /- -->
            </div>
        </div>
    </div>

</x-master-layout>
