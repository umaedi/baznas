<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MuzakkiExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $muzakki;

    public function __construct($muzakki)
    {
        $this->muzakki = $muzakki;
    }

    public function collection()
    {
        return $this->muzakki;
    }

    public function map($muzakki): array
    {
        return [
            $muzakki->name,
            $muzakki->email,
            $muzakki->no_tlp,
            $muzakki->dinas->nama_dinas,
        ];
    }

    public function  headings(): array
    {
        return [
            'Nama',
            'Email',
            'No Telpon',
            'Status'
        ];
    }
}
