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
            <a href="{{ route('pengaju.result') }}" style="color: white;">
                <i class="icon-note menu-icon" style="color: white;"></i><span class="nav-text">Data yang diajukan</span>
            </a>
        </li>
        <li>
            <a href="javascript:void()" style="color: white;">
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
                            <li class="list-group-item"><strong>status pengajuan:</strong> <span class="badge badge-secondary px-2">Belum dibaca</span></li>
                            <li class="list-group-item"><strong>status pencairan:</strong> <span class="badge badge-secondary px-2">Belum cair</span></li>
                            <li class="list-group-item"><strong>keterangan:</strong> Lorem ipsum dolor sit amet....</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="general-button" style="margin-left: 1120px">
    <a href="{{ route('pengaju.status') }}"><button type="button" class="btn mb-1 btn-primary">Kembali</button></a>
</div>
@endsection