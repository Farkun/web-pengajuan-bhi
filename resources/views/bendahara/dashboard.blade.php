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
        <a href="{{ route('bendahara.status') }}" style="color: white;">
            <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Rekap Data</span>
        </a>
    </li>
    <li>
        <a href="{{ route('bendahara.laporan') }}" style="color: white;">
            <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Laporan</span>
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
                <a href="status">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Rekap Data</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $total }}</h2>
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
                                    <div class="stat-text">Selasa ini</div>
                                    <div class="stat-digit gradient-4-text"><i class="fa fa-usd"></i>7800</div>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar gradient-4" style="width: 40%;" role="progressbar"><span class="sr-only">40% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-content">
                                    <div class="stat-text">Jum'at ini</div>
                                    <div class="stat-digit gradient-4-text"><i class="fa fa-usd"></i> 500</div>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar gradient-4" style="width: 15%;" role="progressbar"><span class="sr-only">15% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-widget">
                            <div class="card-body">
                                <h5 class="text-muted">Minggu Ini</h5>
                                <h2 class="mt-4">$6,932.60</h2>
                                <span>Total Dana Pengajuan yang Sudah dicairkan</span>
                                <div class="mt-4">
                                    <h4>2,365</h4>
                                    <h6 class="m-t-10 text-muted">Total Per-hari Selasa <span class="pull-right">80%</span></h6>
                                    <div class="progress mb-3" style="height: 7px">
                                        <div class="progress-bar gradient-1" style="width: 80%;" role="progressbar"><span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h4>1,250</h4>
                                    <h6 class="m-t-10 text-muted">Total Per-hari Jum'at <span class="pull-right">50%</span></h6>
                                    <div class="progress mb-3" style="height: 7px">
                                        <div class="progress-bar gradient-3" style="width: 50%;" role="progressbar"><span class="sr-only">50% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
@endsection