@extends('layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Invoice</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('muzakki.dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item">Invoice</div>
        </div>
      </div>

      <div class="section-body">
        <div class="invoice">
          <div class="invoice-print">
            <div class="row">
              <div class="col-lg-12">
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
                          <input type="text" class="form-control"  id="name" value="{{ $invoice->muzakki->no_tlp ?? '-' }}" readonly/>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="email">Status</label>
                          <input type="email" class="form-control" id="email" value="{{ $invoice->muzakki->dinas->nama_dinas ?? '-' }}" readonly/>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="name">Jumlah/Nominal</label>
                          <input type="text" name="nominal" class="form-control" value="{{ formatRupiah($invoice->nominal) }}" readonly/>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputState">ZIS(Zakat, Infaq, Shodaqoh)</label>
                          <input type="email" class="form-control" id="email" value="{{ $invoice->category->nama_kategori }}" readonly/>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="section-title">Metode Pembayaran</div>
                      <p class="section-lead">Silakan Transfer melalui no rekening dibawah ini.</p>
                      <div class="d-flex">
                        <img class="img-fluid lazyload" data-src="{{ asset('img/logo/Logo_bank_Lampung_baru.png') }}" alt="logo bank lampung">
                      </div>
                      @if ($invoice->category_id !== '4')
                          <div class="input-group mt-3 mb-2">
                            <input type="text" class="form-control font-weight-bold" value="388 03.01 10079.0" id="noRekening">
                            <div class="input-group-prepend" id="show_hide_password">
                              <span class="input-group-text"><button onclick="copyNorek()" class="btn btn-primary">SALIN</button></span>
                            </div>
                          </div>
                        <p>a.n <span class="font-weight-bold">ZAKAT BAZNAS TUBA</span></p>
                        <p>* Setelah melakukan pembayaran silakan lakukan konfirmasi dengan menekan tombol dibawah ini.</p>
                      @else
                          <div class="input-group mt-3 mb-2">
                            <input type="text" class="form-control font-weight-bold" value="388 03.01 10080.2" id="noRekening">
                            <div class="input-group-prepend" id="show_hide_password">
                              <span class="input-group-text"><button onclick="copyNorek()" class="btn btn-primary">SALIN</button></span>
                            </div>
                          </div>
                        <p>a.n <span class="font-weight-bold">INFAQ SHADAQAH BAZNAS TUBA</span></p>
                        <p>* Setelah melakukan pembayaran silakan lakukan konfirmasi dengan menekan tombol dibawah ini.</p>
                      @endif
                    </div>
                  </div>
                  <a href="{{ route('muzakki.konformasi') }}" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Konfirmasi Pembayaran</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@push('js')
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.2.2/lazysizes.min.js" async=""></script>
    <script type="text/javascript"> 
        function copyNorek() {
          var norek = document.getElementById('noRekening');
           norek.select();

           norek.setSelectionRange(0, 99999);
        }
    </script>
@endpush
