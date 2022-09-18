@extends('admin.layouts.master')
@section('css')
@endsection

@section('breadcamb')
    Profile
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
                                <img alt="" src="{{ URL::asset('assets/img/faces/6.jpg') }}"><a
                                    class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a>
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">{{ Auth::guard('admin')->user()->name }}</h5>
                                    <p class="main-profile-name-text">{{ Auth::guard('admin')->user()->email }}</p>
                                </div>
                            </div>
                            @if (!empty(Auth::guard('admin')->user()->about_me))
                                <h6>Bio</h6>
                                <div class="main-profile-bio">
                                    {{ Auth::guard('admin')->user()->about_me }}
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
                                    <h2 class="mb-0 tx-22 mb-1 mt-1">1,587</h2>
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
                                    <h2 class="mb-0 tx-22 mb-1 mt-1">46,782</h2>
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
                                    <h2 class="mb-0 tx-22 mb-1 mt-1">1,890</h2>
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
                            <p class="m-b-5">{{ Auth::guard('admin')->user()->about_me }}</p>
                        </div>
                        <div class="tab-pane" id="update_password">
                            <form role="form" action="{{ route('admin.admin-setting.update', 'test') }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input type="password" value="" id="old_password" name="old_password"
                                        class="form-control @error('old_password') is-invalid @enderror">
                                    @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" value="" id="new_password" name="new_password"
                                        class="form-control @error('new_password') is-invalid @enderror">
                                    @error('new_password')
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
                            <form role="form" action="{{ route('admin.admin-setting.update', 'test') }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" value="{{ Auth::guard('admin')->user()->email }}"
                                        id="Email" class="form-control " disabled readonly>
                                </div>
                                <div class="form-group">
                                    <label for="type">Admin Type</label>
                                    <input type="text" value="{{ Auth::guard('admin')->user()->type }}"
                                        id="type" class="form-control " disabled readonly>
                                </div>
                                <div class="form-group">
                                    <label for="FullName">Full Name</label>
                                    <input type="text" value="{{ old('name', Auth::guard('admin')->user()->name) }}"
                                        id="FullName" class="form-control @error('name') is-invalid @enderror"
                                        name="name">
                                </div>
                                <div class="form-group">
                                    <label for="AboutMe">About Me</label>
                                    <textarea id="AboutMe" class="form-control @error('about_me') is-invalid @enderror" name="about_me"
                                        rows="4">{{ old('about_me', Auth::guard('admin')->user()->about_me) }}
                                    </textarea>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                        {{ Auth::guard('admin')->user()->status == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customSwitch1">Status</label>
                                </div>
                                <hr>
                                <button class="btn btn-primary waves-effect waves-light w-md"
                                    type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
