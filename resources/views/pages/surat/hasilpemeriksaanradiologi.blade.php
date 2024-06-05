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
                        <div
                            class="border border-3 border-rounded py-4 px-5"
                        ></div>
                    </div>
                </div>
            </div>
            <hr class="m-0 mt-3 mb-3">
            <div class="content">
               <table>
                <tr>
                    <td style="width: 200px">Nama</td>
                    <td style="width: 20px">:</td>
                    <td class="fw-bold">{{ $item->radiologiPatient->queue->patient->name ?? '' }}</td>
                </tr>
                <tr>
                    <td>Usia</td>
                    <td>:</td>
                    @php
                        $lahir = $item->radiologiPatient->queue->patient->tanggal_lhr;
                        list($thnL, $blnL, $tglL) = explode('-', $lahir);
                        list($thnS, $blnS, $tglS) = explode('-', $today);

                        $usia = $thnS - $thnL;
                        if($blnS < $blnL || ( $blnS == $blnL && $tglS < $tglL)){
                            $usia--;
                        }

                    @endphp
                    <td>{{ $usia ?? '' }} Tahun</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $item->radiologiPatient->queue->patient->jenis_kelamin ?? '' }}</td>
                </tr>
                <tr>
                    <td>No. RM</td>
                    <td>:</td>
                    <td>{{ $item->radiologiPatient->queue->patient->no_rm ?? '' }}</td>
                </tr>
                <tr>
                    <td>No. Pemeriksaan</td>
                    <td>:</td>
                    <td>{{ $item->nomor ?? '' }}</td>
                </tr>
                <tr>
                    <td>Tgl. ({{ $item->radiologiFormRequestDetail->radiologiFormRequestMaster->name ?? '' }})</td>
                    <td>:</td>
                    <td>{{ $item->tanggal ?? ''}}</td>
                </tr>
                <tr>
                    <td>Jenis Pemeriksaan</td>
                    <td>:</td>
                    <td>{{ $item->radiologiFormRequestDetail->radiologiFormRequestMaster->name ?? '' }}</td>
                </tr>
               </table>
               <hr class="m-0 mt-2 mb-2">
               <p class=" fst-italic">Teman Sejawat Yth,</p>
               <h5 class="fw-bold">{{ $item->radiologiFormRequestDetail->radiologiFormRequestMaster->name ?? '' }} :  {{ $item->radiologiFormRequestDetail->value ? $item->radiologiFormRequestDetail->value : $item->radiologiFormRequestDetail->radiologiFormRequestMasterDetail->name ?? '' }}</h5>

                {!! $item->hasil ?? '' !!}

               <p class=" fst-italic">Terima kasih atas kerja samanya.</p>         
               <p class="m-0">Padang, <span id="tanggal"></span></p>
               <br><br><br>
               @if ($item->radiologiPatient->user) 
               <p class="m-0 text-decoration-underline">{{ $item->radiologiPatient->user->name ?? '' }}</p>
               <p class="m-0">(
                   @foreach ($item->radiologiPatient->user->specialists as $spesialis)
                        {{ $spesialis->name ?? '' }},
                    @endforeach
                )</p>
                @else
                <p class="fw-bold m-0 border border-dark">Menunggu Validasi</p>
               @endif
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
