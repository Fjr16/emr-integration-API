<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Hasil Pemeriksaan Labor PK</title>
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
                /* height: 32.8cm; */
                /* min-height: 13.97cm; */
                padding: 10mm;
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

            .table-bordered {
                font-size: 8pt !important;
            }

            small {
                font-size: 6pt !important;
            }

            .p-1 {
                font-size: 10pt;
            }
            
            .table-content {
                font-size: 10pt !important;
            }
            /* td {
                padding-top: 5px;
            } */
            th {
                font-size: 10pt !important;
            }

            h6 {
                font-size: 10pt;
            }

            .borderhr {
                color: black;
                background-color: black;
                border-color: black;
                height: 5px;
                opacity: 100;
            }

            .header1 {
                margin: 0;
                font-size: 30px;
                font-weight: bold;
            }
            .header2 {
                margin: 0;
                font-size: 19px;
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
                    height: 32.8cm;
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
                        <h1 class="header1">LABORATORIUM KLINIK</h1>
                        <h1 class="header2">HASIL PEMERIKSAAN LABORATORIUM</h1>
                    </div>
                    <div class="col-3">
                        <div
                            class="border border-3 border-rounded py-4 px-5"
                        ></div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="content">
                <div class="row">
                    <div class="col-7">
                        <table class="table-content">
                            <tbody>
                                <tr>
                                    <td style="width: 100px">Nama Pasien</td>
                                    <td style="width: 10px">:</td>
                                    <td>{{ $item->queue->patient->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Tgl. Lahir</td>
                                    <td>:</td>
                                    <td>{{ $item->queue->patient->tanggal_lhr ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>No. MR</td>
                                    <td>:</td>
                                    <td>{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>:</td>
                                    <td>{{ $item->queue->patient->nik ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Diagnosa</td>
                                    <td>:</td>
                                    <td>{{ $item->laboratoriumRequest->diagnosa ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                      
                    </div>
                    <div class="col-5">
                        <table class="table-content">
                            <tbody>
                                <tr>
                                    <td style="width: 100px">No. Labor</td>
                                    <td style="width: 10px">:</td>
                                    <td>{{ $item->nomor_reg_lab ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Tgl. Periksa</td>
                                    <td>:</td>
                                    <td>{{ $item->tanggal_periksa ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggungan</td>
                                    <td>:</td>
                                    <td>{{ $item->queue->patientCategory->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Ruangan</td>
                                    <td>:</td>
                                    <td>{{ $item->laboratoriumRequest->ruang ?? '' }}</td>
                                </tr>
                                <tr>
                                  <td>Detail Ruangan</td>
                                  <td>:</td>
                                  <td>{{ $item->laboratoriumRequest->roomDetail->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Tipe Permintaan</td>
                                    <td>:</td>
                                    <td>{{ $item->laboratoriumRequest->laboratoriumRequestTypeMaster->name ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                </div>

                <div class="row">
                  @foreach ($dataCategoryPemeriksaan as $category)    
                    <div class="col-6">
                      <h6 class="m-0 mb-2 mt-4">{{ $category->name ?? '' }}</h6>
                      <table class="table-bordered w-100">
                        <tbody>
                            @foreach ($item->laboratoriumPatientResultDetails as $resultDetail)
                              @if ($resultDetail->laboratoriumRequestMasterVariable->laboratoriumRequestCategoryMaster)
                                @if ($resultDetail->laboratoriumRequestMasterVariable->laboratoriumRequestCategoryMaster->id == $category->id)   
                                <tr>
                                  <td class="text-center">{{ $loop->iteration }}</td>
                                  <td>{{ $resultDetail->laboratoriumRequestMasterVariable->name ?? '' }}</td>
                                  <td style="width: 100px" class="text-center">
                                    {{ $resultDetail->value ?? '' }}
                                  </td>
                                  @if ($resultDetail->laboratoriumRequestMasterVariable->laboratoriumRequestMasterDetails->isNotEmpty())
                                    <td>
                                      @foreach ($resultDetail->laboratoriumRequestMasterVariable->laboratoriumRequestMasterDetails as $detailMaster)
                                        @php
                                          $from = $detailMaster->from ?? '';
                                          $to = $detailMaster->to ?? '';
                                          $digitFrom = strlen((string) $detailMaster->from);
                                          $digitTo = strlen((string) $detailMaster->to);
                                          if ($digitFrom >= 4){
                                            $from = number_format($digitFrom);
                                          }
                                          if ($digitTo >= 4){
                                            $to = number_format($digitTo);
                                          }
                                        @endphp
                                        <small>
                                          ({{ $detailMaster->alias ? $detailMaster->alias .':' : '' }}{{ $from ?? '' }}-{{ $to ?? '' }} {{ $detailMaster->unit ?? '' }})
                                        </small> <br>
                                      @endforeach
                                    </td>
                                  @endif
                                </tr>
                                @endif  
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                  @endforeach
                </div>
                <div class="row">
                  <div class="col-6">
                    <table class="mt-3 table-bordered w-100">
                      <tbody>
                        <tr>
                          <td colspan="2">Kesan</td>
                          <td colspan="2">
                            {{ $item->kesan ?? '' }}
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2">Anjuran</td>
                          <td colspan="2">
                            {{ $item->anjuran ?? '' }}
                          </td>
                        </tr>
                      
                      </tbody>
                    </table>
                  </div>
                  <div class="col-6">
                    <table class="table-bordered w-100 mt-3">
                      <tbody>
                        <tr>
                          <td>Jam Pengambilan Sampel</td>
                          <td style="width: 150px">
                            {{ $item->tgl_pengambilan_sampel ?? ''  }}
                          </td>
                        </tr>
                        <tr>
                          <td>Jam Pemeriksaan Selesai</td>
                          <td>
                            {{ $item->tgl_pemeriksaan_selesai ?? ''  }}
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <h6 class="mt-3 m-0 text-decoration-underline">CATATAN PELAPORAN NILAI KRITIS</h6>
                    <table class="table-bordered w-100">
                      <tbody>
                        <tr>
                          <td style="width: 150px">Nilai Kritis</td>
                          <td>
                            @foreach ($item->laboratoriumPatientResultDetails as $detail)
                              @if ($detail->kondisi_kritis)
                                {{ $detail->laboratoriumRequestMasterVariable->name ?? '' }},
                              @endif
                            @endforeach
                          </td>
                        </tr>
                        <tr>
                          <td>Dilaporkan ke DPJP / Dokter Yang Membuat Permintaan</td>
                          <td>Jam : {{ $item->jam_pelaporan_kritis ?? '' }} &nbsp;&nbsp;&nbsp;Nama : {{ $item->laboratoriumRequest->user->name ?? '' }}</td>
                        </tr>
                      </tbody>
                    </table>

                    <div class="row mt-5">
                        <div class="col-4"></div>
                        <div class="col-8 text-center">
                            <p>Divalidasi Oleh</p>
                            <br><br><br>
                            @if ($item->laboratoriumUserValidator->user)
                            <p class="text-decoration-underline m-0">{{ $item->laboratoriumUserValidator->user->name ?? '' }}</p>
                            <p class="p-1 m-0">No. SIP : </p>
                            @else
                            <p class="fw-bold m-0 border border-dark">Menunggu Validasi</p>
                            @endif
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
