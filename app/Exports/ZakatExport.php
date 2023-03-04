<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ZakatExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $zakat;

    public function __construct($zakat)
    {
        $this->zakat = $zakat;
    }

    public function collection()
    {
        return $this->zakat;
    }

    public function map($zakat): array
    {
        return [
            $zakat->muzakki->name,
            $zakat->category->nama_kategori,
            $zakat->nominal,
            $zakat->created_at,
            env('APP_URL') . 'storage/image/kwitansi/' . $zakat->kwitansi,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Kategori Zakat',
            'Nominal',
            'Tanggal',
            'Kwitansi',
        ];
    }
}
