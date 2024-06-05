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
                    <img src="{{ asset('assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-7 d-flex align-self-center">
                    <h1 class="mx-auto">SURAT BUKTI PELAYANAN KESEHATAN</h1>
                </div>

            </div>
        </div>
        <!-- <hr class="m-0 p-0 mt-3" /> -->
        <div class="content border p-1 mt-4">
            <div class="row">
                <div class="col-8">
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <td style="width: 130px">Data Pasien</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $kemoterapiPatient->patient->name }}</td>
                            </tr>
                            <tr>
                                <td>No Rek. Medis</td>
                                <td>:</td>
                                <td>{{ implode('-', str_split(str_pad($kemoterapiPatient->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl Lahir</td>
                                <td>:</td>
                                <td>{{ $kemoterapiPatient->patient->tanggal_lhr }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ $kemoterapiPatient->jenis_kelamin ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Tgl Masuk RS</td>
                                <td>:</td>
                                <td>{{ $kemoterapiPatient->tanggal_masuk ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-4">
                    <div class="mx-3">
                        {{-- {{ $kemoterapiPatient->keterangan  ?? ''}} --}}
                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio" value="Kunjungan Awal"
                                id="defaultRadio1"
                                {{ $kemoterapiPatient->keterangan == 'Kunjungan Awal' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio1">
                                Kunjungan Awal
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio"
                                value="Kunjungan Lanjutan" id="defaultRadio2"
                                {{ $kemoterapiPatient->keterangan == 'Kunjungan Lanjutan' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio2">
                                Kunjungan Lanjutan
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio" value="Observasi"
                                id="defaultRadio3"
                                {{ $kemoterapiPatient->keterangan == 'Observasi' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio3">
                                Observasi
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio" value="Post Operasi"
                                id="defaultRadio4"
                                {{ $kemoterapiPatient->keterangan == 'Post Operasi' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio4">
                                Post Operasi
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-12 ">
                    <div class="mb-3 mt-3 border">
                        {{-- <label for="editor" class="form-label">Anamnesa</label> --}}
                        {!! $kemoterapiPatient->anamnesa ?? '' !!}
                    </div>
                </div>
            </div>
            <table class="table table-bordered mb-3">
                <thead>
                    <tr class="text-center">
                        <th>Poliklinik / Penunjang</th>
                        <th>Diagnosa</th>
                        <th>ICD X</th>
                        <th>Tindakan / Pemberi Penunjang</th>
                        <th>TTDS Nama Dokter / Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kemoterapiPatientDetail as $item)
                        <tr>
                            <td></td>
                            <td>{{ $item->diagnosa }}</td>
                            <td>{{ $item->icd }}</td>
                            <td>{{ $item->nama_tindakan }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table table-bordered mb-3">
                <thead>
                    <tr class="text-center">
                        <th class="text-body">Diagnosis</th>
                        <th class="text-body" style="width: 150px">
                            Kode ICD X
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Diagnosis Utama</td>
                        <td>{{ $kemoterapiPatient->icdx ?? '' }}</td>
                    </tr>
                    @foreach ($kemoterapiSekunderDiagnosis as $item)
                        <tr>
                            <td>Diagnosis Tambahan</td>
                            <td>{{ $item->diagnosa_icdx }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table table-bordered mb-3">
                <thead>
                    <tr class="text-center">
                        <th class="text-body">Tindakan / Prosedur</th>
                        <th class="text-body" style="width: 150px">
                            Kode ICD 9 CM
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tindakan Utama</td>
                        <td>{{ $kemoterapiPatient->icdg }}</td>
                    </tr>
                    @foreach ($kemoterapiSekunderAction as $item)
                        <tr>
                            <td>Tindakan Tambahan</td>
                            <td>{{ $item->action_icdg }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="row">
                <div class="col-7"></div>
                <div class="col-5 text-center">
                    <p class="m-0 p-0">Dokter Penanggung Jawab Pasien</p>
                    @if ($kemoterapiPatient->ttd_dpjp)
                        <img src="{{ Storage::url($kemoterapiPatient->ttd_dpjp ?? '') }}" alt="">
                    @else
                        <br /><br /><br /><br>
                    @endif

                    <small class="m-0">
                        ({{ $kemoterapiPatient->nama_dpjp ?? '............................................' }})
                        </small>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Mendapatkan tanggal saat ini
        var today = new Date();
        var options = {
            year: "numeric",
            month: "long",
            day: "numeric"
        };
        document.getElementById("tanggal").innerText =
            today.toLocaleDateString("id-ID", options);
    </script>
</body>

</html>
