<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield ('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/theme/images/logo-bhs.png') }}">
    <!-- Pignose Calender -->
    <link href="{{ asset('assets/theme/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('assets/theme/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/theme/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <!-- dataTable -->
    <link href="{{ asset('assets/theme/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <!-- sweetAlert -->
    <link href="{{ asset('assets/theme/plugins/sweetalert/css/sweetalert.css')}}" rel="stylesheet">
    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <!-- Custom Stylesheet -->
    <link href="{{ asset('assets/theme/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <span class="brand-title">
                    <img src="{{ asset('assets/theme/images/logo-bhs.png') }}" alt="">
                </span>
                <!-- <a href="index.html">
                    <b class="logo-abbr"><img src="images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>
                </a> -->
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <!-- Tampilkan badge hanya jika ada notifikasi -->
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span
                                        class="badge badge-pill gradient-2">{{ auth()->user()->unreadNotifications->count() }}</span>
                                @endif
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <!-- Tampilkan pesan berbeda tergantung jumlah notifikasi -->
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                        <span>{{ auth()->user()->unreadNotifications->count() }} New Notifications</span>
                                    @else
                                        <span>No Notifications</span>
                                    @endif
                                    <!-- Badge di bagian dalam hanya muncul jika ada notifikasi -->
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                        <a href="javascript:void()" class="d-inline-block">
                                            <span
                                                class="badge badge-pill gradient-2">{{ auth()->user()->unreadNotifications->count() }}</span>
                                        </a>
                                    @endif
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        @foreach (auth()->user()->unreadNotifications as $notification)
                                            <li>
                                                <a href="{{ route('notifications.read', ['id' => $notification->id]) }}">
                                                    <span class="mr-3 avatar-icon bg-success-lighten-2"><i
                                                            class="icon-present"></i></span>
                                                    <div class="notification-content">
                                                        <h6 class="notification-heading">
                                                            {{ $notification->data['messages'] }}
                                                        </h6>
                                                        <span
                                                            class="notification-text">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown d-none d-md-flex">
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{ asset('assets/theme/images/user/1.png')}}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="{{ route('profile.edit') }}"><i class="icon-user"></i>
                                                <span>Profile</span></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <i class="mdi mdi-bell-outline"></i> <span>History</span>
                                                <div class="badge gradient-3 badge-pill gradient-1">3</div>
                                            </a>
                                        </li>

                                        <hr class="my-2">
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                                    <i class="icon-key"></i> <span>Logout</span>
                                                </x-responsive-nav-link>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                @yield('sidebar')
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            @yield('content')
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a>
                    2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('assets/theme/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('assets/theme/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/theme/js/settings.js') }}"></script>
    <script src="{{ asset('assets/theme/js/gleek.js') }}"></script>
    <script src="{{ asset('assets/theme/js/styleSwitcher.js') }}"></script>

    <!-- Chartjs -->
    <script src="{{ asset('assets/theme/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Circle progress -->
    <script src="{{ asset('assets/theme/plugins/circle-progress/circle-progress.min.js') }}"></script>
    <!-- Datamap -->
    <script src="{{ asset('assets/theme/plugins/d3v3/index.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/topojson/topojson.min.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/datamaps/datamaps.world.min.js') }}"></script>
    <!-- Morrisjs -->
    <script src="{{ asset('assets/theme/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/morris/morris.min.js') }}"></script>
    <!-- Pignose Calender -->
    <script src="{{ asset('assets/theme/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
    <!-- ChartistJS -->
    <script src="{{ asset('assets/theme/plugins/chartist/js/chartist.min.js') }}"></script>
    <script
        src="{{ asset('assets/theme/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js')}}"></script>

    <script src="{{ asset('assets/theme/js/dashboard/dashboard-1.js') }}"></script>

    <!-- dataTable -->
    <script src="{{ asset('assets/theme/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>

    <!-- SweetAlert -->
    <script src="{{ asset('assets/theme/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/theme/plugins/sweetalert/js/sweetalert.init.js') }}"></script>

    <script>
        function formatRupiah(element) {
            let angka = element.value.replace(/[^,\d]/g, ''),
                split = angka.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            element.value = rupiah;
        }

        document.addEventListener('DOMContentLoaded', function () {
            let inputElement = document.getElementById('val-currency');

            inputElement.addEventListener('input', function () {
                let cursorPos = inputElement.selectionStart;
                let originalLength = inputElement.value.length;

                formatRupiah(inputElement);

                let newLength = inputElement.value.length;
                cursorPos += newLength - originalLength;
                inputElement.setSelectionRange(cursorPos, cursorPos);
            });
        });
    </script>

    <script>
        document.querySelectorAll('.sweet-confirmm').forEach(button => {
            button.addEventListener('click', function (event) {
                const form = this.closest('form');
                swal({
                    title: "Apakah Anda yakin?",
                    text: "Data ini akan dihapus secara permanen!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false
                }, function () {
                    form.submit(); // Submit form untuk menghapus data
                });
            });
        });
    </script>

    <script>
        document.querySelectorAll('.sweet-confirm').forEach(button => {
            button.addEventListener('click', function (event) {
                const form = this.closest('form'); // Get the closest form related to the button
                swal({
                    title: "Apakah Anda yakin?",
                    text: "Password akan direset ke default!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, reset password!",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false
                }, function () {
                    form.submit(); // Submit form untuk reset password
                });
            });
        });
    </script>

    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            // Izinkan angka saja (0-9)
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>

    <script>
        document.querySelector('.sweet-ajax').addEventListener('click', function (event) {
            event.preventDefault(); // Mencegah form submit langsung
            // Validasi sederhana di frontend
            var date = document.getElementById('val-date').value;
            var username = document.getElementById('val-username').value;
            var suggestions = document.getElementById('val-suggestions').value;
            var currency = document.getElementById('val-currency').value;
            var nomorRekening = document.getElementById('nomor_rekening').value;
            var namaBank = document.getElementById('nama_bank').value;
            var invoice = document.querySelector('.invoice-input').files[0]; // Menggunakan class untuk validasi file upload

            // Cek apakah semua field sudah diisi
            if (date === "" || username === "" || suggestions === "" || currency === "" || nomorRekening === "" || namaBank === "") {
                swal({
                    title: "Kesalahan!",
                    text: "Semua data pengajuan yang wajib harus diisi!",
                    icon: "error",
                    button: "OK",
                });
            } else if (invoice && !['application/pdf', 'image/jpeg', 'image/png'].includes(invoice.type)) {
                swal({
                    title: "Kesalahan!",
                    text: "File invoice harus dalam format PDF, JPEG, atau PNG!",
                    icon: "error",
                    button: "OK",
                });
            } else if (invoice && invoice.size > 2048 * 1024) { // Maksimal 2MB
                swal({
                    title: "Kesalahan!",
                    text: "Ukuran file invoice tidak boleh lebih dari 2MB!",
                    icon: "error",
                    button: "OK",
                });
            } else {
                swal({
                    title: "Apakah Anda yakin?",
                    text: "Anda akan mengajukan permintaan ini.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Ajukan!",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false
                }, function () {
                    // Kirim form menggunakan JavaScript
                    event.target.closest('form').submit(); // Mengirim form jika dikonfirmasi
                });
            }
        });
    </script>

    <script>
        // Mengatur ID pengajuan untuk modal Tolak
        $('#rejectModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var pengajuId = button.data('id'); // Ambil ID pengajuan dari atribut data-id
            var modal = $(this);
            modal.find('.modal-body #rejectId').val(pengajuId); // Set ID pengajuan ke dalam input hidden
        });

        // Mengatur ID pengajuan untuk modal Pending
        $('#pendingModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var pengajuId = button.data('id'); // Ambil ID pengajuan dari atribut data-id
            var modal = $(this);
            modal.find('.modal-body #pendingId').val(pengajuId); // Set ID pengajuan ke dalam input hidden
        });
    </script>

    <script>
        // Mengatur ID pengajuan untuk modal Tolak
        $('#rejecttModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var pengajuId = button.data('id'); // Ambil ID pengajuan dari atribut data-id
            var modal = $(this);
            modal.find('.modal-body #rejectId').val(pengajuId); // Set ID pengajuan ke dalam input hidden
        });
    </script>

    <script>
        function confirmApprove(id) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            swal({
                title: "Apakah Anda yakin?",
                text: "Anda akan menyetujui pengajuan ini!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#4CAF50",
                confirmButtonText: "Ya, setujui!",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) {
                    // Kirim request POST untuk menyetujui pengajuan
                    fetch('/approval/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            pengaju_id: id,
                            keterangan: null, // Set null jika tidak ada keterangan
                            status: 'Setujui', // Status yang diatur
                            user_id: {{ Auth::id() }} // Mengirim ID pengguna yang sedang login
                })
                    })
                        .then(response => {
                            if (response.ok) {
                                return response.json(); // Coba parsing JSON jika respons OK
                            } else {
                                return response.text().then(text => { throw new Error(text); }); // Tangani respons non-JSON
                            }
                        })
                        .then(data => {
                            if (data.success) {
                                swal("Disetujui!", "Pengajuan telah disetujui.", "success");
                                location.reload(); // Reload halaman setelah proses selesai
                            } else {
                                swal("Oops!", "Terjadi kesalahan saat menyetujui pengajuan.", "error");
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error); // Log error ke console
                            swal("Oops!", "Terjadi kesalahan saat menyetujui pengajuan.", "error");
                        });
                }
            });
        }
    </script>

    <script>
        function submitForm(event, formId, status) {
            event.preventDefault(); // Mencegah form dari submit secara default

            // Tampilkan swal dengan konfirmasi sederhana
            swal({
                title: 'Anda yakin?',
                text: 'Apakah Anda yakin ingin melanjutkan aksi ini?',
                type: 'warning',
                showCancelButton: true, // Menampilkan tombol batal
                confirmButtonText: 'Iya',
                cancelButtonText: 'Batal',
                closeOnConfirm: false, // Jangan otomatis menutup swal
                closeOnCancel: false // Jangan otomatis menutup swal
            }, function (isConfirm) {
                if (isConfirm) {
                    var form = document.getElementById(formId);
                    var formData = new FormData(form);

                    fetch('{{ route('approval.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            let title, text, icon;

                            if (data.success) {
                                if (status === 'Tolak') {
                                    title = 'Ditolak!';
                                    text = 'Pengajuan telah ditolak. ' + data.message;
                                    icon = 'error';
                                } else if (status === 'Pending') {
                                    title = 'Pending!';
                                    text = 'Pengajuan dalam status pending. ' + data.message;
                                    icon = 'warning';
                                } else {
                                    title = 'Berhasil!';
                                    text = data.message;
                                    icon = 'success';
                                }

                                // Tampilkan swal hasil akhir
                                swal({
                                    title: title,
                                    text: text,
                                    type: icon, // Menggunakan 'type' di SweetAlert 1.x
                                    confirmButtonText: "OK"
                                }, function () {
                                    // Menyembunyikan modal dan reload halaman
                                    $('#' + formId.replace('Form', 'Modal')).modal('hide');
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: 'Oops!',
                                    text: data.message || 'Terjadi kesalahan.',
                                    type: 'error',
                                    confirmButtonText: "OK"
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            swal({
                                title: 'Oops!',
                                text: 'Terjadi kesalahan saat mengirim data.',
                                type: 'error',
                                confirmButtonText: "OK"
                            });
                        });
                } else {
                    swal({
                        title: 'Dibatalkan',
                        text: 'Aksi Anda dibatalkan.',
                        type: 'info',
                        confirmButtonText: "OK"
                    });
                }
            });
        }
    </script>

    <script>
        document.getElementById('kirimRekapBtn').addEventListener('click', function () {
            if (document.querySelectorAll('input[name="selected_pengajus[]"]:checked').length > 0) {
                swal({
                    title: "Kirim Rekap?",
                    text: "Apakah Anda yakin ingin mengirim rekap data yang telah dipilih?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Ya, kirim!",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        var form = document.getElementById('forwardForm');
                        var formData = new FormData(form);

                        fetch(form.action, {
                            method: form.method,
                            body: formData,
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    swal({
                                        title: "Sukses",
                                        text: data.message,
                                        type: "success"
                                    }, function () {
                                        window.location.reload(); // Reload halaman setelah menekan OK
                                    });
                                    document.querySelectorAll('input[name="selected_pengajus[]"]:checked').forEach(checkbox => {
                                        checkbox.closest('tr').remove();
                                    });
                                } else {
                                    swal("Gagal", data.message, "error");
                                }
                            })
                            .catch(error => {
                                swal("Terjadi kesalahan", "Terjadi kesalahan saat mengirim data.", "error");
                            });
                    }
                });
            } else {
                swal("Error", "Harap pilih data terlebih dahulu sebelum mengirim rekap.", "error");
            }
        });
    </script>

    <script>
        document.getElementById('kirimRekapBtnTwo').addEventListener('click', function () {
            if (document.querySelectorAll('input[name="selected_pengajus[]"]:checked').length > 0) {
                swal({
                    title: "Kirim Rekap?",
                    text: "Apakah Anda yakin ingin mengirim rekap data yang telah dipilih?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Ya, kirim!",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        var form = document.getElementById('forwardTwoForm');
                        var formData = new FormData(form);

                        fetch(form.action, {
                            method: form.method,
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    swal({
                                        title: "Sukses",
                                        text: data.message,
                                        type: "success"
                                    }, function () {
                                        window.location.reload(); // Reload halaman setelah menekan OK
                                    });
                                    // Hapus row data yang dipilih
                                    document.querySelectorAll('input[name="selected_pengajus[]"]:checked').forEach(checkbox => {
                                        checkbox.closest('tr').remove();
                                    });
                                } else {
                                    swal("Gagal", data.message, "error");
                                }
                            })
                            .catch(error => {
                                swal("Terjadi kesalahan", "Terjadi kesalahan saat mengirim data.", "error");
                            });
                    }
                });
            } else {
                swal("Error", "Harap pilih data terlebih dahulu sebelum mengirim rekap.", "error");
            }
        });
    </script>

    <script>
        document.getElementById('select-all').addEventListener('change', function () {
            const checkboxes = document.querySelectorAll('.pengaju-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>

    <script>
        document.getElementById('rejectForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah form dari submit secara default

            swal({
                title: 'Anda yakin?',
                text: 'Pengajuan akan ditunda dan dikembalikan ke accountant.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tolak!',
                cancelButtonText: 'Batal',
                closeOnConfirm: false, // Jangan otomatis menutup swal
                closeOnCancel: true // Menutup swal jika dibatalkan
            }, function (isConfirm) {
                if (isConfirm) {
                    var form = document.getElementById('rejectForm');
                    var formData = new FormData(form);

                    // Menambahkan header CSRF
                    fetch("{{ route('bendaharay.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                swal({
                                    title: 'Ditolak!',
                                    text: 'Pengajuan telah ditolak dan dikembalikan ke accountant.',
                                    type: 'success',
                                    confirmButtonText: 'OK'
                                }, function () {
                                    // Sembunyikan modal dan reload halaman
                                    $('#rejecttModal').modal('hide');
                                    location.reload();
                                });
                            } else {
                                swal('Error', data.message, 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            swal('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
                        });
                }
            });
        });
    </script>

    <script>
        document.getElementById('approveAllBtn').addEventListener('click', function () {
            swal({
                title: "Setujui Semua Pengajuan?",
                text: "Apakah Anda yakin ingin menyetujui semua pengajuan yang ada?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Ya, setujui semua!",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Kirim permintaan POST untuk menyetujui semua pengajuan
                    fetch('/bendaharay/approve-all', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                swal({
                                    title: "Disetujui!",
                                    text: "Semua pengajuan telah disetujui dan dikirim.",
                                    type: "success"
                                }, function () {
                                    window.location.reload(); // Reload halaman setelah sukses
                                });
                            } else {
                                swal("Oops!", "Terjadi kesalahan saat menyetujui pengajuan.", "error");
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            swal("Oops!", "Terjadi kesalahan saat menyetujui pengajuan.", "error");
                        });
                }
            });
        });
    </script>

    <script>
        // Menambahkan event listener untuk submit form pencairan
        document.getElementById('cairForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah submit form secara otomatis

            swal({
                title: 'Anda yakin?',
                text: 'Dana akan dicairkan dan bukti pembayaran akan disimpan.',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Cairkan!',
                cancelButtonText: 'Batal',
                closeOnConfirm: false, // Jangan otomatis menutup swal
                closeOnCancel: true // Menutup swal jika dibatalkan
            }, function (isConfirm) {
                if (isConfirm) {
                    // Ambil form dan data form
                    var form = document.getElementById('cairForm');
                    var formData = new FormData(form);

                    // Menambahkan header CSRF
                    fetch("{{ route('bendahara.updateCair') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Jika berhasil, tampilkan alert sukses dan reload halaman
                                swal({
                                    title: 'Sukses!',
                                    text: 'Dana telah berhasil dicairkan dan bukti pembayaran telah disimpan.',
                                    type: 'success',
                                    confirmButtonText: 'OK'
                                }, function () {
                                    $('#cairModal').modal('hide'); // Menutup modal
                                    location.reload(); // Reload halaman
                                });
                            } else {
                                // Jika gagal, tampilkan alert error
                                swal('Error', data.message, 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            swal('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
                        });
                }
            });
        });
    </script>

    <script>
        // Menangani event ketika modal dibuka
        $('#cairModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var pengajuId = button.data('pengaju-id'); // Ambil ID pengaju dari data attribute

            // Isi input tersembunyi dengan ID pengaju
            document.getElementById('pengajuId').value = pengajuId;
        });
    </script>

    <script>
        function toggleBankInput() {
            var select = document.getElementById("nama_bank_select");
            var otherBankInput = document.getElementById("other_bank");
            var hiddenBankInput = document.getElementById("nama_bank");

            if (select.value === "other") {
                otherBankInput.style.display = "block";
                otherBankInput.required = true;
                hiddenBankInput.value = ""; // Kosongkan saat opsi "Lainnya" dipilih

                // Update input hidden dengan nilai dari input custom saat pengguna mengetik
                otherBankInput.addEventListener('input', function () {
                    hiddenBankInput.value = otherBankInput.value;
                });
            } else {
                otherBankInput.style.display = "none";
                otherBankInput.required = false;
                hiddenBankInput.value = select.value; // Set nilai dropdown jika bukan "Lainnya"
            }
        }
    </script>

    <script>
        function confirmReceive(pengajuId, checkbox) {
            // Menyimpan status awal checkbox
            const isChecked = checkbox.checked;

            // Menampilkan SweetAlert konfirmasi menggunakan callback function
            swal({
                title: 'Apakah dana yang dicairkan sudah Anda terima?',
                text: "Jika sudah, tekan 'Ya' untuk konfirmasi.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                closeOnCancel: true // Menutup swal jika dibatalkan
            }, function (isConfirm) {
                if (isConfirm) {
                    // Jika konfirmasi 'Ya', kirimkan data ke server
                    fetch("{{ route('pengaju.receive') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ id: pengajuId })
                    })
                        .then(response => {
                            if (!response.ok) {
                                return Promise.reject('Server Error: Gagal mengirimkan data');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Jika berhasil, tampilkan SweetAlert sukses
                                swal({
                                    title: 'Berhasil!',
                                    text: 'Dana telah diterima.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }, function () {
                                    // Ubah status checkbox dan nonaktifkan agar tidak bisa diubah lagi
                                    checkbox.checked = true;
                                    checkbox.disabled = true;
                                });
                            } else {
                                swal('Error!', 'Gagal mengonfirmasi penerimaan dana.', 'error');
                            }
                        })
                        .catch(error => {
                            // Tangani error jika terjadi pada fetch atau response
                            console.error('Error:', error);
                            swal('Error', 'Terjadi kesalahan saat mengirim data.', 'error');

                            // Mengembalikan status checkbox jika ada error
                            checkbox.checked = !isChecked;
                        });
                } else {
                    // Jika dibatalkan, kembalikan status awal checkbox
                    checkbox.checked = !isChecked;
                }
            });
        }
    </script>
</body>

</html>