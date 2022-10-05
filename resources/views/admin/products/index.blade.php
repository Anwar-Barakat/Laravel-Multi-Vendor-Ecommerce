@extends('admin.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection


@section('title', 'Products List')

@section('breadcamb', 'Products List')

@section('content')
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-3 col-md-12 mb-3 mb-md-0">
            <div class="card">
                <div class="card-header border-bottom pt-3 pb-3 mb-0 font-weight-bold text-uppercase">Category</div>
                <div class="card-body pb-0">
                    <div class="form-group">
                        <label class="form-label">Mens</label>
                        <select name="beast" id="select-beast" class="form-control  nice-select  custom-select">
                            <option value="0">--Select--</option>
                            <option value="1">Foot wear</option>
                            <option value="2">Top wear</option>
                            <option value="3">Bootom wear</option>
                            <option value="4">Men's Groming</option>
                            <option value="5">Accessories</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label">Women</label>
                        <select name="beast" id="select-beast1" class="form-control  nice-select  custom-select">
                            <option value="0">--Select--</option>
                            <option value="1">Western wear</option>
                            <option value="2">Foot wear</option>
                            <option value="3">Top wear</option>
                            <option value="4">Bootom wear</option>
                            <option value="5">Beuty Groming</option>
                            <option value="6">Accessories</option>
                            <option value="7">jewellery</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label">Baby & Kids</label>
                        <select name="beast" id="select-beast2" class="form-control  nice-select  custom-select">
                            <option value="0">--Select--</option>
                            <option value="1">Boys clothing</option>
                            <option value="2">girls Clothing</option>
                            <option value="3">Toys</option>
                            <option value="4">Baby Care</option>
                            <option value="5">Kids footwear</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label">Electronics</label>
                        <select name="beast" id="select-beast3" class="form-control  nice-select  custom-select">
                            <option value="0">--Select--</option>
                            <option value="1">Mobiles</option>
                            <option value="2">Laptops</option>
                            <option value="3">Gaming & Accessories</option>
                            <option value="4">Health care Appliances</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label class="form-label">Sport,Books & More </label>
                        <select name="beast" id="select-beast4" class="form-control  nice-select  custom-select">
                            <option value="0">--Select--</option>
                            <option value="1">Stationery</option>
                            <option value="2">Books</option>
                            <option value="3">Gaming</option>
                            <option value="4">Music</option>
                            <option value="5">Exercise & fitness</option>
                        </select>
                    </div>
                </div>
                <div class="card-header border-bottom border-top pt-3 pb-3 mb-0 font-weight-bold text-uppercase">Filter
                </div>
                <div class="card-body">
                    <form role="form product-form">
                        <div class="form-group">
                            <label>Brand</label>
                            <select class="form-control nice-select">
                                <option>Wallmart</option>
                                <option>Catseye</option>
                                <option>Moonsoon</option>
                                <option>Textmart</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control nice-select">
                                <option>Small</option>
                                <option>Medium</option>
                                <option>Large</option>
                                <option>Extra Large</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="card-header border-bottom border-top pt-3 pb-3 mb-0 font-weight-bold text-uppercase">Rating
                </div>
                <div class="py-2 px-3">
                    <label class="p-1 mt-2 d-flex align-items-center">
                        <span class="check-box mb-0">
                            <span class="ckbox"><input checked="" type="checkbox"><span></span></span>
                        </span>
                        <span class="ml-3 tx-16 my-auto">
                            <i class="ion ion-md-star  text-warning"></i>
                            <i class="ion ion-md-star  text-warning"></i>
                            <i class="ion ion-md-star  text-warning"></i>
                            <i class="ion ion-md-star  text-warning"></i>
                            <i class="ion ion-md-star  text-warning"></i>
                        </span>
                    </label>
                    <label class="p-1 mt-2 d-flex align-items-center">
                        <span class="check-box mb-0">
                            <span class="ckbox"><input checked="" type="checkbox"><span></span></span>
                        </span>
                        <span class="ml-3 tx-16 my-auto">
                            <i class="ion ion-md-star  text-warning"></i>
                            <i class="ion ion-md-star  text-warning"></i>
                            <i class="ion ion-md-star  text-warning"></i>
                            <i class="ion ion-md-star  text-warning"></i>
                        </span>
                    </label>
                    <label class="p-1 mt-2 d-flex align-items-center">
                        <span class="check-box mb-0">
                            <span class="ckbox"><input checked="" type="checkbox"><span></span></span>
                        </span>
                        <span class="ml-3 tx-16 my-auto">
                            <i class="ion ion-md-star  text-warning"></i>
                            <i class="ion ion-md-star  text-warning"></i>
                            <i class="ion ion-md-star  text-warning"></i>
                        </span>
                    </label>
                    <label class="p-1 mt-2 d-flex align-items-center">
                        <span class="checkbox mb-0">
                            <span class="check-box">
                                <span class="ckbox"><input type="checkbox"><span></span></span>
                            </span>
                        </span>
                        <span class="ml-3 tx-16 my-auto">
                            <i class="ion ion-md-star  text-warning"></i>
                            <i class="ion ion-md-star  text-warning"></i>
                        </span>
                    </label>
                    <label class="p-1 mt-2 d-flex align-items-center">
                        <span class="checkbox mb-0">
                            <span class="check-box">
                                <span class="ckbox"><input type="checkbox"><span></span></span>
                            </span>
                        </span>
                        <span class="ml-3 tx-16 my-auto">
                            <i class="ion ion-md-star  text-warning"></i>
                        </span>
                    </label>
                    <button class="btn btn-primary-gradient mt-2 mb-2 pb-2" type="submit">Filter</button>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12">
            <div class="card">
                <div class="card-body p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search ...">
                        <span class="input-group-append">
                            <button class="btn btn-primary" type="button">Search</button>
                        </span>
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
                                    @if ($product->getFirstMediaUrl('products', 'thumb'))
                                        <img class="w-100" src="{{ $product->getFirstMediaUrl('products', 'thumb') }}"
                                            alt="product-image">
                                    @else
                                        <img class="w-100" src="{{ URL::asset('assets/img/ecommerce/01.jpg') }}"
                                            alt="product-image">
                                    @endif
                                    <a href="#" class="adtocart">
                                        <i class="las la-edit"></i>
                                    </a>
                                </div>
                                <div class="text-center pt-3">
                                    <h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">{{ ucwords($product->name) }}
                                    </h3>
                                    <span class="tx-15 ml-auto">
                                        <i class="ion ion-md-star text-warning"></i>
                                        <i class="ion ion-md-star text-warning"></i>
                                        <i class="ion ion-md-star text-warning"></i>
                                        <i class="ion ion-md-star-half text-warning"></i>
                                        <i class="ion ion-md-star-outline text-warning"></i>
                                    </span>
                                    <h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">
                                        ${{ $product->price }}
                                        <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$59</span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card">
                            Not Result Found !!
                        </div>
                    </div>
                @endforelse
            </div>
            {{ $products->links() }}
        </div>
    </div>
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
@endsection
