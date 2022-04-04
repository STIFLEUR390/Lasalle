<x-guest-layout>
    <div class="card-body login-card-body">
      <p class="login-box-msg">@lang('Sign in to start your session')</p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

      <form action="{{ route('login') }}" method="post">
        @csrf

        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('Email')" type="email" name="email" value="{{ old('email') }}" required autofocus />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('Password')" name="password" required autocomplete="current-password" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                @lang('Remember me')
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">@lang("Log in")</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      {{-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> --}}
      <!-- /.social-auth-links -->

      @if (Route::has('password.request'))
        <p class="mb-1">
            <a href="{{ route('password.request') }}">@lang('Forgot your password?')</a>
        </p>
      @endif
      <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">@lang('Register')</a>
      </p>
    </div>
</x-guest-layout>
