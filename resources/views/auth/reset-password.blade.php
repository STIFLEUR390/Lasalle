<x-guest-layout>
    <div class="card-body login-card-body">
      {{-- <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p> --}}

      <form action="{{ route('password.update') }}" method="post">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="input-group mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('Email')" name="email"
                value="{{ old('email', $request->email) }}" required />
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
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">@lang('Reset Password')</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{ route('login') }}">@lang("Login")</a>
      </p>
    </div>
</x-guest-layout>
