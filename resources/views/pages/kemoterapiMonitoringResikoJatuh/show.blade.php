<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>ASESMEN DAN MONITORING RISIKO JATUH</title>
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
                        <img src="{{asset('assets/img/logo.png')}}" alt="" />
                    </div>
                    <div class="col-span-2">
                        <h1 class="text-center uppercase mt-2">
                            ASESMEN DAN MONITORING RISIKO JATUH
                        </h1>
                    </div>
                </div>
            </div>
            <div class="content">
                @if ($usia > 12 && $usia <= 65)
                    <!-- table kiri -->
                    <section class="border border-black h-fit mt-4">
                        <div class="p-2">
                            <p class="text-center font-bold uppercase">
                                Asesmen risiko jatuh morse fall scale <br />
                                pada pasien dewasa usia > 12 sampai usia 65 tahun
                            </p>
                            <p>Keterangan :</p>
                            <div class="grid grid-cols-2 gap-x-2 w-fit">
                                <p>1. Risiko Rendah</p>
                                <p>: 0 - 24</p>
                                <p class="col-start-1">2. Risiko Sedang</p>
                                <p>: 25 - 44</p>
                                <p class="col-start-1">3. Risiko Tinggi</p>
                                <p>: &ge; 44</p>
                            </div>
                        </div>
                        <table border="1" class="table-auto w-full">
                            <thead>
                                <tr class="border-y border-black">
                                    <th
                                        rowspan="3"
                                        class="border-r border-black uppercase w-3/12"
                                    >
                                        Faktor Risiko
                                    </th>
                                    <th
                                        rowspan="3"
                                        class="border-x border-black uppercase w-5/12"
                                    >
                                        Skala
                                    </th>
                                    <div class="w-4/12">
                                        <td class="border-x border-black">Tgl</td>
                                        @php
                                            $formatId = Carbon\Carbon::parse($monitoring->tanggal);
                                        @endphp
                                        <td class="border-black">{{$formatId->isoformat('D MMM Y')}}</td>
                                    </div>
                                </tr>
                                <tr>
                                    <td class="border-x border-black">*</td>
                                    <td class="border-black"></td>
                                </tr>
                                <tr class="border-y border-black">
                                    <td
                                        class="text-xs text-center border-x border-black"
                                    >
                                        SKOR
                                    </td>
                                    <td class="text-xs text-center border-black">
                                        SKOR
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- riwayat jatuh -->
                                @foreach ($data as $index => $item)
                                    @php
                                        $detail = $details[$index];
                                    @endphp
                                    <tr class="border-t border-black">
                                        <td
                                            class="border-r border-black align-top font-semibold"
                                        >
                                            <p class="p-1">{{$item['faktor_resiko']}}</p>
                                        </td>
                                        <td
                                            class="border-x border-black font-semibold align-top"
                                        >
                                            @foreach ($item['skala'] as $skala)
                                                <p class="font-semibold">{{$skala}}</p>
                                            @endforeach
                                        </td>
                                        <td
                                            class="border-x border-black font-semibold text-center align-top"
                                        >
                                            @foreach ($item['skor'] as $skor)
                                                <p class="font-semibold">{{$skor}}</p>
                                            @endforeach
                                        </td>
                                        <td class="border-black text-center">{{$detail->skor}}</td>
                                    </tr>
                                @endforeach

                                <!-- total skor -->
                                <tr class="border-y border-black">
                                    <td
                                        colspan="3"
                                        class="uppercase font-bold px-1"
                                    >
                                        Total Skor
                                    </td>
                                    <td class="border-black border-l px-2">{{$monitoring->total_skor}}</td>
                                </tr>
                                <!-- nilai skor -->
                                <tr class="border-y border-black">
                                    <td colspan="3" class="font-bold px-1">
                                        Nilai Skor (RR/RS/RT)
                                    </td>
                                    <td class="border-black border-l px-2">{{$monitoring->nilai_skor}}</td>
                                </tr>
                                <!-- nama perawat -->
                                <tr class="border-y border-black">
                                    <td colspan="3" class="font-bold px-1">
                                        Nama Perawat (Inisial)
                                    </td>
                                    <td class="border-black border-x px-2">{{$monitoring->user->name}}</td>
                                </tr>
                                <!-- paraf -->
                                <tr class="border-t border-black">
                                    <td colspan="3" class="font-bold">Paraf</td>
                                    <td class="border-black border-x px-2"><img src="{{Storage::url($monitoring->user->paraf)}}" alt="" width="100px"></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                @elseif ($usia > 65)
                    <!-- table tengah -->
                    <section class="border border-black h-fit mt-4">
                        <div class="p-2">
                            <p class="text-center font-bold uppercase">
                                Asesmen risiko jatuh hendrich scale <br />
                                pada pasien usia > 65 tahun
                            </p>
                            <p class="italic font-semibold">Keterangan :</p>
                            <div
                                class="grid grid-cols-2 font-semibold gap-x-2 w-fit"
                            >
                                <p>1. Risiko Rendah</p>
                                <p>: 0 - 7</p>
                                <p class="col-start-1">2. Risiko Sedang</p>
                                <p>: 8 - 13</p>
                                <p class="col-start-1">3. Risiko Tinggi</p>
                                <p>: &ge; 14</p>
                            </div>
                        </div>
                        <table border="1" class="table-auto w-full">
                            <thead>
                                <tr class="border-y border-black w-full">
                                    <th
                                        rowspan="3"
                                        class="border-r border-black uppercase w-6/12"
                                    >
                                        Faktor Risiko
                                    </th>
                                    <th
                                        rowspan="3"
                                        class="border-x border-black uppercase w-2/12"
                                    >
                                        Skala
                                    </th>
                                    <div class="w-4/12">
                                        <td class="border-x border-black">Tgl</td>
                                        @php
                                            $formatId = Carbon\Carbon::parse($monitoring->tanggal);
                                        @endphp
                                        <td class="border-l border-black">{{$formatId->isoformat('D MMM Y')}}</td>
                                    </div>
                                </tr>
                                <tr>
                                    <td class="border-x border-black">*</td>
                                    <td class="border-l border-black"></td>
                                </tr>
                                <tr class="border-y border-black text-center">
                                    <td class="text-xs border-x border-black">
                                        SKOR
                                    </td>
                                    <td class="text-xs border-l border-black">
                                        SKOR
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                    @php
                                        $detail = $details[$index];
                                    @endphp
                                    <tr class="border-t border-black">
                                        <td
                                            class="border-r border-black text-sm font-semibold align-top"
                                        >
                                            <p class="p-1">
                                                {{$item['faktor_resiko']}}
                                            </p>
                                        </td>
                                        <td
                                            class="border-x border-black font-semibold align-top"
                                        >
                                            @foreach ($item['skala'] as $skala)
                                                <p class="font-semibold">{{$skala}}</p>
                                            @endforeach
                                        </td>
                                        <td
                                            class="border-x border-black font-semibold text-center align-top"
                                        >
                                            @foreach ($item['skor'] as $skor)
                                                <p class="font-semibold">{{$skor}}</p>
                                            @endforeach
                                        </td>
                                        <td class="border-l border-black text-center">{{$detail->skor}}</td>
                                    </tr>
                                @endforeach

                                <!-- total skor -->
                                <tr class="border-y border-black">
                                    <td
                                        colspan="3"
                                        class="uppercase font-bold px-1"
                                    >
                                        Total Skor
                                    </td>
                                    <td class="border-l border-black px-2">{{$monitoring->total_skor}}</td>
                                </tr>
                                <!-- nilai skor -->
                                <tr class="border-y border-black">
                                    <td colspan="3" class="font-bold px-1">
                                        Nilai Skor (RR/RS/RT)
                                    </td>
                                    <td class="border-l border-black px-2">{{$monitoring->nilai_skor}}</td>
                                </tr>
                                <!-- nama perawat -->
                                <tr class="border-y border-black">
                                    <td colspan="3" class="font-bold px-1">
                                        Nama Perawat (Inisial)
                                    </td>
                                    <td class="border-l border-black px-2">{{$monitoring->user->name}}</td>
                                </tr>
                                <!-- paraf -->
                                <tr class="border-t border-black">
                                    <td colspan="3" class="font-bold">Paraf</td>
                                    <td class="border-l border-black px-2"><img src="{{Storage::url($monitoring->user->paraf)}}" alt="" width="100px"></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                @elseif ($usia <= 12)
                    <!-- table kanan -->
                    <section class="border border-black h-fit mt-4">
                        <div class="p-2">
                            <p class="text-center font-bold uppercase">
                                Asesmen risiko jatuh humpty dumpty scale <br />
                                pada pasien usia &le; 12 tahun
                            </p>
                            <p class="italic font-semibold">Keterangan :</p>
                            <div class="grid grid-cols-2 font-semibold w-fit">
                                <p class="col-span-2">
                                    1. Skor minimum 7, maksimum 23
                                </p>
                                <p class="col-start-1">2. Skor 7-11</p>
                                <p>: Risiko Rendah</p>
                                <p class="col-start-1">3. Skor > 12</p>
                                <p>: Risiko Tinggi</p>
                            </div>
                        </div>
                        <table border="1" class="table-auto w-full">
                            <thead>
                                <tr class="border-y border-black text">
                                    <th
                                        rowspan="3"
                                        class="border-r border-black uppercase w-3/12"
                                    >
                                        Parameter
                                    </th>
                                    <th
                                        rowspan="3"
                                        class="border-x border-black uppercase w-6/12"
                                    >
                                        Kriteria
                                    </th>
                                    <th
                                        rowspan="3"
                                        class="border-x border-black uppercase w-1/12"
                                    >
                                        Skala
                                    </th>
                                    <div class="w-4/12">
                                        @php
                                            $formatId = Carbon\Carbon::parse($monitoring->tanggal);
                                        @endphp
                                        <td class="border-l border-black">Tgl : {{$formatId->isoformat('D MMM Y')}}</td>
                                    </div>
                                </tr>
                                <tr>
                                    <td class="border-l border-black">*</td>
                                    </td>

                                    </td>
                                </tr>
                                <tr class="border-t border-black text-center">
                                    <td class="text-xs border-l border-black">
                                        SKOR
                                    </td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $item)
                                    @php
                                        $detail = $details[$index];
                                    @endphp
                                    <tr class="border-t border-black">
                                        <td
                                            class="border-r border-black text-sm font-semibold align-top"
                                        >
                                            <p class="p-1">{{$item['faktor_resiko']}}</p>
                                        </td>
                                        <td
                                            class="border-x border-black font-semibold px-2"
                                        >
                                            <div class="flex-row">
                                                @foreach ($item['skala'] as $skala)
                                                    <p class="font-semibold">{{$skala}}</p>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td
                                            class="border-x border-black font-semibold text-center"
                                        >
                                            @foreach ($item['skor'] as $skor)
                                                <p class="font-semibold">{{$skor}}</p>
                                            @endforeach
                                        </td>
                                        <td class="border-l border-black text-center">{{$detail->skor}}</td>
                                    </tr>
                                @endforeach

                                <!-- total skor -->
                                <tr class="border-y border-black">
                                    <td
                                        colspan="3"
                                        class="uppercase font-bold px-1"
                                    >
                                        Total Skor
                                    </td>
                                    <td class="border-l border-black px-2">{{$monitoring->total_skor}}</td>

                                </tr>
                                <!-- nilai skor -->
                                <tr class="border-y border-black">
                                    <td colspan="3" class="font-bold px-1">
                                        Nilai Skor (RR/RS/RT)
                                    </td>
                                    <td class="border-l border-black px-2">{{$monitoring->nilai_skor}}</td>

                                </tr>
                                <!-- nama perawat -->
                                <tr class="border-y border-black">
                                    <td colspan="3" class="font-bold px-1">
                                        Nama Perawat (Inisial)
                                    </td>
                                    <td class="border-l border-black px-2">{{$monitoring->user->name}}</td>

                                </tr>
                                <!-- paraf -->
                                <tr class="border-t border-black">
                                    <td colspan="3" class="font-bold">Paraf</td>
                                    <td class="border-l border-black px-2"><img src="{{Storage::url($monitoring->user->paraf)}}" alt="" width="100px"></td>

                                </tr>
                            </tbody>
                        </table>
                    </section>
                @endif
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
