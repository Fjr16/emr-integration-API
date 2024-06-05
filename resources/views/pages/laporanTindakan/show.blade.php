<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? '' }}</title>
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
            width: 21.59cm;
            height: 29.7cm;
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
                width: 21.59cm;
                height: 29.7cm;
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
                right: 15mm;
                width: 100%;
                text-align: right;
            }
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="header">
            <div class="d-flex flex-row align-items-center">
                <div class="col-1">
                    <img src={{ asset('assets/img/logo.png') }} alt="" />
                </div>
                <div class="text-center mx-auto">
                    <h1 class="">LAPORAN TINDAKAN</h1>
                </div>
                <div class="">
                    <div class="border border-dark p-1" style="border-radius: 15px">
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
                                    {{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
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
            <table class="table-bordered w-100 mt-4 small">
                <tbody>
                    <tr>
                        <td class="py-2 px-2">
                            <span class="fw-bold">Dokter Penanggung Jawab Pasien</span> : {{ $item->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2">
                            <div class="row">
                                <div class="col-3 fw-bold">Diagnosa</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-8">{{ $item->diagnosa ?? '' }}</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2">
                            <div class="row">
                                <div class="col-3 fw-bold">Jenis Tindakan</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-8">
                                    {{ $item->jenis_tindakan ?? '' }}
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2">
                            <div class="row">
                                <div class="col-3 fw-bold">Lokasi</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-8">{{ $item->lokasi ?? '' }}</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2">
                            <div class="row">
                                <div class="col-3 fw-bold">Tanggal Tindakan</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-2">{{ date('Y-m-d', strtotime($item->tgl_tindakan ?? '')) }}</div>
                                <div class="col-6">
                                    <div class="d-flex flex-row">
                                        <div class="fw-bold">Jam Tindakan</div>
                                        <div class="px-2">:</div>
                                        <div class="">{{ date('H:i', strtotime($item->tgl_tindakan ?? '')) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-2 pb-5 pt-2">
                            <div class="row">
                                <div class="col-3 fw-bold">Laporan Tindakan</div>
                                <div class="col-1 text-center">:</div>
                                <div class="col-8">{!! $item->laporan_tindakan ?? '' !!}</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-2 pb-5 pt-2">
                            <div class="d-flex flex-row">
                                <div class="fw-bold">
                                    Intruksi Pasca Tindakan
                                </div>
                                <div class="col-1 text-center ms-2">:</div>
                                <div class="col-8 ps-3">{!! $item->intruksi ?? '' !!}</div>
                            </div>
                            <div class="row justify-content-end mt-5">
                                <div class="col-5">
                                    <p class="mt-5 text-center fw-bold mb-0">
                                        Dokter Penanggung Jawab Pasien
                                    </p>
                                    @if ($item->paraf)
                                        <p class="text-center">
                                            <img src="{{ Storage::url($item->paraf ?? '') }}" alt=""
                                                class="img-fluid mb-0" style="max-width: 150px">
                                        </p>
                                    @else
                                        <br /><br /><br />
                                    @endif
                                    <p class="text-center">
                                        (&nbsp;{{ $item->user->name ?? '.....................................' }}&nbsp;)
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- Footer --}}
        <div class="d-flex flex-row justify-content-between PT-5">
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
            <p class="small"><span class="border border-dark px-5">RM 04.RJ.DR</span></p>
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
