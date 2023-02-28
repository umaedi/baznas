@extends('layouts.auth')
@section('content')
<section class="section">
  <div class="container mt-3">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="login-brand">
          <img src="{{ asset('img') }}/logo/baznas-tuba.png" alt="logo" width="100">
        </div>

        <div class="card card-primary">
          <div class="card-header"><h4>{{ __('DAFTAR AKUN BAZNAS TUBA') }}</h4></div>
          <div class="card-body">
            <div class="form-group">
                <button type="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" tabindex="4">
                  {{ __('Daftar Dengan Akun Google') }}
              </button>
              <div class="mt-3 text-muted text-center">
                {{ __('Atau isi form dibawah ini') }}
              </div>
              </div>
            <form action="{{ route('muzakki.store') }}" method="POST" class="needs-validation" novalidate="">
                @csrf
              <div class="form-group">
                <label for="name">{{ __('Nama Lengkap') }}</label>
                <input id="name" type="text" class="form-control" name="name" tabindex="1" required autofocus>
              </div>
              <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
              </div>
              <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" id="password" name="password">
                  <div class="input-group-prepend" id="show_hide_password">
                    <span class="input-group-text"><a href="javascript:void(0)"><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>
                  </div>
              </div>
              </div>
              <div class="form-group">
                <button type="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" tabindex="4">
                  {{ __('Daftar') }}
              </button>
              </div>
            </form>
          </div>
        </div>
        <div class="mt-5 text-muted text-center">
          {{ __('Sudah Punya Akun?') }} <a href="/"> {{ __('Masuk') }}</a>
        </div>
        <div class="simple-footer">
          {{ __('Copyright') }} &copy; {{ date('Y') }}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@push('js')
<script src="{{ asset('js') }}/jquery-3.3.1.min.js"></script>
<script>
   //show hide password
  const toglePassword = document.querySelector('#show_hide_password');
    const password = document.querySelector('#password');
    
    toglePassword.addEventListener('click', function(e) {
        const icon = document.querySelector('#show_hide_password i');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        if(type === 'text') {
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
        }else {
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
        }
    });
</script>
@endpush
