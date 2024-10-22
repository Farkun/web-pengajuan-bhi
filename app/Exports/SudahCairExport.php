<?php

namespace App\Exports;

use App\Models\Pengaju;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SudahCairExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil data pengajuan yang status dananya sudah cair
        $cairPengajus = Pengaju::where('id_statusdana', 1) // Hanya ambil yang sudah cair
            ->with(['user', 'keterangan']) // Load relasi user dan keterangan
            ->get();

        // Map data menjadi format yang akan di-export ke Excel
        return $cairPengajus->map(function ($pengaju) {
            return [
                'Id' => $pengaju->id,
                'Tanggal' => Carbon::parse($pengaju->tanggal)->format('d/m/Y'),
                'Nama Departemen' => $pengaju->user->name,
                'Nama Pengaju' => $pengaju->nama_pengaju,
                'Deskripsi' => $pengaju->deskripsi,
                'Dana Pengajuan' => number_format($pengaju->total, 0, ',', ','),
                'Status Dana' => 'Sudah Cair', // Karena kita hanya mengambil yang sudah cair
            ];
        });
    }

    /**
     * Fungsi untuk menentukan header kolom di Excel
     * @return array
     */
    public function headings(): array
    {
        return [
            'Id',
            'Tanggal',
            'Nama Departemen',
            'Nama Pengaju',
            'Deskripsi',
            'Dana Pengajuan',
            'Status Dana',
        ];
    }
}
