@extends('admin.layouts.master')
@section('css')
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
@endsection

@section('title')
    Profile
@endsection

@section('breadcamb')
    {{ Auth::guard('admin')->user()->type }} Profile
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
                                @if (Auth::guard('admin')->user()->getFirstMediaUrl('avatars', 'thumb'))
                                    <img src="{{ Auth::guard('admin')->user()->getFirstMediaUrl('avatars', 'thumb') }}">
                                @else
                                    <img src="{{ asset('assets/img/faces/6.jpg') }}">
                                @endif
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
                                <a href="#personal_info" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs">
                                        <i class="las la-user-circle tx-16 mr-1"></i>
                                    </span>
                                    <span class="hidden-xs">Personal Info</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#business_info" data-toggle="tab" aria-expanded="false">
                                    <span class="visible-xs">
                                        <i class="las la-business-time tx-15 mr-1"></i>
                                    </span>
                                    <span class="hidden-xs">Business Info</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#bank_info" data-toggle="tab" aria-expanded="false">
                                    <span class="visible-xs">
                                        <i class="las la-money-bill-wave-alt tx-16 mr-1"></i>
                                    </span>
                                    <span class="hidden-xs">Bank Info</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                        <div class="tab-pane active" id="personal_info">
                            <form role="form" action="{{ route('vendor.peronsal-info.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @php
                                    $auth = Auth::guard('admin')->user();
                                @endphp
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="Email">Email</label>
                                        <input type="email" value="{{ $auth->email }}" id="Email"
                                            class="form-control " disabled readonly>
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="name">Full Name</label>
                                        <input type="text" value="{{ old('name', $auth->vendor->name) }}"
                                            name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="address">Address</label>
                                        <input type="text" name="address"
                                            value="{{ old('address', $auth->vendor->address) }}" id="address"
                                            class="form-control @error('address') is-invalid @enderror">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="city">City</label>
                                        <input type="text" name="city"
                                            value="{{ old('city', $auth->vendor->city) }}" id="city"
                                            class="form-control @error('city') is-invalid @enderror">
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="state">state</label>
                                        <input type="text" name="state"
                                            value="{{ old('state', $auth->vendor->state) }}" id="state"
                                            class="form-control @error('state') is-invalid @enderror">
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="country_id">country</label>
                                        <select name="country_id" class="form-control">
                                            <option value="" selected>Select...</option>
                                            @foreach (App\Models\Country::where('status', 1)->get() as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ old('country_id', $auth->vendor->country->id) == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="pincode">pincode</label>
                                        <input type="text" name="pincode"
                                            value="{{ old('pincode', $auth->vendor->pincode) }}" id="pincode"
                                            class="form-control @error('pincode') is-invalid @enderror">
                                        @error('pincode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12">
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
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="mobile">Mobile</label>
                                        <input type="tel" name="mobile"
                                            value="{{ old('mobile', $auth->vendor->mobile) }}" id="mobile"
                                            class="form-control @error('mobile') is-invalid @enderror">
                                        @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="avatar">Avatar</label>
                                        <input type="file" class="dropify" data-height="200" name="avatar" />
                                        @error('avatar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Update
                                </button>
                            </form>
                        </div>
                        <div class="tab-pane" id="business_info">
                            @if ($errors->any())
                                {{ implode('', $errors->all('<div>:message</div>')) }}
                            @endif
                            <form role="form" action="{{ route('vendor.business-info.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @php
                                    $vendorBusiness = Auth::guard('admin')->user()->vendor->businessInfo;
                                @endphp
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        @if ($vendorBusiness->getFirstMediaUrl('vendor_address_proof_images'))
                                            <img src="{{ $vendorBusiness->getFirstMediaUrl('vendor_address_proof_images') }}"
                                                alt="">
                                            <hr>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="Email">Email</label>
                                        <input type="email" value="{{ Auth::guard('admin')->user()->email }}"
                                            id="Email" class="form-control " disabled readonly>
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="shop_name">Shop name</label>
                                        <input type="text" value="{{ old('shop_name', $vendorBusiness->shop_name) }}"
                                            name="shop_name" id="shop_name"
                                            class="form-control @error('shop_name') is-invalid @enderror">
                                        @error('shop_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="shop_address">Shop address</label>
                                        <input type="text"
                                            value="{{ old('shop_address', $vendorBusiness->shop_address) }}"
                                            name="shop_address" id="shop_address"
                                            class="form-control @error('shop_address') is-invalid @enderror">
                                        @error('shop_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="shop_city">Shop city</label>
                                        <input type="text" value="{{ old('shop_city', $vendorBusiness->shop_city) }}"
                                            name="shop_city" id="shop_city"
                                            class="form-control @error('shop_city') is-invalid @enderror">
                                        @error('shop_city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="shop_state">Shop state</label>
                                        <input type="text"
                                            value="{{ old('shop_state', $vendorBusiness->shop_state) }}"
                                            name="shop_state" id="shop_state"
                                            class="form-control @error('shop_state') is-invalid @enderror">
                                        @error('shop_state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="shop_country_id">Shop country</label>
                                        <select name="shop_country_id"
                                            class="form-control @error('shop_country_id') is-invalid @enderror">
                                            <option value="" selected>Select</option>
                                            @foreach (App\Models\Country::where('status', 1)->get() as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ old('shop_country_id', $vendorBusiness->shop_country_id) == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('shop_country_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="shop_pincode">Shop pincode</label>
                                        <input type="text" name="shop_pincode"
                                            value="{{ old('shop_pincode', $vendorBusiness->shop_pincode) }}"
                                            id="shop_pincode"
                                            class="form-control @error('shop_pincode') is-invalid @enderror">
                                        @error('shop_pincode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="shop_mobile">Shop mobile</label>
                                        <input type="tel" name="shop_mobile"
                                            value="{{ old('shop_mobile', $vendorBusiness->shop_mobile) }}"
                                            id="shop_mobile"
                                            class="form-control @error('shop_mobile') is-invalid @enderror">
                                        @error('shop_mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="shop_email">Shop Email</label>
                                        <input type="email" name="shop_email"
                                            value="{{ old('shop_email', $vendorBusiness->shop_email) }}" id="shop_email"
                                            class="form-control @error('shop_email') is-invalid @enderror">
                                        @error('shop_email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="shop_website">Shop website</label>
                                        <input type="text" name="shop_website"
                                            value="{{ old('shop_website', $vendorBusiness->shop_website) }}"
                                            id="shop_website"
                                            class="form-control @error('shop_website') is-invalid @enderror">
                                        @error('shop_website')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="address_proof">Address proof</label>
                                        <select name="address_proof"
                                            class="form-control @error('address_proof') is-invalid @enderror">
                                            <option value="" selected>Select...</option>
                                            @foreach (App\Models\Vendor::ADDRESSPROOF as $key => $address)
                                                <option value="{{ $key }}"
                                                    {{ $vendorBusiness->address_proof == $key ? 'selected' : '' }}>
                                                    {{ strtoupper(str_replace('_', ' ', $address)) }}</option>
                                            @endforeach
                                        </select>
                                        @error('address_proof')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="business_license_number">Business license number</label>
                                        <input type="text" name="business_license_number"
                                            value="{{ old('business_license_number', $vendorBusiness->business_license_number) }}"
                                            id="business_license_number"
                                            class="form-control @error('business_license_number') is-invalid @enderror">
                                        @error('business_license_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="gst_number">GST number</label>
                                        <input type="text" name="gst_number"
                                            value="{{ old('gst_number', $vendorBusiness->gst_number) }}" id="gst_number"
                                            class="form-control @error('gst_number') is-invalid @enderror">
                                        @error('gst_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="pan_number">PAN number</label>
                                        <input type="text" name="pan_number"
                                            value="{{ old('pan_number', $vendorBusiness->pan_number) }}" id="pan_number"
                                            class="form-control @error('pan_number') is-invalid @enderror">
                                        @error('pan_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="address_proof_image">Address proof image</label>
                                        <input type="file" class="dropify" data-height="200"
                                            name="address_proof_image" />
                                        @error('address_proof_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Update
                                </button>
                            </form>
                        </div>
                        <div class="tab-pane" id="bank_info">
                            <form role="form" action="{{ route('vendor.bank-info.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                @php
                                    $vendorBank = Auth::guard('admin')->user()->vendor->bankInfo;
                                @endphp
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="Email">Email</label>
                                        <input type="email" value="{{ Auth::guard('admin')->user()->email }}"
                                            id="Email" class="form-control " disabled readonly>
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="account_holder_name">Account holder name</label>
                                        <input type="text"
                                            value="{{ old('account_holder_name', $vendorBank->account_holder_name) }}"
                                            name="account_holder_name" id="account_holder_name"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('account_holder_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="bank_name">Bank name</label>
                                        <input type="text" value="{{ old('bank_name', $vendorBank->bank_name) }}"
                                            name="bank_name" id="bank_name"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('bank_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="account_number">Account number</label>
                                        <input type="number"
                                            value="{{ old('account_number', $vendorBank->account_number) }}"
                                            name="account_number" id="account_number"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('account_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12 col-lg-6">
                                        <label for="bank_ifsc_code">Bank IFSC code</label>
                                        <input type="text"
                                            value="{{ old('bank_ifsc_code', $vendorBank->bank_ifsc_code) }}"
                                            name="bank_ifsc_code" id="bank_ifsc_code"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('bank_ifsc_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
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
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/custom/admin-password-check.js') }}"></script>
@endpush
