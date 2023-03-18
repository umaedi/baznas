@extends('layouts.app')
@section('content')
<div class="main-wrapper">
    <!-- Main Content -->
    <div class="main-content">
        <section class="section container">
            <div class="section-header">
                <h1>{{ __('Konfirmasi') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('muzakki.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Konfirmasi</div>
                  </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">

                        @error('struk')
                        <div class="alert alert-warning">{{ $message }}</div>
                        @enderror

                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-warning">{{ session('error') }}</div>
                        @endif

                        <div class="card-header">
                            <h4>KONFORMASI PEMBAYARAN ZAKAT</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('muzakki.konfirmasi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" value="{{ auth()->guard('muzakki')->user()->name }}" readonly/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Struk Pembayaran</label>
                                        <input type="file" class="form-control" id="email" name="struk"/>
                                    </div>
                                </div>
                                <a href="{{ route('muzakki.dashboard') }}" class="btn btn-primary btn-icon icon-left"><i class="fa fa-arrow-left"></i></a>
                                
                                @if (!session()->has('success'))
                                <button type="submit" class="btn btn-primary">
                                    {{ __('UNGGAH') }}
                                </button>
                                @endif

                                @if (session()->has('success'))
                                <a href="https://api.whatsapp.com/send?phone={{ env('NO_TLP') }}" target="_blank" class="btn btn-primary">
                                    {{ __('KONFIRMASI VIA WHATSAPP') }}
                                </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('js') }}/jquery.mask.min.js"></script>
<script>
    $('input[name=nominal]').mask('000.000.000.000', {reverse: true});
</script>
    <script>
        function tampilkanwaktu(){   
      var waktu = new Date();    
      var sh = waktu.getHours() + "";   
      var sm = waktu.getMinutes() + "";  
      var ss = waktu.getSeconds() + ""; 
      document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
  }
</script>
@endpush