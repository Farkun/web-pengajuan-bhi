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
    <h1>Status</h1>
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
                                                    <th>Nama Dapartemen</th>
                                                    <th>Nama Pengaju</th>
                                                    <th>Deskripsi</th>
                                                    <th>Dana Pengajuan</th>
                                                    <th>Detail</th>
                                                    <th>Persetujuan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>1</th>
                                                    <td>2024-01-22</td>
                                                    <td>akutansi</td>
                                                    <td>M.Budiman</td>
                                                    <td>Lorem ipsum dolor sit amet....</td>
                                                    <td class="color-primary">Rp2.000.000</td>
                                                    <td><a href="{{ route('approval.detailstat') }}"><button type="button" class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                                    <td><button type="button" class="btn mb-1 btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Tolak</a>
                                                        <a class="dropdown-item" href="#">Pending</a>
                                                        <a class="dropdown-item" href="#">Setujui</a>
                                                    </div>
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <th>2</th>
                                                    <td>2024-01-30</td> 
                                                    <td>akutansi</td>
                                                    <td>M.Budiman</td>
                                                    <td>Lorem ipsum dolor sit amet....</td>
                                                    <td class="color-primary">Rp2.000.000</td>
                                                    <td><a href="{{ route('approval.detailstat') }}"><button type="button" class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                                    <td><button type="button" class="btn mb-1 btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Tolak</a>
                                                        <a class="dropdown-item" href="#">Pending</a>
                                                        <a class="dropdown-item" href="#">Setujui</a>
                                                    </div>
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <th>3</th>
                                                    <td>2024-01-25</td> 
                                                    <td>akutansi</td>
                                                    <td>M.Budiman</td>
                                                    <td>Lorem ipsum dolor sit amet....</td>
                                                    <td class="color-primary">Rp2.000.000</td>
                                                    <td><a href="{{ route('approval.detailstat') }}"><button type="button" class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                                    <td><button type="button" class="btn mb-1 btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Tolak</a>
                                                        <a class="dropdown-item" href="#">Pending</a>
                                                        <a class="dropdown-item" href="#">Setujui</a>
                                                    </div>
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <th>4</th>
                                                    <td>2024-01-08</td> 
                                                    <td>akutansi</td>
                                                    <td>M.Budiman</td>
                                                    <td>Lorem ipsum dolor sit amet....</td>
                                                    <td class="color-primary">Rp2.000.000</td>
                                                    <td><a href="{{ route('approval.detailstat') }}"><button type="button" class="btn mb-1 btn-info">Cek Detail</button></a></td>
                                                    <td><button type="button" class="btn mb-1 btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Tolak</a>
                                                        <a class="dropdown-item" href="#">Pending</a>
                                                        <a class="dropdown-item" href="#">Setujui</a>
                                                    </div>
                                                    </td> 
                                                </tr>
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