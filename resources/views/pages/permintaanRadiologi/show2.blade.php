<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ROPANASURI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

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
            width: 210mm;
            height: auto;
            min-height: 13.97cm;
            padding: 13mm;
            padding-top: 35px;
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

        tr th {
            font-size: 10pt;
        }

        tr td {
            font-size: 10pt;
        }

        /* td {
                padding-top: 5px;
            } */
        th {
            font-size: 10pt !important;
        }

        ol li {
            margin: none;
            margin-top: 0px;
        }

        .borderhr {
            color: black;
            background-color: black;
            border-color: black;
            height: 5px;
            opacity: 100;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }

        td {
            padding-top: 5px;
            vertical-align: top;
        }

        input[type="checkbox"] {
            pointer-events: none;
        }

        input[type="radio"] {
            pointer-events: none;
        }

        @page {
            size: A4;
            margin: 10mm;
        }

        @media print {

            html,
            body {
                width: 215mm;
                height: 330mm;
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
            }

            .print-footer {
                /* position: fixed; */
                bottom: 0mm;
                right: 10mm;
                width: 100%;
                text-align: right;
            }
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="header">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-7 d-flex align-self-center">
                    <h1 class="mx-auto text-uppercase text-center ">FORMULIR PERMINTAAN RADIOLOGI</h1>
                </div>
                {{-- <div class="col-3">
                    <div class="border border-3 border-rounded py-4 px-5"></div>
                </div> --}}
            </div>
        </div>

        <div class="content">
            <table class="table-bordered w-100 mt-3">
                <tr>
                    <!-- kiri -->
                    <td class="w-50">
                        <table class="mx-3">
                            <tr>
                                <td>Nama Pasien</td>
                                <td>: {{ $itemRadiologi->patient->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Tgl lahir</td>
                                <td>: {{ $itemRadiologi->patient->tanggal_lhr ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>No. RM</td>
                                <td>:
                                    {{ implode('-', str_split(str_pad($itemRadiologi->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                </td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>: {{ $itemRadiologi->patient->nik ?? '' }}</td>
                            </tr>
                        </table>
                    </td>

                    <!-- kanan -->
                    <td class="w-50">
                        <table class="mx-3">
                            <tr>
                                <td>Tanggungan</td>
                                <td>: {{ $itemQueue->patientCategory->name ?? '' }}</td>
                                {{-- <td>: Umum / BPJS / Perusahaan</td> --}}
                            </tr>
                            <tr>
                                <td>Asal Ruangan</td>
                                <td>: {{ $itemRadiologi->roomDetail->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Diagnosa Klinis</td>
                                <td>: {{ strip_tags($itemRadiologi->diagnosa_klinis) ?? '' }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <p class="m-0 mt-3 small fst-italic">*Pemeriksaan yang diminta harapan diberi tanda ceklis
                (&check;) dan keterangan
                seperlunya
            </p>


            <table class="table-bordered w-100">
                <tr class=" ">
                    <td colspan="3" class="fw-bolder text-center">X-RAY</td>
                </tr>
                <tbody>
                    <tr class="text-center fw-bolder">
                        <td>
                            EXSTREMITAS ATAS
                        </td>
                        <td>
                            EXSTREMITAS BAWAH
                        </td>
                        <td>
                            LAIN-LAIN
                        </td>
                    </tr>

                    <tr>
                        <!-- ekstremitasi atas-->
                        <td class="px-1">
                            <table class="w-100">
                                <tr>
                                    <td>
                                        {{-- Clavicula --}}
                                        <div class="mt-2 mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" value="Clavicula"
                                                        name="Clavicula">
                                                    <label class="form-check-label ms-2">
                                                        Clavicula
                                                    </label>
                                                </div>
                                                <div class="ms-2 d-flex flex-row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Clavicula-Radio" value="Dextra">
                                                        <label class="form-check-label">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Clavicula-Radio" value="Sinitra">
                                                        <label class="form-check-label">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Clavicula --}}

                                        {{-- Shoulder --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" id="Shoulder"
                                                        value="Shoulder" name="Shoulder">
                                                    <label class="form-check-label ms-2">
                                                        Shoulder
                                                    </label>
                                                </div>
                                                <div class="ms-2 d-flex flex-row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Shoulder-Radio" value="Dextra">
                                                        <label class="form-check-label">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Shoulder-Radio" value="Sinitra">
                                                        <label class="form-check-label">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Shoulder --}}

                                        {{-- Humerus --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" id="Humerus"
                                                        value="Humerus" name="Humerus">
                                                    <label class="form-check-label ms-2">
                                                        Humerus
                                                    </label>
                                                </div>
                                                <div class="ms-2 d-flex flex-row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Humerus-Radio" value="Dextra">
                                                        <label class="form-check-label">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Humerus-Radio" value="Sinitra">
                                                        <label class="form-check-label">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Humerus --}}

                                        {{-- Elbow Joint --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" id="Elbow Joint"
                                                        value="Elbow Joint" name="Elbow-Joint">
                                                    <label class="form-check-label ms-2">
                                                        Elbow Joint
                                                    </label>
                                                </div>
                                                <div class="ms-1 d-flex flex-row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Elbow-Joint-Radio" value="Dextra">
                                                        <label class="form-check-label">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Elbow-Joint-Radio" value="Sinitra">
                                                        <label class="form-check-label">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Elbow Joint --}}

                                        {{-- Antebrachii --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" id="Antebrachii"
                                                        value="Antebrachii" name="Antebrachii">
                                                    <label class="form-check-label ms-2">
                                                        Antebrachii
                                                    </label>
                                                </div>
                                                <div class="ms-1 d-flex flex-row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Antebrachii-Radio" value="Dextra">
                                                        <label class="form-check-label">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Antebrachii-Radio" value="Sinitra">
                                                        <label class="form-check-label">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Antebrachii --}}

                                        {{-- Wrist Joint --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" id="Wrist Joint"
                                                        value="Wrist Joint" name="Wrist-Joint">
                                                    <label class="form-check-label ms-2">
                                                        Wrist Joint
                                                    </label>
                                                </div>
                                                <div class="ms-1 d-flex flex-row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Wrist-Joint-Radio" value="Dextra">
                                                        <label class="form-check-label">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Wrist-Joint-Radio" value="Sinitra">
                                                        <label class="form-check-label">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Wrist Joint --}}

                                        {{-- Manus --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" id="Manus"
                                                        value="Manus" name="Manus">
                                                    <label class="form-check-label ms-2">
                                                        Manus
                                                    </label>
                                                </div>
                                                <div class="ms-2 d-flex flex-row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Manus-Radio" value="Dextra">
                                                        <label class="form-check-label">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Manus-Radio" value="Sinitra">
                                                        <label class="form-check-label">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Manus --}}

                                        {{-- Lainnya --}}
                                        @foreach ($itemRadiologi->newEkstremitasAtas as $atas)
                                            @if (is_null($atas['value']))
                                                <div class="mb-0">
                                                    <div class="d-flex flex-row">
                                                        <div class="form-check d-flex">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Lainnya" value="Lainnya" name="Lainnya"
                                                                checked>
                                                            <label class="form-check-label ms-2">
                                                                {{ $atas->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        {{-- end Lainnya --}}
                                    </td>
                                </tr>
                            </table>
                            <!-- end looping  -->
                        </td>

                        <!-- ekstremitasi bawah -->
                        <td class="px-1">
                            <table class="w-100">
                                <tr>
                                    <td>
                                        {{-- Femur --}}
                                        <div class="mt-2 mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" id="Femur"
                                                        value="Femur" name="Femur">
                                                    <label class="form-check-label ms-2">
                                                        Femur
                                                    </label>
                                                </div>
                                                <div class="ms-2 d-flex flex-row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Femur-Radio" value="Dextra">
                                                        <label class="form-check-label">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Femur-Radio" value="Sinitra">
                                                        <label class="form-check-label">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Femur --}}

                                        {{-- Genu --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" id="Genu"
                                                        value="Genu" name="Genu">
                                                    <label class="form-check-label ms-2">
                                                        Genu
                                                    </label>
                                                </div>
                                                <div class="ms-2 d-flex flex-row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Genu-Radio" value="Dextra">
                                                        <label class="form-check-label">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Genu-Radio" value="Sinitra">
                                                        <label class="form-check-label">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Genu --}}

                                        {{-- Cruris --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" id="Cruris"
                                                        value="Cruris" name="Cruris">
                                                    <label class="form-check-label ms-2">
                                                        Cruris
                                                    </label>
                                                </div>
                                                <div class="ms-2 d-flex flex-row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Cruris-Radio" value="Dextra">
                                                        <label class="form-check-label">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Cruris-Radio" value="Sinitra">
                                                        <label class="form-check-label">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Cruris --}}

                                        {{-- Ankle Joint --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input col-1" type="checkbox"
                                                        id="Ankle Joint" value="Ankle Joint" name="Ankle-Joint">
                                                    <label class="form-check-label ms-2">
                                                        Ankle Joint
                                                    </label>
                                                </div>
                                                <div class="d-flex flex-row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Ankle-Joint-Radio" value="Dextra">
                                                        <label class="form-check-label">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Ankle-Joint-Radio" value="Sinitra">
                                                        <label class="form-check-label">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Ankle Joint --}}

                                        {{-- Calcaneus --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" id="Calcaneus"
                                                        value="Calcaneus" name="Calcaneus">
                                                    <label class="form-check-label ms-2">
                                                        Calcaneus
                                                    </label>
                                                </div>
                                                <div class="ms-2 d-flex flex-row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Calcaneus-Radio" value="Dextra">
                                                        <label class="form-check-label">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Calcaneus-Radio" value="Sinitra">
                                                        <label class="form-check-label">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Calcaneus --}}

                                        {{-- Pedis --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" id="Pedis"
                                                        value="Pedis" name="Pedis">
                                                    <label class="form-check-label ms-2">
                                                        Pedis
                                                    </label>
                                                </div>
                                                <div class="ms-2 d-flex flex-row">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Pedis-Radio" value="Dextra">
                                                        <label class="form-check-label">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Pedis-Radio" value="Sinitra">
                                                        <label class="form-check-label">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Pedis --}}

                                        {{-- Lainnya --}}
                                        @foreach ($itemRadiologi->newEkstremitasBawah as $bawah)
                                            @if (is_null($bawah['value']))
                                                <div class="mb-0">
                                                    <div class="d-flex flex-row">
                                                        <div class="form-check d-flex">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Lainnya" value="Lainnya" name="Lainnya"
                                                                checked>
                                                            <label class="form-check-label ms-2">
                                                                {{ $bawah->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        {{-- end Lainnya --}}
                                    </td>
                                </tr>
                            </table>
                            <!-- end looping  -->
                        </td>

                        <!-- LAIN LAIN -->
                        <td class="px-1">
                            <table class="w-100">
                                <tr>
                                    <td>
                                        {{-- Thorax --}}
                                        <div class="mt-2 mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" value="Thorax"
                                                        name="Thorax">
                                                    <label class="form-check-label ms-2">
                                                        Thorax
                                                    </label>
                                                </div>
                                                <div class="ms-1">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Thorax-Radio" value="AP">
                                                        <label class="form-check-label" for="Thorax1">AP</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Thorax-Radio" value="PA">
                                                        <label class="form-check-label" for="Thorax2">PA</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Thorax-Radio" value="Lat">
                                                        <label class="form-check-label" for="Thorax3">Lat</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Thorax-Radio" value="Top Lordotik">
                                                        <label class="form-check-label" for="Thorax4">Top
                                                            Lordotik</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Thorax --}}

                                        {{-- Foto Polos Abdomen --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="Foto Polos Abdomen" name="Foto-Polos-Abdomen">
                                                    <label class="form-check-label ms-2">
                                                        Foto Polos Abdomen
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Foto Polos Abdomen --}}

                                        {{-- Abdomen --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" value="Abdomen"
                                                        name="Abdomen">
                                                    <label class="form-check-label ms-2"> Abdomen </label>
                                                </div>
                                                <div class="ms-2">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Abdomen-Radio" value="2 Posisi">
                                                        <label class="form-check-label">2
                                                            Posisi</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Abdomen-Radio" value="3 Posisi">
                                                        <label class="form-check-label">3
                                                            Posisi</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Abdomen --}}

                                        {{-- Pelvic --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" value="Pelvic"
                                                        name="Pelvic">
                                                    <label class="form-check-label ms-2">
                                                        Pelvic
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Pelvic --}}

                                        {{-- Schedel --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" value="Schedel"
                                                        name="Schedel">
                                                    <label class="form-check-label ms-2">
                                                        Schedel
                                                    </label>
                                                </div>
                                                <div class="ms-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Schedel-Radio" value="Cranial AP">
                                                        <label class="form-check-label">Cranial
                                                            AP</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Schedel-Radio" value="Lat">
                                                        <label class="form-check-label">Lat</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Schedel --}}

                                        {{-- Waters --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" value="Waters"
                                                        name="Waters">
                                                    <label class="form-check-label ms-2">
                                                        Waters
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Waters --}}

                                        {{-- SPN 2 Posisi --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="SPN 2 Posisi" name="SPN-2-Posisi">
                                                    <label class="form-check-label ms-2">
                                                        SPN 2 Posisi
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Vertebrae Cervical --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input col-1" type="checkbox"
                                                        id="Vertebrae Cervical" value="Vertebrae Cervical"
                                                        name="Vertebrae-Cervical">
                                                    <label class="form-check-label ms-2">
                                                        Vertebrae Cervical
                                                    </label>
                                                </div>
                                                <div class="ms-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Vertebrae-Cervical-Radio" value="AP">
                                                        <label class="form-check-label">
                                                            AP
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Vertebrae-Cervical-Radio" value="Lat">
                                                        <label class="form-check-label">
                                                            Lat
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Vertebrae-Cervical-Radio" value="3 posisi">
                                                        <label class="form-check-label">
                                                            3 posisi
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Vertebrae Cervical --}}

                                        {{-- Vertebrae Thoracal --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input col-1" type="checkbox"
                                                        id="Vertebrae Thoracal" value="Vertebrae Thoracal"
                                                        name="Vertebrae-Thoracal">
                                                    <label class="form-check-label ms-2">
                                                        Vertebrae Thoracal
                                                    </label>
                                                </div>
                                                <div class="ms-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Vertebrae-Thoracal-Radio" value="AP">
                                                        <label class="form-check-label">
                                                            AP
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="Vertebrae-Thoracal-Radio" value="Lat">
                                                        <label class="form-check-label">
                                                            Lat
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Vertebrae Thoracal --}}

                                        {{-- Vertebrae Thoracolumbal --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="Vertebrae Thoracolumbal"
                                                        name="Vertebrae-Thoracolumbal">
                                                    <label class="form-check-label ms-2">
                                                        Vertebrae Thoracolumbal
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Vertebrae Thoracolumbal --}}

                                        {{-- Vertebrae Lumbosacral --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="Vertebrae Lumbosacral" name="Vertebrae-Lumbosacral">
                                                    <label class="form-check-label ms-2">
                                                        Vertebrae Lumbosacral
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Vertebrae Lumbosacral --}}

                                        {{-- Sacrum --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" value="Sacrum"
                                                        name="Sacrum">
                                                    <label class="form-check-label ms-2">
                                                        Sacrum
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Sacrum --}}

                                        {{-- Coccygeus --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" value="Coccygeus"
                                                        name="Coccygeus">
                                                    <label class="form-check-label ms-2">
                                                        Coccygeus
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Coccygeus --}}

                                        {{-- Mastoid --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" value="Mastoid"
                                                        name="Mastoid">
                                                    <label class="form-check-label ms-2">
                                                        Mastoid
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Mastoid --}}

                                        {{-- TMJ --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" value="TMJ"
                                                        name="TMJ">
                                                    <label class="form-check-label ms-2">
                                                        TMJ
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end TMJ --}}

                                        {{-- Nasal --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" value="Nasal"
                                                        name="Nasal">
                                                    <label class="form-check-label ms-2">
                                                        Nasal
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Nasal --}}

                                        {{-- Maxila --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" value="Maxila"
                                                        name="Maxila">
                                                    <label class="form-check-label ms-2">
                                                        Maxila
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Maxila --}}

                                        {{-- Mandibula --}}
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" value="Mandibula"
                                                        name="Mandibula">
                                                    <label class="form-check-label ms-2">
                                                        Mandibula
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end Mandibula --}}

                                        {{-- Lainnya --}}
                                        @php
                                            $excludeList = [
                                                'Thorax',
                                                'Foto Polos Abdomen',
                                                'Abdomen',
                                                'Pelvic',
                                                'Schedel',
                                                'Waters',
                                                'SPN 2 Posisi',
                                                'Vertebrae Cervical',
                                                'Vertebrae Thoracal',
                                                'Vertebrae Thoracolumbal',
                                                'Vertebrae Lumbosacral',
                                                'Sacrum',
                                                'Coccygeus',
                                                'Mastoid',
                                                'TMJ',
                                                'Nasal',
                                                'Maxila',
                                                'Mandibula',
                                            ];
                                        @endphp
                                        @foreach ($itemRadiologi->newLainLain as $lainLain)
                                            @if (is_null($lainLain['value']) && !in_array($lainLain['name'], $excludeList))
                                                <div class="mb-0">
                                                    <div class="d-flex flex-row">
                                                        <div class="form-check d-flex">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Lainnya" value="Lainnya" name="Lainnya"
                                                                checked>
                                                            <label class="form-check-label ms-2">
                                                                {{ $lainLain->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                        {{-- end Lainnya --}}
                                    </td>
                                </tr>
                            </table>
                            <!-- end looping  -->
                        </td>
                    </tr>
                </tbody>
            </table>


            <table class="table-bordered w-100 mt-2">
                <tbody>
                    <tr>
                        <td class="text-center">USG</td>
                        <td class="text-center">KONTRAS*</td>
                    </tr>


                    <tr>
                        <td rowspan="3" class="px-1" style="max-width: 150px">
                            <div class="d-flex flex-column">
                                {{-- Leher / Thyroid --}}
                                <div class="mt-2 mb-0">
                                    <div class="d-flex flex-row">
                                        {{-- <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Leher/Thyroid"
                                                    value="Leher/Thyroid" name="Leher/Thyroid"
                                                    onchange="toggleRadioVisibility(this, 'Leher/Thyroid-Radio')">
                                                <label class="form-check-label ms-2" for="Leher/Thyroid">
                                                Leher/Thyroid
                                            </label>
                                            </div> --}}
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Leher/Thyroid-Radio" value="Leher">
                                                <label class="form-check-label">Leher</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Leher/Thyroid-Radio" value="Thyroid">
                                                <label class="form-check-label">Thyroid</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end Leher / Thyroid --}}

                                {{-- Mammae --}}
                                <div class="mb-0">
                                    <div class="d-flex flex-row">
                                        <div class="form-check d-flex">
                                            <input class="form-check-input" type="checkbox" value="Mammae"
                                                name="Mammae">
                                            <label class="form-check-label ms-2">
                                                Mammae
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- end Mammae --}}

                                {{-- Abdomen Atas --}}
                                <div class="mb-0">
                                    <div class="d-flex flex-row">
                                        <div class="form-check d-flex">
                                            <input class="form-check-input" type="checkbox" value="Abdomen Atas"
                                                name="Abdomen-Atas">
                                            <label class="form-check-label ms-2">
                                                Abdomen Atas
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- end Abdomen Atas --}}

                                {{-- Abdomen Bawah / Pelvis --}}
                                <div class="mb-0">
                                    <div class="d-flex flex-row">
                                        <div class="form-check d-flex">
                                            <input class="form-check-input" type="checkbox" value="Abdomen"
                                                name="Abdomen-2">
                                            <label class="form-check-label ms-2">
                                                Abdomen
                                            </label>
                                        </div>
                                        <div class="ms-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="Abdomen-2-Radio"
                                                    value="Bawah">
                                                <label class="form-check-label">Bawah</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="Abdomen-2-Radio"
                                                    value="Pelvis">
                                                <label class="form-check-label">Pelvis</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end Abdomen Bawah / Pelvis --}}

                                {{-- Urologi --}}
                                <div class="mb-0">
                                    <div class="d-flex flex-row">
                                        <div class="form-check d-flex">
                                            <input class="form-check-input" type="checkbox" value="Urologi"
                                                name="Urologi">
                                            <label class="form-check-label ms-2">
                                                Urologi
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- end Urologi --}}

                                {{-- Prostat --}}
                                <div class="mb-0">
                                    <div class="d-flex flex-row">
                                        <div class="form-check d-flex">
                                            <input class="form-check-input" type="checkbox" value="Prostat"
                                                name="Prostat">
                                            <label class="form-check-label ms-2">
                                                Prostat
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- end Prostat --}}

                                {{-- Testis --}}
                                <div class="mb-0">
                                    <div class="d-flex flex-row">
                                        <div class="form-check d-flex">
                                            <input class="form-check-input" type="checkbox" value="Testis"
                                                name="Testis">
                                            <label class="form-check-label ms-2">
                                                Testis
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- end Testis --}}

                                {{-- Testis-Dople --}}
                                <div class="mb-0">
                                    <div class="d-flex flex-row">
                                        <div class="form-check d-flex">
                                            <input class="form-check-input" type="checkbox" value="Testis Dople"
                                                name="Testis-Dople">
                                            <label class="form-check-label ms-2">
                                                Testis-Dople
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- end Testis-Dople --}}

                                {{-- Lainnya --}}
                                @php
                                    $excludeListUsg = [
                                        'Mammae',
                                        'Abdomen Atas',
                                        'Abdomen',
                                        'Urologi',
                                        'Prostat',
                                        'Testis',
                                        'Testis Dople',
                                        'Leher',
                                        'Thyroid',
                                    ];
                                @endphp
                                @foreach ($itemRadiologi->newUsg as $Usg)
                                    @if (is_null($Usg['value']) && !in_array($Usg['name'], $excludeListUsg))
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" id="Lainnya"
                                                        value="Lainnya" name="Lainnya" checked>
                                                    <label class="form-check-label ms-2">
                                                        {{ $Usg->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                {{-- end Lainnya --}}
                            </div>
                        </td>
                        <td class="px-1">
                            <div class="form-check d-flex flex-column">
                                {{-- Appendicogram --}}
                                <div class="mt-2 mb-0">
                                    <div class="d-flex flex-row">
                                        <div class="form-check d-flex">
                                            <input class="form-check-input" type="checkbox" id="Appendicogram"
                                                value="Appendicogram" name="Appendicogram">
                                            <label class="form-check-label ms-2">
                                                Appendicogram
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- end Appendicogram --}}

                                {{-- Cystography --}}
                                <div class="mb-0">
                                    <div class="d-flex flex-row">
                                        <div class="form-check d-flex">
                                            <input class="form-check-input" type="checkbox" id="Cystography"
                                                value="Cystography" name="Cystography">
                                            <label class="form-check-label ms-2">
                                                Cystography
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- end Cystography --}}
                                {{-- BNO / IVP --}}
                                <div class="mb-0">
                                    <div class="d-flex flex-row">
                                        {{-- <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="BNO/IVP"
                                                    value="BNO/IVP" name="BNO/IVP"
                                                    onchange="toggleRadioVisibility(this, 'BNO/IVP-Radio')">
                                                <label class="form-check-label ms-2" for="BNO/IVP">
                                                BNO/IVP
                                            </label>
                                            </div> --}}
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="BNO/IVP-Radio"
                                                    value="BNO">
                                                <label class="form-check-label">BNO</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="BNO/IVP-Radio"
                                                    value="IVP">
                                                <label class="form-check-label">IVP</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end BNO / IVP --}}

                                {{-- Lainnya --}}
                                @php
                                    $excludeListKontras = ['Appendicogram', 'Cystography', 'BNO', 'IVP'];
                                @endphp
                                @foreach ($itemRadiologi->newKontras as $Kontras)
                                    @if (is_null($Kontras['value']) && !in_array($Kontras['name'], $excludeListKontras))
                                        <div class="mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <input class="form-check-input" type="checkbox" id="Lainnya"
                                                        value="Lainnya" name="Lainnya" checked>
                                                    <label class="form-check-label ms-2">
                                                        {{ $Kontras->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                {{-- end Lainnya --}}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-uppercase text-center  ">Pemeriksaan lainnya
                        </td>
                    </tr>
                    <tr>
                        <td class="px-1">
                            <table>
                                <tr>
                                    <td>
                                        {{-- CT-Scan --}}
                                        <div class="mt-2 mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <div class="">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="CT-Scan" name="CT-Scan"
                                                            onchange="toggleTextInput(this, 'CT-Scan-value')">
                                                        <label class="form-check-label" for="CT-Scan">
                                                            CT-Scan :
                                                        </label>
                                                    </div>
                                                    <div class="ms-2">
                                                        <div id="CT-Scan-value"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end CT-Scan --}}

                                        {{-- MRI --}}
                                        <div class="mt-2 mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex">
                                                    <div class="">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="MRI" name="MRI"
                                                            onchange="toggleTextInput(this, 'MRI-value')">
                                                        <label class="form-check-label" for="MRI">
                                                            MRI :
                                                        </label>
                                                    </div>
                                                    <div class="ms-2">
                                                        <div id="MRI-value"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- end MRI --}}

                                        {{-- Lainnya --}}
                                        @php
                                            $excludeListPemeriksaLainnya = ['CT-Scan', 'MRI'];
                                        @endphp
                                        @foreach ($itemRadiologi->newPemeriksaanLainnya as $PemeriksaanLainnya)
                                            @if (is_null($PemeriksaanLainnya['value']) && !in_array($PemeriksaanLainnya['name'], $excludeListPemeriksaLainnya))
                                                <div class="mb-0">
                                                    <div class="d-flex flex-row">
                                                        <div class="form-check d-flex">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Lainnya" value="Lainnya" name="Lainnya"
                                                                checked>
                                                            <label class="form-check-label ms-2">
                                                                {{ $PemeriksaanLainnya->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        {{-- end Lainnya --}}
                                    </td>
                                </tr>
                            </table>
                            <!-- end looping  -->
                        </td>
                    </tr>
                </tbody>
            </table>


            <div class="row">
                <div class="col-6" style="font-size: 3mm;">
                    <p class="fst-italic">*) Dijadwalkan dan dipersiapkan oleh Petugas Radiologi</p>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column justify-content-end small mt-5">
                        <p class="text-center mb-0">Padang,
                            {{ $itemRadiologi->created_at->format('d F Y') }}
                        </p>
                        <p class="text-center mb-0">Dokter yang Meminta</p>
                        <img src="{{ Storage::url($itemRadiologi->ttd_dokter) }}" alt="">
                        <p class="text-center">( {{ $itemRadiologi->user->name ?? '' }} )</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-end mt-4 print-footer">
            <p class="small"><span class="border border-dark">RM 26.RI.RS.REV-1</span></p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function processData(data) {
                data.forEach(function(item) {
                    // Handle Checkbox
                    let checkboxSelector = 'input[name="' + item.name.replace(/\s+/g, '-') + '"]';
                    let checkbox = document.querySelector(checkboxSelector);
                    if (checkbox) {
                        checkbox.checked = true;
                        // If the checkbox is for CT-Scan, display its value
                        if (checkbox.name === "CT-Scan") {
                            document.getElementById('CT-Scan-value').textContent = item.value;
                        }

                        if (checkbox.name === "MRI") {
                            document.getElementById('MRI-value').textContent = item.value;
                        }
                    }

                    // Handle Radio
                    if (item.hasOwnProperty('value')) {
                        let radioSelector = 'input[name="' + item.name.replace(/\s+/g, '-') +
                            '-Radio"][value="' + item.value + '"]';
                        let radio = document.querySelector(radioSelector);
                        if (radio) {
                            radio.checked = true;
                        }
                    }
                });
            }


            var ekstremitasAtasData = {!! json_encode($itemRadiologi->newEkstremitasAtas) !!};
            var ekstremitasBawahData = {!! json_encode($itemRadiologi->newEkstremitasBawah) !!};
            var lainLain = {!! json_encode($itemRadiologi->newLainLain) !!};
            var usg = {!! json_encode($itemRadiologi->newUsg) !!};
            var kontras = {!! json_encode($itemRadiologi->newKontras) !!};
            var PemeriksaanLainnya = {!! json_encode($itemRadiologi->newPemeriksaanLainnya) !!};

            processData(ekstremitasAtasData);
            processData(ekstremitasBawahData);
            processData(lainLain);
            processData(usg);
            processData(kontras);
            processData(PemeriksaanLainnya);

            // Explicitly check specific radio buttons if needed
            let leherThyroidRadios = document.getElementsByName('Leher/Thyroid-Radio');
            let bnoIvpRadios = document.getElementsByName('BNO/IVP-Radio');

            for (let radio of leherThyroidRadios) {
                if (radio.value === 'Leher' || radio.value === 'Thyroid') {
                    radio.checked = true;
                }
            }

            for (let radio of bnoIvpRadios) {
                if (radio.value === 'BNO' || radio.value === 'IVP') {
                    radio.checked = true;
                }
            }

            function toggleTextInput(checkbox, displayElementId) {
                var displayElement = document.getElementById(displayElementId);
                if (checkbox.checked) {
                    displayElement.textContent = checkbox.value;
                }
            }
        });
    </script>





</body>

</html>
