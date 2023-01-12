<x-master-layout>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Login</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascrip:void(0);">Customer Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-account u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="reg-wrapper item p-4">
                        <h2 class="account-h2 u-s-m-b-20 main-title md:text-sm">Customer Login</h2>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="text-field mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-label for="password" :value="__('Password')" />

                                <x-input id="password" class="text-field mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                            </div>

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-between mt-4">
                                <div>
                                    @if (Route::has('password.request'))
                                        <a class="block underline text-sm text-gray-600 hover:text-gray-900 mb-2" href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif

                                    <a class="block underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                                        {{ __('You don\'t have an account?') }}
                                    </a>
                                </div>

                                <button class="ml-4 button button-primary" type="submit">
                                    {{ __('Log in') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
