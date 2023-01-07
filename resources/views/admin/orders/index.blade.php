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


@section('title', 'Orders List')

@section('breadcamb', 'Orders List')

@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Orders TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-3">Customers Orders Details</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap table-hover table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Order Date</th>
                                    <th class="border-bottom-0">Customer Name</th>
                                    <th class="border-bottom-0">Order Products</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Final Price</th>
                                    <th class="border-bottom-0">Payment Method</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ ucwords($order->name) }}</td>
                                        <td>
                                            @foreach ($order->orderProducts as $item)
                                                <span class="badge badge-success d-block mb-1">
                                                    {{ $item->product_name }} - {{ $item->product_code }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div>
                                                <div class="spinner-grow  spinner-grow-sm {{ $order->order_status }}" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                <span class=" {{ $order->order_status }} cursor-pointer">{{ $order->order_status }}</span>
                                            </div>
                                        </td>
                                        <td>${{ $order->final_price }}</td>
                                        <td>{{ $order->paymeny_method }}</td>
                                        <td>
                                            <div class="dropdown dropup">
                                                <button class="btn btn-outline-secondary dropdown-toggle btn-sm btn-group-sm" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-bars fa-1x"></i>
                                                </button>
                                                <div class="dropdown-menu tx-13">
                                                    <form action="{{ route('admin.categories.destroy', $order) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('admin.orders.show', $order) }}" class="dropdown-item" title="Details">
                                                            <i class="fas fa-file-alt text-warning"></i>&nbsp;
                                                            Details
                                                        </a>
                                                        @if ($order->order_status == 'Delivered' || $order->order_status == 'Shipped')
                                                            <a href="{{ route('admin.orders.invoice.show', $order) }}" class="dropdown-item" title="Invoice">
                                                                <i class="fas fa-print text-success"></i>&nbsp;
                                                                Invoice
                                                            </a>
                                                            <a href="{{ route('admin.orders.invoice.pdf', $order) }}" class="dropdown-item" title="Invoice">
                                                                <i class="fas fa-file-pdf text-danger"></i>&nbsp;
                                                                Download
                                                            </a>
                                                        @endif
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

    <script src="{{ asset('assets/js/custom/update-category-status.js') }}"></script>
@endsection
