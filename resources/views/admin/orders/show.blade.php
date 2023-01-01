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


@section('title', 'Orders Details')

@section('breadcamb', 'Orders Details')

@section('content')
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Delivery Address</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mg-b-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Info</th>
                                    <th>Product Size</th>
                                    <th>Product Price</th>
                                    <th>Product Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderProducts as $item)
                                    @php
                                        $product = App\Models\Product::findOrFail($item->product_id);
                                    @endphp
                                    <tr>
                                        <td>
                                            <div>
                                                <img width="55" src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}" alt="{{ $item->product_name }}" loading="lazy" class="img img-thumbnail" />
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="grid">
                                                <span>{{ ucwords($item->product_name) }}</span>
                                                <span>{{ $item->product_code }} -
                                                    {{ $item->product_color }}
                                                </span>
                                            </h6>
                                        </td>
                                        <td>
                                            <div>
                                                {{ $item->product_size }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                ${{ $item->product_price }}
                                            </div>
                                        </td>
                                        <td>
                                            {{ $item->product_qty }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>

    </div>
    <div class="row row-sm">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Delivery Address</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mg-b-0 text-md-nowrap">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>{{ $order->name }}</th>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <th>{{ $order->email }}</th>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <th>{{ $order->address }}</th>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <th>{{ $order->mobile }}</th>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <th>{{ $order->city }}</th>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <th>{{ $order->state }}</th>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <th>{{ $order->country->name }}</th>
                                </tr>
                                <tr>
                                    <th>Charges</th>
                                    <th>${{ $order->shipping_charges }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Order Details</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mg-b-0 text-md-nowrap">
                            <tbody>
                                <tr>
                                    <td>Status </td>
                                    <td>{{ $order->order_status }}</td>
                                </tr>
                                <tr>
                                    <td>Paymeny Method </td>
                                    <td>{{ $order->paymeny_method }}</td>
                                </tr>
                                <tr>
                                    <td>Payment Gateway </td>
                                    <td>{{ $order->paymeny_method }}</td>
                                </tr>
                                <tr>
                                    <td>Final Price </td>
                                    <td class="font-bold bg-success text-white">${{ $order->final_price }}</td>
                                </tr>
                                <tr>
                                    <td>Coupon Code </td>
                                    <td>{{ $order->coupon_code ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Coupon Amount </td>
                                    <td>{{ $order->coupon_amount ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
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
