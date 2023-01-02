@component('mail::message')
# Order Placed

Dear {{ $order->name }}, Your Order #{{ $order->id }} Has Been Placed <br>
With {{ config('app.name') }}.<br>
Your Order Details :<br>

| Product Name | Product Code| Product Color| Product Size| Product Qty|Product Price|
| :--- | :----: | :----: | :----: | :----: | ----: |
@foreach ($order->orderProducts as $p)
| {{ $p->product_name }} | {{ $p->product_code }} | {{ $p->product_color }} | {{ $p->product_size }} | {{ $p->product_qty }} | {{ $p->product_price }} |
@endforeach

We Will Intimate You Once Your Order Is Shipped.

@component('mail::button', ['url' => route('front.shopping.store')])
    Contine Shopping
@endcomponent

Thanks, Regards<br>
{{ config('app.name') }}
@endcomponent
