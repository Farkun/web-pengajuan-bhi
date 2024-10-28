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
        <a href="javascript:void()" style="color: white;">
            <i class="icon-note menu-icon" style="color: white;"></i><span class="nav-text">Ajukan Dana</span>
        </a>
    </li>
    <li>
        <a href="{{ route('pengaju.result') }}" style="color: white;">
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
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pb-0 d-flex justify-content-between">
                            <div>
                                <h3 class="mb-1">Pengajuan</h3>
                                <h5>Di halaman ini Anda dapat mengajukan dana satu atau lebih.
                                    Orang yang Anda minta untuk menyetujui pengajuan akan mendapat notifikasi untuk
                                    menyetujui pengajuan. </h5>
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
                            <form class="form-valide" action="{{ route('pengaju.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-date">Masukan tanggal pengajuan
                                        <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" id="val-date" name="val-date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Masukan nama pengaju <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-username" name="val-username"
                                            placeholder="Tuliskan nama">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Deskripsi <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" id="val-suggestions" name="val-suggestions"
                                            rows="5" placeholder="Tuliskan deskripsi"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-currency">Dana pengajuan <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="val-currency" name="val-currency"
                                            placeholder="Rp.0,00" oninput="formatRupiah(this)">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nomor_rekening">Nomor Rekening <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nomor_rekening"
                                            name="nomor_rekening" placeholder="Masukkan nomor rekening"
                                            onkeypress="return isNumberKey(event)">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nama_bank">Nama Bank <span class="text-danger">*</span></label>
                                        <select id="nama_bank_select" name="nama_bank_select" class="form-control"
                                            onchange="toggleBankInput()">
                                            <option selected="selected" value="">Pilih Bank...</option>
                                            <option value="BCA">BCA</option>
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="BNI">BNI</option>
                                            <option value="BRI">BRI</option>
                                            <option value="Danamon">Danamon</option>
                                            <option value="CIMB Niaga">CIMB Niaga</option>
                                            <option value="other">Lainnya...</option>
                                        </select>

                                        <!-- Input tambahan untuk nama bank lain -->
                                        <input type="text" id="other_bank" class="form-control mt-2"
                                            placeholder="Masukkan Nama Bank Lainnya" style="display: none;">

                                        <!-- Input hidden yang akan mengirim nama bank ke database -->
                                        <input type="hidden" id="nama_bank" name="nama_bank">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="invoice">Invoice (opsional) *maksimal 2MB</label>
                                    <input type="file" class="form-control-file invoice-input" name="invoice">
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-10 text-right">
                                        <button class="btn btn-info btn sweet-ajax">Tambah Pengajuan</button>
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

@endsection