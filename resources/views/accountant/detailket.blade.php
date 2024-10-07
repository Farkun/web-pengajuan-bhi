@extends('layout.main')

@section('sidebar')
<ul class="metismenu" id="menu">
    <li class="nav-label"></li>
    <li>
        <a href="{{ route('accountant.dashboard') }}" style="color: white;">
            <i class="icon-speedometer menu-icon" style="color: white;"></i><span class="nav-text">Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('accountant.data') }}" style="color: white;">
            <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Data Approval</span>
        </a>
    </li>
    <li>
        <a href="javascript:void()" style="color: white;">
            <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Rekap data</span>
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="container-fluid">
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail</h4>
                    <div class="basic-list-group">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Tanggal:</strong> {{ $pengaju->tanggal }}</li>
                            <li class="list-group-item"><strong>Nama Departement:</strong> {{ $pengaju->user->name }}
                            </li>
                            <li class="list-group-item"><strong>Nama Pengaju:</strong> {{ $pengaju->nama_pengaju }}</li>
                            <li class="list-group-item"><strong>Deskripsi:</strong> {{ $pengaju->deskripsi }}</li>
                            <li class="list-group-item"><strong>Dana Pengajuan:</strong>
                                {{ number_format($pengaju->total, 0, ',', '.') }}</li>
                            <li class="list-group-item"><strong>Status:</strong>
                                <span class="badge 
                                    @php
                                        // Mengambil data keterangan_data
                                        $keteranganData = $pengaju->keterangan->keterangan_data ?? null;

                                        // Jika keterangan_data adalah string JSON, decode menjadi array
                                        if (is_string($keteranganData)) {
                                            $keteranganData = json_decode($keteranganData, true);
                                        }

                                        // Cek apakah keterangan_data adalah array dan ambil status dari bendahara yayasan
                                        $bendaharaData = $keteranganData['bendahara yayasan'] ?? null;

                                        if ($bendaharaData && isset($bendaharaData['id_status'])) {
                                            // Tentukan class badge berdasarkan id_status di keterangan_data
                                            $statusBadgeClass = ($bendaharaData['id_status'] == 2) ? 'badge-danger' : 'badge-success';
                                            echo $statusBadgeClass;
                                        } elseif (is_null($bendaharaData) && !is_null($pengaju->forwarded_at)) {
                                            // Jika data bendahara kosong dan pengajuan sudah diteruskan, status adalah Menunggu
                                            echo 'badge-secondary';
                                        } else {
                                            // Fallback ke status dari tabel pengajus
                                            echo $pengaju->status->badge_class;
                                        }
                                    @endphp
                                    px-2">
                                    @php
                                        // Tentukan status berdasarkan keterangan_data jika ada
                                        if ($bendaharaData && isset($bendaharaData['id_status'])) {
                                            echo ($bendaharaData['id_status'] == 2) ? 'Ditunda' : 'Disetujui';
                                        } elseif (is_null($bendaharaData) && !is_null($pengaju->forwarded_at)) {
                                            // Jika pengajuan sudah diteruskan tapi belum ada data dari bendahara, status Menunggu
                                            echo 'Menunggu';
                                        } else {
                                            // Fallback ke status dari tabel pengajus
                                            echo $pengaju->status->status;
                                        }
                                    @endphp
                                </span>
                            </li>
                            <li class="list-group-item"><strong>Keterangan:</strong>
                                <p> @if($pengaju->keterangan)
                                                                    @php
                                                                        // Mengambil data keterangan_data
                                                                        $keteranganData = $pengaju->keterangan->keterangan_data;

                                                                        // Jika keterangan_data adalah string JSON, decode menjadi array
                                                                        if (is_string($keteranganData)) {
                                                                            $keteranganData = json_decode($keteranganData, true);
                                                                        }

                                                                        // Cek apakah keterangan_data sudah menjadi array dan lanjutkan untuk bendahara yayasan
                                                                        $bendaharaData = $keteranganData['bendahara yayasan'] ?? null;
                                                                    @endphp

                                                                    @if($bendaharaData)
                                                                        <p><strong>{{ \App\Models\User::find($bendaharaData['id'])->name }}:</strong>
                                                                            {{ $bendaharaData['keterangan'] }}</p>
                                                                    @else
                                                                        Tidak ada keterangan.
                                                                    @endif
                                @else
                                    Tidak ada keterangan.
                                @endif
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="general-button col-lg-11 text-right">
                    <a href="{{ route('accountant.rekap') }}"><button type="button"
                            class="btn mb-1 btn-primary">Kembali</button></a>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

@endsection