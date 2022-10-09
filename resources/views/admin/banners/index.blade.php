@extends('admin.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title', 'Banners List')

@section('breadcamb', 'Banners List')

@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Banners TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-3">List of Banners</p>
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
                                    <th class="border-bottom-15">#</th>
                                    <th class="border-bottom-15">Image</th>
                                    <th class="border-bottom-15">Title</th>
                                    <th class="border-bottom-15">Status</th>
                                    <th class="border-bottom-15">Created At</th>
                                    <th class="border-bottom-15">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($banner->getFirstMediaUrl('banners', 'thumb'))
                                                <img class="img img-thumbnail" width="300"
                                                    src="{{ $banner->getFirstMediaUrl('banners', 'thumb') }}">
                                            @else
                                                <img class="img img-thumbnail" width="300"
                                                    src="{{ asset('assets/img/banners/banner-default.jpg') }}">
                                            @endif
                                        </td>
                                        <td>{{ ucwords($banner->title) }}</td>
                                        <td>
                                            @livewire('admin.banner.update-status', ['status' => $banner->status, 'banner_id' => $banner->id])
                                        </td>
                                        <td>{{ $banner->created_at }}</td>
                                        <td>
                                            <div class="dropdown dropup">
                                                <button
                                                    class="btn btn-outline-secondary dropdown-toggle btn-sm btn-group-sm"
                                                    type="button" id="triggerId" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-bars fa-1x"></i>
                                                </button>
                                                <div class="dropdown-menu tx-13">
                                                    <form action="{{ route('admin.categories.destroy', $banner) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="javascript:void(0);" role="button" data-toggle="modal"
                                                            class="dropdown-item" title="Update"
                                                            data-target="#edit{{ $banner->id }}">
                                                            <i class="fas fa-edit text-primary"></i>&nbsp;
                                                            Edit
                                                        </a>
                                                        <a href="javascript:void(0);"
                                                            class="confirmationDelete dropdown-item" title="Delete"
                                                            data-toggle="modal" data-target="#delete{{ $banner->id }}">
                                                            <i class="fas fa-trash text-danger"></i>&nbsp;
                                                            Delete
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <x-delete-modal :id="$banner->id" :title="'Delete The Banner'" :action="route('admin.banners.destroy', $banner)" />
                                    </tr>
                                    @include('admin.banners.edit')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.banners.add')
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


    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
@endsection
