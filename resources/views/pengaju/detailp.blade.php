@extends('layout.main')

@section('sidebar')
<ul class="metismenu" id="menu">
    <li class="nav-label"></li>
    <li>
        <a href="{{ route('pengaju.dashboard') }}" style="color: white;">
            <i class="icon-speedometer menu-icon" style="color: white;"></i><span class="nav-text">Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('pengaju.dana') }}" style="color: white;">
            <i class="icon-note menu-icon" style="color: white;"></i><span class="nav-text">Ajukan Dana</span>
        </a>
    </li>
    <li>
        <a href="javascript:void()" style="color: white;">
            <i class="icon-note menu-icon" style="color: white;"></i><span class="nav-text">Data yang diajukan</span>
        </a>
    </li>
    <li>
        <a href="{{ route('pengaju.status') }}" style="color: white;">
            <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Status</span>
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
                                Rp.{{ number_format($pengaju->total, 0, ',', '.') }}</li>
                            <li class="list-group-item"><strong>No Rekening:</strong> {{ $pengaju->nama_bank }} - {{$pengaju->nomor_rekening}}</li>
                            <li class="list-group-item"><strong>Persetujuan:</strong>
                                @if($pengaju->id_status == 2)
                                    <span class="badge badge-danger px-2">Ditolak</span>
                                @elseif($pengaju->id_status == 3)
                                    <span class="badge badge-warning px-2">Dipending</span>
                                @elseif($pengaju->id_status == 1)
                                    <span class="badge badge-success px-2">Disetujui</span>
                                @else
                                    <span class="badge badge-secondary px-2">Belum dibaca</span>
                                @endif
                            </li>
                            <li class="list-group-item"><strong>Invoice:</strong>
                            @if($pengaju->invoice)
        @php
            $extension = pathinfo($pengaju->invoice, PATHINFO_EXTENSION);
        @endphp

        <!-- Tombol unduh untuk semua jenis file -->
        <button class="btn btn-primary">
            <a href="{{ asset('storage/' . $pengaju->invoice) }}" target="_blank" style="color:white; text-decoration:none;">Unduh Invoice ({{ strtoupper($extension) }})</a>
        </button>
    @else
        <span>Tidak ada invoice yang diunggah.</span>
    @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="general-button col-lg-11 text-right">
                    <a href="{{ route('pengaju.result') }}"><button type="button"
                            class="btn mb-1 btn-primary">Kembali</button></a>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
@endsection