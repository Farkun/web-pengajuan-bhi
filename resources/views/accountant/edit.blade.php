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
        <a href="{{ route('accountant.rekap') }}" style="color: white;">
            <i class="icon-notebook menu-icon" style="color: white;"></i><span class="nav-text">Rekap data</span>
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="{{ route('accountant.update', $pengaju->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH') <!-- Tambahkan ini untuk menggunakan metode PATCH -->

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="">Deskripsi </label>
                                <div class="col-lg-6">
                                    <textarea class="form-control" id="deskripsi" name="deskripsi"
                                        rows="5">{{ old('deskripsi', $pengaju->deskripsi) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" for="">Dana pengajuan</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="total" name="total"
                                        value="{{ old('total', $pengaju->total) }}" oninput="formatRupiah(this)">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-10 text-right">
                                    <button class="btn btn-info" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection