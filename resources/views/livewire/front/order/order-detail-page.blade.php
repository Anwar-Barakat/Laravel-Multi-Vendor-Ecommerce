<div>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Order Details</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascriot:;">Order Details</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Cart-Page -->
    <div class="page-cart u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-wrapper u-s-m-b-60">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product Image</th>
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
                                            <div class="cart-anchor-image">
                                                <a class="d-flex align-items-center gap-2" href="{{ route('front.product.detail', ['productId' => $item->product_id]) }}">
                                                    <img src="{{ $product->getFirstMediaUrl('main_img_of_product', 'small') }}" alt="{{ $item->product_name }}" loading="lazy" class="img img-thumbnail" />
                                                    <h6 class="grid">
                                                        <span>{{ ucwords($item->product_name) }}</span>
                                                        <span>{{ $item->product_code }} -
                                                            {{ $item->product_color }}
                                                        </span>
                                                    </h6>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-price">
                                                {{ $item->product_size }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-price">
                                                ${{ $item->product_price }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-quantity">
                                                <div class="quantity">
                                                    <input type="text" class="quantity-text-field" value="{{ $item->product_qty }}" readonly>
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
            <div class="row justify-between">
                <div class="col-lg-6">
                    <div class="calculation u-s-m-b-60 ml-0">
                        <div class="table-wrapper-2">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            <span>Delivery Addresses</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Name </h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->name }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Email </h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->email }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Address </h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->address }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Mobile</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->mobile }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">City</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->city }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">State</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->state }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Country</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->country->name }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Shipping Charges</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">${{ $order->shipping_charges }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="calculation u-s-m-b-60">
                        <div class="table-wrapper-2">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            <span>Order Details</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Status</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->order_status }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Paymeny Method</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->paymeny_method }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Payment Gateway</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->paymeny_method }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Final Price</h3>
                                        </td>
                                        <td class="bg-green-700">
                                            <span class="calc-text font-bold text-white">${{ $order->final_price }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Coupon Code</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->coupon_code ?? '' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Coupon Amount</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->coupon_amount ?? '' }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="calculation u-s-m-b-60">
                        <div class="table-wrapper-2">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            <span>Update Order Status</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Status</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->order_status }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Paymeny Method</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->paymeny_method }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Payment Gateway</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->paymeny_method }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Final Price</h3>
                                        </td>
                                        <td class="bg-green-700">
                                            <span class="calc-text font-bold text-white">${{ $order->final_price }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Coupon Code</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->coupon_code ?? '' }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Coupon Amount</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">{{ $order->coupon_amount ?? '' }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
