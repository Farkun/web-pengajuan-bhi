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
        <a href="{{ route('pengaju.dana') }}" style="color: white;">
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
                        <div class="card-body d-flex align-items-stretch">
                            <div style="flex: 1; padding: 20px;">
                                <div>
                                    <h2 class="mb-1">Selamat Datang, {{ $user->name }}</h2>
                                    <p>{{ $currentDate }}</p>
                                    <br><br>
                                    <a href="{{ route('pengaju.dana') }}">
                                        <button type="button" class="btn mb-1 btn-info">Ajukan Dana disini<span
                                                class="btn-icon-right"><i class="fa fa-table"></i></span>
                                        </button>
                                    </a>
                                </div>
                            </div>

                            <!-- Garis Vertikal sebagai pemisah -->
                            <div
                                style="border-left: 2px solid #808080; height: 250px; align-self: stretch; margin: 0 40px;">
                            </div>

                            <div style="flex: 2; padding: 20px; text-align: center;">
                                <h4 class="text-muted text-center">Data Pengajuan Terbaru</h4>
                                <br>
                                <div class="table-responsive">
                                    <a href="{{ route('pengaju.result') }}">
                                        <table class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tanggal</th>
                                                    <th>Pengajuan</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($latestPengajus as $pengaju)
                                                    <tr>
                                                        <th>{{ $loop->iteration }}</th>
                                                        <td>{{ $pengaju->tanggal }}</td>
                                                        <td>Rp{{ number_format($pengaju->total, 0, ',', '.') }}</td>
                                                        <td>
                                                            @if($pengaju->id_status == 2)
                                                                <span class="badge badge-danger px-2">Ditolak</span>
                                                            @elseif($pengaju->id_status == 3)
                                                                <span class="badge badge-warning px-2">Dipending</span>
                                                            @elseif($pengaju->id_status == 1)
                                                                <span class="badge badge-success px-2">Disetujui</span>
                                                            @else
                                                                <span class="badge badge-secondary px-2">Belum dibaca</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-stretch justify-content-center text-center">
                                    <!-- Tombol di sebelah kiri -->
                                    <div class="me-3">
                                        <td><a href="{{ route('pengaju.status') }}">
                                                <button class="btn w-100" id="status-button"
                                                    style="background-color: transparent; border: 2px solid #000; padding: 35px; font-size: 1.5rem; color: #000;">
                                                    <div class="card mb-0">
                                                        <div class="card-body d-flex align-items-center p-0"
                                                            style="padding: 40px; display: flex; align-items: center;">
                                                            <img src="{{asset('assets/theme/images/status_pengaju.png')}}"
                                                                class="img-fluid" alt="Placeholder Image"
                                                                style="max-width: 200px; margin-right: 20px;" id="status-image">
                                                            <div class="ml-3" id="status-text">
                                                                <h1>Status Pengaju & Pencairan Dana</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </button>
                                    </div>

                                </div>
                            </div>
                            <!-- /# card -->
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script>
    function adjustLayout() {
        const cardBody = document.querySelector('.card-body');
        if (window.innerWidth <= 767) {
            cardBody.style.flexDirection = 'column';
        } else {
            cardBody.style.flexDirection = 'row';
        }
    }

    window.addEventListener('resize', adjustLayout);
    adjustLayout();
</script>

<script>
    function adjustSeparator() {
        const separator = document.querySelector('.card-body > div:nth-child(2)');
        if (window.innerWidth <= 767) {
            separator.style.borderLeft = 'none';
            separator.style.borderTop = '2px solid #808080';
            separator.style.height = 'auto';
            separator.style.margin = '20px 0';
        } else {
            separator.style.borderLeft = '2px solid #808080';
            separator.style.borderTop = 'none';
            separator.style.height = '250px';
            separator.style.margin = '0 40px';
        }
    }

    window.addEventListener('resize', adjustSeparator);
    adjustSeparator();
</script>

<script>
    function adjustTable() {
        const tableResponsive = document.querySelector('.table-responsive');
        if (window.innerWidth <= 767) {
            tableResponsive.style.overflowX = 'auto';
        } else {
            tableResponsive.style.overflowX = 'visible';
        }
    }

    window.addEventListener('resize', adjustTable);
    adjustTable();
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function adjustLayout() {
            const width = window.innerWidth;
            const img = document.getElementById('status-image');
            const text = document.getElementById('status-text');
            const button = document.getElementById('status-button');

            if (width < 768) { // Ukuran untuk perangkat mobile
                // Sesuaikan border dan padding untuk tampilan mobile
                button.style.border = '1px solid #000'; // Kurangi ketebalan border untuk mobile
                button.style.padding = '20px'; // Sesuaikan padding untuk mobile

                img.style.display = 'block'; // Tampilkan gambar
                img.style.maxWidth = '100%'; // Sesuaikan lebar gambar

                text.style.display = 'none'; // Sembunyikan teks
            } else {
                // Kembalikan gaya untuk desktop
                button.style.border = '2px solid #000'; // Ketebalan border untuk desktop
                button.style.padding = '35px'; // Padding untuk desktop

                img.style.display = 'inline-block'; // Tampilkan gambar
                img.style.maxWidth = '200px'; // Sesuaikan lebar gambar untuk desktop

                text.style.display = 'block'; // Tampilkan teks
            }
        }

        // Initial adjustment
        adjustLayout();

        // Adjust layout on window resize
        window.addEventListener('resize', adjustLayout);
    });
</script>

@endsection