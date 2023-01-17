<x-master-layout>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Confirm Your Password</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascrip:void(0);">Confirm Your Password</a>
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
                        <h2 class="account-h1">Confirm Your Password</h2>

                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                        </div>

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <!-- Password -->
                            <div>
                                <x-label for="password" :value="__('Password')" />

                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                            </div>

                            <div class="flex justify-end mt-4">
                                <button class="button button-outline-secondary" type="submit">
                                    {{ __('Confirm') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
