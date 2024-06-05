<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LEMBARAN KONSULTASI PENYAKIT DALAM (TOLERANSI OPERASI)</title>
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
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-8 text-center">
                    <h1>LEMBARAN KONSULTASI PENYAKIT DALAM <br>
                        (TOLERANSI OPERASI)

                    </h1>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <table class="w-100 table border ">
                <tr>
                    <td colspan="2" class="m-0 p-0">
                        <p class="m-0 mx-2">
                            Ruangan <span class="mx-4">: {{ $item->roomDetail->name }}</span>
                        </p>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <p class="m-0 mb-4">Yth dr. : {{ $item->ranapJawabanKonsulPenyakitDalamPatient->user->name }}
                        </p>

                        <p class="m-0 ">Dengan Hormat,</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="m-0 ">Mohon bantuan sejawat untuk</p>
                            {{-- <p class="m-0 ">Lingkari yang sesuai(*)</p> --}}
                        </div>
                        <div class="mb-3">
                            <ol type="1">
                                <li> {{ $item->permintaan }}</li>
                            </ol>
                        </div>
                        <p class="m-0">
                            Atas pasien ini yang kami rawat dengan :
                            {!! $item->ket_pasien !!}
                            <br>
                        </p>
                        <p class="m-0">
                            Pemeriksaan yang ditemukan :
                            {!! $item->pemeriksaan_ditemukan !!}
                        </p>
                        <p class="m-0 mb-5">
                            Atas perhatian dan kerjasama, kami ucapkan terima kasih.
                        </p>
                        <div class="w-50 ms-auto text-center">
                            @php
                                $formatId = Carbon\Carbon::parse($item->tanggal);
                            @endphp
                            <p class="m-0 mb-5">Padang, {{ $formatId->isoformat('D MMM Y') }}</p>
                            <img src="{{ Storage::url($item->user->paraf) }}" alt="" height="70px">
                            <p>{{ $item->user->name ?? '(.......................................)' }}
                            </p>

                        </div>
                        {{-- <p class="m-0 mt-1">
                            jawaban konsoltasi di sebelah
                        </p> --}}


                    </td>
                </tr>
            </table>

        </div>
    </div>

    @if ($item->ranapJawabanKonsulPenyakitDalamPatient)
        <div class="page">
            <div class="header">
                <div class="row">
                    <div class="col-2">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" />
                    </div>
                    <div class="col-8 text-center">
                        <h1>LEMBARAN JAWABAN KONSULTASI PENYAKIT DALAM <br>
                            (TOLERANSI OPERASI)

                        </h1>
                    </div>
                    <!-- <div class="col-3">
                        <div class="border border-3 border-rounded py-4 px-5"></div>
                    </div> -->
                </div>
            </div>

            <div class="content mt-3">
                <table class="w-100 table border ">
                    <tr>
                        <td colspan="2" class="m-0 p-0">
                            <p class="m-0 mx-2">
                                Ruangan <span class="mx-4">:
                                    {{ $jawaban->ranapPermintaanKonsulPenyakitDalamPatient->roomDetail->name }}</span>
                            </p>
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2">
                            <p class="m-0 ">Yth dr. :
                                {{ $jawaban->ranapPermintaanKonsulPenyakitDalamPatient->user->name }}</p>
                            <p class="m-0 pb-4">Membalas konsultasi TS , dengan ini kami telah memeriksa pasien :
                                {{ $jawaban->ranapPermintaanKonsulPenyakitDalamPatient->patient->name }}</p>


                            <p class="m-0">Penemuan :</p>
                            @foreach ($penemuans as $penemuan)
                                @if ($penemuan->name == 'S')
                                    <p class="m-0 ms-3 fw-bold">S : {{ $penemuan->value }}</p>
                                @endif
                            @endforeach
                            <div class="m-0 ms-3 fw-bold d-flex">
                                <p class="m-0 me-1">O:</p>
                                <table class="w-100 table table-bordered">
                                    <tr class="text-center">
                                        <th style="font-size: 10px" class="m-0 p-0">Keadaan Umum</th>
                                        <th style="font-size: 10px" class="m-0 p-0">Kesadaran </th>
                                        <th style="font-size: 10px" class="m-0 p-0">Tekanan Darah</th>
                                        <th style="font-size: 10px" class="m-0 p-0">Frekuensi Nadi </th>
                                        <th style="font-size: 10px" class="m-0 p-0">Frekuensi Napas</th>
                                        <th style="font-size: 10px; min-width: 80px" class="m-0 p-0">SPO<sub>2</sub>
                                        </th>
                                    </tr>
                                    <tr>
                                        @foreach ($penemuans as $penemuan)
                                            @if ($penemuan->name == 'Keadaan Umum')
                                                <td class="py-4">{{ $penemuan->value }}</td>
                                            @endif
                                            @if ($penemuan->name == 'Kesadaran')
                                                <td class="py-4">{{ $penemuan->value }}</td>
                                            @endif
                                            @if ($penemuan->name == 'Tekanan Darah')
                                                <td class="py-4">{{ $penemuan->value }}</td>
                                            @endif
                                            @if ($penemuan->name == 'Frekuensi Nadi')
                                                <td class="py-4">{{ $penemuan->value }}</td>
                                            @endif
                                            @if ($penemuan->name == 'Frekuensi Napas')
                                                <td class="py-4">{{ $penemuan->value }}</td>
                                            @endif
                                            @if ($penemuan->name == 'SPO')
                                                <td class="py-4">{{ $penemuan->value }}</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                </table>

                            </div>
                            @foreach ($penemuans as $penemuan)
                                @if ($penemuan->name == 'THORAX')
                                    <p class="m-0 ms-3 fw-bold">THORAX : {{ $penemuan->value }}</p>
                                @endif
                            @endforeach

                            <div class="row mt-5">
                                <div class="col">
                                    @foreach ($penemuans as $penemuan)
                                        @if ($penemuan->name == 'ABDOMEN')
                                            <p class="ms-3 fw-bold">ABDOMEN : {{ $penemuan->value }}</p>
                                        @endif
                                    @endforeach
                                    <div class="mt-5">
                                        <table class="fw-bold" style="font-size: 13px">
                                            @foreach ($lainnyas as $lainnya)
                                                {{-- <p class="ms-3 fw-bold">{{$lainnya->name}} : {{$lainnya->value}}</p> --}}
                                                <tr>
                                                    <td>{{ $lainnya->name }}</td>
                                                    <td>: {{ $lainnya->value }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        <p class="mt-3">KESIMPULAN</p>
                                        <p>{!! $jawaban->kesimpulan !!}</p>
                                    </div>
                                </div>
                                <div class="col ps-5 ms-5">
                                    <p style="border-bottom: 1.5px solid black; width: 100%; display: inline;">Skrining
                                        Covid-19 </p>

                                    <div class="d-flex flex-column justify-content-center align-items-start">
                                        <table class=" w-75">
                                            @php
                                                $skor = 0;
                                            @endphp
                                            @foreach ($covids as $covid)
                                                <tr>
                                                    <td class="w-25 py-1">{{ $covid->name }}</td>
                                                    <td>: {{ $covid->value }}</td>
                                                </tr>
                                                @php
                                                    $skor = $skor + $covid->value;
                                                @endphp
                                            @endforeach
                                            <tr style="border-top: 1px solid black">
                                                <td class="py-1">Skor</td>
                                                <td class="py-1">: {{ $skor }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <p class="m-0">Anjuran :</p>
                            <p>{!! $jawaban->anjuran !!}</p>
                            <p class="m-0 ms-3 ">Atas perhatian dan kerjasama diucapkan terima kasih</p>

                            <div class="w-50 ms-auto text-center  mt-2">
                                @php
                                    $formatId = Carbon\Carbon::parse($item->tanggal);
                                @endphp
                                <p class="m-0">Padang, {{ $formatId->isoformat('D MMM Y') }}</p>
                                <p class="m-0 pb-5">Dokter Konsulen</p>
                                <img src="{{ Storage::url($jawaban->user->paraf) }}" alt="" height="70px">
                                <p class="m-0 pb-2">
                                    {{ $jawaban->user->name ?? '(........................................)' }}
                                </p>
                            </div>


                        </td>
                    </tr>
                </table>

            </div>
        </div>
    @endif


</body>

</html>
