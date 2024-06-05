<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Gangguan Mobilitas Fisik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #fafafa;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 29.7cm;
            /* height: 21cm; */
            height: auto;
            min-height: 13.97cm;
            padding: 15mm;
            margin: 10mm auto;
            border: 1px #d3d3d3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 257mm;
            outline: 2cm #ffeaea solid;
        }

        td {
            padding-top: 5px;
            vertical-align: top;
        }

        th {
            font-size: 10pt !important;
            vertical-align: top;
        }

        .borderhr {
            color: black;
            background-color: black;
            border-color: black;
            height: 5px;
            opacity: 100;
        }

        /* .header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 10mm;
            background: white;
        } */

        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }

        /* .page-break {
            page-break-before: always;
        } */

        .bg-gray {
            background-color: #d3d3d3
        }

        @page {
            size: landscape;
            /* margin: 15mm; */
        }

        @media print {

            *,
            *:before,
            *:after {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            html,
            body {
                width: 29.7cm;
                height: 21.59cm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
                /* padding-top: 20mm; */
            }

            thead {
                display: table-header-group;
            }

            /* tr,
            td,
            th {
                page-break-inside: avoid;
            } */
        }
    </style>
</head>

<body>
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="page">
        <div class="header">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-7 text-center">
                    <h1 class="pt-2">ASUHAN KEPERAWATAN PASIEN INSTALASI RAWAT JALAN</h1>
                </div>
                <div class="col-3">
                    <div class="border border-3 border-rounded py-4 px-5">
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card-header m-0">
            <h5 class="mb-0 m-0">Asesmen Perawat {{ $item->patient->no_rm }}</h5>
        </div> --}}
        <div class="mt-2">
            <div class="d-flex flex-row">
                <span class="small px-5">Tanggal : ......</span>
            </div>

            <table class="table-bordered">
                <thead>
                    <tr class="fw-bold text-center bg-gray">
                        <td>Data</td>
                        <td>Diagnosis Keperawatan</td>
                        <td>Luaran</td>
                        <td>Intervensi</td>
                        <td>Implementasi</td>
                        <td>Evaluasi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="small">
                            <div class="bg-gray">
                                <span class="fw-bold">Tanda & Gejala Mayor</span>
                            </div>

                            <div class="">
                                <p class="fw-bold mb-0">Data Subjektif</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault1">
                                    <label class="form-check-label" for="flexCheckDefault1">
                                        Mengeluh sulit menggerakkan ekstremitas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault2">
                                    <label class="form-check-label" for="flexCheckDefault2">
                                        ..............
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault3">
                                    <label class="form-check-label" for="flexCheckDefault3">
                                        ..............
                                    </label>
                                </div>
                            </div>

                            <div class="mt-3">
                                <p class="fw-bold mb-0">Data Objektif</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault4">
                                    <label class="form-check-label" for="flexCheckDefault4">
                                        Kekuatan Otot Menurun
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault5">
                                    <label class="form-check-label" for="flexCheckDefault5">
                                        Rentang Gerak (ROM) menurun
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">
                                        ..............
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault7">
                                    <label class="form-check-label" for="flexCheckDefault7">
                                        ..............
                                    </label>
                                </div>
                            </div>

                            <div class="bg-gray mt-3">
                                <span class="fw-bold">Tanda & Gejala Minor</span>
                            </div>

                            <p class="fw-bold mb-0">Data Subjektif</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault8">
                                <label class="form-check-label" for="flexCheckDefault8">
                                    Nyeri Saat Bergerak
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault9">
                                <label class="form-check-label" for="flexCheckDefault9">
                                    Enggan Melakukan Pergerakan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault100">
                                <label class="form-check-label" for="flexCheckDefault100">
                                    Merasa Cemas Saat Bergerak
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault101">
                                <label class="form-check-label" for="flexCheckDefault101">
                                    ................
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault102">
                                <label class="form-check-label" for="flexCheckDefault102">
                                    ................
                                </label>
                            </div>

                            <div class="">
                                <p class="fw-bold mb-0">Data Objektif</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault103">
                                    <label class="form-check-label" for="flexCheckDefault103">
                                        Gerakan terbatas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault104">
                                    <label class="form-check-label" for="flexCheckDefault104">
                                        Fisik Lemah
                                    </label>
                                </div>
                            </div>
                        </td>

                        <td class="small">
                            <p class="text-center fw-bold mb-3">Gangguan Mobilitas Fisik</p>
                            <p class="text-center fw-bold mb-0"><i>berhubungan dengan</i></p>
                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault10">
                                    <label class="form-check-label" for="flexCheckDefault10">
                                        Kerusakan integritas struktur tulang
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault11">
                                    <label class="form-check-label" for="flexCheckDefault11">
                                        Kontraktur
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault12">
                                    <label class="form-check-label" for="flexCheckDefault12">
                                        Penurunan Kekuatan Otot
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault105">
                                    <label class="form-check-label" for="flexCheckDefault105">
                                        Kekakuan Sendi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault106">
                                    <label class="form-check-label" for="flexCheckDefault106">
                                        Program pembatasan gerak
                                    </label>
                                </div>
                            </div>

                            <p class="text-center fw-bold mt-3 mb-0"><i>dibuktikan dengan</i></p>
                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault13">
                                    <label class="form-check-label" for="flexCheckDefault13">
                                        Mengeluh sulit menggerakkan ekstremitas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault14">
                                    <label class="form-check-label" for="flexCheckDefault14">
                                        Kekuatan otot menurun
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault15">
                                    <label class="form-check-label" for="flexCheckDefault15">
                                        Rentang Gerak (ROM) menurun
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault16">
                                    <label class="form-check-label" for="flexCheckDefault16">
                                        Nyeri saat bergerak
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault17">
                                    <label class="form-check-label" for="flexCheckDefault17">
                                        Sendi Kaku
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault107">
                                    <label class="form-check-label" for="flexCheckDefault107">
                                        Gerakan terbatas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault108">
                                    <label class="form-check-label" for="flexCheckDefault108">
                                        Fisik Lemah
                                    </label>
                                </div>
                            </div>
                        </td>

                        <td class="small">
                            <p class="mb-0">Setelah dilakukan intervensi keperawatan selama ... jam, mobilitas fisik,
                                dengan
                                kriteria hasil : </p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault18">
                                <label class="form-check-label" for="flexCheckDefault18">
                                    Pergerakan ekstriminitas meningkat
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault19">
                                <label class="form-check-label" for="flexCheckDefault19">
                                    Kekuatan otot meningkat
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault20">
                                <label class="form-check-label" for="flexCheckDefault20">
                                    Rentang gerak (ROM) meningkat
                                </label>
                            </div>
                        </td>

                        <td class="small">
                            <p class="fw-bold mb-0">Dukungan Mobilisasi</p>
                            <p class="fw-bold mb-0">Tindakan</p>
                            <p class="fw-bold mb-0">Observasi</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault24">
                                <label class="form-check-label" for="flexCheckDefault24">
                                    Identifikasi adanya nyeri atau keluhan fisik lainnya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault109">
                                <label class="form-check-label" for="flexCheckDefault109">
                                    Identifikasi toleransi fisik melakukan pergerakan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault110">
                                <label class="form-check-label" for="flexCheckDefault110">
                                    Monitor Kondisi umum selama melakukan mobilisasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault111">
                                <label class="form-check-label" for="flexCheckDefault111">
                                    ...................
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault112">
                                <label class="form-check-label" for="flexCheckDefault112">
                                    ...................
                                </label>
                            </div>

                            <p class="fw-bold mt-2 mb-0">Terapeutik</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault25">
                                <label class="form-check-label" for="flexCheckDefault25">
                                    Fasilitasi aktifitas mobilisasi dengan alat bantu (kruk, walker, dll)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault26">
                                <label class="form-check-label" for="flexCheckDefault26">
                                    Fasilitasi melakukan pergerakan jika perlu
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault113">
                                <label class="form-check-label" for="flexCheckDefault113">
                                    Libatkan keluaga untuk membantu pasien dalam pergerakan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault114">
                                <label class="form-check-label" for="flexCheckDefault114">
                                    ...................
                                </label>
                            </div>

                            <p class="fw-bold mt-2 mb-0">Edukasi</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault27">
                                <label class="form-check-label" for="flexCheckDefault27">
                                    Jelaskan tujuan dan prosedur mobilisasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault115">
                                <label class="form-check-label" for="flexCheckDefault115">
                                    Ajarkan mobilisasi sederhana
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault116">
                                <label class="form-check-label" for="flexCheckDefault116">
                                    ...................
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault117">
                                <label class="form-check-label" for="flexCheckDefault117">
                                    ...................
                                </label>
                            </div>
                        </td>

                        <td class="small">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault35">
                                <label class="form-check-label" for="flexCheckDefault35">
                                    Memonitoring keadaan umum pasien
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault36">
                                <label class="form-check-label" for="flexCheckDefault36">
                                    Mengidentifikasi keluhan fisik lainnya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault37">
                                <label class="form-check-label" for="flexCheckDefault37">
                                    Mengidentifikasi toleransi fisik melakukan pergerakan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault38">
                                <label class="form-check-label" for="flexCheckDefault38">
                                    Memfasilitasi alat bantu yang di perlukan untuk mobilisasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault39">
                                <label class="form-check-label" for="flexCheckDefault39">
                                    Melibatkan keluarga dalam membantu mobilisasi
                                </label>
                            </div>
                        </td>

                        <td class="small">
                            <div class="">
                                <p class="fw-bold mb-0">Gangguan Mobilitas Fisik</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault39">
                                    <label class="form-check-label" for="flexCheckDefault39">
                                        Teratasi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault40">
                                    <label class="form-check-label" for="flexCheckDefault40">
                                        Teratasi Sebagian
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault41">
                                    <label class="form-check-label" for="flexCheckDefault41">
                                        Belum Teratasi
                                    </label>
                                </div>

                                <p class="fw-bold mt-5 text-center">Tanda Tangan & Nama Jelas</p>
                                <p class="text-center"></p>
                                <p class="mt-5 text-center">(....................................)</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="page-break"></div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>
