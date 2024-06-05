<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ews Dewasa</title>
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
                height: 210mm;
                width: 330mm;
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
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-2 lg:col-span-2 print:col-span-2 mx-auto">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-span-9 lg:col-span-8 print:col-span-8">
                    <h1 class="text-center uppercase mt-2">
                        EARLY WARNING SYSTEM (EWS) DEWASA
                    </h1>
                </div>
            </div>
        </div>
        <div class="content mt-10">
            <main class="flex gap-3 mt-3">
                <div class="grid grid-cols-12 justify-items-center">
                    <div class="col-span-12 lg:col-span-5 print:col-span-5">
                        <section>
                            <table class="table-sm w-96">
                                <thead>
                                    <tr class="border-y border-black text-center">
                                        <td class="border-x border-black px-2">
                                            <span>Total Skor</span>
                                        </td>
                                        <td class="border-x border-black">
                                            <span>Frekuensi Observasi</span>
                                        </td>
                                        <td class="border-x border-black">
                                            <span>Alert</span>
                                        </td>
                                        <td class="border-x border-black">
                                            <span>Respon</span>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- 1 -->
                                    <tr class="border-y border-black">
                                        <td class="border-x border-black text-center">
                                            <span>1</span>
                                        </td>
                                        <td class="border-x border-black text-center">
                                            <span>Setiap 12 jam</span>
                                        </td>
                                        <td class="border-x border-black px-2">
                                            <span>Perawat yang bertugas</span>
                                        </td>
                                        <td class="border-x border-black px-2">
                                            <span>Perawat yang bertugas mereview
                                                kondisi pasien</span>
                                        </td>
                                    </tr>
                                    <!-- 2 -->
                                    <tr class="border-y border-black">
                                        <td class="border-x border-black text-center">
                                            <span>2</span>
                                        </td>
                                        <td class="border-x border-black text-center">
                                            <span>Setiap 6 jam</span>
                                        </td>
                                        <td class="border-x border-black px-2">
                                            <span>Perawat yang bertugas</span>
                                        </td>
                                        <td class="border-x border-black px-2">
                                            <span>Perawat yang bertugas mereview
                                                kondisi pasien</span>
                                        </td>
                                    </tr>
                                    <!-- 3 -->
                                    <tr class="border-y border-black">
                                        <td class="border-x border-black text-center">
                                            <span>3</span>
                                        </td>
                                        <td class="border-x border-black text-center">
                                            <span>Setiap 4 jam</span>
                                        </td>
                                        <td class="border-x border-black px-2">
                                            <span>Perawat yang bertugas dan tim
                                                pengkajian kritis</span>
                                        </td>
                                        <td class="border-x border-black px-2">
                                            <div class="flex gap-2">
                                                <input type="checkbox" style="pointer-events: none;" />
                                                <span>PPA/PJ Shift untuk meninjau
                                                    dalam waktu satu jam</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- 4-6 -->
                                    <tr class="border-y border-black align-top">
                                        <td class="border-x border-black text-center">
                                            <span>4-6</span>
                                        </td>
                                        <td class="border-x border-black text-center">
                                            <span>Setiap 1 jam</span>
                                        </td>
                                        <td class="border-x border-black px-2">
                                            <span>Perawat yang bertugas dan tim
                                                pengkajian kritis</span>
                                        </td>
                                        <td class="border-x border-black px-2">
                                            <div class="flex gap-2">
                                                <input type="checkbox" style="pointer-events: none;" />
                                                <span>PPA/PJ Shift untuk meninjau
                                                    dalam waktu satu jam</span>
                                            </div>
                                            <div class="flex gap-2">
                                                <input type="checkbox" style="pointer-events: none;" />
                                                <span>Screening untuk Sepsis</span>
                                            </div>
                                            <div class="flex gap-2">
                                                <input type="checkbox" style="pointer-events: none;" />
                                                <span>Jika tidak ada respon terhadap
                                                    pengobatan dalam 1 jam hubungi
                                                    dokter</span>
                                            </div>
                                            <div class="flex gap-2">
                                                <input type="checkbox" style="pointer-events: none;" />
                                                <span>Jika tidak ada respon terhadap
                                                    pengobatan dalam 1 jam hubungi
                                                    dokter</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- lebih sama dengan 7 -->
                                    <tr class="border-t border-black align-top">
                                        <td class="border-x border-black text-center">
                                            <span>&ge;7</span>
                                        </td>
                                        <td class="border-x border-black text-center">
                                            <span>Setiap &frac12; jam</span>
                                        </td>
                                        <td class="border-x border-black px-2">
                                            <span>Perawat yang bertugas dan tim
                                                pengkajian kritis</span>
                                        </td>
                                        <td class="border-x border-black px-2">
                                            <div class="flex gap-2">
                                                <input type="checkbox" style="pointer-events: none;" />
                                                <span>Dokter segera meninjau</span>
                                            </div>
                                            <div class="flex gap-2">
                                                <input type="checkbox" style="pointer-events: none;" />
                                                <span>Pemantauan pasien terus
                                                    menerus</span>
                                            </div>
                                            <div class="flex gap-2">
                                                <input type="checkbox" style="pointer-events: none;" />
                                                <span>Rencanakan untuk pindah ke
                                                    tingkat perawatan yang lebih
                                                    tinggi</span>
                                            </div>
                                            <div class="flex gap-2">
                                                <input type="checkbox" style="pointer-events: none;" />
                                                <span>Mengaktifkan Sistem Tanggap
                                                    Darurat (Emergency Response
                                                    System/ERS) (sesuai model rumah
                                                    sakit)</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table-sm w-96">
                                <thead>
                                    <tr>
                                        <td colspan="8" class="border border-black bg-blue-300 text-center">
                                            <span class="uppercase">Newss Pasien Dewasa</span>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-y border-black text-center">
                                        <td class="border-x border-black w-2/12"></td>
                                        <td class="border-x border-black bg-red-500 w-1/12"></td>
                                        <td class="border-x border-black bg-orange-500 w-1/12"></td>
                                        <td class="border-x border-black bg-yellow-300 w-2/12">
                                            <span>1</span>
                                        </td>
                                        <td class="border-x border-black bg-green-500 w-1/12">
                                            <span>0</span>
                                        </td>
                                        <td class="border-x border-black bg-yellow-300 w-1/12">
                                            <span>1</span>
                                        </td>
                                        <td class="border-x border-black bg-green-500 w-2/12">
                                            <span>2</span>
                                        </td>
                                        <td class="border-x border-black bg-red-500 w-1/12">
                                            <span>3</span>
                                        </td>
                                    </tr>
                                    <!-- 1 -->
                                    <tr class="border-y border-black text-center">
                                        <td class="border-x border-black text-start px-1">
                                            <span>Frekuensi Pernapasan
                                                (x/Menit)</span>
                                        </td>
                                        <td class="border-x border-black bg-red-500"></td>
                                        <td class="border-x border-black bg-orange-500">
                                            <span>&lt;8</span>
                                        </td>
                                        <td class="border-x border-black bg-yellow-300">
                                            <span>8</span>
                                        </td>
                                        <td class="border-x border-black bg-green-500">
                                            <span>16-17</span>
                                        </td>
                                        <td class="border-x border-black bg-yellow-300">
                                            <span>18-20</span>
                                        </td>
                                        <td class="border-x border-black bg-green-500">
                                            <span>21-59</span>
                                        </td>
                                        <td class="border-x border-black bg-red-500">
                                            <span>&ge;30</span>
                                        </td>
                                    </tr>
                                    <!-- 2 -->
                                    <tr class="border-y border-black text-center">
                                        <td class="border-x border-black text-start px-1">
                                            <span>Frekuensi Nadi (x/Menit)</span>
                                        </td>
                                        <td class="border-x border-black bg-red-500"></td>
                                        <td class="border-x border-black bg-orange-500">
                                            <span>&lt;40</span>
                                        </td>
                                        <td class="border-x border-black bg-yellow-300">
                                            <span>40-50</span>
                                        </td>
                                        <td class="border-x border-black bg-green-500">
                                            <span>51-100</span>
                                        </td>
                                        <td class="border-x border-black bg-yellow-300">
                                            <span>101-110</span>
                                        </td>
                                        <td class="border-x border-black bg-green-500">
                                            <span>111-129</span>
                                        </td>
                                        <td class="border-x border-black bg-red-500">
                                            <span>&ge;130</span>
                                        </td>
                                    </tr>
                                    <!-- 3 -->
                                    <tr class="border-y border-black text-center">
                                        <td class="border-x border-black text-start px-1">
                                            <span>CRT</span>
                                        </td>
                                        <td class="border-x border-black bg-red-500"></td>
                                        <td class="border-x border-black bg-orange-500"></td>
                                        <td class="border-x border-black bg-yellow-300"></td>
                                        <td class="border-x border-black bg-green-500">
                                            <span>Kulit normal CRT 1,2 Detik</span>
                                        </td>
                                        <td class="border-x border-black bg-yellow-300">
                                            <span>Pucat, CRT 3 Detik</span>
                                        </td>
                                        <td class="border-x border-black bg-green-500">
                                            <span>Abu-abu/ Kebiruan CRT 4 Detik</span>
                                        </td>
                                        <td class="border-x border-black bg-red-500">
                                            <span>Biru CRT 5 Detik</span>
                                        </td>
                                    </tr>
                                    <!-- 4 -->
                                    <tr class="border-y border-black text-center">
                                        <td class="border-x border-black text-start px-1">
                                            <span>Tekanan Darah Sistolik (mmHg)</span>
                                        </td>
                                        <td class="border-x border-black bg-red-500">
                                            <span>&plusmn;70</span>
                                        </td>
                                        <td class="border-x border-black bg-orange-500">
                                            <span>71-80</span>
                                        </td>
                                        <td class="border-x border-black bg-yellow-300">
                                            <span>81-100</span>
                                        </td>
                                        <td class="border-x border-black bg-green-500">
                                            <span>101-159</span>
                                        </td>
                                        <td class="border-x border-black bg-yellow-300">
                                            <span>160-199</span>
                                        </td>
                                        <td class="border-x border-black bg-green-500">
                                            <span>200-220</span>
                                        </td>
                                        <td class="border-x border-black bg-red-500">
                                            <span>&gt;220</span>
                                        </td>
                                    </tr>
                                    <!-- 5 -->
                                    <tr class="border-y border-black text-center">
                                        <td class="border-x border-black text-start px-1">
                                            <span>Tingkat Kesadaran</span>
                                        </td>
                                        <td class="border-x border-black bg-red-500">
                                            <span>Coma</span>
                                        </td>
                                        <td class="border-x border-black bg-orange-500">
                                            <span>Stupor</span>
                                        </td>
                                        <td class="border-x border-black bg-yellow-300">
                                            <span>Somnolen</span>
                                        </td>
                                        <td class="border-x border-black bg-green-500">
                                            <span>Compos Mentis</span>
                                        </td>
                                        <td class="border-x border-black bg-yellow-300">
                                            <span>Apatis</span>
                                        </td>
                                        <td class="border-x border-black bg-green-500">
                                            <span>Acute Confusional/ Delirium</span>
                                        </td>
                                        <td class="border-x border-black bg-red-500"></td>
                                    </tr>
                                    <!-- 6 -->
                                    <tr class="border-y border-black text-center">
                                        <td class="border-x border-black text-start px-1">
                                            <span>Suhu Tubuh (&#8451;)</span>
                                        </td>
                                        <td class="border-x border-black bg-red-500"></td>
                                        <td class="border-x border-black bg-orange-500">
                                            <span>&lt;35&#8451;</span>
                                        </td>
                                        <td class="border-x border-black bg-yellow-300">
                                            <span>35,05&#8451; - 36&#8451;</span>
                                        </td>
                                        <td class="border-x border-black bg-green-500">
                                            <span>36,5&#8451; - 38&#8451;</span>
                                        </td>
                                        <td class="border-x border-black bg-yellow-300">
                                            <span>38,05&#8451; - 38,5&#8451;</span>
                                        </td>
                                        <td class="border-x border-black bg-green-500">
                                            <span>&gt;38,5&#8451;</span>
                                        </td>
                                        <td class="border-x border-black bg-red-500"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>
                    </div>
                    <div class="col-span-12 lg:col-span-6 print:col-span-6">
                        <section>
                            <div class="grid grid-cols-6 justify-items-center mt-5">
                                @foreach ($item->ranapEwsDewasaPatients as $ewsDewasa)
                                    <div class="col-span-6 mx-1 lg:col-span-3 print:col-span-3">
                                        <table
                                            class="font-semibold {{ !$loop->first ? 'mt-5 lg:mt-0 print:mt-0' : '' }}">
                                            <tbody>
                                                <!-- 1 -->
                                                <tr>
                                                    <td class="border border-black">
                                                        <p class="py-1 pl-3 pr-24 font-semibold">
                                                            Tanggal
                                                        </p>
                                                    </td>
                                                    <td class="border border-black">
                                                        <input type="text" class="w-full py-1"
                                                            value="{{ $ewsDewasa->tanggal ?? '' }}"
                                                            @readonly(true) />
                                                    </td>
                                                </tr>
                                                <!-- 2 -->
                                                <tr>
                                                    <td class="border border-black">
                                                        <p class="py-1 pl-3 font-semibold">
                                                            Waktu
                                                        </p>
                                                    </td>
                                                    <td class="border border-black">
                                                        <input type="text" class="w-full py-1"
                                                            value="{{ $ewsDewasa->jam ?? '' }}" @readonly(true) />
                                                    </td>
                                                </tr>
                                                <!-- 3 -->
                                                <tr>
                                                    <td class="border border-black">
                                                        <p class="py-1 pl-3 font-semibold">
                                                            Frekuensi Napas
                                                        </p>
                                                    </td>
                                                    <td class="border border-black">
                                                        <input type="text" class="w-full py-1"
                                                            value="{{ $ewsDewasa->frekuensi_napas ?? '' }}"
                                                            @readonly(true) />
                                                    </td>
                                                </tr>
                                                <!-- 4 -->
                                                <tr>
                                                    <td class="border border-black">
                                                        <p class="py-1 pl-3 font-semibold">
                                                            Frekuensi Nadi
                                                        </p>
                                                    </td>
                                                    <td class="border border-black">
                                                        <input type="text" class="w-full py-1"
                                                            value="{{ $ewsDewasa->frekuensi_nadi ?? '' }}"
                                                            @readonly(true) />
                                                    </td>
                                                </tr>
                                                <!-- 5 -->
                                                <tr>
                                                    <td class="border border-black">
                                                        <p class="py-1 pl-3 font-semibold">
                                                            Tekanan Sistolik
                                                        </p>
                                                    </td>
                                                    <td class="border border-black">
                                                        <input type="text" class="w-full py-1"
                                                            value="{{ $ewsDewasa->tekanan_sistolik ?? '' }}"
                                                            @readonly(true) />
                                                    </td>
                                                </tr>
                                                <!-- 6 -->
                                                <tr>
                                                    <td class="border border-black">
                                                        <p class="py-1 pl-3 font-semibold">
                                                            Suhu
                                                        </p>
                                                    </td>
                                                    <td class="border border-black">
                                                        <input type="text" class="w-full py-1"
                                                            value="{{ $ewsDewasa->suhu ?? '' }}" @readonly(true) />
                                                    </td>
                                                </tr>
                                                <!-- 7 -->
                                                <tr>
                                                    <td class="border border-black">
                                                        <p class="py-1 pl-3 font-semibold">
                                                            Jumlah Skor
                                                        </p>
                                                    </td>
                                                    <td class="border border-black">
                                                        <input type="text" class="w-full py-1"
                                                            value="{{ $ewsDewasa->total_skor ?? '' }}"
                                                            @readonly(true) />
                                                    </td>
                                                </tr>
                                                <!-- 8 -->
                                                <tr>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>

                            <div class="flex gap-10 mt-7 font-semibold px-2">
                                <div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>Score Penilain</td>
                                            </tr>
                                        </thead>
                                        <tbody class="text-xs">
                                            <tr>
                                                <td class="bg-green-500 text-center px-3 py-1">
                                                    Hijau (0-1)
                                                </td>
                                                <td class="px-2">: Stabil</td>
                                            </tr>
                                            <tr>
                                                <td class="bg-yellow-300 text-center px-3 py-1">
                                                    Kuning (2-3)
                                                </td>
                                                <td class="px-2">
                                                    : Resiko Ringan
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-orange-500 text-center px-3 py-1">
                                                    Orange (4-5)
                                                </td>
                                                <td class="px-2">
                                                    : Resiko Sedang
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-red-500 text-center px-3 py-1">
                                                    Merah (&ge;6)
                                                </td>
                                                <td class="px-2">: Resiko Berat</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <span>Catatan :</span>
                                    <span>Observasi dan pencatatan Early Warning
                                        System (EWS) dilakukan :</span>
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
                                            d. Jika petugas khawatir dengan
                                            perubahan kondisi pasien
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>



            </main>
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
