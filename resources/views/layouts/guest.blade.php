<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $app_setting->name }}</title>
  <link rel="icon" type="image/x-icon" href="{{ asset($app_setting->logo) }}"/>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="{{ url('/') }}"><b>{{ $app_setting->name }}</b></a>
  </div>

  <div class="card">
    {{ $slot }}
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
</body>
</html>
