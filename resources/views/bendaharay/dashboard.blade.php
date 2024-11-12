@extends('layout.main')

@section('sidebar')
<ul class="metismenu" id="menu">
    <li class="nav-label"></li>
    <li>
        <a href="javascript:void()" style="color: white;">
            <i class="icon-speedometer menu-icon" style="color: white;"></i><span class="nav-text">Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('bendaharay.data') }}" style="color: white;">
            <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Data Rekap
            Accountant</span>
        </a>
    </li>
    <li>
        <a href="{{ route('bendaharay.statusBendaharaY') }}" style="color: white;">
            <i class="icon-speedometer menu-icon" style="color: white;"></i><span class="nav-text">Progress Keseluruhan</span>
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body d-flex align-items-end row">
                            <div>
                                <h2 class="mb-1">Selamat Datang, {{ $user->name }}</h2>
                                <p>{{ $currentDate }}</p>
                            </div>
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card card-body gradient-1">
                <a href="data">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Rekap Accountant</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $totaldat }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </a>
            </div>
        </div>
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