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
                        <h1 class="mt-2">PERMINTAAN PELAYANAN KEROHANIAN</h1>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>

            <div class="content">
                 <!-- FORM PENYAMPAIAN KELUHAN -->
        <div class="row border-end border-start border-top mt-3">

            <div class="col-12 text-uppercase text-center pt-2 border-bottom" colspan="3" style="font-size: 10pt;  background-color: #eeebeb;">
                    PENYAMPAIN KOMPLAIN / KELUHAN
            </div>

            <div class="col-7">
               <p>Nama Pasien / Pengunjung <span>:</span> <span>...............................................</span></p>
            </div>
            <div class="col-2">
                <p>No. <span>:</span> ..........</p>
            </div>
            <div class="col-7">
               <p>No. Telp / HP <span>:</span> <span>......................................................................</span></p>
            </div>
            <div class="col-2">
                <p>Masalah<span>:</span></p>
            </div>
            <div class="col-1">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Baru
                    </label>
                </div>
            </div>
            <div class="col-1">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Lama
                    </label>
                </div>
            </div>

            <div class="col-12">
               <p>Tanggal/Jam Komplain <span>:</span> <span>.....................................................</span></p>
            </div>
            <div class="col-12">
               <p>Ruangan / Bagian <span>:</span> <span>............................................................</span></p>
            </div>


         <div class="col-12">
            <p>Uraian Penyampaian Komplain / Keluhan :</p>
           <p>...............................................................................................................................................................................</p>
           <p>...............................................................................................................................................................................</p>
           <p>...............................................................................................................................................................................</p>
           <p>...............................................................................................................................................................................</p>
           <p>...............................................................................................................................................................................</p>
           <p>...............................................................................................................................................................................</p>
           <p>...............................................................................................................................................................................</p>


         </div>

        <!-- TTD -->
        <div class="row d-flex justify-content-end">


            <div class="col-6 pt-3 text-center">
                <p>*Pasien / Keluarga / Pangunjung</p>
                <p class="mt-5">( ....................................... )</p>

            </div>

        </div>

        </div>

        <!-- GRAADING -->
        <div class="row border-end border-start ">
            <div class="col-12 text-uppercase text-center border-top border-bottom my-2" colspan="3"
                style="font-size: 10pt;  background-color: #eeebeb;">
                GRADING
            </div>
            <!-- TABLE -->
            <div class="col-11 mx-auto mt-2">
                <table class="table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Tingkat</th>
                            <th scope="col">Kriteria</th>
                            <th scope="col">Grading Komplain(V)</th>

                        </tr>
                    </thead>
                    <tbody >
                        <tr>
                            <th scope="row" class="p-4 text-center bg-success">Rendah</th>
                            <td valign="top">Tidak menimbulkan kerugian berarti baik material maupun immaterial.</td>
                            <td valign="top"></td>
                        </tr>
                        <tr>
                            <th scope="row" class="p-4 text-center bg-warning">Tinggi</th>
                            <td valign="top">Cenderung berhubungan dengan pemberitaan media, potensi kerugian immaterial, dan Lain-lain</td>
                            <td valign="top"></td>

                        </tr>
                        <tr>
                            <th scope="row " class="p-4 text-center " style="background-color: rgb(238, 70, 70);">Ekstrim</th>
                            <td valign="top">Cenderung berhubungan dengan polisi, pengadilan, kematian, mengancam sistem/kelangsungan organisasi, potensi kerugian
                            material, dan lain-lain</td>
                            <td valign="top"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- TTD -->
            <div class="row d-flex justify-content-end">


                <div class="col-6 pt-3 text-center">
                    <p>Yang Melakukan Grading</p>
                    <p class="mt-5">( ....................................... )</p>

                </div>

            </div>
        </div>


        <!-- PENYELESAIAN KOMPLAIN -->
        <div class="row border-end border-start border-bottom">
            <div class="col-12 text-uppercase text-center border-top border-bottom my-2" colspan="3"
                style="font-size: 10pt;  background-color: #eeebeb;">
                PENYELESAIAN KOMPLAIN / KELUHAN
            </div>

            <!-- ISI DAN TTD -->
            <div class="row d-flex justify-content-end">

            <div class="col-12">
                <p>Dengan ini menyatakan bahwa saya telah menerima informasi mengenai proses penyampaian komplain / keluhan serta
                dilibatkan dalam proses penyelesaiannya</p>
            </div>
                <div class="col-6 pt-3 text-center">
                    <p>*Pasien / Keluarga / Pangunjung</p>
                    <p class="mt-5">( ....................................... )</p>

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
