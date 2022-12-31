<div>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Thanks Page</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="track-order.html">Thanks Page</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Track-Order-Page -->
    <div class="page-track-order u-s-p-t-80">
        <div class="container">
            <div class="track-order-wrapper text-center">
                <h2 class="track-order-h2 u-s-m-b-20 ">Your Order Has been Placed Successfully</h2>
                <h5 class="text-lg-center">
                    Your order number is <span class="font-bold text-green-600">{{ session()->get('orderId') }}</span>
                    and Grand Total is <span class="font-bold text-green-600">${{ session()->get('grandTotal') }}</span>
                </h5>
                <a href="{{ route('front.shopping.store') }}" class="custom-btn mt-3">Continue Shopping</a>
            </div>
        </div>
    </div>
</div>

@php
    session()->forget('orderId');
    session()->forget('grandTotal');
    session()->forget('coupon');
@endphp
