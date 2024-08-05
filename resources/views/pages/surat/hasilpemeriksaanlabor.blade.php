<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Hasil Pemeriksaan Laboratorium</title>
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
                        <div class="border border-3 border-rounded py-2 px-2 fst-italic fw-bold text-secondary">
                          {{ $item->no_reg ?? '' }}
                        </div>
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
                                    <td class="fw-bold" style="width: 100px">Nama / No RM</td>
                                    <td class="fw-bold" style="width: 10px">:</td>
                                    <td>{{ $item->queue->patient->name ?? '' }} / {{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Tgl. Lahir</td>
                                    <td class="fw-bold">:</td>
                                    <td>{{ $item->queue->patient->tanggal_lhr ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">NIK</td>
                                    <td class="fw-bold">:</td>
                                    <td>{{ $item->queue->patient->nik ?? '' }}</td>
                                </tr>
                                <tr>
                                  <td class="fw-bold">Tanggungan</td>
                                  <td class="fw-bold">:</td>
                                  <td>{{ $item->queue->patientCategory->name ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                      
                    </div>
                    <div class="col-5">
                        <table class="table-content">
                            <tbody>
                              <tr>
                                <td class="fw-bold">Asal Ruangan</td>
                                <td class="fw-bold">:</td>
                                <td>{{ $item->queue->dpjp->poliklinik->name ?? '' }}</td>
                              </tr>
                                <tr>
                                  <td class="fw-bold">Diagnosa</td>
                                  <td class="fw-bold">:</td>
                                  <td>{{ $item->diagnosa ?? '' }}</td>
                                </tr>
                                <tr>
                                  @php
                                    $waktuStart = new DateTime($item->jadwal_periksa);
                                    $waktuEnd = new DateTime($item->tanggal_periksa_selesai);
                                  @endphp
                                    <td class="fw-bold">Tgl. Periksa</td>
                                    <td class="fw-bold">:</td>
                                    <td>{{ $waktuStart->format('Y/m/d') ?? '' }} - {{ $waktuEnd->format('Y/m/d') ?? '.......' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Tipe Permintaan</td>
                                    <td class="fw-bold">:</td>
                                    <td>
                                      <span class="{{ $item->tipe_permintaan == 'Urgent' ? 'badge bg-danger text-white' : '' }}">{{ $item->tipe_permintaan ?? '' }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                </div>

                <hr>
                <div class="row mt-2">
                  <div class="col-12">
                    <table class="table tex-nowrap">
                      <thead>
                        <tr class="table-primary">
                          <th>Kode</th>
                          <th>Nama</th>
                          <th class="text-center">Hasil</th>
                          <th class="text-center">Kritis</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($item->laboratoriumRequestDetails as $index => $detail)
                          <tr>
                            <td>
                              {{ $detail->action->action_code ?? '' }}
                            </td>
                            <td>{{ $detail->action->name ?? '' }}</td>
                            <td class="text-center">
                              {{ $detail->hasil ?? '' }} <span class="fw-bold small fst-italic">{{ $detail->satuan }}</span>
                            </td>
                            <td class="text-center">
                              {{ $detail->kritis == true ? 'Ya' : 'Tidak' }}
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="table-responsive mt-2">
                  <div class="border-bottom">
                    <h6 class="my-1 px-0 fw-bold">KESAN & ANJURAN</h6>
                  </div>
                  <div class="table-body fst-italic">
                    {{ $item->kesan_anjuran ?? '' }}
                  </div>
                </div>
            </div>
        </div>
    </body>
</html>
