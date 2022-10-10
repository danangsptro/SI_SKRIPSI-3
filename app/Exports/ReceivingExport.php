<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReceivingExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings() :array
    {
        return [
            'Tanggal Receiving',
            'No Receiving',
            'No PO',
            'No Surat Jalan',
            'Nama Suplier',
            'Total Barang PO',
            'Total Barang diterima',
            'Sisa PO',
            'Satuan',
            'Validasi'
        ];
    }
}
