<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kontrol Ulang</title>
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
            /* width: 21.59cm;
            height: 29.7cm; */
            height: 21.59cm;
            width: 29.7cm;
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
        input[type="checkbox"],
        input[type="radio"] {
            pointer-events: none;
        }

        /* td {
                padding-top: 5px;
            } */
        /* th {
            font-size: 10pt !important;
        } */

        .font-8pt {
            font-size: 8pt !important;
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
            font-size: 18px;
            font-weight: bold;
        }

        @page {
            size: landscape;
            margin: 10mm;
        }

        @media print {

            html,
            body {
                height: 21.59cm;
                width: 29.7cm;
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
        <div class="d-flex justify-content-between gap-2">

            <div class="col-6 font-8pt">
                <!-- <hr class="m-0 p-0 mt-3" /> -->
                <div class="content border border-dark p-1 mt-4">

                    <div class="row">
                        <div class="col-7">
                            <h6>LEMBAR KONTROL ULANG PASIEN</h6>
                            <table class="w-100">
                                <tbody>
                                    <tr>
                                        <td>Nama Pasien</td>
                                        <td>:</td>
                                        <td>{{ $item->patient->name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>No Rekam Medis</td>
                                        <td>:</td>
                                        <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Antrian</td>
                                        <td>:</td>
                                        <td>{{ $item->no_antrian ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Kontrol</td>
                                        <td>:</td>
                                        <td>{{ $item->created_at->format('Y-m-d') ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-5">
                            <table class="w-100">
                                <table class="w-100">
                                    <tbody>
                                        <tr>
                                            <td class="text-center pt-4">Petugas Rekam
                                                medis
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" style="padding-top: 70px;">
                                                ...................................
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
