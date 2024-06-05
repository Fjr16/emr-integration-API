<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Resep Dokter Ranap</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" />
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
            height: 210mm;
            width: 297mm;
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

        /* td {
                padding-top: 5px;
            } */
        th {
            font-size: 10pt !important;
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

        @page {
            size: landscape;
            margin: 0;
        }

        @media print {

            html,
            body {
                height: 210mm;
                width: 297mm;
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
                <div class="col-7 text-center">
                    <h1>DAFTAR RESEP DOKTER</h1>
                </div>
                <div class="col-3">
                    {{-- <div class="border border-3 border-rounded py-4 px-5">
                      </div> --}}
                </div>
            </div>
        </div>

        <div class="content mt-4">
            <table class="table table-bordered text-center">
                <thead class="table-secondary">
                    <tr>
                        <th class="text-dark text-capitalize">Tanggal / Jam</th>
                        <th class="text-dark text-capitalize">Nama Obat</th>
                        <th class="text-dark text-capitalize">Jumlah</th>
                        <th class="text-dark text-capitalize">Aturan</th>
                        <th class="text-dark text-capitalize">Digunakan</th>
                        <th class="text-dark text-capitalize">Ket. Penggunaan</th>
                        <th class="text-dark text-capitalize">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td class="text-dark text-sm">{{ $item->created_at->format('Y-m-d / H:i') }}</td>
                        @foreach ($item->ranapMedicineReceiptDetails as $detail)
                            <td class="text-dark text-sm">{{ $detail->medicine->name ?? '' }}</td>
                            <td class="text-dark text-sm">{{ $detail->jumlah ?? '' }}</td>
                            <td class="text-dark text-sm">{{ $detail->aturan_pakai ?? '' }}</td>
                            <td class="text-dark text-sm">{{ $detail->category ?? '-' }}</td>
                            <td class="text-dark text-sm">{{ $detail->keterangan ?? '' }}</td>
                            <td class="text-dark text-sm">{{ $detail->other ?? '' }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>

            {{-- <div class="row border border-dark">
                <div class="col-sm-2 fw-bold border border-dark">
                    Tanggal / Jam
                </div>
                <div class="col-sm-2 fw-bold border border-dark">
                    Nama Obat
                </div>
                <div class="col-sm-1 fw-bold border border-dark">
                    Jumlah
                </div>
                <div class="col-sm-1 fw-bold border border-dark">
                    Aturan
                </div>
                <div class="col-sm-2 fw-bold border border-dark">
                    Digunakan
                </div>
                <div class="col-sm-2 fw-bold border border-dark">
                    Ket. Penggunaan
                </div>
                <div class="col-sm-2 fw-bold border border-dark">
                    Keterangan
                </div>
            </div>
            <div class="row border">
                <div class="col-sm-2">
                    {{ $item->created_at->format('Y-m-d / H:i') }}
                </div>
                <div class="col">
                    @foreach ($item->ranapMedicineReceiptDetails as $detail)
                        <div class="row">
                            <div class="col border">
                                {{ $detail->medicine->name ?? '' }}
                            </div>
                            <div class="col-2 border text-center">
                                {{ $detail->jumlah ?? '' }}
                            </div>
                            <div class="col border">
                                {{ $detail->aturan_pakai ?? '' }}
                            </div>
                            <div class="col-2 border text-center">
                                {{ $detail->category ?? '' }}
                            </div>
                            <div class="col-2 border text-center">
                                {{ $detail->keterangan ?? '' }}
                            </div>
                            <div class="col-2 border text-center">
                                {{ $detail->other ?? '' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> --}}
        </div>

    </div>
</body>

</html>
