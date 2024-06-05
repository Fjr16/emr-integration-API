<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Permintaan Pelayanan Kerohanian</title>
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
                /* height: 29.7cm; */
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
                        <h1 class="mt-2">LAPORAN PASIEN MELARIKAN DIRI</h1>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>

            <div class="content">
                <div class="row mt-4 py-2   border">

                    <div class="col-12 border-bottom">

                        <p>No RM <span style="padding-left: 4.3rem;">:</span></p>

                    </div>
                    <div class="col-12 border-bottom">
                        <p>Nama <span style="padding-left: 5rem;">:</span></p>
                    </div>
                    <div class="col-12 border-bottom">
                        <p>Tanggal Lahir <span style="padding-left: 1.8rem;">:</span></p>

                    </div>
                    <div class="col-12 border-bottom">
                        <p>Alamat <span style="padding-left: 4.5rem;">:</span></p>

                    </div>
                    <div class="col-12 border-bottom">
                        <p>Ruang Perawatan <span style="padding-left: 4.5rem;">:</span></p>

                    </div>
                    <div class="col-12 border-bottom">
                        <p>Tanggal Masuk Rumah Sakit <span style="padding-left: 4.5rem;">:</span></p>

                    </div>
                    <div class="col-12 border-bottom">
                        <p>Tanggal Kejadian </p>

                    </div>
                    <div class="col-12 " style="padding-bottom: 8rem;">

                        <p style="font-size: small;">RINGKASAN KEJADIAN <span style="padding-left: 3rem;">:</span></p>


                    </div>
                    <div class="col-12 border-bottom pb-2">
                        <div class="row">
                            <div class="col-5 ">

                                <p style="font-size: small;">MEMBAHAYAKAN DIRI/ LINGKUNGAN <span
                                        style="padding-left: 1rem; ">:</span></p>


                            </div>
                            <div class="col-2 ">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ya
                                    </label>
                                </div>


                            </div>
                            <div class="col-2 ">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row ">


                        <div class="col-6 pt-3 text-center">
                            <p class="mt-5">Mengetahui</p>
                            <p>Ka.Instalasi ................................</p>
                            <p class="mt-5">( ....................................... )</p>
                            <p>NIP.</p>
                        </div>
                        <div class="col-6 pt-3 text-center">
                            <p>Padang ................ 20 .......</p>
                            <p class="pt-3">Yang Melaporkan</p>
                            <p style="margin-top: 5rem;">( ....................................... )</p>
                            <p>NIP.</p>
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
