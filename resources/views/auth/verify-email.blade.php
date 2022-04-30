<x-guest-layout>
    <div class="card-body login-card-body">
        <p class="login-box-msg">
            @lang('Thanks for signing up! Before getting started, could you verify your email address by clicking on the
            link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.')
        </p>

        <!-- Session Status -->
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                @lang('A new verification link has been sent to the email address you provided during registration.')
            </div>
        @endif

        <form action="{{ route('verification.send') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">@lang('Resend Verification Email')</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="mt-1">
            @csrf

            <button type="submit" class="btn btn-secondary btn-block">@lang('Log Out')</button>
        </form>
    </div>
</x-guest-layout>
