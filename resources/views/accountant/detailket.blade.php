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
                            <li class="list-group-item"><strong>Tanggal:</strong> 11/04/2023</li>
                            <li class="list-group-item"><strong>Nama Departement:</strong> Dapartement Kebersihan
                            </li>
                            <li class="list-group-item"><strong>Nama Pengaju:</strong> Asep</li>
                            <li class="list-group-item"><strong>Deskripsi:</strong> butuh medkit</li>
                            <li class="list-group-item"><strong>Dana Pengajuan:</strong>
                                Rp.200.000</li>
                            <li class="list-group-item"><strong>Status:</strong> <span
                                    class="badge badge-secondary px-2">Belum Menunggu</span></li>
                            <li class="list-group-item"><strong>Keterangan:</strong>
                                <p>Tidak ada keterangan.</p>
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