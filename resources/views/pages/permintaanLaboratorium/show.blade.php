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
            /* height: 330mm; */
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

        .content {
            font-size: 10pt;
        }

        .fs-8 {
            font-size: 8pt;
        }

        @page {
            size: A4;
            margin: 0;
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
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="header">
            <div class="d-flex flex-row align-items-center justify-content-center">
                <div class="col-1">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                </div>
                <div class="text-center mx-2 col-6">
                    <h1>FORMULIR PERMINTAAN LABORATORIUM</h1>
                </div>
                <div class="">
                    <div class="border border-dark py-1 px-1" style="border-radius: 15px">
                        <table class="small small-table">
                            <tr>
                                <td class="fs-8">Nama</td>
                                <td class="px-2 fs-8">:</td>
                                <td class="fs-8">{{ $item->patient->name }}</td>
                            </tr>
                            <tr>
                                <td class="fs-8">Tanggal Lahir</td>
                                <td class="px-2 fs-8">:</td>
                                @php
                                    $tanggalLahir = new DateTime($item->patient->tanggal_lhr);
                                    $now = new DateTime();
                                    $ageDiff = $now->diff($tanggalLahir);
                                    $ageString = $ageDiff->format('%y tahun %m bulan');
                                @endphp
                                <td class="fs-8">{{ $tanggalLahir->format('d-m-Y') ?? '....' }}
                                    <span>({{ $ageString ?? '....' }})</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fs-8">No Rekam Medis</td>
                                <td class="px-2 fs-8">:</td>
                                <td class="fs-8">
                                    {{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fs-8">NIK</td>
                                <td class="px-2 fs-8">:</td>
                                <td class="fs-8">{{ $item->patient->nik }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <table class="my-3">
                <tr>
                    <td>Nama Pasien</td>
                    <td>:</td>
                    <td>{{ $item->patient->name ?? '' }}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td>{{ $item->patient->tanggal_lhr ?? '' }}</td>
                </tr>
                <tr>
                    <td>No RM</td>
                    <td>:</td>
                    <td>{{ $item->patient->no_rm ?? '' }}</td>
                </tr>
                <tr>
                    <td>Diagnosa</td>
                    <td>:</td>
                    <td>{!! $item->diagnosa ?? '' !!}</td>
                </tr>
                <tr>
                    <td>Tanggungan</td>
                    <td>:</td>
                    <td>{{ $item->queue->patientCategory->name ?? '' }}</td>
                </tr>
                <tr>
                    <td>Ruang</td>
                    <td>:</td>
                    <td>{{ $item->queue->doctorPatient->user->roomDetail->room->name ?? '' }}</td>
                </tr>
                <tr>
                    <td>Detail Ruang</td>
                    <td>:</td>
                    <td>{{ $item->queue->doctorPatient->user->roomDetail->name ?? '' }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pengambilan Sampel</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Kategori Permintaan</td>
                    <td>:</td>
                    <td>{{ $item->laboratoriumRequestTypeMaster->name ?? '' }}</td>
                </tr>
            </table>

            {{-- @if (in_array($data->first()->id, $categoryIds))
                    <p class="fw-bold mb-0 mt-2">{{ $data->first()->name ?? '' }}</p>
                    @foreach ($item->laboratoriumRequestDetails as $operasi)
                    @if ($operasi->laboratoriumRequestMaster)
                        @if ($operasi->laboratoriumRequestMaster->laboratoriumRequestCategoryMaster->id == $data->first()->id)
                        <div class="">
                            <div class="form-check mt-1">
                                <input type="radio" class="form-check-input" style="pointer-events: none;" checked/>
                                <label class="form-check-label m-0">
                                {{ $operasi->laboratoriumRequestMaster->name ?? '' }}
                                </label>
                            </div>
                        </div>
                        @endif
                    @endif
                    @endforeach
                @endif --}}

            <div class="row mb-3">
                @foreach ($dataKategori as $category)
                    @if (in_array($category->id, $categoryIds))
                        <div class="col-4">
                            <h6 class="mb-2">{{ $category->name ?? '' }}</h6>
                            <div class="mb-3 mx-1">
                                @foreach ($item->laboratoriumRequestDetails as $detail)
                                    @if ($detail->laboratoriumRequestMasterVariable->laboratoriumRequestCategoryMaster)
                                        @if ($detail->laboratoriumRequestMasterVariable->laboratoriumRequestCategoryMaster->id == $category->id)
                                            <div class="form-check mt-1">
                                                <input type="checkbox" style="pointer-events: none;"
                                                    class="form-check-input" checked />
                                                <label class="form-check-label m-0">
                                                    {{ $detail->laboratoriumRequestMasterVariable->name ?? '' }}
                                                    {{ $detail->value ? $detail->value : '' }}
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="row">
                    <div class="col-6 ">
                    </div>
                    <div class="col-6">
                        <p class="text-end" style="margin: 3mm;">Padang,</p>
                        <p class="text-end" style="margin: 3mm;">Dokter yang Meminta</p>
                        <br>
                        <br>
                        <p class="text-end mx-3">{{ $item->user->name ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
