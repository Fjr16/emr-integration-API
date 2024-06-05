<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Asesmen Awal Medis Pasien Rawat Inap</title>
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
                /* height: 330mm; */
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
                        <img src="logo.png" alt="" />
                    </div>
                    <div class="col-7 text-center">
                        <h1>ASESMEN AWAL MEDIS <br />PASIEN RAWAT INAP</h1>
                    </div>
                    <div class="col-3">
                        <!-- <div
                            class="border border-3 border-rounded py-4 px-5"
                        ></div> -->
                    </div>
                </div>
            </div>

            <div class="content">
                <table class="table-bordered w-100 mt-4">
                    <tbody>
                        <tr>
                            <td class="w-50">Tanggal : {{ $waktu->format('Y-m-d') ?? '' }}</td>
                            <td>Jam melakukan asesmen awal : {{ $waktu->format('H:i') ?? '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="m-0 fw-bold">ANAMNESIS</p>
                                <p class="m-0">&emsp;Data diperoleh dari</p>
                                <div class="form-check mx-3">
                                    <input
                                        name="default-radio-1"
                                        class="form-check-input"
                                        type="radio"
                                        value=""
                                        id="defaultRadio1"
                                        {{ $item->isPasien ? 'checked' : '' }}
                                        style="pointer-events: none;"
                                    />
                                    <label
                                        class="form-check-label d-flex"
                                        for="defaultRadio1" style="pointer-events: none;"
                                    >
                                        Pasien
                                    </label>
                                    <input
                                        name="default-radio-1"
                                        class="form-check-input"
                                        type="radio"
                                        value=""
                                        id="defaultRadio2"
                                        {{ $item->isPasien ? '' : 'checked' }}
                                        style="pointer-events: none;"
                                    />
                                    <label
                                        class="form-check-label d-flex"
                                        for="defaultRadio2" style="pointer-events: none;"
                                    >
                                        Orang Lain(Alloanamnesa) <span class="fw-bold mx-2">{{ $item->name ?? '..........' }}</span>
                                        Hubungan dengan pasien
                                        <span class="fw-bold mx-2">{{ $item->hubungan ?? '..................' }}</span>
                                    </label>
                                </div>
                                <p class="m-0 fw-bold">KELUHAN UTAMA</p>
                                <p class="m-0">
                                    {!! $item->keluhan_utama ?? '-' !!}
                                </p>
                                <p class="m-0 fw-bold">
                                    RIWAYAT PENYAKIT SEKARANG
                                </p>
                                <p class="m-0">
                                    {!! $item->riwayat_penyakit_sekarang ?? '-' !!}
                                </p>
                                <p class="m-0 fw-bold">
                                    RIWAYAT PENYAKIT TERDAHULU
                                </p>
                                <p class="m-0">
                                    {!! $item->riwayat_penyakit_dahulu ?? '-' !!}
                                </p>
                                <p class="m-0 fw-bold">
                                    RIWAYAT PENGGUNAAN OBAT
                                </p>
                                <p class="m-0">
                                    {!! $item->riwayat_penggunaan_obat ?? '-' !!}
                                </p>
                                <p class="m-0 fw-bold">
                                    RIWAYAT PENYAKIT KELUARGA
                                </p>
                                <p class="m-0">
                                    {!! $item->riwayat_penyakit_keluarga ?? '-' !!}
                                </p>
                                <p class="m-0 fw-bold">PEMERIKSAAN FISIK</p>
                                <table class="table-bordered w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>KETERANGAN</th>
                                            <th>NORMAL</th>
                                            <th>JELASKAN JIKA TIDAK NORMAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item->ranapPemeriksaanFisikInitialAssesments as $pemeriksaanFisik)    
                                            <tr>
                                                <td>{{ $pemeriksaanFisik->name ?? '' }}</td>
                                                <td class="text-center">{{ $pemeriksaanFisik->isNormal ? 'Ya' : 'Tidak' }}</td>
                                                <td class="text-center">{{ $pemeriksaanFisik->keterangan ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <p class="m-0 fw-bold">STATUS LOKALIS</p>
                                <p class="m-0">
                                    {!! $item->status_lokalis ?? '-' !!}
                                </p>
                                <p class="m-0 fw-bold">
                                    HASIL PEMERIKSAAN PENUNJANG
                                </p>
                                <div class="mx-2">
                                    @foreach ($item->ranapHasilPemeriksaanPenunjangInitialAssesment as $pemeriksaanPenunjang)     
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="defaultCheck1"
                                                style="pointer-events: none;"
                                                {{ $pemeriksaanPenunjang->hasil ? 'checked' : '' }}
                                            />
                                            <label
                                                class="form-check-label"
                                            >
                                                {{ $pemeriksaanPenunjang->name ?? '' }} : {!! $pemeriksaanPenunjang->hasil ?? '' !!}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="m-0 fw-bold">DIAGNOSA KERJA</p>
                                <p class="m-0">
                                    {!! $item->diagnosa_kerja ?? '-' !!}
                                </p>
                                <p class="m-0 fw-bold">DIAGNOSA BANDING</p>
                                <p class="m-0">
                                    {!! $item->diagnosa_banding ?? '-' !!}
                                </p>
                                <p class="m-0 fw-bold">
                                    TERAPI / INSTRUKSI (STANDING ORDER)
                                </p>
                                <p class="m-0">
                                    {!! $item->terapi ?? '-' !!}
                                </p>
                                <p class="m-0 fw-bold">RENCANA</p>
                                @if ($item->ranapRencanaInitialAssesments->isNotEmpty())    
                                    <div class="mx-2">
                                        @foreach ($item->ranapRencanaInitialAssesments as $rencana)    
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="defaultCheck4"
                                                style="pointer-events: none;"
                                                @checked(true)
                                            />
                                            <label
                                                class="form-check-label"
                                            >
                                                {{ $rencana->name ?? '' }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                @else    
                                    <div class="mx-2">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="defaultCheck4"
                                                style="pointer-events: none;"
                                            />
                                            <label
                                                class="form-check-label"
                                            >
                                                Tindakan
                                                ...............................
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="defaultCheck5"
                                                style="pointer-events: none;"
                                            />
                                            <label
                                                class="form-check-label"
                                            >
                                                Dirawat di ruang
                                                ...................................
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="defaultCheck6"
                                                style="pointer-events: none;"
                                            />
                                            <label
                                                class="form-check-label"
                                            >
                                                Diet
                                                ................................
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <p class="m-0 fw-bold">KEBUTUHAN EDUKASI</p>
                                <div class="mx-2">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            value=""
                                            id="defaultCheck7"
                                            style="pointer-events: none;"
                                            {{ in_array('Penggunaan obat secara efektif dan aman', $item->ranapKebutuhanEdukasiInitialAssesments->pluck('name')->toArray()) ? 'checked' : '' }}
                                        />
                                        <label
                                            class="form-check-label"
                                        >
                                            Penggunaan obat secara efektif dan
                                            aman
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            value=""
                                            id="defaultCheck8"
                                            style="pointer-events: none;"
                                            {{ in_array('Penggunaan peralatan alat medis yang aman', $item->ranapKebutuhanEdukasiInitialAssesments->pluck('name')->toArray()) ? 'checked' : '' }}
                                        />
                                        <label
                                            class="form-check-label"
                                        >
                                            Penggunaan peralatan alat medis yang
                                            aman
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            value=""
                                            id="defaultCheck9"
                                            style="pointer-events: none;"
                                            {{ in_array('Potensi interaksi obat dan makanan', $item->ranapKebutuhanEdukasiInitialAssesments->pluck('name')->toArray()) ? 'checked' : '' }}
                                            
                                        />
                                        <label class="form-check-label">
                                            Potensi interaksi obat dan makanan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            value=""
                                            id="defaultCheck10"
                                            style="pointer-events: none;"
                                            {{ in_array('Teknik rehabilitasi', $item->ranapKebutuhanEdukasiInitialAssesments->pluck('name')->toArray()) ? 'checked' : '' }}
                                        />
                                        <label class="form-check-label">
                                            Teknik rehabilitasi
                                        </label>
                                    </div>
                                </div>
                                <p class="m-0 fw-bold">
                                    PERENCANAAN PEMULANGAN PASIEN (DISCHARGE
                                    PLANNING)
                                </p>
                                <p class="m-0">
                                    Kriteria Perencanaan Pemulangan Pasien :
                                </p>
                                <ol class="m-0">
                                    @foreach ($item->ranapRencanaPemulanganPasienInitialAssesments as $pemulangan)    
                                        <li>
                                            <div class="row">
                                                <div class="col-6">
                                                    {{ $pemulangan->name ?? '' }}
                                                </div>
                                                <div class="col-6">
                                                    <div
                                                        class="form-check form-check-inline"
                                                    >
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            id="inlineCheckbox1"
                                                            value="ya"
                                                            style="pointer-events: none;"
                                                            {{ $pemulangan->isYes ? 'checked' : '' }}
                                                        />
                                                        <label
                                                            class="form-check-label"
                                                            >Ya</label
                                                        >
                                                    </div>
                                                    <div
                                                        class="form-check form-check-inline"
                                                    >
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            id="inlineCheckbox2"
                                                            value="tidak"
                                                            style="pointer-events: none;"
                                                            {{ $pemulangan->isYes ? '' : 'checked' }}
                                                        />
                                                        <label class="form-check-label">Tidak</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ol>
                                <small class="m-0">
                                    *Bila satu atau lebih jawaban ya,
                                    dilanjutkan dengan pengisian form
                                    perencanaan pemulangan pasien (Discharge
                                    Planning)
                                </small>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="w-100 row mt-5 text-center">
                    <div
                        class="col-5 d-flex flex-column justify-content-center align-items-center"
                    >
                        <small>
                            Tanggal <span class="fw-bold">{{ $formatId->isoformat('D MMMM Y') ?? '.................' }}</span> Jam <span class="fw-bold">{{ $waktu->format('H:i') ?? '.........' }}</span> <br />Telah
                            dijelaskan dan dipahami kepada <br />
                            <span class="fw-bold">{{ $item->dijelaskan_kepada ?? '' }}</span><br>
                        </small>
                        <br /><br /><br>

                        <small class="m-0">
                            @if ($item->isPasien)
                                ({{ $item->patient->name ?? '' }})
                            @else
                                ({{ $item->name ?? '............................................' }})
                            @endif
                        </small>
                    </div>
                    <div
                        class="col-2 d-flex flex-column justify-content-center align-items-center"
                    ></div>
                    <div
                        class="col-5 d-flex flex-column justify-content-center align-items-center"
                    >
                        <small>
                            Tanggal <span class="fw-bold">{{ $formatId->isoformat('D MMMM Y') ?? '.................' }}</span> Jam <span class="fw-bold">{{ $waktu->format('H:i') ?? '.........' }}</span> <br/>

                            Dokter Penanggung Jawab Pasien<br />
                        </small>
                        <br /><br /><br /><br>

                        <small class="m-0">
                            ({{ $item->rawatInapPatient->queue->suratPengantarRawatJalanPatient->user->name ?? '............................................' }})
                        </small>
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
