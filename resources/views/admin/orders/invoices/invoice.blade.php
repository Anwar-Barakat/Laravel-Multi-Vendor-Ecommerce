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


@section('title', 'Order Invoice')

@section('breadcamb', 'Order Invoice')

@section('content')
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">Invoice</h1>
                            <div class="billed-from">
                                <h6>Shipped To</h6>
                                <p>{{ $order->name }}</p>
                                <p class="mb-2">{{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->country->name }}<br>
                                    Tel No: {{ $order->mobile }}<br>
                                    Email: {{ $order->email }}</p>
                                <p>
                                    @php
                                        echo DNS1D::getBarcodeHTML($order->id, 'C39E+');
                                    @endphp
                                </p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">Billed To</label>
                                <div class="billed-to">
                                    <p>{{ $order->user->name }}</p>
                                    <p>{{ $order->user->address }}, {{ $order->user->city }}, {{ $order->user->state }}, {{ $order->user->country->name }}<br>
                                        Tel No: {{ $order->user->mobile }}<br>
                                        Email: {{ $order->user->email }}</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600">Invoice Information</label>
                                <p class="invoice-info-row"><span>Payment Method</span> <span>{{ $order->paymeny_method }}</span></p>
                                <p class="invoice-info-row"><span>Payment Gateway</span> <span>{{ $order->paymeny_gateway }}</span></p>
                                <p class="invoice-info-row"><span>Issue Date:</span> <span>{{ Carbon\Carbon::parse($order->created_at)->format('M y,Y') }}</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">Item</th>
                                        <th class="wd-40p">Size</th>
                                        <th class="tx-center">Price</th>
                                        <th class="tx-right">Qty</th>
                                        <th class="tx-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $subTotal = 0;
                                    @endphp
                                    @foreach ($order->orderProducts as $item)
                                        @php
                                            $total = $item->product_qty * $item->product_price;
                                            $subTotal += $total;
                                        @endphp
                                        <tr>
                                            <td>
                                                <span class="block">Name: {{ $item->product_name }}</span>
                                                <span class="block">Code: {{ $item->product_code }}</span>
                                                <span class="block">Color: {{ $item->product_color }}</span>
                                                <span class="block mt-2">
                                                    @php
                                                        echo DNS1D::getBarcodeHTML($item->id, 'C39E+');
                                                    @endphp
                                                </span>
                                            </td>
                                            <td class="tx-12">${{ number_format($item->product_price, 2) }}</td>
                                            <td class="tx-center">{{ $item->product_qty }}</td>
                                            <td class="tx-right">{{ $item->product_size }}</td>
                                            <td class="tx-right">${{ $total }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13"></label>

                                            </div><!-- invoice-notes -->
                                        </td>
                                        <td class="tx-right">Sub-Total</td>
                                        <td class="tx-right" colspan="2">${{ number_format($subTotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">Shipping Charges</td>
                                        <td class="tx-right" colspan="2">${{ number_format($order->shipping_charges, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">Coupon Amount</td>
                                        <td class="tx-right" colspan="2"> -${{ number_format($order->coupon_amount, 2) ?? '0' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">Total Due</td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">${{ $order->final_price }}</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">
                        <a class="btn btn-purple float-left mt-3 mr-2" href="">
                            <i class="mdi mdi-currency-usd ml-1"></i>Pay Now
                        </a>
                        <a href="#" class="btn btn-danger float-left mt-3 mr-2">
                            <i class="mdi mdi-printer ml-1"></i>Print
                        </a>
                        <a href="#" class="btn btn-success float-left mt-3">
                            <i class="mdi mdi-telegram ml-1"></i>Send Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
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
