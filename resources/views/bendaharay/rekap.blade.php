@extends('layout.main')

@section('sidebar')
<ul class="metismenu" id="menu">
    <li class="nav-label"></li>
    <li>
        <a href="{{ route('bendaharay.data') }}" style="color: white;">
            <i class="icon-speedometer menu-icon" style="color: white;"></i><span class="nav-text">Data Rekap
                Accountant</span>
        </a>
    </li>
    <li>
        <a href="javascript:void()" style="color: white;">
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
                    <h4 class="card-title">Data Rekap Ulang</h4>
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
                                <tr>
                                    <td>1</td>
                                    <td>13/07/2024</td>
                                    <td>Kebersihan</td>
                                    <td>udin</td>
                                    <td>butuh penyikat kamar mandi</td>
                                    <td>25.000</td>
                                    <td><a href="{{ route('bendahara.detail') }}"><button type="button"
                                                class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                    <td><button type="button" class="btn mb-1 btn-secondary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Belum
                                            ditanggapi</button>
                                        <div class="dropdown-menu"><a class="dropdown-item" href="#">Tolak</a>
                                        </div>
                                    </td>
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
                                    <td><button type="button" class="btn mb-1 btn-secondary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Belum
                                            ditanggapi</button>
                                        <div class="dropdown-menu"><a class="dropdown-item" href="#">Tolak</a>
                                        </div>
                                    </td>
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
                                    <td><button type="button" class="btn mb-1 btn-secondary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Belum
                                            ditanggapi</button>
                                        <div class="dropdown-menu"><a class="dropdown-item" href="#">Sudah cair</a>
                                        </div>
                                    </td>
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
                                    <td><button type="button" class="btn mb-1 btn-secondary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Belum
                                            ditanggapi</button>
                                        <div class="dropdown-menu"><a class="dropdown-item" href="#">Tolak</a>
                                        </div>
                                    </td>
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
</div>
</div>
@endsection