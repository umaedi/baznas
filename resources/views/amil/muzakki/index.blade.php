@extends('layouts.app')
@section('content')
<div class="main-content container">
    <section class="section">
      <div class="section-header">
        <h1>{{ __("Data List Muzakki") }}</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('amil.dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item">Data List Muzakki</div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
            <div class="section-body">
                <h2 class="section-title">Assalamualikum, Amil</h2>
                <p class="section-lead">
                  Ini adalah data list muzakki.
                </p>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Cari berdasarkan nama...">
                    </div>
                    <div class="col-md-2 mb-3">
                        <select class="form-control" id="category" name="category">
                            <option value="">--STATUS--</option>
                            <option value="1">Dinas</option>
                            <option value="2">Pegawai</option>
                            <option value="3">Masyarakat Biasa</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <select class="form-control" id="perPage" name="pagination">
                            <option value="12">--PER PAGE--</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('amil.muzakki.export') }}" class="form-control btn btn-primary">EXPORT</a>
                    </div>
                  </div>

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
    var search = '';

    $(() => {
        loadTable();

        $('#search').on('keypress', function (e) {
            if (e.which == 13) {
                filterTable()
                return false;
            }
        });

        $("#perPage").change(function () {
            filterTable()
        });

        $("#category").change(function() {
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
        paginate = $('#perPage').val();
        search   = $('#search').val();
        category = $('#category').val();
        loadTable()
    }

    async function loadTable() {
            var param = {
                method: 'GET',
                url: '{{ url()->current() }}',
                data: {
                    load: 'table',
                    search: search,
                    paginate: paginate,
                    category: category,
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