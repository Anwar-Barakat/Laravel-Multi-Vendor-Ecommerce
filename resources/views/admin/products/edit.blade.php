@extends('admin.layouts.master')
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/css/custom/colors.css') }}">

    {{-- smart wizard --}}
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
@endsection


@section('livewire-css')
    @livewireStyles
@endsection

@section('title', 'Edit Product')

@section('breadcamb', 'Edit Product')

@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Edit Product</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <div class="card-body" id="smartwizard">
                    <div class="m-3 d-flex justify-content-around align-items-center card flex-row flex-wrap">
                        <div class="form-group m-3">
                            @if ($product->getFirstMediaUrl('main_img_of_product', 'small'))
                                <img class="img img-thumbnail img-activity" src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}" alt="product-image">
                            @else
                                <img class="img img-thumbnail img-activity" src="{{ URL::asset('assets/img/6.jpg') }}" alt="product-image">
                            @endif
                        </div>
                        <div class="form-group m-3">
                            @if ($product->getFirstMediaUrl('main_video_of_product'))
                                <video width="200" class="img img-thumbnail mb-4 admin-image" controls>
                                    <source src="{{ $product->getFirstMediaUrl('main_video_of_product') }}" type="video/mp4" class="img img-thumbnail img-activity">
                                    <source src="{{ $product->getFirstMediaUrl('main_video_of_product') }}" type="video/ogg" class="img img-thumbnail img-activity">
                                    {{ __('msgs.browser_error') }}
                                </video>
                            @else
                                <img src="{{ asset('assets/img/6.jpg') }}" class="img img-thumbnail mb-4 admin-image" alt="Alternative Vedio">
                            @endif
                        </div>
                    </div>
                    <br>
                    <ul class="nav nav-progress">
                        <li class="nav-item">
                            <a class="nav-link" href="#step-1">
                                <div class="num">1</div>
                                Main Info
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-2">
                                <span class="num">2</span>
                                Color & Code
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-3">
                                <span class="num">3</span>
                                Attachments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#step-4">
                                <span class="num">4</span>
                                Additional Info
                            </a>
                        </li>
                    </ul>
                    <form class="form-horizontal tab-content" method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" required value="{{ old('name', $product->name) }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @foreach (App\Models\Filter::active()->get() as $filter)
                                @if (in_array($product->category_id, explode(',', $filter->category_ids)))
                                    @php
                                        $allFilters[] = $filter;
                                    @endphp
                                @endif
                            @endforeach

                            @livewire('admin.product.get-category-filters', [
                                'category' => $product->category_id,
                                'allFilters' => $allFilters ?? '',
                                'selectedCategoryId' => $product->category_id,
                                'product' => $product,
                            ])
                            <div class="row">
                                <div class="col-md-12 col-lg-3">
                                    <label for="price">Price</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input aria-label="Amount (to the nearest dollar)" class="form-control  @error('price') is-invalid @enderror" type="number" value="{{ old('price', $product->price) }}" name="price">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-3">
                                    <label for="discount">Discount</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <input aria-label="Amount (to the nearest dollar)" class="form-control  @error('discount') is-invalid @enderror" type="number" value="{{ old('discount', $product->discount) }}" name="discount">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                        @error('discount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-3">
                                    <label for="gst">GST</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <input aria-label="Amount (to the nearest dollar)" class="form-control  @error('gst') is-invalid @enderror" type="number" value="{{ old('gst', $product->gst) }}" name="gst">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                        @error('gst')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-3">
                                    <label for="weight">Weight</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">g</span>
                                        </div>
                                        <input aria-label="Amount (to the nearest dollar)" class="form-control  @error('weight') is-invalid @enderror" type="number" value="{{ old('weight', $product->weight) }}" name="weight">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                        @error('weight')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="brand_id">Brands</label>
                                        <select name="brand_id" class="form-control  @error('brand_id') is-invalid @enderror">
                                            <option value="" selected>Select...</option>
                                            @foreach (App\Models\Brand::all() as $brand)
                                                <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                                    {{ ucwords($brand->name) }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" class="form-control  @error('code') is-invalid @enderror" name="code" required value="{{ old('code', $product->code) }}">
                                        @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="group_code">Group Code</label>
                                        <input type="text" class="form-control  @error('group_code') is-invalid @enderror" name="group_code" required value="{{ old('group_code', $product->group_code) }}">
                                        @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <label for="color">Color</label>
                                    <div class="form-group colors custom-flex">
                                        @foreach (App\Models\Product::COLORS as $item)
                                            <input type="radio" name="color" id="{{ $item }}" value="{{ old('color', $item) }}" {{ $item == $product->color ? 'checked' : '' }} />
                                            <label for="{{ $item }}"><span class="{{ $item }}"></span></label>
                                        @endforeach
                                        @error('color')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <div class="form-group has-success mg-b-0">
                                            <textarea class="form-control @error('description') is-invalid @enderror" style="height: 212px;" name="description">{{ old('description', $product->description) }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="avatar">Image</label>
                                        <input type="file" class="dropify" data-height="200" name="image" />
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="avatar">Video</label>
                                        <input type="file" class="dropify" data-height="200" name="video" />
                                        @error('video')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                            <div class="row">
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="meta_title">Meta title</label>
                                        <input type="text" class="form-control  @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}">
                                        @error('meta_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="meta_description">Meta description</label>
                                        <input type="text" class="form-control  @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" value="{{ old('meta_description', $product->meta_description) }}">
                                        @error('meta_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta keywords</label>
                                        <input type="text" class="form-control  @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $product->meta_keywords) }}">
                                        @error('meta_keywords')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="is_featured">Is Featured</label>
                                        <select name="is_featured" class="form-control  @error('is_featured') is-invalid @enderror">
                                            <option value="" selected>Select...</option>
                                            <option value="no" {{ old('is_featured') == 'no' ? 'selected' : '' }} {{ $product->is_featured == 'no' ? 'selected' : '' }}>No</option>
                                            <option value="yes" {{ old('is_featured') == 'yes' ? 'selected' : '' }} {{ $product->is_featured == 'yes' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                        @error('is_featured')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="is_best_seller">is_best_seller</label>
                                        <select name="is_best_seller" class="form-control  @error('is_best_seller') is-invalid @enderror">
                                            <option value="" selected>Select...</option>
                                            <option value="0" {{ old('is_best_seller') == '0' ? 'selected' : '' }} {{ $product->is_best_seller == '0' ? 'selected' : '' }}>Inactive
                                            </option>
                                            <option value="1" {{ old('is_best_seller') == '1' ? 'selected' : '' }} {{ $product->is_best_seller == '1' ? 'selected' : '' }}>Active
                                            </option>
                                        </select>
                                        @error('is_best_seller')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control  @error('status') is-invalid @enderror">
                                            <option value="" selected>Select...</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }} {{ $product->status == '0' ? 'selected' : '' }}>Inactive
                                            </option>
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }} {{ $product->status == '1' ? 'selected' : '' }}>Active
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-primary-gradient">
                                        <i class="fas fa-edit"></i> Update
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <!-- Ionicons js -->
    <script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    {{-- form wizard --}}
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets/js/custom/form-wizard.js') }}"></script>


    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
@endsection

@section('livewire-js')
    @livewireScripts
@endsection
