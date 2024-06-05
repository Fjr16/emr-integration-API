<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ASESMEN AWAL KEPERAWATAN PASIEN GAWAT DARURAT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #fafafa;
            font-size: 8pt !important;
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

        /* tr th {
                font-size: 10pt;
            }
            tr td {
                font-size: 10pt;
            } */
        /* td {
                padding-top: 5px;
            } */
        /* th {
                font-size: 10pt !important;
            } */

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
            <div class="grid grid-cols-4 gap-4">
                <div class="...">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-span-2">
                    <h1 class="text-center uppercase">
                        ASESMEN AWAL KEPERAWATAN <br />
                        PASIEN GAWAT DARURAT
                    </h1>
                </div>
            </div>
        </div>

        <div class="content">
            <section class="">
                <div class="flex justify-end px-6 gap-x-1">
                    <div class="w-5 h-5 text-center border border-black">
                        <p class="font-bold">✓</p>
                    </div>
                    <p>
                        <em>Gunakan tanda ini jika sesuai dengan
                            anamnesa</em>
                    </p>
                </div>

                <div class="py-3 border border-black">
                    <div class="grid grid-cols-12">
                        <div class="grid grid-cols-12 col-span-6">
                            <p class="col-span-4">Tanggal / Jam Datang</p>
                            <p class="col-span-1 px-2 text-end">:</p>
                            <p class="col-span-6">
                                {{ $item->igdPatient->created_at->format('Y-m-d') ?? '............................' }} /
                                {{ $item->igdPatient->created_at->format('H:i') ?? '..............' }}
                            </p>
                        </div>
                        <div class="flex col-span-6 gap-x-2">
                            <p>Jam Asesmen</p>
                            <p>:</p>
                            <p>{{ $item->created_at->format('H:i') ?? '............................' }}</p>
                        </div>
                    </div>

                    <div class="text-center bg-gray-300">
                        <p class="font-bold text-md">STATUS FISIK</p>
                    </div>

                    <div class="grid grid-cols-12 pl-2">
                        <div class="grid grid-cols-12 col-span-2">
                            <p class="col-span-10">Kondisi Umum</p>
                            <p class="col-span-1 text-end">:</p>
                        </div>
                        @foreach ($kondisiUmum as $kus)
                            @php
                                $detail = $kondisiUmums->where('name', $kus)->first();
                                if ($detail) {
                                    $checked = 'checked';
                                } else {
                                    $checked = null;
                                }
                            @endphp
                            <div class="flex col-span-2 gap-x-1">
                                <input type="checkbox" {{ $checked }} @style('pointer-events: none;') />
                                <p>{{ $kus }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-12 pl-2">

                        <div class="grid grid-cols-12 col-span-2">
                            <p class="col-span-10">Kesadaran</p>
                            <p class="col-span-1 text-end">:</p>
                        </div>
                        @foreach ($kesadaran as $k)
                            @php
                                $detail = $kesadarans->where('name', $k)->first();
                                if ($detail) {
                                    $checked = 'checked';
                                } else {
                                    $checked = null;
                                }
                            @endphp
                            <div class="flex col-span-2 gap-x-1">
                                <input type="checkbox" {{ $checked }} @style('pointer-events: none;') />
                                <p>{{ $k }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-12 pl-2">

                        <div class="grid grid-cols-12 col-span-2">
                            <p class="col-span-10">Tekanan darah</p>
                            <p class="col-span-1 text-end">:</p>
                        </div>
                        <div class="flex col-span-2 gap-x-1">
                            <p>{{ $statusFisik->darah }}</p>
                            <p>mmHg</p>
                        </div>
                        <div class="flex col-span-2 gap-x-1">
                            <p>Nadi</p>
                            <p>:</p>
                            <div class="flex gap-x-1">
                                <p>{{ $statusFisik->nadi }}</p>
                                <p>x/menit</p>
                            </div>
                        </div>
                        <div class="flex col-span-2 gap-x-1">
                            <p>Suhu</p>
                            <p>:</p>
                            <div class="flex gap-x-1">
                                <p>{{ $statusFisik->suhu }}</p>
                                <p>°C</p>
                            </div>
                        </div>
                        <div class="flex col-span-3 gap-x-1">
                            <p>Pernafasan</p>
                            <p>:</p>
                            <div class="flex gap-x-1">
                                <p>{{ $statusFisik->pernafasan }}</p>
                                <p>x/menit</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 col-span-2">
                            <p class="col-span-10">Tinggi Badan</p>
                            <p class="col-span-1 px-2 text-end">:</p>
                        </div>
                        <div class="flex col-span-2 gap-x-1">
                            <p>{{ $statusFisik->tb }}</p>
                            <p>cm</p>
                        </div>
                        <div class="flex col-span-8 gap-x-1">
                            <p>Berat Badan</p>
                            <p>:</p>
                            <div class="flex gap-x-1">
                                <p>{{ $statusFisik->bb }}</p>
                                <p>kg</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 col-span-2">
                            <p class="col-span-12">Kebutuhan Khusus</p>
                        </div>
                        @foreach ($kebutuhanKhusus as $kk)
                            @php
                                $detail = $kebutuhanKhususs->where('name', $kk)->first();
                                if ($detail) {
                                    $checked = 'checked';
                                } else {
                                    $checked = null;
                                }
                            @endphp
                            <div class="flex col-span-2 gap-x-1">
                                <input type="checkbox" {{ $checked }} @style('pointer-events: none;') />
                                <p>{{ $kk }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center bg-gray-300">
                        <p class="font-bold text-md">
                            PSIKO-SOSIO-SPIRITUAL
                        </p>
                    </div>

                    <div class="grid grid-cols-12 pt-3 pl-2">
                        <div class="grid grid-cols-12 col-span-2">
                            <p class="col-span-9">Psikologis</p>
                            <p class="col-span-1">:</p>
                        </div>
                        @foreach ($psikos as $p)
                            <div class="flex col-span-{{ 'Kecendrungan Bunuh Diri' == $p->name ? 3 : 2 }} gap-x-1">
                                <input @style('pointer-events: none;') type="checkbox"
                                    {{ $p->value == 'checked' ? 'checked' : '' }} />
                                <p>{{ $p->name }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-12 pt-3 pl-2">
                        <div class="grid grid-cols-12 col-span-2">
                            <p class="col-span-9">Sosial</p>
                            <p class="col-span-1">:</p>
                        </div>
                        @foreach ($sosials as $s)
                            <div class="flex col-span-8 col-start-3 gap-x-1">
                                <input @style('pointer-events: none;') type="checkbox" {{ $s->value != null ? 'checked' : '' }} />
                                <p>{{ $s->name }}?</p>
                                <p>{{ str_replace('/', '', $s->value ?? '') }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-12 pt-3 pl-2">
                        <div class="grid grid-cols-12 col-span-2">
                            <p class="col-span-9">Spiritual</p>
                            <p class="col-span-1">:</p>
                        </div>
                        @foreach ($spirituals as $s)
                            @if ($s->name == 'Sehat')
                                <div class="flex col-span-8 col-start-3 gap-x-1">
                                    <input @style('pointer-events: none;') type="checkbox"
                                        {{ $s->value != null ? 'checked' : '' }} />
                                    <p>Sehat : </p>
                                    <p>{{ $s->value }}</p>
                                </div>
                                <div class="flex col-span-8 col-start-3 gap-x-1">
                                    <input @style('pointer-events: none;') type="checkbox" />
                                    <p>Sakit : </p>
                                    <p>...........</p>
                                </div>
                                <div class="flex col-span-8 col-start-3 gap-x-1">
                                    <input @style('pointer-events: none;') type="checkbox" />
                                    <p>Hambatan Sosial : </p>
                                    <p>...........</p>
                                </div>
                            @elseif ($s->name == 'Sakit')
                                <div class="flex col-span-8 col-start-3 gap-x-1">
                                    <input @style('pointer-events: none;') type="checkbox" />
                                    <p>Sehat : </p>
                                    <p>...........</p>
                                </div>
                                <div class="flex col-span-8 col-start-3 gap-x-1">
                                    <input @style('pointer-events: none;') type="checkbox"
                                        {{ $s->value != null ? 'checked' : '' }} />
                                    <p>Sakit : </p>
                                    <p>{{ $s->value }}</p>
                                </div>
                                <div class="flex col-span-8 col-start-3 gap-x-1">
                                    <input @style('pointer-events: none;') type="checkbox" />
                                    <p>Hambatan Sosial : </p>
                                    <p>...........</p>
                                </div>
                            @elseif ($s->name == 'Hambatan Spiritual')
                                <div class="flex col-span-8 col-start-3 gap-x-1">
                                    <input @style('pointer-events: none;') type="checkbox" />
                                    <p>Sehat : </p>
                                    <p>...........</p>
                                </div>
                                <div class="flex col-span-8 col-start-3 gap-x-1">
                                    <input @style('pointer-events: none;') type="checkbox" />
                                    <p>Sakit : </p>
                                    <p>...........</p>
                                </div>
                                <div class="flex col-span-8 col-start-3 gap-x-1">
                                    <input @style('pointer-events: none;') type="checkbox"
                                        {{ $s->value != null ? 'checked' : '' }} />
                                    <p>Hambatan Sosial : </p>
                                    <p>{{ $s->value }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="grid grid-cols-12 pt-3 pl-2">
                        <div class="col-span-3">
                            <p>Kultural / Nilai Kepercayaan :</p>
                        </div>
                        @foreach ($spirituals as $s)
                            @if ($s->name == 'Kultural / Nilai Kepercayaan')
                                @if ($s->value == 'Ada')
                                    <div class="flex col-span-2 gap-x-1">
                                        <input @style('pointer-events: none;') type="checkbox" />
                                        <p>Tidak ada</p>
                                    </div>
                                    <div class="flex col-span-7 gap-x-1">
                                        <input @style('pointer-events: none;') type="checkbox" checked />
                                        <p>Ada, sebutkan</p>
                                        <p>{{ $s->value }}</p>
                                    </div>
                                @else
                                    <div class="flex col-span-2 gap-x-1">
                                        <input @style('pointer-events: none;') type="checkbox" checked />
                                        <p>Tidak ada</p>
                                    </div>
                                    <div class="flex col-span-7 gap-x-1">
                                        <input @style('pointer-events: none;') type="checkbox" />
                                        <p>Ada, sebutkan</p>
                                        <p>...............................</p>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>

                    <div class="grid grid-cols-12 pt-3 pl-2">
                        <div class="col-span-8">
                            <p>
                                Apakah pasien memerlukan pelayanan /
                                bimbingan rohani selama dirawat?
                            </p>
                        </div>
                        @foreach ($spirituals as $s)
                            @if ($s->name == 'Apakah pasien memerlukan pelayanan / bimbingan rohani selama dirawat?')
                                @if ($s->value == 'Ada')
                                    <div class="flex col-span-1 gap-x-1">
                                        <input @style('pointer-events: none;') type="checkbox" />
                                        <p>Tidak</p>
                                    </div>
                                    <div class="flex col-span-2 gap-x-1">
                                        <input @style('pointer-events: none;') type="checkbox" checked />
                                        <p>Ada, sebutkan : {{ $s->value }}</p>
                                    </div>
                                @else
                                    <div class="flex col-span-1 gap-x-1">
                                        <input @style('pointer-events: none;') type="checkbox" checked />
                                        <p>Tidak</p>
                                    </div>
                                    <div class="flex col-span-2 gap-x-1">
                                        <input @style('pointer-events: none;') type="checkbox" />
                                        <p>Ada, sebutkan ........</p>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>

                    <div class="text-center bg-gray-300">
                        <p class="font-bold text-md">EKONOMI</p>
                    </div>

                    <div class="grid grid-cols-12 py-3 pl-2">
                        <div class="grid grid-cols-12 col-span-3">
                            <p class="col-span-10">Pasien menggunakan</p>
                            <p class="col-span-2">:</p>
                        </div>
                        <div class="flex col-span-2 gap-x-1">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $ekonomi->status == 'BPJS-TK' ? 'checked' : '' }} />
                            <p>BPJS-TK</p>
                        </div>
                        <div class="flex col-span-2 gap-x-1">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $ekonomi->status == 'BPJS-KES' ? 'checked' : '' }} />
                            <p>BPJS-KES</p>
                        </div>
                        <div class="flex col-span-2 gap-x-1">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $ekonomi->status == 'Asuransi' ? 'checked' : '' }} />
                            <p>Asuransi</p>
                        </div>
                        <div class="flex col-span-2 gap-x-1">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $ekonomi->status == 'Perusahaan' ? 'checked' : '' }} />
                            <p>Perusahaan</p>
                        </div>

                        <div class="flex col-span-2 col-start-4 gap-x-1">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $ekonomi->status == 'Jasa Raharja' ? 'checked' : '' }} />
                            <p>Jasa Raharja</p>
                        </div>
                        <div class="flex col-span-2 gap-x-1">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $ekonomi->status == 'Umum' ? 'checked' : '' }} />
                            <p>Umum</p>
                        </div>
                        @if (
                            $ekonomi->status != 'BPJS-TK' &&
                                $ekonomi->status != 'BPJS-KES' &&
                                $ekonomi->status != 'Asuransi' &&
                                $ekonomi->status != 'Perusahaan' &&
                                $ekonomi->status != 'Jasa Raharja' &&
                                $ekonomi->status != 'Umum')
                            <div class="flex col-span-4 gap-x-1">
                                <input @style('pointer-events: none;') type="checkbox" checked />
                                <p>Lainnya</p>
                                <p>:</p>
                                <p>{{ $ekonomi->status }}</p>
                            </div>
                        @else
                            <div class="flex col-span-4 gap-x-1">
                                <input @style('pointer-events: none;') type="checkbox"
                                    {{ $ekonomi->status == 'BPJS-TK' ? 'checked' : '' }} />
                                <p>Lainnya</p>
                                <p>:</p>
                                <p>………………………</p>
                            </div>
                        @endif

                        <div class="grid grid-cols-12 col-span-3">
                            <p class="col-span-10">Hambatan Ekonomi</p>
                            <p class="col-span-2">:</p>
                        </div>
                        <div class="flex col-span-2 gap-x-1">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $ekonomi->hambatan == 'Tidak Ada' ? 'checked' : '' }} />
                            <p>Tidak ada</p>
                        </div>
                        <div class="flex col-span-7 gap-x-1">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $ekonomi->hambatan != 'Tidak Ada' ? 'checked' : '' }} />
                            <p>Ada, sebutkan</p>
                            <p>{{ $ekonomi->hambatan != 'Tidak Ada' ? $ekonomi->hambatan : '...............................' }}
                            </p>
                        </div>
                    </div>

                    <div class="text-center bg-gray-300">
                        <p class="font-bold text-md">RIWAYAT ALERGI</p>
                    </div>
                    <div class="grid grid-cols-12 py-3 pl-2">
                        <div class="flex col-span-4 gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $alergi->status == 'Tidak Ada' ? 'checked' : '' }} />
                            <p>Tidak Ada</p>
                        </div>
                        <div class="flex col-span-4 gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $alergi->status == 'Tidak Diketahui' ? 'checked' : '' }} />
                            <p>Tidak Diketahui</p>
                        </div>
                        <div class="flex col-span-4 gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $alergi->status == 'Ada' ? 'checked' : '' }} />
                            <p>Ada</p>
                        </div>
                        @if ($alergi->status == 'Ada')
                            <div class="flex col-span-7 pl-5 gap-x-1">
                                <p>Alergi obat (sebutkan)</p>
                                <p>
                                    {{ $alergi->alergi_obat ?? '............................................' }}
                                </p>
                            </div>
                            <div class="flex col-span-5 pl-5 gap-x-1">
                                <p>Reaksi</p>
                                <p>
                                    {{ $alergi->reaksi_obat ?? '............................................' }}
                                </p>
                            </div>

                            <div class="flex col-span-7 pl-5 gap-x-1">
                                <p>Alergi makanan (sebutkan)</p>
                                <p>
                                    {{ $alergi->alergi_mkn ?? '............................................' }}
                                </p>
                            </div>
                            <div class="flex col-span-5 pl-5 gap-x-1">
                                <p>Reaksi</p>
                                <p>
                                    {{ $alergi->reaksi_mkn ?? '............................................' }}
                                </p>
                            </div>

                            <div class="flex col-span-7 pl-5 gap-x-1">
                                <p>Alergi lainnya (sebutkan)</p>
                                <p>
                                    {{ $alergi->alergi_lainnya ?? '............................................' }}
                                </p>
                            </div>
                            <div class="flex col-span-5 pl-5 gap-x-1">
                                <p>Reaksi</p>
                                <p>
                                    {{ $alergi->alergi_lainnya ?? '............................................' }}
                                </p>
                            </div>
                        @else
                            <div class="flex col-span-7 pl-5 gap-x-1">
                                <p>Alergi obat (sebutkan)</p>
                                <p>
                                    ................................................
                                </p>
                            </div>
                            <div class="flex col-span-5 pl-5 gap-x-1">
                                <p>Reaksi</p>
                                <p>
                                    ............................................
                                </p>
                            </div>

                            <div class="flex col-span-7 pl-5 gap-x-1">
                                <p>Alergi makanan (sebutkan)</p>
                                <p>
                                    ................................................
                                </p>
                            </div>
                            <div class="flex col-span-5 pl-5 gap-x-1">
                                <p>Reaksi</p>
                                <p>
                                    ............................................
                                </p>
                            </div>

                            <div class="flex col-span-7 pl-5 gap-x-1">
                                <p>Alergi lainnya (sebutkan)</p>
                                <p>
                                    ................................................
                                </p>
                            </div>
                            <div class="flex col-span-5 pl-5 gap-x-1">
                                <p>Reaksi</p>
                                <p>
                                    ............................................
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="text-center bg-gray-300">
                        <p class="font-bold text-md">
                            SKRINING DAN ASESMEN NYERI
                        </p>
                    </div>

                    <div class="grid grid-cols-12 py-3 pl-2">
                        <div class="col-span-4">
                            <p>Apakah Pasien Merasa Nyeri?</p>
                        </div>
                        <div class="flex col-span-2 gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $skrinAsesmenNyeri->status == 'Tidak' ? 'checked' : '' }} />
                            <p>Tidak</p>
                        </div>
                        <div class="flex col-span-6 gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $skrinAsesmenNyeri->status == 'Ya' ? 'checked' : '' }} />
                            <p>Ya</p>
                        </div>

                        <div class="col-span-4">
                            <p>Kategori Nyeri</p>
                        </div>
                        <div class="flex col-span-2 gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $skrinAsesmenNyeri->category == 'Akut' ? 'checked' : '' }} />
                            <p>Akut</p>
                        </div>
                        <div class="flex col-span-6 gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox"
                                {{ $skrinAsesmenNyeri->category == 'Kronis' ? 'checked' : '' }} />
                            <p>Kronis</p>
                        </div>

                        <div class="col-span-12">
                            <p>
                                Jika Ya, lakukan pengkajian nyeri lebih
                                lanjut dengan format yang sesuai dengan usia
                                pasien
                            </p>
                        </div>
                    </div>

                    <div class="w-full px-1">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <td class="w-[50%] text-center border border-black">
                                        <p class="font-medium">
                                            DEWASA (<em>NUMERIC SCALE</em>)
                                        </p>
                                    </td>
                                    <td class="w-[50%] border border-black"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="w-[50%] border border-black">
                                        <div class="flex items-center justify-center">
                                            <img src="{{ asset('assets/img/askepdewasa.png') }}" alt="gambar" />
                                        </div>
                                    </td>
                                    <td rowspan="2" class="w-[50%] border border-black">
                                        <div class="grid grid-cols-12 pl-2 gap-y-2">
                                            <div class="col-span-6">
                                                <p>
                                                    Provocation (Pencetus)
                                                </p>
                                            </div>
                                            <div class="flex col-span-6 gap-x-1">
                                                <p>:</p>
                                                <p>
                                                    {{ $skrinAsesmenNyeri->provocation ?? '................................................' }}
                                                </p>
                                            </div>

                                            <div class="col-span-6">
                                                <p>
                                                    Quality (Karakteristik)
                                                </p>
                                            </div>
                                            <div class="flex col-span-6 gap-x-1">
                                                <p>:</p>
                                                <p>
                                                    {{ $skrinAsesmenNyeri->quality ?? '................................................' }}
                                                </p>
                                            </div>

                                            <div class="col-span-6">
                                                <p>
                                                    Region
                                                    (Lokasi/Penjalaran)
                                                </p>
                                            </div>
                                            <div class="flex col-span-6 gap-x-1">
                                                <p>:</p>
                                                <p>
                                                    {{ $skrinAsesmenNyeri->region ?? '................................................' }}
                                                </p>
                                            </div>

                                            <div class="col-span-6">
                                                <p>Severity (Keparahan)</p>
                                            </div>
                                            <div class="flex col-span-6 gap-x-1">
                                                <p>:</p>
                                                <p>
                                                    {{ $skrinAsesmenNyeri->severity ?? '................................................' }}
                                                </p>
                                            </div>

                                            <div class="col-span-6">
                                                <p>
                                                    Time (Durasi dan
                                                    Frekuensi)
                                                </p>
                                            </div>
                                            <div class="flex col-span-6 gap-x-1">
                                                <p>:</p>
                                                <p>
                                                    {{ $skrinAsesmenNyeri->time ?? '................................................' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-[50%] border border-black">
                                        <div class="flex flex-col items-center justify-center">
                                            <p class="font-medium">
                                                ANAK - ANAK (<em>WONG BAKERFACES PAIN SCALE</em>)
                                            </p>
                                            <img src="{{ asset('assets/img/askepanak.png') }}" alt="gambar" />
                                            <div class="flex font-medium gap-x-11">
                                                <p>0</p>
                                                <p>2</p>
                                                <p>4</p>
                                                <p>6</p>
                                                <p>8</p>
                                                <p>10</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border border-black">
                                        <div class="p-2">
                                            <div>
                                                <p class="font-medium">
                                                    Nyeri hilang, dengan :
                                                </p>
                                            </div>
                                            <div class="grid grid-cols-12">
                                                @foreach ($asesmentNyeri as $an)
                                                    @php
                                                        $detail = $nyeriHilang->where('name', $an)->first();
                                                        if ($detail) {
                                                            $checked = 'checked';
                                                        } else {
                                                            $checked = null;
                                                        }
                                                    @endphp
                                                    <div class="flex col-span-3 gap-x-1">
                                                        <input @style('pointer-events: none;') type="checkbox"
                                                            {{ $checked }} />
                                                        <p>{{ $an }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- halaman 2 -->
    <div class="page">
        <div class="header">
            <div class="grid grid-cols-4 gap-4">
                <div class="...">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-span-2">
                    <h1 class="text-center uppercase">
                        ASESMEN AWAL KEPERAWATAN <br />
                        PASIEN GAWAT DARURAT
                    </h1>
                </div>
            </div>
        </div>

        <div class="content">
            <section class="">
                <div class="flex justify-end px-6 gap-x-1">
                    <div class="w-5 h-5 text-center border border-black">
                        <p class="font-bold">✓</p>
                    </div>
                    <p><em>Gunakan tanda ini jika sesuai dengan anamnesa</em></p>
                </div>

                <div class="border border-black">
                    <div class="text-center bg-gray-300">
                        <p class="font-bold text-md">SKRINING DAN ASESMEN RISIKO JATUH</p>
                    </div>

                    <div class="px-1">
                        <table class="w-full border border-black">
                            <thead>
                                <tr class="text-center">
                                    <th class="border border-black" class="text-body border border-black">KOMPONEN
                                        PENILAIAN</th>
                                    <th class="text-body border border-black">YA</th>
                                    <th class="text-body border border-black">TIDAK</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($skriningResiko)
                                    <tr>
                                        <td class="border border-black">a. Perhatikan cara berjalan pasien saat akan
                                            duduk dikursi. Apakah pasien tampak tidak seimbang (sempoyongan / linglung)
                                            ?</td>
                                        <td class="text-center border border-black">
                                            <input class="form-check-input" type="radio" @style('pointer-events: none;')
                                                {{ $skriningResiko->a == 'ya' ? 'checked' : '' }} />
                                        </td>
                                        <td class="text-center border border-black">
                                            <input class="form-check-input" type="radio" @style('pointer-events: none;')
                                                {{ $skriningResiko->a == 'tidak' ? 'checked' : '' }} />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border border-black">b. Apakah pasien memegang pinggiran kursi atau
                                            meja atau benda lain sebagai penopang saat akan duduk?</td>
                                        <td class="text-center border border-black">
                                            <input class="form-check-input" type="radio" @style('pointer-events: none;')
                                                {{ $skriningResiko->b == 'ya' ? 'checked' : '' }} />
                                        </td>
                                        <td class="text-center border border-black">
                                            <input class="form-check-input" type="radio" @style('pointer-events: none;')
                                                {{ $skriningResiko->b == 'tidak' ? 'checked' : '' }} />
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="border border-black">a. Perhatikan cara berjalan pasien saat akan
                                            duduk dikursi. Apakah pasien tampak tidak seimbang (sempoyongan / linglung)
                                            ?</td>
                                        <td class="text-center border border-black">
                                            <input class="form-check-input" type="radio" />
                                        </td>
                                        <td class="text-center border border-black">
                                            <input class="form-check-input" type="radio" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border border-black">b. Apakah pasien memegang pinggiran kursi atau
                                            meja atau benda lain sebagai penopang saat akan duduk?</td>
                                        <td class="text-center border border-black">
                                            <input class="form-check-input" type="radio" />
                                        </td>
                                        <td class="text-center border border-black">
                                            <input class="form-check-input" type="radio" />
                                        </td>
                                    </tr>
                                @endif

                                @if ($detailSkriningResiko->isNotEmpty())
                                    <tr>
                                        <td style="width: 400px" class="border border-black">
                                            <p class="m-0">Kategori :</p>
                                            <div class="mx-3">
                                                @foreach ($komponenPenilaian1 as $komponen1)
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            {{ in_array($komponen1, $detailSkriningResiko->pluck('name')->toArray()) ? 'checked' : '' }}
                                                            type="checkbox" @style('pointer-events: none;') />
                                                        <label class="form-check-label">
                                                            {{ $komponen1 }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td colspan="3" class="border border-black py-4">
                                            @foreach ($komponenPenilaian2 as $komponen2)
                                                <div class="form-check">
                                                    <input class="form-check-input"
                                                        {{ in_array($komponen2, $detailSkriningResiko->pluck('name')->toArray()) ? 'checked' : '' }}
                                                        type="checkbox" @style('pointer-events: none;') />
                                                    <label class="form-check-label">
                                                        {{ $komponen2 }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td style="width: 400px" class="border border-black">
                                            <p class="m-0">Kategori :</p>
                                            <div class="mx-3">
                                                @foreach ($komponenPenilaian1 as $komponen1)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" />
                                                        <label class="form-check-label">
                                                            {{ $komponen1 }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td colspan="3" class="border border-black py-4">
                                            @foreach ($komponenPenilaian2 as $komponen2)
                                                <div class="form-check">
                                                    <input class="form-check-input" />
                                                    <label class="form-check-label">
                                                        {{ $komponen2 }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center bg-gray-300">
                        <p class="font-bold text-md">ASESMEN STATUS FUNGSIONAL</p>
                    </div>

                    <div class="p-1">
                        <table class="w-full border border-black">
                            <thead>
                                <tr>
                                    <td class="text-center border border-black">
                                        Kategori & Skor
                                    </td>
                                    <td class="text-center border border-black">
                                        No.
                                    </td>
                                    <td class="text-center border border-black">
                                        Kriteria Barthel Index
                                    </td>
                                    <td class="text-center w-24 border border-black">
                                        Dengan Bantuan
                                    </td>
                                    <td class="text-center border border-black">
                                        Mandiri
                                    </td>
                                    <td class="w-20 text-center border border-black">
                                        Nilai
                                    </td>
                                </tr>
                            </thead>
                            @php
                                $nilai = 0;
                                foreach ($statusFungsional as $sf) {
                                    $nilai = $nilai + $sf->nilai;
                                }
                            @endphp
                            <tbody>
                                <tr>
                                    <td rowspan="11">
                                        <table>
                                            <tr>
                                                <td><input @style('pointer-events: none;') type="checkbox"
                                                        {{ $nilai == 100 ? 'checked' : '' }}></td>
                                                <td>Mandiri</td>
                                                <td>:</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td><input @style('pointer-events: none;') type="checkbox"
                                                        {{ $nilai >= 91 && $nilai <= 99 ? 'checked' : '' }}></td>
                                                <td>Ketergantungan Ringan</td>
                                                <td>:</td>
                                                <td>91 - 99</td>
                                            </tr>
                                            <tr>
                                                <td><input @style('pointer-events: none;') type="checkbox"
                                                        {{ $nilai >= 62 && $nilai <= 90 ? 'checked' : '' }}></td>
                                                <td>Ketergantungan Sedang</td>
                                                <td>:</td>
                                                <td>62 - 90</td>
                                            </tr>
                                            <tr>
                                                <td><input @style('pointer-events: none;') type="checkbox"
                                                        {{ $nilai >= 21 && $nilai <= 61 ? 'checked' : '' }}></td>
                                                <td>Ketergantungan Berat</td>
                                                <td>:</td>
                                                <td>21 - 61</td>
                                            </tr>
                                            <tr>
                                                <td><input @style('pointer-events: none;') type="checkbox"
                                                        {{ $nilai < 20 ? 'checked' : '' }}></td>
                                                <td>Ketergantungan Total</td>
                                                <td>:</td>
                                                <td>0 - 20</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3">(Bila Ketergantungan Total, kolaborasi
                                                    dengan DPJP)</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @foreach ($statusFungsional as $sf)
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
                                    @endphp
                                    <tr>
                                        <td class="text-center border border-black">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="pl-2 border border-black">
                                            {{ $sf->name }}
                                        </td>
                                        <td class="text-center border border-black">
                                            {{ $bantuan }}
                                        </td>
                                        <td class="text-center border border-black">
                                            {{ $mandiri }}
                                        </td>
                                        <td class="border border-black text-center">{{ $sf->nilai }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="border border-black"></td>
                                    <td class="pl-2 border border-black" colspan="4">
                                        TOTAL
                                    </td>
                                    <td class="border border-black text-center">{{ $nilai }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center bg-gray-300">
                        <p class="font-semibold text-md">SKRINING RISIKO NUTRISIONAL</p>
                    </div>

                    <div class="p-1">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <td class="text-center border border-black" colspan="4">
                                        Skrining Gizi Pada Anak <br>
                                        Berdasarkan Metode Strong Kids (usia < 18 tahun) </td>
                                    <td class="text-center border border-black" colspan="3">
                                        Skrining Gizi Pada Dewasa <br>
                                        Berdasarkan Metode MST (usia > 18 tahun)
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center border border-black">
                                        No.
                                    </td>
                                    <td class="text-center border border-black">
                                        Paramater
                                    </td>
                                    <td class="text-center border border-black">
                                        Jawaban
                                    </td>
                                    <td class="text-center border border-black">
                                        Nilai
                                    </td>
                                    <td class="text-center border border-black">
                                        No.
                                    </td>
                                    <td class="text-center border border-black">
                                        Paramater
                                    </td>
                                    <td class="text-center border border-black">
                                        Nilai
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($usia < 18)
                                    <tr>
                                        <td class="text-center border border-black">
                                            1
                                        </td>
                                        <td class="pl-2 border border-black">
                                            Apakah pasien tampak kurus?
                                        </td>
                                        @php
                                            $detail = $skriningNutrisional
                                                ->where('category', 'anak')
                                                ->where('name', 'Apakah pasien tampak kurus?')
                                                ->first();
                                            if ($detail != null) {
                                                $checked = $detail->nilai;
                                            } else {
                                                $checked = null;
                                            }
                                        @endphp
                                        <td class="border border-black">
                                            <div class="flex flex-col pl-1">
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')
                                                        {{ $checked == '1' ? 'checked' : '' }}>
                                                    <p>Ya</p>
                                                </div>
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')
                                                        {{ $checked == '0' ? 'checked' : '' }}>
                                                    <p>Tidak</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border border-black">
                                            <p>1</p>
                                            <p>0</p>
                                        </td>
                                        <td class="text-center border border-b-0 border-black">
                                            1
                                        </td>
                                        <td class="pl-2 border border-black">
                                            Apakah pasien mengalami penurunan berat badan yang
                                            tidak direncanakan/tidak diinginkan dalam 6 bulan
                                            terakhir?
                                        </td>
                                        <td class="text-center border border-black"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center border border-black">
                                            2
                                        </td>
                                        <td class="pl-2 border border-black">
                                            Apakah terdapat penurunan BB selama 1
                                            bulan terakhir? Berdasarkan penilaian
                                            objektif
                                        </td>
                                        @php
                                            $detail = $skriningNutrisional
                                                ->where('category', 'anak')
                                                ->where(
                                                    'name',
                                                    'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif',
                                                )
                                                ->first();
                                            if ($detail != null) {
                                                $checked = $detail->nilai;
                                            } else {
                                                $checked = null;
                                            }
                                        @endphp
                                        <td class="border border-black">
                                            <div class="flex flex-col pl-1">
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" disabled @style('pointer-events: none;')
                                                        {{ $checked == 1 ? 'checked' : '' }}>
                                                    <p>Ya</p>
                                                </div>
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')
                                                        {{ $checked == 0 ? 'checked' : '' }}>
                                                    <p>Tidak</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border border-black">
                                            <p>1</p>
                                            <p>0</p>
                                        </td>
                                        <td class="text-center border border-t-0 border-black" rowspan="3">

                                        </td>
                                        <td class="border border-black" rowspan="2">
                                            <div class="list-disc">
                                                <div class="pl-10 border-b border-black">
                                                    <li>Tidak</li>
                                                </div>
                                                <div class="pl-10 border-b border-black">
                                                    <li>Tidak yakin (tanda-tanda : baju menjadi longgar)</li>
                                                </div>
                                                <div class="pl-10 border-b border-black">
                                                    <li>Ya, ada penurunan BB sebanyak :</li>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="pl-16 border-b border-black">
                                                    <p>1 - 5 kg</p>
                                                </div>
                                                <div class="pl-16 border-b border-black">
                                                    <p>6 - 10kg</p>
                                                </div>
                                                <div class="pl-16 border-b border-black">
                                                    <p>11 - 15 kg</p>
                                                </div>
                                                <div class="pl-16 border-b border-black">
                                                    <p>> 15 kg</p>
                                                </div>
                                                <div class="pl-16">
                                                    <p>Tidak tahu berapa kg penurunan</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border border-black" rowspan="2">
                                            <div>
                                                <div class="border-b border-black flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>0</p>
                                                </div>
                                                <div class="border-b border-black flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>2</p>
                                                </div>
                                                <div class="py-2 border-b border-black">
                                                    <p></p>
                                                </div>
                                                <div class="border-b border-black flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>1</p>
                                                </div>
                                                <div class="border-b border-black flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>2</p>
                                                </div>
                                                <div class="border-b border-black flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>3</p>
                                                </div>
                                                <div class="border-b border-black flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>4</p>
                                                </div>
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>2</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center border border-black">
                                            3
                                        </td>
                                        <td class="pl-2 border border-black">
                                            <div>
                                                <p>Apakah terdapat salah satu kondisi berikut?</p>
                                                <p class="pl-1">a. Diare ≥ 5 kali/hari dan atau muntah > 3
                                                    kali/hari dalam seminggu terakhir.</p>
                                                <p class="pt-2 pl-1">b. Asuhan makanan kurang selama
                                                    1 minggu terakhir
                                                </p>
                                            </div>
                                        </td>
                                        @php
                                            $detail = $skriningNutrisional
                                                ->where('category', 'anak')
                                                ->where(
                                                    'name',
                                                    'Apakah terdapat salah satu kondisi berikut? - Diare ≥ 5 kali/hari dan atau muntah > 3 kali/hari dalam seminggu terakhir - Asupan makanan kurang selama 1 minggu terakhir',
                                                )
                                                ->first();
                                            if ($detail != null) {
                                                $checked = $detail->nilai;
                                            } else {
                                                $checked = null;
                                            }
                                        @endphp
                                        <td class="border border-black">
                                            <div class="flex flex-col pl-1">
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')
                                                        {{ $checked == 1 ? 'checked' : '' }}>
                                                    <p>Ya</p>
                                                </div>
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')
                                                        {{ $checked == 0 ? 'checked' : '' }}>
                                                    <p>Tidak</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border border-black">
                                            <p>1</p>
                                            <p>0</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center border border-black">
                                            4
                                        </td>
                                        <td class="pl-2 border border-black">
                                            <p>Apakah terdapat penyakit atau keadaan yang
                                                mengakibatkan pasien berisiko malnutrisi
                                                dan sudah malnutrisi (Gizi Buruk)?
                                            </p>
                                        </td>
                                        @php
                                            $detail = $skriningNutrisional
                                                ->where('category', 'anak')
                                                ->where(
                                                    'name',
                                                    'Apakah terdapat penyakit atau keadaan yang mangakibatkan pasien beresiko malnutrisi dan sudah malnutrisi (Gizi buruk)?',
                                                )
                                                ->first();
                                            if ($detail != null) {
                                                $checked = $detail->nilai;
                                            } else {
                                                $checked = null;
                                            }
                                        @endphp
                                        <td class="border border-black">
                                            <div class="flex flex-col pl-1">
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')
                                                        {{ $checked == 2 ? 'checked' : '' }}>
                                                    <p>Ya</p>
                                                </div>
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')
                                                        {{ $checked == 0 ? 'checked' : '' }}>
                                                    <p>Tidak</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border border-black">
                                            <p>2</p>
                                            <p>0</p>
                                        </td>
                                        <td class="pl-2 border border-black">
                                            <div>
                                                <p>Apakah asupan makanan pasien berkurang karena
                                                    penurunan nafsu makan/kesulitan menerima makanan
                                                </p>
                                                <ul class="pl-8 list-disc">
                                                    <li>Tidak</li>
                                                    <li>Ya</li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="text-center border border-black">
                                            <p>0</p>
                                            <p>1</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center border border-black"></td>
                                        <td class="text-center border border-black">
                                            Total Skor
                                        </td>
                                        <td class="text-center border border-black"></td>
                                        <td class="text-center border border-black"></td>
                                        <td class="text-center border border-black">
                                            Total Skor
                                        </td>
                                        <td class="text-center border border-black">

                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="text-center border border-black">
                                            1
                                        </td>
                                        <td class="pl-2 border border-black">
                                            Apakah pasien tampak kurus?
                                        </td>
                                        <td class="border border-black">
                                            <div class="flex flex-col pl-1">
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>Ya</p>
                                                </div>
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>Tidak</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border border-black">
                                            <p>1</p>
                                            <p>0</p>
                                        </td>
                                        <td class="text-center border border-b-0 border-black">
                                            1
                                        </td>
                                        <td class="pl-2 border border-black">
                                            Apakah pasien mengalami penurunan berat badan yang
                                            tidak direncanakan/tidak diinginkan dalam 6 bulan
                                            terakhir?
                                        </td>
                                        <td class="text-center border border-black"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center border border-black">
                                            2
                                        </td>
                                        <td class="pl-2 border border-black">
                                            Apakah terdapat penurunan BB selama 1
                                            bulan terakhir? Berdasarkan penilaian
                                            objektif
                                        </td>
                                        <td class="border border-black">
                                            <div class="flex flex-col pl-1">
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>Ya</p>
                                                </div>
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>Tidak</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border border-black">
                                            <p>1</p>
                                            <p>0</p>
                                        </td>
                                        <td class="text-center border border-t-0 border-black" rowspan="3">

                                        </td>
                                        <td class="border border-black" rowspan="2">
                                            <div class="list-disc">
                                                <div class="pl-10 border-b border-black">
                                                    <li>Tidak</li>
                                                </div>
                                                <div class="pl-10 border-b border-black">
                                                    <li>Tidak yakin (tanda-tanda : baju menjadi longgar)</li>
                                                </div>
                                                <div class="pl-10 border-b border-black">
                                                    <li>Ya, ada penurunan BB sebanyak :</li>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="pl-16 border-b border-black">
                                                    <p>1 - 5 kg</p>
                                                </div>
                                                <div class="pl-16 border-b border-black">
                                                    <p>6 - 10kg</p>
                                                </div>
                                                <div class="pl-16 border-b border-black">
                                                    <p>11 - 15 kg</p>
                                                </div>
                                                <div class="pl-16 border-b border-black">
                                                    <p>> 15 kg</p>
                                                </div>
                                                <div class="pl-16">
                                                    <p>Tidak tahu berapa kg penurunan</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border border-black" rowspan="2">
                                            <div>
                                                @php
                                                    $detail = $skriningNutrisional
                                                        ->where('category', 'dewasa')
                                                        ->where(
                                                            'name',
                                                            'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Tidak',
                                                        )
                                                        ->first();
                                                    if ($detail != null) {
                                                        $checked = 'checked';
                                                    } else {
                                                        $checked = null;
                                                    }
                                                @endphp
                                                <div class="border-b border-black flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;') {{ $checked }}>
                                                    <p>0</p>
                                                </div>
                                                @php
                                                    $detail = $skriningNutrisional
                                                        ->where('category', 'dewasa')
                                                        ->where(
                                                            'name',
                                                            'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Tidak yakin (tanda-tanda : baju menjadi longgar)',
                                                        )
                                                        ->first();
                                                    if ($detail != null) {
                                                        $checked = 'checked';
                                                    } else {
                                                        $checked = null;
                                                    }
                                                @endphp
                                                <div class="border-b border-black flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;') {{ $checked }}>
                                                    <p>2</p>
                                                </div>
                                                <div class="py-2 border-b border-black">
                                                    <p></p>
                                                </div>
                                                @php
                                                    $detail = $skriningNutrisional
                                                        ->where('category', 'dewasa')
                                                        ->where(
                                                            'name',
                                                            'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 1-5 Kg',
                                                        )
                                                        ->first();
                                                    if ($detail != null) {
                                                        $checked = 'checked';
                                                    } else {
                                                        $checked = null;
                                                    }
                                                @endphp
                                                <div class="border-b border-black flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;') {{ $checked }}>
                                                    <p>1</p>
                                                </div>
                                                @php
                                                    $detail = $skriningNutrisional
                                                        ->where('category', 'dewasa')
                                                        ->where(
                                                            'name',
                                                            'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 6-10 Kg',
                                                        )
                                                        ->first();
                                                    if ($detail != null) {
                                                        $checked = 'checked';
                                                    } else {
                                                        $checked = null;
                                                    }
                                                @endphp
                                                <div class="border-b border-black flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;') {{ $checked }}>
                                                    <p>2</p>
                                                </div>
                                                @php
                                                    $detail = $skriningNutrisional
                                                        ->where('category', 'dewasa')
                                                        ->where(
                                                            'name',
                                                            'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak 11-15 Kg',
                                                        )
                                                        ->first();
                                                    if ($detail != null) {
                                                        $checked = 'checked';
                                                    } else {
                                                        $checked = null;
                                                    }
                                                @endphp
                                                <div class="border-b border-black flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;') {{ $checked }}>
                                                    <p>3</p>
                                                </div>
                                                @php
                                                    $detail = $skriningNutrisional
                                                        ->where('category', 'dewasa')
                                                        ->where(
                                                            'name',
                                                            'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak >15 Kg',
                                                        )
                                                        ->first();
                                                    if ($detail != null) {
                                                        $checked = 'checked';
                                                    } else {
                                                        $checked = null;
                                                    }
                                                @endphp
                                                <div class="border-b border-black flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;') {{ $checked }}>
                                                    <p>4</p>
                                                </div>
                                                @php
                                                    $detail = $skriningNutrisional
                                                        ->where('category', 'dewasa')
                                                        ->where(
                                                            'name',
                                                            'Apakah mengalami penurunan berat badan yang tidak direncanakan/tidak diinginkan dalam 6 bulan terakhir? - Ya, ada penurunan BB sebanyak Tidak tahu berapa kg penurunan',
                                                        )
                                                        ->first();
                                                    if ($detail != null) {
                                                        $checked = 'checked';
                                                    } else {
                                                        $checked = null;
                                                    }
                                                @endphp
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;') {{ $checked }}>
                                                    <p>2</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center border border-black">
                                            3
                                        </td>
                                        <td class="pl-2 border border-black">
                                            <div>
                                                <p>Apakah terdapat salah satu kondisi berikut?</p>
                                                <p class="pl-1">a. Diare ≥ 5 kali/hari dan atau muntah > 3
                                                    kali/hari dalam seminggu terakhir.</p>
                                                <p class="pt-2 pl-1">b. Asuhan makanan kurang selama
                                                    1 minggu terakhir
                                                </p>
                                            </div>
                                        </td>
                                        <td class="border border-black">
                                            <div class="flex flex-col pl-1">
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>Ya</p>
                                                </div>
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>Tidak</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border border-black">
                                            <p>1</p>
                                            <p>0</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center border border-black">
                                            4
                                        </td>
                                        <td class="pl-2 border border-black">
                                            <p>Apakah terdapat penyakit atau keadaan yang
                                                mengakibatkan pasien berisiko malnutrisi
                                                dan sudah malnutrisi (Gizi Buruk)?
                                            </p>
                                        </td>
                                        <td class="border border-black">
                                            <div class="flex flex-col pl-1">
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>Ya</p>
                                                </div>
                                                <div class="flex gap-x-1">
                                                    <input type="checkbox" @style('pointer-events: none;')>
                                                    <p>Tidak</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border border-black">
                                            <p>2</p>
                                            <p>0</p>
                                        </td>
                                        <td class="pl-2 border border-black">
                                            <div>
                                                <p>Apakah asupan makanan pasien berkurang karena
                                                    penurunan nafsu makan/kesulitan menerima makanan
                                                </p>
                                                <ul class="pl-8 list-disc">
                                                    <li>Tidak</li>
                                                    <li>Ya</li>
                                                </ul>
                                            </div>
                                        </td>
                                        @php
                                            $detail = $skriningNutrisional
                                                ->where('category', 'dewasa')
                                                ->where(
                                                    'name',
                                                    'Apakah terdapat penurunan BB selama 1 bulan terakhir? Berdasarkan penilaian objectif ? Tidak',
                                                )
                                                ->first();
                                            if ($detail != null) {
                                                $checked = 'checked';
                                            } else {
                                                $checked = null;
                                            }
                                        @endphp
                                        <td class="text-center border border-black">
                                            <div class="flex gap-x-1">
                                                <input type="checkbox" @style('pointer-events: none;')
                                                    {{ $checked == 'checked' ? 'checked' : '' }}>
                                                <p>0</p>
                                            </div>
                                            <div class="flex gap-x-1">
                                                <input type="checkbox" @style('pointer-events: none;')
                                                    {{ $checked != 'checked' ? 'checked' : '' }}>
                                                <p>1</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center border border-black">

                                        </td>
                                        <td class="text-center border border-black" colspan="2">
                                            Total Skor
                                        </td>
                                        <td class="text-center border border-black"></td>
                                        <td class="text-center border border-black"></td>
                                        <td class="text-center border border-black">
                                            Total Skor
                                        </td>
                                        <td class="text-center border border-black">

                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="border border-black" colspan="4">
                                        <div class="pl-2">
                                            <small>Bila skor : 4 -5 dilakukan pengkajian lebih lanjut oleh dietisien
                                            </small>
                                        </div>
                                    </td>
                                    <td class="border border-black" colspan="3">
                                        <div class="pl-2">
                                            <small>Bila skor MST ≥ 2 dilakukan pengkajian lebih lanjut oleh dietisien
                                            </small>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="grid grid-cols-12 py-2 pl-4"></div>

                </div>
            </section>
        </div>
    </div>
    <!-- halaman 3 -->
    <div class="page">
        <div class="header">
            <div class="grid grid-cols-4 gap-4">
                <div class="...">
                    <img src="logo.png" alt="" />
                </div>
                <div class="col-span-2">
                    <h1 class="text-center uppercase">
                        ASESMEN AWAL KEPERAWATAN <br />
                        PASIEN GAWAT DARURAT
                    </h1>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="flex justify-end px-6 gap-x-1">
                <div class="w-5 h-5 text-center border border-black">
                    <p class="font-bold">✓</p>
                </div>
                <p><em>Gunakan tanda ini jika sesuai dengan anamnesa</em></p>
            </div>
            <div class="border border-black">
                <!-- diagnosis keperawatan -->
                <h1 class="font-bold text-center uppercase bg-gray-300">Diagnosis Keperawatan</h1>

                <section class="grid grid-cols-6 p-3">
                    {{-- Nyeri Akut --}}
                    @php
                        $diagnosa = $asesmenDiagnosa->where('diagnosa', '*) Nyeri Akut / Kronis')->first();
                    @endphp
                    @if ($diagnosa)
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" checked />
                            <p>{{ $diagnosa->diagnosa }}</p>
                        </div>
                        <div class="justify-self-end pr-5">
                            <p>b.d</p>
                        </div>
                        @foreach ($bdNyeriAkut as $bd)
                            @php
                                $detail = $diagnosa->igdHubDiagnosisKepAssKepPatients->where('name', $bd)->first();
                                if ($detail) {
                                    $checked = 'checked';
                                } else {
                                    $checked = null;
                                }
                            @endphp
                            <div class="flex gap-x-2 col-span-4 col-start-3">
                                <input @style('pointer-events: none;') type="checkbox" {{ $checked }} />
                                <p>{{ $bd }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" />
                            <p>*) Nyeri Akut / Kronis </p>
                        </div>
                        <div class="justify-self-end pr-5">
                            <p>b.d</p>
                        </div>
                        @foreach ($bdNyeriAkut as $bd)
                            <div class="flex gap-x-2 col-span-4 col-start-3">
                                <input @style('pointer-events: none;') type="checkbox" />
                                <p>{{ $bd }}</p>
                            </div>
                        @endforeach
                    @endif

                    {{-- gangguan mobilitas fisik --}}
                    @php
                        $diagnosa = $asesmenDiagnosa->where('diagnosa', 'Gangguan Mobilitas Fisik')->first();
                    @endphp
                    @if ($diagnosa)
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" checked />
                            <p>{{ $diagnosa->diagnosa }}</p>
                        </div>
                        <div class="justify-self-end pr-5">
                            <p>b.d</p>
                        </div>
                        @foreach ($bdFisik as $bd)
                            @php
                                $detail = $diagnosa->igdHubDiagnosisKepAssKepPatients->where('name', $bd)->first();
                                if ($detail) {
                                    $checked = 'checked';
                                } else {
                                    $checked = null;
                                }
                            @endphp
                            <div class="flex gap-x-2 col-span-4 col-start-3">
                                <input @style('pointer-events: none;') type="checkbox" {{ $checked }} />
                                <p>{{ $bd }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" />
                            <p>Gangguan Mobilitas Fisik</p>
                        </div>
                        <div class="justify-self-end pr-5">
                            <p>b.d</p>
                        </div>
                        @foreach ($bdFisik as $bd)
                            <div class="flex gap-x-2 col-span-4 col-start-3">
                                <input @style('pointer-events: none;') type="checkbox" />
                                <p>{{ $bd }}</p>
                            </div>
                        @endforeach
                    @endif

                    {{-- Gangguan Integritas Kulit --}}
                    @php
                        $diagnosa = $asesmenDiagnosa
                            ->where('diagnosa', '*) Gangguan Integritas Kulit/jaringan')
                            ->first();
                    @endphp
                    @if ($diagnosa)
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" checked />
                            <p>{{ $diagnosa->diagnosa }}</p>
                        </div>
                        <div class="justify-self-end pr-5">
                            <p>b.d</p>
                        </div>
                        @foreach ($bdIntegritas as $bd)
                            @php
                                $detail = $diagnosa->igdHubDiagnosisKepAssKepPatients->where('name', $bd)->first();
                                if ($detail) {
                                    $checked = 'checked';
                                } else {
                                    $checked = null;
                                }
                            @endphp
                            <div class="flex gap-x-2 col-span-4 col-start-3">
                                <input @style('pointer-events: none;') type="checkbox" {{ $checked }} />
                                <p>{{ $bd }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" />
                            <p>*) Gangguan Integritas Kulit/jaringan</p>
                        </div>
                        <div class="justify-self-end pr-5">
                            <p>b.d</p>
                        </div>
                        @foreach ($bdIntegritas as $bd)
                            <div class="flex gap-x-2 col-span-4 col-start-3">
                                <input @style('pointer-events: none;') type="checkbox" />
                                <p>{{ $bd }}</p>
                            </div>
                        @endforeach
                    @endif

                    {{-- Retensi urine --}}
                    @php
                        $diagnosa = $asesmenDiagnosa->where('diagnosa', 'Retensi Urine')->first();
                    @endphp
                    @if ($diagnosa)
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" checked />
                            <p>{{ $diagnosa->diagnosa }}</p>
                        </div>
                        <div class="justify-self-end pr-5">
                            <p>b.d</p>
                        </div>
                        @foreach ($bdUrine as $bd)
                            @php
                                $detail = $diagnosa->igdHubDiagnosisKepAssKepPatients->where('name', $bd)->first();
                                if ($detail) {
                                    $checked = 'checked';
                                } else {
                                    $checked = null;
                                }
                            @endphp
                            <div class="flex gap-x-2 col-span-4 col-start-3">
                                <input @style('pointer-events: none;') type="checkbox" {{ $checked }} />
                                <p>{{ $bd }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" />
                            <p>Retensi Urine</p>
                        </div>
                        <div class="justify-self-end pr-5">
                            <p>b.d</p>
                        </div>
                        @foreach ($bdUrine as $bd)
                            <div class="flex gap-x-2 col-span-4 col-start-3">
                                <input @style('pointer-events: none;') type="checkbox" />
                                <p>{{ $bd }}</p>
                            </div>
                        @endforeach
                    @endif

                    {{-- Bersihan Jalan Napas --}}
                    @php
                        $diagnosa = $asesmenDiagnosa->where('diagnosa', 'Bersihan Jalan Napas Tidak Efektif')->first();
                    @endphp
                    @if ($diagnosa)
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" checked />
                            <p>{{ $diagnosa->diagnosa }}</p>
                        </div>
                        <div class="justify-self-end pr-5">
                            <p>b.d</p>
                        </div>
                        @foreach ($bdJalanNafas as $bd)
                            @php
                                $detail = $diagnosa->igdHubDiagnosisKepAssKepPatients->where('name', $bd)->first();
                                if ($detail) {
                                    $checked = 'checked';
                                } else {
                                    $checked = null;
                                }
                            @endphp
                            <div class="flex gap-x-2 col-span-4 col-start-3">
                                <input @style('pointer-events: none;') type="checkbox" {{ $checked }} />
                                <p>{{ $bd }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" />
                            <p>Bersihan Jalan Napas Tidak Efektif</p>
                        </div>
                        <div class="justify-self-end pr-5">
                            <p>b.d</p>
                        </div>
                        @foreach ($bdJalanNafas as $bd)
                            <div class="flex gap-x-2 col-span-4 col-start-3">
                                <input @style('pointer-events: none;') type="checkbox" />
                                <p>{{ $bd }}</p>
                            </div>
                        @endforeach
                    @endif

                    {{-- Pola Napas Tidak --}}
                    @php
                        $diagnosa = $asesmenDiagnosa->where('diagnosa', 'Pola Napas Tidak Efektif')->first();
                    @endphp
                    @if ($diagnosa)
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" checked />
                            <p>{{ $diagnosa->diagnosa }}</p>
                        </div>
                        <div class="justify-self-end pr-5">
                            <p>d.d</p>
                        </div>
                        @foreach ($bdPolaNafas as $bd)
                            @php
                                $detail = $diagnosa->igdHubDiagnosisKepAssKepPatients->where('name', $bd)->first();
                                if ($detail) {
                                    $checked = 'checked';
                                } else {
                                    $checked = null;
                                }
                            @endphp
                            <div class="flex gap-x-2 col-span-4 col-start-3">
                                <input @style('pointer-events: none;') type="checkbox" {{ $checked }} />
                                <p>{{ $bd }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" />
                            <p>Pola Napas Tidak Efektif</p>
                        </div>
                        <div class="justify-self-end pr-5">
                            <p>d.d</p>
                        </div>
                        @foreach ($bdPolaNafas as $bd)
                            <div class="flex gap-x-2 col-span-4 col-start-3">
                                <input @style('pointer-events: none;') type="checkbox" />
                                <p>{{ $bd }}</p>
                            </div>
                        @endforeach
                    @endif

                    {{-- lainnya --}}
                    @php
                        $diagnosa = $asesmenDiagnosa
                            ->where('diagnosa', '!=', '*) Nyeri Akut / Kronis')
                            ->where('diagnosa', '!=', 'Gangguan Mobilitas Fisik')
                            ->where('diagnosa', '!=', '*) Gangguan Integritas Kulit/jaringan')
                            ->where('diagnosa', '!=', 'Retensi Urine')
                            ->where('diagnosa', '!=', 'Bersihan Jalan Napas Tidak Efektif')
                            ->where('diagnosa', '!=', 'Pola Napas Tidak Efektif')
                            ->first();
                    @endphp
                    @if ($diagnosa)
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" checked />
                            <p>{{ $diagnosa->diagnosa }}</p>
                        </div>
                        <div class="justify-self-end pr-5">
                            <p>b.d</p>
                        </div>
                        @foreach ($diagnosa->igdHubDiagnosisKepAssKepPatients as $bd)
                            <div class="flex gap-x-2 col-span-4 col-start-3">
                                <input @style('pointer-events: none;') type="checkbox" checked />
                                <p>{{ $bd->name }}</p>
                            </div>
                        @endforeach
                    @endif
                </section>

                <!-- masalah keperawatan -->
                <h1 class="font-bold text-center uppercase bg-gray-300">Masalah Keperawatan</h1>

                <section class="grid grid-cols-4 p-2">
                    @foreach ($masalahKeperawatan as $mK)
                        @php
                            $detail = $masalah->where('diagnosa', $mK)->first();
                            if ($detail) {
                                $checked = 'checked';
                            } else {
                                $checked = null;
                            }
                        @endphp
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" {{ $checked }} />
                            <p>{{ $mK }}</p>
                        </div>
                    @endforeach
                </section>

                <!-- rencana asuhan -->
                <h1 class="font-bold text-center uppercase bg-gray-300">Rencana Asuhan</h1>

                <section class="grid grid-cols-4 p-2">
                    @foreach ($rencanaAsuhan as $ra)
                        @php
                            $detail = $detailRencana->where('name', $ra)->first();
                            if ($detail) {
                                $checked = 'checked';
                            } else {
                                $checked = null;
                            }
                        @endphp
                        <div class="flex gap-x-2">
                            <input @style('pointer-events: none;') type="checkbox" {{ $checked }} />
                            <p>{{ $ra }}</p>
                        </div>
                    @endforeach
                </section>

                <!-- TTD -->
                <section class="grid grid-cols-2 grid-rows-4 justify-items-center pt-10" @style('grid-template-rows: max-content;')>
                    @php
                        $formatTanggal = Carbon\Carbon::parse($item->tgl_selesai_asesmen);
                    @endphp
                    <div class="flex col-start-1 row-start-1 h-5">
                        <p>Diriview</p>
                    </div>
                    <div class="flex col-start-2 row-start-1 h-5">
                        <p>Tanggal / Jam selesai asesmen :
                            {{ $formatTanggal->isoformat('D MMM Y') ?? '............' }} /
                            {{ $formatTanggal->format('H:i') ?? '...........' }}</p>
                    </div>
                    <div class="flex col-start-1 row-start-2 h-5">
                        <p>Dokter IGD</p>
                    </div>
                    <div class="flex col-start-2 row-start-2">
                        <p>Perawat Yang Melakukan Pengkajian</p>
                    </div>
                    <div class="col-start-1 row-start-3">
                        @if ($item->ttdDokter)
                            <img src="{{ asset('storage/' . $item->ttdDokter ?? '') }}" class="img-thumbnail"
                                width="150" height="150" alt="">
                        @else
                            <img src="" class="img-thumbnail">
                        @endif
                    </div>
                    <div class="col-start-2 row-start-3">
                        @if ($item->ttdPerawat)
                            <img src="{{ Storage::url($item->ttdPerawat ?? '') }}" class="img-fluid" width="150"
                                height="150" alt="">
                        @else
                            <img src="" class="img-fluid" alt="">
                        @endif
                    </div>
                    <div class="col-start-1 row-start-4">
                        {{ $item->nm_dokter ?? '(....................................................)' }}
                    </div>
                    <div class="col-start-2 row-start-4">
                        {{ $item->nm_perawat ?? '(....................................................)' }}
                    </div>
                </section>

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
