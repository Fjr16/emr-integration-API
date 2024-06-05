<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Retensi Urine</title>
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
                                        Sensasi penuh pada kandung kemih
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
                                        disuria / anuria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault5">
                                    <label class="form-check-label" for="flexCheckDefault5">
                                        distensi kandung kemih
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">
                                        kateter terpasang baik
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
                                    dribbling(urine menetes)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault9">
                                <label class="form-check-label" for="flexCheckDefault9">
                                    ...............
                                </label>
                            </div>

                            <div class="">
                                <p class="fw-bold mb-0">Data Objektif</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault9">
                                    <label class="form-check-label" for="flexCheckDefault9">
                                        Inkontinensia berlebih
                                    </label>
                                </div>
                            </div>
                        </td>

                        <td class="small">
                            <p class="text-center fw-bold mb-3">Retensi Urine</p>
                            <p class="text-center fw-bold mb-0"><i>berhubungan dengan</i></p>
                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault10">
                                    <label class="form-check-label" for="flexCheckDefault10">
                                        peningkatan tekanan uretra
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault11">
                                    <label class="form-check-label" for="flexCheckDefault11">
                                        disfungsi neurologis (mis trauma, penyakit syaraf)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault12">
                                    <label class="form-check-label" for="flexCheckDefault12">
                                        efek agen farmakologis
                                    </label>
                                </div>
                            </div>

                            <p class="text-center fw-bold mt-3 mb-0"><i>dibuktikan dengan</i></p>
                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault13">
                                    <label class="form-check-label" for="flexCheckDefault13">
                                        sensasi penuh pada kandung kemih
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault14">
                                    <label class="form-check-label" for="flexCheckDefault14">
                                        disuria / anuria
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault15">
                                    <label class="form-check-label" for="flexCheckDefault15">
                                        distensi kandung kemih
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault16">
                                    <label class="form-check-label" for="flexCheckDefault16">
                                        dribbling
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault17">
                                    <label class="form-check-label" for="flexCheckDefault17">
                                        inkontinensia berlebih
                                    </label>
                                </div>
                            </div>
                        </td>

                        <td class="small">
                            <p class="mb-0">Setelah dilakukan intervensi keperawatan selama ... jam, maka eliminasi
                                urine membaik,
                                dengan
                                kriteria hasil : </p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault18">
                                <label class="form-check-label" for="flexCheckDefault18">
                                    disuria / anuria menurun
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault19">
                                <label class="form-check-label" for="flexCheckDefault19">
                                    desakan kemih (urgensi) menurun
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault20">
                                <label class="form-check-label" for="flexCheckDefault20">
                                    distensi kandung kemih menurun
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault21">
                                <label class="form-check-label" for="flexCheckDefault21">
                                    berkemih tidak tuntas menurun
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault22">
                                <label class="form-check-label" for="flexCheckDefault22">
                                    urine menetes (dribbling) menurun
                                </label>
                            </div>
                        </td>

                        <td class="small">
                            <p class="fw-bold mb-0">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault23">
                                <label class="form-check-label fw-bold" for="flexCheckDefault23">
                                    Perawatan retensi urine
                                </label>
                            </div>
                            </p>
                            <p class="fw-bold mb-0">Tindakan</p>
                            <p class="fw-bold mb-0">Observasi</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault24">
                                <label class="form-check-label" for="flexCheckDefault24">
                                    identifikasi penyebab retensi urine
                                </label>
                            </div>

                            <p class="fw-bold mt-2 mb-0">Terapeutik</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault25">
                                <label class="form-check-label" for="flexCheckDefault25">
                                    sediakan privasi untuk berkemih
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault26">
                                <label class="form-check-label" for="flexCheckDefault26">
                                    pasang kateter urine jika perlu
                                </label>
                            </div>

                            <p class="fw-bold mt-2 mb-0">Edukasi</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault27">
                                <label class="form-check-label" for="flexCheckDefault27">
                                    ajarkan cara melakukan rangsangan berkemih
                                </label>
                            </div>

                            <p class="fw-bold mb-0 mt-5">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault28">
                                <label class="form-check-label fw-bold" for="flexCheckDefault28">
                                    Perawatan katerer urine
                                </label>
                            </div>
                            </p>
                            <p class="fw-bold mb-0">Tindakan</p>
                            <p class="fw-bold mb-0">Observasi</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault29">
                                <label class="form-check-label" for="flexCheckDefault29">
                                    monitor kepatenan kateter urine
                                </label>
                            </div>

                            <p class="fw-bold mt-2 mb-0">Terapeutik</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault30">
                                <label class="form-check-label" for="flexCheckDefault30">
                                    gunakan teknik aseptik selama perawatan kateter urine
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault31">
                                <label class="form-check-label" for="flexCheckDefault31">
                                    pastikan kantong urine diletakkan dibawah dan tidak dilantai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault32">
                                <label class="form-check-label" for="flexCheckDefault32">
                                    kosongkan kantong urine jika sudah terisi setengahnya
                                </label>
                            </div>

                            <p class="fw-bold mt-2 mb-0">Edukasi</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault33">
                                <label class="form-check-label" for="flexCheckDefault33">
                                    lakukan perawatan perineal (perineal hygiene) min 1 x sehari
                                </label>
                            </div>

                            <p class="fw-bold mt-2 mb-0">Kolaborasi</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault34">
                                <label class="form-check-label" for="flexCheckDefault34">
                                    lepaskan kateter urine jika perlu
                                </label>
                            </div>
                        </td>

                        <td class="small">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault35">
                                <label class="form-check-label" for="flexCheckDefault35">
                                    mengidentifikasi penyebab retensi urine
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault36">
                                <label class="form-check-label" for="flexCheckDefault36">
                                    menyediakan privasi untuk berkemih
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault37">
                                <label class="form-check-label" for="flexCheckDefault37">
                                    mengajarkan cara melakukan rangsangan berkemih
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault38">
                                <label class="form-check-label" for="flexCheckDefault38">
                                    memasang keteter urine (kolaborasi)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault39">
                                <label class="form-check-label" for="flexCheckDefault39">
                                    memberikan edukasi cara mengosongkan kantong urine
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault40">
                                <label class="form-check-label" for="flexCheckDefault40">
                                    memberikan edukasi kantong urine tidak boleh di letakkan di lantai dan tidak boleh
                                    di
                                    atas pinggang
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault41">
                                <label class="form-check-label" for="flexCheckDefault41">
                                    memberikan edukasi siang kateter tidak boleh terlipat
                                </label>
                            </div>

                            <div class="form-check mt-5">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault42">
                                <label class="form-check-label" for="flexCheckDefault42">
                                    memonitoring kepatenan kateter urine
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault43">
                                <label class="form-check-label" for="flexCheckDefault43">
                                    menggunakan teknik asepti selama perawatan kateter urine
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault44">
                                <label class="form-check-label" for="flexCheckDefault44">
                                    memastikan kantong urine di letakkan di bawah dan tidak di lantai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault45">
                                <label class="form-check-label" for="flexCheckDefault45">
                                    mengosongkan kantong urine di letakkan di bawah dan tidak di lantai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault46">
                                <label class="form-check-label" for="flexCheckDefault46">
                                    mengosongkan klantong urine jika sudah terisi setengahnya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault47">
                                <label class="form-check-label" for="flexCheckDefault47">
                                    memberikan edukasi untuk melakukan perineal higlene
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="flexCheckDefault48">
                                <label class="form-check-label" for="flexCheckDefault48">
                                    melakukan kolaborasi untuk melepaskan kateter
                                </label>
                            </div>
                        </td>

                        <td class="small">
                            <div class="">
                                <p class="fw-bold mb-0">Retensi Urine</p>
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

                            <div class="" style="margin-top: 140px">
                                <p class="fw-bold mb-0">Retensi Urine</p>
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
