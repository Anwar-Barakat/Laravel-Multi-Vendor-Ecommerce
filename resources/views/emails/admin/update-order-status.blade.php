@component('mail::message')
# Update Order Status

Dear {{ $order->name }}, Your Order #{{ $order->id }} Status Has Been Updated <br>
To {{ $order->order_status }}, with  {{ config('app.name') }}

@component('mail::button', ['url' => route('front.shopping.store')])
Continue Shopping
@endcomponent

Thanks, Regards<br>
{{ config('app.name') }}
@endcomponent
