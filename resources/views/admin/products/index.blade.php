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
                            <select name="beast" id="section_id" class="form-control nice-select custom-select">
                                <option value="" selected>Select...</option>
                                @foreach (App\Models\Section::all() as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label class="form-label">Categories</label>
                            <select name="beast" id="category_id" class="form-control nice-select custom-select">
                                <option value="" selected selected>Select...</option>
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
                            <select name="beast" id="brand_id" class="form-control  nice-select  custom-select">
                                <option value="" selected>Select...</option>
                                @foreach (App\Models\Brand::all() as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary-gradient mt-2 mb-2 pb-2" type="button"
                            id="select-filter">Filter</button>
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
            <div class="card">
                <form>
                    <div class="card-body p-2">
                        <div class="input-group">
                            <input type="text" id="price" class="form-control" placeholder="Search by max price ...">
                            <span class="input-group-append">
                                <button class="btn btn-primary" type="button" id="price-filter">Search</button>
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
                                    <img src="{{ URL::asset('assets/img/svgicons/note_taking.svg') }}" alt=""
                                        width="120">
                                    <h5 class="mg-b-10 mg-t-15 tx-18">Not results found !!</h5>
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

    {{-- filtering by name --}}
    <script>
        let pName = document.getElementById('name');
        let pName_btn = document.getElementById('name-filter');
        pName.onkeyup = () => {
            pName.value.length > 0 ?
                pName_btn.style.display = 'block' :
                pName_btn.style.display = 'none';
        }

        function nameFiltering() {
            let url = "products?";
            var name = pName.value;

            url += "filter[name]=" + name;

            document.location.href = url;
        }
        pName_btn.addEventListener('click', nameFiltering);
    </script>

    {{-- filtering by select options --}}
    <script>
        let p_section_id = document.getElementById('section_id');
        let p_category_id = document.getElementById('category_id');
        let p_brand_id = document.getElementById('brand_id');
        let p_select_btn = document.getElementById('select-filter');
        p_select_btn.style.display = 'none';

        p_section_id.onchange = () => p_select_btn.style.display = 'block';
        p_category_id.onchange = () => p_select_btn.style.display = 'block';
        p_brand_id.onchange = () => p_select_btn.style.display = 'block';

        function selectFiltering() {
            let url = "products?";
            var section_id = p_section_id.value;
            var category_id = p_category_id.value;
            var brand_id = p_brand_id.value;

            if (section_id !== '' && category_id !== '' && brand_id !== '')
                url += "filter[section_id]=" + section_id + "&filter[category_id]=" + category_id + "&filter[brand_id]=" +
                brand_id
            else if (section_id !== '' && category_id !== '')
                url += "filter[section_id]=" + section_id + "&filter[category_id]=" + category_id;
            else if (category_id !== '' && brand_id !== '')
                url += "filter[category_id]=" + category_id + "&filter[brand_id]=" + brand_id;
            else if (section_id !== '' && brand_id !== '')
                url += "filter[section_id]=" + section_id + "&filter[brand_id]=" + brand_id;
            else if (section_id !== '')
                url += "filter[section_id]=" + section_id;
            else if (category_id !== '')
                url += "filter[category_id]=" + category_id;
            else if (brand_id !== '')
                url += "filter[brand_id]=" + brand_id;

            document.location.href = url;
        }
        p_select_btn.addEventListener('click', selectFiltering);
    </script>

    {{-- filtering by name --}}
    <script>
        let pPrice = document.getElementById('price');
        let pPrice_btn = document.getElementById('price-filter');
        pPrice.onkeyup = () => {
            pPrice.value.length > 0 && Number(pPrice.value) ?
                pPrice_btn.style.display = 'block' :
                pPrice_btn.style.display = 'none';
        }

        function priceFiltering() {
            let url = "products?";
            var price = pPrice.value;

            url += "filter[max_price]=" + price;

            document.location.href = url;
        }
        pPrice_btn.addEventListener('click', priceFiltering);
    </script>
@endsection
