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
                            <b>Assalamualikum Amil</b>, apa fokus utama Anda ini?</em
                        >
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fa fa-users fa-2x" style="color: #fff"></i>
                        </div>
                        <a href="{{ route('amil.muzakki') }}" style="text-decoration: none">
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Total Muzakki') }}</h4>
                            </div>
                            <div class="card-body text-uppercase">{{ $muzakkis }}</div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-list"></i>
                        </div>
                        <a href="{{ route('zakat_confirm') }}" style="text-decoration: none">
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('Total Zakat Dikonfirmasi') }}</h4>
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
                        <div class="card-header">
                            <h4>PEMBAYARAN ZAKAT PERLU DIKONFIRMASI</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" id="x-data-table">
                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@push('js')
    <script>
        var page = 1;
        $(() => {
            loadTable();

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

        async function transAjax(data) {
            html =  null,
            data.headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            await $.ajax(data).done(function(res){
                html = res;
            }).fail(function() {
                return false
            })
            return html;
        }

        async function loadTable(){
            var param = {
                method: 'GET',
                url: '{{ route('amil.zakat.needconfirm') }}',
                data: {
                    page: page,
                }
            }
            await transAjax(param).then((result) => {
                $('#x-data-table').html(result)
            }).catch((err) => {
                console.log('Internal Server Error');
            });
        }

        // setInterval(() => {
        //     loadTable();
        // }, 10000);

</script>
@endpush