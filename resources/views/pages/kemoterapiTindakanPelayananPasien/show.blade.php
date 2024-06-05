<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pelayanan Tindakan Pasien Kemoterapi</title>
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
                        REKAPITULASI TINDAKAN PELAYANAN PASIEN
                    </h1>
                </div>
            </div>
        </div>
        <div class="content">
            <section class="mt-9">
                <div class="grid grid-cols-2 gap-x-4 w-fit pb-3">
                    <p class="font-semibold text-sm">Tanggal Masuk/Jam</p>
                    <p class="font-semibold text-sm">
                        : {{$item->tanggal_masuk}}
                    </p>
                    <p class="font-semibold text-sm mt-2">Tanggal Keluar/Jam</p>
                    <p class="font-semibold text-sm mt-2">
                        : {{$item->tanggal_keluar}}
                    </p>
                    <p class="font-semibold text-sm mt-2">Dokter Yang Mengirim</p>
                    <p class="font-semibold text-sm mt-2">
                        : {{$item->user->name}}
                    </p>
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="text-center font-semibold uppercase">
                            <td rowspan="2" class="border border-black w-1">
                                <p class="px-2 text-sm">No.</p>
                            </td>
                            <td rowspan="2" class="border border-black">
                                <p class="text-sm">Tanggal</p>
                            </td>
                            <td rowspan="2" class="border border-black">
                                <p class="text-sm">Lab</p>
                            </td>
                            <td colspan="2" class="border border-black">
                                <p class="text-sm">Rontgent</p>
                            </td>
                            <td rowspan="2" class="border border-black">
                                <p class="text-sm">ECG</p>
                            </td>
                            <td rowspan="2" class="border border-black">
                                <p class="text-sm">Tindakan</p>
                            </td>
                            <td colspan="2" class="border border-black">
                                <p class="text-sm">Konsul</p>
                            </td>
                            <td rowspan="2" class="border border-black">
                                <p class="text-sm">Pa</p>
                            </td>
                            <td rowspan="2" class="border border-black">
                                <p class="text-sm">Oksigen (O<sub>2</sub>)</p>
                            </td>
                            <td rowspan="2" class="border border-black">
                                <p class="text-sm">Lain - Lain</p>
                            </td>
                        </tr>
                        <tr class="font-semibold text-center">
                            <td class="border border-black">
                                <p class="text-sm">Jenis Tindakan</p>
                            </td>
                            <td class="border border-black">
                                <p class="text-sm">Biaya</p>
                            </td>
                            <td class="border border-black">
                                <p class="text-sm">Dokter</p>
                            </td>
                            <td class="border border-black">
                                <p class="text-sm">Biaya</p>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $item)
                            <tr>
                                <td class="border border-black p-3 text-sm">{{ $loop->iteration }}</td>
                                <td class="border border-black p-3 text-sm">{{ $item->tanggal }}</td>
                                <td class="border border-black p-3 text-sm">{{ $item->lab }}</td>
                                <td class="border border-black p-3 text-sm">{{ $item->actionMembers->name }}</td>
                                <td class="border border-black p-3 text-sm">{{ $item->biaya_tindakan }}</td>
                                <td class="border border-black p-3 text-sm">{{ $item->ecg }}</td>
                                <td class="border border-black p-3 text-sm">{{ $item->tindakan }}</td>
                                <td class="border border-black p-3 text-sm">{{ $item->user->name }}</td>
                                <td class="border border-black p-3 text-sm">{{ $item->biaya_konsul }}</td>
                                <td class="border border-black p-3 text-sm">{{ $item->pa }}</td>
                                <td class="border border-black p-3 text-sm">{{ $item->oksigen }}</td>
                                <td class="border border-black p-3 text-sm">{!! $item->lain !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
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
