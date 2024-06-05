<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Log Perubahan Hasil Radiologi</title>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css"
        />
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
            }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="header">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-7 text-center">
                        <h1 class="mt-2">LOG PERUBAHAN HASIL PEMERIKSAAN RADIOLOGI PASIEN A/N {{ strtoupper($item->radiologiPatient->queue->patient->name ?? '') }} ({{ implode('-', str_split(str_pad($item->radiologiPatient->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})</h1>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
            </div>
            <hr class="m-0 mt-3 mb-3">
            <div class="content">
               @if ($item->changeLogs)    
                @foreach ($item->changeLogs as $oldData)
                @php
                    $change = json_decode($oldData->old_data);
                @endphp
                <table class="text-danger" style="text-decoration: line-through;">
                    <tr>
                        <td class="fw-bold">User Yang Melakukan Perubahan</td>
                        <td>:</td>
                        <td>{{ $oldData->user->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Tanggal Perubahan</td>
                        <td>:</td>
                        <td>{{ $oldData->created_at->format('Y-m-d H:i:s') ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">No. Pemeriksaan</td>
                        <td>:</td>
                        <td>{{ $change->nomor ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Jenis Pemeriksaan</td>
                        <td>:</td>
                        <td>{{ $change->radiologi_form_request_detail->radiologi_form_request_master->name ?? '' }} ({{ $change->radiologi_form_request_detail->radiologi_form_request_master_detail->name ?? '' }})</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Tgl. ({{ $change->radiologi_form_request_detail->radiologi_form_request_master->name ?? '' }})</td>
                        <td>:</td>
                        <td>{{ $change->tanggal ?? ''}}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Hasil Pemeriksaan</td>
                        <td>:</td>
                    </tr>
                    <tr>
                        <td>{!! $change->hasil ?? 'tidak diisi' !!}</td>
                    </tr>
                   </table>
                   <hr class="m-0 mt-2 mb-2">
                @endforeach
               @endif
               <table>
                <tr>
                    <td class="fw-bold">No. Pemeriksaan</td>
                    <td>:</td>
                    <td>{{ $item->nomor ?? '' }}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Jenis Pemeriksaan</td>
                    <td>:</td>
                    <td>{{ $item->radiologiFormRequestDetail->radiologiFormRequestMaster->name ?? '' }} ({{ $item->radiologiFormRequestDetail->radiologiFormRequestMasterDetail->name ?? '' }})</td>
                </tr>
                <tr>
                    <td class="fw-bold">Tgl. ({{ $item->radiologiFormRequestDetail->radiologiFormRequestMaster->name ?? '' }})</td>
                    <td>:</td>
                    <td>{{ $item->tanggal ?? ''}}</td>
                </tr>
                <tr>
                    <td class="fw-bold">Hasil Pemeriksaan</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td>{!! $item->hasil ?? '' !!}</td>
                </tr>
               </table>
               <hr class="m-0 mt-2 mb-2">
            </div>
        </div>

        <script>
            // Mendapatkan tanggal saat ini
            var today = new Date();
            var options = { year: "numeric", month: "long", day: "numeric" };
            document.getElementById("tanggal").innerText =
                today.toLocaleDateString("id-ID", options);
        </script>
    </body>
</html>
