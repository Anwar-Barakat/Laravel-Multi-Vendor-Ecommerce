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
                <form>
                    <div class="card-header border-bottom pt-3 pb-3 mb-0 font-weight-bold text-uppercase">Sections &
                        Category
                    </div>
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label class="form-label">Sections</label>
                            <select name="beast" id="select-beast" class="form-control nice-select custom-select">
                                <option value="" selected>Select...</option>
                                @foreach (App\Models\Section::all() as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label class="form-label">Categories</label>
                            <select name="beast" id="select-beast1" class="form-control  nice-select  custom-select">
                                <option value="0" selected>Select...</option>
                                @foreach (App\Models\Category::where('status', 1)->get() as $category)
                                    <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                                    @if ($category->subCategories)
                                        @foreach ($category->subCategories as $child)
                                            <option value="{{ $child->id }}">&nbsp;&raquo;
                                                {{ ucwords($child->name) }}
                                            </option>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-header border-bottom border-top pt-3 pb-3 mb-0 font-weight-bold text-uppercase">Filter
                    </div>
                    <div class="card-body">
                        <div class="form-group mt-2">
                            <label class="form-label">Brands</label>
                            <select name="beast" id="select-beast3" class="form-control  nice-select  custom-select">
                                <option value="0">Select...</option>
                                @foreach (App\Models\Brand::all() as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label class="form-label">Admins & Vendors</label>
                            <select name="beast" id="select-beast3" class="form-control  nice-select  custom-select">
                                <option value="0">Select...</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary-gradient mt-2 mb-2 pb-2" type="submit">Filter</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12">
            <div class="card">
                <form>
                    <div class="card-body p-2">
                        <div class="input-group">
                            <input type="text" id="name" class="form-control" placeholder="Search by name ...">
                            <span class="input-group-append">
                                <button class="btn btn-primary" type="button" id="name-filter">Search</button>
                            </span>
                        </div>
                    </div>
                </form>
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
                            <div class="card-body">
                                <div class="text-center pt-3">
                                    <h4>No results found</h4>
                                </div>
                            </div>
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

    <script>
        let product_name = document.getElementById('name');
        let product_name_btn = document.getElementById('name-filter');
        product_name.onkeyup = () => {
            product_name.value.length > 0 ?
                product_name_btn.style.display = 'block' :
                product_name_btn.style.display = 'none';
        }

        function nameFiltering() {
            let url = "products?";
            var name = product_name.value;

            url += "filter[name]=" + name;

            document.location.href = url;
        }
        product_name_btn.addEventListener('click', nameFiltering);
    </script>
@endsection
