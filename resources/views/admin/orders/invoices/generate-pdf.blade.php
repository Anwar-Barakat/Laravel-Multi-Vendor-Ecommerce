<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{ $order->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
            text-align: right
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }

        .block {
            display: block
        }

        .mt-2 {
            margin-top: 8px
        }

        .code {
            align-items: center;
            display: inline-flex !important;
            gap: 1rem;
            margin: 10px 0;
        }
    </style>
</head>

<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">{{ config('app.name') }}</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: #{{ $order->id }}</span> <br>
                    <span>Date: {{ $order->created_at }}</span> <br>
                    <span class="code">
                        <span>Barcode : </span>
                        <span>
                            @php
                                echo DNS1D::getBarcodeHTML($order->id, 'C39E+');
                            @endphp
                        </span>
                    </span> <br>
                    <span>Address: {{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->country->name }}</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Order Details</th>
                <th width="50%" colspan="2">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Id:</td>
                <td>6</td>

                <td>Full Name:</td>
                <td>{{ $order->name }}</td>
            </tr>
            <tr>
                <td>Tracking Id/No.:</td>
                <td>{{ $order->tracking_number }}</td>

                <td>Email Id:</td>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d h-m-i A') }}</td>

                <td>Phone:</td>
                <td>{{ $order->mobile }}</td>
            </tr>
            <tr>
                <td>Payment Method:</td>
                <td>{{ $order->paymeny_method }}</td>

                <td>Address:</td>
                <td>{{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->country->name }}</td>
            </tr>
            <tr>
                <td>Order Status:</td>
                <td>{{ $order->order_status }}</td>

                <td>Final Price:</td>
                <td>{{ $order->final_price }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th>Item</th>
                <th>Size</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
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
                <td colspan="4" class="total-heading">Sub-Total</small> :</td>
                <td colspan="1" class="total-heading">${{ number_format($subTotal, 2) }}</td>
            </tr>
            <tr>
                <td colspan="4" class="total-heading">Shipping Charges</small> :</td>
                <td colspan="1" class="total-heading">${{ number_format($order->shipping_charges, 2) }}</td>
            </tr>
            <tr>
                <td colspan="4" class="total-heading">Coupon Amount</small> :</td>
                <td colspan="1" class="total-heading">-${{ number_format($order->coupon_amount, 2) ?? '0' }}</td>
            </tr>
            <tr>
                <td colspan="4" class="total-heading">Total Due</small> :</td>
                <td colspan="1" class="total-heading">${{ number_format((float) $order->final_price, 2) ?? '0' }}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Thank your for shopping with {{ config('app.name') }}
    </p>

</body>

</html>
