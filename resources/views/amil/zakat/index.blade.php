@extends('layouts.app')
@section('content')
<div class="main-content container">
    <section class="section">
      <div class="section-header">
        <h1>{{ __("Riwayat Zakat") }}</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('muzakki.dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item">Riwayat Zakat</div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
            <div class="section-body">
                <h2 class="section-title">Hi, </h2>
                <p class="section-lead">
                  Ini adalah riwayat pembayaran zakat Anda
                </p>
                <hr>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <select class="form-control" id="category" name="category">
                            <option value="">--KATEGORI ZAKAT--</option>
                            {{-- @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" id="perPage">
                            <option value="12">--PER PAGE--</option>
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
 
    </section>
</div>
@endsection
@push('js')
<script>

    var page = 1;
    var paginate = 12;
    var category = '';

    $(() => {
        loadTable();

        $('#category').change(function () {
            filterTable()
        })

        $("#perPage").change(function () {
            filterTable()
        })
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
                }
            }
            // loading(true)
            await transAjax(param).then((result) => {
                // loading(false)
                $('#x-data-table').html(result)

                // initMagnific()
                // checkRow()
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