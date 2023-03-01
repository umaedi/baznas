@extends('layouts.auth')
@section('content')
<section class="section">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-body text-center">
                <img data-src="{{ asset('img/success.svg') }}" class="lazyload" width="150" alt="">
                <div class="x-text mt-3">
                    <h5>PEMBAYARAN BERHASIL</h5>
                    <p>"Semoga Allah memberikan ganjaran pahala terhadap harta yang telah engkau berikan dan menjadikannya penyuci bagimu, serta semoga Allah memberikan keberkahan hartamu yang masih tersisa padamu."</p>
                </div>
                <a href="{{ route('muzakki.dashboard') }}" class="btn btn-primary">KEMBALI</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/lazysizes.min.js" async=""></script>
@endpush
