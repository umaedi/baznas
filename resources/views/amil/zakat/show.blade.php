@extends('layouts.app')
@section('content')
<div class="main-content container">
    <section class="section">
      <div class="section-header">
        <h1>{{ __("Detail Zakat") }}</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('amil.dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item">Detail Zakat</div>
        </div>
      </div>
      <div class="card">
        <div id="x-message"></div>
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card-body">
            <div class="section-body">
                <h2 class="section-title">Detail Zakat</h2>
                <p class="section-lead">
                  Ini adalah detail zakat {{ $invoice->muzakki->name }}, silakan dicek, pilih kwitansi lalu klik konfirmasi
                </p>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" value="{{ $invoice->muzakki->name }}" readonly/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ $invoice->muzakki->email }}" readonly/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">No HP</label>
                        <input type="text" class="form-control"  id="name" value="{{ $invoice->muzakki->no_tlp }}" readonly/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Status</label>
                        <input type="email" class="form-control" id="email" value="{{ $invoice->muzakki->dinas->nama_dinas }}" readonly/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputState">ZIS(Zakat, Infaq, Shodaqoh)</label>
                        <input type="email" class="form-control" id="email" value="{{ $invoice->category->nama_kategori }}" readonly/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Jumlah/Nominal</label>
                        <input type="text" name="nominal" class="form-control" value="{{ formatRupiah($invoice->nominal) }}" readonly/>
                    </div>
                    <div class="form-group col-md-12">
                    <form action="/amil/konfirmasi_zakat/{{ $invoice->id }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                            <label for="name">Pilih Kwitansi Jika Anda ingin mengkonfirmasi data ini</label>
                            <input type="file" name="kwitansi" class="form-control" required>    
                        </div>
                </div>        
                <a href="{{ route('amil.dashboard') }}" class="btn btn-primary btn-icon icon-left"><i class="fa fa-arrow-left"></i></a>
                        <button type="submit" class="btn btn-primary" id="confirm">KONFIRMASI</button>        
                    </form>       
                <button class="btn btn-warning" id="tolak"  onclick="return confirm('Yakin tolak data ini?')">TOLAK</button>               
                <a href="https://api.whatsapp.com/send?phone={{ $invoice->muzakki->no_tlp }}" target="_blank" class="btn btn-primary"><i class="fa fa-phone"></i></a>    
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $(() => {
            $('#tolak').click(function() {
               tolakZakat();
            });
        });

    async function transAjax(data) {
        html = null;
        data.headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        await $.ajax(data).done(function(res) {
            html = res;
        })
            .fail(function() {
                return false;
            })
        return html
    }

    function tolakZakat(){
        confirmZakat('3');
    }

    async function  confirmZakat(value) {
            var param = {
                method: 'GET',
                url: '{{ url()->current() }}',
                data: {
                    load: 'table',
                    status: value,
                }
            }

            await transAjax(param).then((result) => {
                if(result == '2') {
                    $('#x-message').html('<div class="alert alert-success">Data berhasil dikonfirmasi</div>');
                }else {
                    $('#x-message').html('<div class="alert alert-success">Data berhasil ditolak!</div>');
                }
            }).catch((err) => {
                $('#x-message').html('<div class="alert alert-warning">Internal Server Error!</div>');
        });
    }
    </script>
@endpush