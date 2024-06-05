<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ews Anak</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            /* height: 210mm; */
            max-width: 330mm;
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

        .table-sm {
            font-size: 7pt !important;
        }

        .content {
            font-size: 8pt;
        }

        /* tr th {
                font-size: 8pt;
            }
            tr td {
                font-size: 9pt;
            } */

        small {
            font-size: 7pt;
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
            size: landscape;
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
                width: 100%;
                height: auto;
                margin: 0;
                padding: 0;
                overflow: visible;
                -webkit-print-color-adjust: exact;
            }

            .page {
                width: 100%;
                margin: 0;
                border: initial;
                border-radius: initial;
                box-shadow: none;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="header">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-2 lg:col-span-2 print:col-span-2">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-span-10 lg:col-span-8 print:col-span-8">
                    <h1 class="text-center uppercase mt-2">
                        EARLY WARNING SYSTEM (EWS) ANAK
                    </h1>
                </div>
            </div>
        </div>
        <div class="content mt-5">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 lg:col-span-6 print:col-span-6">
                    <table class="table-sm mb-3">
                        <thead>
                            <tr>
                                <td colspan="5" class="border border-black text-center">
                                    <span class="uppercase">Newss Pasien Anak</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-y border-black text-center">
                                <td class="border-x border-black"></td>
                                <td class="border-x border-black w-2/12">
                                    <span>0</span>
                                </td>
                                <td class="border-x border-black w-3/12">
                                    <span>1</span>
                                </td>
                                <td class="border-x border-black w-3/12">
                                    <span>2</span>
                                </td>
                                <td class="border-x border-black w-3/12">
                                    <span>3</span>
                                </td>
                            </tr>
                            <!-- 1 -->
                            <tr class="border-y border-black align-top">
                                <td class="border-x border-black text-start p-1">
                                    <span>Perilaku</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Sesuai</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Cenderung Murung / Diam</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Sensitif</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Letargik / Bingung / Penurunan
                                        Respon Terhadap Nyeri</span>
                                </td>
                            </tr>
                            <!-- 3 -->
                            <tr class="border-y border-black align-top">
                                <td class="border-x border-black text-start p-1">
                                    <span>Kardiovaskular</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Pink atau CRT 1-2 Detik</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Pucat atau CRT 3 <br />
                                        Detik Tekanan Darah Sistolik 10 mmHg
                                        diatas atau dibawah nilai
                                        normal</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Abu abu / biru CRT 4 detik <br />
                                        Takikardia : Nadi lebih tinggi/
                                        rendah 10 kali / menit</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Abu - abu / biru, mottled atau CRT
                                        ≥ 5 atau takikardia, nadi lebih
                                        tinggi atau lebih rendah 30 kali /
                                        menit</span>
                                </td>
                            </tr>
                            <!-- 3 -->
                            <tr class="border-y border-black align-top">
                                <td class="border-x border-black text-start p-1">
                                    <span>Respirasi</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Normal tidak ada retraksi</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>RR > 10 diatas normal menggunakan
                                        otot-otot aksesoris pernafasan</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>RR > 20 diatas normal, terdapat
                                        retraksi dinding dada</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>RR : 5 Di bawah normal dengan
                                        retraksi atau grunting
                                        (mendengkur)</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-span-12 lg:col-span-6 print:col-span-6">
                    <table class="font-semibold text-sm mb-3">
                        <tbody>
                            <!-- 1 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="py-1 pl-3 pr-24 font-semibold">
                                        Tanggal
                                    </p>
                                </td>
                                @foreach ($item->ranapEwsAnakPatients->pluck('tanggal') as $tanggal)
                                    <td class="border border-black"><input type="text" class="w-full py-1"
                                            value="{{ $tanggal ?? '' }}"></td>
                                @endforeach
                            </tr>
                            <!-- 2 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="py-1 pl-3 font-semibold">
                                        Waktu
                                    </p>
                                </td>
                                @foreach ($item->ranapEwsAnakPatients->pluck('jam') as $jam)
                                    <td class="border border-black"><input type="text" class="w-full py-1"
                                            value="{{ date('H', strtotime($jam ?? '')) }}"></td>
                                @endforeach
                            </tr>
                            <!-- 3 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="py-1 pl-3 font-semibold">
                                        Perilaku
                                    </p>
                                </td>
                                @foreach ($item->ranapEwsAnakPatients->pluck('perilaku') as $perilaku)
                                    <td class="border border-black"><input type="text" class="w-full py-1"
                                            value="{{ $perilaku ?? '' }}"></td>
                                @endforeach
                            </tr>
                            <!-- 4 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="py-1 pl-3 font-semibold">
                                        Kardiovaskular
                                    </p>
                                </td>
                                @foreach ($item->ranapEwsAnakPatients->pluck('kardiovaskular') as $kardiovaskular)
                                    <td class="border border-black"><input type="text" class="w-full py-1"
                                            value="{{ $kardiovaskular ?? '' }}"></td>
                                @endforeach
                            </tr>
                            <!-- 5 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="py-1 pl-3 font-semibold">
                                        Respirasi
                                    </p>
                                </td>
                                @foreach ($item->ranapEwsAnakPatients->pluck('respirasi') as $respirasi)
                                    <td class="border border-black"><input type="text" class="w-full py-1"
                                            value="{{ $respirasi ?? '' }}"></td>
                                @endforeach
                            </tr>
                            <!-- 6 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="py-1 pl-3 font-semibold">
                                        Jumlah Skor
                                    </p>
                                </td>
                                @foreach ($item->ranapEwsAnakPatients->pluck('total_skor') as $total)
                                    <td class="border border-black"><input type="text" class="w-full py-1"
                                            value="{{ $total ?? '' }}"></td>
                                @endforeach
                            </tr>
                            <!-- 7 -->
                            {{-- <tr>
                                    <script>
                                        for (var i = 0; i < 19; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr> --}}
                        </tbody>
                    </table>
                </div>
                <div class="col-span-12">
                    <table class="font-semibold uppercase text-center mb-3 mx-auto lg:mx-44 print:mx-32">
                        <tbody>
                            <tr class="border-y border-black">
                                <td class="border-x border-black px-2 py-1 bg-green-500">
                                    <span>Hijau</span>
                                </td>
                                <td class="border-x border-black px-2 py-1 bg-yellow-300">
                                    <span>Kuning</span>
                                </td>
                                <td class="border-x border-black px-2 py-1 bg-orange-500">
                                    <span>Orange</span>
                                </td>
                                <td class="border-x border-black px-2 py-1 bg-red-500">
                                    <span>Merah</span>
                                </td>
                            </tr>
                            <tr class="border-y border-black">
                                <td class="border-x border-black px-2 py-1 bg-green-500">
                                    <span>0-2</span>
                                </td>
                                <td class="border-x border-black px-2 py-1 bg-yellow-300">
                                    <span>3</span>
                                </td>
                                <td class="border-x border-black px-2 py-1 bg-orange-500">
                                    <span>4</span>
                                </td>
                                <td class="border-x border-black px-2 py-1 bg-red-500">
                                    <span>&ge;5</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-span-12 lg:col-span-6 print:col-span-6">
                    <table class="w-full table-sm mb-2 text-center">
                        <thead>
                            <tr>
                                <td colspan="4" class="border border-black text-center">
                                    <span class="uppercase">Nilai normal sesuai usia</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-y border-black text-center">
                                <td class="border-x border-black w-1/4 p-1">
                                    <span>Usia</span>
                                </td>
                                <td class="border-x border-black w-1/4 p-1">
                                    <span>Frekuensi Nadi (x/menit)</span>
                                </td>
                                <td class="border-x border-black w-1/4 p-1">
                                    <span>Tekanan Darah Sistolik (mmHg)</span>
                                </td>
                                <td class="border-x border-black w-1/4 p-1">
                                    <span>Frekuensi Nafas (x/menit)</span>
                                </td>
                            </tr>
                            <!-- 1 -->
                            <tr class="border-y border-black">
                                <td class="border-x border-black p-1">
                                    <span>0 - 3 Bulan</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>100-180</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>50</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>50</span>
                                </td>
                            </tr>
                            <!-- 2 -->
                            <tr class="border-y border-black">
                                <td class="border-x border-black p-1">
                                    <span>4 - 12 Bulan</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>100-180</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>60</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>60</span>
                                </td>
                            </tr>
                            <!-- 3 -->
                            <tr class="border-y border-black">
                                <td class="border-x border-black p-1">
                                    <span>1 - 4 Tahun</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>90-160</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>70</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>40</span>
                                </td>
                            </tr>
                            <!-- 1 -->
                            <tr class="border-y border-black">
                                <td class="border-x border-black p-1">
                                    <span>5 - 12 Tahun</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>80-140</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>80</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>30</span>
                                </td>
                            </tr>
                            <!-- 1 -->
                            <tr class="border-y border-black">
                                <td class="border-x border-black p-1">
                                    <span>&gt;12 Tahun</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>60-130</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>90</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>30</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-span-12">
                    <div class="font-semibold">
                        <span>Catatan :</span>
                        <span>Observasi dan pencatatan
                            <span class="italic">Early Warning System</span>
                            (EWS) dilakukan :</span>
                        <ul>
                            <li>a. Pada saat pasien masuk</li>
                            <li>
                                b. Sesuai dengan total skor (frekuensi
                                observasi)
                            </li>
                            <li>
                                c. Pada saat pasien mengalami perubahan
                                kondisi
                            </li>
                            <li>
                                d. Jika petugas khawatir dengan perubahan
                                kondisi pasien
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <main class="flex gap-3">
                <section class="basis-2/5">
                    {{-- <table class="table-sm mb-3">
                        <thead>
                            <tr>
                                <td colspan="5" class="border border-black text-center">
                                    <span class="uppercase">Newss Pasien Anak</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-y border-black text-center">
                                <td class="border-x border-black"></td>
                                <td class="border-x border-black w-2/12">
                                    <span>0</span>
                                </td>
                                <td class="border-x border-black w-3/12">
                                    <span>1</span>
                                </td>
                                <td class="border-x border-black w-3/12">
                                    <span>2</span>
                                </td>
                                <td class="border-x border-black w-3/12">
                                    <span>3</span>
                                </td>
                            </tr>
                            <!-- 1 -->
                            <tr class="border-y border-black align-top">
                                <td class="border-x border-black text-start p-1">
                                    <span>Perilaku</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Sesuai</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Cenderung Murung / Diam</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Sensitif</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Letargik / Bingung / Penurunan
                                        Respon Terhadap Nyeri</span>
                                </td>
                            </tr>
                            <!-- 3 -->
                            <tr class="border-y border-black align-top">
                                <td class="border-x border-black text-start p-1">
                                    <span>Kardiovaskular</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Pink atau CRT 1-2 Detik</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Pucat atau CRT 3 <br />
                                        Detik Tekanan Darah Sistolik 10 mmHg
                                        diatas atau dibawah nilai
                                        normal</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Abu abu / biru CRT 4 detik <br />
                                        Takikardia : Nadi lebih tinggi/
                                        rendah 10 kali / menit</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Abu - abu / biru, mottled atau CRT
                                        ≥ 5 atau takikardia, nadi lebih
                                        tinggi atau lebih rendah 30 kali /
                                        menit</span>
                                </td>
                            </tr>
                            <!-- 3 -->
                            <tr class="border-y border-black align-top">
                                <td class="border-x border-black text-start p-1">
                                    <span>Respirasi</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>Normal tidak ada retraksi</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>RR > 10 diatas normal menggunakan
                                        otot-otot aksesoris pernafasan</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>RR > 20 diatas normal, terdapat
                                        retraksi dinding dada</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>RR : 5 Di bawah normal dengan
                                        retraksi atau grunting
                                        (mendengkur)</span>
                                </td>
                            </tr>
                        </tbody>
                    </table> --}}

                    {{-- <table class="font-semibold uppercase text-center mb-3 mx-52">
                        <tbody>
                            <tr class="border-y border-black">
                                <td class="border-x border-black px-2 py-1 bg-green-500">
                                    <span>Hijau</span>
                                </td>
                                <td class="border-x border-black px-2 py-1 bg-yellow-300">
                                    <span>Kuning</span>
                                </td>
                                <td class="border-x border-black px-2 py-1 bg-orange-500">
                                    <span>Orange</span>
                                </td>
                                <td class="border-x border-black px-2 py-1 bg-red-500">
                                    <span>Merah</span>
                                </td>
                            </tr>
                            <tr class="border-y border-black">
                                <td class="border-x border-black px-2 py-1 bg-green-500">
                                    <span>0-2</span>
                                </td>
                                <td class="border-x border-black px-2 py-1 bg-yellow-300">
                                    <span>3</span>
                                </td>
                                <td class="border-x border-black px-2 py-1 bg-orange-500">
                                    <span>4</span>
                                </td>
                                <td class="border-x border-black px-2 py-1 bg-red-500">
                                    <span>&ge;5</span>
                                </td>
                            </tr>
                        </tbody>
                    </table> --}}

                    {{-- <table class="w-full table-sm mb-10 text-center">
                        <thead>
                            <tr>
                                <td colspan="4" class="border border-black text-center">
                                    <span class="uppercase">Nilai normal sesuai usia</span>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-y border-black text-center">
                                <td class="border-x border-black w-1/4 p-1">
                                    <span>Usia</span>
                                </td>
                                <td class="border-x border-black w-1/4 p-1">
                                    <span>Frekuensi Nadi (x/menit)</span>
                                </td>
                                <td class="border-x border-black w-1/4 p-1">
                                    <span>Tekanan Darah Sistolik (mmHg)</span>
                                </td>
                                <td class="border-x border-black w-1/4 p-1">
                                    <span>Frekuensi Nafas (x/menit)</span>
                                </td>
                            </tr>
                            <!-- 1 -->
                            <tr class="border-y border-black">
                                <td class="border-x border-black p-1">
                                    <span>0 - 3 Bulan</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>100-180</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>50</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>50</span>
                                </td>
                            </tr>
                            <!-- 2 -->
                            <tr class="border-y border-black">
                                <td class="border-x border-black p-1">
                                    <span>4 - 12 Bulan</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>100-180</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>60</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>60</span>
                                </td>
                            </tr>
                            <!-- 3 -->
                            <tr class="border-y border-black">
                                <td class="border-x border-black p-1">
                                    <span>1 - 4 Tahun</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>90-160</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>70</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>40</span>
                                </td>
                            </tr>
                            <!-- 1 -->
                            <tr class="border-y border-black">
                                <td class="border-x border-black p-1">
                                    <span>5 - 12 Tahun</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>80-140</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>80</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>30</span>
                                </td>
                            </tr>
                            <!-- 1 -->
                            <tr class="border-y border-black">
                                <td class="border-x border-black p-1">
                                    <span>&gt;12 Tahun</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>60-130</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>90</span>
                                </td>
                                <td class="border-x border-black p-1">
                                    <span>30</span>
                                </td>
                            </tr>
                        </tbody>
                    </table> --}}

                    {{-- <div class="font-semibold">
                        <span>Catatan :</span>
                        <span>Observasi dan pencatatan
                            <span class="italic">Early Warning System</span>
                            (EWS) dilakukan :</span>
                        <ul>
                            <li>a. Pada saat pasien masuk</li>
                            <li>
                                b. Sesuai dengan total skor (frekuensi
                                observasi)
                            </li>
                            <li>
                                c. Pada saat pasien mengalami perubahan
                                kondisi
                            </li>
                            <li>
                                d. Jika petugas khawatir dengan perubahan
                                kondisi pasien
                            </li>
                        </ul>
                    </div> --}}
                </section>

                <section class="basis-3/5">
                    {{-- <table class="font-semibold text-sm mb-3">
                        <tbody>
                            <!-- 1 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="py-1 pl-3 pr-24 font-semibold">
                                        Tanggal
                                    </p>
                                </td>
                                @foreach ($item->ranapEwsAnakPatients->pluck('tanggal') as $tanggal)
                                    <td class="border border-black"><input type="text" class="w-full py-1"
                                            value="{{ $tanggal ?? '' }}"></td>
                                @endforeach
                            </tr>
                            <!-- 2 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="py-1 pl-3 font-semibold">
                                        Waktu
                                    </p>
                                </td>
                                @foreach ($item->ranapEwsAnakPatients->pluck('jam') as $jam)
                                    <td class="border border-black"><input type="text" class="w-full py-1"
                                            value="{{ date('H', strtotime($jam ?? '')) }}"></td>
                                @endforeach
                            </tr>
                            <!-- 3 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="py-1 pl-3 font-semibold">
                                        Perilaku
                                    </p>
                                </td>
                                @foreach ($item->ranapEwsAnakPatients->pluck('perilaku') as $perilaku)
                                    <td class="border border-black"><input type="text" class="w-full py-1"
                                            value="{{ $perilaku ?? '' }}"></td>
                                @endforeach
                            </tr>
                            <!-- 4 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="py-1 pl-3 font-semibold">
                                        Kardiovaskular
                                    </p>
                                </td>
                                @foreach ($item->ranapEwsAnakPatients->pluck('kardiovaskular') as $kardiovaskular)
                                    <td class="border border-black"><input type="text" class="w-full py-1"
                                            value="{{ $kardiovaskular ?? '' }}"></td>
                                @endforeach
                            </tr>
                            <!-- 5 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="py-1 pl-3 font-semibold">
                                        Respirasi
                                    </p>
                                </td>
                                @foreach ($item->ranapEwsAnakPatients->pluck('respirasi') as $respirasi)
                                    <td class="border border-black"><input type="text" class="w-full py-1"
                                            value="{{ $respirasi ?? '' }}"></td>
                                @endforeach
                            </tr>
                            <!-- 6 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="py-1 pl-3 font-semibold">
                                        Jumlah Skor
                                    </p>
                                </td>
                                @foreach ($item->ranapEwsAnakPatients->pluck('total_skor') as $total)
                                    <td class="border border-black"><input type="text" class="w-full py-1"
                                            value="{{ $total ?? '' }}"></td>
                                @endforeach
                            </tr>
                            <!-- 7 -->
                            <tr>
                                    <script>
                                        for (var i = 0; i < 19; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                        </tbody>
                    </table> --}}

                    {{-- idk --}}
                    {{-- <table class="font-semibold text-sm mb-3">
                            <tbody>
                                <!-- 1 -->
                                <tr>
                                    <td class="border border-black">
                                        <p
                                            class="py-1 pl-3 pr-24 font-semibold"
                                        >
                                            Tanggal
                                        </p>
                                    </td>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 18; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                                <!-- 2 -->
                                <tr>
                                    <td class="border border-black">
                                        <p class="py-1 pl-3 font-semibold">
                                            Waktu
                                        </p>
                                    </td>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 18; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                                <!-- 3 -->
                                <tr>
                                    <td class="border border-black">
                                        <p class="py-1 pl-3 font-semibold">
                                            Prilaku
                                        </p>
                                    </td>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 18; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                                <!-- 4 -->
                                <tr>
                                    <td class="border border-black">
                                        <p class="py-1 pl-3 font-semibold">
                                            Kardiovaskular
                                        </p>
                                    </td>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 18; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                                <!-- 5 -->
                                <tr>
                                    <td class="border border-black">
                                        <p class="py-1 pl-3 font-semibold">
                                            Respirasi
                                        </p>
                                    </td>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 18; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                                <!-- 6 -->
                                <tr>
                                    <td class="border border-black">
                                        <p class="py-1 pl-3 font-semibold">
                                            Jumlah Skor
                                        </p>
                                    </td>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 18; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                                <!-- 7 -->
                                <tr>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 19; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                            </tbody>
                        </table>
                        <table class="font-semibold text-sm mb-3">
                            <tbody>
                                <!-- 1 -->
                                <tr>
                                    <td class="border border-black">
                                        <p
                                            class="py-1 pl-3 pr-24 font-semibold"
                                        >
                                            Tanggal
                                        </p>
                                    </td>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 18; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                                <!-- 2 -->
                                <tr>
                                    <td class="border border-black">
                                        <p class="py-1 pl-3 font-semibold">
                                            Waktu
                                        </p>
                                    </td>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 18; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                                <!-- 3 -->
                                <tr>
                                    <td class="border border-black">
                                        <p class="py-1 pl-3 font-semibold">
                                            Prilaku
                                        </p>
                                    </td>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 18; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                                <!-- 4 -->
                                <tr>
                                    <td class="border border-black">
                                        <p class="py-1 pl-3 font-semibold">
                                            Kardiovaskular
                                        </p>
                                    </td>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 18; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                                <!-- 5 -->
                                <tr>
                                    <td class="border border-black">
                                        <p class="py-1 pl-3 font-semibold">
                                            Respirasi
                                        </p>
                                    </td>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 18; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                                <!-- 6 -->
                                <tr>
                                    <td class="border border-black">
                                        <p class="py-1 pl-3 font-semibold">
                                            Jumlah Skor
                                        </p>
                                    </td>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 18; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                                <!-- 7 -->
                                <tr>
                                    <!-- layout html
                                    <td class="border border-black"><input type="text" class="w-full py-1"></td> -->
                                    <script>
                                        for (var i = 0; i < 19; i++) {
                                            document.write(
                                                '<td class="border border-black"><input type="text" class="w-full py-1"></td>'
                                            );
                                        }
                                    </script>
                                </tr>
                            </tbody>
                        </table> --}}
                </section>
            </main>
        </div>
    </div>

    {{-- <script>
            var today = new Date();
            var options = { year: "numeric", month: "long", day: "numeric" };
            document.getElementById("tanggal").innerText =
                today.toLocaleDateString("id-ID", options);
        </script> --}}
</body>

</html>
