<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Kwitansi</title>
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
            .content {
                font-size: 11pt;
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
                font-size: 11pt !important;
            }
            td {
                font-size: 11pt;
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
                font-size: 18px;
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
                        <img src="{{ asset ('assets/img/logo.png') }}" alt="" />
                    </div>
                    <div class="col-7 d-flex align-self-center">
                        <h1 class="mx-auto">KWITANSI PEMBAYARAN FARMASI</h1>
                    </div>
                    <div class="col-3">
                        <div
                            class="border border-3 border-rounded py-4 px-5"
                        ></div>
                    </div>
                </div>
            </div>
            <!-- <hr class="m-0 p-0 mt-3" /> -->
            <div class="content border p-1 mt-4">
                <div class="row">
                    <div class="col-6">
                        <table class="w-100 fw-bold">
                            <tr>
                                <td style="width: 100px">No. Resep</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $item->no_faktur ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>No. RM</td>
                                <td>:</td>
                                <td>{{ $item->patient->no_rm ?? '' }}</td>
                                
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $item->patient->name ?? '' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="w-100 fw-bold">
                            <tr>
                                <td style="width: 100px"></td>
                                <td style="width: 20px"></td>
                                {{-- <td>{{ $item->rajalFarmasiPatient->rawatJalanPatient->queue->doctorPatient->user->poli->name ?? '' }}</td> --}}
                                <td></td>
                            </tr>
                            <tr>
                                <td>Dokter</td>
                                <td>:</td>
                                <td>{{ $item->rajalFarmasiPatient->rawatJalanPatient->queue->doctorPatient->user->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Tanggungan</td>
                                <td>:</td>
                                <td>{{ $item->rajalFarmasiPatient->rawatJalanPatient->queue->patientCategory->name ?? '' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12">
                        <table class="w-100 table mt-3">
                            <thead class="fw-bold">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>No Batch</th>
                                    <th>QTY</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                    {{-- <th>Tanggungan</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->rajalFarmasiObatDetails->where('patient_category_id', $tanggunganUmum->id) as $obat)    
                                {{-- @foreach ($item->rajalFarmasiObatDetails as $obat)     --}}
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $obat->medicine->name ?? '' }}</td>
                                    <td>{{ $obat->medicineStok->no_batch ?? '' }}</td>
                                    <td>{{ number_format($obat->jumlah ?? '') }}</td>
                                    <td>{{ number_format($obat->harga_satuan ?? '') }}</td>
                                    <td>{{ number_format($obat->total_harga ?? '') }}</td>
                                    {{-- <td>{{ $obat->unitCategoryPivot->name ?? '' }}</td> --}}
                                </tr>
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-center">Total Akhir</td>
                                    <td>{{ number_format($item->rajalFarmasiObatDetails->where('patient_category_id', $tanggunganUmum->id)->sum('total_harga') ?? '') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-7"></div>
                    <div class="col-5 text-center">
                        <p class="m-0 p-0">Petugas Farmasi</p>
                        <br /><br /><br />
                        <p class="m-0 p-0">{{ $item->user->name ?? '' }}</p>
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
