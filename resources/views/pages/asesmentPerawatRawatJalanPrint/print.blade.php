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
        .multi-line-text {
            white-space: pre-wrap;
            word-break: break-word;
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
            <div class="row">
                <div class="col-6 align-self-center ps-4">
                    <h5 class="mb-2">ASESMEN AWAL KEPERAWATAN</h5>
                    <h6>RAWAT JALAN</h6>
                    <h6>Tgl. {{ $itemAss->created_at->format('Y-m-d') }}</h6>
                </div>
                <div class="col-6">
                    <table class="small small-table">
                        <tr>
                            <td>Nama</td>
                            <td class="px-2">:</td>
                            <td>{{ $itemAss->patient->name }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td class="px-2">:</td>
                            @php
                                $tanggalLahir = new DateTime($itemAss->patient->tanggal_lhr);
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
                            <td>{{ implode('-', str_split(str_pad($itemAss->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                            </td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td class="px-2">:</td>
                            <td>{{ $itemAss->patient->nik }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="border border-dark mt-2">
            <div class="row mb-3 px-2">
                <div class="col-12 d-flex">
                    <span class="small fw-bold">Keluhan Utama :</span>
                    <span class="small ms-2">
                        {{ $itemAss->keluhan_utama ?? '' }}
                    </span>
                </div>
            </div>

            <span class="px-2 text-dark small fw-bold">STATUS FISIK</span>
            <hr class="my-1">
            <div class="row px-2">
                <div class="col-6 d-flex">
                    <span class="small fw-bold">Kesadaran :</span>
                    <span class="small ms-2">{{ $itemAss->kesadaran ?? '..........................................................................' }}</span>
                </div>
                <div class="col-6 d-flex">
                    <span class="small fw-bold">Keadaan Umum :</span>
                    <span class="small ms-2">{{ $itemAss->keadaan_umum ?? '...............................................................' }}</span>
                </div>
            </div>
            <div class="row px-2 mb-3">
                <div class="col-4 d-flex">
                    <span class="small fw-bold">Tinggi Badan :</span>
                    <span class="small ms-2">{{ $itemAss->tb ?? '..........' }}</span>
                    <span class="small ms-2">cm</span>
                </div>
                <div class="col-4">
                    <span class="small fw-bold">Berat Badan :</span>
                    <span class="small ms-2">{{ $itemAss->bb ?? '..........' }}</span>
                    <span class="small ms-2">kg</span>
                </div>
                <div class="col-4">
                    <span class="small fw-bold">Lingkar Kepala :</span>
                    <span class="small ms-2">{{ $itemAss->lk ?? '..........' }}</span>
                    <span class="small ms-2">cm</span>
                </div>
            </div>

            <span class="px-2 text-dark small fw-bold">TANDA-TANDA VITAL</span>
            <hr class="my-1">
            <div class="row px-2">
                <div class="col-6 d-flex">
                    <span class="small fw-bold">Nadi :</span>
                    <span class="small ms-2">{{ $itemAss->nadi ?? '.............' }}</span>
                    <span class="small ms-2">bpm</span>
                </div>
                <div class="col-6 d-flex">
                    <span class="small fw-bold">Tekanan Darah :</span>
                    <span class="small ms-2">{{ $itemAss->td_sistolik ?? '.............' }} / {{ $itemAss->td_diastolik ?? '.............' }}</span>
                    <span class="small ms-2">mmHg</span>
                </div>
            </div>
            <div class="row px-2 mb-3">
                <div class="col-6 d-flex">
                    <span class="small fw-bold">Suhu Badan :</span>
                    <span class="small ms-2">{{ $itemAss->suhu ?? '.............' }}</span>
                    <span class="small ms-2">°C</span>
                </div>
                <div class="col-6 d-flex">
                    <span class="small fw-bold">Nafas :</span>
                    <span class="small ms-2">{{ $itemAss->nafas ?? '.............' }}</span>
                    <span class="small ms-2">x/menit</span>
                </div>
            </div>

            <span class="px-2 text-dark small fw-bold">RIWAYAT PENYAKIT & ALERGI</span>
            <hr class="my-1">
            <div class="row mb-1 px-2">
                <div class="col-6">
                    <span class="small fw-bold">Riwayat Penyakit Pasien</span>
                    <p class="multi-line-text">{!! $itemAss->riw_penyakit_pasien ?? '' !!}</p>
                </div>
                <div class="col-6">
                    <span class="small fw-bold">Riwayat Penyakit Keluarga</span>
                     <p class="multi-line-text">{!! $itemAss->riw_penyakit_keluarga ?? '' !!}</p>   
                </div>
            </div>
            <div class="row mb-3 px-2">
                <div class="col-6">
                    <span class="small fw-bold">Alergi Makanan</span>
                    <p class="multi-line-text">{!! $itemAss->alergi_makanan ?? '' !!}</p>
                </div>
                <div class="col-6">
                    <span class="small fw-bold">Alergi Obat</span>
                    <p class="multi-line-text">{!! $itemAss->alergi_obat ?? '' !!}</p>
                </div>
            </div>

            <span class="px-2 text-dark small fw-bold">ASESMEN GIZI</span>
            <hr class="my-1">
            <div class="row mb-1 px-2">
                <div class="col-8">
                    <div class="row mb-3">
                        <span class="small fw-bold">Mengalami penurunan berat badan dalam 6 bulan terakhir ?</span>
                        <span class="">
                            Ya (skor: {{ $itemAss->skor_ass_gizi_1 ?? '' }})
                        </span>
                    </div>
                    <div class="row mb-3">
                        <span class="small fw-bold">Memiliki keluhan kurang nafsu makan ?</span>
                        <span class="">Tidak juga (skor: {{ $itemAss->skor_ass_gizi_2 ?? '' }})</span>
                    </div>
                    <div class="row mb-3">
                        <span class="small fw-bold">Kondisi Gizi Pasien</span>
                        <span class="">{{ $itemAss->kondisi_gizi ?? '' }}</span>
                    </div>
                </div>
                <div class="col-4 text-center align-self-center">
                    <h3 class="mb-2">SKOR MST</h3>
                    <h1>0</h1>
                </div>
            </div>

            <span class="px-2 text-dark small fw-bold">ASESMEN NYERI</span>
            <hr class="my-1">
            <div class="row mb-0">
                <div class="col-12 text-center">
                    <img src="{{ asset('assets/img/aakprj2.jpg') }}" alt="" class="img-fluid" style="max-width: 400px">
                </div>
                <div class="row">
                    <div class="col-12 text-center mx-4 ps-3">
                        <div class="form-check form-check-inline mt-3 ps-4 ms-2">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" style="pointer-events: none;" {{ $itemAss->skor_nyeri ?? '' == '0' ? 'checked' : '' }} />
                        </div>
                        <div class="form-check form-check-inline ms-4 ps-3 pe-0">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" style="pointer-events: none;" {{ $itemAss->skor_nyeri ?? '' == '2' ? 'checked' : '' }} />
                        </div>
                        <div class="form-check form-check-inline mx-4 ps-3">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss->skor_nyeri ?? '' == '4' ? 'checked' : '' }}/>
                        </div>
                        <div class="form-check form-check-inline mx-4 ps-3">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss->skor_nyeri ?? '' == '6' ? 'checked' : '' }}/>
                        </div>
                        <div class="form-check form-check-inline mx-4 ps-2">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss->skor_nyeri ?? '' == '8' ? 'checked' : '' }}/>
                        </div>
                        <div class="form-check form-check-inline mx-4">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" style="pointer-events: none;" {{ $itemAss->skor_nyeri ?? '' == '10' ? 'checked' : '' }}/>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- Footer --}}
        <div class="d-flex flex-row justify-content-between mt-4">
            <div class="row" style="font-size: 8pt">
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
        </div>
    </div>
    {{--  --}}
    <div class="page-break"></div>
    <div class="page">
        <div class="header">
            <div class="row">
                <div class="col-6 align-self-center ps-4">
                    <h5 class="mb-2">ASESMEN AWAL KEPERAWATAN</h5>
                    <h6>RAWAT JALAN</h6>
                    <h6>Tgl. {{ $itemAss->created_at->format('Y-m-d') }}</h6>
                </div>
                <div class="col-6">
                    <table class="small small-table">
                        <tr>
                            <td>Nama</td>
                            <td class="px-2">:</td>
                            <td>{{ $itemAss->patient->name }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td class="px-2">:</td>
                            @php
                                $tanggalLahir = new DateTime($itemAss->patient->tanggal_lhr);
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
                            <td>{{ implode('-', str_split(str_pad($itemAss->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                            </td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td class="px-2">:</td>
                            <td>{{ $itemAss->patient->nik }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="border border-dark mt-2 pt-2">
            <span class="px-2 text-dark small fw-bold">ASESMEN RESIKO JATUH</span>
            <hr class="my-1">
            <div class="row mb-3 px-2">
                <div class="col-8">
                    <div class="row">
                        <div class="col-10 small">
                            <p class="mb-4">a. Saat akan duduk dikursi pasien tampak tidak seimbang (sempoyongan / linglung) ?</p>
                            <p>b. Saat akan duduk pasien memegang pinggiran kursi atau benda lain sebagai penopang ?</p>
                        </div>
                        <div class="col-2 mt-4 small">
                            <p class="mb-4">{{ (($itemAss->resiko_jatuh_a ?? '') ? 'YA' : 'TIDAK') ?? '...' }}</p>
                            <p>{{ (($itemAss->resiko_jatuh_b ?? '') ? 'YA' : 'TIDAK') ?? '...' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-4 pe-3 align-self-center">
                    <div class="card bg-transparent border border-primary">
                        <div class="card-body text-center p-2 align-self-center">
                            <h7 class="text-uppercase mb-1 text-primary">
                                {{ $itemAss->resiko_jatuh_result ?? '' }}
                            </h7>
                        </div>
                    </div>
                </div>
            </div>

            <span class="px-2 text-dark small fw-bold">PSIKOLOGIS & SOSIAL EKONOMI</span>
            <hr class="my-1">
            <div class="px-2 row mb-3">
                <div class="col-6">
                    <span class="small fw-bold">Status Psikologis</span>
                    <div class="d-flex">
                        @foreach ($itemAss->detailPsikologis as $detail)
                            <p class="me-1">{{ $detail->name ?? '' }},</p>
                        @endforeach
                    </div>
                </div>
                <div class="col-6">
                    <span class="small fw-bold">Status Ekonomi</span>
                    <div>{{ $itemAss->stts_ekonomi ?? '' }}</div>
                </div>
            </div>

            <span class="px-2 text-dark small fw-bold">SOAP KEPERAWATAN</span>
            <hr class="my-1">
            <div class="row mb-3 px-2">
                <div class="col-6">
                    <span class="small fw-bold">Subjective:</span>
                    <p class="small multi-line-text">{!! $soapPerawat->subjective ?? '' !!}</p>
                </div>
                <div class="col-6">
                    <span class="small fw-bold">Objective:</span>
                    <p class="small multi-line-text">{!! $soapPerawat->objective ?? '' !!}</p>
                </div>
            </div>
            <div class="row mb-3 px-2">
                <div class="col-6">
                    <span class="small fw-bold">Assesment:</span>
                    <p class="small multi-line-text">{!! $soapPerawat->asesment ?? '' !!}</p>
                </div>
                <div class="col-6">
                    <span class="small fw-bold">Planning:</span>
                    <p class="small multi-line-text">{!! $soapPerawat->planning ?? '' !!}</p>
                </div>
            </div>
        </div>
        {{-- Footer --}}
        <div class="d-flex flex-row justify-content-between mt-4">
            <div class="row" style="font-size: 8pt">
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
        </div>
    </div>
</body>

</html>
