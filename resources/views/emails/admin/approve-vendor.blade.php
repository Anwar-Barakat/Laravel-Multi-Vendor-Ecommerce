@component('mail::message')
# Approve Vendor Account

Welcome {{ ucwords($vendor->name) }}<br>
your email is {{ $vendor->email }} <br>
your account will be approved. therefor, you can login and add your products

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
