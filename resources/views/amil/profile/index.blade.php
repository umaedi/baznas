@extends('layouts.app')
@section('content')
<div class="main-content container">
    <section class="section">
      <div class="section-header">
        <h1>Profile</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('muzakki.dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item">Profile</div>
        </div>
      </div>
      <div class="section-body">
        <h2 class="section-title">Hi, {{ auth()->user()->name }}</h2>
        <p class="section-lead">
          Anda dapat merubah informasi tentang diri Anda disini.
        </p>
        <form action="/amil/profile/update/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
          <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
              <div class="card profile-widget">
                <div class="profile-widget-header">
                  <img alt="image" id="imgPrev" src="{{ asset('storage') }}/image/profille/{{ auth()->user()->image }}" class="rounded-circle profile-widget-picture">
                </div>
                @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card-body">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" onchange="previewImg()" id="image" name="image">
                    <label class="custom-file-label" for="image">Pilih file</label>
                  </div>
                </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-12 col-12">
                        <label>{{ __('Nama Lengkap') }}</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" required="" name="name">
                      </div>
                      <div class="form-group col-md-12 col-12">
                        <label>{{ __('Email') }}</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->email }}" required="" name="email">
                      </div>
                      <div class="form-group col-md-12 col-12">
                        <label>{{ __('No telpon') }}</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->no_tlp }}" required="" name="no_tlp">
                      </div>
                      <div class="form-group col-md-12 col-12">
                        <div class="input-group">
                          <input type="password" class="form-control" id="password" name="password">
                          <div class="input-group-prepend" id="show_hide_password">
                            <span class="input-group-text"><a href="javascript:void(0)"><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>
                          </div>
                      </div>
                      </div>
                    </div>
                    <a href="{{ route('amil.dashboard') }}" class="btn btn-primary btn-icon icon-left"><i class="fa fa-arrow-left"></i></a>
                    <button id="btn-login" class="btn btn-primary" type="submit">{{ __('Simpan perubahan') }}</button>
                </div>
              </div>
            </div>
          </form>
          </div>
      </div>
    </section>
</div>
@endsection
@push('js')
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

  function previewImg(){
    const imgPreview = document.querySelector('#imgPrev');
    const image = document.querySelector('#image');
    const blob = URL.createObjectURL(image.files[0]);
    imgPreview.src = blob; 
  }
</script>
@endpush