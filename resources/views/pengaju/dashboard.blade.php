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
        <a href="{{ route('pengaju.status') }}" style="color: white;">
            <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Status</span>
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
                                <p>{{ $currentDate }}</p>
                            </div>
                            <div class="card-body pb-0 px-0 px-md-4">
                                <!-- <canvas id="chart_widget_2"></canvas> -->
                                <img src="{{asset('assets/theme/images/Illustration.png')}}" alt=""
                                    style=" margin-left: 400px; width:300px; height: auto;">
                            </div>
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-9">
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
                                                            <img src="{{asset('assets/theme/images/status_pengaju.png')}}"
                                                                class="img-fluid" alt="Placeholder Image"
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
                                    <div style="flex-grow: 1; margin-left: 50px;">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tanggal</th>
                                                        <th>Pengajuan</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($latestPengajus as $pengaju)
                                                        <tr>
                                                            <th>{{ $loop->iteration }}</th>
                                                            <td>{{ $pengaju->tanggal }}</td>
                                                            <td>Rp{{ number_format($pengaju->total, 0, ',', '.') }}</td>
                                                            <td>
                                                                @if($pengaju->id_status == 2)
                                                                    <span class="badge badge-danger px-2">Ditolak</span>
                                                                @elseif($pengaju->id_status == 3)
                                                                    <span class="badge badge-warning px-2">Dipending</span>
                                                                @elseif($pengaju->id_status == 1)
                                                                    <span class="badge badge-success px-2">Disetujui</span>
                                                                @else
                                                                    <span class="badge badge-secondary px-2">Belum dibaca</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
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