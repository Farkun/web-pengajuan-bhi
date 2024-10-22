@extends('layout.main')

@section('sidebar')
<ul class="metismenu" id="menu">
    <li class="nav-label"></li>
    <li>
        <a href="{{ route('accountant.dashboard') }}" style="color: white;">
            <i class="icon-speedometer menu-icon" style="color: white;"></i><span class="nav-text">Dashboard</span>
        </a>
    </li>
    <li>
        <a href="javascript:void()" style="color: white;">
            <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Data Approval</span>
        </a>
    </li>
    <li>
        <a href="{{ route('accountant.rekap') }}" style="color: white;">
            <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Rekap Data</span>
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{ route('accountant.forward') }}" method="POST" id="forwardForm">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Data Approval</h4>
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
                                        <th>No Rekening</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($approvedPengajus as $pengaju)
                                        <tr>
                                            <td><input type="checkbox" name="selected_pengajus[]" value="{{ $pengaju->id }}">&nbsp;&nbsp;&nbsp;{{ $loop->iteration }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($pengaju->tanggal)->format('d/m/Y') }}</td>
                                            <td>{{ $pengaju->user->name }}</td>
                                            <td>{{ $pengaju->nama_pengaju }}</td>
                                            <td
                                                style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $pengaju->deskripsi }}
                                            </td>
                                            <td>{{ number_format($pengaju->total, 0, ',', '.') }}</td>
                                            <td>{{ $pengaju->nama_bank }} - {{$pengaju->nomor_rekening}}</td>
                                            <td><a href="{{ route('accountant.detail', $pengaju->id) }}"><button
                                                        type="button" class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada data yang disetujui approval.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tanggal</th>
                                        <th>Nama Dapartement</th>
                                        <th>Nama Pengaju</th>
                                        <th>Deskripsi</th>
                                        <th>Dana Pengajuan</th>
                                        <th>No Rekening</th>
                                        <th>Detail</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="general-button col-lg-11 text-right">
                        <div class="sweetalert m-t-30">
                            <button type="button" class="btn mb-1 btn-primary" id="kirimRekapBtn">Kirim Rekap</button>
                        </div>
                        <br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection