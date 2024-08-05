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
            <a href="{{ route('pengaju.status') }}" style="color: white;">
                <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Status</span>
            </a>
        </li>
</ul>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <h1>Pengajuan</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-0 d-flex justify-content-between">
                            <div>
                                <h3 class="mb-1">Informasi</h3>
                                <h5>Di halaman ini Anda dapat mengajukan dana satu atau lebih. 
                                    Orang yang Anda minta untuk menyetujui pengajuan akan mendapat notifikasi untuk menyetujui pengajuan. </h5>
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
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Nama Departemen</th>
                                        <th>Nama pengaju</th>
                                        <th>Keterangan</th>
                                        <th>Dana pengajuan</th>
                                        <th>Persetujuan</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td>2024-01-22</td>
                                        <td> Akuntasi </td>
                                        <td>M. Budiman</td>
                                        <td>Lorem ipsum dolor sit amet....</td>
                                        <td class="color-primary">Rp2.000.000</td>
                                        
                                        <td><span class="badge badge-secondary px-2">Belum dibaca</span></td>
                                        
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group row" style="max-width: 500px; margin-left: auto;">
                            <div class="col-lg-8 ml-auto">
                                <td><a href="{{ route('pengaju.dana') }}"><button type="button" class="btn mb-1 btn-info">kembali</button></a></td>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
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
                <td><a href="{{ route('pengaju.result') }}"><button type="button" class="btn mb-1 btn-info">ok</button></a></td>
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
