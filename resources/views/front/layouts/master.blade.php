<!DOCTYPE html>
<html class="no-js" lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('front/images/favicon/favicon.ico') }}" type="image/x-icon" />
    <link rel="icon" href="{{ asset('front/images/favicon/favicon.ico') }}" type="image/x-icon" />

    @include('front.layouts.head')

    @livewireStyles
</head>

<body>
    <div id="global-loader">
        <img src="{{ URL::asset('assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <div id="app">
        @livewire('front.main-header')

        {{ $slot }}

        <!-- Footer -->
        @include('front.layouts.footer')
        <!-- Footer /- -->

        @include('front.layouts.modals')
    </div>
    <!-- app /- -->

    <!-- NoScript -->
    <noscript>
        <div class="app-issue">
            <div class="vertical-center">
                <div class="text-center">
                    <h1>JavaScript is disabled in your browser.</h1>
                    <span>Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser.</span>
                </div>
            </div>
        </div>
        <style>
            #app {
                display: none;
            }
        </style>
    </noscript>
    @include('front.layouts.footer-scripts')
    @livewireScripts
</body>

</html>
