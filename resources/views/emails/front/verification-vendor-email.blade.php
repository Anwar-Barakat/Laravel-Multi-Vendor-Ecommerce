@php
    $code = base64_encode($vendor->email);
@endphp
@component('mail::message')
# Introduction

Welcome {{ ucwords($vendor->name) }}<br>
your email is {{ $vendor->email }} <br>
Please, confirm your email to activate your vendor account.
@component('mail::button', ['url' => route('vendor.activate.account', $code)])
    Click here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
