<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ $title ?? 'Login' }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="theme-color" content="#0a5414"/>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css') }}/style.css">

  <!-- PWA  -->
{{-- <link rel="apple-touch-icon" href="{{ asset('img/icon/lc_icon_baznas.png') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}"> --}}
  @stack('css')
  {{-- @vite([]) --}}
</head>

<body>
  <div id="app">
    @yield('content')
  </div>
</body>
<script>
  function logOut()
  {
    localStorage.removeItem("api_token");
    window.location.href = "{{ url('/admin/logout') }}"
  }
  </script>
@stack('js')
</html>