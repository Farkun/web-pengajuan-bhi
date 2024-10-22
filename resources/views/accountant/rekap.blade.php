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
                <form action="{{ route('accountant.forwardtwo') }}" method="POST" id="forwardTwoForm">
                    @csrf
                    <div class="card-body">
                        <h4 class="card-title">Rekap Data</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all" /></th>
                                        <th>Tanggal</th>
                                        <th>Nama Departement</th>
                                        <th>Nama Pengaju</th>
                                        <th>Deskripsi</th>
                                        <th>Dana Pengajuan</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($finalPengajus as $pengaju)
                                    <tr>
                                        <td>
                                            @if($pengaju->status->status === 'Ditunda')
                                                <input type="checkbox" class="pengaju-checkbox" name="selected_pengajus[]" value="{{ $pengaju->id }}">
                                            @else
                                                &nbsp;&nbsp; <!-- Ini untuk mengatur tata letak jika tidak ada checkbox -->
                                            @endif
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($pengaju->tanggal)->format('d/m/Y') }}</td>
                                        <td>{{ $pengaju->user->name }}</td>
                                        <td>{{ $pengaju->nama_pengaju }}</td>
                                        <td
                                            style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $pengaju->deskripsi }}
                                        </td>
                                        <td>{{ number_format($pengaju->total, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge {{ $pengaju->status->badge_class }} px-2">
                                                {{ $pengaju->status->status }}
                                            </span>
                                        </td>
                                        <td
                                            style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            @if($pengaju->displayed_keterangan)
                                                                                    @php
                                                                                        // Mengambil data keterangan_data
                                                                                        $keteranganData = $pengaju->keterangan->keterangan_data;

                                                                                        // Jika keterangan_data adalah string JSON, decode menjadi array
                                                                                        if (is_string($keteranganData)) {
                                                                                            $keteranganData = json_decode($keteranganData, true);
                                                                                        }

                                                                                        // Cek apakah keterangan_data sudah menjadi array dan lanjutkan untuk bendahara yayasan
                                                                                        $bendaharaData = $keteranganData['bendahara yayasan'] ?? null;
                                                                                    @endphp

                                                                                    @if($bendaharaData)
                                                                                        <p><strong>{{ \App\Models\User::find($bendaharaData['id'])->name }}:</strong>
                                                                                            {{ $bendaharaData['keterangan'] }}</p>
                                                                                    @else
                                                                                        Tidak ada keterangan.
                                                                                    @endif
                                            @else
                                                Tidak ada keterangan.
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('accountant.detailket', ['id' => $pengaju->id]) }}" style="margin-right: 10px;">
                                                    <button type="button" class="btn mb-1 btn-info">Cek Detail</button>
                                                </a>
    
                                                @if($pengaju->status->status != 'Menunggu')
                                                    <a href="{{ route('accountant.edit', ['id' => $pengaju->id]) }}">
                                                        <button type="button" class="btn btn-warning">
                                                            <i class="fa fa-pencil"></i>&nbsp;Edit
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="general-button col-lg-11 text-right">
                        <div class="sweetalert m-t-30">
                            <button type="button" class="btn mb-1 btn-primary" id="kirimRekapBtnTwo">Kirim Rekap</button>
                        </div>
                        <br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection