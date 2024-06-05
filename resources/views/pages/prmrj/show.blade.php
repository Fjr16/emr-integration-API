<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PRMRJ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            /* height: 210mm; */
            height: auto;
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

        .small-table td {
            padding: 2px 5px;
            font-size: 8pt;
        }

        .bg-gray {
            background-color: #d3d3d3
        }

        @page {
            size: landscape;
            margin: 10mm;
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

            .print-footer {
                position: fixed;
                bottom: 0mm;
                right: 10mm;
                width: 100%;
                text-align: right;
            }

            *,
            *:before,
            *:after {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="header">
            <div class="row">
                <div class="col-1 d-flex align-items-center">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-7 d-flex align-items-center justify-content-center">
                    <h1>PROFIL RINGKAS MEDIS RAWAT JALAN (PRMRJ)</h1>
                </div>
                <div class="col-4">
                    <div class="border border-dark p-1" style="border-radius: 15px">
                        <table class="small small-table">
                            <tr>
                                <td>Nama</td>
                                <td class="px-2">:</td>
                                <td>{{ $item->name }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td class="px-2">:</td>
                                @php
                                    $tanggalLahir = new DateTime($item->tanggal_lhr);
                                    $now = new DateTime();
                                    $ageDiff = $now->diff($tanggalLahir);
                                    $ageString = $ageDiff->format('%y tahun %m bulan');
                                @endphp
                                <td>{{ $tanggalLahir->format('d-m-Y') ?? '....' }}
                                    <span>({{ $ageString ?? '....' }})</span>
                                </td>
                            </tr>
                            <tr>
                                <td>No Rekam Medis</td>
                                <td class="px-2">:</td>
                                <td>{{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                </td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td class="px-2">:</td>
                                <td>{{ $item->nik }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <table class="table-bordered w-100 mt-4">
                <thead>
                    <tr class="text-center bg-gray">
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>DPJP</th>
                        <th>Diagnosa Penting</th>
                        <th>Urainan Klinis Penting</th>
                        <th>Rencana Penting</th>
                        <th>Nama & Paraf</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item->prmrjs as $prmrj)
                        <tr class="text-center">
                            <td>{{ date('Y-m-d', strtotime($prmrj->tanggal ?? '')) }}</td>
                            <td>{{ date('H:i', strtotime($prmrj->tanggal ?? '')) }}</td>
                            <td>{{ $prmrj->user->name ?? '' }}</td>
                            <td>{!! $prmrj->diagnosa_penting ?? '' !!}</td>
                            <td>{!! $prmrj->uraian_klinis ?? '' !!}</td>
                            <td>{!! $prmrj->rencana_penting ?? '' !!}</td>
                            <td>
                                <a href="{{ Storage::url($prmrj->paraf) }}"><img
                                        src="{{ Storage::url($prmrj->paraf) }}" alt=""></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div class="d-flex flex-row justify-content-between mt-5">
            <div class="d-flex flex-row text-center" style="font-size: 5pt">
                <div class="col col-3 text-center">
                    <i class="bi bi-geo-alt-fill"></i>
                    <p>Jl. Aur No. 8, Ujung Gurun, Padang Barat, Kota Padang, Sumatera Barat</p>
                </div>
                <div class="col col-3 text-center">
                    <i class="bi bi-envelope-at-fill"></i>
                    <p>rskbropanasuripadang@gmail.com</p>
                </div>
                <div class="col col-3 text-center">
                    <i class="bi bi-telephone-fill"></i>
                    <p>(0751) 31938 - 33854 - 25735 - 8955227</p>
                </div>
            </div>
            <p class="mt-2"><span class="border border-dark">RM 03.RJ.DR.REV.1-2/2</span></p>
        </div>
    </div>

    <script>
        // Mendapatkan tanggal saat ini
        var today = new Date();
        var options = {
            year: "numeric",
            month: "long",
            day: "numeric"
        };
        document.getElementById("tanggal").innerText =
            today.toLocaleDateString("id-ID", options);
    </script>
</body>

</html>
