@extends('layouts.app')
@section('content')
<div class="main-wrapper">
    <!-- Main Content -->
    <div class="main-content">
        <section class="section container">
            <div class="section-header">
                <h1>{{ __('Dashboard') }}</h1>
                <div id="clock" class="ml-auto h5 mt-2 font-weight-bold">
                    <h6>Loading...</h6>
                </div>
            </div>
            <div
                class="alert alert-light alert-dismissible alert-has-icon"
                id="alert-1"
                style="background-color: #e3eaef42"
            >
                <div class="alert-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div class="alert-body mt-1">
                    <button class="close" data-dismiss="alert">
                        <span>x</span>
                    </button>
                    <p class="text-justify pr-5">
                        <em>
                            <b>Assalamualikum Umaedi</b>, apa kabar hari
                            ini?</em
                        >
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <a href="{{ route('muzakki.profile') }}" style="text-decoration: none">
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Data Diri') }}</h4>
                            </div>
                            <div class="card-body text-uppercase">{{ auth()->guard('muzakki')->user()->name }}</div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-bell"></i>
                        </div>
                        <a href="{{ route('muzakki.zakat.pending') }}" style="text-decoration: none">
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Menunggu Verifikasi') }}</h4>
                            </div>
                            <div class="card-body">{{ $pending }}</div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-file"></i>
                        </div>
                        <a href="{{ route('muzakki.riwayat.zakat') }}" style="text-decoration: none">
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Riwayat Zakat</h4>
                            </div>
                            <div class="card-body">{{ $invoices }}</div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        @if (auth()->guard('muzakki')->user()->dinas_id == null || auth()->guard('muzakki')->user()->no_tlp == null)
                        <div class="alert alert-warning">Mohon untuk melengkapi data diri Anda. <a href="{{ route('muzakki.profile') }}">klik disini</a></div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-warning">{{ session('error') }}</div>
                        @endif
                        <div class="card-header">
                            <h4>FORMULIR PEMBAYARAN ZAKAT</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('muzakki.inovice.store') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" value="{{ $muzakki->name }}" readonly/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" value="{{ $muzakki->email }}" readonly/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">No HP</label>
                                        <input type="number" class="form-control"  id="name" value="{{ $muzakki->no_tlp }}" readonly/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Status</label>
                                        <input type="email" class="form-control" id="email" value="{{ $muzakki->dinas->nama_dinas ?? '' }}" readonly/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Jumlah/Nominal</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                            <input type="text" name="nominal" class="form-control @error('nominal') ? is-invalid @enderror" placeholder="Masukan nominal zakat"/>
                                            @error('nominal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputState">ZIS(Zakat, Infaq, Shodaqoh)</label>
                                        <select id="inputState" class="form-control" name="category_id">
                                            <option value="null">--PILIH KATEGORI ZAKAT--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('BAYAR') }}
                                </button>
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
        $(() => {
            setInterval(() => {
                tampilkanWaktu();
            }, 1000);

            function tampilkanWaktu() {
            var waktu = new Date();    
            var sh = waktu.getHours() + "";   
            var sm = waktu.getMinutes() + "";  
            var ss = waktu.getSeconds() + ""; 
            document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
            }
        });
</script>
@endpush