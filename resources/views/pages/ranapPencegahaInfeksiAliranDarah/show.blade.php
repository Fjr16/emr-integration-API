<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>RSKB | {{$title}}</title>
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
                width: 210mm;
                height: 330mm;
                min-height: 13.97cm;
                padding: 13mm;
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

            tr th {
                font-size: 10pt;
            }
            tr td {
                font-size: 10pt;
            }
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
                font-size: 12pt;
                font-weight: bold;
            }

            .content {
                font-size: 10pt;
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
                <div class="row">
                    <div class="col-2">
                        <img src="{{asset('assets/img/logo.png')}}" alt="" />
                    </div>
                    <div class="col-9 d-flex align-self-center">
                        <h1 class="mx-auto text-center">
                            PENERAPAN BUNDLES PENCEGAHAN INFEKSI RUMAH SAKIT
                            (HAIs)
                            <br />
                            INFEKSI ALIRAN DARAH (IAD) PERIFER / PLEBITIS
                        </h1>
                    </div>
                    <div class="col-3">
                        <!-- <div
                            class="border border-3 border-rounded py-4 px-5"
                        ></div> -->
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="row mt-4">
                    <div class="col-6">
                        @php
                            $formatId = Carbon\Carbon::parse($data->tanggal);
                        @endphp
                        <p class="fw-bold m-0">
                            Bulan : {{$formatId->isoformat('MMM Y') ?? '.......................'}}
                        </p>
                    </div>
                    <div class="col-auto">
                        <p class="fw-bold m-0">
                            Ruangan/Instansi/Satuan Kerja : {{$data->roomDetail->name ?? '..............'}}
                        </p>
                    </div>
                </div>
                <table class="table-bordered w-100">
                    <!-- table header -->
                    <tr class="fw-bold">
                        <td colspan="2" class="text-center">Tanggal</td>
                        <td colspan="2" class="text-center">{{$formatId->isoformat('D MMM Y') ?? ''}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="text-center fw-bold">
                        <td rowspan="2">No</td>
                        <td rowspan="2">Pheriperal Line</td>
                        <td colspan="2">1</td>
                        <td rowspan="2">TDD*</td>
                        <td rowspan="2">Ket</td>
                    </tr>
                    <tr class="fw-bold">
                        <td class="text-center">Y</td>
                        <td class="text-center">T</td>
                    </tr>

                    <!-- sub kategori -->
                    @foreach ($details as $detail)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td>{{$detail->nama ?? ''}}</td>
                            <td class="text-center">{{$detail->status == 'Y' ? '✓' : ''}}</td>
                            <td class="text-center">{{$detail->status == 'T' ? '✓' : ''}}</td>
                            <td class="text-center">{{$detail->status == 'TDD' ? '✓' : ''}}</td>
                            <td class="text-center">{{$detail->ket ?? ''}}</td>
                        </tr>
                    @endforeach

                    <!-- inisial perawat paling bawah -->
                    <tr>
                        <td></td>
                        <td>Inisian Perawat</td>
                        <td colspan="2">{{$data->user->name ?? ''}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                <div class="row mt-2">
                    <div class="col-8 fw-bold">
                        <p class="m-0 fst-italic">Keterangan</p>
                        <p class="m-0">Y : YA &emsp; T : TIDAK</p>
                        <p class="m-0">*) TDD : Tidak Dapat Dinilai</p>
                    </div>
                    <div class="col-4 text-center fw-bold">
                        <p>PPJA/IPCLN</p>
                        <img src="{{Storage::url($data->user->paraf)}}" alt="" width="70px">
                        <p>({{$data->user->name ?? '..................'}})</p>
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
