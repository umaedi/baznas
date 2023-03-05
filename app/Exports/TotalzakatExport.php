<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TotalzakatExport implements FromCollection, WithMapping, WithHeadings
{
    protected $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function collection()
    {
        return $this->invoice;
    }

    public function map($invoice): array
    {
        return [
            $invoice->muzakki->name,
            $invoice->category->nama_kategori,
            $invoice->nominal,
            $invoice->created_at,
            $invoice->muzakki->dinas->nama_dinas,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Kategori zakat',
            'Nominal Zakat',
            'Tanggal',
            'Status'
        ];
    }
}
