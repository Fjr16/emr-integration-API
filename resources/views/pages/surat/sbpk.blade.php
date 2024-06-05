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
                                <td>{{ $item->queue->patient->name }}</td>
                            </tr>
                            <tr>
                                <td>No Rek. Medis</td>
                                <td>:</td>
                                <td>{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl Lahir</td>
                                <td>:</td>
                                <td>{{ $item->queue->patient->tanggal_lhr }}</td>
                            </tr>
                            <tr>
                                <td>Jam Keluar</td>
                                <td>:</td>
                                <td>{{ $item->jam_keluar ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Tgl Masuk RS</td>
                                <td>:</td>
                                <td>{{ $item->tanggal_masuk ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-4">
                    <div class="mx-3">
                        {{-- {{ $surat->keterangan  ?? ''}} --}}
                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio" value="Kunjungan Awal"
                                id="defaultRadio1" style="pointer-events: none;"
                                {{ ($item->keterangan ?? '') == 'Kunjungan Awal' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio1">
                                Kunjungan Awal
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio"
                                value="Kunjungan Lanjutan" id="defaultRadio2" style="pointer-events: none;"
                                {{ ($item->keterangan ?? '') == 'Kunjungan Lanjutan' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio2">
                                Kunjungan Lanjutan
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio" value="Observasi"
                                id="defaultRadio3" style="pointer-events: none;"
                                {{ ($item->keterangan ?? '') == 'Observasi' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio3">
                                Observasi
                            </label>
                        </div>
                        <div class="form-check">
                            <input name="default-radio-1" class="form-check-input" type="radio" value="Post Operasi"
                                id="defaultRadio4" style="pointer-events: none;"
                                {{ ($item->keterangan ?? '') == 'Post Operasi' ? 'checked' : '' }} />
                            <label class="form-check-label" for="defaultRadio4">
                                Post Operasi
                            </label>
                        </div>

                        <div class="mb-3">
                            <p class="m-0 p-0">Berat Lahir / BB : {{ $item->berat ?? '' }} Kg</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="editor" class="form-label">Anamnesa</label>
                        {!! $item->anamnesa ?? '' !!}
                    </div>
                </div>
            </div>
            <table class="table table-bordered mb-3">
                <thead>
                    <tr class="text-center">
                        <th>Poliklinik / Penunjang</th>
                        <th>Diagnosa</th>
                        <th>ICDX</th>
                        <th>Tindakan / Pemberi Penunjang</th>
                        <th>TDT Nama Dokter / Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item->suratBuktiPelayananPatientDetails as $suratDetail)
                        <tr>
                            <td>{{ $suratDetail->poliklinik ?? ' ' }}</td>
                            <td>{{ $suratDetail->diagnosa ?? '' }}</td>
                            <td>{{ $suratDetail->icd ?? '' }}</td>
                            <td>{{ $suratDetail->nama_tindakan ?? '' }}</td>
                            <td><img src="{{ Storage::url($suratDetail->tdt ?? '') }}" alt=""
                                    style="width: 100px">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-6">
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <td style="width: 80px">Konsultasi</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $item->konsultasi ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>USG</td>
                                <td>:</td>
                                <td>{{ $item->usg ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <table class="w-100 mb-3">
                        <tbody>
                            <tr>
                                <td style="width: 80px">Tindakan</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $item->tindakan ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Rontgen</td>
                                <td>:</td>
                                <td>{{ $item->rontgen ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <table class="table table-bordered mb-3">
                <thead>
                    <tr class="text-center">
                        <th class="text-body">Diagnosis</th>
                        <th class="text-body" style="width: 100px">
                            Kode ICDX
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Diagnosis Utama</td>
                        <td>{{ $item->icdx ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Diagnosis Tambahan</td>
                        <td>...</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered mb-3">
                <thead>
                    <tr class="text-center">
                        <th class="text-body">Tindakan / Prosedur</th>
                        <th class="text-body" style="width: 100px">
                            Kode ICDX
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tindakan Utama</td>
                        <td>{{ $item->icdg ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Tindakan Tambahan</td>
                        <td></td>
                    </tr>
                    @foreach ($item->suratBuktiPelayananSekunderActions as $suratSekunderAction)
                        <tr>
                            <td>{{ $suratSekunderAction->action_name ?? '' }}</td>
                            <td>{{ $suratSekunderAction->action_icdg ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-7"></div>
                <div class="col-5 text-center">
                    <p class="m-0 p-0">Dokter Penanggung Jawab Pasien</p>
                    <img src ="{{ Storage::url($item->ttd_dokter) }} " alt="" width="100">
                    <p class="m-0 p-0">{{ $item->nama_dokter }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="page">
        <div class="header">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-7 d-flex align-self-center">
                    <h1 class="mx-auto">SURAT KETERANGAN</h1>
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
                                <td style="width: 180px">Nama Pasien</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $suratKeterangan->queue->patient->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td>:</td>
                                @php
                                    $tanggal_lahir = $suratKeterangan->queue->patient->tanggal_lhr ?? null;
                                    $umur = '';
                                    if ($tanggal_lahir) {
                                        $tanggal_lahir = \Carbon\Carbon::parse($tanggal_lahir);
                                        $sekarang = \Carbon\Carbon::now();
                                        $tahun = $sekarang->diffInYears($tanggal_lahir);
                                        $bulan = $sekarang->copy()->subYears($tahun)->diffInMonths($tanggal_lahir);
                                        $umur = $tahun . ' tahun ' . $bulan . ' bulan';
                                    }
                                @endphp
                                <td>{{ $umur }}</td>
                            </tr>
                            <tr>
                                <td>No Rek. Medis</td>
                                <td>:</td>
                                <td>{{ implode('-', str_split(str_pad($suratKeterangan->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                </td>
                            </tr>

                            <tr>
                                <td>Diagnosa</td>
                                <td>:</td>
                                <td>{{ $suratKeterangan->diagnosa ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Terapi</td>
                                <td>:</td>
                                <td>{{ $suratKeterangan->terapi ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Surat Rujukan</td>
                                <td>:</td>
                                <td>{{ $suratKeterangan->tgl_surat_rujukan ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="editor" class="form-label">Belum dapat di kembalikan ke fasilitas perujuk dengan
                            alasan :</label>
                        <p>1. {{ $suratKeterangan->fasilitas_rujukan ?? '' }}</p>
                        <p>2. {{ $suratKeterangan->fasilitas_rujukan_lainnya ?? '' }}</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="editor" class="form-label">Rencana tindak lanjut akan dilakukan pada kunjungan
                            selanjutnya :</label>
                        <p>1. {{ $suratKeterangan->tindak_lanjut ?? '' }}</p>
                        <p>2. {{ $suratKeterangan->tindak_lanjut_lainnya ?? '' }}</p>
                    </div>
                </div>
                <div class="col-12">
                    <table class="w-100">
                        <tbody>
                            <label for="editor" class="form-label">Rencana tindak lanjut akan dilakukan pada
                                kunjungan
                                selanjutnya :</label>
                            <tr>
                                <td style="width: 180px">Pada Tanggal</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $suratKeterangan->tgl_kunjungan ?? '' }}</td>
                            </tr>
                            <tr>
                                <td style="width: 180px">Nomor Antrian</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $suratKeterangan->nomor_antrian ?? '' }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-6">
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <td class="text-center" style="padding-bottom: 123px;">Perawat Pendamping</td>
                            </tr>
                            <tr>
                                <td class="text-center" style="padding-top: 10px;">...................................
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <table class="w-100">
                        <table class="w-100">
                            <tbody>
                                <tr>
                                    <td class="text-center" style="padding-bottom: 100px;">Padang,
                                        {{ date('d-M-Y') }} <br>
                                        Nama jelas dan tanda tangan
                                        Dokter yang memeriksa</td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="padding-top: 10px;">
                                        ...................................
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
            <hr>

            <div class="row mt-5">
                <div class="col-6">
                    <h6>LEMBAR KONTROL ULANG PASIEN
                    </h6>
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <td>Nama Pasien</td>
                                <td>:</td>
                                <td>{{ $item->queue->patient->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>No Rekam Medis</td>
                                <td>:</td>
                                <td>{{ implode('-', str_split(str_pad($suratKeterangan->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Nomor Antrian</td>
                                <td>:</td>
                                <td>{{ $suratKeterangan->nomor_antrian ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Kontrol</td>
                                <td>:</td>
                                <td>{{ $suratKeterangan->tgl_kunjungan ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <table class="w-100">
                        <table class="w-100">
                            <tbody>
                                <tr>
                                    <td class="text-center" style="padding-bottom: 100px;">Petugas Rekam medis
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="padding-top: 10px;">
                                        ...................................
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
