<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $app_setting->name }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href="{{ url('/') }}"><b>{{ $app_setting->name }}</b></a>
        </div>
        <!-- User name -->
        <div class="lockscreen-name">{{ Auth::user()->name }}</div>

        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item">
            <!-- lockscreen image -->
            <div class="lockscreen-image">
                <img src="{{ Auth::user()->img }}" alt="{{ Auth::user()->name }}">
            </div>
            <!-- /.lockscreen-image -->

            <!-- lockscreen credentials (contains the form) -->
            <form class="lockscreen-credentials" method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="password">

                    <div class="input-group-append">
                        <button type="submit" class="btn">
                            <i class="fas fa-arrow-right text-muted"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </form>
            <!-- /.lockscreen credentials -->

        </div>
        <!-- /.lockscreen-item -->
        <div class="help-block text-center">
            @lang("This is a secure area of the application. Please confirm your password before continuing.")
        </div>
        <div class="text-center">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-secondary btn-block">@lang('Log Out')</button>
            </form>
            {{-- <a href="login.html">Or sign in as a different user</a> --}}
        </div>
        <div class="lockscreen-footer text-center">
            Copyright &copy; 2022-
            <script>
                document.write(new Date().getFullYear());
            </script> <b><a class="text-black" href="{{ url('/') }}"
                    target="_blank">{{ config('app.name', 'Laravel') }}</a></b><br>
            All rights reserved
        </div>
    </div>
    <!-- /.center -->

</body>

</html>
