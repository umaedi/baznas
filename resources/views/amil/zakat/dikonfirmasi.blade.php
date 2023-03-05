@extends('layouts.app')
@section('content')
<div class="main-content container">
    <section class="section">
      <div class="section-header">
        <h1>{{ __("Total Zakat Keseluruhan") }}</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('amil.dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item">Total Zakat Keseluruhan</div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
            <div class="section-body">
                <h2 class="section-title">Assalamualikum, Amil</h2>
                <p class="section-lead">
                  Ini adalah data total zakat yang di konfirmasi.
                </p>
                <hr>
                <form action="{{ route('amil.totalzakat.export') }}" method="GET">
                    @csrf
                <div class="row mb-3">
                    <div class="col-md-4 mb-3">
                        <select class="form-control" id="category" name="category">
                            <option value="">--KATEGORI--</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
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
                    <div class="col-md-2">
                        <?php $start = date('Y'); $end = 2022?>
                        <select class="form-control" id="tahun" name="tahun">
                            <option value="">--TAHUN--</option>
                            <?php for($i=$end; $i<=$start; $i++) { ?>
                                <option value="{{ $i }}"> <?php echo ucwords($i); ?> </option>
                             <?php } ?>
                             </select>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" id="perPage">
                            <option value="12">--PER PAGE--</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                       <button type="submit" class=" form-control btn btn-primary">EXPORT</button>
                    </div>
                  </div>
                </form>
                <div class="table-responsive" id="x-data-table">
                    
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
    var paginate = 12;
    var category = '';
    var status = '2';
    var tahun = '';
    var bulan = '';
    var search = '';

    $(() => {
        loadTable();

        $('#search').on('keypress', function (e) {
            if (e.which == 13) {
                filterTable()
                return false;
            }
        });

        $('#category').change(function () {
            filterTable()
        });

        $("#perPage").change(function () {
            filterTable()
        });

        $('#status').change(function() {
            filterTable();
        }); 

        $('#tahun').change(function() {
            filterTable();
        });

        $('#bulan').change(function() {
            filterTable();
        });

        $('#refresh').click(function() {
            filterTable();
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
        paginate = $('#perPage').val();
        status   = $('#status').val();
        tahun    = $('#tahun').val();
        bulan    = $('#bulan').val();
        search   = $('#search').val();
        loadTable()
    }

    async function loadTable() {
            var param = {
                method: 'GET',
                url: '{{ url()->current() }}',
                data: {
                    load: 'table',
                    category: category,
                    page: page,
                    paginate: paginate,
                    status: status,
                    tahun: tahun,
                    bulan: bulan,
                    search: search,
                }
            }
            await transAjax(param).then((result) => {
                $('#x-data-table').html(result)
          
            }).catch((err) => {
                console.log('error');
        });
    }

    function loadPaginate(to) {
        page = to
        filterTable()
    }

</script>
@endpush