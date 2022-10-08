@extends('admin.layouts.master2')

@section('title')
    Admin Login
@stop
@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="main-signup-header">
                                        <h2>Multi Vendor Store</h2>
                                        <h5 class="font-weight-semibold mb-4">Admin Login</h5>
                                        <form method="POST" action="{{ route('admin.login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label>E-mail Address</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email" id="email"
                                                    autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Password</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password" id="password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary-gradient btn-block">
                                                Login
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->

            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex p-0">
                <img src="https://i.postimg.cc/cHkffzLS/shopping2.jpg" style="object-fit: cover" alt="logo">
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
