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
                                    <td>{{ ucwords($product->color) }}</td>
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
                @if (!empty($product->attributes))
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Added Attributes</h4>
                        </div>
                    </div>
                    <div class="card-body product-attributes-info">
                        <form action="{{ route('admin.products.attributes.update', $product) }}" method="post"
                            name="UpdateProductAttributes" id="UpdateProductAttributes">
                            @csrf
                            <div class="table-responsive">
                                <table class="table text-md-nowrap" id="productAttributes">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">#</th>
                                            <th class="wd-15p border-bottom-0">Size</th>
                                            <th class="wd-15p border-bottom-0">SKU</th>
                                            <th class="wd-15p border-bottom-0">Price</th>
                                            <th class="wd-15p border-bottom-0">Stock</th>
                                            <th class="wd-15p border-bottom-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->attributes as $attribute)
                                            <input type="text" class="d-none" name="attribute_id[]"
                                                value="{{ $attribute['id'] }}">
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $attribute['size'] }}</td>
                                                <td>{{ $attribute['sku'] }}</td>
                                                <td>
                                                    <input type="number" class="form-control" name="price[]"
                                                        value="{{ $attribute['price'] }}" style="height: 2rem;">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="stock[]"
                                                        value="{{ $attribute['stock'] }}" style="height: 2rem;">
                                                </td>
                                                <td>
                                                    <div class="dropdown dropup">
                                                        <button aria-expanded="false" aria-haspopup="true"
                                                            style="font-size: 11px" class="btn ripple btn-secondary"
                                                            data-toggle="dropdown"
                                                            type="button">{{ __('translation.actions') }}
                                                            <i class="fas fa-caret-down ml-1"></i></button>
                                                        <div class="dropdown-menu tx-13">
                                                            <form
                                                                action="{{ route('admin.products.attributes.destroy', $attribute['id']) }}"
                                                                method="post">
                                                                @csrf
                                                                @if ($attribute['status'] == 1)
                                                                    <a href="javascript:void(0);" title="Update Status"
                                                                        class="updateAttributeStatus text-success dropdown-item"
                                                                        id="attribute-{{ $attribute['id'] }}"
                                                                        attribute_id="{{ $attribute['id'] }}"
                                                                        status="{{ $attribute['status'] }}">
                                                                        <i class="fas fa-power-off "></i>
                                                                        {{ __('translation.active') }}
                                                                    </a>
                                                                @else
                                                                    <a href="javascript:void(0);" title="Update Status"
                                                                        class="updateAttributeStatus text-danger  dropdown-item"
                                                                        id="attribute-{{ $attribute['id'] }}"
                                                                        attribute_id="{{ $attribute['id'] }}"
                                                                        status="{{ $attribute['status'] }}">
                                                                        <i class="fas fa-power-off "></i>
                                                                        {{ __('translation.disactive') }}
                                                                    </a>
                                                                @endif
                                                                <a href="javascript:void(0);"
                                                                    class="confirmationDelete dropdown-item"
                                                                    data-attribute="{{ $attribute['id'] }}"
                                                                    title="{{ __('buttons.delete') }}">
                                                                    <i class="fas fa-trash text-danger"></i>
                                                                    {{ __('buttons.delete') }}
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="button-30"
                                        role="button">{{ __('buttons.update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row  mb-5">
        <div class="col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title mb-1">Add Attributes</h4>
                </div>
                <div class="card-body pt-0">
                    <form class="form-horizontal" method="POST"
                        action="{{ route('admin.products.attributes.store', $product) }}" enctype="multipart/form-data"
                        name="ProductAttributesForm" id="ProductAttributesForm">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="field_wrapper multiAttributesForm p-2">
                                    <div class="form-group">
                                        <label for="size">Size</label>
                                        <input type="text" name="size[]" value="{{ old('size') }}" id="size"
                                            class="form-control" placeholder="Type the size" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="sku">SKU</label>
                                        <input type="text" name="sku[]" value="{{ old('sku') }}" id="sku"
                                            class="form-control" required="" placeholder="Type the sku" />
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" name="price[]" value="{{ old('price') }}" id="price"
                                            class="form-control" required="" placeholder="Type the price" />
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" name="stock[]" value="{{ old('stock') }}" id="stock"
                                            class="form-control" required="" placeholder="Type the stock" />
                                    </div>
                                    <a href="javascript:void(0);" class="add_button btn btn-success-gradient"
                                        title="Add field" style="margin-top: 13px;">
                                        <i class="fas fa-plus"></i> Add Row
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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


    {{-- MultiField Form Script --}}
    <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 10;
            var addButton = $('.add_button');
            var wrapper = $('.field_wrapper');
            var fieldHTML =
                `<div class="multiAttributesForm mt-3">
                    <div class="form-group">
                        <input type="text" name="size[]" value="{{ old('size') }}" class="form-control" required="" placeholder="Type the size" id="size" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="sku[]" value="{{ old('sku') }}" class="form-control" required="" placeholder="Type the sku" id="sku" />
                    </div>
                    <div class="form-group">
                        <input type="number" name="price[]" value="{{ old('price') }}" class="form-control" required="" placeholder="Type the price" id="price" />
                    </div>
                    <div class="form-group">
                    <input type="number" name="stock[]" value="{{ old('stock') }}" class="form-control" required="" placeholder="Type the stock" id="stock" />
                    </div>
                    <a href="javascript:void(0);" class="mb-3 remove_button btn btn-danger-gradient added-field-attribute-deleted-btn"><i class='fas fa-times'></i> Delete Row</a>
                </div>`;
            var x = 1;
            $(addButton).click(function() {
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    {{-- turn on/off the Product Attribute status --}}
    <script>
        $(document).on("click", ".updateAttributeStatus", function() {
            var status = $(this).attr('status');
            var attribute_id = $(this).attr('attribute_id');
            var activeIc = `<i class="fas fa-power-off text-success"></i>`;
            var disactiveIcon = `<i class="fas fa-power-off text-danger"></i>`;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-attribute-status',
                data: {
                    status: status,
                    attribute_id: attribute_id,
                },
                success: function(response) {
                    if (response['status'] == 0) {
                        $('#attribute-' + response['attribute_id'])
                            .attr('status', `${response['status']}`);
                        $('#attribute-' + response['attribute_id']).text('Inactive');
                        $('#attribute-' + response['attribute_id']).attr('style',
                            'color : #ee335e  !important');
                        $('#attribute-' + response['attribute_id']).prepend(
                            '<i class="fas fa-power-off text-danger"></i> ');
                    } else {
                        $('#attribute-' + response['attribute_id'])
                            .attr('status', `${response['status']}`);
                        $('#attribute-' + response['attribute_id']).text('Active');
                        $('#attribute-' + response['attribute_id']).attr('style',
                            'color : #22c03c   !important');
                        $('#attribute-' + response['attribute_id']).prepend(
                            '<i class="fas fa-power-off text-success"></i> ');

                    }
                },
                error: function() {},
            });
        });
    </script>

    {{-- Confirmation Delete Attribute --}}
    <script>
        $(document).on("click", ".confirmationDelete", function() {
            Swal.fire({
                title: '{{ __('msgs.are_your_sure') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: '{{ __('buttons.close') }}',
                confirmButtonText: '{{ __('msgs.yes_delete') }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/admin/delete-attribute/' + $(this).data(
                        'attribute');
                }
            });
        });
    </script>
@endsection
