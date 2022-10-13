@extends('admin.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@endsection


@section('title', 'Filters List')

@section('breadcamb', 'Filters List')

@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Filters TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-3">A lot Of Filters</p>
                    <button type="button" class="btn btn-primary-gradient  modal-effect" data-effect="effect-rotate-left"
                        role="button" data-toggle="modal" data-target="#addNew">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap table-hover table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Id</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Column</th>
                                    <th class="border-bottom-0">Categories</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Created At</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($filters as $filter)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $filter->filter_name }}</td>
                                        <td>{{ $filter->filter_column }}</td>
                                        <td class="flex flex-wrap" style="gap: .5rem">
                                            @php
                                                $cat_ids = explode(',', $filter->category_ids);
                                            @endphp

                                            @foreach ($cat_ids as $id)
                                                <span class="badge badge-danger">
                                                    {{ App\Models\Category::where('id', $id)->first()->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @livewire('admin.filter.update-status', ['status' => $filter->status, 'filter_id' => $filter->id])
                                        </td>
                                        <td>{{ $filter->created_at }}</td>
                                        <td>
                                            <span class="tag tag-gray">
                                                <a href="javascript:void(0);" role="button" data-toggle="modal"
                                                    title="Update" data-target="#edit{{ $filter->id }}"
                                                    style="color: white">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>
                                            </span>
                                        </td>
                                        {{-- @include('admin.brands.edit') --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.filters.add')
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

    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Choose one',
                searchInputPlaceholder: 'Search'
            });
        });
    </script>
@endsection
