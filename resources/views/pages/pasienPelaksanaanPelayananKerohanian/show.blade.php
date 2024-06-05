<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Bukti Pelayanan Kerohanian</title>
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
                    <div class="col-8 text-center">
                        <h1 class="mt-3">PELAKSANAAN PELAYANAN KEROHANIAN</h1>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>

            <div class="content">
                <div class="row mt-3">
                    <div class="col-12 border p-4">
                        <p class="m-0">
                            Saya yang bertandatangan dibawah ini selaku Konseris
                            / Rohaniawan :
                        </p>
                        <table class="mx-3 mb-3">
                            <tbody>
                                <tr>
                                    <td style="width: 100px">Nama</td>
                                    <td style="width: 10px">:</td>
                                    <td>..........................</td>
                                </tr>
                                <tr>
                                    <td>Umur</td>
                                    <td>:</td>
                                    <td>..........................</td>
                                </tr>
                                <tr>
                                    <td>Agama</td>
                                    <td>:</td>
                                    <td>..........................</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>..........................</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="m-0">
                            Dengan ini menyatakan dengan sebenar-benarnya telah
                            melaksanakan pelayanan kerohanian agama /
                            kepercayaan terhitung mulai tanggal
                            ....................... s/d tanggal
                            .......................... kepada pasien RSK Bedah
                            Ropanasuri :
                        </p>
                        <table class="mx-3 mb-3">
                            <tbody>
                                <tr>
                                    <td style="width: 100px">Nama</td>
                                    <td style="width: 10px">:</td>
                                    <td>..........................</td>
                                </tr>
                                <tr>
                                    <td>Nomor RM</td>
                                    <td>:</td>
                                    <td>..........................</td>
                                </tr>
                                <tr>
                                    <td>Umur</td>
                                    <td>:</td>
                                    <td>..........................</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>..........................</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="m-0">
                            Demikian pernyataan ini saya buat sebagai bukti
                            pelaksanaan pelayanan kerohanian di RSK Bedah
                            Ropanasuri.
                        </p>
                        <div class="row mt-5">
                            <div class="col-5 text-center">
                                <p class="m-0 mt-3">
                                    Pasien / Keluarga Pasien / Wali*
                                </p>
                                <br /><br /><br />
                                <p class="m-0">
                                    (...................................................................)
                                </p>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-1"></div>
                            <div class="col-5">
                                <p class="m-0">
                                    Padang, <span id="tanggal"></span>
                                </p>
                                <p class="m-0">Rohaniawan</p>
                                <br /><br /><br />
                                <p class="m-0">
                                    (...................................................................)
                                </p>
                            </div>
                        </div>
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
