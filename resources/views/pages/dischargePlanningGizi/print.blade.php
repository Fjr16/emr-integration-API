<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title></title>
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
                        <img src="logo.png" alt="" />
                    </div>
                    <div class="col-span-2">
                        <h1 class="text-center uppercase">
                            Checklist Rencana Pulang
                        </h1>
                    </div>
                </div>
            </div>

            <div class="content">
                <section class="pt-5">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="font-bold uppercase border-y border-black"
                            >
                                <td
                                    colspan="2"
                                    class="border-x border-black p-1"
                                >
                                    Tata laksana gizi pasien dirumah
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-y border-black">
                                <td class="border-x border-black w-1/2 pl-10">
                                    <p class="font-bold uppercase">Diet</p>
                                    <div class="flex pl-3 gap-x-5">
                                        <input type="checkbox" {{ in_array('Anjuran Pola Makan', $item->ranapDischargePlanningNutritions->pluck('diet')->toArray()) ? 'checked' : '' }}/>
                                        <p>Anjuran Pola Makan</p>
                                    </div>
                                    <div class="flex pl-3 gap-x-5">
                                        <input type="checkbox" {{ in_array('Makanan yang perlu dihindari', $item->ranapDischargePlanningNutritions->pluck('diet')->toArray()) ? 'checked' : '' }}/>
                                        <p>Makanan Yang Perlu Dihindari</p>
                                    </div>
                                </td>
                                <td class="border-x border-black w-1/2 p-2">
                                    {{-- <textarea class="w-full h-20"></textarea> --}}
                                    {!! $item->keterangan_gizi ?? '' !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="w-full">
                        <thead class="font-bold uppercase">
                            <tr class="border-b border-black">
                                <td
                                    colspan="6"
                                    class="border-x border-black p-1"
                                >
                                    Pemberian Obat Pulang
                                </td>
                            </tr>
                            <tr class="border-b border-black">
                                <td
                                    colspan="6"
                                    class="border-x border-black text-center p-2"
                                >
                                    Daftar Nama obat - obatan
                                </td>
                            </tr>
                            <tr class="text-center">
                                <td class="border-x border-black px-3">No.</td>
                                <td class="border-x border-black w-3/12">
                                    Nama obat
                                </td>
                                <td class="border-x border-black w-1/12">
                                    Indikasi
                                </td>
                                <td class="border-x border-black w-1/12">
                                    Dosis
                                </td>
                                <td class="border-x border-black w-3/12">
                                    Waktu Pemberian
                                </td>
                                <td class="border-x border-black w-4/12">
                                    Cara Pemberian Obat
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->ranapDischargePlanningPharmacies as $farmasi)    
                                <tr>
                                    <td class="border border-black text-center">{{ $loop->iteration }}</td>
                                    <td class="border border-black text-center">{{ $farmasi->medicine->name ?? '' }}</td>
                                    <td class="border border-black text-center">{{ $farmasi->indikasi ?? '' }}</td>
                                    <td class="border border-black text-center">{{ $farmasi->dosis ?? '' }}</td>
                                    <td class="border border-black text-center">{{ date('d F Y H:i', strtotime($farmasi->waktu_pemberian)) ?? '' }}</td>
                                    <td class="border border-black text-center">{{ $farmasi->cara_pemberian ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
                <section>
                    <div
                        class="grid grid-cols-3 grid-rows-2 justify-items-center font-semibold pt-5"
                    >
                        <p class="col-span-3 justify-self-start pb-5">
                            Instruksi Rencana Pemulangan Pasien ini telah
                            dijelaskan kepada pasien dan / atau keluarga
                        </p>
                        <div>
                            <p>Telah dibaca dan dimengerti</p>
                        </div>
                        <div>
                            <p>Farmasi Klinis</p>
                        </div>
                        <div>
                            <p>Dietisien</p>
                        </div>
                        <div class="row">
                                <img src="{{ asset('storage/' . $item->ttd_wali) }}" alt="" class="img-fluid">
                        </div>
                        <div class="row">
                                <img src="{{ asset('storage/' . $item->ttd_petugas_farmasi) }}" alt="" class="img-fluid">
                        </div>
                        <div class="row">
                                <img src="{{ asset('storage/' . $item->ttd_petugas_gizi) }}" alt="" class="img-fluid">
                        </div>
                        <div class="row">
                            (<input 
                                class="text-center"
                                type="text"
                                placeholder="...................................................."
                                value="{{ $item->nm_wali ?? '' }}"
                                @readonly(true)
                            />)
                        </div>
                        <div class="row">
                            (<input 
                                class="text-center"
                                type="text"
                                placeholder="...................................................."
                                value="{{ $item->nm_petugas_farmasi ?? '' }}"
                                @readonly(true)
                            />)
                        </div>
                        <div class="row">
                            (<input 
                                class="text-center"
                                type="text"
                                placeholder="...................................................."
                                value="{{ $item->nm_petugas_gizi ?? '' }}"
                                @readonly(true)
                            />)
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
