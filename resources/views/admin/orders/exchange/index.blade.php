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


@section('title', 'Exchange Requests List')

@section('breadcamb', 'Exchange Requests List')

@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Exchange Requests TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-3">Customers Exchange Requests Details</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap table-hover table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Order</th>
                                    <th class="border-bottom-0">Product Code</th>
                                    <th class="border-bottom-0">Product Size</th>
                                    <th class="border-bottom-0">Required Size</th>
                                    <th class="border-bottom-0">Request Status</th>
                                    <th class="border-bottom-0">Date</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exchanges as $exchange)
                                    <tr>
                                        <td>
                                            <span class="text text-secondary">
                                                <a href="{{ route('admin.orders.show', $exchange->order) }}">#{{ $exchange->order->id }}</a>
                                                {{ ucwords($exchange->order->name) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="tag tag-secondary">
                                                {{ $exchange->product_code }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="tag tag-danger">
                                                {{ $exchange->product_size }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="tag tag-success">
                                                {{ $exchange->required_size }}
                                            </span>
                                        </td>
                                        <td>
                                            @livewire('admin.order.exchange.update-request-status', ['request_id' => $exchange->id, 'product_code' => $exchange->product_code, 'product_size' => $exchange->product_size])
                                        </td>
                                        <td>{{ $exchange->created_at }}</td>
                                        <td>
                                            <div class="dropdown dropup">
                                                <button class="btn btn-outline-secondary dropdown-toggle btn-sm btn-group-sm" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-bars fa-1x"></i>
                                                </button>
                                                <div class="dropdown-menu tx-13">
                                                    <a href="javascript:;" class="dropdown-item" role="button" data-toggle="modal" title="Details" data-target="#details{{ $exchange->id }}">
                                                        <i class="fas fa-eye text text-warning"></i>
                                                        Details
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- Show Details --}}
                                        <div class="modal fade" id="details{{ $exchange->id }}" tabindex="-1" role="dialog" aria-labelledby="details{{ $exchange->id }}Label" aria-hidden="true" data-effect="effect-super-scaled">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Return Request Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            @php
                                                                $cause = '';
                                                            @endphp
                                                            @foreach (App\Models\ReturnRequest::RETURNREASONS as $key => $reason)
                                                                @if ($key == $exchange->reason)
                                                                    @php
                                                                        $cause = $reason;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                            <label for="reason">Return Reason</label>
                                                            <input type="text" class="form-control" value="{{ $cause }}" id="reason" rows="6" readonly disabled />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="comment">Return Comment</label>
                                                            <textarea type="text" class="form-control" id="comment" rows="6" readonly disabled>{{ $exchange->comment }}</textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary-gradient modal-effect" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
