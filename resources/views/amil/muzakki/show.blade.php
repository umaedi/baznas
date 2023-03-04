@extends('layouts.app')
@section('content')
<div class="main-content container">
    <section class="section">
      <div class="section-header">
        <h1>Detail Data Muzakki</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('amil.dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item">Detail Data Muzakki</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Muzakki</h4>
                    </div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Riwayat Zakat</h4>
                        <div class="export ml-auto">
                            <button id="export" class="btn btn-primary">Export</button>
                        </div>
                    </div>
                    <div class="card-body">
                              <div class="row mb-3">
                                <div class="col-md-3 mb-3">
                                    <select class="form-control" id="category" name="category">
                                        <option value="">--KATEGORI ZAKAT--</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="bulan" name="bulan">
                                        <option value="">--BULAN--</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Deesember</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <?php $start = date('Y'); $end = 2022?>
                                    <select class="form-control" id="tahun" name="tahun">
                                        <option value="">--TAHUN--</option>
                                        <?php for($i=$end; $i<=$start; $i++) { ?>
                                            <option value="{{ $i }}"> <?php echo ucwords($i); ?> </option>
                                         <?php } ?>
                                         </select>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="perPage" name="pagination">
                                        <option value="12">--PER HALAMAN--</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                              </div>
            
                            <div class="table-responsive" id="x-data-table">
                                
                            </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
      </div>
    </section>
</div>
@endsection
@push('js')
<script>
    var page = 1;
    var category = '';
    var bulan = '';
    var tahun = '';
    var perPage = '';
    
    $(() => {
        filterTable();

        $('#category').change(function() {
            filterTable();
        });       

        $('#bulan').change(function() {
            filterTable();
        });

        $('#tahun').change(function() {
            filterTable();
        });

        $('#perPage').change(function() {
            filterTable();
        });

        $('#export').click(function() {
            exportTable();
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

    function filterTable() {
        category = $('#category').val();
        bulan = $('#bulan').val();
        tahun = $('#tahun').val();
        paginate = $('#perPage').val();
        loadTable()
    }

    async function loadTable() {
            var param = {
                method: 'GET',
                url: '{{ url()->current() }}',
                data: {
                    load: 'table',
                    category: category,
                    bulan: bulan,
                    tahun: tahun,
                    paginate: paginate,
                }
            }
            await transAjax(param).then((result) => {
                $('#x-data-table').html(result)

            }).catch((err) => {
                console.log('error');
        });
    }

    function exportTable() {
        category = $('#category').val();
        bulan = $('#bulan').val();
        tahun = $('#tahun').val();
        exportData()
    }

    async function exportData()
    {
        window.location.href = '/amil/zakat/export/{{ $id_muzakki }}?category='+category+'&bulan='+bulan+'&tahun='+tahun;
    }

    function loadPaginate(to) {
        page = to
        filterTable()
    }
</script>
@endpush