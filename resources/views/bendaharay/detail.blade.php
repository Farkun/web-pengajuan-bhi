<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Form Advance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        body {
            font-family: Tahoma, sans-serif;
            font-size: 10pt;
        }

        .container {
            width: 800px;
            margin: 0 auto;
        }

        .header,
        .supplier-info,
        .item-table,
        .footer {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .header td,
        .supplier-info td,
        .item-table th,
        .item-table td,
        .footer td {
            padding: 5px;
            border: 1px solid black;
        }

        .header td,
        .supplier-info td {
            border: none;
        }

        .item-table th,
        .item-table td {
            text-align: left;
        }

        .item-table th {
            text-align: center;
        }

        .footer td {
            text-align: right;
        }

        .title {
            font-size: 14pt;
            font-weight: bold;
        }

        .right-align {
            text-align: right;
        }

        .logo-img {
            width: 150px;
            /* Atur lebar gambar */
            height: auto;
            /* Biarkan tinggi menyesuaikan proporsi */
        }

        .footer {
            display: flex;
            justify-content: flex-end;
            /* Pindahkan semua tombol ke sebelah kanan */
        }

        .footer .btn {
            margin-left: 10px;
            /* Jarak antara tombol */
        }

        @media print {
            .footer {
                display: none;
            }
        }

    </style>
</head>

<body>
    <div class="container">
        <table class="header">
            <tr>
                <td style="width: 70%;">
                    <!-- <span class="title">Nama Toko</span> -->
                    <img src="{{ asset('assets/theme/images/logo-bhs.png')}}" alt="Logo Toko" class="logo-img">
                    <br>
                    <span style="font-size: 10px;">Jl. Curug Mekar No.17 Yasmin-Bogor</span><br>
                    <span style="font-size: 10px;">Phone: 0251-7534343, Fax: 0251-7534515</span><br>
                    <span style="font-size: 10px;">Website: www.stpbogor.ac.id</span><br>
                    <span style="font-size: 10px;">Email: marketing@stpbogor.ac.id</span><br>
                </td>
                <td style="width: 10%; vertical-align: bottom; padding-top: 10px;">
                        Id: {{ 'PA' . str_pad($pengaju->id, 6, '0', STR_PAD_LEFT) }}<br>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; vertical-align: middle;">
                    <Strong>CASH FORM ADVANCE</Strong><br>
                </td>
            </tr>
        </table>

        <table class="item-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($pengaju->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $pengaju->deskripsi }}</td>
                        <td>Rp{{ number_format($pengaju->total, 0, ',', '.') }},00</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Rp{{ number_format($pengaju->total, 0, ',', '.') }},00</td>
                    </tr>
            </tbody>
        </table>
        <div class="footer">
            <a href="{{ route('bendaharay.data') }}"><button type="button"
                    class="btn mb-1 btn-rounded btn-warning"></span>Kembali</button></a>
            <button type="button" class="btn mb-1 btn-rounded btn-info" onclick="window.print()">
                <i class="bi bi-printer"></i>&nbsp;&nbsp;</span>Cetak PDF</button>
        </div>
    </div>
    
</body>

</html>