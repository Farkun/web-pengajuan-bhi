@extends('layout.main')

@section('sidebar')
<ul class="metismenu" id="menu">
    <li class="nav-label"></li>
    <li>
        <a href="javascript:void()" style="color: white;">
            <i class="icon-speedometer menu-icon" style="color: white;"></i><span class="nav-text">Data Rekap
                Accountant</span>
        </a>
    </li>
    <li>
        <a href="{{ route('bendaharay.rekap') }}" style="color: white;">
            <i class="icon-note menu-icon" style="color: white;"></i><span class="nav-text">Data Rekap
                Ulang</span>
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Rekap Data</h4>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($forwardedPengajus as $pengaju)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pengaju->created_at)->format('d/m/Y') }}</td>
                                            <td>{{ $pengaju->user->name }}</td>
                                            <td>{{ $pengaju->nama_pengaju }}</td>
                                            <td
                                                style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $pengaju->deskripsi }}
                                            </td>
                                            <td>{{ number_format($pengaju->total, 0, ',', '.') }}</td>
                                            <td><a href="{{ route('bendaharay.detail', $pengaju->id) }}"><button type="button"
                                                        class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                            <td>
                                                <button type="button" class="btn mb-1 btn-secondary dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Belum
                                                    ditanggapi</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item reject-button" href="#" data-toggle="modal"
                                                        data-target="#rejectModal" data-id="{{ $pengaju->id }}">Tolak</a>
                                                </div>

                                            </td>
                                        </tr>
                                    </tbody>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada pengajuan yang diteruskan.</td>
                                    </tr>
                                @endforelse
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Tanggal</th>
                                    <th>Nama Departement</th>
                                    <th>Nama Pengaju</th>
                                    <th>Deskripsi</th>
                                    <th>Dana Pengajuan</th>
                                    <th>Detail</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="general-button col-lg-11 text-right">
                    <div class="sweetalert m-t-30">
                        <a href=""><button type="button" class="btn mb-1 btn-primary">Kirim Rekap</button></a>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    <!-- Modals -->
    @include('bendaharay.modals')
</div>
</div>
@endsection