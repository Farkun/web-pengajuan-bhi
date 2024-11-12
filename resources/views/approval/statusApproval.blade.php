@extends('layout.main')

@section('sidebar')
<ul class="metismenu" id="menu">
    <li class="nav-label"></li>
        <li>
            <a href="{{ route('approval.status') }}" style="color: white;">
                <i class="icon-speedometer menu-icon" style="color: white;"></i><span class="nav-text">Status</span>
            </a>
        </li>
        <li>
            <a href="{{ route('approval.laporan') }}" style="color: white;">
                <i class="icon-note menu-icon" style="color: white;"></i><span class="nav-text">Laporan</span>
            </a>
        </li>
        <li>
            <a href="{{ route('approval.statusApproval') }}" style="color: white;">
                <i class="icon-note menu-icon" style="color: white;"></i><span class="nav-text">Progress Keseluruhan</span>
            </a>
        </li>
</ul>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body pb-0 d-flex justify-content-between">
                                <div>
                                    <h3 class="mb-1">Informasi</h3>
                                    <h5>Berikut ini daftar surat pengajuan yang perlu Anda tanda tangani. Anda harus melakukan persetujuan untuk dapat menyetujui surat pengajuan. </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Nama Departemen</th>
                                            <th>Nama Pengaju</th>
                                            <th>Deskripsi</th>
                                            <th>Dana Pengajuan</th>
                                            <th>Detail</th>
                                            <th>Persetujuan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


