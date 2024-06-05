<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Hasil Pemeriksaan Labor PA</title>
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
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" />
                    </div>
                    <div class="col-7 text-center">
                        <h1>
                            HASIL PEMERIKSAAN <br />LABORATORIUM PATOLOGI
                            ANATOMIK
                        </h1>
                    </div>
                    <div class="col-3">
                        <div
                            class="border border-3 border-rounded py-4 px-5"
                        ></div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="content">
                <div class="row mb-3">
                    <div class="col-3">Ahli Patologi :</div>
                    <div class="col-9">
                        <p class="m-0">1. dr. Ucok</p>
                        <p class="m-0">2. dr. Ucok</p>
                    </div>
                </div>
                <p class="mb-3">
                    Kepada Yth, <span class="fw-bold">{{ $item->detailAntrianLaboratoriumPatologiAnatomiPatient->antrianLaboratoriumPatologiAnatomiPatient->permintaanLaboratoriumPatologiAnatomikPatient->user->name }}</span>
                </p>
                <div class="row mb-3">
                    <div class="col-7">
                        <table class="w-100">
                            <tr>
                                <td style="width: 110px">Nama Pasien</td>
                                <td style="width: 10px">:</td>
                                <td>{{ $item->detailAntrianLaboratoriumPatologiAnatomiPatient->antrianLaboratoriumPatologiAnatomiPatient->permintaanLaboratoriumPatologiAnatomikPatient->queue->patient->name }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td>{{ $item->detailAntrianLaboratoriumPatologiAnatomiPatient->antrianLaboratoriumPatologiAnatomiPatient->permintaanLaboratoriumPatologiAnatomikPatient->queue->patient->tanggal_lhr }}</td>
                            </tr>
                            <tr>
                                <td>No. RM</td>
                                <td>:</td>
                                <td>{{ $item->detailAntrianLaboratoriumPatologiAnatomiPatient->antrianLaboratoriumPatologiAnatomiPatient->permintaanLaboratoriumPatologiAnatomikPatient->queue->patient->no_rm }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-5">
                        <table class="w-100">
                            <tr>
                                <td style="width: 150px">No. Sediaan</td>
                                <td style="width: 10px">:</td>
                                <td>{{ $item->detailAntrianLaboratoriumPatologiAnatomiPatient->antrianLaboratoriumPatologiAnatomiPatient->permintaanLaboratoriumPatologiAnatomikPatient->no_sediaan }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Terima</td>
                                <td>:</td>
                                <td>23/09/1923</td>
                            </tr>
                            <tr>
                                <td>Tanggal Jawaban</td>
                                <td>:</td>
                                <td>23/09/1923</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <p>
                    <span>{!! $item->bacaan !!}</span>
                    <span>{!! $item->diagnosis !!}</span>
                </p>
                <p>
                    <span class="fw-bold">Kesan :</span>
                    {!! $item->kesan !!}
                </p>
                <p>
                    <span class="fw-bold">Diagnosa :</span><br />
                    {!! $item->diagnosis !!}
                </p>
                <div class="row">
                    <div class="col-7"></div>
                    <div class="col-5 text-center">
                        <p class="m-0 p-0">Ahli Patologi</p>
                        <br /><br /><br />
                        <h5 class="text-decoration-underline fw-bold m-0 p-0">Dr. Ucok Hasibuan, Sp.PA</h5>
                        <P>SIP.755/SDMK-JAMKES/DKK/VI/2020</P>
                    </div>
                </div>
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
