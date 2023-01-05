@component('mail::message')
# Update Order Status

Dear {{ $order->name }}, Your Order #{{ $order->id }} Status Has Been Updated <br>
To {{ $order->order_status }},
@if ($order->order_status == 'Shipped')
The Courier Name is {{ $order->courier_name }}, and Tracking Number is {{ $order->tracking_number }} <br>
with  {{ config('app.name') }} <br>
@endif

@component('mail::button', ['url' => route('front.shopping.store')])
Continue Shopping
@endcomponent

Thanks, Regards<br>
{{ config('app.name') }}
@endcomponent
