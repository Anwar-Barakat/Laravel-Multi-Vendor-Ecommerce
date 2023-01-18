@extends('admin.layouts.master')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
                <p class="mg-b-0">Sales monitoring dashboard template.</p>
            </div>
        </div>
        <div class="main-dashboard-header-right">
            <div>
                <label class="tx-13">Customer Ratings</label>
                <div class="main-star">
                    <i class="typcn typcn-star active"></i>
                    <i class="typcn typcn-star active"></i>
                    <i class="typcn typcn-star active"></i>
                    <i class="typcn typcn-star active"></i>
                    <i class="typcn typcn-star"></i>
                    <span>({{ App\Models\User::all()->count() }})</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">TODAY REVENUE</h6>
                    </div>
                    @php
                        $ordersCount = App\Models\Order::count();
                        $ordersSum = App\Models\Order::sum('final_price');
                        $todayRevenue = App\Models\Order::whereDate('created_at', \Carbon\Carbon::today())->sum('final_price');
                    @endphp
                    <div class="pb-0 mt-0">
                        <div class="d-flex justify-between">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    {{ number_format($todayRevenue, 2) }}
                                </h4>
                            </div>
                            <span class="my-auto">
                                <span class="text-white op-7"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">TOTAL REVENUE</h6>
                    </div>
                    @php
                        $deliveredSum = App\Models\Order::where('order_status', 'Delivered')->sum('final_price');
                    @endphp
                    <div class="pb-0 mt-0">
                        <div class="d-flex justify-between">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    ${{ number_format($deliveredSum, 2) }}
                                </h4>
                            </div>
                            <span class="my-auto">
                                <span class="text-white op-7">
                                    {{ round(($deliveredSum / $ordersSum) * 100, 2) }}%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">TOTAL ORDERS</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex justify-between">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $ordersCount }}</h4>
                            </div>
                            <span class="my-auto">
                                <span class="text-white op-7">100%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">TOTAL SALES</h6>
                    </div>
                    @php
                        $deliveredOrders = App\Models\Order::where('order_status', 'Delivered')->count();
                    @endphp
                    <div class="pb-0 mt-0">
                        <div class="d-flex justify-between">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    {{ $deliveredOrders }}
                                </h4>
                            </div>
                            <span class="my-auto">
                                <span class="text-white op-7">{{ round(($deliveredOrders / $ordersCount) * 100, 2) }}%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>

    </div>
    <!-- row closed -->
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Orders</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 text-muted mb-0">Order Status and Tracking. Track your order from ship date to arrival.
                        To begin, enter your order number.</p>
                </div>
                <div class="card-body">
                    {!! $ordersChart->renderHtml() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-5">
            <div class="card card-dashboard-map-one">
                <label class="main-content-label">Count of Products</label>
                <span class="d-block mg-b-20 text-muted tx-12">Display products has been added</span>
                <div class="">
                    {!! $chart1->renderHtml() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm row-deck">
        <div class="col-md-12">
            <div class="card card-table-two">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-1">Your Lastest Orders</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <span class="tx-12 tx-muted mb-3 ">This is your five latest order.</span>
                <div class="table-responsive country-table">
                    <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-lg-25p">Customer</th>
                                <th class="wd-lg-25p">Date</th>
                                <th class="wd-lg-25p">Status</th>
                                <th class="wd-lg-25p">Grand Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $latestOrder = App\Models\Order::latest()
                                    ->take(5)
                                    ->get();
                            @endphp
                            @foreach ($latestOrder as $order)
                                <tr>
                                    <td class="tx-medium tx-inverse">
                                        <a href="{{ route('front.orders.show', $order) }}">
                                            #{{ $order->id }}
                                            {{ ucwords($order->name) }}
                                        </a>
                                    </td>
                                    <td>{{ $order->created_at }}</td>
                                    <td class="tx-medium tx-inverse">
                                        <div>
                                            <div class="spinner-grow  spinner-grow-sm {{ $order->order_status }}" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            <span class=" {{ $order->order_status }} cursor-pointer">{{ $order->order_status }}</span>
                                        </div>
                                    </td>
                                    <td class="tx-medium">${{ number_format($order->final_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>

    {!! $ordersChart->renderChartJsLibrary() !!}
    {!! $ordersChart->renderJs() !!}

    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
@endsection
