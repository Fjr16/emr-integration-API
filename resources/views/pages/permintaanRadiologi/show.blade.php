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
                            <!-- looping here -->
                            {{-- @php
                                $atasCheckedId = $itemRadiologi->radiologiFormRequestMasters
                                    ->where('kategori', 'EKSTREMITAS ATAS')
                                    ->pluck('id')
                                    ->toArray();
                            @endphp --}}
                            <table>
                                @foreach ($itemRadiologi->newEkstremitasAtas as $atas)
                                    <tr>
                                        <td>
                                            <div class="form-check d-flex">
                                                {{-- <input class="form-check-input" type="checkbox" id="atas"
                                                    {{ in_array($atas->id, $atasCheckedId) ? 'checked' : '' }}
                                                    style = "pointer-events: none;"> --}}
                                                <input type="checkbox" checked>
                                                <label class="form-check-label ms-2">
                                                    {{ $atas->name ?? '' }}
                                                </label>
                                            </div>
                                        </td>
                                        <td class="ps-2">
                                            @if ($atas->value)
                                                <p class="mx-auto ">/ {{ $atas->value }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <!-- end looping  -->
                        </td>

                        <!-- ekstremitasi bawah -->
                        <td class="px-1">
                            {{-- @php
                                $bawahCheckedId = $itemRadiologi->radiologiFormRequestMasters
                                    ->where('kategori', 'EKSTREMITAS BAWAH')
                                    ->pluck('id')
                                    ->toArray();
                            @endphp --}}
                            <table>
                                @foreach ($itemRadiologi->newEkstremitasBawah as $bawah)
                                    <tr>
                                        <td>
                                            <div class="form-check d-flex">
                                                {{-- <input class="form-check-input" type="checkbox" id="bawah"
                                                    {{ in_array($bawah->id, $bawahCheckedId) ? 'checked' : '' }}
                                                    style = "pointer-events: none;"> --}}
                                                <input type="checkbox" checked>
                                                <label class="form-check-label ms-2">
                                                    {{ $bawah->name ?? '' }}
                                                </label>
                                            </div>
                                        </td>
                                        <td class="ps-2">
                                            @if ($bawah->value)
                                                <p class="mx-auto ">/ {{ $bawah->value }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <!-- end looping  -->
                        </td>

                        <!-- LAIN LAIN -->
                        <td class="px-1">
                            {{-- @php
                                $lainCheckedId = $itemRadiologi->radiologiFormRequestMasters
                                    ->where('kategori', 'LAIN-LAIN')
                                    ->pluck('id')
                                    ->toArray();
                            @endphp --}}
                            <table>
                                @foreach ($itemRadiologi->newLainLain as $lain)
                                    <tr>
                                        <td>
                                            <div class="form-check d-flex">
                                                {{-- <input class="form-check-input" type="checkbox" id="lain"
                                                    {{ in_array($lain->id, $lainCheckedId) ? 'checked' : '' }}
                                                    style="pointer-events: none;"> --}}
                                                <input type="checkbox" checked>
                                                <label class="form-check-label ms-2">
                                                    {{ $lain->name ?? '' }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($lain->value)
                                                <p class="">/ {{ $lain->value }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
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
                        <td rowspan="3" class="px-1">
                            <!-- looping here -->
                            {{-- @php
                                $usgCheckedId = $itemRadiologi->radiologiFormRequestMasters
                                    ->where('kategori', 'USG')
                                    ->pluck('id')
                                    ->toArray();
                            @endphp --}}
                            @foreach ($itemRadiologi->newUsg as $usg)
                                <div class="form-check d-flex">
                                    {{-- <input class="form-check-input" type="checkbox" id="usg"
                                        {{ in_array($usg->id, $usgCheckedId) ? 'checked' : '' }}
                                        style="pointer-events: none;"> --}}
                                    <input type="checkbox" checked>
                                    <label class="form-check-label ms-2">
                                        {{ $usg->name ?? '' }}
                                    </label>
                                    @if ($usg->value)
                                        <p class="mx-auto">/{{ $usg->value }}</p>
                                    @endif
                                </div>
                            @endforeach

                            <!-- end looping  -->
                        </td>
                        <td class="px-1">
                            {{-- @php
                                $kontrasCheckedId = $itemRadiologi->radiologiFormRequestMasters
                                    ->where('kategori', 'KONTRAS')
                                    ->pluck('id')
                                    ->toArray();
                            @endphp --}}
                            @foreach ($itemRadiologi->newKontras as $kontras)
                                <div class="form-check d-flex">
                                    {{-- <input class="form-check-input" type="checkbox" id="kontras"
                                        {{ in_array($kontras->id, $kontrasCheckedId) ? 'checked' : '' }}
                                        style="pointer-events: none;"> --}}
                                    <input type="checkbox" checked>
                                    <label class="form-check-label ms-2">
                                        {{ $kontras->name ?? '' }}
                                    </label>
                                </div>
                            @endforeach
                            <!-- end looping  -->
                        </td>
                    </tr>
                    <tr>
                        <td class="text-uppercase text-center  ">Pemeriksaan lainnya
                        </td>
                    </tr>
                    <tr>
                        <td class="px-1">
                            {{-- @php
                                $lainnyaCheckedId = $itemRadiologi->radiologiFormRequestMasters
                                    ->where('kategori', 'PEMERIKSAAN LAINNYA')
                                    ->pluck('id')
                                    ->toArray();
                            @endphp --}}
                            <!-- looping here -->
                            <table>
                                @foreach ($itemRadiologi->newPemeriksaanLainnya as $lainnya)
                                    <tr>
                                        <td>
                                            <div class="form-check d-flex">
                                                {{-- <input class="form-check-input" type="checkbox" value=""
                                                    id="lainnya"
                                                    {{ in_array($lainnya->id, $lainnyaCheckedId) ? 'checked' : '' }}
                                                    style="pointer-events: none;"> --}}
                                            </div>
                                        </td>
                                        <td>
                                            <input type="checkbox" checked>
                                            <label class="form-check-label ms-2">
                                                {{ $lainnya->name ?? '' }}
                                            </label>
                                        </td>
                                        @if ($lainnya->value)
                                            <td class="ps-2">:</td>
                                            <td>
                                                <p class="mx-auto ">{{ $lainnya->value }}</p>
                                                {{-- <label
                                                class="form-check-label ms-2">{{ $itemRadiologi->radiologiFormRequestMasters()->where('radiologi_form_request_master_id', $lainnya->id)->pluck('value')->first() ?? '' }}</label> --}}
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
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

</body>

</html>
