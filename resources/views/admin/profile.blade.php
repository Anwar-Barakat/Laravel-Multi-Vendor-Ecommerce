@extends('admin.layouts.master')
@section('css')
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    Profile
@endsection

@php
    $auth = Auth::guard('admin')->user();
@endphp

@section('breadcamb')
    {{ ucwords($auth->type) }} Profile
@endsection

@section('content')
    <!-- row -->

    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">
                                @if ($auth->getFirstMediaUrl('avatars', 'thumb'))
                                    <img src="{{ $auth->getFirstMediaUrl('avatars', 'thumb') }}">
                                @else
                                    <img src="{{ asset('assets/img/faces/6.jpg') }}">
                                @endif
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">{{ $auth->name }}</h5>
                                    <p class="main-profile-name-text">{{ $auth->email }}</p>
                                </div>
                            </div>
                            @if (!empty($auth->about_me))
                                <h6>Bio</h6>
                                <div class="main-profile-bio">
                                    {{ $auth->about_me }}
                                </div>
                            @endif
                            <hr class="mg-y-30">
                            <label class="main-content-label tx-13 mg-b-20">Social</label>
                            <div class="main-profile-social-list">
                                <div class="media">
                                    <div class="media-icon bg-primary-transparent text-primary">
                                        <i class="icon ion-logo-github"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Github</span> <a href="">github.com/spruko</a>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon bg-success-transparent text-success">
                                        <i class="icon ion-logo-twitter"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Twitter</span> <a href="">twitter.com/spruko.me</a>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon bg-info-transparent text-info">
                                        <i class="icon ion-logo-linkedin"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>Linkedin</span> <a href="">linkedin.com/in/spruko</a>
                                    </div>
                                </div>
                                <div class="media">
                                    <div class="media-icon bg-danger-transparent text-danger">
                                        <i class="icon ion-md-link"></i>
                                    </div>
                                    <div class="media-body">
                                        <span>My Portfolio</span> <a href="">spruko.com/</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- main-profile-overview -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row row-sm">
                <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon bg-primary-transparent">
                                    <i class="icon-layers text-primary"></i>
                                </div>
                                <div class="mr-auto">
                                    <h5 class="tx-13">Orders</h5>
                                    <h2 class="tx-22 mb-1 mt-1">1,587</h2>
                                    <p class="text-muted mb-0 tx-11"><i
                                            class="si si-arrow-up-circle text-success mr-1"></i>increase</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon bg-danger-transparent">
                                    <i class="icon-paypal text-danger"></i>
                                </div>
                                <div class="mr-auto">
                                    <h5 class="tx-13">Revenue</h5>
                                    <h2 class="tx-22 mb-1 mt-1">46,782</h2>
                                    <p class="text-muted mb-0 tx-11"><i
                                            class="si si-arrow-up-circle text-success mr-1"></i>increase</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="counter-status d-flex md-mb-0">
                                <div class="counter-icon bg-success-transparent">
                                    <i class="icon-rocket text-success"></i>
                                </div>
                                <div class="mr-auto">
                                    <h5 class="tx-13">Product sold</h5>
                                    <h2 class="tx-22 mb-1 mt-1">1,890</h2>
                                    <p class="text-muted mb-0 tx-11"><i
                                            class="si si-arrow-up-circle text-success mr-1"></i>increase</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                            <li class="active">
                                <a href="#home" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs">
                                        <i class="las la-user-circle tx-16 mr-1"></i>
                                    </span>
                                    <span class="hidden-xs">ABOUT ME</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#update_password" data-toggle="tab" aria-expanded="false">
                                    <span class="visible-xs">
                                        <i class="las la-lock tx-15 mr-1"></i>
                                    </span>
                                    <span class="hidden-xs">Update Password</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#settings" data-toggle="tab" aria-expanded="false">
                                    <span class="visible-xs">
                                        <i class="las la-cog tx-16 mr-1"></i>
                                    </span>
                                    <span class="hidden-xs">SETTINGS</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                        <div class="tab-pane active" id="home">
                            <h4 class="tx-15 text-uppercase mb-3">BIOdata</h4>
                            <p class="m-b-5">{{ $auth->about_me }}</p>
                        </div>
                        <div class="tab-pane" id="update_password">
                            <form role="form" action="{{ route('admin.update_password') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" value="" id="old_password" name="old_password"
                                        class="form-control @error('old_password') is-invalid @enderror">
                                    <small id="password_checked"></small>
                                    @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" value="" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="confirmation_password">Confirmation Password</label>
                                    <input type="password" value="" id="confirmation_password"
                                        name="confirmation_password"
                                        class="form-control @error('confirmation_password') is-invalid @enderror">
                                    @error('confirmation_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                                <button class="btn btn-primary waves-effect waves-light w-md" type="submit">
                                    Update
                                </button>
                            </form>
                        </div>
                        <div class="tab-pane" id="settings">
                            <form role="form" action="{{ route('admin.update_details') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" value="{{ $auth->email }}" id="Email"
                                        class="form-control " disabled readonly>
                                </div>
                                <div class="form-group">
                                    <label for="type">Admin Type</label>
                                    <input type="text" value="{{ $auth->type }}" id="type"
                                        class="form-control " disabled readonly>
                                </div>
                                <div class="form-group">
                                    <label for="FullName">Full Name</label>
                                    <input type="text" value="{{ old('name', $auth->name) }}" id="FullName"
                                        class="form-control @error('name') is-invalid @enderror" name="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="tel" name="mobile" value="{{ old('mobile', $auth->mobile) }}"
                                        id="mobile" class="form-control @error('mobile') is-invalid @enderror">
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="AboutMe">About Me</label>
                                    <textarea id="AboutMe" class="form-control @error('about_me') is-invalid @enderror" name="about_me"
                                        rows="4">{{ old('about_me', $auth->about_me) }}
                                    </textarea>
                                    @error('about_me')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group" style="width: 50%;">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" class="dropify" data-height="200" name="avatar" />
                                    @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                                <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Update
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/custom/admin-password-check.js') }}"></script>
@endpush
