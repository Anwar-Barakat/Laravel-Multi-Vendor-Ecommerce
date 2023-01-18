@component('mail::message')
# Update Exchange Request Status

Welcome to Our Multi-Vendor E-Commerce Website <br>
And Your Exchange Request Status For Order #{{ $exchangeRequest->order->id }} Has Been Updated to {{ $exchangeRequest->status }} 

@component('mail::button', ['url' => route('front.shopping.store')])
Continue Shopping
@endcomponent

Thanks, Regards<br>
{{ config('app.name') }}
@endcomponent
