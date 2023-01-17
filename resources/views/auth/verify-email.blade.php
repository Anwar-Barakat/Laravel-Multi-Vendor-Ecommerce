<x-master-layout>
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Verify Your Email</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="{{ route('front.home') }}">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="javascrip:void(0);">Verify Your Email</a>
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
                        <h2 class="account-h1">Email Verification</h2>

                        <div class="mb-4 text-sm text-gray-600 mt-4 alert alert-success">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600 alert alert-success">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <div class="mt-4 flex items-center justify-between">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div>
                                    <button class="button button-primary" type="submit">
                                        {{ __('Resend Verification Email') }}
                                    </button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
