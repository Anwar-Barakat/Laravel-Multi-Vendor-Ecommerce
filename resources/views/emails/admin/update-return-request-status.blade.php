@component('mail::message')
# Update Return Request Status

Welcome to Our Multi-Vendor E-Commerce Website <br>
Your Return Request Status For Order  #{{ $returnRequest->order->id }} Has Been Updated to {{ $returnRequest->status }} 

@component('mail::button', ['url' => route('front.shopping.store')])
Continue Shopping
@endcomponent

Thanks, Regards<br>
{{ config('app.name') }}
@endcomponent
