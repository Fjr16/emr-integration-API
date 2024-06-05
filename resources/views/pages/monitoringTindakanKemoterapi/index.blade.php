<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RINGKASAN MASUK DAN KELUAR KEMOTERAPI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" />
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
            /* height: 29.7cm; */
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
            font-size: 8pt !important;
        }

        td {
            font-size: 8pt !important;
        }

        .ctt-reaksi {
            font-size: 8pt !important;
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
                width: 21.59cm;
                /* height: 29.7cm; */
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
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-7 text-center">
                    <h1>Monitoring Tindakan Kemoterapi</h1>
                </div>
                <div class="col-3">
                    <!-- <div
                            class="border border-3 border-rounded py-4 px-5"
                        ></div> -->
                </div>
            </div>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <p>Tanggal Kemoterapi : {{ $item->created_at->format('d-m-y') ?? '' }}</p>
        <div class="">
            <table class="table table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th class="text-dark text-capitalize">Observasi</th>
                        <th class="text-dark text-capitalize">TD (MmHg)</th>
                        <th class="text-dark text-capitalize">Nadi (x/menit)</th>
                        <th class="text-dark text-capitalize">RR (x/menit)</th>
                        <th class="text-dark text-capitalize">Suhu (°C)</th>
                        <th class="text-dark text-capitalize">Jam Mulai</th>
                        <th class="text-dark text-capitalize">REGIMEN CAIRAN DAN OBAT</th>
                        <th class="text-dark text-capitalize">Jam Selesai</th>
                        <th class="text-dark text-capitalize">Nama Perawat</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    {{-- PREKEMO --}}
                    <tr>
                        <td class="text-dark text-sm">PREKEMO</td>
                        <td class="text-dark">{{ $item->prekemo->first()->td ?? '-' }}</td>
                        <td class="text-dark">{{ $item->prekemo->first()->nadi ?? '-' }}</td>
                        <td class="text-dark">{{ $item->prekemo->first()->rr ?? '-' }}</td>
                        <td class="text-dark">{{ $item->prekemo->first()->suhu ?? '-' }}</td>
                        @foreach ($item->prekemo as $prekemo)
                            <td class="text-dark">
                                @foreach ($prekemo->kemoterapiRegimen as $itemPrekemo)
                                    <p>{{ $itemPrekemo->jam_mulai ?? '-' }}</p>
                                @endforeach
                            </td>
                            <td class="text-dark">
                                @foreach ($prekemo->kemoterapiRegimen as $name)
                                    <p>
                                        @if ($name->name == 'Cairan NaCl 0,9 %')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }} {{ $name->keterangan }}</span>
                                            <span>cc</span>
                                        @elseif ($name->name == null)
                                            <p>..................</p>
                                        @else
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }}</span>
                                        @endif
                                    </p>
                                @endforeach
                            </td>
                            <td class="text-dark">
                                @foreach ($prekemo->kemoterapiRegimen as $jamSelesai)
                                    <p>{{ $jamSelesai->jam_selesai ?? '-' }}</p>
                                @endforeach
                            </td>
                        @endforeach
                        <td class="text-dark">{{ $item->prekemo->first()->nama_perawat ?? '-' }}</td>
                    </tr>
                    {{-- END PREKEMO --}}

                    {{-- INTRAKEMO --}}
                    <tr>
                        <td class="text-dark">INTRAKEMO</td>
                        <td class="text-dark">{{ $item->intrakemo->first()->td ?? '-' }}</td>
                        <td class="text-dark">{{ $item->intrakemo->first()->nadi ?? '-' }}</td>
                        <td class="text-dark">{{ $item->intrakemo->first()->rr ?? '-' }}</td>
                        <td class="text-dark">{{ $item->intrakemo->first()->suhu ?? '-' }}</td>
                        @foreach ($item->intrakemo as $intrakemo)
                            <td class="text-dark">
                                @foreach ($intrakemo->kemoterapiRegimen as $itemIntrakemo)
                                    <p>{{ $itemIntrakemo->jam_mulai }}</p>
                                @endforeach
                            </td>
                            <td class="text-dark">
                                @foreach ($intrakemo->kemoterapiRegimen as $name)
                                    <p>
                                        {{-- ini ada 6 --}}
                                        {{-- {{ dd($name->name) }} --}}
                                        @if ($name->name == 'Bilas cairan NaCl 0,9 %')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }} {{ $name->keterangan }}</span>
                                            {{-- @php
                                                dd($name->keterangan);
                                                die();
                                            @endphp --}}
                                            <span>cc</span>
                                        @elseif ($name->name == 'Docetaxel')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }} {{ $name->keterangan }}</span>
                                            <span>Mg Di Dalam Dextrose 5 % 250 Cc</span>
                                        @elseif ($name->name == 'Brexel')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }} {{ $name->keterangan }}</span>
                                            <span>Mg Didalam Dextrose 5 % 250 Cc</span>
                                        @elseif ($name->name == 'Novelbin / Vinocal')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }} {{ $name->keterangan }}</span>
                                            <span>Mg Didalam NaCl 0,9 % 50 Cc</span>
                                        @elseif ($name->name == 'Doxorubicin')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }} {{ $name->keterangan }}</span>
                                            <span>Mg Di Dalam NaCl 0,9 % 100 Cc</span>
                                        @elseif ($name->name == 'Epirubicin')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }} {{ $name->keterangan }}</span>
                                            <span>Mg Di Dalam NaCl 0,9 % 100 Cc</span>
                                        @elseif ($name->name == 'Zoledronic 4 mg infus')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }}</span>
                                        @elseif ($name->name == 'Cyclovid 600 mg / 800 mg dalam nacl 250cc')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }}</span>
                                        @elseif ($name->name == 'Curacil 500 mg /750 mg dalam nacl 250 cc')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }}</span>
                                        @elseif ($name->name == null)
                                            <p>..................</p>
                                        @else
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }}</span>
                                        @endif
                                    </p>
                                @endforeach
                            </td>
                        @endforeach

                        <td class="text-dark">
                            @foreach ($intrakemo->kemoterapiRegimen as $itemIntrakemo)
                                <p>{{ $itemIntrakemo->jam_selesai ?? '-' }}</p>
                            @endforeach
                        </td>
                        <td class="text-dark">{{ $item->intrakemo->first()->nama_perawat }}</td>
                    </tr>
                    <tr>
                        <td class="text-dark">POSTKEMO</td>
                        <td class="text-dark">{{ $item->postkemo->first()->td ?? '-' }}</td>
                        <td class="text-dark">{{ $item->postkemo->first()->nadi ?? '-' }}</td>
                        <td class="text-dark">{{ $item->postkemo->first()->rr ?? '-' }}</td>
                        <td class="text-dark">{{ $item->postkemo->first()->suhu ?? '-' }}</td>
                        @foreach ($item->postkemo as $postkemo)
                            <td class="text-dark">
                                @foreach ($postkemo->kemoterapiRegimen as $itemPostkemo)
                                    <p>{{ $itemPostkemo->jam_mulai ?? '-' }}</p>
                                @endforeach
                            </td>
                            <td class="text-dark">
                                @foreach ($postkemo->kemoterapiRegimen as $name)
                                    <p>
                                        @if ($name->name == 'Injeksi Dexametasone 5 mg / 1 amp')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }}</span>
                                        @elseif ($name->name == 'Injeksi Ranitidine 50 mg / 1 amp')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }}</span>
                                        @elseif ($name->name == 'Injeksi Ondansentrone 8 mg / 1 amp')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }}</span>
                                        @elseif ($name->name == 'Injeksi Lasix 20 mg / 1 amp')
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }}</span>
                                        @elseif ($name->name == null)
                                            <p>..................</p>
                                        @else
                                            <input class="form-check-input" type="checkbox" checked />
                                            <span class="ms-1">{{ $name->name }}</span>
                                        @endif
                                    </p>
                                @endforeach
                            </td>
                        @endforeach
                        <td class="text-dark">
                            @foreach ($postkemo->kemoterapiRegimen as $itemPostkemo)
                                <p>{{ $itemPostkemo->jam_selesai ?? '-' }}</p>
                            @endforeach
                        </td>
                        <td class="text-dark">{{ $item->postkemo->first()->nama_perawat ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row mt-3">
            <div class="col col-6 mt-3">
                <p class="small ctt-reaksi">Catatan : Reaksi selama pemasangan obat kemoterapi</p>
                <p>
                <div class="d-flex flex-row mb-3 small">
                    <div class="">
                        <span class="ctt-reaksi">Alergi : &nbsp;</span>
                    </div>
                    <div class="">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="defaultCheck3"
                                {{ $item->alergi == 'Tidak' ? 'checked' : '' }} />
                            <span class="ctt-reaksi">Tidak &nbsp;</span>
                        </div>
                    </div>
                    <div class="">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="defaultCheck3"
                                {{ $item->alergi == 'Ya' ? 'checked' : '' }} />
                            <span class="ctt-reaksi">Ya, </span>
                            <span class="ctt-reaksi">{{ $item->keterangan_alergi ?? '...................' }}</span>
                        </div>
                    </div>
                </div>
                </p>
                <p>
                <div class="d-flex flex-row mb-3 small">
                    <div class="">
                        <span class="ctt-reaksi">Ekstravasasi : &nbsp;</span>
                    </div>
                    <div class="">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="defaultCheck3"
                                {{ $item->ekstravasasi == 'Tidak' ? 'checked' : '' }} />
                            <span class="ctt-reaksi">Tidak &nbsp;</span>
                        </div>
                    </div>
                    <div class="">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="defaultCheck3"
                                {{ $item->ekstravasasi == 'Ya' ? 'checked' : '' }} />
                            <span class="ctt-reaksi">Ya, </span>
                            <span
                                class="ctt-reaksi">{{ $item->keterangan_ekstravasasi ?? '...................' }}</span>
                        </div>
                    </div>
                </div>
                </p>
            </div>

            <div class="col col-6 text-center ctt-reaksi">
                <p>Perawat</p>
                <p class="ms-5 ps-2"><img src="{{ Storage::url(Auth::user()->paraf ?? '') }}" alt=""
                        height="70px"></p>
                <p>({{ Auth::user()->name ?? '..............................................' }})
                </p>
            </div>

        </div>
    </div>
</body>

</html>
