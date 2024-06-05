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
            padding: 27mm;
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

        /* tr th {
            font-size: 10pt;
        } */

        /* tr{
            margin-top: 100px;
        } */

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
            padding-top: 7px;
            vertical-align: top;
        }

        .print-footer {
                padding-top: 200px;
            }

        .form-check-input {
            pointer-events: none;
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

            .print-footer {
                position: fixed;
                bottom: 10mm;
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
                <div class="col-8 d-flex align-self-center">
                    <h1 class="mx-auto text-uppercase text-center ">SURAT PENGANTAR RAWAT</h1>
                </div>
                {{-- <div class="col-3">
                    <div class="border border-3 border-rounded py-4 px-5"></div>
                </div> --}}
            </div>
        </div>

        <div class="content">
            <div class="d-flex flex-row justify-content-between" style="margin-top: 70px">
                <p>Dengan Hormat</p>
                <p>Padang, {{date('d-m-Y', strtotime($data->tgl_operasi)) ?? '.......................'}}</p>
            </div>
            <table>
                <tr>
                    <td style="width: 150px">Identitas Pasien</td>
                    <td class="pe-2">:</td>
                    <td>{{$data->patient->name ?? '......................'}}</td>
                </tr>
                <tr>
                    <td>Diagnosa Primer</td>
                    <td>:</td>
                    <td>{{$data->primer ?? '......................'}}</td>
                </tr>
                <tr>
                    <td>Diagnosa Sekunder</td>
                    <td>:</td>
                    <td>
                        <ol class="px-3">
                            @foreach ($sekunderSurat as $sekunder)
                            <li>{{$sekunder->name ?? '......................'}}</li>
                            @endforeach
                        </ol>
                    </td>
                </tr>
                <tr>
                    <td>Rencana Tindakan</td>
                    <td>:</td>
                    <td>
                        <ol class="px-3">
                            <li>......................</li>
                            <li>......................</li>
                        </ol>
                    </td>
                </tr>
                <tr>
                    <td>Persiapan Operasi</td>
                    <td>:</td>
                    <td>
                        <div class="row">
                            @foreach ($operasiSurat as $operasi)
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$operasi->name ?? ''}}" @if ($operasi->name) checked @endif>
                                    <label class="form-check-label">
                                      {{$operasi->name ?? ''}}
                                    </label>
                                  </div>
                            </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Terapi</td>
                    <td>:</td>
                    <td>
                        <ol class="px-3">
                            @foreach ($terapiSurat as $terapi)
                            <li>{{$terapi->name ?? '......................'}}</li>
                            @endforeach
                        </ol>
                    </td>
                </tr>
                <tr>
                    <td>Alat</td>
                    <td>:</td>
                    <td>{{$data->alat ?? '......................'}}</td>
                </tr>
                <tr>
                    <td>Prioritas Kebutuhan</td>
                    <td>:</td>
                    <td>
                        <div class="row">
                            @foreach ($kebutuhanSurat as $kebutuhan)
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$kebutuhan->name ?? ''}}" checked>
                                    <label class="form-check-label">
                                      {{$kebutuhan->name ?? ''}}
                                    </label>
                                  </div>
                            </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Ruangan</td>
                    <td>:</td>
                    <td>
                        <div class="d-flex flex-row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="Ruangan Biasa" id="Ruangan Biasa"
                                @if (isset($data->ruangan) && $data->ruangan == 'Ruangan Biasa') checked @endif>
                                <label class="form-check-label">
                                    Ruangan Biasa
                                </label>
                            </div>
                            <div class="form-check ms-5">
                                <input class="form-check-input" type="checkbox" value="Ruangan Isolasi" id="Ruangan Isolasi"
                                @if (isset($data->ruangan) && $data->ruangan == 'Ruangan Isolasi') checked @endif>
                                <label class="form-check-label">
                                    Ruangan Isolasi
                                </label>
                            </div>
                            <div class="form-check ms-5">
                                <input class="form-check-input" type="checkbox" value="HCU" id="HCU"
                                @if (isset($data->ruangan) && $data->ruangan == 'HCU') checked @endif>
                                <label class="form-check-label">
                                    HCU
                                </label>
                            </div>

                        </div>
                    </td>
                </tr>
            </table>
            <div class="d-flex flex-row justify-content-between" style="margin-top: 70px">
                <p>Atas kesediaan kami ucapkan terima kasih</p>
                <p class="pt-4">Salam Sejawat</p>
            </div>
        </div>

        <div class="text-end mt-4 print-footer">
            <p class="small"><span class="border border-dark">RM-09-00-2020</span></p>
        </div>
    </div>

</body>

</html>
