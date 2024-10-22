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
        <a href="javascript:void()" style="color: white;">
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
                                        <th>Nama pengaju</th>
                                        <th>Deskripsi</th>
                                        <th>Dana pengajuan</th>
                                        <th>No Rekening</th>
                                        <th>Persetujuan</th>
                                        <th>Cek Detail</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pengajus as $pengaju)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $pengaju->tanggal }}</td>
                                            <td>{{ $pengaju->nama_pengaju }}</td>
                                            <td
                                                style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $pengaju->deskripsi }}
                                            </td>
                                            <td class="color-primary">Rp.{{ number_format($pengaju->total, 0, ',', '.') }}</td>
                                            <td>{{ $pengaju->nama_bank }} - {{$pengaju->nomor_rekening}}</td>
                                            <td>@if($pengaju->id_status == 2)
                                                <span class="badge badge-danger px-2">Ditolak</span>
                                            @elseif($pengaju->id_status == 3)
                                                <span class="badge badge-warning px-2">Dipending</span>
                                            @elseif($pengaju->id_status == 1)
                                                <span class="badge badge-success px-2">Disetujui</span>
                                            @else
                                                <span class="badge badge-secondary px-2">Belum dibaca</span>
                                            @endif
                                            </td>
                                            <td><a href="{{ route('pengaju.detailp', $pengaju->id) }}"><button type="button"
                                                        class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                            <td>
                                                <form action="{{ route('pengaju.destroy', $pengaju->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn sweet-confirmm"
                                                        data-id="{{ $pengaju->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
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
</div>


<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Pengajuan telah ditambahkan.
            </div>

            <div class="modal-footer">
                <td><a href="{{ route('pengaju.result') }}"><button type="button"
                            class="btn mb-1 btn-info">ok</button></a></td>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    function showNotificationModal() {
        $('#notificationModal').modal('show');
    }
</script>