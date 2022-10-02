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


@section('title', 'Categories List')

@section('breadcamb', 'Categories List')

@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Categories TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-3">List of Categories & Sub-categories</p>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap table-hover table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Id</th>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Parent Category</th>
                                    <th class="border-bottom-0">Section</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Created At</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucwords($category->name) }}</td>
                                        <td>
                                            <span
                                                class="badge badge-{{ !empty($category->parentCategory->name) ? 'warning' : 'success' }}">
                                                {{ $category->parentCategory->name ?? 'Root' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary">
                                                {{ ucwords($category->section->name) }}</span>
                                        </td>
                                        <td>
                                            <div class="spinner-grow spinner-grow-sm {{ $category->status == '1' ? 'green' : 'red' }}"
                                                role="status" id="status-{{ $category->id }}">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <span class="text text-{{ $category->status == '1' ? 'success' : 'danger' }}"
                                                id="status-text{{ $category->id }}">
                                                {{ $category->status == '1' ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>
                                            <div class="dropdown dropup">
                                                <button
                                                    class="btn btn-outline-secondary dropdown-toggle btn-sm btn-group-sm"
                                                    type="button" id="triggerId" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-bars fa-1x"></i>
                                                </button>
                                                <div class="dropdown-menu tx-13">
                                                    <form action="{{ route('admin.categories.destroy', $category) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        @if ($category->status == 1)
                                                            <a href="javascript:void(0);"
                                                                title="{{ __('translation.update_status') }}"
                                                                class="updateCategoryStatus text-success dropdown-item"
                                                                id="category-{{ $category->id }}"
                                                                category_id="{{ $category->id }}"
                                                                status="{{ $category->status }}">
                                                                <i class="fas fa-power-off"></i>&nbsp;
                                                                Active
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0);"
                                                                title="{{ __('translation.update_status') }}"
                                                                class="updateCategoryStatus text-danger  dropdown-item"
                                                                id="category-{{ $category->id }}"
                                                                category_id="{{ $category->id }}"
                                                                status="{{ $category->status }}">
                                                                <i class="fas fa-power-off "></i>&nbsp;
                                                                Inactive
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('admin.categories.edit', $category) }}"
                                                            class="dropdown-item" title="Edit">
                                                            <i class="fas fa-edit text-primary"></i>&nbsp;
                                                            Edit
                                                        </a>
                                                        <a href="javascript:void(0);"
                                                            class="confirmationDelete dropdown-item"
                                                            data-product="{{ $category->id }}" title="Delete"
                                                            data-toggle="modal" data-target="#delete{{ $category->id }}">
                                                            <i class="fas fa-trash text-danger"></i>&nbsp;
                                                            Delete
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        </td>
                                        <x-delete-modal :id="$category->id" :title="'Delete The Category'" :action="route('admin.categories.destroy', $category)" />
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

    <script src="{{ asset('assets/js/custom/update-category-status.js') }}"></script>
@endsection
