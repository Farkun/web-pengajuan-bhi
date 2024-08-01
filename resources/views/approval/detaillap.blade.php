@extends('layout.main')

@section('sidebar')
<ul class="metismenu" id="menu">
    <li class="nav-label">Dashboard</li>
    <li>
        <a href="{{ route('approval.status') }}">
            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Status</span>
        </a>
    </li>
    <li>
        <a href="{{ route('approval.laporan') }}">
            <i class="icon-note menu-icon"></i><span class="nav-text">Laporan</span>
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
                            <li class="list-group-item"><strong>Tanggal:</strong> 01/02/2027</li>
                            <li class="list-group-item"><strong>Nama Departement:</strong> Akuntansi</li>
                            <li class="list-group-item"><strong>Nama Pengaju:</strong> M. Budiman</li>
                            <li class="list-group-item"><strong>Deskripsi:</strong>
                                Porta ac consectetur ac Porta ac consectetur ac
                                Porta ac consectetur ac Porta ac consectetur ac
                                Porta ac consectetur ac Porta ac consectetur ac
                                Porta ac consectetur ac Porta ac consectetur ac
                                Porta ac consectetur ac Porta ac consectetur ac
                                Porta ac consectetur ac Porta ac consectetur ac
                                Porta ac consectetur ac Porta ac consectetur ac
                                Porta ac consectetur ac Porta ac consectetur ac
                            </li>
                            <li class="list-group-item"><strong>Dana Pengajuan:</strong> Rp.250.000</li>
                            <li class="list-group-item"><strong>Status:</strong> <span class="badge badge-success px-2">Sudah cair</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="general-button" style="margin-left: 1120px">
    <a href="{{ route('approval.laporan') }}"><button type="button" class="btn mb-1 btn-primary">Kembali</button></a>
</div>
@endsection