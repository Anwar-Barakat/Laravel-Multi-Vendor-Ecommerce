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
    Admins List
@endsection

@section('breadcamb')
    Admins List
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Admins TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">List Of Admins, Sub-Admins, Vendors &</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap table-hover table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Id</th>
                                    <th class="border-bottom-0">Image</th>
                                    <th class="border-bottom-0">Type</th>
                                    <th class="border-bottom-0">E-mail</th>
                                    <th class="border-bottom-0">Mobile</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($admin->getFirstMediaUrl('avatars', 'thumb'))
                                                <img src="{{ $admin->getFirstMediaUrl('avatars', 'thumb') }}"
                                                    class=" img img-thumbnail" width="70">
                                            @else
                                                <img src="{{ asset('assets/img/faces/6.jpg') }}" class=" img img-thumbnail"
                                                    width="70">
                                            @endif
                                        </td>
                                        <td>{{ ucwords(str_replace('-', ' ', $admin->type)) }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->mobile }}</td>
                                        <td>
                                            <div class="dropdown dropup">
                                                <button class="btn btn-secondary dropdown-toggle btn-sm btn-group-sm"
                                                    type="button" id="triggerId" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu tx-13">
                                                    <form action="{{ route('admin.admins.destroy', $admin) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        @if ($admin->status == 1)
                                                            <a href="javascript:void(0);"
                                                                title="{{ __('translation.update_status') }}"
                                                                class="updateAdminStatus text-success dropdown-item"
                                                                id="admin-{{ $admin->id }}"
                                                                admin_id="{{ $admin->id }}"
                                                                status="{{ $admin->status }}">
                                                                <i class="fas fa-power-off"></i>&nbsp;
                                                                Active
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0);"
                                                                title="{{ __('translation.update_status') }}"
                                                                class="updateAdminStatus text-danger  dropdown-item"
                                                                id="admin-{{ $admin->id }}"
                                                                admin_id="{{ $admin->id }}"
                                                                status="{{ $admin->status }}">
                                                                <i class="fas fa-power-off "></i>&nbsp;
                                                                Inactive
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('admin.admins.edit', $admin) }}"
                                                            class="dropdown-item" title="Edit">
                                                            <i class="fas fa-edit text-primary"></i>&nbsp;
                                                            Edit
                                                        </a>
                                                        <a href="{{ route('admin.admins.show', $admin) }}"
                                                            class="dropdown-item" title="Show">
                                                            <i class="fas fa-eye text-warning"></i>&nbsp;
                                                            Show
                                                        </a>
                                                        <a href="javascript:void(0);"
                                                            class="confirmationDelete dropdown-item"
                                                            data-product="{{ $admin->id }}" title="Delete">
                                                            <i class="fas fa-trash text-danger"></i>&nbsp;
                                                            Delete
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
                </div>
            </div>
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
