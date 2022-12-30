<div>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Register</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascrip:void(0);">Vendor Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-account u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-2">
                    <div class="reg-wrapper item p-4">
                        <h2 class="account-h2 u-s-m-b-20 main-title">Vendor Register</h2>
                        <form wire:submit.prevent="storeVendor" method="POST">
                            @csrf
                            <div class="u-s-m-b-30">
                                <label for="name">Name
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="name"
                                    class="text-field @error('name') is-invalid @enderror" placeholder="Your Name"
                                    wire:model="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="email">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" id="email"
                                    class="text-field @error('email') is-invalid @enderror" placeholder="Your Email"
                                    wire:model="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="mobile">Mobile
                                    <span class="astk">*</span>
                                </label>
                                <input type="tel" id="mobile"
                                    class="text-field @error('mobile') is-invalid @enderror" placeholder="Mobile Number"
                                    wire:model="mobile">
                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="password">Password
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="password"
                                    class="text-field @error('password') is-invalid @enderror"
                                    placeholder="Password More than 8 chars" wire:model="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="u-s-m-b-30">
                                <input type="checkbox" class="check-box" id="accept" value="true"
                                    wire:model="accept">
                                <label class="label-text no-color" for="accept">
                                    I’ve read and accept the
                                    <a href="" class="u-c-brand">terms & conditions</a>
                                </label>
                                @error('accept')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="u-s-m-b-45">
                                <button class="button button-primary w-100" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
