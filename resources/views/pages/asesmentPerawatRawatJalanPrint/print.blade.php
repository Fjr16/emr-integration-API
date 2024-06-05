<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Asesmen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            height: auto;
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

        .page-break {
            page-break-before: always;
            /* Mulai halaman baru sebelum elemen ini */
        }

        .bg-gray {
            background-color: #d3d3d3
        }

        @page {
            size: 210mm 400mm;
            margin: 0;
        }

        @media print {

            *,
            *:before,
            *:after {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            html,
            body {
                width: auto;
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

        .custom-checkbox-label {
            color: #000;
            /* Ganti dengan warna yang Anda inginkan */
            opacity: 1;
            /* Menjaga kejelasan warna */
        }

        .form-check-input:disabled+.form-check-label {
            color: #000;
            /* Ganti dengan warna yang Anda inginkan */
            opacity: 1;
            /* Menjaga kejelasan warna */
        }

        /* Warna teks yang jelas untuk label */
        .custom-checkbox-label {
            color: #000;
            /* Ganti dengan warna yang diinginkan */
            opacity: 1;
            /* Menjaga kejelasan warna */
        }

        /* Warna dan gaya checkbox yang tidak butram */
        .custom-checkbox-input:disabled {
            background-color: #f8f9fa;
            /* Latar belakang yang jelas */
            border-color: #adb5bd;
            /* Warna border yang jelas */
            opacity: 1;
            /* Menjaga kejelasan warna */
        }

        .custom-checkbox-input:disabled:checked {
            background-color: #0d6efd;
            /* Warna ceklis yang jelas */
            border-color: #0d6efd;
            /* Warna border yang jelas */
            opacity: 1;
            /* Menjaga kejelasan warna */
        }

        /* Warna dan gaya radio button yang tidak butram */
        .custom-radio-input:disabled {
            background-color: #f8f9fa;
            /* Latar belakang yang jelas */
            border-color: #adb5bd;
            /* Warna border yang jelas */
            opacity: 1;
            /* Menjaga kejelasan warna */
        }

        .custom-radio-input:disabled:checked {
            background-color: #0d6efd;
            /* Warna ceklis yang jelas */
            border-color: #0d6efd;
            /* Warna border yang jelas */
            opacity: 1;
            /* Menjaga kejelasan warna */
        }
    </style>
</head>

<body>
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="page">
        <div class="header">
            <div class="d-flex flex-row align-items-center justify-content-center">
                <div class="col-1">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                </div>
                <div class="text-center mx-2">
                    <h1>ASESMEN AWAL KEPERAWATAN <br> PASIEN RAWAT JALAN</h1>
                </div>
                <div class="small">
                    <div class="border border-dark py-1 px-1" style="border-radius: 15px">
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
                                <td>{{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
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
        {{-- <div class="card-header m-0">
            <h5 class="mb-0 m-0">Asesmen Perawat {{ $item->patient->no_rm }}</h5>
        </div> --}}
        <div class="border border-dark mt-2">
            @php
                $formatTanggal = Carbon\Carbon::parse($item->created_at);

                $time = isset($formatTanggal)
                    ? \Carbon\Carbon::parse($formatTanggal)->subMinutes(5)->format('H:i')
                    : '.....';
            @endphp

            <div class="d-flex flex-row justify-content-center">
                <span class="small px-5">Tanggal : {{ $formatTanggal->isoformat('D MMM Y') ?? '...............' }}
                </span>
                <span class="small px-5">Jam Datang : {{ $time ?? '.....' }}</span>
                <span class="small px-5">Jam Asesmen : {{ $formatTanggal->format('H:i') ?? '.....' }}</span>
            </div>
            <h6 class="text-center bg-gray text-dark small mt-1 py-1">STATUS FISIK</h6>
            {{-- Kondisi Umum --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Kondisi Umum :</span>

                @foreach ($kondisiUmum as $umum)
                    @php
                        $isChecked = in_array(
                            $umum,
                            $item->statusFisikDiagnosaKeperawatanPatient->detailStatusFisikDiagnosaKeperawatanPatient
                                ->where('category', 'Kondisi Umum')
                                ->pluck('name')
                                ->toArray(),
                        );
                    @endphp
                    <span class="ms-2 small">
                        <div class="form-check">
                            <input class="form-check-input custom-checkbox-input" type="checkbox"
                                {{ $isChecked ? 'checked' : '' }} disabled id="defaultCheck1" />
                            <label class="form-check-label custom-checkbox-label" for="defaultCheck1">
                                {{ $umum }}
                            </label>
                        </div>
                    </span>
                @endforeach

                <span class="small ms-2">
                    @php
                        $lainnyaCheckboxChecked = false;
                        // Periksa apakah variabel $statusFisik tidak null dan memiliki properti yang diinginkan
                        if ($item->statusFisikDiagnosaKeperawatanPatient->detailStatusFisikDiagnosaKeperawatanPatient) {
                            // Lakukan iterasi dan periksa properti yang diinginkan
                            foreach (
                                $item->statusFisikDiagnosaKeperawatanPatient
                                    ->detailStatusFisikDiagnosaKeperawatanPatient
                                as $detail
                            ) {
                                if ($detail->category === 'Kondisi Umum' && !in_array($detail->name, $kondisiUmum)) {
                                    $lainnyaCheckboxChecked = true;
                                    break; // Hentikan perulangan jika sudah ditemukan
                                }
                            }
                        }
                    @endphp
                    <div class="form-check">
                        <input class="form-check-input lainnya-checkbox custom-checkbox-input" type="checkbox"
                            name="lainnya-checkbox" id="lainnya-checkbox"
                            {{ $lainnyaCheckboxChecked ? 'checked' : '' }} disabled />
                        <label class="form-check-label custom-checkbox-label" for="defaultCheck2">
                            Lainnya :
                            {{ optional($item->statusFisikDiagnosaKeperawatanPatient)->detailStatusFisikDiagnosaKeperawatanPatient
                                ? $item->statusFisikDiagnosaKeperawatanPatient->detailStatusFisikDiagnosaKeperawatanPatient->where('category', 'Kondisi Umum')->whereNotIn('name', $kondisiUmum)->pluck('name')->first()
                                : '.................' }}
                        </label>
                    </div>
                </span>
            </div>

            {{-- Kesadaran --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Kesadaran :</span>
                @foreach ($kesadaran as $sadar)
                    @php
                        $isChecked = in_array(
                            $sadar,
                            $item->statusFisikDiagnosaKeperawatanPatient->detailStatusFisikDiagnosaKeperawatanPatient
                                ->where('category', 'Kesadaran')
                                ->pluck('name')
                                ->toArray(),
                        );
                    @endphp
                    <span class="small ms-2">
                        <div class="form-check">
                            <input class="form-check-input custom-checkbox-input" type="checkbox"
                                {{ $isChecked ? 'checked' : '' }} disabled id="defaultCheck1" />
                            <label class="form-check-label custom-checkbox-label" for="defaultCheck1">
                                {{ $sadar }}
                            </label>
                        </div>
                    </span>
                @endforeach
            </div>


            {{-- Tekanan Darah --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Tekanan Darah :</span>
                <span class="small ms-2">
                    {{ $item->statusFisikDiagnosaKeperawatanPatient->darah ?? '..........' }}
                </span>
                <span class="small ms-1">mmhg</span>

                <span class="small ms-3 fw-bold">Nadi :</span>
                <span class="small ms-2">
                    {{ $item->statusFisikDiagnosaKeperawatanPatient->nadi ?? '..........' }}
                </span>
                <span class="small ms-1">x/menit</span>

                <span class="small ms-3 fw-bold">Suhu</span>
                <span class="small ms-2">
                    {{ $item->statusFisikDiagnosaKeperawatanPatient->suhu ?? '..........' }}
                </span>
                <span class="small ms-1">°C</span>

                <span class="small ms-3 fw-bold">Pernafasan</span>
                <span class="small ms-2">
                    {{ $item->statusFisikDiagnosaKeperawatanPatient->pernafasan ?? '..........' }}
                </span>
                <span class="small ms-1">x/menit</span>
            </div>

            {{-- Tinggi Badan --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Tinggi Badan :</span>
                <span class="small ms-2">{{ $item->statusFisikDiagnosaKeperawatanPatient->tb ?? '..........' }}</span>
                <span class="small ms-1">cm</span>

                <span class="small fw-bold ms-3">Berat Badan :</span>
                <span class="small ms-2">{{ $item->statusFisikDiagnosaKeperawatanPatient->bb ?? '..........' }}</span>
                <span class="small ms-1">kg</span>
            </div>

            {{-- Kebutuhan Khusus --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Kebutuhan Khusus</span>
                @foreach ($kebutuhanKhusus as $khusus)
                    @php
                        $isChecked = in_array(
                            $khusus,
                            $item->statusFisikDiagnosaKeperawatanPatient->detailStatusFisikDiagnosaKeperawatanPatient
                                ->where('category', 'Kebutuhan Khusus')
                                ->pluck('name')
                                ->toArray(),
                        );
                    @endphp
                    <span class="small ms-2">
                        <div class="form-check">
                            <input class="form-check-input custom-checkbox-input" type="checkbox"
                                {{ $isChecked ? 'checked' : '' }} disabled id="defaultCheck1" />
                            <label class="form-check-label custom-checkbox-label" for="defaultCheck1">
                                {{ $khusus }}
                            </label>
                        </div>
                    </span>
                @endforeach
                <span class="small ms-2">
                    @php
                        $khususCheckboxChecked = false;
                        // Periksa apakah $statusFisik tidak null dan apakah ada data dengan kategori "Kebutuhan Khusus" dan nilai yang tidak ada dalam array kebutuhan khusus
                        if ($item->statusFisikDiagnosaKeperawatanPatient->detailStatusFisikDiagnosaKeperawatanPatient) {
                            foreach (
                                $item->statusFisikDiagnosaKeperawatanPatient
                                    ->detailStatusFisikDiagnosaKeperawatanPatient
                                as $detail
                            ) {
                                if (
                                    $detail->category === 'Kebutuhan Khusus' &&
                                    !in_array($detail->name, $kebutuhanKhusus)
                                ) {
                                    $khususCheckboxChecked = true;
                                    break; // Hentikan perulangan jika sudah ditemukan
                                }
                            }
                        }
                    @endphp
                    <div class="form-check">
                        <input class="form-check-input khusus-checkbox custom-checkbox-input" type="checkbox"
                            name="khusus-checkbox" id="khusus-checkbox" {{ $khususCheckboxChecked ? 'checked' : '' }}
                            disabled />
                        <label class="form-check-label custom-checkbox-label" for="defaultCheck2">
                            Lainnya :
                            {{ $item->statusFisikDiagnosaKeperawatanPatient ? $item->statusFisikDiagnosaKeperawatanPatient->detailStatusFisikDiagnosaKeperawatanPatient->where('category', 'Kebutuhan Khusus')->whereNotIn('name', $kebutuhanKhusus)->pluck('name')->first() : '............' }}
                        </label>
                    </div>
                </span>
            </div>




            <h6 class="text-center bg-gray text-dark small mt-1 py-1">PSIKO-SOSIO-SPRITUAL</h6>
            {{-- Psikologis --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Psikologis:</span>
                <div class="row ms-1">
                    @foreach ($psikologis as $psiko)
                        <div class="col-4">
                            @php
                                $isChecked = in_array(
                                    $psiko,
                                    $item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient
                                        ->where('category', 'psikologis')
                                        ->pluck('name')
                                        ->toArray(),
                                );
                            @endphp
                            <span class="">
                                <div class="form-check">
                                    <input class="form-check-input custom-checkbox-input" type="checkbox"
                                        {{ $isChecked ? 'checked' : '' }} disabled id="defaultCheck1" />
                                    <label class="form-check-label custom-checkbox-label small" for="defaultCheck1">
                                        {{ $psiko }}
                                    </label>
                                </div>
                            </span>

                        </div>
                    @endforeach

                </div>
                @php
                    $khususCheckboxChecked = false;
                    // Periksa apakah ada data dengan kategori "Kondisi Umum" dan nilai yang tidak ada dalam array kondisi umum
                    foreach ($dbpsiko->detailPsikoSosioSpritualDiagnosaKeperawatanPatient as $detail) {
                        if ($detail->category === 'psikologis' && !in_array($detail->name, $psikologis)) {
                            $khususCheckboxChecked = true;
                            break; // Hentikan perulangan jika sudah ditemukan
                        }
                    }
                @endphp
                <div class="form-check sm-2 small">
                    <input class="form-check-input psikologis-checkbox custom-checkbox-input" type="checkbox"
                        name="psikologis-checkbox" id="psikologis-checkbox"
                        {{ $khususCheckboxChecked ? 'checked' : '' }} disabled />
                    <label class="form-check-label custom-checkbox-label mx-2" for="psikologis-checkbox">
                        Lainnya :
                        {{ $dbpsiko->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'psikologis')->whereNotIn('name', $psikologis)->pluck('name')->first() }}
                    </label>

                </div>

            </div>

            {{-- Sosial --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold col-1">Sosial :</span>

                <div class="row mx-3">
                    <div class="col-12">
                        <span>
                            @foreach ($item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'sosial')->where('name', 'Pasien tinggal dirumah dengan siapa') as $detailPsiko)
                                @php
                                    $isChecked = $detailPsiko->value ? true : false;
                                @endphp
                                <div class="form-check d-flex flex-row">
                                    <input class="form-check-input custom-checkbox-input" type="checkbox"
                                        {{ $isChecked ? 'checked' : '' }} disabled id="tinggal" />
                                    <label class="form-check-label ms-2 small custom-checkbox-label" for="tinggal">
                                        Pasien tinggal dirumah dengan siapa
                                    </label>
                                    <span class="ms-2 small">{{ $detailPsiko->value ?? '.....' }}</span>
                                </div>
                            @endforeach
                        </span>
                    </div>
                    <div class="col-12">
                        <span class="">
                            @foreach ($item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'sosial')->where('name', 'Interaksi dengan lingkungan sekitar') as $detailPsiko)
                                @php
                                    $isChecked = $detailPsiko->value ? true : false;
                                @endphp
                                <div class="form-check d-flex flex-row">
                                    <input class="form-check-input custom-checkbox-input" type="checkbox"
                                        {{ $isChecked ? 'checked' : '' }} disabled id="interaksi" />
                                    <label class="form-check-label ms-2 small custom-checkbox-label" for="interaksi">
                                        Interaksi dengan lingkungan sekitar
                                    </label>
                                    <span class="ms-3 small">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input custom-radio-input" name="interaksi"
                                                type="radio" id="inlineCheckbox2"
                                                {{ $detailPsiko->value == 'Baik' ? 'checked' : '' }}
                                                value="Tidak Baik" disabled />
                                            <label class="form-check-label custom-checkbox-label"
                                                for="inlineCheckbox2">Baik</label>

                                        </div>
                                    </span>
                                    <span class="small">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input custom-radio-input" name="interaksi"
                                                type="radio" id="inlineCheckbox1"
                                                {{ $detailPsiko->value == 'Tidak Baik' ? 'checked' : '' }}
                                                value="Baik" disabled />
                                            <label class="form-check-label custom-checkbox-label"
                                                for="inlineCheckbox1">Tidak Baik</label>

                                        </div>
                                    </span>
                                </div>
                            @endforeach
                        </span>
                    </div>
                    <div class="col-12">
                        @foreach ($item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'sosial')->where('name', 'Datang kerumah sakit dengan siapa') as $detailPsiko)
                            @php
                                $isChecked = $detailPsiko->value ? true : false;
                            @endphp
                            <div class="form-check d-flex flex-row">
                                <input class="form-check-input custom-checkbox-input" type="checkbox"
                                    {{ $isChecked ? 'checked' : '' }} disabled id="datang" />
                                <label class="form-check-label ms-2 small custom-checkbox-label" for="datang">
                                    Datang kerumah sakit dengan siapa :
                                </label>
                                <span class="mx-2 small">{{ $detailPsiko->value ?? '.....' }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12">
                        @foreach ($item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'sosial')->where('name', 'Kerabat terdekat yang bisa dihubungi : ') as $detailPsiko)
                            @php
                                $isChecked = $detailPsiko->value ? true : false;
                            @endphp
                            <div class="form-check d-flex flex-row">
                                <input class="form-check-input custom-checkbox-input" type="checkbox"
                                    {{ $isChecked ? 'checked' : '' }} disabled id="kerabat" />
                                <label class="form-check-label ms-2 small custom-checkbox-label" for="kerabat">
                                    Kerabat terdekat yang bisa dihubungi :
                                </label>
                                <span class="ms-2 small">{{ $detailPsiko->value ?? '.....' }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-12">
                        @foreach ($item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where('category', 'sosial')->where('name', 'Hambatan Sosial') as $detailPsiko)
                            @php
                                $isChecked = $detailPsiko->value ? true : false;

                                // Ambil data dari database
                                $record = $item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient
                                    ->where('category', 'sosial')
                                    ->where('name', 'Hambatan Sosial')
                                    ->pluck('value')
                                    ->first();

                                // Inisialisasi variabel
                                $hambatanSosial = '';
                                $keteranganHambatanSosial = '';

                                // Parsing nilai jika ada data
                                if ($record) {
                                    if (strpos($record, ' Keterangan : ') !== false) {
                                        [$hambatanSosial, $keteranganHambatanSosial] = explode(
                                            ' Keterangan : ',
                                            $record,
                                        );
                                    } else {
                                        $hambatanSosial = $record;
                                    }
                                }
                            @endphp
                            <div class="form-check d-flex flex-row">
                                <input class="form-check-input custom-checkbox-input" type="checkbox"
                                    {{ $isChecked ? 'checked' : '' }} disabled id="hambatan" />
                                <label class="form-check-label ms-2 small custom-checkbox-label" for="hambatan">
                                    Hambatan Sosial
                                </label>
                                <span class="ms-3 small">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input custom-radio-input" name="hambatanSosial"
                                            type="radio" id="inlineCheckbox1"
                                            {{ $hambatanSosial === 'Tidak Ada' ? 'checked' : '' }} value="Tidak ada"
                                            disabled />
                                        <label class="form-check-label custom-radio-label" for="inlineCheckbox1">Tidak
                                            Ada</label>
                                    </div>
                                </span>
                                <span class="small">
                                    <div class="form-check form-check-inline">
                                        <div class="d-flex flex-row">
                                            <input class="form-check-input custom-radio-input" name="hambatanSosial"
                                                type="radio" id="inlineCheckbox2"
                                                {{ $hambatanSosial === 'Ada' ? 'checked' : '' }} value="Ada"
                                                disabled />
                                            <label class="form-check-label ms-2 custom-radio-label"
                                                for="inlineCheckbox2">Ada, sebutkan : </label>
                                            {{ $keteranganHambatanSosial ?? ' .........' }}
                                        </div>
                                    </div>
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- Spiritual --}}
            <div class="d-flex flex-row px-2 ">
                <span class="small fw-bold">Spiritual:</span>
                @php
                    $spirituals = $item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient->where(
                        'category',
                        'spritual',
                    );
                @endphp

                <div class="row ms-1">
                    <div class="col-12 mx-2">
                        <div class="row form-check d-flex">
                            <div class="mb-2 col-sm-1">
                                <input class="form-check-input custom-checkbox-input" type="checkbox" value="Sehat"
                                    name="spiritual_sehat" id="SpiritualSehat"
                                    onclick="toggleInput('SpiritualSehat', 'input-sehat')"
                                    {{ $spirituals->where('name', 'Sehat')->first() ? 'checked' : '' }} disabled />
                                <label for="SpiritualSehat" class="form-check-label">
                                    <p class="m-0">Sehat, </p>
                                </label>
                            </div>
                            <div class="mb-2 col-sm-2">
                                {{ $spirituals->where('name', 'Sehat')->pluck('value')->first() ?? '.............................' }}
                            </div>
                            <div class="mb-2 col-sm-9"></div>
                            <div class="mb-2 col-sm-1">
                                <input class="form-check-input custom-checkbox-input" type="checkbox" value="Sakit"
                                    name="spiritual_sakit" id="SpiritualSakit"
                                    onclick="toggleInput('SpiritualSakit', 'input-sakit')"
                                    {{ $spirituals->where('name', 'Sakit')->first() ? 'checked' : '' }} disabled />
                                <label for="SpiritualSakit" class="form-check-label">
                                    <p class="m-0">Sakit,</p>
                                </label>
                            </div>
                            <div class="mb-2 col-sm-2">
                                {{ $spirituals->where('name', 'Sakit')->pluck('value')->first() ?? '.............................' }}
                            </div>
                            <div class="mb-2 col-sm-9"></div>
                            <div class="mb-2 col-sm-auto">
                                <input class="form-check-input custom-checkbox-input" type="checkbox"
                                    value="Hambatan Spiritual" name="spiritual_hamSpiritual" id="hamSpiritual"
                                    onclick="toggleInput('hamSpiritual', 'input-hamSpiritual')"
                                    {{ $spirituals->where('name', 'Hambatan Spiritual')->isNotEmpty() ? 'checked' : '' }}
                                    disabled />
                                <label class="form-check-label" for="hamSpiritual">Hambatan Spiritual</label>

                                <div class="form-check form-check-inline mx-3">
                                    <input class="form-check-input" type="radio" name="hambatan-spiritual"
                                        id="tidakAdaH" value="Tidak Ada"
                                        {{ $spirituals->where('name', 'Hambatan Spiritual')->pluck('value')->first() == 'Tidak Ada' ? 'checked' : 'disabled' }} />
                                    <label class="form-check-label" for="tidakAdaH">Tidak Ada</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input custom-radio-input" type="radio"
                                        name="hambatan-spiritual" id="AdaH" value="Ada"
                                        {{ $spirituals->where('name', 'Hambatan Spiritual')->isNotEmpty() && $spirituals->where('name', 'Hambatan Spiritual')->pluck('value')->first() != 'Tidak Ada' ? 'checked' : 'disabled' }} />
                                    <label class="form-check-label d-flex" for="AdaH">
                                        Ada, sebutkan :
                                        <span class="ms-2">
                                            {{ $spirituals->where('name', 'Hambatan Spiritual')->pluck('value')->first() != 'Tidak Ada' ? $spirituals->where('name', 'Hambatan Spiritual')->pluck('value')->first() : '.............................' }}
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Kultural --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Klutural/Nilai Kepercayaan:</span>
                @php
                    // Ambil data dari database
                    $record = $item->psikoSosioSpritualDiagnosaKeperawatanPatient->detailPsikoSosioSpritualDiagnosaKeperawatanPatient
                        ->where('category', 'spritual')
                        ->where('name', 'Kultular / Nilai kepercayaan')
                        ->pluck('value')
                        ->first();

                    // Inisialisasi variabel
                    $nilaiKepercayaan = '';
                    $ketNilaiKepercayaan = '';

                    // Parsing nilai jika ada data
                    if ($record) {
                        if (strpos($record, ' Keterangan : ') !== false) {
                            [$nilaiKepercayaan, $ketNilaiKepercayaan] = explode(' Keterangan : ', $record);
                        } else {
                            $nilaiKepercayaan = $record;
                        }
                    }
                @endphp
                <div class="col-sm-auto">
                    <div class="form-check form-check-inline mx-3">
                        <input class="form-check-input" type="radio" name="nilai-kepercayaan" id="inlineCheckbox1"
                            value="Tidak Ada" {{ $nilaiKepercayaan === 'Tidak Ada' ? 'checked' : 'disabled' }} />
                        <label class="form-check-label custom-radio-label" for="inlineCheckbox1">Tidak Ada</label>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input custom-radio-input" type="radio" name="nilai-kepercayaan"
                            id="inlineCheckbox2" value="Ada"
                            {{ $nilaiKepercayaan === 'Ada' ? 'checked' : 'disabled' }} />
                        <label class="form-check-label d-flex custom-radio-label" for="inlineCheckbox2">
                            Ada, sebutkan :
                            <span class="mx-2">
                                {{ $ketNilaiKepercayaan ?? '.............' }}
                            </span>
                        </label>
                    </div>
                </div>
            </div>


            {{-- Rohani --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold ">Apakah pasien memerlukan pelayanan / bimbingan rohani ? </span>
                <div class="row">
                    <div class="col-sm-auto">
                        <div class="form-check form-check-inline mx-3">
                            <input class="form-check-input" name="rohani" type="radio" id="rohani1"
                                value="Tidak"
                                {{ $spirituals->where('name', 'Apakah pasien memerlukan pelayanan / bimbingan rohani')->pluck('value')->first() == 'Tidak' ? 'checked' : 'disabled' }} />
                            <label class="form-check-label" for="rohani1">Tidak</label>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="rohani" type="radio" id="rohani2"
                                value="Ya"
                                {{ $spirituals->where('name', 'Apakah pasien memerlukan pelayanan / bimbingan rohani')->pluck('value')->first() != 'Tidak' ? 'checked' : 'disabled' }} />
                            <label class="form-check-label d-flex" for="rohani2">
                                Ya
                                <span class="mx-2">
                                    {{ $spirituals->where('name', 'Apakah pasien memerlukan pelayanan / bimbingan rohani')->pluck('value')->first() != 'Tidak' ? $spirituals->where('name', 'Apakah pasien memerlukan pelayanan / bimbingan rohani')->pluck('value')->first() : '.................' }}
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>


            <h6 class="text-center bg-gray text-dark small mt-1 py-1">EKONOMI</h6>

            {{-- Pasien Menggunakan --}}
            {{-- <div class="d-flex flex-row px-2">
                <span class="small fw-bold"> Pasien menggunakan :</span>
                <div class="row ms-2">
                    <div class="col">
                        <div class="form-check small">
                            <input class="form-check-input" type="checkbox"
                                value="{{ $item->ekonomiDiagnosaKeperawatanPatient?->status }}" name="status"
                                id="statusCheck1"
                                {{ $item->ekonomiDiagnosaKeperawatanPatient?->status ? 'checked' : 'disabled' }} />

                            <label class="form-check-label" for="statusCheck1">
                                <p class="m-0 d-flex">{{ $item->ekonomiDiagnosaKeperawatanPatient->status ?? '' }}</p>
                            </label>
                        </div>
                    </div>
                </div>
            </div> --}}



            <div class="row px-2">
                <div class="col-md-12">
                    <div class="d-flex flex-row">
                        <span class="small fw-bold"> Pasien menggunakan :</span>
                        <div class="row small ms-1">
                            <div class="col-lg-3">
                                <div class="flex col-span-2 gap-x-1">
                                    <input disabled type="checkbox" class ="form-check-input custom-checkbox-input"
                                        {{ $ekonomi->status == 'BPJS-TK' ? 'checked' : '' }} />
                                    <label>BPJS-TK</label>
                                </div>
                                <div class="flex col-span-2 col-start-4 gap-x-1">
                                    <input disabled type="checkbox" class ="form-check-input custom-checkbox-input"
                                        {{ $ekonomi->status == 'Jasa Raharja' ? 'checked' : '' }} />
                                    <label>Jasa Raharja</label>
                                </div>

                            </div>
                            <div class="col-lg-3">
                                <div class="flex col-span-2 gap-x-1">
                                    <input disabled type="checkbox" class ="form-check-input custom-checkbox-input"
                                        {{ $ekonomi->status == 'BPJS' ? 'checked' : '' }} />
                                    <label>BPJS-KES</label>
                                </div>

                                <div class="flex col-span-2 gap-x-1">
                                    <input disabled type="checkbox" class ="form-check-input custom-checkbox-input"
                                        {{ $ekonomi->status == 'Umum' ? 'checked' : '' }} />
                                    <label>Umum</label>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="flex col-span-2 gap-x-1">
                                    <input disabled type="checkbox" class ="form-check-input custom-checkbox-input"
                                        {{ $ekonomi->status == 'Asuransi' ? 'checked' : '' }} />
                                    <label>Asuransi</label>
                                </div>
                                <div class="flex col-span-2 gap-x-1">
                                    <input disabled type="checkbox" class ="form-check-input custom-checkbox-input"
                                        {{ $ekonomi->status == 'Perusahaan' ? 'checked' : '' }} />
                                    <label>Perusahaan</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if (
                                    $ekonomi->status != 'BPJS-TK' &&
                                        $ekonomi->status != 'BPJS' &&
                                        $ekonomi->status != 'Asuransi' &&
                                        $ekonomi->status != 'Perusahaan' &&
                                        $ekonomi->status != 'Jasa Raharja' &&
                                        $ekonomi->status != 'Umum')
                                    <div class="flex col-span-4 gap-x-1">
                                        <input disabled type="checkbox"
                                            class ="form-check-input custom-checkbox-input" checked />
                                        <label>Lainnya</label>
                                        <label>:</label>
                                        <label>{{ $ekonomi->status }}</label>
                                    </div>
                                @else
                                    <div class="flex col-span-4 gap-x-1">
                                        <input disabled type="checkbox"
                                            class ="form-check-input custom-checkbox-input"
                                            {{ $ekonomi->status == 'BPJS-TK' ? 'checked' : '' }} />
                                        <label>Lainnya</label>
                                        <label> : ……………</label>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Hambatan Ekonomi --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Hambatan Ekonomi :</span>
                <div class="col-sm-auto">
                    <div class="form-check form-check-inline mx-4">
                        <input class="form-check-input" type="radio" name="hambatan-ekonomi"
                            id="hambatan-ekonomi1" value="Tidak"
                            {{ ($ekonomi->hambatan ?? '') == 'Tidak Ada' ? 'checked' : 'disabled' }} />
                        <label class="form-check-label" for="hambatan-ekonomi1">Tidak</label>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hambatan-ekonomi"
                            id="hambatan-ekonomi2" value="Ada"
                            {{ ($ekonomi->hambatan ?? '') != 'Tidak Ada' ? 'checked' : 'disabled' }} />
                        <label class="form-check-label d-flex" for="hambatan-ekonomi2">
                            Ada, sebutkan :
                            <span class="mx-1">
                                {{ optional($ekonomi)->hambatan != 'Tidak Ada' ? optional($ekonomi)->hambatan : ' ...................' }}
                            </span>
                        </label>
                    </div>
                </div>
            </div>


            <h6 class="text-center bg-gray text-dark small mt-1 py-1">RIWAYAT ALERGI</h6>
            @foreach ($item->riwayatAlergiDiagnosaKeperawatanPatient as $index => $riwayatAlergi)
                @if ($loop->first)
                    <div class="d-flex flex-row px-2 small">
                        <div class="form-check">
                            <input class="form-check-input"
                                {{ $riwayatAlergi->status == 'Tidak Ada' ? 'checked' : 'disabled' }} type="radio"
                                name="alergi" value="Tidak Ada" id="riwayatAlergi1" />
                            <label class="form-check-label" for="riwayatAlergi1">
                                Tidak Ada
                            </label>
                        </div>
                        <div class="form-check ms-5">
                            <input class="form-check-input"
                                {{ $riwayatAlergi->status == 'Tidak Diketahui' ? 'checked' : 'disabled' }}
                                type="radio" name="alergi" value="Tidak Diketahui" id="riwayatAlergi2" />
                            <label class="form-check-label" for="riwayatAlergi2">
                                Tidak Diketahui
                            </label>
                        </div>
                        <div class="form-check ms-5">
                            <input class="form-check-input"
                                {{ $riwayatAlergi->status == 'Ada' ? 'checked' : 'disabled' }} type="radio"
                                name="alergi" value="Ada" id="riwayatAlergi3" />
                            <label class="form-check-label" for="riwayatAlergi3">
                                Ada
                            </label>
                        </div>
                    </div>
                @endif
                <div class="row mb-0 px-2">
                    <div class="col-sm-6">
                        <div class="d-flex flex-row">
                            <p class="small col-4 mb-0">{{ $arrAlergi[$index] }}</p>
                            <div class=" small">
                                : {{ $riwayatAlergi->alergi ?? ' .............................' }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex flex-row">
                            <p class="m-0 small mb-0">Reaksi </p>
                            <div class="mx-2 small">
                                : {{ $riwayatAlergi->reaksi ?? ' ........................................' }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


            <h6 class="text-center bg-gray text-dark small mt-1 py-1">SKRINING DAN ASESMEN NYERI</h6>
            <div class="mb-3 small px-2">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-auto">
                            Apakah Pasien Merasa Nyeri ?
                        </div>
                        <div class="col-sm-auto">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="rasa-nyeri" type="radio" id="rasa-nyeri1"
                                    onclick="disableNyeri()" value="Tidak"
                                    {{ ($skrinAsesmenNyeri->status ?? '') == 'Tidak' ? 'checked' : '' }}
                                    {{ ($skrinAsesmenNyeri->status ?? '') == 'Ya' ? 'disabled' : '' }} />
                                <label class="form-check-label" for="rasa-nyeri1">Tidak</label>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="rasa-nyeri" type="radio" id="rasa-nyeri2"
                                    onclick="enableNyeri()" value="Ya"
                                    {{ ($skrinAsesmenNyeri->status ?? '') == 'Ya' ? 'checked' : '' }}
                                    {{ ($skrinAsesmenNyeri->status ?? '') == 'Tidak' ? 'disabled' : '' }} />
                                <label class="form-check-label d-flex" for="rasa-nyeri2">Ya</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-auto">
                            Kategori Nyeri
                        </div>
                        <div class="col-sm-auto">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input custom-radio-input" name="kategori-nyeri"
                                    type="radio" id="akut" value="Akut"
                                    {{ ($skrinAsesmenNyeri->category ?? '') == 'Akut' ? 'checked' : '' }}
                                    {{ ($skrinAsesmenNyeri->status ?? '') == 'Ya' ? '' : 'disabled' }}
                                    {{ ($skrinAsesmenNyeri->category ?? '') == 'kronis' ? '' : 'disabled' }} />
                                <label class="form-check-label" for="akut">Akut</label>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input custom-radio-input" name="kategori-nyeri"
                                    type="radio" id="kronis" value="Kronis"
                                    {{ ($skrinAsesmenNyeri->category ?? '') == 'Kronis' ? 'checked' : '' }}
                                    {{ ($skrinAsesmenNyeri->status ?? '') == 'Ya' ? '' : 'disabled' }}
                                    {{ ($skrinAsesmenNyeri->category ?? '') == 'akut' ? '' : 'disabled' }} />
                                <label class="form-check-label d-flex" for="kronis">Kronis</label>
                            </div>
                        </div>
                    </div>

                </div>

                <p class="m-0">Jika Ya, lakukan pengkajian nyeri lebih lanjut dengan format sesuai dengan usia
                    pasien
                </p>
                <table class="table-bordered w-100 mb-3">
                    <tbody>
                        <tr>
                            <th class="text-center">DEWASA (NUMERIC SCALE)</th>
                            <td rowspan="3" style="width: 650px">
                                <table class="">
                                    <tr>
                                        <td>Provocation (Pencetus)</td>
                                        <td>:</td>
                                        <td>
                                            {{-- <input type="text" name="provocation"
                                                value="{{ $item->asesmentNyeriDiagnosaKeperawatanPatient->provocation }}"
                                                placeholder="Provocation (Pencetus)"
                                                class="form-control form-control-sm" id="lainnya"
                                                aria-describedby="floatingInputHelp" /> --}}
                                            {{ $item->asesmentNyeriDiagnosaKeperawatanPatient->provocation ?? '..........' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Quality (Karakteristik)</td>
                                        <td>:</td>
                                        <td>
                                            {{-- <input type="text" name="quality"
                                                value="{{ $item->asesmentNyeriDiagnosaKeperawatanPatient->quality }}"
                                                placeholder="Quality (Karakteristik)"
                                                class="form-control form-control-sm" id="lainnya"
                                                aria-describedby="floatingInputHelp" /> --}}
                                            {{ $item->asesmentNyeriDiagnosaKeperawatanPatient->quality ?? '..........' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Region (Lokasi/Penjalaran)</td>
                                        <td>:</td>
                                        <td>
                                            {{-- <input type="text" name="region"
                                                value="{{ $item->asesmentNyeriDiagnosaKeperawatanPatient->region }}"
                                                placeholder="Region (Lokasi/Penjalaran)"
                                                class="form-control form-control-sm" id="lainnya"
                                                aria-describedby="floatingInputHelp" /> --}}
                                            {{ $item->asesmentNyeriDiagnosaKeperawatanPatient->region ?? '..........' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Severity (Keparahan)</td>
                                        <td>:</td>
                                        <td>
                                            {{-- <input type="text" name="severity"
                                                value="{{ $item->asesmentNyeriDiagnosaKeperawatanPatient->severity }}"
                                                placeholder="Severity (Keparahan)"
                                                class="form-control form-control-sm" id="lainnya"
                                                aria-describedby="floatingInputHelp" /> --}}
                                            {{ $item->asesmentNyeriDiagnosaKeperawatanPatient->severity ?? '..........' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Time (Durasi dan Frekuensi)</td>
                                        <td>:</td>
                                        <td>
                                            {{-- <input type="text" name="time"
                                                value="{{ $item->asesmentNyeriDiagnosaKeperawatanPatient->time }}"
                                                placeholder="Time (Durasi dan Frekuensi)"
                                                class="form-control form-control-sm" id="lainnya"
                                                aria-describedby="floatingInputHelp" /> --}}
                                            {{ $item->asesmentNyeriDiagnosaKeperawatanPatient->time ?? '..........' }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{ asset('/assets/img/aakprj1.jpg') }}" alt="" class="img-fluid"
                                    style="max-width: 350px">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{ asset('/assets/img/aakprj2.jpg') }}" alt="" class="img-fluid"
                                    style="max-width: 350px">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12">
                        <p class="fw-bold m-0">Nyeri hilang, dengan :</p>
                        <div class="d-flex flex-row">
                            @foreach ($asesmentNyeri as $nyeri)
                                @php
                                    $isChecked = false;
                                    if ($item->asesmentNyeriDiagnosaKeperawatanPatient) {
                                        $isChecked = in_array(
                                            $nyeri,
                                            $item->asesmentNyeriDiagnosaKeperawatanPatient->detailAsesmentNyeriDiagnosaKeperawatanPatient
                                                ->pluck('name')
                                                ->toArray(),
                                        );
                                    }
                                @endphp
                                <div class="form-check pe-4">
                                    <input class="form-check-input custom-checkbox-input" name="nyeri-hilang[]"
                                        type="checkbox" value="{{ $nyeri }}"
                                        id="defaultCheck{{ $loop->index }}" {{ $isChecked ? 'checked' : '' }}
                                        {{ !$isChecked ? 'disabled' : '' }} disabled />
                                    <label class="form-check-label custom-checkbox-label"
                                        for="defaultCheck{{ $loop->index }}">
                                        {{ $nyeri }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex flex-row">
                            @php
                                $isCheckedLain2 = false;
                                $lain2Value = '';
                                if ($item->asesmentNyeriDiagnosaKeperawatanPatient) {
                                    $isCheckedLain2 = in_array(
                                        'lain2',
                                        $item->asesmentNyeriDiagnosaKeperawatanPatient->detailAsesmentNyeriDiagnosaKeperawatanPatient
                                            ->pluck('name')
                                            ->toArray(),
                                    );
                                    if ($isCheckedLain2) {
                                        $lain2Value = $item->asesmentNyeriDiagnosaKeperawatanPatient->detailAsesmentNyeriDiagnosaKeperawatanPatient
                                            ->where('name', 'lain2')
                                            ->pluck('value')
                                            ->first();
                                    }
                                }
                            @endphp
                            <input class="form-check-input" name="lain2" type="checkbox" value="lain2"
                                id="defaultCheckLain2" {{ $isCheckedLain2 ? 'checked' : '' }}
                                {{ !$isCheckedLain2 ? 'disabled' : '' }} />
                            <label class="form-check-label ms-2" for="defaultCheckLain2">
                                Lain-lain. sebutkan :
                            </label>
                            <div class="">
                                {{ $lain2Value ?? '.............................' }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        {{-- Footer --}}
        <div class="d-flex flex-row justify-content-between mt-4">
            <div class="d-flex flex-row text-center" style="font-size: 5pt">
                <div class="col col-3 text-center">
                    <i class="bi bi-geo-alt-fill"></i>
                    <p>Jl. Aur No. 8, Ujung Gurun, Padang Barat, Kota Padang, Sumatera Barat</p>
                </div>
                <div class="col col-3 text-center">
                    <i class="bi bi-envelope-at-fill"></i>
                    <p>rskbropanasuripadang@gmail.com</p>
                </div>
                <div class="col col-3 text-center">
                    <i class="bi bi-telephone-fill"></i>
                    <p>(0751) 31938 - 33854 - 25735 - 8955227</p>
                </div>
            </div>
            <p class="mt-2"><span class="border border-dark">RM 01.RJ.KEP.REV.1-1/3</span></p>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="page">
        <div class="header">
            <div class="d-flex flex-row align-items-center justify-content-center">
                <div class="col-1">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                </div>
                <div class="text-center mx-2">
                    <h1>ASESMEN AWAL KEPERAWATAN <br> PASIEN RAWAT JALAN</h1>
                </div>
                <div class="small">
                    <div class="border border-dark py-1 px-1" style="border-radius: 15px">
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
                                <td>{{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
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
        <h6 class="text-center bg-gray text-dark small py-1 mt-2">SKRINING RESIKO JATUH RAWAT JALAN (GET UP AND GO
            TEST)</h6>
        <table class="table table-bordered w-100 small">
            <thead>
                <tr class="text-center">
                    <th colspan="2" class="text-body">KOMPONEN PENILAIAN</th>
                    <th class="text-body">YA</th>
                    <th class="text-body">TIDAK</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">a. Perhatikan cara berjalan pasien saat akan duduk di kursi. Apakah pasien
                        tampak tidak seimbang (sempoyongan / linglung)?</td>
                    <td class="text-center">
                        <input class="form-check-input custom-radio-input" name="a" type="radio"
                            {{ optional($item->resikoRajalDiagnosaKeperawatanPatient)->a == 'ya' ? 'checked' : 'disabled' }}
                            disabled value="ya" id="defaultCheck1" />
                    </td>
                    <td class="text-center">
                        <input class="form-check-input custom-radio-input" name="a" type="radio"
                            {{ optional($item->resikoRajalDiagnosaKeperawatanPatient)->a == 'tidak' ? 'checked' : 'disabled' }}
                            disabled value="tidak" id="defaultCheck1" />
                    </td>

                </tr>
                <tr>
                    <td colspan="2">b. Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai
                        penopang saat akan duduk?</td>
                    <td class="text-center">
                        <input class="form-check-input custom-radio-input" name="b" type="radio"
                            {{ optional($item->resikoRajalDiagnosaKeperawatanPatient)->b == 'ya' ? 'checked' : 'disabled' }}
                            disabled value="ya" id="defaultCheck1" />
                    </td>
                    <td class="text-center">
                        <input class="form-check-input custom-radio-input" name="b" type="radio"
                            {{ optional($item->resikoRajalDiagnosaKeperawatanPatient)->b == 'tidak' ? 'checked' : 'disabled' }}
                            disabled value="tidak" id="defaultCheck1" />
                    </td>

                </tr>
                <tr>
                    <td style="width: 50%">
                        <p class="m-0">Kategori :</p>
                        <div class="mx-3">
                            @foreach ($komponenPenilaian1 as $index => $komponen1)
                                @php
                                    $checked = false;
                                    $disabled = 'disabled';

                                    if ($resikorajal && $resikorajal->detailResikoRajalDiagnosaKeperawatanPatient) {
                                        $detail = $resikorajal->detailResikoRajalDiagnosaKeperawatanPatient
                                            ->where('name', $komponen1)
                                            ->first();
                                        if ($detail) {
                                            $checked = true;
                                            $disabled = '';
                                        }
                                    }
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input custom-checkbox-input"
                                        name="kategori-skrining-rajal[]" value="{{ $komponen1 }}"
                                        id="komponen1{{ $index + 1 }}" type="checkbox"
                                        {{ $checked ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="komponen1{{ $index + 1 }}">
                                        {{ $komponen1 }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td colspan="3">
                        @foreach ($komponenPenilaian2 as $index => $komponen2)
                            @php
                                $checked = false;
                                $disabled = 'disabled';

                                if ($resikorajal && $resikorajal->detailResikoRajalDiagnosaKeperawatanPatient) {
                                    $detail = $resikorajal->detailResikoRajalDiagnosaKeperawatanPatient
                                        ->where('name', $komponen2)
                                        ->first();
                                    if ($detail) {
                                        $checked = true;
                                        $disabled = '';
                                    }
                                }
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input custom-checkbox-input" name="kategori-skrining-rajal[]"
                                    value="{{ $komponen2 }}" id="komponen2{{ $index + 1 }}" type="checkbox"
                                    {{ $checked ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="komponen2{{ $index + 1 }}">
                                    {{ $komponen2 }}
                                </label>
                            </div>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>


        <h6 class="text-center bg-gray text-dark small py-1">ASESMEN STATUS FUNGSIONAL</h6>
        <table class="table table-bordered small mb-3">
            <thead>
                <tr class="text-center">
                    <td>Kategori & Skor</td>
                    <td>No</td>
                    <td>Kriteria Barthel Index</td>
                    <td style="width: 130px;">Dengan Bantuan</td>
                    <td>Mandiri</td>
                    <td>Nilai</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="11" style="min-width: 220px">
                        @php
                            $nilaiFungsional = $item->nilaiFungsional ?? '';
                        @endphp
                        <div class="form-check">
                            <input class="form-check-input custom-radio-input" type="radio" name="fungsional"
                                id="fungsional1" value="100"
                                {{ $nilaiFungsional == '100' ? 'checked' : 'disabled' }}>
                            <label class="form-check-label" for="fungsional1">
                                Mandiri : 100
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input custom-radio-input" type="radio" name="fungsional"
                                id="fungsional2" value="91-99"
                                {{ $nilaiFungsional == '91-99' ? 'checked' : 'disabled' }}>
                            <label class="form-check-label" for="fungsional2">
                                Ketergantungan Ringan : 91-99
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input custom-radio-input" type="radio" name="fungsional"
                                id="fungsional3" value="62-90"
                                {{ $nilaiFungsional == '62-90' ? 'checked' : 'disabled' }}>
                            <label class="form-check-label" for="fungsional3">
                                Ketergantungan Sedang : 62-90
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input custom-radio-input" type="radio" name="fungsional"
                                id="fungsional4" value="21-61"
                                {{ $nilaiFungsional == '21-61' ? 'checked' : 'disabled' }}>
                            <label class="form-check-label" for="fungsional4">
                                Ketergantungan Berat : 21-61
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input custom-radio-input" type="radio" name="fungsional"
                                id="fungsional5" value="0-20"
                                {{ $nilaiFungsional == '0-20' ? 'checked' : 'disabled' }}>
                            <label class="form-check-label" for="fungsional5">
                                Ketergantungan Total : 0-20
                            </label>
                        </div>
                        <i class="small">(Bila Ketergantungan Total, kolaborasi dengan DPJP)</i>
                    </td>
                </tr>
                @if (
                    $item &&
                        $item->asesmentStatusFungsionalDiagnosaKeperawatanPatient &&
                        $item->asesmentStatusFungsionalDiagnosaKeperawatanPatient->detailAsesmentStatusFungsionalDiagnosaKeperawatanPatient)
                    @foreach ($item->asesmentStatusFungsionalDiagnosaKeperawatanPatient->detailAsesmentStatusFungsionalDiagnosaKeperawatanPatient as $fungsional)
                        @php
                            $bantuan = '0';
                            $mandiri = '0';
                            if ($loop->iteration < 3 || $loop->iteration > 6) {
                                $bantuan = '5';
                                $mandiri = '10';
                            } elseif ($loop->iteration > 3 && $loop->iteration < 6) {
                                $bantuan = '0';
                                $mandiri = '5';
                            } else {
                                $bantuan = '5-10';
                                $mandiri = '15';
                            }
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $fungsional->name }}</td>
                            <td>{{ $bantuan }}</td>
                            <td>{{ $mandiri }}</td>
                            <td>
                                {{ $fungsional->nilai }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <!-- Handle the case where $item or its properties are null -->
                    @foreach ($kriteriaNames as $fungsional)
                        @php
                            $bantuan = '0';
                            $mandiri = '0';
                            $values = [];
                            if ($loop->iteration < 3 || $loop->iteration > 6) {
                                $bantuan = '5';
                                $mandiri = '10';
                                $values = [0, 5, 10];
                            } elseif ($loop->iteration > 3 && $loop->iteration < 6) {
                                $bantuan = '0';
                                $mandiri = '5';
                                $values = [0, 5];
                            } else {
                                $bantuan = '5-10';
                                $mandiri = '15';
                                $values = [0, 5, 10, 15];
                            }

                            $selectedValue = null;

                            // Jika tidak ada nilai tersimpan, gunakan nilai tertinggi dari $values sebagai default
                            if (is_null($selectedValue) && !empty($values)) {
                                $selectedValue = max($values);
                            }
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $fungsional }}</td>
                            <td>{{ $bantuan }}</td>
                            <td>{{ $mandiri }}</td>
                            <td>
                                <select name="kriteria[]" id="" class="form-control" disabled>
                                    @foreach ($values as $vl)
                                        <option value="{{ $vl }}"
                                            {{ $vl == $selectedValue ? 'selected' : '' }}>{{ $vl }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endforeach
                @endif


                {{-- <td></td> --}}
                <td colspan="5">Total</td>

                <td>
                    @php
                        $nilaiSum =
                            optional(
                                optional($item->asesmentStatusFungsionalDiagnosaKeperawatanPatient)
                                    ->detailAsesmentStatusFungsionalDiagnosaKeperawatanPatient,
                            )->sum('nilai') ?? 100;
                    @endphp

                    <input type="number" value="{{ $nilaiSum }}" class="form-control form-control-sm"
                        id="total" placeholder="" disabled />

                </td>

            </tbody>
        </table>

        <h6 class="text-center bg-gray text-dark small py-1">SKRINING RISIKO NUTRISIONAL</h6>
        <table class="table table-bordered mb-3">
            <thead class="text-center">
                <tr>
                    @if ($usia < 18)
                        <td class="w-50">Skrining Gizi Pada Anak <br> Berdasarkan Metode Strong Kids (usia < 18)</td>
                            @else
                        <td class="anak">Skrining Gizi Pada Dewasa <br> Berdasarkan Metode MST (usia > 18)</td>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if ($usia < 18)
                        <td class="p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Parameter</td>
                                        <td>Jawaban</td>
                                        <td>Nilai</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Apakah pasien tampak kurus?</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input custom-radio-input " name="anak-satu"
                                                    type="radio" value="1" id="defaultCheck1"
                                                    {{ $anak->where('name', 'Apakah pasien tampak kurus?')->pluck('nilai')->first() == '1' ? 'checked' : 'disabled' }}
                                                    data-score="1" />

                                                <label class="form-check-label" for="defaultCheck1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input custom-radio-input " name="anak-satu"
                                                    type="radio" value="0" id="defaultCheck2"
                                                    {{ $anak->where('name', 'Apakah pasien tampak kurus?')->pluck('nilai')->first() == '0' ? 'checked' : 'disabled' }}
                                                    data-score="0" />
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Tidak
                                                </label>
                                            </div>
                                        </td>
                                        <td class="fw-bold text-center">1 <br> 0</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan
                                            penilaian objectif</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input custom-radio-input " name="anak-dua"
                                                    type="radio" value="1" id="defaultCheck1"
                                                    {{ $anak->where('name', 'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif')->pluck('nilai')->first() == '1' ? 'checked' : 'disabled' }}
                                                    data-score="1" />
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input custom-radio-input " name="anak-dua"
                                                    type="radio" value="0" id="defaultCheck2"
                                                    {{ $anak->where('name', 'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif')->pluck('nilai')->first() == '0' ? 'checked' : 'disabled' }}
                                                    data-score="0" />
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Tidak
                                                </label>
                                            </div>
                                        </td>
                                        <td class="fw-bold text-center">1 <br> 0</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            Apakah terdapat salah satu kondisi berikut?
                                            <ul>
                                                <li>Diare ≥ 5 kali/hari dan atau muntah > 3 kali/hari dalam seminggu
                                                    terakhir</li>
                                                <li>Asupan makanan kurang selama 1 minggu terakhir</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input custom-radio-input " name="anak-tiga"
                                                    type="radio" value="1" id="defaultCheck1"
                                                    {{ $anak->where('name', 'Apakah terdapat salah satu kondisi berikut? - Diare ≥ 5 kali/hari dan atau muntah > 3 kali/hari dalam seminggu terakhir - Asupan makanan kurang selama 1 minggu terakhir')->pluck('nilai')->first() == '1' ? 'checked' : 'disabled' }}
                                                    data-score="1" />
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input custom-radio-input " name="anak-tiga"
                                                    type="radio" value="0" id="defaultCheck2"
                                                    {{ $anak->where('name', 'Apakah terdapat salah satu kondisi berikut? - Diare ≥ 5 kali/hari dan atau muntah > 3 kali/hari dalam seminggu terakhir - Asupan makanan kurang selama 1 minggu terakhir')->pluck('nilai')->first() == '0' ? 'checked' : 'disabled' }}
                                                    data-score="0" />
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Tidak
                                                </label>
                                            </div>
                                        </td>
                                        <td class="fw-bold text-center">1 <br> 0</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Apakah terdapat penyakit atau keadaan yang mangakibatkan pasien beresiko
                                            malnutrisi dan sudah malnutrisi (Gizi buruk)?</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input custom-radio-input " name="anak-empat"
                                                    type="radio" value="2" id="defaultCheck1"
                                                    {{ $anak->where('name', 'Apakah terdapat penyakit atau keadaan yang mangakibatkan pasien beresiko malnutrisi dan sudah malnutrisi (Gizi buruk)?')->pluck('nilai')->first() == '2' ? 'checked' : 'disabled' }}
                                                    data-score="2" />
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input custom-radio-input " name="anak-empat"
                                                    type="radio" value="0" id="defaultCheck2"
                                                    {{ $anak->where('name', 'Apakah terdapat penyakit atau keadaan yang mangakibatkan pasien beresiko malnutrisi dan sudah malnutrisi (Gizi buruk)?')->pluck('nilai')->first() == '0' ? 'checked' : 'disabled' }}
                                                    data-score="0" />
                                                <label class="form-check-label" for="defaultCheck2">
                                                    Tidak
                                                </label>
                                            </div>
                                        </td>
                                        <td class="fw-bold text-center">2 <br> 0</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">Total Skor</td>
                                        <td class="fw-bold text-center" id="total-score">0</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                    @else
                        <td class="p-0">
                            <table class="table table-bordered fs-sm">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Parameter</td>
                                        <td>Nilai</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="9">1</td>
                                        <td>Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak
                                            diinginkan dalam 6 bulan terakhir?</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <li>Tidak</li>
                                        </td>
                                        <td class="fw-bold text-center">
                                            <input class="form-check-input custom-radio-input " type="radio"
                                                name="dewasa-satu" checked value="Tidak" id="defaultCheck3"
                                                {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Tidak')->pluck('nilai')->first() == '0' ? 'checked' : 'disabled' }}
                                                data-score="0" />

                                            <label class="form-check-label" for="defaultCheck3">
                                                0
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <li>Tidak yakin (tanda-tanda : baju menjadi longgar)</li>
                                        </td>
                                        <td class="fw-bold text-center">
                                            <input class="form-check-input custom-radio-input " type="radio"
                                                name="dewasa-satu"
                                                value="Tidak yakin (tanda-tanda : baju menjadi longgar)"
                                                id="defaultCheck3"
                                                {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Tidak yakin (tanda-tanda : baju menjadi longgar)')->pluck('nilai')->first() == '2' ? 'checked' : 'disabled' }}
                                                data-score="2" />

                                            <label class="form-check-label" for="defaultCheck3">
                                                2
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <li>Ya, ada penurunan BB sebanyak :</li>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mx-4">1-5 Kg</span>
                                        </td>
                                        <td class="fw-bold text-center">
                                            <input class="form-check-input custom-radio-input " type="radio"
                                                name="dewasa-satu" value="1-5 Kg" id="defaultCheck3"
                                                {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 1-5 Kg')->pluck('nilai')->first() == '1' ? 'checked' : 'disabled' }}
                                                data-score="1" />

                                            <label class="form-check-label" for="defaultCheck3">
                                                1
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mx-4">6-10 Kg</span>
                                        </td>
                                        <td class="fw-bold text-center">
                                            <input class="form-check-input custom-radio-input " type="radio"
                                                name="dewasa-satu" value="6-10 Kg" id="defaultCheck3"
                                                {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 6-10 Kg')->pluck('nilai')->first() == '2' ? 'checked' : 'disabled' }}
                                                data-score="2" />

                                            <label class="form-check-label" for="defaultCheck3">
                                                2
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mx-4">11-15 Kg</span>
                                        </td>
                                        <td class="fw-bold text-center">
                                            <input class="form-check-input custom-radio-input " type="radio"
                                                name="dewasa-satu" value="11-15 Kg" id="defaultCheck3"
                                                {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 11-15 Kg')->pluck('nilai')->first() == '3' ? 'checked' : 'disabled' }}
                                                data-score="3" />

                                            <label class="form-check-label" for="defaultCheck3">
                                                3
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="mx-4">>15 Kg</span>
                                        </td>
                                        <td class="fw-bold text-center">
                                            <input class="form-check-input custom-radio-input " type="radio"
                                                name="dewasa-satu" value=">15 Kg" id="defaultCheck3"
                                                {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak >15 Kg')->pluck('nilai')->first() == '4' ? 'checked' : 'disabled' }}
                                                data-score="4" />

                                            <label class="form-check-label" for="defaultCheck3">
                                                4
                                            </label>
                                        </td>
                                    <tr>
                                        <td>
                                            <span class="mx-4">Tidak tahu berapa kg penurunan</span>
                                        </td>
                                        <td class="fw-bold text-center">
                                            <input class="form-check-input custom-radio-input " type="radio"
                                                name="dewasa-satu" value="Tidak tahu berapa kg penurunan"
                                                id="defaultCheck3"
                                                {{ $dewasaDua->where('name', 'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak Tidak tahu berapa kg penurunan')->pluck('nilai')->first() == '2' ? 'checked' : 'disabled' }}
                                                data-score="2" />

                                            <label class="form-check-label" for="defaultCheck3">
                                                2
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Apakah asupan makanan pasien berkurang karena penurunan nafsu
                                            makan/kesulitan menerima makanan
                                            <ul>
                                                <li>Tidak</li>
                                                <li>Ya</li>
                                            </ul>
                                        </td>
                                        <td class="fw-bold text-center">
                                            <input class="form-check-input custom-radio-input " type="radio"
                                                name="dewasa-dua" value="0" id="defaultCheck3"
                                                {{ $dewasaDua->where('name', 'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif ? Tidak')->pluck('nilai')->first() == '0' ? 'checked' : 'disabled' }}
                                                data-score="0" />
                                            <label class="form-check-label" for="defaultCheck3">
                                                0
                                            </label>
                                            <br>
                                            <input class="form-check-input custom-radio-input " type="radio"
                                                name="dewasa-dua" value="1" id="defaultCheck4"
                                                {{ $dewasaDua->where('name', 'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif ? Ya')->pluck('nilai')->first() == '1' ? 'checked' : 'disabled' }}
                                                data-score="1" />
                                            <label class="form-check-label" for="defaultCheck4">
                                                1
                                            </label>
                                        </td>

                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Total Skor</td>
                                        <td class="fw-bold text-center" id="total-score">0</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                    @endif
                </tr>
                <tr>
                    @if ($usia < 18)
                        <td class="text-center">Bila skor : 4-5 dilakukan pengkajian lebih lanjut oleh dietisen
                        </td>
                    @else
                        <td class="text-center">Bila skor MST ≥2 dilakukan pengkajian lebih lanjut oleh dietisen
                        </td>
                    @endif
                </tr>
            </tbody>
        </table>

        {{-- Footer --}}
        <div class="d-flex flex-row justify-content-between mt-4">
            <div class="d-flex flex-row text-center" style="font-size: 5pt">
                <div class="col col-3 text-center">
                    <i class="bi bi-geo-alt-fill"></i>
                    <p>Jl. Aur No. 8, Ujung Gurun, Padang Barat, Kota Padang, Sumatera Barat</p>
                </div>
                <div class="col col-3 text-center">
                    <i class="bi bi-envelope-at-fill"></i>
                    <p>rskbropanasuripadang@gmail.com</p>
                </div>
                <div class="col col-3 text-center">
                    <i class="bi bi-telephone-fill"></i>
                    <p>(0751) 31938 - 33854 - 25735 - 8955227</p>
                </div>
            </div>
            <p class="mt-2"><span class="border border-dark">RM 01.RJ.KEP.REV.1-1/3</span></p>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="page">
        <div class="header">
            <div class="d-flex flex-row align-items-center justify-content-center">
                <div class="col-1">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                </div>
                <div class="text-center mx-2">
                    <h1>ASESMEN AWAL KEPERAWATAN <br> PASIEN RAWAT JALAN</h1>
                </div>
                <div class="small">
                    <div class="border border-dark py-1 px-1" style="border-radius: 15px">
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
                                <td>{{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
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

        <div class="border border-dark mt-4">
            <h6 class="text-center bg-gray text-dark small py-1">DIAGNOSIS KEPERAWATAN</h6>

            <div class="row mb-3 small">

                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input" type="checkbox" name="diagnosis-keperawatan[]"
                            value="Ansietas" id="ansietasCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Ansietas')->first() ? 'checked' : 'disabled' }} />
                        <label class="form-check-label" for="ansietasCheck">
                            Ansietas
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdAnsietas as $bd)
                            @php
                                $checked = null;
                                if ($detailDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $bd)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                    }
                                }
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input ansietas-option custom-checkbox-input" type="checkbox"
                                    value="{{ $bd }}" name="ansietas[]"
                                    id="ansietasOption{{ $loop->index + 2 }}" disabled {{ $checked }}
                                    disabled />
                                <label class="form-check-label custom-checkbox-label"
                                    for="ansietasOption{{ $loop->index + 2 }}">
                                    {{ $bd }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Diagnosis Nyeri Akut -->
                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input custom-checkbox-input" type="checkbox" value="Nyeri Akut"
                            name="diagnosis-keperawatan[]" id="nyeriAkutCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Nyeri Akut')->first() ? 'checked' : 'disabled' }}
                            disabled />
                        <label class="form-check-label" for="nyeriAkutCheck">
                            Nyeri Akut
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdNyeri as $key => $subOptions)
                            @php
                                $checked = null;
                                $selectedDetail = null;

                                if ($detailDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $key)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                        $selectedDetail = $detail->detail_name;
                                    } else {
                                        $checked = 'disabled';
                                    }
                                }

                            @endphp

                            <div class="form-check">
                                <input class="form-check-input custom-checkbox-input nyeri-akut-option"
                                    type="checkbox" name="nyeri-akut[]" value="{{ $key }}"
                                    id="nyeriAkutOption{{ $loop->index }}" {{ $checked }} disabled>
                                <label class="form-check-label" for="nyeriAkutOption{{ $loop->index }}">
                                    {{ $key }}
                                    @if ($detail && $detail->detail_name)
                                        ({{ $detail->detail_name }})
                                    @endif

                                </label>
                            </div>
                            <div id="subOptions{{ $loop->index }}" class="sub-options"
                                style="display: none; margin-left: 20px;">
                                @foreach ($subOptions as $subOption)
                                    @php
                                        $subChecked = $selectedDetail == $subOption ? 'checked' : '';
                                    @endphp
                                    <div class="form-check">
                                        <input class="form-check-input nyeri-akut-sub custom-radio-input"
                                            type="radio" name="detail-nyeri[{{ $key }}]"
                                            value="{{ $subOption }}"
                                            id="subOption{{ $loop->parent->index }}{{ $loop->index }}"
                                            {{ $subChecked }}>
                                        <label class="form-check-label"
                                            for="subOption{{ $loop->parent->index }}{{ $loop->index }}">
                                            {{ $subOption }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- Diagnosis Nyeri Kronis -->
                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input custom-checkbox-input" type="checkbox" value="Nyeri Kronis"
                            name="diagnosis-keperawatan[]" id="nyeriKronisCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Nyeri Kronis')->first() ? 'checked' : 'disabled' }}
                            disabled />
                        <label class="form-check-label" for="nyeriKronisCheck">
                            Nyeri Kronis
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdNyeriKronis as $key => $subOptions)
                            @php
                                $checked = null;
                                $selectedDetail = null;

                                if ($detailDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $key)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                        $selectedDetail = $detail->detail_name;
                                    }
                                }
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input nyeri-kronis-option custom-checkbox-input"
                                    type="checkbox" name="nyeri-kronis[]" value="{{ $key }}"
                                    id="nyeriKronisOption{{ $loop->index }}" {{ $checked }} disabled>
                                <label class="form-check-label" for="nyeriKronisOption{{ $loop->index }}">
                                    {{ $key }} @if ($detail && $detail->detail_name)
                                        ({{ $detail->detail_name }})
                                    @endif

                                </label>
                            </div>
                            @if (!empty($subOptions))
                                <div id="subOptionsKronis{{ $loop->index }}" class="sub-options"
                                    style="display: none; margin-left: 20px;">
                                    @foreach ($subOptions as $subOption)
                                        @php
                                            $subChecked = $selectedDetail == $subOption ? 'checked' : '';
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input nyeri-kronis-sub" type="radio"
                                                name="detail-nyeri[{{ $key }}]"
                                                value="{{ $subOption }}"
                                                id="subOptionKronis{{ $loop->parent->index }}{{ $loop->index }}"
                                                {{ $subChecked }}>
                                            <label class="form-check-label"
                                                for="subOptionKronis{{ $loop->parent->index }}{{ $loop->index }}">
                                                {{ $subOption }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Diagnosis Gangguan Mobilitas Fisik -->
                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input custom-checkbox-input" type="checkbox"
                            value="Gangguan Mobilitas Fisik" name="diagnosis-keperawatan[]" id="mobilitasCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Gangguan Mobilitas Fisik')->first() ? 'checked' : 'disabled' }}
                            disabled />
                        <label class="form-check-label" for="mobilitasCheck">
                            Gangguan Mobilitas Fisik
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdFisik as $bd)
                            @php
                                $checked = null;
                                if ($asesmenDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $bd)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                    }
                                }
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input mobilitas-option custom-checkbox-input" type="checkbox"
                                    value="{{ $bd }}" name="gangguan-mobilitas-fisik[]"
                                    id="mobilitasOption{{ $loop->index + 2 }}" disabled {{ $checked }}
                                    disabled />
                                <label class="form-check-label" for="mobilitasOption{{ $loop->index + 2 }}">
                                    {{ $bd }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Diagnosis Gangguan Integritas Kulit -->
                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input custom-checkbox-input" type="checkbox"
                            value="Gangguan Integritas Kulit" name="diagnosis-keperawatan[]" id="kulitCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Gangguan Integritas Kulit')->first() ? 'checked' : 'disabled' }}
                            disabled />
                        <label class="form-check-label" for="kulitCheck">
                            Gangguan Integritas Kulit
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdKulit as $key => $subOptions)
                            @php
                                $checked = null;
                                $selectedDetail = null;

                                if ($detailDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $key)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                        $selectedDetail = $detail->detail_name;
                                    }
                                }
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input kulit-option custom-checkbox-input" type="checkbox"
                                    name="gangguan-integritas-kulit[]" value="{{ $key }}"
                                    id="kulitOption{{ $loop->index }}" {{ $checked }} disabled>
                                <label class="form-check-label" for="kulitOption{{ $loop->index }}">
                                    {{ $key }}
                                    @if ($detail && $detail->detail_name)
                                        ({{ $detail->detail_name }})
                                    @endif


                                </label>

                            </div>

                            @if (!empty($subOptions))
                                <div id="subOptionsKulit{{ $loop->index }}" class="sub-options"
                                    style="display: none; margin-left: 20px;">
                                    @foreach ($subOptions as $subOption)
                                        @php
                                            $subChecked = $selectedDetail == trim($subOption) ? 'checked' : 'disabled';
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input kulit-sub" type="radio"
                                                name="detail-nyeri[{{ $key }}]"
                                                value="{{ trim($subOption) }}"
                                                id="subOptionKulit{{ $loop->parent->index }}{{ $loop->index }}"
                                                {{ $subChecked }}>
                                            <label class="form-check-label"
                                                for="subOptionKulit{{ $loop->parent->index }}{{ $loop->index }}">
                                                {{ trim($subOption) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- Diagnosis Gangguan Integritas Jaringan -->
                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input custom-checkbox-input" type="checkbox"
                            value="Gangguan Integritas Jaringan" name="diagnosis-keperawatan[]" id="jaringanCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Gangguan Integritas Jaringan')->first() ? 'checked' : 'disabled' }}
                            disabled />
                        <label class="form-check-label" for="jaringanCheck">
                            Gangguan Integritas Jaringan
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdJaringan as $key => $subOptions)
                            @php
                                $checked = null;
                                $selectedDetail = null;

                                if ($detailDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $key)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                        $selectedDetail = $detail->detail_name;
                                    }
                                }
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input jaringan-option custom-checkbox-input" type="checkbox"
                                    name="gangguan-integritas-jaringan[]" value="{{ $key }}"
                                    id="jaringanOption{{ $loop->index }}" {{ $checked }} disabled>
                                <label class="form-check-label" for="jaringanOption{{ $loop->index }}">
                                    {{ $key }} @if ($detail && $detail->detail_name)
                                        ({{ $detail->detail_name }})
                                    @endif

                                </label>
                            </div>
                            @if (!empty($subOptions))
                                <div id="subOptionsJaringan{{ $loop->index }}" class="sub-options"
                                    style="display: none; margin-left: 20px;">
                                    @foreach ($subOptions as $subOption)
                                        @php
                                            $subChecked = $selectedDetail == trim($subOption) ? 'checked' : 'disabled';
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input jaringan-sub" type="radio"
                                                name="detail-nyeri[{{ $key }}]"
                                                value="{{ trim($subOption) }}"
                                                id="subOptionJaringan{{ $loop->parent->index }}{{ $loop->index }}"
                                                {{ $subChecked }}>
                                            <label class="form-check-label"
                                                for="subOptionJaringan{{ $loop->parent->index }}{{ $loop->index }}">
                                                {{ trim($subOption) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Diagnosis Retensi Urine -->
                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input custom-checkbox-input" type="checkbox" value="Retensi Urine"
                            name="diagnosis-keperawatan[]" id="urineCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Retensi Urine')->first() ? 'checked' : 'disabled' }}
                            disabled />
                        <label class="form-check-label" for="urineCheck">
                            Retensi Urine
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdUrine as $key => $subOptions)
                            @php
                                $checked = null;
                                $selectedDetail = null;

                                if ($detailDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $key)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                        $selectedDetail = $detail->detail_name;
                                    }
                                }
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input urine-option custom-checkbox-input" type="checkbox"
                                    name="retensi-urine[]" value="{{ $key }}"
                                    id="urineOption{{ $loop->index }}" {{ $checked }} disabled>
                                <label class="form-check-label" for="urineOption{{ $loop->index }}">
                                    {{ $key }} @if ($detail && $detail->detail_name)
                                        ({{ $detail->detail_name }})
                                    @endif

                                </label>
                            </div>
                            @if (!empty($subOptions))
                                <div id="subOptionsUrine{{ $loop->index }}" class="sub-options"
                                    style="display: none; margin-left: 20px;">
                                    @foreach ($subOptions as $subOption)
                                        @php
                                            $subChecked = $selectedDetail == trim($subOption) ? 'checked' : '';
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input urine-sub" type="radio"
                                                name="detail-nyeri[{{ $key }}]"
                                                value="{{ trim($subOption) }}"
                                                id="subOptionUrine{{ $loop->parent->index }}{{ $loop->index }}"
                                                {{ $subChecked }}>
                                            <label class="form-check-label"
                                                for="subOptionUrine{{ $loop->parent->index }}{{ $loop->index }}">
                                                {{ trim($subOption) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                @php
                    $excludedDiagnoses = [
                        'Ansietas',
                        'Nyeri Akut',
                        'Nyeri Kronis',
                        'Retensi Urine',
                        'Gangguan Mobilitas Fisik',
                        'Gangguan Integritas Kulit',
                        'Gangguan Integritas Jaringan',
                    ];
                    $otherDiagnosis = $asesmenDiagnosa
                        ->filter(function ($diagnosa) use ($excludedDiagnoses) {
                            return !in_array($diagnosa->diagnosa, $excludedDiagnoses);
                        })
                        ->first();
                @endphp
                <div class="row mb-3">
                    <div class="col-sm-3 form-check">

                        <label class="form-control-label" for="lainnya">Lainnya :
                            {{ $asesmenDiagnosa->whereNotIn('diagnosa', $excludedDiagnoses)->pluck('diagnosa')->first() }}

                        </label>
                    </div>

                    <div class="col-sm-1 mx-4">
                        <p class="fw-bold mx-4">b.d.</p>
                    </div>
                    <div class="col-sm-4">
                        @foreach ($detailDiagnosa->whereNotIn('diagnosa', $excludedDiagnoses) as $detail)
                            {{ $detail->name }} <br>
                        @endforeach
                    </div>
                </div>
            </div>

            <h6 class="text-center bg-gray text-dark small py-1">MASALAH KEPERAWATAN</h6>

            <div class="row small mx-2">
                @foreach ($masalahKeperawatan as $keperawatan)
                    @php
                        $isChecked = in_array(
                            $keperawatan,
                            $item->detailMasalahDiagnosisKeperawatanPatient->pluck('diagnosa')->toArray(),
                        );
                    @endphp
                    <div class="col-sm-4">
                        <div class="form-check">
                            <input class="form-check-input custom-checkbox-input" type="checkbox"
                                value="{{ $keperawatan }}" name="masalah-keperawatan[]"
                                id="defaultCheck1-{{ $loop->index }}"
                                {{ $isChecked ? 'checked disabled' : 'disabled' }} disabled />
                            <label class="form-check-label" for="defaultCheck1-{{ $loop->index }}">
                                {{ $keperawatan }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row small mx-2">
                <div class="col-sm-4">
                </div>

            </div>

            <h6 class="text-center bg-gray text-dark small py-1">RENCANA ASUHAN</h6>
            <div class="row mb-3 small mx-2">


                @foreach ($rencanaAsuhan as $asuhan)
                    @php
                        $checked = null;
                        $disabled = 'disabled'; // Secara default, semua checkbox dinonaktifkan
                        if ($detailRencana) {
                            $detail = $detailRencana->where('name', $asuhan)->first();
                            if ($detail) {
                                $checked = 'checked';
                                // Checkbox yang sudah dicentang juga dinonaktifkan
                            }
                        }
                    @endphp
                    <div class="col-sm-4">
                        <div class="form-check">

                            <input class="form-check-input custom-checkbox-input" type="checkbox"
                                value="{{ $asuhan }}" name="asuhan[]" id="{{ $asuhan }}"
                                {{ $checked }} {{ $checked ? 'disabled' : $disabled }} />
                            <label class="form-check-label" for="{{ $asuhan }}">
                                {{ $asuhan }}
                            </label>
                        </div>
                    </div>
                @endforeach


            </div>

            <div class="row small mt-5">
                <div class="col-6 text-center">
                    <p class="mb-0">Direview</p>
                    <p class="mt-0">Dokter Penanggung Jawab Pelayanan</p>
                    <img src="{{ Storage::url($asesmentKeperawatanRencanaAsuhan->ttddppj ?? '') }}" alt=""
                        id="ImgTtdPPJA">

                    <p class="{{ $asesmentKeperawatanRencanaAsuhan->ttddppj ? '' : 'mt-5' }}">
                        ({{ $asesmentKeperawatanRencanaAsuhan->namadppj ?? '........................................' }})
                    </p>
                </div>
                @php
                    $formatTanggal = Carbon\Carbon::parse($asesmentKeperawatanRencanaAsuhan->tanggal ?? '');
                @endphp


                <div class="col-6 text-center">
                    <p class="mb-0 text-start">Tanggal / Jam selesai asesmen :

                        {{ $formatTanggal->isoformat('D MMMM Y') ?? '............' }} /
                        {{ $formatTanggal->format('H:i') ?? '...........' }}
                    </p>
                    <p class="mt-0">Perawat Yang Melakukan Pengkajian</p>
                    <img src="{{ Storage::url($asesmentKeperawatanRencanaAsuhan->ttdppja ?? '') }}" alt=""
                        id="ImgTtdPPJA" style="max-width: 150px">

                    <p class="{{ $asesmentKeperawatanRencanaAsuhan->ttdppja ? '' : 'mt-5' }}">
                        ({{ $asesmentKeperawatanRencanaAsuhan->namappja ?? '........................................' }})
                    </p>
                </div>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-between mt-4">
            <div class="d-flex flex-row text-center" style="font-size: 5pt">
                <div class="col col-3 text-center">
                    <i class="bi bi-geo-alt-fill"></i>
                    <p>Jl. Aur No. 8, Ujung Gurun, Padang Barat, Kota Padang, Sumatera Barat</p>
                </div>
                <div class="col col-3 text-center">
                    <i class="bi bi-envelope-at-fill"></i>
                    <p>rskbropanasuripadang@gmail.com</p>
                </div>
                <div class="col col-3 text-center">
                    <i class="bi bi-telephone-fill"></i>
                    <p>(0751) 31938 - 33854 - 25735 - 8955227</p>
                </div>
            </div>
            <p class="mt-2"><span class="border border-dark">RM 01.RJ.KEP.REV.1-3/3</span></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radioButtons = document.querySelectorAll('.form-check-input');
            const totalScoreElement = document.getElementById('total-score');

            function calculateTotalScore() {
                let totalScore = 0;
                radioButtons.forEach(radio => {
                    if (radio.checked) {
                        const score = parseInt(radio.getAttribute('data-score'));
                        if (!isNaN(score)) {
                            totalScore += score;
                        } else {
                            console.error(`Invalid score value: ${radio.getAttribute('data-score')}`);
                        }
                    }
                });
                totalScoreElement.textContent = totalScore;
            }

            radioButtons.forEach(radio => {
                radio.addEventListener('change', calculateTotalScore);
            });

            // Initial calculation on page load
            calculateTotalScore();
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalScoreInput = document.getElementById('total');
            const totalScore = parseInt(totalScoreInput.value);

            if (!isNaN(totalScore)) {
                if (totalScore === 100) {
                    document.getElementById('fungsional1').checked = true;
                } else if (totalScore >= 91 && totalScore <= 99) {
                    document.getElementById('fungsional2').checked = true;
                } else if (totalScore >= 62 && totalScore <= 90) {
                    document.getElementById('fungsional3').checked = true;
                } else if (totalScore >= 21 && totalScore <= 61) {
                    document.getElementById('fungsional4').checked = true;
                } else if (totalScore >= 0 && totalScore <= 20) {
                    document.getElementById('fungsional5').checked = true;
                } else {
                    // Clear all radio buttons if the score is out of the expected range
                    document.querySelectorAll('input[name="fungsional"]').forEach((el) => el.checked = false);
                }
            } else {
                // Clear all radio buttons if the score is not a number
                document.querySelectorAll('input[name="fungsional"]').forEach((el) => el.checked = false);
            }
        });
    </script>

</body>

</html>
