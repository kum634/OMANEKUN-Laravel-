<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  @include('parts.user_head')
</head>
<body class="text-center">
  @include('user_header')
<main>
  @yield('content')
</main>
  @include('parts.footer')
  @include('parts.js')
</body>
</html>
