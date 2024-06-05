<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CPPT</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" />
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
      height: max-content;
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
          @foreach ($item->cpptKemoterapi as $cppt)
          @php
            $soap = str_replace(['|', ',', '&nbsp;'], '', $cppt->soap);
          @endphp
          <tr>
            <td class="text-center">{{ $cppt->created_at->format('Y-m-d / H:i:s') ?? ''}}</td>
            <td class="text-center">{{ $cppt->user->name ?? '' }} ({{ $cppt->user->staff_id ?? '' }})</td>
            <td class="p-2">
              {!! $soap ?? '' !!}

              @if ($cppt->tipe_cppt == 'SBAR')
                <table class="table">
                  <thead class="text-nowrap">
                    <th class="text-body">
                        {{ $cppt->tipe_cppt}}
                    </th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        {{-- tanda tangan PPA --}}
                        @if ($cppt->ttd_user)
                          Dibuat oleh {{ $cppt->user->roles()->first()->name ?? '' }} <span class="fw-bold">({{ $cppt->user->name }})</span> pada <span class="fw-bold">{{ $cppt->created_at->format('d M Y') }}</span> 
                          <img src="{{ Storage::url($cppt->ttd_user) }}" alt="" class="img-thumbnail">
                        @else
                            <span class="fw-bold border">MENUNGGU VALIDASI PPA</span><br>
                        @endif
                      </td>
                      <td>
                        {{-- VALIDASI DPJP --}}
                        @if ($cppt->ttd_dpjp)
                          @php
                            $tanggalValidasiDpjp = Carbon\Carbon::parse($cppt->tanggal_dpjp);
                          @endphp
                          <span>Divalidasi oleh DPJP  <span class="fw-bold">({{ $cppt->rawatInapPatient->ranapDpjpPatientDetails->where('user_id', $cppt->id_dpjp)->first()->user->name ?? '' }})</span> pada <span class="fw-bold">{{ $tanggalValidasiDpjp->format('d M Y') }}</span>
                            <img src="{{ Storage::url($cppt->ttd_dpjp) }}" alt="" class="img-thumbnail">
                        @else
                            <span class="fw-bold border">MENUNGGU VALIDASI DPJP</span>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              @endif

              {{-- alih rawat --}}
              @if ($cppt->tipe_cppt == 'ALIH RAWAT')
                <h6>{{ $cppt->tipe_cppt}}</h6>
                <table class="table">
                  <thead class="text-nowrap">
                    <th class="text-body">DPJP</th>
                    <th class="text-body">DPJP Mendatang</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        {{-- tanda tangan DPJP --}}
                        @if ($cppt->ttd_user)
                          Dibuat oleh <span class="fw-bold">({{ $cppt->user->name }})</span> pada <span class="fw-bold">{{ $cppt->created_at->format('d M Y') }}</span> 
                          <img src="{{ Storage::url($cppt->ttd_user) }}" alt="" class="img-thumbnail">
                        @else
                            <span class="fw-bold border">MENUNGGU VALIDASI DPJP SAAT INI</span><br>
                        @endif
                      </td>
                      <td>
                        @if ($cppt->ranapCpptAlihRawatPatient)     
                          @if ($cppt->ranapCpptAlihRawatPatient->ttd_user)
                            @php
                              $tanggalValidasiDpjpTujuan = Carbon\Carbon::parse($cppt->ranapCpptAlihRawatPatient->tanggal);
                            @endphp
                            <span>Dikonfirmasi oleh <span class="fw-bold">({{ $cppt->ranapCpptAlihRawatPatient->user->name }})</span> pada <span class="fw-bold">{{ $tanggalValidasiDpjp->format('d M Y') }}</span>
                              <img src="{{ Storage::url($cppt->ranapCpptAlihRawatPatient->ttd_user) }}" alt="" class="img-thumbnail">
                          @else
                              <span class="fw-bold border">MENUNGGU KONFIRMASI DOKTER TUJUAN</span>
                          @endif
                        @else
                          <span class="fw-bold border">DATA ALIH RAWAT TIDAK DITEMUKAN</span>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              @endif
            </td>
            <td class="p-2">{!! $cppt->intruksi !!}</td>
            <td>
                @if ($cppt->ranapCpptSbarPatient)
                  <img src="{{ Storage::url($cppt->ranapCpptSbarPatient->ttd ?? '') }}" alt="" class="img-thumbnail">
                  <span class="text-center">
                    ({{ $cppt->ranapCpptSbarPatient->user->name ?? '' }}) <br>
                    @php
                      $tanggal = Carbon\Carbon::parse($cppt->ranapCpptSbarPatient->tanggal ?? '');
                    @endphp
                    {{ $tanggal->format('d M Y') }} 
                  </span>
                @else
                  <span class="fw-bold">MENUNGGU VERIFIKASI DPJP</span>
                @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</body>

</html>