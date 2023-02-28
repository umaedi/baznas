@extends('layouts.auth')
@section('content')
<section class="section">
    <div class="container mt-5">
      <div class="page-error">
        <div class="page-inner">
          <div class="page-description">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <img src="{{ asset('img/qrcode/qrcode.svg') }}" alt="">
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="simple-footer mt-5">
        Copyright &copy; BAZNAS TUBA {{ date('Y') }}
      </div>
    </div>
  </section>
@endsection