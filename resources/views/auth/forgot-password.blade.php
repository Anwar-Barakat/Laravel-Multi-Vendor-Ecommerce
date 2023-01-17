<x-master-layout>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Lost Password</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascrip:void(0);">Lost Password</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="page-account u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="reg-wrapper item p-4 ">
                        <h2 class="account-h1">Forget Password</h2>

                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button class="button button-outline-secondary" type="submit">
                                    {{ __('Email Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
