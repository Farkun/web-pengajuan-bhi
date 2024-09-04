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
                                    @php $counter = 1; @endphp
                                    @foreach($pengajus as $pengaju)
                                    @php
                                    $userId = Auth::id();
                                    $userKey = $userId == 3 ? 'cindy' : 'runi';
                                    $keteranganData = $pengaju->keterangan->keterangan_data ?? [];
                                    $statusUser = $keteranganData[$userKey]['id_status'] ?? null;
                                    @endphp
                                    @if($statusUser === null || $statusUser === $statusPending)
                                    <tr>
                                        <th>{{ $counter }}</th>
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
                                    @php $counter++; @endphp
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
            </div>
                
        </div>   
@endsection