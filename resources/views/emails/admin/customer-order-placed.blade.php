@component('mail::message')
# Order Placed

Dear {{ $order->name }}, Your Order #{{ $order->id }} Has Been Placed <br>
With {{ config('app.name') }}.<br>
Your Order Details :<br>

@component('mail::table')
|  Name  |  Code  |   Color|  Size  |  Qty   | Price  |
| :-----------   | :-----------   | :-----------   | :-----------   | :-----------   | :----------- |
@foreach ($order->orderProducts as $p)
| {{ $p->product_name }} | {{ $p->product_code }} | {{ $p->product_color }} | {{ $p->product_size }} | {{ $p->product_qty }} | {{ $p->product_price }} |
@endforeach
| :-----------   | :-----------  |  :-----------   |  :-----------  |  Shipping Charges | {{ $order->shipping_charges ?? '0' }} |
| :-----------   | :-----------  |  :-----------   |  :-----------  |  Coupon Discount  | {{ $order->coupon_amount ?? '-' }} |
| :-----------   | :-----------  |  :-----------   |  :-----------  |  Final Price      | ${{ $order->final_price }} |
@endcomponent

Your Delivery Address :<br>
@component('mail::table')
|  Name  |  Address  |   Mobile |  City  |  State   | Country  |
| :-----------   | :-----------   | :-----------   | :-----------   | :-----------   | :----------- |
| {{ $p->name }} | {{ $p->address }} | {{ $p->mobile }} | {{ $p->city }} | {{ $p->state }} | {{ $p->country->name }} |
@endcomponent


We Will Intimate You Once Your Order Is Shipped.

@component('mail::button', ['url' => route('front.shopping.store')])
    Contine Shopping
@endcomponent

Thanks, Regards<br>
{{ config('app.name') }}
@endcomponent
`