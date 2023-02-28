<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="theme-color" content="#6777ef"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? "Dashboard" }}</title>
  <link rel="stylesheet" href="{{ asset('css') }}/bootstrap.4.3.1.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css') }}/style.css">
  <link rel="stylesheet" href="{{ asset('css') }}/components.css">
  <link rel="stylesheet" href="{{ asset('css') }}/fakeLoader.min.css">
  @stack('css')
  @vite([])
</head>
<body>
  <div class="fakeloader"></div>
  <div id="app">
    <div class="main-wrapper container">
      @include('layouts.navbar')
      @yield('content')
      @include('layouts.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('js') }}/stisla.js"></script>

  <script src="{{ asset('js') }}/scripts.js"></script>
  <script src="{{ asset('js') }}/custom.js"></script>

  <script src="{{ asset('js') }}/fakeLoader.min.js"></script>
  <script>
    $(document).ready(function(){
        $.fakeLoader({
            timeToHide:500,
            spinner:"spinner7"
        });
    });
  </script>
   <div class="fakeLoader"></div>
 <script>
    function logOut()
    {
      window.location.href = "{{ url('/muzakki/destroy') }}"
    }
    </script>
  @stack('js')
</body>
</html>
