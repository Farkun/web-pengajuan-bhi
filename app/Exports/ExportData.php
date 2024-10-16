<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use App\Models\Pengaju;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;


class ExportData implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Ambil data yang sudah diteruskan ke bendahara yayasan dengan status tertentu
        $approvedPengajus = Pengaju::whereNotNull('forwarded_at')
            ->where('id_status', 1) // Hanya ambil yang statusnya 1
            ->whereHas('keterangan', function ($query) {
                $query->where('keterangan_data', 'LIKE', '%bendahara yayasan%');
            })
            ->with(['user', 'keterangan']) // Load relasi user dan keterangan
            ->get();

        // Map data menjadi format yang akan di-export ke Excel
        return $approvedPengajus->map(function ($pengaju) {
            return [
                'Id' => $pengaju->id,
                'Tanggal' => Carbon::parse($pengaju->tanggal)->format('d/m/Y'),
                'Nama Departemen' => $pengaju->user->name,
                'Nama Pengaju' => $pengaju->nama_pengaju,
                'Deskripsi' => $pengaju->deskripsi,
                'Dana Pengajuan' => number_format($pengaju->total, 0, ',', '.'),
                'Status Dana' => is_null($pengaju->id_statusdana) ? 'Belum Cair' : 'Sudah Cair',
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
