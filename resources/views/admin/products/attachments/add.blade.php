@extends('admin.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/custom/colors.css') }}">
@endsection

@section('title', 'Add Product Attributes')

@section('breadcamb', 'Add Product Attributes')

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Main Information</h4>
                    </div>
                </div>
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div class="table-responsive">
                        <table class="table table-striped mg-b-0 text-md-nowrap">
                            <tbody>
                                <tr>
                                    <th>Section</th>
                                    <td>{{ ucwords(str_replace('-', ' ', $product->section->name)) }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ ucwords(str_replace('-', ' ', $product->category->name)) }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ ucwords(str_replace('-', ' ', $product->name)) }}</td>
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <td>{{ $product->code }}</td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td>
                                        <div class="colors custom-flex">
                                            @foreach (App\Models\Product::COLORS as $item)
                                                @if ($product->color == $item)
                                                    <input type="radio" name="color" id="{{ $item }}"
                                                        value="{{ $item }}" />
                                                    <label for="{{ $item }}">
                                                        <span class="{{ $item }}"></span>
                                                    </label>
                                                @endif
                                            @endforeach
                                            @error('color')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>${{ $product->price }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-12 text-center col-xl-6">
                        @if ($product->getFirstMediaUrl('main_img_of_product', 'small'))
                            <img src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}"
                                class="img img-thumbnail mb-4">
                        @else
                            <img src="{{ asset('assets/img/1.jpg') }}" class="img img-thumbnail mb-4"
                                alt="Alternative Image">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row  mb-5">
        <div class="col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Add Attachments</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.attachments.store', $product) }}" method="POST"
                        enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="image">Attachments</label>
                                    <div class="custom-file">
                                        <input class="custom-file-input" id="customFile" type="file" type="file"
                                            name="image[]" accept=".jpg, .png, image/jpeg, image/png" multiple required>
                                        <label class="custom-file-label @error('image') is-invalid @enderror"
                                            for="customFile">Choose</label>
                                    </div>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label></label>
                                <div class="form-group" style="margin-top: 0.35rem">
                                    <button type="submit" class="btn btn-primary-gradient"><i class="fas fa-plus"></i>
                                        Add</button>
                                </div>
                            </div>
                        </div>
                        @if ($product->getFirstMediaUrl('product_attachments'))
                            {{-- <x-delete-modal :id="$product->id" :title="'Delete All Attachments'" :action="" /> --}}
                        @endif
                    </form>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Managment Attachments</h4>
                    </div>
                    @include('admin.products.attachments.index')
                </div><!-- bd -->
            </div>
        </div>
    </div>
    <!-- row -->
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

    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <script src="{{ URL::asset('assets/css/modal-popup.js') }}"></script>
@endsection
