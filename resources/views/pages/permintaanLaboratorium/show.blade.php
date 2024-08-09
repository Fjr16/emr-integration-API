<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Permintaan Laboratorium</title>
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
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-8 d-flex align-self-center">
                    <h1 class="mx-auto text-uppercase text-center ">FORMULIR PERMINTAAN LABORATORIUM</h1>
                </div>
            </div>
        </div>

        <div class="content">
            <table class="w-100 my-3">
                <tr>
                    <td class="w-50">
                        <table class="mx-3">
                            <tr>
                                <td class="fw-bold">Nama Pasien</td>
                                <td class="ps-4 pe-1 fw-bold">:</td>
                                <td>{{ $queue->patient->name ?? '' }} / {{ $queue->patient->no_rm ?? '' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tgl. Lahir</td>
                                <td class="ps-4 pe-1 fw-bold">:</td>
                                <td>{{ $queue->patient->tanggal_lhr ?? '' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggungan</td>
                                <td class="ps-4 pe-1 fw-bold">:</td>
                                <td>{{ $queue->patientCategory->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Asal Ruang</td>
                                <td class="ps-4 pe-1 fw-bold">:</td>
                                <td>{{ $queue->dpjp->poliklinik->name ?? '' }}</td>
                            </tr>
                        </table>
                    </td>
                    <td class="w-50">
                        <table class="mx-3">
                            <tr>
                                <td class="fw-bold">Diagnosa</td>
                                <td class="ps-4 pe-1 fw-bold">:</td>
                                <td>{{  $item->diagnosa ?? '' }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tgl. Ambil Sampel</td>
                                <td class="ps-4 pe-1 fw-bold">:</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Kategori</td>
                                <td class="ps-4 pe-1 fw-bold">:</td>
                                <td>
                                    <span class="{{ $item->tipe_permintaan == 'Urgent' ? 'badge bg-danger' : '' }}">
                                        {{ $item->tipe_permintaan ?? '' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Status</td>
                                <td class="ps-4 pe-1 fw-bold">:</td>
                                <td>
                                    @if ($item->status == 'WAITING')
                                        <span class="badge bg-warning">PERMINTAAN</span>
                                    @elseif ($item->status == 'CANCEL')
                                        <span class="badge bg-danger">BATAL</span>
                                    @elseif ($item->status == 'DENIED')
                                        <span class="badge bg-warning">DITOLAK</span>
                                    @elseif ($item->status == 'ACCEPTED')
                                        <span class="badge bg-primary">DITERIMA</span>
                                    @elseif ($item->status == 'UNVALIDATE')
                                        <span class="badge bg-primary">SEDANG DIPERIKSA</span>
                                    @elseif ($item->status == 'FINISHED')
                                        <span class="badge bg-success">SELESAI</span>
                                    @else
                                        <span class="badge bg-danger">TIDAK DIKETAHUI</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <hr>
            <table class="table w-100">
                <thead>
                    <tr class="table-primary text-white text-center">
                        <th>Kode Tindakan</th>
                        <th>Nama Tindakan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item->laboratoriumRequestDetails as $detail)                        
                        <tr class="text-center">
                            <td>{{ $detail->action->action_code ?? '...' }}</td>
                            <td>{{ $detail->action->name ?? '...' }}</td>
                            <td>{{ $detail->keterangan ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row">
                <div class="col-6" style="font-size: 3mm;">
                    <p class="fst-italic">*) Dijadwalkan dan dipersiapkan oleh Petugas Laboratorium</p>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column justify-content-end small mt-5">
                        <p class="text-center mb-0">Padang,
                            {{ $item->created_at->format('d F Y') }}
                        </p>
                        <p class="text-center mb-0 fw-bold">Dokter yang Meminta</p>
                        <p class="text-center {{ $item->ttd_dokter ? 'mb-0' : 'mb-5' }}">
                            <img src="{{ Storage::url($item->ttd_dokter ?? '') }}" alt="" width="200px">
                        </p>
                        <p class="text-center">( {{ $item->user->name ?? '' }} )</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
