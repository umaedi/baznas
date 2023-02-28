<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">NO.</th>
        <th scope="col">KATEGORI</th>
        <th scope="col">NOMINAL</th>
        <th scope="col">TANGGAL</th>
        <th scope="col">STATUS</th>
        <th scope="col" class="text-center">STRUK</th>
    </tr>
    </thead>
    <tbody id="data-barang">
        @forelse ($table as $key => $tb)
        <tr>
            <th>{{ $table->firstItem() + $key }}</th>
            <td>{{ $tb->category->nama_kategori }}</td>
            <td>Rp.{{ $tb->nominal }}</td>
            <td>{{ $tb->created_at }}</td>
            @if ($tb->status == '1')
                <td>Menunggu Verifikasi</td>
            @else
                <td>Ditolak</td>
            @endif
            <td class="text-center"><a href="{{ asset('storage/image/struk/'.$tb->struk) }}" target="_blank"><i class="fa fa-2x fa-file-invoice"></i></a></td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">
                <div class="empty">
                    <div class="empty-img">
                        <svg  style="width: 96px; height: 96px" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12.983 8.978c3.955 -.182 7.017 -1.446 7.017 -2.978c0 -1.657 -3.582 -3 -8 -3c-1.661 0 -3.204 .19 -4.483 .515m-2.783 1.228c-.471 .382 -.734 .808 -.734 1.257c0 1.22 1.944 2.271 4.734 2.74"></path>
                            <path d="M4 6v6c0 1.657 3.582 3 8 3c.986 0 1.93 -.067 2.802 -.19m3.187 -.82c1.251 -.53 2.011 -1.228 2.011 -1.99v-6"></path>
                            <path d="M4 12v6c0 1.657 3.582 3 8 3c3.217 0 5.991 -.712 7.261 -1.74m.739 -3.26v-4"></path>
                            <line x1="3" y1="3" x2="21" y2="21"></line>
                        </svg>
                    </div>
                    <p class="empty-title">Tidak ada data yang tersedia</p>
                    <div class="empty-action">
                        <a href="{{ url('galeri/create') }}" class="btn btn-primary">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <!-- SVG icon code -->
                            Kembali
                        </a>
                    </div>
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
{{$table->links('pagination.stisla-paging')}}