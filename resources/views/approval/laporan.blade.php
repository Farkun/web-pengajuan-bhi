@extends('layout.main')

@section('sidebar')
<ul class="metismenu" id="menu">
    <li class="nav-label"></li>
        <li>
            <a href="{{ route('approval.status') }}" style="color: white;">
                <i class="icon-speedometer menu-icon" style="color: white;"></i><span class="nav-text">Status</span>
            </a>
        </li>
        <li>
            <a href="javascript:void()" style="color: white;">
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
                                            <h3 class="mb-1">Laporan</h3>
                                            <h5>Berikut ini laporan surat pengajuan. Anda bisa memantau status pencairan.</h5>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                                                <td><a href="{{ route('approval.detaillap') }}"><button type="button" class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                                <td><span class="badge badge-success px-2">Sudah cair</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>13/07/2024</td>
                                                <td>Kebersihan</td>
                                                <td>udin</td>
                                                <td>butuh penyikat kamar mandi</td>
                                                <td>25.000</td>
                                                <td><a href="{{ route('approval.detaillap') }}"><button type="button" class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                                <td><span class="badge badge-success px-2">Sudah cair</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>13/07/2024</td>
                                                <td>Kebersihan</td>
                                                <td>udin</td>
                                                <td>butuh penyikat kamar mandi</td>
                                                <td>25.000</td>
                                                <td><a href="{{ route('approval.detaillap') }}"><button type="button" class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                                <td><span class="badge badge-success px-2">Sudah cair</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>13/07/2024</td>
                                                <td>Kebersihan</td>
                                                <td>udin</td>
                                                <td>butuh penyikat kamar mandi</td>
                                                <td>25.000</td>
                                                <td><a href="{{ route('approval.detaillap') }}"><button type="button" class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                                <td><span class="badge badge-success px-2">Sudah cair</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
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
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="general-button col-lg-11 text-right">
                                        <button type="button" class="btn mb-1 btn-success">Export Excel</button>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- #/ container -->
            </div>
        
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
                                <span>Total Dana Pengajuan yang Sudah dicairkan</span>
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
@endsection