<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RINGKASAN MASUK DAN KELUAR</title>
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
            /* height: 29.7cm; */
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
                /* height: 29.7cm; */
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
                <div class="col-7 text-center">
                    <h1>RINGKASAN MASUK DAN KELUAR</h1>
                </div>
                <div class="col-3">
                    <!-- <div
                            class="border border-3 border-rounded py-4 px-5"
                        ></div> -->
                </div>
            </div>
        </div>

        <table class="mx-auto table table-bordered w-100 mt-3 m-0">
            <tr>
                <td colspan="2">
                    <div class="d-flex justify-content-between align-items-center gap-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="m-0" style="min-width: 100px">
                                Tgl. Masuk
                                {{ Carbon\Carbon::parse($data->tanggal_masuk)->isoformat('D MMM Y') ?? '..........' }}
                                , Jam {{ Carbon\Carbon::parse($data->jam_masuk)->format('H:i') ?? '..........' }}
                            </p>
                            <p class="m-0" style="min-width: 100px">
                                . Tgl. Keluar
                                {{ Carbon\Carbon::parse($data->tanggal_keluar)->isoformat('D MMM Y') ?? '..........' }}
                                , Jam {{ Carbon\Carbon::parse($data->jam_keluar)->format('H:i') ?? '..........' }}
                            </p>
                            <p class="m-0" style="min-width: 100px">
                                . Lama Dirawat {{ $total ?? '..........' }} hari
                            </p>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="w-50">
                    <div class="row m-0">
                        <p>Pendidikan Terakhir :
                            @if (
                                $data->pendidikan_terakhir == 'TIDAK SEKOLAH' ||
                                    $data->pendidikan_terakhir == 'PAUD' ||
                                    $data->pendidikan_terakhir == 'TK')
                                {{ $data->pendidikan_terakhir }}
                            @endif
                        </p>
                        <table>
                            <tr>
                                <td>
                                    <input disabled type="checkbox" class="form-check-input mx-2" value="SD"
                                        {{ $data->pendidikan_terakhir == 'SD' ? 'checked' : '' }} />SD
                                </td>
                                <td>
                                    <input disabled type="checkbox" class="form-check-input mx-2" value="SMP"
                                        {{ $data->pendidikan_terakhir == 'SMP / MTS / SLTP SEDERAJAT' ? 'checked' : '' }} />SMP
                                </td>
                                <td>
                                    <input disabled type="checkbox" class="form-check-input mx-2" value="SMA"
                                        {{ $data->pendidikan_terakhir == 'SMA / SMK / SLTA SEDERAJAT' ? 'checked' : '' }} />SMA
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input disabled type="checkbox" class="form-check-input mx-2" value="D2/D2"
                                        {{ $data->pendidikan_terakhir == 'D2' || $data->pendidikan_terakhir == 'D3' ? 'checked' : '' }} />D2/D3
                                </td>
                                <td>
                                    <input disabled type="checkbox" class="form-check-input mx-2" value="DIV/S1"
                                        {{ $data->pendidikan_terakhir == 'D4' || $data->pendidikan_terakhir == 'S1' ? 'checked' : '' }} />D4/S1
                                </td>
                                <td>
                                    <input disabled type="checkbox" class="form-check-input mx-2" value="S2/S3"
                                        {{ $data->pendidikan_terakhir == 'S2' || $data->pendidikan_terakhir == 'S3' ? 'checked' : '' }} />S2/S3
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td class="w-50">
                    <div class="row">
                        <div class="d-flex justify-content-start">
                            <p class="m-0 col" style="min-width: 150px">
                                Tahun Kunjungan {{ $data->tahun_kunjungan ?? '.................' }} Dirawat ke
                                {{ $data->dirawat_ke ?? '................' }}
                            </p>
                        </div>
                    </div>
                    <div class="row m-0">
                        <p class="my-1">Ruang Rawat</p>
                        <div>
                            <table class="w-100">
                                <tr>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->ruang_rawat == 'VIP' ? 'checked' : '' }} />VIP
                                    </td>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->ruang_rawat == 'KELAS II' ? 'checked' : '' }} />Kelas II
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->ruang_rawat == 'KELAS I' ? 'checked' : '' }} />Kelas I
                                    </td>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->ruang_rawat == 'KELAS III' ? 'checked' : '' }} />Kelas III
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="row mb-2 m-0">
                        <div class="d-flex justify-content-start">
                            <p class="m-0 col">Alamat Sesuai KTP</p>
                            <p class="m-0 col">
                                : {{ $data->alamat_sesuai_ktp ?? '........................................' }}</p>
                            </p>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="d-flex justify-content-start">
                            <p class="m-0 col">Alamat Sesuai Domisili</p>
                            <p class="m-0 col">
                                : {{ $data->alamat_sesuai_domisili ?? '........................................' }}
                            </p>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row mb-2 m-0">
                        <div class="d-flex justify-content-start">
                            <p class="m-0 col">Nomor Telepon / HP</p>
                            <p class="m-0 col">
                                : {{ $data->no_telphone ?? '.......................................' }}
                            </p>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="d-flex justify-content-start">
                            <p class="m-0 col">Email</p>
                            <p class="m-0 col">
                                : {{ $data->email ?? '.......................................' }}
                            </p>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="row m-0">
                        <label class="col-sm-5 col-form-label" for="basic-default-name">Suku Bangsa :</label>
                        <table>
                            <tr>
                                <td>
                                    <input disabled type="checkbox" class="mx-2 form-check-input"
                                        {{ $data->suku_bangsa == 'Minang' ? 'checked' : '' }} />Minang
                                </td>
                                <td>
                                    <input disabled type="checkbox" class="mx-2 form-check-input"
                                        {{ $data->suku_bangsa == 'Jawa' ? 'checked' : '' }} />Jawa
                                </td>
                                <td>
                                    <input disabled type="checkbox" class="mx-2 form-check-input"
                                        {{ $data->suku_bangsa == 'Batak' ? 'checked' : '' }} />Batak
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input disabled type="checkbox" class="mx-2 form-check-input"
                                        {{ $data->suku_bangsa == 'Mentawai' ? 'checked' : '' }} />Mentawai
                                </td>
                                <td>
                                    <input disabled type="checkbox" class="mx-2 form-check-input"
                                        {{ $data->suku_bangsa == 'Melayu' ? 'checked' : '' }} />Melayu
                                </td>
                                @if (
                                    $data->suku_bangsa != 'Minang' &&
                                        $data->suku_bangsa != 'Jawa' &&
                                        $data->suku_bangsa != 'Batak' &&
                                        $data->suku_bangsa != 'Mentawai' &&
                                        $data->suku_bangsa != 'Melayu')
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            checked />{{ $data->suku_bangsa }}
                                    </td>
                                @else
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input" />Lainnya
                                    </td>
                                @endif
                            </tr>
                        </table>
                    </div>
                </td>
                <td>
                    <div class="row m-0">
                        <label class="col-sm-5 col-form-label" for="basic-default-name">Agama :</label>
                        <table>
                            <tr>
                                <td>
                                    <input disabled type="checkbox" class="mx-2 form-check-input"
                                        {{ $data->agama == 'Islam' ? 'checked' : '' }} />Islam
                                </td>
                                <td>
                                    <input disabled type="checkbox" class="mx-2 form-check-input"
                                        {{ $data->agama == 'Protestan' ? 'checked' : '' }} />Protestan
                                </td>
                                <td>
                                    <input disabled type="checkbox" class="mx-2 form-check-input"
                                        {{ $data->agama == 'Khatolik' ? 'checked' : '' }} />Khatolik
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input disabled type="checkbox" class="mx-2 form-check-input"
                                        {{ $data->agama == 'Budha' ? 'checked' : '' }} />Budha
                                </td>
                                <td>
                                    <input disabled type="checkbox" class="mx-2 form-check-input"
                                        {{ $data->agama == 'Hindu' ? 'checked' : '' }} />Hindu
                                </td>
                                <td>
                                    <input disabled type="checkbox" class="mx-2 form-check-input"
                                        {{ $data->agama == 'Konghucu' ? 'checked' : '' }} />Konghucu
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="row m-0">
                        <p class="my-1">Pekerjaan :</p>
                        <div>
                            <table class="w-100">
                                <tr>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->pekerjaan == 'PNS' ? 'checked' : '' }} />PNS
                                    </td>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->pekerjaan == 'BUMN' ? 'checked' : '' }} />BUMN
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->pekerjaan == 'SWASTA' ? 'checked' : '' }} />SWASTA
                                    </td>
                                    @if ($data->pekerjaan != 'PNS' && $data->pekerjaan != 'BUMN' && $data->pekerjaan != 'SWASTA')
                                        <td>
                                            <input disabled type="checkbox" class="mx-2 form-check-input"
                                                checked />{{ $data->pekerjaan }}
                                        </td>
                                    @else
                                        <td>
                                            <input disabled type="checkbox" class="mx-2 form-check-input" />lainnya
                                            ............
                                        </td>
                                    @endif
                                </tr>
                            </table>
                            <div class="col-sm-7">
                                <input disabled type="text" class="form-control" name="pekerjaan_lainnya"
                                    style="display: none" id="pekerjaan_lainnya"
                                    placeholder="Ketik Nama Pekerjaan disini" />
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row m-0">
                        <div class="d-flex justify-content-start">
                            <p class="m-0 col">Keyakinan</p>
                            <p class="m-0 col">
                                : {{ $data->keyakinan ?? '............................................' }}
                            </p>
                        </div>
                    </div>
                    <div class="row mt-3 m-0">
                        <div class="d-flex justify-content-start">
                            <p class="m-0 col">Nilai-nilai Pribadi</p>
                            <p class="m-0 col">
                                : {{ $data->nilai_nilai_pribadi ?? '............................................' }}
                            </p>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="row m-0">
                        <p class="m-0">Bahasa yang digunakan</p>
                        <div>
                            <table class="w-100">
                                <tr>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->bahasa == 'Indonesia' ? 'checked' : '' }} />Indonesia
                                    </td>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->bahasa == 'Daerah' ? 'checked' : '' }} />Daerah
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->bahasa == 'Isyarat' ? 'checked' : '' }} />Isyarat
                                    </td>
                                    @if ($data->bahasa != 'Indonesia' && $data->bahasa != 'Daerah' && $data->bahasa != 'Isyarat')
                                        <td>
                                            <input disabled type="checkbox" class="mx-2 form-check-input"
                                                checked />{{ $data->bahasa }}
                                        </td>
                                    @else
                                        <td>
                                            <input disabled type="checkbox" class="mx-2 form-check-input" />Lainnya
                                        </td>
                                    @endif
                                </tr>
                            </table>
                            <div class="col-sm-7">
                                <input disabled type="text" class="form-control" name="lainnya_bahasa"
                                    style="display: none" id="lainnya_bahasa"
                                    placeholder="Ketik Bahasa Yang Digunakan" />
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row m-0">
                        <p class="m-0">Kedatangan Pasien</p>
                        <div class="my-2">
                            <table class="w-100">
                                <tr>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->kedatangan_pasien == 'Datang Sendiri' ? 'checked' : '' }} />Datang
                                        Sendiri
                                    </td>
                                    @if ($data->kedatangan_pasien != 'Datang Sendiri')
                                        <td>
                                            <input disabled type="checkbox" class="form-check-input mx-2"
                                                checked />Dirujuk
                                            Oleh {{ $data->kedatangan_pasien ?? '.......' }}
                                        </td>
                                    @else
                                        <td>
                                            <input disabled type="checkbox" class="form-check-input mx-2" />Dirujuk
                                            Oleh
                                            .......
                                        </td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="row">
                        <div>
                            <table class="w-100">
                                <tr>
                                    <td class="py-1">Hambatan Bahasa</td>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->hambatan_bahasa == 'Tidak' ? 'checked' : '' }} />
                                        Tidak
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->hambatan_bahasa == 'Ya' ? 'checked' : '' }} />Ya
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-1">
                                        Kebutuhan Penerjemah
                                    </td>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->kebutuhan_penerjemah == 'Tidak' ? 'checked' : '' }} />
                                        Tidak
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->kebutuhan_penerjemah == 'Ya' ? 'checked' : '' }} />Ya
                                    </td>
                                </tr>
                                <tr>
                                    <td class="">Kebutuhan Disabilitas</td>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->kebutuhan_disabilitas == 'Tidak' ? 'checked' : '' }} />
                                        Tidak
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->kebutuhan_disabilitas == 'Ya' ? 'checked' : '' }} />Ya
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row m-0">
                        <p class="my-1">Masuk Rumah Sakit Melalui :</p>
                        <div>
                            <table class="w-100">
                                <tr>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->jalur_masuk_rumahsakit == 'Poliklinik' ? 'checked' : '' }} />Poliklinik
                                    </td>
                                    <td>
                                        <input disabled type="checkbox" class="mx-2 form-check-input"
                                            {{ $data->jalur_masuk_rumahsakit == 'IGD' ? 'checked' : '' }} />IGD
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="row m-0">
                        <p class="m-0">Riwayat Mutasi :</p>
                        <div>
                            <table>
                                <tr>
                                    <td>
                                        1. Pindah Dari Bangsal {{ $data->mutasi_bangsal_1 ?? '........' }} Ke
                                        {{ $data->mutasi_pindah_bangsal_1 ?? '........' }} Tanggal
                                        @if ($data->tanggal_bangsal_1 != null)
                                            {{ Carbon\Carbon::parse($data->tanggal_bangsal_1)->isoformat('D MMM Y') }}
                                        @else
                                            ........
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        2. Pindah Dari Bangsal {{ $data->mutasi_bangsal_2 ?? '........' }} Ke
                                        {{ $data->mutasi_pindah_bangsal_2 ?? '........' }} Tanggal
                                        @if ($data->tanggal_bangsal_2 != null)
                                            {{ Carbon\Carbon::parse($data->tanggal_bangsal_2)->isoformat('D MMM Y') }}
                                        @else
                                            ........
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>

                <td>
                    <div class="row m-0">
                        <p class="my-1">Keadaan Keluar</p>
                        <div>
                            <table>
                                <tr>
                                    <td style="width: 33%">
                                        <input disabled type="checkbox" class="mx-1 form-check-input"
                                            {{ $data->keadaan_keluar == 'Sembuh' ? 'checked' : '' }} />Sembuh
                                    </td>
                                    <td style="width: 33%">
                                        <input disabled type="checkbox" class="mx-1 form-check-input"
                                            {{ $data->keadaan_keluar == 'Perbaikan' ? 'checked' : '' }} />Perbaikan
                                    </td>
                                    <td style="width: 33%">
                                        <input disabled type="checkbox" class="mx-1 form-check-input"
                                            {{ $data->keadaan_keluar == 'Cacat' ? 'checked' : '' }} />Cacat
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <input disabled type="checkbox" class="mx-1 form-check-input"
                                            {{ $data->keadaan_keluar == 'Menetap/Memburuk' ? 'checked' : '' }} />Menetap/Memburuk
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <input disabled type="checkbox" class="mx-1 form-check-input"
                                            {{ $data->keadaan_keluar == 'Meninggal <= 48 Jam' ? 'checked' : '' }} />Meninggal
                                        <= 48 Jam </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <input disabled type="checkbox" class="mx-1 form-check-input"
                                            {{ $data->keadaan_keluar == 'Meninggal > 48 Jam' ? 'checked' : '' }} />Meninggal
                                        > 48 jam
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="">
                    <div class="row">
                        <p class="my-1">Cara Keluar :</p>
                        <div>
                            <table class="w-100">
                                <tr>
                                    <td>
                                        <div>
                                            <input disabled type="checkbox" class="form-check-input mx-1"
                                                {{ $data->cara_keluar == 'Atas Persetujuan' ? 'checked' : '' }} />Atas
                                            Persetujuan
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input disabled type="checkbox" class="form-check-input mx-1"
                                                {{ $data->cara_keluar == 'Lari' ? 'checked' : '' }} />Lari
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input disabled type="checkbox" class="form-check-input mx-1"
                                                {{ $data->cara_keluar == 'Meninggal' ? 'checked' : '' }} />Meninggal
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-2">
                                        <div style="min-width: 100px">
                                            <input disabled type="checkbox" class="form-check-input mx-1"
                                                {{ $data->cara_keluar == 'Pulang APS' ? 'checked' : '' }} />Pulang APS
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <div style="min-width: 150px">
                                            <input disabled type="checkbox" class="form-check-input mx-1"
                                                {{ $data->cara_keluar == 'Pindah RS Lain' ? 'checked' : '' }} />Pindah
                                            RS Lain
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row m-0">
                        <p class="my-1">Meninggal</p>
                        <div>
                            <table class="w-100">
                                <tr>
                                    <td>
                                        <div style="min-width: 130px">
                                            <input disabled type="checkbox" class="form-check-input mx-2"
                                                {{ $data->meninggal == 'Autopsi' ? 'checked' : '' }}
                                                value="Autopsi" />Autopsi
                                        </div>
                                    </td>
                                    <td>
                                        <div style="min-width: 200px">
                                            <input disabled type="checkbox" class="form-check-input mx-2"
                                                {{ $data->meninggal != 'Autopsi' ? 'checked' : '' }} />Tanpa Autopsi
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <table class="table-bordered w-100">
            <thead>
                <tr class="text-nowrap bg-secondary">
                    <th class="text-dark">
                        Diagnosis (Dengan Huruf Cetak, Jangan Disingkat)
                    </th>
                    <th class="text-dark">Kode Diagnosa Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Diagnosa Utama</td>

                    <td>
                        ICD X
                        : {{ $data->diagnosa_utama ?? '.........................................................' }}
                    </td>
                </tr>
                <tr>
                    <td>Diagnosa Sekunder</td>

                    <td>
                        ICD X
                        : {{ $data->diagnosa_sekunder ?? '.........................................................' }}
                    </td>
                </tr>
                <tr>
                    <td>Diagnosa Kompikasi dan Resiko Yang Muncul</td>

                    <td>
                        ICD X
                        :
                        {{ $data->komplikasi_dan_resiko ?? '.........................................................' }}
                    </td>
                </tr>
                <tr>
                    <td>Tindakan Operasi</td>
                    <td>
                        ICD X
                        : {{ $data->tindakan_operasi ?? '.........................................................' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Riwayat Alergi
                        <input disabled type="checkbox" class="ms-2 form-check-input"
                            {{ $data->riwayat_alergi == 'Tidak' ? 'checked' : '' }} />
                        Tidak
                        <input disabled type="checkbox" class="ms-2 form-check-input"
                            {{ $data->riwayat_alergi == 'Ya' ? 'checked' : '' }} />
                        Ada
                        <span class="mx-5 px-5"></span>
                        Riwayat Tranfusi
                        <input disabled type="checkbox" class="ms-2 form-check-input"
                            {{ $data->riwayat_transfusi == 'Tidak' ? 'checked' : '' }} />
                        Tidak
                        <input disabled type="checkbox" class="ms-2 form-check-input"
                            {{ $data->riwayat_transfusi == 'Ya' ? 'checked' : '' }} />
                        Ada
                    </td>
                </tr>
                <tr>
                    <td>
                        Boleh Pulang /APS/Meninggal : <br> Tgl.
                        @if ($data->tanggal_aps != null)
                            {{ Carbon\Carbon::parse($data->tanggal_aps)->isoformat('D MMM Y') }}
                        @else
                            ..........
                        @endif
                        Jam.
                        @if ($data->jam_aps != null)
                            {{ Carbon\Carbon::parse($data->jam_aps)->format('H:i') }}
                        @else
                            ..........
                        @endif
                    </td>
                    <td>
                        Kontrol Kembali : <br> Tgl.
                        @if ($data->tanggal_kontrol != null)
                            {{ Carbon\Carbon::parse($data->tanggal_kontrol)->isoformat('D MMM Y') }}
                        @else
                            ..........
                        @endif
                        Jam.
                        @if ($data->jam_kontrol != null)
                            {{ Carbon\Carbon::parse($data->jam_kontrol)->format('H:i') }}
                        @else
                            ..........
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="w-100 row mt-5 text-center">
            <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                <p>Nama DPJP Tambahan</p>
                <br /><br />
                <p class="m-0">
                    1. ..............................................
                </p>
                <p class="m-0">
                    2. ..............................................
                </p>
            </div>
            <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                <p>Tanda Tangan</p>
                <br /><br />
                <p class="m-0">
                    1. ..............................................
                </p>
                <p class="m-0">
                    2. ..............................................
                </p>
            </div>
            <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                <p>Dokter yang merawat (DPJP Utama)</p>
                <br /><br />
                <p class="m-0">
                    (..........................................................)
                </p>
            </div>
        </div>
    </div>
</body>

</html>
