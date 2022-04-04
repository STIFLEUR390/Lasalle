<x-guest-layout>
    <div class="card-body register-card-body">
        <p class="login-box-msg">@lang("Register a new membership")</p>

        <form action="{{ route('register') }}" method="post">
            @csrf

            <div class="input-group mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('Name')" name="name" value="{{ old('name') }}"
                    required autofocus autocomplete="name">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                @error('name') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="input-group mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('Email')" name="email"
                    value="{{ old('email') }}" required />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="@lang('Password')" name="password" required
                    autocomplete="new-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password') <span class="error invalid-feedback">{{ $message }}</span> @enderror
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="@lang('Confirm Password')"
                    name="password_confirmation" required autocomplete="new-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-8">
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" class=" @error('terms') is-invalid @enderror" name="terms" value="agree">
                            <label for="agreeTerms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
                                    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
                                ]) !!}
                            </label>
                            @error('terms') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">@lang('Register')</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        {{-- <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i>
                Sign up using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i>
                Sign up using Google+
            </a>
        </div> --}}

        <a href="{{ route('login') }}" class="text-center">@lang('Already registered?')</a>
    </div>
</x-guest-layout>
