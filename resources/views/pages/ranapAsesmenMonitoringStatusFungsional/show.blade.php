<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>ASESMEN MONITORING STATUS FUNGSIONAL (BARTHEL INDEX)</title>
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
            .content {
                font-size: 8pt;
            }
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
                    page-break-after: always;
                }
            }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="header">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-2">
                        <img src="{{asset('assets/img/logo.png')}}" alt="" />
                    </div>
                    <div class="col-span-9">
                        <h1 class="text-center uppercase mt-2">
                            ASESMEN MONITORING STATUS FUNGSIONAL (BARTHEL INDEX)
                        </h1>
                    </div>
                </div>
            </div>
            <div class="content">
                <section>
                    <table class="mt-4 w-full text-lg">
                        <thead>
                            <tr class="text-center font-semibold">
                                <td
                                    rowspan="3"
                                    class="border border-black px-2"
                                >
                                    <p>No.</p>
                                </td>
                                <td
                                    rowspan="3"
                                    class="border border-black w-4/12"
                                >
                                    <p class="italic">Kriteria Brathel Index</p>
                                </td>
                                <td
                                    rowspan="3"
                                    class="border border-black px-2"
                                >
                                    <p>Dengan Bantuan</p>
                                </td>
                                <td
                                    rowspan="3"
                                    class="border border-black px-2"
                                >
                                    <p>Mandiri</p>
                                </td>
                                <td colspan="{{count($mainTb) + 2}}" class="border border-black">
                                    <p>Nilai Skor</p>
                                </td>
                            </tr>
                            <tr class="font-semibold text-center">
                                <td colspan="{{count($mainTb)}}" class="border border-black w-7/12">
                                    <p>Selama Perawatan (Tanggal)</p>
                                </td>
                                <td
                                    rowspan="2"
                                    class="border border-black px-5"
                                >
                                    <p>Saat Pulang</p>
                                </td>
                            </tr>
                            <tr class="font-semibold text-center">
                                @foreach ($mainTb as $data)
                                    @php
                                        $formatId = Carbon\Carbon::parse($data->tanggal);
                                    @endphp
                                    <td class="border border-black w-16">
                                        <div>{{$formatId->isoformat('D MMM Y')}}</div>
                                    </td>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 1 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center font-semibold">1</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="px-1">Makan</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">5</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">10</p>
                                </td>
                                @foreach ($mainTb as $data)
                                    @php
                                        $makan = $data->ranapAsesMoniStatusFungsionalDetails->where('name', 'MAKAN')->first();
                                    @endphp
                                    <td class="border border-black w-16 text-center">{{$makan->skor}}</td>
                                @endforeach
                                @php
                                    $isMakan = $isPulang->ranapAsesMoniStatusFungsionalDetails->where('name', 'MAKAN')->first();
                                @endphp
                                <td class="border border-black w-16 text-center">{{$isMakan->skor}}</td>
                            </tr>
                            <!-- 2 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center font-semibold">2</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="px-1">
                                        Toilet (Aktivitas BAB & BAK)
                                    </p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">5</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">10</p>
                                </td>
                                @foreach ($mainTb as $data)
                                    @php
                                        $makan = $data->ranapAsesMoniStatusFungsionalDetails->where('name', 'TOILET (AKTIVITAS BAB & BAK)')->first();
                                    @endphp
                                    <td class="border border-black w-16 text-center">{{$makan->skor}}</td>
                                @endforeach
                                @php
                                    $isMakan = $isPulang->ranapAsesMoniStatusFungsionalDetails->where('name', 'TOILET (AKTIVITAS BAB & BAK)')->first();
                                @endphp
                                <td class="border border-black w-16 text-center">{{$isMakan->skor}}</td>
                            </tr>
                            <!-- 3 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center font-semibold">3</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="px-1">
                                        Berpindah dari kursi roda ke tempat
                                        tidur/sebaliknya
                                    </p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">5 - 10</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">15</p>
                                </td>
                                @foreach ($mainTb as $data)
                                    @php
                                        $makan = $data->ranapAsesMoniStatusFungsionalDetails->where('name', 'BERPINDAH DARI KURSI RODA KE TEMPAT TIDUR/SEBALIKNYA')->first();
                                    @endphp
                                    <td class="border border-black w-16 text-center">{{$makan->skor}}</td>
                                @endforeach
                                @php
                                    $isMakan = $isPulang->ranapAsesMoniStatusFungsionalDetails->where('name', 'BERPINDAH DARI KURSI RODA KE TEMPAT TIDUR/SEBALIKNYA')->first();
                                @endphp
                                <td class="border border-black w-16 text-center">{{$isMakan->skor}}</td>
                            </tr>
                            <!-- 4 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center font-semibold">4</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="px-1">
                                        Kebersihan diri, mencuci muka, menyisir
                                        rambut, menggosok gigi
                                    </p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">5</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">10</p>
                                </td>
                                @foreach ($mainTb as $data)
                                    @php
                                        $makan = $data->ranapAsesMoniStatusFungsionalDetails->where('name', 'KEBERSIHAN DIRI, MENCUCI MUKA, MENYISIR RAMBUT, MENGGOSOK GIGI')->first();
                                    @endphp
                                    <td class="border border-black w-16 text-center">{{$makan->skor}}</td>
                                @endforeach
                                @php
                                    $isMakan = $isPulang->ranapAsesMoniStatusFungsionalDetails->where('name', 'KEBERSIHAN DIRI, MENCUCI MUKA, MENYISIR RAMBUT, MENGGOSOK GIGI')->first();
                                @endphp
                                <td class="border border-black w-16 text-center">{{$isMakan->skor}}</td>
                            </tr>
                            <!-- 5 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center font-semibold">5</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="px-1">Mandi</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">5</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">10</p>
                                </td>
                                @foreach ($mainTb as $data)
                                    @php
                                        $makan = $data->ranapAsesMoniStatusFungsionalDetails->where('name', 'MANDI')->first();
                                    @endphp
                                    <td class="border border-black w-16 text-center">{{$makan->skor}}</td>
                                @endforeach
                                @php
                                    $isMakan = $isPulang->ranapAsesMoniStatusFungsionalDetails->where('name', 'MANDI')->first();
                                @endphp
                                <td class="border border-black w-16 text-center">{{$isMakan->skor}}</td>
                            </tr>
                            <!-- 6 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center font-semibold">6</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="px-1">
                                        Berjalan di permukaan datar
                                    </p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">5 - 10</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">15</p>
                                </td>
                                @foreach ($mainTb as $data)
                                    @php
                                        $makan = $data->ranapAsesMoniStatusFungsionalDetails->where('name', 'BERJALAN DI PERMUKAAN DATAR')->first();
                                    @endphp
                                    <td class="border border-black w-16 text-center">{{$makan->skor}}</td>
                                @endforeach
                                @php
                                    $isMakan = $isPulang->ranapAsesMoniStatusFungsionalDetails->where('name', 'BERJALAN DI PERMUKAAN DATAR')->first();
                                @endphp
                                <td class="border border-black w-16 text-center">{{$isMakan->skor}}</td>
                            </tr>
                            <!-- 7 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center font-semibold">7</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="px-1">Naik turun tangga</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">5</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">10</p>
                                </td>
                                @foreach ($mainTb as $data)
                                    @php
                                        $makan = $data->ranapAsesMoniStatusFungsionalDetails->where('name', 'NAIK TURUN TANGGA')->first();
                                    @endphp
                                    <td class="border border-black w-16 text-center">{{$makan->skor}}</td>
                                @endforeach
                                @php
                                    $isMakan = $isPulang->ranapAsesMoniStatusFungsionalDetails->where('name', 'NAIK TURUN TANGGA')->first();
                                @endphp
                                <td class="border border-black w-16 text-center">{{$isMakan->skor}}</td>
                            </tr>
                            <!-- 8 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center font-semibold">8</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="px-1">Berpakaian</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">5</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">10</p>
                                </td>
                                @foreach ($mainTb as $data)
                                    @php
                                        $makan = $data->ranapAsesMoniStatusFungsionalDetails->where('name', 'BERPAKAIAN')->first();
                                    @endphp
                                    <td class="border border-black w-16 text-center">{{$makan->skor}}</td>
                                @endforeach
                                @php
                                    $isMakan = $isPulang->ranapAsesMoniStatusFungsionalDetails->where('name', 'BERPAKAIAN')->first();
                                @endphp
                                <td class="border border-black w-16 text-center">{{$isMakan->skor}}</td>
                            </tr>
                            <!-- 9 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center font-semibold">9</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="px-1">Mengontrol defekasi/BAB</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">5</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">10</p>
                                </td>
                                @foreach ($mainTb as $data)
                                    @php
                                        $makan = $data->ranapAsesMoniStatusFungsionalDetails->where('name', 'MENGONTROL DEFEKASI/BAB')->first();
                                    @endphp
                                    <td class="border border-black w-16 text-center">{{$makan->skor}}</td>
                                @endforeach
                                @php
                                    $isMakan = $isPulang->ranapAsesMoniStatusFungsionalDetails->where('name', 'MENGONTROL DEFEKASI/BAB')->first();
                                @endphp
                                <td class="border border-black w-16 text-center">{{$isMakan->skor}}</td>
                            </tr>
                            <!-- 10 -->
                            <tr>
                                <td class="border border-black">
                                    <p class="text-center font-semibold">10</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="px-1">Mengontrol berkemih/BAK</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">5</p>
                                </td>
                                <td class="border border-black font-semibold">
                                    <p class="text-center">10</p>
                                </td>
                                @foreach ($mainTb as $data)
                                    @php
                                        $makan = $data->ranapAsesMoniStatusFungsionalDetails->where('name', 'MENGONTROL BERKEMIH/BAK')->first();
                                    @endphp
                                    <td class="border border-black w-16 text-center">{{$makan->skor}}</td>
                                @endforeach
                                @php
                                    $isMakan = $isPulang->ranapAsesMoniStatusFungsionalDetails->where('name', 'MENGONTROL BERKEMIH/BAK')->first();
                                @endphp
                                <td class="border border-black w-16 text-center">{{$isMakan->skor}}</td>
                            </tr>
                            <!-- total skor -->
                            <tr>
                                <td
                                    colspan="4"
                                    class="border border-black font-bold"
                                >
                                    <p class="px-2 py-1">Total Skor</p>
                                </td>
                                @foreach ($mainTb as $data)
                                    <td class="border border-black w-16 text-center">{{$data->total_skor}}</td>
                                @endforeach
                                <td class="border border-black w-16 text-center">{{$isPulang->total_skor}}</td>
                            </tr>
                            <!-- kategori skor -->
                            <tr>
                                <td
                                    colspan="4"
                                    class="border border-black font-bold"
                                >
                                    <p class="px-2 py-1">Kategori Skor</p>
                                </td>
                                @foreach ($mainTb as $data)
                                    <td class="border border-black w-16 text-center">{{$data->kategori_skor}}</td>
                                @endforeach
                                <td class="border border-black w-16 text-center">{{$isPulang->kategori_skor}}</td>
                            </tr>
                            <!-- inisial -->
                            <tr>
                                <td
                                    colspan="4"
                                    class="border border-black font-bold"
                                >
                                    <p class="px-2 py-1">
                                        Inisial nama perawat yang mengkaji
                                    </p>
                                </td>
                                @foreach ($mainTb as $data)
                                    <td class="border border-black w-16 text-center">{{$data->user->name}}</td>
                                @endforeach
                                <td class="border border-black w-16 text-center">{{$isPulang->user->name}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex p-3 gap-80">
                        <div>
                            <p class="font-bold italic">Catatan :</p>
                            <p class="font-semibold">
                                1. Asesmen Monitoring status fungsional <br />
                                <span class="pl-4"
                                    >dilaksanakan setiap hari (Shift Pagi / SP)
                                    dan</span
                                ><br />
                                <span class="pl-4"
                                    >situasional pada saat :
                                </span>
                            </p>
                            <ul class="pl-8 font-semibold">
                                <li>&middot; Awal Masuk (A)</li>
                                <li>&middot; Perubahan Kondisi (PK)</li>
                            </ul>
                            <p class="font-semibold">
                                2. Total Skor &ge; 6 direkomendasikan dengan
                                DPJP untuk konsul ke Rehabilitasi Medik
                            </p>
                        </div>
                        <div class="grid grid-cols-3">
                            <p class="col-span-3 font-bold pb-3">
                                Kategori Skor
                            </p>
                            <p>Mandiri</p>
                            <p class="justify-self-end pr-5">(M)</p>
                            <p>100</p>
                            <p>Ketergantungan Ringan</p>
                            <p class="justify-self-end pr-5">(KR)</p>
                            <p>91-99</p>
                            <p>Ketergantungan Sedang</p>
                            <p class="justify-self-end pr-5">(KS)</p>
                            <p>62-90</p>
                            <p>Ketergantungan Berat</p>
                            <p class="justify-self-end pr-5">(KB)</p>
                            <p>21-61</p>
                            <p>Ketergantungan Total</p>
                            <p class="justify-self-end pr-5">(KT)</p>
                            <p>0-20</p>
                            <p class="col-span-3 justify-self-start">
                                (Bila Ketergantungan Total, kolaborasi dengan
                                DPJP)
                            </p>
                        </div>
                    </div>
                </section>
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
