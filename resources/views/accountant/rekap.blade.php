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
        <a href="{{ route('accountant.data') }}" style="color: white;">
            <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Data Approval</span>
        </a>
    </li>
    <li>
        <a href="javascript:void()" style="color: white;">
            <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Rekap data</span>
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
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>13/07/2024</td>
                                    <td>Kebersihan</td>
                                    <td>udin</td>
                                    <td>butuh penyikat kamar mandi</td>
                                    <td>25.000</td>
                                    <td><a href="{{ route('bendahara.detail') }}"><button type="button"
                                                class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                    <td><span class="badge badge-danger px-2">Ditunda</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>13/07/2024</td>
                                    <td>Kebersihan</td>
                                    <td>udin</td>
                                    <td>butuh penyikat kamar mandi</td>
                                    <td>25.000</td>
                                    <td><a href="{{ route('bendahara.detail') }}"><button type="button"
                                                class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                    <td><span class="badge badge-secondary px-2">Menunggu</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>13/07/2024</td>
                                    <td>Kebersihan</td>
                                    <td>udin</td>
                                    <td>butuh penyikat kamar mandi</td>
                                    <td>25.000</td>
                                    <td><a href="{{ route('bendahara.detail') }}"><button type="button"
                                                class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                    <td><span class="badge badge-secondary px-2">Menunggu</span></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>13/07/2024</td>
                                    <td>Kebersihan</td>
                                    <td>udin</td>
                                    <td>butuh penyikat kamar mandi</td>
                                    <td>25.000</td>
                                    <td><a href="{{ route('bendahara.detail') }}"><button type="button"
                                                class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                    <td><span class="badge badge-danger px-2">Ditunda</span></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No Telp</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                    <th>Detail</th>
                                    <th>Status</th>
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
</div>
</div>
@endsection