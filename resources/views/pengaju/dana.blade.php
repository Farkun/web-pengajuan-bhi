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
                        <div class="form-validation">
                            <form class="form-valide" action="#" method="post" onsubmit="event.preventDefault(); showNotificationModal();">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-date">Masukan tanggal pengajuan <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" id="val-date" name="val-date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Masukan nama pengaju <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="val-username" placeholder="Tuliskan nama">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Deskripsi <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" id="val-suggestions" name="val-suggestions" rows="5" placeholder="Tuliskan deskripsi"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-currency">Dana pengajuan <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-currency" name="val-currency" placeholder="Rp1.600.000">
                                    </div>
                                </div>
                               
                                <div class="form-group row" style="max-width: 500px; margin-left: auto;">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary" id="submitButton">Tambah pengajuan</button>
                                    </div>
                                </div>
                            </form>
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
