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


@section('title')
    Sections List
@endsection

@section('breadcamb')
    Sections List
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Sections TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-3">List of Section that Contains Categories</p>
                    <button type="button" class="btn btn-primary  modal-effect" data-effect="effect-rotate-left"
                        role="button" data-toggle="modal" data-target="#addNewSection">
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
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Created At</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $section->name }}</td>
                                        <td>
                                            <div class="spinner-grow  spinner-grow-sm {{ $section->status == '1' ? 'green' : 'red' }}"
                                                role="status" id="status-{{ $section->id }}">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <span class="text text-{{ $section->status == '1' ? 'success' : 'danger' }}"
                                                id="status-text{{ $section->id }}">
                                                {{ $section->status == '1' ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $section->created_at }}</td>
                                        <td>
                                            @if ($section->status == 1)
                                                <a href="javascript:void(0);" class="updateSectionStatus text-success p-2"
                                                    title="Update Status" id="section-{{ $section->id }}"
                                                    section_id="{{ $section->id }}" status="{{ $section->status }}">
                                                    <i class="fas fa-power-off"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0);" class="updateSectionStatus text-danger p-2"
                                                    title="Update Status" id="section-{{ $section->id }}"
                                                    section_id="{{ $section->id }}" status="{{ $section->status }}">
                                                    <i class="fas fa-power-off text-danger"></i>
                                                </a>
                                            @endif
                                            <a href="javascript:void(0);" role="button" data-toggle="modal"
                                                title="{{ __('buttons.update') }}"
                                                data-target="#editSection{{ $section->id }}" class="text-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        @include('admin.sections.edit')
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.sections.add')
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

    <script src="{{ asset('assets/js/custom/update-section-status.js') }}"></script>
@endsection
