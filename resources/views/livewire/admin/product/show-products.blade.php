<div class="row row-sm">
    <div class="col-xl-3 col-lg-3 col-md-12 mb-3 mb-md-0">
        <div class="card">
            <div class="card-header border-bottom pt-3 pb-3 mb-0 font-weight-bold text-uppercase">Sections &
                Category
            </div>
            <div class="card-body pb-0">
                <div class="form-group">
                    <label class="form-label">Sections</label>
                    <select name="beast" class="form-control nice-select custom-select" wire:model="bySection">
                        <option value="" selected>Select...</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">Categories</label>
                    <select name="beast"class="form-control nice-select custom-select" wire:model="byCategory">
                        <option value="" selected>Select...</option>
                        @foreach ($sections as $section)
                            @foreach ($section->categories as $category)
                                <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                                @if ($category->subCategories)
                                    @foreach ($category->subCategories as $child)
                                        <option value="{{ $child->id }}">&nbsp;&raquo;
                                            {{ ucwords($child->name) }}
                                        </option>
                                    @endforeach
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">Brands</label>
                    <select name="beast"class="form-control nice-select custom-select" wire:model="byBrand">
                        <option value="" selected>Select...</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">Admins</label>
                    <select name="beast"class="form-control nice-select custom-select" wire:model="byAdmin">
                        <option value="" selected>Select...</option>
                        @foreach ($admins as $admin)
                            <option value="{{ $admin->id }}">
                                {{ $admin->name }} - ({{ str_replace('-', ' ', $admin->type) }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">Order By</label>
                    <select name="beast"class="form-control nice-select custom-select" wire:model="byOrder">
                        <option value="name" selected>Name (default)</option>
                        <option value="price">Price</option>
                        <option value="color">Color</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">Admins</label>
                    <select name="beast"class="form-control nice-select custom-select" wire:model="BySort">
                        <option value="asc" selected>ASC</option>
                        <option value="desc">DESC</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-12">
        <div class="card">
            <div class="card-body p-2">
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="Search..." wire:model.debounce.350ms="search">
                </div>
            </div>
        </div>
        <div class="row row-sm">
            @forelse ($products as $product)
                <div class="col-md-6 col-lg-6 col-xl-4  col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="pro-img-box">
                                <div class="d-flex product-sale">
                                    @if ($product->is_featured == 'yes')
                                        <div class="badge bg-pink">Featured</div>
                                    @endif
                                </div>
                                @if ($product->getFirstMediaUrl('main_img_of_product', 'small'))
                                    <img class="w-100" src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}" alt="product-image">
                                @else
                                    <img class="w-100" src="{{ URL::asset('assets/img/ecommerce/01.jpg') }}" alt="product-image">
                                @endif
                                <a href="{{ route('admin.products.edit', $product) }}" class="adtocart">
                                    <i class="fas fa-edit fa-1x icon"></i>
                                </a>
                            </div>
                            <div class="text-center pt-3">
                                <h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">
                                    {{ ucwords($product->name) }}
                                </h3>
                                <span class="tx-15 ml-auto">
                                    <i class="ion ion-md-star text-warning"></i>
                                    <i class="ion ion-md-star text-warning"></i>
                                    <i class="ion ion-md-star text-warning"></i>
                                    <i class="ion ion-md-star-half text-warning"></i>
                                    <i class="ion ion-md-star-outline text-warning"></i>
                                </span>
                                <div class="grid gap-4 h-100 mt-2">
                                    @php
                                        $dataPrices = App\Models\Product::applyDiscount($product->id, $product->price);
                                    @endphp
                                    <h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger flex justify-between">
                                        @if ($dataPrices['discount'] > 0)
                                            {{ $dataPrices['final_price'] }}
                                            <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">${{ $dataPrices['original_price'] }}</span>
                                        @else
                                            ${{ $product->price }}
                                        @endif
                                    </h4>
                                    <div class="d-flex align-content-center" style="gap:.5rem">
                                        <a href="{{ route('admin.products.attributes.create', $product) }}" class="btn btn-info-gradient btn-sm rounded">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                        <a href="{{ route('admin.products.attachments.create', $product) }}" class="btn btn-dark-gradient btn-sm rounded">
                                            <i class="fas fa-images"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center pt-3">
                                <img src="{{ URL::asset('assets/img/svgicons/note_taking.svg') }}" alt="" width="120" class="m-auto">
                                <h5 class="mg-b-10 mg-t-15 tx-18">Not results found !!</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="mb-8">
            {{ $products->links() }}
        </div>
    </div>
</div>
