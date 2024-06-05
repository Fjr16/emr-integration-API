<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Asesmen Awal Medis Pasien Rawat Jalan</title>
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

        /* .header {
            width: 100%;
            position: sticky;
            top: 0;
            background: white;
            z-index: 1000;
            padding-bottom: 10px;
            border-bottom: 2px solid #000;
        } */

        input[type="checkbox"] {
            pointer-events: none;
        }

        @page {
            size: A4;
            margin: 10mm;
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
                position: relative;
                page-break-after: always;
            }

            .page-1 .print-footer-1,
            .page-2 .print-footer-2 {
                position: fixed;
                bottom: 0mm;
                right: 10mm;
                width: 100%;
                text-align: right;
            }

            .page-2 .print-footer-1,
            .page-1 .print-footer-2 {
                display: none;
            }

            .print-footer-1 {
                right: 10mm;
            }

            .print-footer-2 {
                right: 10mm;
            }

            input[type="checkbox"] {
                pointer-events: none;
            }
        }
    </style>
</head>

<body>
    <div class="page" id="page-1">
        <div class="header">
            <div class="d-flex flex-row">
                <div class="col-1 d-flex align-items-center">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                </div>
                <div class="d-flex align-items-center justify-content-center ms-5">
                    <h1>ASESMEN AWAL MEDIS <br />PASIEN RAWAT JALAN</h1>
                </div>
                <div class="ms-5">
                    <div class="border border-dark p-1" style="border-radius: 15px">
                        <table class="small small-table">
                            <tr>
                                <td>Nama</td>
                                <td class="px-2">:</td>
                                <td>{{ $item->patient->name }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td class="px-2">:</td>
                                @php
                                    $tanggalLahir = new DateTime($item->patient->tanggal_lhr);
                                    $now = new DateTime();
                                    $ageDiff = $now->diff($tanggalLahir);
                                    $ageString = $ageDiff->format('%y tahun %m bulan');
                                @endphp
                                <td>{{ $tanggalLahir->format('d-m-Y') ?? '....' }}
                                    <span>({{ $ageString ?? '....' }})</span>
                                </td>
                            </tr>
                            <tr>
                                <td>No Rekam Medis</td>
                                <td class="px-2">:</td>
                                <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                </td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td class="px-2">:</td>
                                <td>{{ $item->patient->nik }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <table class="table-bordered w-100 mt-4">
                <tbody>
                    <tr>
                        <td class="w-50 p-1">Tanggal : {{ $waktu->format('Y-m-d') ?? '' }}</td>
                        <td class="p-1">Jam melakukan asesmen awal : {{ $waktu->format('H:i') ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="px-2">

                            <p class="m-0 fw-bold">ANAMNESIS</p>
                            <p class="m-0">&emsp;Data diperoleh dari</p>
                            <div class="form-check mx-3">
                                <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                    id="defaultRadio1" {{ $item->isPasien ? 'checked' : '' }}
                                    style="pointer-events: none;" />
                                <label class="form-check-label d-flex" for="defaultRadio1"
                                    style="pointer-events: none;">
                                    Pasien
                                </label>
                                <input name="default-radio-1" class="form-check-input" type="radio" value=""
                                    id="defaultRadio2" {{ $item->isPasien ? '' : 'checked' }}
                                    style="pointer-events: none;" />
                                <label class="form-check-label d-flex" for="defaultRadio2"
                                    style="pointer-events: none;">
                                    Orang Lain(Alloanamnesa) <span
                                        class="fw-bold mx-2">{{ $item->name ?? '..........' }}</span>
                                    Hubungan dengan pasien
                                    <span class="fw-bold mx-2">{{ $item->hubungan ?? '..................' }}</span>
                                </label>
                            </div>


                            <p class="m-0 fw-bold">KELUHAN UTAMA</p>
                            <p class="m-0">
                                {!! $item->keluhan ?? '-' !!}
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
                                    @foreach ($item->initialAssesmentPhysicalExaminations as $fisik)
                                        <tr>
                                            <td>{{ $fisik->name ?? '' }}</td>
                                            <td class="text-center">{{ $fisik->isNormal ? 'Ya' : 'Tidak' }}
                                            </td>
                                            <td class="text-center">{{ $fisik->keterangan ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <p class="m-0 fw-bold mt-3">
                                STATUS LOKALIS
                            </p>
                            <p class="m-0 mb-5">
                                {!! $item->status_lokalis ?? '-' !!}
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-end mt-4 print-footer-1">
            <p class="small"><span class="border border-dark">RM 01.RJ.DR.REV.1-1/2</span></p>
        </div>
    </div>

    <div class="page" id="page-2">
        <div class="header">
            <div class="d-flex flex-row">
                <div class="col-1 d-flex align-items-center">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                </div>
                <div class="d-flex align-items-center justify-content-center ms-5">
                    <h1>ASESMEN AWAL MEDIS <br />PASIEN RAWAT JALAN</h1>
                </div>
                <div class="ms-5">
                    <div class="border border-dark p-1" style="border-radius: 15px">
                        <table class="small small-table">
                            <tr>
                                <td>Nama</td>
                                <td class="px-2">:</td>
                                <td>{{ $item->patient->name }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td class="px-2">:</td>
                                @php
                                    $tanggalLahir = new DateTime($item->patient->tanggal_lhr);
                                    $now = new DateTime();
                                    $ageDiff = $now->diff($tanggalLahir);
                                    $ageString = $ageDiff->format('%y tahun %m bulan');
                                @endphp
                                <td>{{ $tanggalLahir->format('d-m-Y') ?? '....' }}
                                    <span>({{ $ageString ?? '....' }})</span>
                                </td>
                            </tr>
                            <tr>
                                <td>No Rekam Medis</td>
                                <td class="px-2">:</td>
                                <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                </td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td class="px-2">:</td>
                                <td>{{ $item->patient->nik }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <table class="table-bordered w-100 mt-4">
                <tbody>
                    <tr>
                        <td class="px-2">
                            <p class="m-0 fw-bold">
                                HASIL PEMERIKSAAN PENUNJANG
                            </p>
                            @php
                                $labor = '';
                                $radiologi = '';
                                foreach ($item->initialAssesmentSupportingExaminationResults as $penunjang) {
                                    if (Str::startsWith($penunjang->name, 'Labor ')) {
                                        $labor = $penunjang->name;
                                    }
                                    if (Str::startsWith($penunjang->name, 'Radiologi ')) {
                                        $radiologi = $penunjang->name;
                                    }
                                }
                            @endphp
                            <table>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="Labor" {{ !empty($labor) ? 'checked' : '' }}>

                                            <label class="form-check-label" for="Labor">
                                                Labor
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-2">:</td>
                                    <td>{{ $labor ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="Radiologi" {{ !empty($radiologi) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="Radiologi">
                                                Radiologi
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-2">:</td>
                                    <td>{{ $radiologi ?? '' }}</td>
                                </tr>
                                @foreach ($item->initialAssesmentSupportingExaminationResults as $penunjang)
                                    @if (!Str::startsWith($penunjang->name, 'Radiologi ') && !Str::startsWith($penunjang->name, 'Labor '))
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="Lain-Lain" checked>
                                                    <label class="form-check-label" for="Lain-Lain">
                                                        Lain-Lain
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="px-2">:</td>
                                            <td>{{ $penunjang->name ?? '' }}</td>
                                        </tr>
                                    @endif
                                @endforeach

                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="px-2">
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
                            @php
                                $tindakan = '';
                                $dirawat = '';
                                $diet = '';
                                foreach ($item->initialAssesmentPlan as $penunjang) {
                                    if (Str::startsWith($penunjang->name, 'Tindakan ')) {
                                        $tindakan = $penunjang->name;
                                    }
                                    if (Str::startsWith($penunjang->name, 'Dirawat ')) {
                                        $dirawat = $penunjang->name;
                                    }
                                    if (Str::startsWith($penunjang->name, 'Diet ')) {
                                        $diet = $penunjang->name;
                                    }
                                }
                            @endphp

                            <div class="d-flex flex-column">
                                <div class="d-flex flex-row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="" {{ !empty($tindakan) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
                                            Tindakan : {{ $tindakan ?? '' }}
                                        </label>
                                    </div>
                                </div>
                                <div class="d-flex flex-row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="" {{ !empty( $dirawat) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
                                            Dirawat : {{ $dirawat ?? '' }}
                                        </label>
                                    </div>
                                    {{-- <span>{{ $dirawat ?? '' }}</span> --}}
                                </div>
                                <div class="d-flex flex-row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="" {{ !empty( $diet) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">
                                            Diet : {{ $diet ?? '' }}
                                        </label>
                                    </div>
                                    {{-- <span>............</span> --}}
                                </div>
                                @foreach ($item->initialAssesmentPlan as $plan)
                                    @if (
                                        !Str::startsWith($plan->name, 'Tindakan ') &&
                                            !Str::startsWith($plan->name, 'Dirawat ') &&
                                            !Str::startsWith($plan->name, 'Diet '))
                                        <div class="d-flex flex-row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="" checked>
                                                <label class="form-check-label" for="">
                                                    {{ $plan->name ?? '' }}
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach


                            </div>


                            <p class="m-0 fw-bold mt-3">KEBUTUHAN EDUKASI</p>
                            @php
                                $arrValEdukasi = $item->initialAssesmentEducationalNeeds->pluck('name')->toArray();
                            @endphp
                            <div class="mx-2">

                                {{-- @foreach ($item->initialAssesmentEducationalNeeds as $edukasi)
                                    @if ($edukasi->name == null)
                                        @continue
                                    @endif
                                    <div class="form-check">
                                        <input class="form-check-input" style="pointer-events: none;" type="checkbox"
                                            value="" checked />
                                        <label class="form-check-label d-flex">
                                            {{ $edukasi->name }}
                                        </label>
                                    </div>
                                @endforeach --}}

                                <div class="d-flex flex-column">
                                    @foreach ($arrEdukasi as $edukasi)
                                        <div class="d-flex flex-row">
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                    type="checkbox"value="{{ $edukasi }}"
                                                    id="{{ $edukasi }}" name="edukasi[]"
                                                    {{ in_array($edukasi, $arrValEdukasi) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ $edukasi }}">
                                                    {{ $edukasi }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach ($item->initialAssesmentEducationalNeeds as $valEdukasi)
                                        @if (!in_array($valEdukasi->name, $arrEdukasi))
                                            <div class="d-flex flex-row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $valEdukasi->name ?? '' }}" id="">
                                                    <label class="form-check-label" for="">
                                                        {{ $valEdukasi->name ?? '' }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    {{-- <div class="d-flex flex-row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                            <label class="form-check-label" for="">
                                                Penggunaan obat secara efektif dan aman
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                            <label class="form-check-label" for="">
                                                Penggunaan peralatan alat medis yang aman
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                            <label class="form-check-label" for="">
                                                Potensi interaksi obat dan makanan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                            <label class="form-check-label" for="">
                                                Teknik rehabilitasi
                                            </label>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="">
                                            <label class="form-check-label" for="">
                                                lainnya
                                            </label>
                                        </div>
                                        <span>.......................</span>
                                    </div> --}}
                                </div>
                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-5 text-center row">
            <div class="col-6">
                <div class="small">
                    <span>Tanggal</span>
                    <span class="ms-1">{{ $waktu->format('Y-m-d') ?? '' }}</span>
                    <span>Jam</span>
                    <span class="ms-1">{{ $waktu->format('H:i') ?? '' }}</span>
                </div>
                <p class="small mb-0">Telah dijelaskan dan dipahami kepada pasien/wali</p>
                <img src="{{ Storage::url($item->ttd_pasien ?? '') }}" alt="" style="max-height: 100px">
                <p class="mt-1 mb-0">
                </p>
                <p class="small">{{ $item->nm_pasien }}</p>

            </div>
            <div class="col-6">
                <div class="small">
                    <span>Tanggal</span>
                    <span class="ms-1">{{ $waktu->format('Y-m-d') ?? '' }}</span>
                    <span>Jam</span>
                    <span class="ms-1">{{ $waktu->format('H:i') ?? '' }}</span>
                </div>
                <p class="small mb-0">Dokter Penanggung Jawab Pelayanan</p>
                <img src="{{ Storage::url($item->ttd_dokter ?? '') }}" alt="" style="max-height: 100px">
                <p class="">
                    {{ $item->nm_dokter ?? '........................................................................' }}
                </p>
            </div>
        </div>

        <div class="text-end mt-4 print-footer-2">
            <p class="small"><span class="border border-dark">RM 01.RJ.DR.REV.1-2/2</span></p>
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

    <script>
        window.addEventListener('load', () => {
            const footer1 = document.querySelector('.print-footer-1');
            const footer2 = document.querySelector('.print-footer-2');
            duplicateFooter(footer1, 'page1');
            duplicateFooter(footer2, 'page2');
        });

        function duplicateFooter(footer, pageId) {
            const page = document.getElementById(pageId);
            const clone = footer.cloneNode(true);
            clone.classList.add('clone');
            page.appendChild(clone);
            let pageHeight = page.offsetHeight;
            let footerHeight = footer.offsetHeight;
            let pageContentHeight = pageHeight - footerHeight;

            while (page.scrollHeight > pageContentHeight) {
                let newPage = page.cloneNode(true);
                newPage.querySelector('.content').innerHTML = '';
                page.parentNode.insertBefore(newPage, page.nextSibling);
                pageHeight = newPage.offsetHeight;
                pageContentHeight = pageHeight - footerHeight;
                page = newPage;
            }
        }
    </script>
</body>

</html>
