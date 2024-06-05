<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Second Opinion</title>
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
                        <h1 class="mt-3">
                            PELAKSANAAN PENDAPAT LAIN <br />
                            (SECOND OPINION)
                        </h1>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>

            <div class="content">
                <p class="m-0 mt-5">Saya yang bertanda tangan dibawah ini :</p>
                <table class="mx-3 mb-3">
                    <tbody>
                        <tr>
                            <td style="width: 100px">Nama</td>
                            <td style="width: 10px">:</td>
                            <td>..........................</td>
                        </tr>
                        <tr>
                            <td>NIK</td>
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
                    Selaku (Pasien / Keluarga / Wali)
                    <span class="fw-bold">Nama Pasien</span> dengan ini
                    menyatakan dengan sadar dan sesungguhnya bahwa :
                </p>
                <ol>
                    <li>
                        Telah menerima dan memahami informasi mengenai kondisi
                        terhadap diri saya / pasien dan tindakan penanganan awal
                        telah dilakukan dari pihak Rumah Sakit.
                    </li>
                    <li>
                        Telah menerima informasi mengenai kondisi pasien
                        (informasi hasil pemeriksaan, diagnosis, rekomendasi
                        terapi, dsb).
                    </li>
                    <li>
                        Meminta kepada Rumah Sakit untuk diberikan kesempatan
                        mencari Pendapat Lain (second opinion) terhadap
                        alternatif diagnosis/ pengobatan diri saya/ pasien ke
                        dokter ......................................... di
                        Rumah Sakit
                        .......................................................
                    </li>
                    <li>
                        Segala pembiayaan terkait dengan kelengkapan dokumen dan
                        fasilitas lainnya dalam proses Pendapat Lain (second
                        opinion) adalah tanggung jawab saya dan keluarga
                    </li>
                    <li>
                        Untuk keperluan tersebut diatas, saya / pasien /
                        meminjam hasil pemeriksaan penunjang kesehatan
                        <ol type="a">
                            <li>
                                .........................................................................................................................................................................
                            </li>
                            <li>
                                .........................................................................................................................................................................
                            </li>
                            <li>
                                .........................................................................................................................................................................
                            </li>
                        </ol>
                    </li>
                </ol>
                <p class="m-0">
                    Demikian pernyataan ini saya buat dengan sesungguhnya untuk
                    diketahui dan digunakan sebagaimana perlunya
                </p>
                <div class="row mt-5">
                    <div class="col-8 text-center">
                        <p class="m-0">Saksi</p>
                    </div>

                    <div class="col-4">
                        <p class="m-0">Padang, <span id="tanggal"></span></p>
                    </div>

                    <div class="col-4 text-center">
                        <p class="m-0">Pihak Keluarga</p>
                        <br /><br /><br /><br />
                        <p>Nama Pihak Keluarga</p>
                    </div>
                    <div class="col-4 text-center">
                        <p class="m-0">Pihak Rumah Sakit</p>
                        <br /><br /><br /><br />
                        <p>Nama Pihak Rumah Sakit</p>
                    </div>
                    <div class="col-4 text-center">
                        <p class="m-0">Yang Menyatakan</p>
                        <br /><br /><br /><br />
                        <p>Nama Yang Menyatakan</p>
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
