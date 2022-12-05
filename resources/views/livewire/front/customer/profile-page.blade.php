<div>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Profile</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascrip:void(0);">Customer Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-account u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="reg-wrapper wide item main-shadow p-4">
                        <h2 class="account-h2 u-s-m-b-20 md:text-sm main-title">Customer Profile</h2>
                        <form>
                            <div class="row mt-4">
                                <div class="form-group col-lg-6 col-md-12">
                                    <x-label for="name" :value="__('Name')" />
                                    <x-input id="name" class="text-field mt-1 w-full" type="text" :value="old('name', Auth::user()->name)" required autofocus />
                                </div>
                                <div class="form-group col-lg-6 col-md-12">
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input class="text-field mt-1 w-full" type="email" name="email" :value="Auth::user()->email" disabled />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="form-group col-lg-4 col-md-12">
                                    <x-label for="address" :value="__('Address')" />
                                    <x-input id="address" class="text-field mt-1 w-full" type="text" :value="old('address', Auth::user()->address)" required autofocus />
                                </div>
                                <div class="form-group col-lg-4 col-md-12">
                                    <x-label for="mobile" :value="__('Mobile')" />
                                    <x-input id="mobile" class="text-field mt-1 w-full" type="text" :value="old('mobile', Auth::user()->mobile)" required autofocus />
                                </div>
                                <div class="form-group col-lg-4 col-md-12">
                                    <x-label for="city" :value="__('City')" />
                                    <x-input id="city" class="text-field mt-1 w-full" type="text" :value="old('city', Auth::user()->city)" required autofocus />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="form-group col-lg-4 col-md-12">
                                    <x-label for="state" :value="__('State')" />
                                    <x-input id="state" class="text-field mt-1 w-full" type="text" :value="old('state', Auth::user()->state)" required autofocus />
                                </div>
                                <div class="form-group col-lg-4 col-md-12">
                                    <x-label for="country" :value="__('Coutry')" />
                                    <select id="country" class="text-field mt-1 w-full">
                                        <option value="" selected>Select...</option>
                                        @foreach (App\Models\Country::active()->get() as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-4 col-md-12">
                                    <x-label for="pincode" :value="__('Pincode')" />
                                    <x-input id="pincode" class="text-field mt-1 w-full" type="text" :value="old('pincode', Auth::user()->pincode)" required autofocus />
                                </div>

                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4 button button-primary">
                                    {{ __('Register') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
