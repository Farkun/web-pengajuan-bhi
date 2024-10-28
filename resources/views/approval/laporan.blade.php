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
        <a href="javascript:void()" style="color: white;">
            <i class="icon-note menu-icon" style="color: white;"></i><span class="nav-text">Laporan</span>
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
                                <h3 class="mb-1">Laporan</h3>
                                <h5>Berikut ini laporan surat pengajuan. Anda bisa memantau status pencairan.</h5>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Laporan Data</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tanggal</th>
                                        <th>Nama Departement</th>
                                        <th>Nama Pengaju</th>
                                        <th>Deskripsi</th>
                                        <th>Dana Pengajuan</th>
                                        <th>Detail</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengajuans as $pengaju)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pengaju->tanggal)->format('d/m/Y') }}</td>
                                            <td>{{ $pengaju->user->name }}</td>
                                            <td>{{ $pengaju->nama_pengaju }}</td>
                                            <td
                                                style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $pengaju->deskripsi }}
                                            </td>
                                            <td>{{ number_format($pengaju->total, 0, ',', '.') }}</td>
                                            <td><a href="{{ route('approval.detaillap', $pengaju->id) }}">
                                                    <button type="button" class="btn mb-1 btn-info">Cek Detail</button></a>
                                            </td>
                                            <td><span class="badge badge-success px-2">Sudah cair</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tanggal</th>
                                        <th>Nama Departement</th>
                                        <th>Nama Pengaju</th>
                                        <th>Deskripsi</th>
                                        <th>Dana Pengajuan</th>
                                        <th>Detail</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- #/ container -->
    </div>

    <!-- #/ container -->
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="stat-widget-one">
                    <div class="stat-content">
                        <div class="stat-text">Selasa {{ $tanggalSelasa }}</div>
                        <div class="stat-digit gradient-4-text"><i
                                class="fa fa-rupiah-sign"></i>Rp. {{ number_format($totalSelasa, 2) }}</div>
                    </div>
                    <div class="progress mb-3">
                        <div class="progress-bar gradient-4" style="width: {{ $persenSelasa }}%;" role="progressbar">
                            <span class="sr-only">{{ $persenSelasa }}% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="stat-widget-one">
                    <div class="stat-content">
                        <div class="stat-text">Jum'at {{ $tanggalJumat }}</div>
                        <div class="stat-digit gradient-4-text"><i
                                class="fa fa-rupiah-sign"></i>Rp. {{ number_format($totalJumat, 2) }}</div>
                    </div>
                    <div class="progress mb-3">
                        <div class="progress-bar gradient-4" style="width: {{ $persenJumat }}%;" role="progressbar">
                            <span class="sr-only">{{ $persenJumat }}% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-widget">
                <div class="card-body">
                    <h5 class="text-muted">Minggu Ini</h5>
                    <h2 class="mt-4"><i class="fa fa-rupiah-sign"></i>Rp. {{ number_format($totalMinggu, 2) }}</h2>
                    <span>Total Dana Pengajuan yang Sudah dicairkan</span>
                    <div class="mt-4">
                        <h4>{{ number_format($totalSelasa, 2) }}</h4>
                        <h6 class="m-t-10 text-muted">Total Per-hari Selasa <span
                                class="pull-right">{{ number_format($persenSelasa, 2, ',', '.') }}%</span></h6>
                        <div class="progress mb-3" style="height: 7px">
                            <div class="progress-bar gradient-1" style="width: {{ $persenSelasa }}%;"
                                role="progressbar">
                                <span class="sr-only">{{ $persenSelasa }}% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4>{{ number_format($totalJumat, 2) }}</h4>
                        <h6 class="m-t-10 text-muted">Total Per-hari Jum'at <span
                                class="pull-right">{{ number_format($persenJumat, 2, ',', '.') }}%</span></h6>
                        <div class="progress mb-3" style="height: 7px">
                            <div class="progress-bar gradient-3" style="width: {{ $persenJumat }}%;" role="progressbar">
                                <span class="sr-only">{{ $persenJumat }}% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection