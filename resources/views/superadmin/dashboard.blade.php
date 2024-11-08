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
        <a href="{{ route('superadmin.daftarakun') }}" style="color: white;">
            <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Daftar Akun</span>
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body d-flex align-items-end row">
                            <div>
                                <h2 class="mb-1">Selamat Datang, {{ $user->name }}</h2>
                                <p>{{ $currentDate }}</p>
                            </div>
                            <div class="card-body pb-0 px-0 px-md-4">
                                <!-- <canvas id="chart_widget_2"></canvas> -->
                                <img src="{{asset('assets/theme/images/Illustration.png')}}" alt=""
                                    style=" margin-left: 200px; width:100px; height: auto;">
                            </div>
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Total akun terdaftar</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $total }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
@endsection