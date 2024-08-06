<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Hasil Radiologi</title>
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
        @foreach ($rad->radiologiFormRequestDetails as $item)    
            <div class="page">
                <div class="header">
                    <div class="row">
                        <div class="col-2">
                            <img src={{ asset('assets/img/logo.png') }} alt="" />
                        </div>
                        <div class="col-7 text-center">
                            <h1 class="mt-2">HASIL PEMERIKSAAN RADIOLOGI</h1>
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                </div>
                <hr class="m-0 mt-3 mb-3">
                <div class="content">
                <table>
                    <tr>
                        <td style="width: 200px">No. RM / Nama</td>
                        <td style="width: 20px">:</td>
                        <td class="fw-bold">
                            {{ implode('-', str_split(str_pad($item->radiologiFormRequest->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }} / {{ $item->radiologiFormRequest->queue->patient->name ?? '' }} 
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $item->radiologiFormRequest->queue->patient->jenis_kelamin ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>No. Registrasi Radiologi</td>
                        <td>:</td>
                        <td>{{ $item->radiologiFormRequest->no_reg_rad ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Tgl. Periksa</td>
                        <td>:</td>
                        <td>{{ $item->tanggal_periksa ?? ''}}</td>
                    </tr>
                </table>
                <hr class="m-0 mt-2 mb-2">
                <p class="fst-italic">Teman Sejawat Yth,</p>
                <h5 class="fw-bold">{{ $item->action->name ?? '' }}</h5>

                    {!! $item->hasil ?? '' !!}

                <p class=" fst-italic">Terima kasih atas kerja samanya.</p>         
                @php
                    $tgl_periksa = new Carbon\Carbon(strtotime($item->tanggal_periksa));
                @endphp
                <p class="m-0">Padang, {{ $tgl_periksa->format('d M Y') ?? $item->created_at->format('d M Y') }}<span id="tanggal"></span></p>
                @isset($rad->validator_rad_id)
                    <a href="{{ Storage::url($rad->ttd_dokter) }}">
                        <img src="{{ Storage::url($rad->ttd_dokter) }}" alt="{{ $rad->ttd_dokter }}" width="150" height="100">
                    </a>
                    <p class="m-0 text-decoration-underline">{{ $item->radiologiFormRequest->validator->name ?? '' }}</p>
                    <p class="m-0">{{ $item->radiologiFormRequest->validator->sip ?? '' }}</p>
                @else
                    <br>
                    <h6 class="fw-bold m-0">(UNVALIDATE)</h6>
                @endisset
                </div>
            </div>
        @endforeach
    </body>
</html>
