<x-guest-layout>
    <div class="card-body login-card-body">
      <p class="login-box-msg">
          @lang('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')
      </p>

      <!-- Session Status -->
      <x-auth-session-status class="mb-4" :status="session('status')" />

      <form action="{{ route('password.email') }}" method="post">
        @csrf

        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('Email')" name="email" value="{{ old('email') }}" required autofocus />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email') <span class="error invalid-feedback">{{ $message }}</span> @enderror
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">@lang('Email Password Reset Link')</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{ route('login') }}">@lang('Login')</a>
      </p>
      <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">@lang('Register')</a>
      </p>
    </div>
</x-guest-layout>
