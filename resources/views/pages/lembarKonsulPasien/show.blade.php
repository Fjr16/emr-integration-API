<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konsultasi/Kontrol Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <style>
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #fafafa;
        }

        .content {
            /* height: 21.59cm; */
            height: auto;
            width: 29.7cm;
            /* min-height: 13.97cm; */
            padding-top: 1.27cm;
            padding-bottom: 1.27cm;
            padding-right: 5rem;
            padding-left: 5rem;
            margin: 5mm auto;
            border: 1px #d3d3d3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .page-break {
            page-break-before: always;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            @page {
                size: landscape;
                margin: 0;
            }

            body {
                font-family: Arial, sans-serif;
            }

            .content {
                height: auto;
                width: auto;
                background-color: #fff;
                border: none;
                box-shadow: none;
                padding-right: 5rem;
                padding-left: 5rem;
            }

            .page-break {
                page-break-before: always;
            }

            .btn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="content">
        <!-- Judul -->
        <div class="d-flex flex-row">
            <div class="col-2 text-start">
                <img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid my-2"
                    style="max-width: 19rem; height: auto" />
            </div>
            <div class="col-8 text-center">
                <p class="fw-bold fs-4 pt-2">LEMBAR KONSULTASI / KONTROL PASIEN</p>
            </div>
        </div>
        <!-- end Judul -->

        <!-- Isi Konten -->
        <div class="row mt-5">
            <div class="col col-12">
                <table>
                    <tr class="">
                        <td class="pt-2">Nama Pasien</td>
                        <td class="pt-2 px-2">:</td>
                        <td class="pt-2"></td>
                    </tr>
                    <tr class="">
                        <td class="pt-2">Umur</td>
                        <td class="pt-2 px-2">:</td>
                        <td class="pt-2"></td>
                    </tr>
                    <tr class="">
                        <td class="pt-2">No. Rekam Medis</td>
                        <td class="pt-2 px-2">:</td>
                        <td class="pt-2"></td>
                    </tr>
                    <tr class="">
                        <td class="pt-2">Diagnosa Akhir</td>
                        <td class="pt-2 px-2">:</td>
                        <td class="pt-2"></td>
                    </tr>
                    <tr class="">
                        <td class="pt-2">Terapi yang diberikan</td>
                        <td class="pt-2 px-2">:</td>
                        <td class="pt-2"></td>
                    </tr>
                    <tr class="">
                        <td class="pt-2">Harap Kontrol kembali ke</td>
                        <td class="pt-2 px-2">:</td>
                        <td class="pt-2">Poliklinik RSK Bedah Ropanasuri</td>
                    </tr>
                    <tr class="">
                        <td class="pt-2">Pada tanggal</td>
                        <td class="pt-2 px-2">:</td>
                        <td class="pt-2"></td>
                    </tr>
                    <tr class="">
                        <td class="pt-2">Pukul</td>
                        <td class="pt-2 px-2">:</td>
                        <td class="pt-2"></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- end Isi Konten -->

        <!-- Akhir Konten -->
        <div class="row mt-5 justify-content-end">
            <div class="col col-4">
                <p>Padang, .........................2024</p>
                <p>Dokter yang Memeriksa</p>
                <img src="" alt="" />
                <p class="mt-5">----------------------</p>
            </div>
        </div>
        <!-- end Akhir Konten -->
    </div>

    <!-- <div class="page-break"></div> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
