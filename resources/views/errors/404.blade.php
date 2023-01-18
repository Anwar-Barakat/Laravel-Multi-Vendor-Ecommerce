<!DOCTYPE html>
<html class="no-js" lang="en-US">

<head>
    <meta charset="UTF-8" />
    <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>
        Multi Vendor E-commerce Website by Stack Developers Youtube Channel
    </title>
    <!-- Standard Favicon -->
    <link href="favicon.ico" rel="shortcut icon" />
    <!-- Base Google Font for Web-app -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" />
    <!-- Google Fonts for Banners only -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet" />
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}" />
    <!-- Utility -->
    <link rel="stylesheet" href="{{ asset('front/css/utility.css') }}" />
    <!-- Main -->
    <link rel="stylesheet" href="{{ asset('front/css/bundle.css') }}" />
</head>

<body>
    <!-- app -->
    <div id="app">
        <!-- 404-Page -->
        <div class="page-404">
            <div class="vertical-center">
                <div class="text-center">
                    <h1>404!</h1>
                    <h5>We can't seem to find the page you're looking for.</h5>
                    <div class="redirect-link-wrapper u-s-p-t-25">
                        <a class="redirect-link" href="{{ route('front.home') }}">
                            <span>Home</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 404-Page /- -->
    </div>
</body>

</html>
