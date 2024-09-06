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
<div class="container-fluid mt-3">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body pb-0 d-flex justify-content-between">
                                        <div>
                                            <h3 class="mb-1">Status</h3>
                                            <h5>Status pengajuan yang sudah anda unggah ditampilkan pada halaman ini. </h5>
                                           
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
                                                    <th>Nama Pengaju</th>
                                                    <th>Dana pengajuan</th>
                                                    <th>Proses pengajuan</th>
                                                    <th>Status dana</th>
                                                    <th>Keterangan</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($pengajus as $pengaju)
                                                <tr>
                                                    <th>{{ $loop->iteration }}</th>
                                                    <td>{{ $pengaju->tanggal }}</td>
                                                    <td>{{ $pengaju->nama_pengaju }}</td>
                                                    <td class="color-primary">Rp.{{ number_format($pengaju->total, 0, ',', '.') }}</td>
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
                                                    <td><span class="badge badge-secondary px-2">Belum cair</span></td>
                                                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    @if($pengaju->keterangan)
                                                        @php
                                                            $hasVisibleKeterangan = false;
                                                        @endphp
        
                                                        @foreach($pengaju->keterangan->keterangan_data as $key => $value)
                                                            @php
                                                                // Mengecek apakah pengguna ini sudah memberikan status 'Setujui'
                                                                $userApproved = $value['id_status'] == \App\Models\Status::where('status', 'Setujui')->first()->id;
                                                            @endphp

                                                            @if(!$userApproved)
                                                                <p><strong>{{ \App\Models\User::find($value['id'])->name }}:</strong> {{ $value['keterangan'] }}</p>
                                                                @php
                                                                    $hasVisibleKeterangan = true;
                                                                @endphp
                                                            @endif
                                                        @endforeach
        
                                                        @if(!$hasVisibleKeterangan)
                                                            Tidak ada keterangan.
                                                        @endif
                                                    @else
                                                        Tidak ada keterangan.
                                                    @endif
                                                    </td> 
                                                    <td><a href="{{ route('pengaju.details', $pengaju->id) }}"><button type="button"
                                                    class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- #/ container -->
            </div>
                
                
        </div>   
@endsection

