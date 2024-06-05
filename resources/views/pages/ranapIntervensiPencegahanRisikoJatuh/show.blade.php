<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>INTERVENSI PENCEGAHAN RISIKO JATUH</title>
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
                width: 330mm;
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

            tr th {
                font-size: 8pt;
            }
            tr td {
                font-size: 9pt;
            }
            /* td {
                padding-top: 5px;
            } */
            th {
                font-size: 10pt !important;
            }
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
                    /* page-break-after: always; */
                }
            }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="header">
                <div class="grid grid-cols-4 gap-4">
                    <div class="...">
                        <img src="logo.png" alt="" />
                    </div>
                    <div class="col-span-2">
                        <h1 class="text-center uppercase mt-2">
                            INTERVENSI PENCEGAHAN RISIKO JATUH
                        </h1>
                    </div>
                </div>
            </div>
            <div class="content">
                <section>

                    <table class="mt-4 w-full">
                        <thead>
                            <tr>
                                <td colspan="2" class="border border-black font-bold text-center uppercase w-1/2">intervensi
                                    pencegahan
                                    risiko jatuh</td>
                                <td  class="border border-black font-bold text-center uppercase w-1/2">tanggal dan
                                    jam</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $formatId = Carbon\Carbon::parse($item->tanggal);
                            @endphp
                            <tr>
                                <td rowspan="2" colspan="2" class="border border-black font-bold">
                                    <p class="px-2">Beri tanda (&check;) pada tindakan yang dilakukan</p>
                                </td>
                                <td class="border border-black ps-2">{{$formatId->isoformat('D MMM Y')}}</td>

                            </tr>
                            <tr>
                                <td class="border border-black ps-2">{{$formatId->format('H:i')}}</td>

                            </tr>
                            <!-- RR -->
                            <tr>
                                <td class="border border-black font-bold w-24"></td>
                                <td class="border border-black font-bold">Intervensi risiko jatuh rendah (RR)</td>

                                <td class="border border-black"></td>

                            </tr>
                            <!-- 1 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">1</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Ruangan rapi, pencahayaan yang cukup, jauhkan kabel dari jalur berjalan pasien dan
                                        keluarga</p>
                                </td>
                                    @php
                                        $detailRR = $details->where('tindakan', 'Ruangan rapi, pencahayaan yang cukup, jauhkan kabel dari jalur berjalan pasien dan keluarga')->first();
                                    @endphp
                                    @if ($detailRR)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 2 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">2</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Lakukan orientasi terhadap lingkungan dan rutinitas RS:</p>
                                </td>
                                    @php
                                        $detailRR = $details->where('tindakan', 'Lakukan orientasi terhadap lingkungan dan rutinitas RS:')->first();
                                    @endphp
                                    @if ($detailRR)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 2.a -->
                            <tr>
                                <td class="border border-black"></td>
                                <td class="border border-black font-semibold">
                                    <p>a. Orientasikan tempat menghidupkan lampu</p>
                                </td>
                                    @php
                                        $detailRR = $details->where('tindakan', 'Orientasikan tempat menghidupkan lampu')->first();
                                    @endphp
                                    @if ($detailRR)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 2.b -->
                            <tr>
                                <td class="border border-black"></td>
                                <td class="border border-black font-semibold">
                                    <p>b. Orientasikan tempat bel dan cara penggunaannnya di kamar dan di kamar mandi</p>
                                </td>
                                    @php
                                        $detailRR = $details->where('tindakan', 'Orientasikan tempat bel dan cara penggunaannnya di kamar dan di kamar mandi')->first();
                                    @endphp
                                    @if ($detailRR)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 2.c -->
                            <tr>
                                <td class="border border-black"></td>
                                <td class="border border-black font-semibold">
                                    <p>c. Orientasikan lokasi kamar mandi dan lantai kamar mandi tidak plicin</p>
                                </td>
                                    @php
                                        $detailRR = $details->where('tindakan', 'Orientasikan lokasi kamar mandi dan lantai kamar mandi tidak plicin')->first();
                                    @endphp
                                    @if ($detailRR)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 2.d -->
                            <tr>
                                <td class="border border-black"></td>
                                <td class="border border-black font-semibold">
                                    <p>d. Memberitahukan waktu pembersihan kamar dan rutinitas pekerjaan</p>
                                </td>
                                    @php
                                        $detailRR = $details->where('tindakan', 'Memberitahukan waktu pembersihan kamar dan rutinitas pekerjaan')->first();
                                    @endphp
                                    @if ($detailRR)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 3 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">3</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Pastikan tempat tidur dalam keadaan rendah dan roda terkunci</p>
                                </td>
                                    @php
                                        $detailRR = $details->where('tindakan', 'Pastikan tempat tidur dalam keadaan rendah dan roda terkunci Kedua pagar pengaman tempat tidur terpasang dengan baik')->first();
                                    @endphp
                                    @if ($detailRR)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 4 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">4</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Kedua pagar pengaman tempat tidur terpasang dengan baik</p>
                                </td>
                                    @php
                                        $detailRR = $details->where('tindakan', 'Kedua pagar pengaman tempat tidur terpasang dengan baik')->first();
                                    @endphp
                                    @if ($detailRR)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 5 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">5</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Barang pribadi dalam jangkauan ( handphone, air minum, kacamata, alat bantu )</p>
                                </td>
                                    @php
                                        $detailRR = $details->where('tindakan', 'Barang pribadi dalam jangkauan (handphone, air minum, kacamata, alat bantu)')->first();
                                    @endphp
                                    @if ($detailRR)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 6 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">6</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Edukasi pasien dan keluarga untuk turun dari tempat tidur secara bertahap</p>
                                </td>
                                    @php
                                        $detailRR = $details->where('tindakan', 'Edukasi pasien dan keluarga untuk turun dari tempat tidur secara bertahap')->first();
                                    @endphp
                                    @if ($detailRR)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 7 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">7</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Anjurkan pasien tidak memakai sandal/sepatu/kaos kaki yang licin</p>
                                </td>
                                    @php
                                        $detailRR = $details->where('tindakan', 'Anjurkan pasien tidak memakai sandal/sepatu/kaos kaki yang licin')->first();
                                    @endphp
                                    @if ($detailRR)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 8 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">8</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Edukasi pasien dan keluarga mengenai pencegahan risiko jatuh</p>
                                </td>
                                    @php
                                        $detailRR = $details->where('tindakan', 'Edukasi pasien dan keluarga mengenai pencegahan risiko jatuh')->first();
                                    @endphp
                                    @if ($detailRR)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 9 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">9</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Informasikan pasien dan keluarga jika membutuhkan perawat</p>
                                </td>
                                    @php
                                        $detailRR = $details->where('tindakan', 'Informasikan pasien dan keluarga jika membutuhkan perawat')->first();
                                    @endphp
                                    @if ($detailRR)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>

                            <!-- RS -->
                            <tr>
                                <td class="border border-black"></td>
                                <td class="border border-black font-bold">
                                    <p>Intervensi risiko jatuh sedang (RS)</p>
                                </td>
                                <td class="border border-black"></td>
                            </tr>
                            <!-- 1 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">1</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Lakukan semua intervensi risiko jatuh rendah</p>
                                </td>
                                    @php
                                        $detailRS = $details->where('tindakan', 'Lakukan semua intervensi risiko jatuh rendah')->first();
                                    @endphp
                                    @if ($detailRS)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 2 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">2</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Pintu tidak dalam keadaan terkunci</p>
                                </td>
                                    @php
                                        $detailRS = $details->where('tindakan', 'Pintu tidak dalam keadaan terkunci')->first();
                                    @endphp
                                    @if ($detailRS)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 3 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">3</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Edukasi pasien/keluarga untuk mendampingi pasian dalam mobilisasi</p>
                                </td>
                                    @php
                                        $detailRS = $details->where('tindakan', 'Edukasi pasien/keluarga untuk mendampingi pasien dalam mobilisasi')->first();
                                    @endphp
                                    @if ($detailRS)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 4 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">4</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Informasikan pasien menggunakan handrail</p>
                                </td>
                                    @php
                                        $detailRS = $details->where('tindakan', 'Informasikan pasien menggunakan handrail')->first();
                                    @endphp
                                    @if ($detailRS)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 5 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">5</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Gunakan alat bantu jalan (walker/tongkat/kursi/roda)</p>
                                </td>
                                    @php
                                        $detailRS = $details->where('tindakan', 'Gunakan alat bantu jalan (walker/tongkat/kursi/roda)')->first();
                                    @endphp
                                    @if ($detailRS)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 6 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">6</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Optimalisasi penggunaan kacamata dan alat bantu dengar (jika perlu)</p>
                                </td>
                                    @php
                                        $detailRS = $details->where('tindakan', 'Optimalisasi penggunaan kacamata dan alat bantu dengar(jika perlu)')->first();
                                    @endphp
                                    @if ($detailRS)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 7 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">7</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Pantau jika pasien mengeluhkan pusing/vertigo dan ajari bangun dari tempat tidur secara
                                        perlahan</p>
                                </td>
                                    @php
                                        $detailRS = $details->where('tindakan', 'Pantau jika pasien mengeluhkan pusing/vertigo dan ajari bangun dari tempat tidur secara perlahan')->first();
                                    @endphp
                                    @if ($detailRS)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 8 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">8</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Pantau obat - obatan yang meningkatkan predisposisi resiki jatuh</p>
                                </td>
                                    @php
                                        $detailRS = $details->where('tindakan', 'Pantau obat-obatan yang meningkatkan predisposisi risiko jatuh')->first();
                                    @endphp
                                    @if ($detailRS)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 9 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">9</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Libatkan keluarga dan bantu pasien jika diperlukan</p>
                                </td>
                                    @php
                                        $detailRS = $details->where('tindakan', 'Libatkan keluarga dan bantu pasien jika diperlukan')->first();
                                    @endphp
                                    @if ($detailRS)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 10 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">10</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Pertisipasi keluarga dalam keselamatan pasien</p>
                                </td>
                                    @php
                                        $detailRS = $details->where('tindakan', 'Partisipasi keluarga dalam keselamatan pasien')->first();
                                    @endphp
                                    @if ($detailRS)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>

                            <!-- RT -->
                            <tr>
                                <td class="border border-black"></td>
                                <td class="border border-black font-bold">
                                    <p>Intervensi risiko jatuh tinggi (RT)</p>
                                </td>
                                <td class="border border-black"></td>

                            </tr>
                            <!-- 1 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">1</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Lakukan semua intervensi risiko jatuh (risiko jatuh rendah / risiko jatuh sedang / risiko
                                        jatuh tinggi)</p>
                                </td>
                                    @php
                                        $detailRT = $details->where('tindakan', 'Lakukan semua intervensi risiko jatuh (risiko jatuh rendah / risiko jatuh sedang / risiko jatuh tinggi)')->first();
                                    @endphp
                                    @if ($detailRT)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 2 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">2</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Pasang penanda risiko jatuh dengan menjepitkan kancing warna kuning pada gelang identitas
                                    </p>
                                </td>
                                    @php
                                        $detailRT = $details->where('tindakan', 'Pasang penanda risiko jatuh dengan menjepitkan kancing warna kuning pada gelang identitas')->first();
                                    @endphp
                                    @if ($detailRT)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 3 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">3</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Pasang segitiga kuning pada tempat tidur pasien </p>
                                </td>
                                    @php
                                        $detailRT = $details->where('tindakan', 'Pasang segitiga kuning pada tempat tidur pasien')->first();
                                    @endphp
                                    @if ($detailRT)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 4 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">4</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Komunikasikan pasien riisko jatuh tinggi pada setiap pergantian shift</p>
                                </td>
                                    @php
                                        $detailRT = $details->where('tindakan', 'Komunikasikan pasien risiko jatuh tinggi pada setiap pergantian shift')->first();
                                    @endphp
                                    @if ($detailRT)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 5 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">5</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Tawarkan pasien menggunakan pispot/urinal untuk eliminasi/defekasi</p>
                                </td>
                                    @php
                                        $detailRT = $details->where('tindakan', 'Tawarkan pasien menggunakan pispot/urinal untuk eliminasi/defekasi')->first();
                                    @endphp
                                    @if ($detailRT)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 6 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">6</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Jangan tinggalkan pasien sendiri dikamar</p>
                                </td>
                                    @php
                                        $detailRT = $details->where('tindakan', 'Jangan tinggalkan pasien sendiri dikamar')->first();
                                    @endphp
                                    @if ($detailRT)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 7 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">7</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Informasikan pasien/keluarga untuk tidak mengunci pintu kamar dan pintu kamar mandi dan
                                        gunakan tempat duduk saat mandi</p>
                                </td>
                                    @php
                                        $detailRT = $details->where('tindakan', 'Informasikan pasien/keluarga untuk tidak mengunci pintu kamar dan pintu kamar mandi dan gunakan tempat duduk saat mandi')->first();
                                    @endphp
                                    @if ($detailRT)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 8 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">8</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Monitor pasien setiap 4 jam</p>
                                </td>
                                    @php
                                        $detailRT = $details->where('tindakan', 'Monitor pasien setiap 4 jam')->first();
                                    @endphp
                                    @if ($detailRT)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- 9 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center">9</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p>Edukasi pasien / keluarga tentang efek samping obat</p>
                                </td>
                                    @php
                                        $detailRT = $details->where('tindakan', 'Edukasi pasien /keluarga tentang efek samping obat')->first();
                                    @endphp
                                    @if ($detailRT)
                                        <td class="border border-black text-center">&check;</td>
                                    @else
                                        <td class="border border-black"></td>
                                    @endif
                            </tr>
                            <!-- paraf -->
                            <tr>
                                <td class="border border-black"></td>
                                <td class="border border-black text-md font-bold">
                                    <p class="py-2">Paraf dan Nama Perawat (Inisial)</p>
                                </td>
                                <td class="border border-black ps-2 d-flex"><img src="{{Storage::url($item->user->paraf)}}" alt="" width="100px">{{$item->user->name ?? '............'}}</td>

                            </tr>
                        </tbody>
                    </table>

                </section>
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
