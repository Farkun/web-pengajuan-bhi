@extends('layout.main')

@section('sidebar')
<ul class="metismenu" id="menu">
    <li class="nav-label"></li>
        <li>
            <a href="javascript:void()" style="color: white;">
                <i class="icon-speedometer menu-icon" style="color: white;"></i><span class="nav-text">Status</span>
            </a>
        </li>
        <li>
            <a href="{{ route('approval.laporan') }}" style="color: white;">
                <i class="icon-note menu-icon" style="color: white;"></i><span class="nav-text">Laporan</span>
            </a>
        </li>
</ul>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <h1>Status</h1>
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
                                <tbody>
                                    @foreach($pengajus as $pengaju)
                                    @php
                                    $userId = Auth::id();
                                    $userKey = $userId == 3 ? 'cindy' : 'runi';
                                    $keteranganData = $pengaju->keterangan->keterangan_data ?? [];
                                    $statusUser = $keteranganData[$userKey]['id_status'] ?? null;
                                    @endphp
                                    @if($statusUser === null || $statusUser === $statusPending)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $pengaju->tanggal }}</td>
                                        <td>{{ $pengaju->user->name }}</td>
                                        <td>{{ $pengaju->nama_pengaju }}</td>
                                        <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $pengaju->deskripsi }}</td>
                                        <td class="color-primary">Rp{{ number_format($pengaju->total, 0, ',', '.') }}</td>
                                        <td><a href="{{ route('approval.detailstat', $pengaju->id) }}"><button type="button" class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                        <td>
                                            @if($statusUser === null)
                                            <button type="button" class="btn mb-1 btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Belum ditanggapi</button>
                                            @elseif($statusUser === $statusPending)
                                            <button type="button" class="btn mb-1 btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pending</button>
                                            @endif
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#rejectModal" data-id="{{ $pengaju->id }}" data-status="Tolak">Tolak</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#pendingModal" data-id="{{ $pengaju->id }}" data-status="Pending">Pending</a>
                                                <a class="dropdown-item" href="#" onclick="confirmApprove({{ $pengaju->id }})">Setujui</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @include('approval.modals')
                
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
                                <span>Total Dana Pengajuan yang Sudah disetujui</span>
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
                
        </div>   
@endsection