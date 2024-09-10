@extends('layout.main')

@section('sidebar')
<ul class="metismenu" id="menu">
    <li class="nav-label"></li>
    <li>
        <a href="javascript:void()" style="color: white;">
            <i class="icon-speedometer menu-icon" style="color: white;"></i><span class="nav-text">Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('accountant.data') }}" style="color: white;">
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
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-0 d-flex align-items-end row">
                            <div class="col-lg-12 text-center" style="text-align: center;">
                                <h2 class="mb-1">Selamat Datang, {{ $user->name }}</h2>
                                <p>{{ $currentDate }}</p>
                            </div>
                            <!-- <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{asset('assets/theme/images/Illustration.png')}}" alt=""
                                    style=" margin-left: 500px; width:100px; height: auto;" class="col-lg-11 text-right">
                            </div> -->
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-sm-6 mx-auto">
            <a href="{{ route('accountant.data') }}">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Data Approval</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">8541</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-file"></i></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-sm-6 ">
            <a href="{{ route('accountant.rekap') }}">
                <div class="card gradient-4">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Rekap Data</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">99</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-table"></i></span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!-- ansjsn -->
@endsection