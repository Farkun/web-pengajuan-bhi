@extends('layout.main')

@section('sidebar')
<ul class="metismenu" id="menu">
    <li class="nav-label">Dashboard</li>
    <li>
        <a href="{{ route('pengaju.dashboard') }}">
            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('pengaju.dana') }}">
            <i class="icon-note menu-icon"></i><span class="nav-text">Ajukan Dana</span>
        </a>
    </li>
    <li>
        <a href="{{ route('pengaju.status') }}">
            <i class="icon-notebook menu-icon"></i><span class="nav-text">Status</span>
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-0 d-flex justify-content-between">
                            <div>
                                <h2 class="mb-1">Selamat Datang, {{ $user->name }}</h2>
                                <p>Total Earnings of the Month</p>
                                <h3 class="m-0">$ 12,555</h3>
                            </div>
                            <div>
                                <ul>
                                    <li class="d-inline-block mr-3"><a class="text-dark" href="#">Day</a></li>
                                    <li class="d-inline-block mr-3"><a class="text-dark" href="#">Week</a></li>
                                    <li class="d-inline-block"><a class="text-dark" href="#">Month</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="chart-wrapper" style="margin-left: 850px">
                            <!-- <canvas id="chart_widget_2"></canvas> -->
                            <img src="assets/theme/images/Illustration.png" alt="">
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="w-100 mr-2">
                                    <h6>Pixel 2</h6>
                                    <div class="progress" style="height: 6px">
                                        <div class="progress-bar bg-danger" style="width: 40%"></div>
                                    </div>
                                </div>
                                <div class="ml-2 w-100">
                                    <h6>iPhone X</h6>
                                    <div class="progress" style="height: 6px">
                                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-stretch">
                                    <!-- Tombol di sebelah kiri -->
                                    <div class="me-3">
                                        <td><a href="{{ route('pengaju.status') }}">
                                        <button class="btn w-100"
                                            style="background-color: transparent; border: 2px solid #000; padding: 35px; font-size: 1.5rem; color: #000;">
                                            <div class="card mb-0">
                                                <div class="card-body d-flex align-items-center p-0"
                                                    style="padding: 40px; display: flex; align-items: center;">
                                                    <img src="assets/theme/images/status_pengaju.png" class="img-fluid"
                                                        alt="Placeholder Image"
                                                        style="max-width: 200px; margin-right: 20px;">
                                                    <div class="ml-3" style="flex-grow: 1;">
                                                        <h1>Status Pengaju</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                    </div>


                                    <!-- Pembatas vertikal di tengah -->
                                    <div class="vr"
                                        style="border-left: 2px solid #000; height: auto; flex-grow: 1; margin: 0 50px;">
                                    </div>

                                    <!-- Konten lain di sebelah kanan pembatas -->
                                    <div class="col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tanggal</th>
                                                        <th>Pengajuan</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>1</th>
                                                        <td>00/00/0000</td>
                                                        <td>Rp.200.000</td>
                                                        <td><span class="badge badge-warning px-2">Pendding</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>2</th>
                                                        <td>00/00/0000</td>
                                                        <td>Rp.200.000</td>
                                                        <td><span class="badge badge-danger px-2">Ditolak</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>3</th>
                                                        <td>00/00/0000</td>
                                                        <td>Rp.200.000</td>
                                                        <td><span class="badge badge-success px-2">Disetujui</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>


@endsection