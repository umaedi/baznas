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
                <div class="invoice-title">
                  <h2>Invoice</h2>
                </div>
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
                          <label for="name">Jumlah/Nominal</label>
                          <input type="text" name="nominal" class="form-control" value="{{ $invoice->nominal }}" readonly/>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputState">ZIS(Zakat, Infaq, Shodaqoh)</label>
                          <input type="email" class="form-control" id="email" value="{{ $invoice->category->nama_kategori }}" readonly/>
                      </div>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="row mt-4">
                  <div class="col-lg-12">
                    <div class="section-title">Metode Pembayaran</div>
                    <div class="section-lead">
                      <p>Silakan tarnsfer melalui no rekning dibawah ini.</p>
                      @if ($invoice->category_id !== 4)
                      <h5>{{ __('388 03.01 10079.0') }}</h5>BANK LAMPUNG, A/N <span>BAZNAS TUBA</span> 
                      @else
                      <h5>{{ __('388 03.01 10080.2') }}</h5>BANK LAMPUNG, A/N <span>BAZNAS TUBA</span> 
                      @endif
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="section-title">Nominal Zakat</div>
                    <div class="section-lead">
                      <h5>Rp. {{ $invoice->nominal }}</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <a href="{{ route('muzakki.dashboard') }}" class="btn btn-primary btn-icon icon-left"><i class="fa fa-arrow-left"></i></a>
          <a href="{{ route('muzakki.konformasi') }}" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Konfirmasi Pembayaran</a>
        </div>
      </div>
    </section>
  </div>
@endsection
