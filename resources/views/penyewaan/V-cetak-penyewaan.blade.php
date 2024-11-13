<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $business_profile->brand_name }} - Bukti Pembayaran</title>

    <link rel="icon" href="{{ Storage::url($business_profile->logo) }}" type="image/x-icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/stisla/dist/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/stisla/dist/assets/modules/fontawesome/css/all.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/stisla/dist/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/stisla/dist/assets/css/components.css">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .a4 {
            width: 210mm;
            height: 297mm;
            padding: 10mm;
            margin: 0 auto;
            box-sizing: border-box;
            background-color: white;
            box-shadow: 0 0 10mm rgba(0, 0, 0, 0.2);
        }

        .form-label {
            font-weight: bold;
        }

        @media print {
            .a4 {
                width: 210mm;
                height: 297mm;
                padding: 10mm;
                margin: 0 auto;
                page-break-after: always;
                page-break-before: always;
                box-shadow: none;
            }

            body {
                margin: 0;
            }
        }
    </style>

</head>

<body class="bg-gray">

    <div class="a4">
        <div class="d-flex align-items-center justify-content-center mb-5">
            <div>
                <img src="{{ Storage::url($business_profile->logo) }}" alt="logo" class="img-fluid" style="width: 100px;">
            </div>
            <div class="text-center ml-3">
                <h1>{{ $business_profile->brand_name }}</h1>
                <h1>Bukti Pembayaran</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <x-input type="text" label="Pelanggan" :value="'ID' . $penyewaan->pengguna->id . ' - ' . $penyewaan->pengguna->name" readonly />
                </div>
                <div class="mb-3">
                    <x-input type="text" label="Merk" :value="$penyewaan->mobil->merk" readonly />
                </div>
                <div class="mb-3">
                    <x-input type="text" label="Model" :value="$penyewaan->mobil->model" readonly />
                </div>
                <div class="mb-3">
                    <x-input type="text" label="No. Polisi" :value="$penyewaan->mobil->no_polisi" readonly />
                </div>
                <div class="mb-3">
                    <x-input type="text" label="Tahun" :value="$penyewaan->mobil->tahun" readonly />
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <x-input type="text" label="Warna" :value="$penyewaan->mobil->warna" readonly />
                </div>
                <div class="mb-3">
                    <x-input type="text" label="Harga Harian" :value="'Rp. ' . number_format($penyewaan->mobil->harga_harian)" readonly />
                </div>
                <div class="mb-3">
                    <x-input type="text" label="Tanggal Penyewaan" :value="date('d-m-Y', strtotime($penyewaan->tgl_mulai)) . ' s/d ' . date('d-m-Y', strtotime($penyewaan->tgl_selesai))" readonly />
                </div>
                <div class="mb-3">
                    <x-input type="text" label="Status Penyewaan" :value="$penyewaan->status" readonly />
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <x-input type="text" name="kode_pembayaran" label="Kode Pembayaran" :value="$penyewaan->pembayaran->kode_pembayaran" readonly />
                </div>
                <div class="mb-3">
                    <x-input type="text" name="tanggal_pembayaran" label="Tanggal Pembayaran" :value="date('d-m-Y H:i', strtotime($penyewaan->pembayaran->created_at))" readonly />
                </div>
                <div class="mb-3">
                    <x-input type="text" name="total_harga" label="Total Harga" :value="'Rp. ' . number_format($penyewaan->pembayaran->total_harga)" readonly />
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <img src="{{ Storage::url($penyewaan->pembayaran->bukti_pembayaran) }}" alt="" class="img-fluid" style="width: 450px;">
                </div>
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('/') }}assets/stisla/dist/assets/modules/jquery.min.js"></script>

    <script>
        window.onload = function() {
            // window.print();
        }
    </script>
</body>

</html>
