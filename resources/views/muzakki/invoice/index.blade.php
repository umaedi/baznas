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
                  <a href="{{ route('muzakki.dashboard') }}" class="btn btn-primary btn-icon icon-left"><i class="fa fa-arrow-left"></i></a>
                  <button id="pay-button" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Bayar Sekarang</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@push('js')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        const payButton = document.querySelector('#pay-button');
        payButton.addEventListener('click', function(e) {
            e.preventDefault();
 
            snap.pay('{{ request('snapToken') }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
        });
    </script>
@endpush
