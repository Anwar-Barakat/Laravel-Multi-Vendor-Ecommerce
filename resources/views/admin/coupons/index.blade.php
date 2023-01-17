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


@section('title', 'Coupons List')

@section('breadcamb', 'Coupons List')

@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Coupons TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-3">List of Coupons & Sub-Coupons</p>
                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary-gradient">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap table-hover table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Id</th>
                                    <th class="border-bottom-0">Coupon Code</th>
                                    <th class="border-bottom-0">Coupon Type</th>
                                    <th class="border-bottom-0">Amount</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Expiry Date</th>
                                    <th class="border-bottom-0">Created At</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $coupon->coupon_code }}</td>
                                        <td>
                                            <span class="tag tag-gray">
                                                {{ ucwords($coupon->coupon_type) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $coupon->amount_type == 'Percentage' ? '%' : '$' }}
                                            {{ number_format($coupon->amount, 2) }}</td>
                                        <td>
                                            @livewire('admin.coupon.update-status', ['status' => $coupon->status, 'coupon_id' => $coupon->id])
                                        </td>
                                        <td>{{ $coupon->expiry_date }}</td>
                                        <td>{{ $coupon->created_at }}</td>
                                        <td>
                                            <div class="dropdown dropup">
                                                <button class="btn btn-outline-secondary dropdown-toggle btn-sm btn-group-sm" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-bars fa-1x"></i>
                                                </button>
                                                <div class="dropdown-menu tx-13">
                                                    <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="dropdown-item" title="Edit">
                                                            <i class="fas fa-edit text-primary"></i>&nbsp;
                                                            Edit
                                                        </a>
                                                        <a href="javascript:void(0);" class="confirmationDelete dropdown-item" title="Delete" data-toggle="modal" data-target="#delete{{ $coupon->id }}">
                                                            <i class="fas fa-trash text-danger"></i>&nbsp;
                                                            Delete
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <x-delete-modal :id="$coupon->id" :title="'Delete The Coupon'" :action="route('admin.coupons.destroy', $coupon)" />
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="7">Not results found !!</td>
                                    </tr>
                                @endforelse
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
