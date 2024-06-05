<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>CPPT</title>
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
                        <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                    </div>
                    <div class="col-7 text-center">
                      <h1>CATATAN PERKEMBANGAN PASIEN <br> TERINTEGRASI (CPPT)</h1>
                    </div>
                    <div class="col-3">
                      <div class="border border-3 border-rounded py-4 px-5">
                      </div>
                    </div>
                </div>
            </div>

            <div class="content">
              <table class="table-bordered w-100 mt-4">
                <thead>
                  <tr class="text-center">
                    <th class="m-0">Tanggal <br> / Jam</th>
                    <th class="m-0">Profesional <br> Pemberi <br> Asuhan <br> (PPA)</th>
                    <th class="m-0">
                      Hasil Pemerikasaan, Analisa dan Tindak Lanjut <br> Subjective, Objective, Asesmen, Planning <br> (SOAP) / ADIME <br>
                      Tulis, Baca, Konfirmasi (TULBAKON) <br>
                    </th>
                    <th class="m-0">
                      Instruksi Tenaga <br>Kesehatan termasuk <br>pasca Bedah / Prosedur <br>
                    </th>
                    <th>
                      Review dan <br>Verifikasi DPJP <br>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($item->igdRmeCppts as $cppt)
                  @if ($cppt->changeLogs)
                    @foreach ($cppt->changeLogs as $change)
                    @php
                      $old_data = json_decode($change->old_data);
                      @endphp
                          <tr class="text-center text-danger" style="text-decoration: line-through;">
                            <td>{{ $old_data->tanggal ?? '' }}</td>
                            <td>{{ $change->user->name ?? '' }} ({{ $change->user->staff_id }})</td>
                            <td>{{ $old_data->soap ?? ''}}</td>
                            <td>{{ $old_data->intruksi ?? '' }}</td>
                            <td></td>
                          </tr>
                      @endforeach
                  @endif                      
                  <tr class="text-center">
                    <td>{{ $cppt->tanggal ?? ''}}</td>
                    <td>{{ $cppt->user->name ?? '' }} ({{ $cppt->user->staff_id ?? '' }})</td>
                    <td>{{ $cppt->soap ?? ''}}</td>
                    <td>{{ $cppt->intruksi }}</td>
                    <td></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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
