<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title></title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                background-color: #fafafa;
                font-size: 8pt !important;
            }

            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }

            .page {
                width: 210mm;
                height: 330mm;
                min-height: 13.97cm;
                padding: 7mm;
                padding-top: 30px;
                margin: 8mm auto;
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
            .table-skor {
                font-size: 7pt !important;
            }
            .text-xxxs {
                font-size: 6pt;
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
                <div class="grid grid-cols-4 gap-4">
                    <div class="...">
                        <img src="logo.png" alt="" />
                    </div>
                    <div class="col-span-2">
                        <h1 class="text-center uppercase mt-2">
                            MONITORING CAIRAN INFUS
                        </h1>
                    </div>
                </div>
            </div>

            <div class="content">
                <section class="mt-3">
                    <table class="w-full">
                        <thead>
                            <tr class="text-center font-semibold">
                                <td class="border border-black py-2">
                                    <p>Tanggal & jam</p>
                                </td>
                                <td class="border border-black w-2/12">
                                    <p>Order Dokter</p>
                                </td>
                                <td class="border border-black">
                                    <p>Jenis Cairan</p>
                                </td>
                                <td class="border border-black">
                                    <p>Botol Ke</p>
                                </td>
                                <td class="border border-black">
                                    <p>Tetes/Menit</p>
                                </td>
                                <td class="border border-black">
                                    <p>Dimulai jam</p>
                                </td>
                                <td class="border border-black">
                                    <p>Habis jam</p>
                                </td>
                                <td class="border border-black">
                                    <p>Nama Perawat</p>
                                </td>
                                <td class="border border-black">
                                    <p>Keterangan</p>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->ranapMonitoringCairanInfusPatients as $infus)         
                                <tr>
                                    <td class="border border-black">{{ $infus->tanggal ?? '' }}</td>
                                    <td class="border border-black">{{ $infus->order_dokter ?? '' }}</td>
                                    <td class="border border-black">{{ $infus->jenis ?? '' }}</td>
                                    <td class="border border-black">{{ $infus->botol_ke ?? '' }}</td>
                                    <td class="border border-black">{{ $infus->tetes ?? '' }}</td>
                                    <td class="border border-black">{{ $infus->mulai ?? '' }}</td>
                                    <td class="border border-black">{{ $infus->habis ?? '' }}</td>
                                    <td class="border border-black">{{ $infus->user->name ?? '' }}</td>
                                    <td class="border border-black">{{ $infus->keterangan ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </body>
</html>
