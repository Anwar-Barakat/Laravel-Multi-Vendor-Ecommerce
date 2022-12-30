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
                    <div class="reg-wrapper wide item p-4">
                        <h2 class="account-h2 u-s-m-b-20 md:text-sm main-title">Customer Profile</h2>
                        <form>
                            <div class="row mt-4">
                                <div class="form-group col-lg-6 col-md-12">
                                    <x-label for="name" :value="__('Name')" />
                                    <input id="name" wire:model="name" class="text-field mt-1 w-full" type="text" required autofocus />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-md-12">
                                    <x-label for="email" :value="__('Email')" />
                                    <input id="email" wire:model="email" class="text-field mt-1 w-full" type="email" name="email" disabled />
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="form-group col-lg-4 col-md-12">
                                    <x-label for="address" :value="__('Address')" />
                                    <input id="address" wire:model="address" class="text-field mt-1 w-full" type="text" required />
                                    @error('adress')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-4 col-md-12">
                                    <x-label for="mobile" :value="__('Mobile')" />
                                    <input id="mobile" wire:model="mobile" class="text-field mt-1 w-full" type="tel" required />
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-4 col-md-12">
                                    <x-label for="city" :value="__('City')" />
                                    <input id="city" wire:model="city" class="text-field mt-1 w-full" type="text" required />
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="form-group col-lg-4 col-md-12">
                                    <x-label for="state" :value="__('State')" />
                                    <input id="state" wire:model="state" class="text-field mt-1 w-full" type="text" required />
                                    @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-4 col-md-12">
                                    <x-label for="country_id" :value="__('Coutry')" />
                                    <select id="country_id" class="text-field mt-1 w-full" wire:model="country_id">
                                        <option value="" selected>Select...</option>
                                        @foreach (App\Models\Country::active()->get() as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-4 col-md-12">
                                    <x-label for="pincode" :value="__('Pincode')" />
                                    <input id="pincode" wire:model="pincode" class="text-field mt-1 w-full" type="text" required />
                                    @error('pincode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button class="ml-4 button button-primary" wire:click.prevent="storeCustomer">
                                    {{ __('Update Profile') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
