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
            size: A4;
            margin: 0;
            margin-top: 10mm;
            margin-bottom: 10mm;
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

            .print-footer {
                position: fixed;
                bottom: 10mm;
                right: 10mm;
                width: 90%;
                text-align: right;
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

                {{-- @foreach ($kondisiUmum as $umum)
                    <span class="ms-2 small">
                        <div class="form-check">
                            <input class="form-check-input custom-checkbox-input" type="checkbox"
                                disabled id="defaultCheck1" />
                            <label class="form-check-label custom-checkbox-label" for="defaultCheck1">
                                {{ $umum }}
                            </label>
                        </div>
                    </span>
                @endforeach --}}
            </div>

            {{-- Kesadaran --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Kesadaran :</span>
                {{-- @foreach ($kesadaran as $sadar) --}}
                    <span class="small ms-2">
                        <div class="form-check">
                            <input class="form-check-input custom-checkbox-input" type="checkbox"
                                disabled id="defaultCheck1" />
                            <label class="form-check-label custom-checkbox-label" for="defaultCheck1">
                                sadar
                            </label>
                        </div>
                    </span>
                {{-- @endforeach --}}
            </div>


            {{-- Tekanan Darah --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Tekanan Darah :</span>
                <span class="small ms-2">
                </span>
                <span class="small ms-1">mmhg</span>

                <span class="small ms-3 fw-bold">Nadi :</span>
                <span class="small ms-2">
                </span>
                <span class="small ms-1">x/menit</span>

                <span class="small ms-3 fw-bold">Suhu</span>
                <span class="small ms-2">
                </span>
                <span class="small ms-1">°C</span>

                <span class="small ms-3 fw-bold">Pernafasan</span>
                <span class="small ms-2">
                </span>
                <span class="small ms-1">x/menit</span>
            </div>

            {{-- Tinggi Badan --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Tinggi Badan :</span>
                <span class="small ms-2">
                </span>
                <span class="small ms-1">cm</span>

                <span class="small fw-bold ms-3">Berat Badan :</span>
                <span class="small ms-2">
                </span>
                <span class="small ms-1">kg</span>
            </div>

            {{-- Kebutuhan Khusus --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Kebutuhan Khusus</span>
            </div>




            <h6 class="text-center bg-gray text-dark small mt-1 py-1">PSIKO-SOSIO-SPRITUAL</h6>
            {{-- Psikologis --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Psikologis:</span>
                <div class="row ms-1">
                    {{-- @foreach ($psikologis as $psiko) --}}
                        <div class="col-4">
                            <span class="">
                                <div class="form-check">
                                    <input class="form-check-input custom-checkbox-input" type="checkbox" id="defaultCheck1" />
                                    <label class="form-check-label custom-checkbox-label small" for="defaultCheck1">
                                        psiko
                                    </label>
                                </div>
                            </span>

                        </div>
                    {{-- @endforeach --}}

                </div>
            </div>


            <h6 class="text-center bg-gray text-dark small mt-1 py-1">EKONOMI</h6>

            {{-- Hambatan Ekonomi --}}
            <div class="d-flex flex-row px-2">
                <span class="small fw-bold">Hambatan Ekonomi :</span>
                <div class="col-sm-auto">
                    <div class="form-check form-check-inline mx-4">
                        <input class="form-check-input" type="radio" name="hambatan-ekonomi" id="hambatan-ekonomi1" value="Tidak"/>
                        <label class="form-check-label" for="hambatan-ekonomi1">Tidak</label>
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hambatan-ekonomi" id="hambatan-ekonomi2" value="Ada"/>
                        <label class="form-check-label d-flex" for="hambatan-ekonomi2">Ya</label>
                    </div>
                </div>
            </div>


            <h6 class="text-center bg-gray text-dark small mt-1 py-1">RIWAYAT ALERGI</h6>


            <h6 class="text-center bg-gray text-dark small mt-1 py-1">SKRINING DAN ASESMEN NYERI</h6>
            <div class="mb-3 small px-2">
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
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Quality (Karakteristik)</td>
                                        <td>:</td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Region (Lokasi/Penjalaran)</td>
                                        <td>:</td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Severity (Keparahan)</td>
                                        <td>:</td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Time (Durasi dan Frekuensi)</td>
                                        <td>:</td>
                                        <td>
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
                                disabled value="ya" id="defaultCheck1" />
                        </td>
                        <td class="text-center">
                            <input class="form-check-input custom-radio-input" name="a" type="radio"
                                disabled value="tidak" id="defaultCheck1" />
                        </td>
    
                    </tr>
                    <tr>
                        <td colspan="2">b. Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai
                            penopang saat akan duduk?</td>
                        <td class="text-center">
                            <input class="form-check-input custom-radio-input" name="b" type="radio"
                                disabled value="ya" id="defaultCheck1" />
                        </td>
                        <td class="text-center">
                            <input class="form-check-input custom-radio-input" name="b" type="radio"
                                disabled value="tidak" id="defaultCheck1" />
                        </td>
    
                    </tr>
                    <tr>
                        <td style="width: 50%">
                            <p class="m-0">Kategori :</p>
                            <div class="mx-3">
                                @foreach ($arrResikoJatuh as $index => $komponen1)
                                    <div class="form-check">
                                        <input class="form-check-input custom-checkbox-input"
                                            name="kategori-skrining-rajal[]" value="{{ $komponen1 }}"
                                            id="komponen1{{ $index + 1 }}" type="checkbox" disabled>
                                        <label class="form-check-label" for="komponen1{{ $index + 1 }}">
                                            {{ $komponen1 }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
    
            <h6 class="text-center bg-gray text-dark small py-1">SKRINING RISIKO NUTRISIONAL</h6>
            <table class="table table-bordered mb-3">
                <thead class="text-center">
                    <tr>
                        <td class="anak">Skrining Gizi Pada Dewasa <br> Berdasarkan Metode MST (usia > 18)</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
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
                                                data-score="0" />
                                            <label class="form-check-label" for="defaultCheck3">
                                                0
                                            </label>
                                            <br>
                                            <input class="form-check-input custom-radio-input " type="radio"
                                                name="dewasa-dua" value="1" id="defaultCheck4"
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
                    </tr>
                    <tr>
                        <td class="text-center">Bila skor MST ≥2 dilakukan pengkajian lebih lanjut oleh dietisen
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        {{-- Footer --}}
        <div class="d-flex flex-row justify-content-between mt-4">
            <div class="row" style="font-size: 5pt">
                <div class="col col-3 text-center border-end border-dark">
                    <i class="bi bi-geo-alt-fill"></i>
                    <p>Jl. Aur No. 8, Ujung Gurun, Padang Barat, Kota Padang, Sumatera Barat</p>
                </div>
                <div class="col col-4 border-end border-dark text-center">
                    <div class="my-2">
                        <i class="bi bi-envelope-at-fill"></i>
                        <p>rskbropanasuripadang@gmail.com</p>
                    </div>
                </div>
                <div class="col col-3 text-center">
                    <div class="my-2">
                        <i class="bi bi-telephone-fill"></i>
                        <p>(0751) 31938 - 33854 - <br> 25735 - 8955227</p>
                    </div>
                </div>
            </div>
            <p class="mt-2"><span class="border border-dark">RM 01.RJ.KEP.REV.1-1/3</span></p>
        </div>
    </div>
</body>

</html>
