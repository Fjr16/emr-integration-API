<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CPPT</title>
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
            height: auto;
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
            font-size: 10pt !important;
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

        .small-table td {
            padding: 2px 5px;
            font-size: 8pt;
        }

        .bg-gray {
            background-color: #d3d3d3
        }

        @page {
            size: A4;
            margin: 10mm;
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
                width: 21.59cm;
                height: 29.7cm;
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
                <div class="col-1 d-flex align-items-center">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="" class="img-fluid" />
                </div>
                <div class="col-6 text-center d-flex align-items-center">
                    <h1>CATATAN PERKEMBANGAN PASIEN <br> TERINTEGRASI (CPPT)</h1>
                </div>
                <div class="col-5">
                    <div class="border border-dark py-1 px-1" style="border-radius: 15px">
                        <table class="small small-table">
                            <tr>
                                <td>Nama</td>
                                <td class="px-2">:</td>
                                <td>{{ $item->name }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td class="px-2">:</td>
                                @php
                                    $tanggalLahir = new DateTime($item->tanggal_lhr);
                                    $now = new DateTime();
                                    $ageDiff = $now->diff($tanggalLahir);
                                    $ageString = $ageDiff->format('%y tahun %m bulan');
                                @endphp
                                <td>{{ $tanggalLahir->format('d-m-Y') ?? '....' }}
                                    <span>({{ $ageString ?? '....' }})</span>
                                </td>
                            </tr>
                            <tr>
                                <td>No Rekam Medis</td>
                                <td class="px-2">:</td>
                                <td>{{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                </td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td class="px-2">:</td>
                                <td>{{ $item->nik }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <table class="table-bordered w-100 mt-4">
                <thead>
                    <tr class="text-center bg-gray">
                        <th class="m-0">Tanggal <br> / Jam</th>
                        <th class="m-0">Profesional <br> Pemberi <br> Asuhan <br> (PPA)</th>
                        <th class="m-0">
                            Hasil Pemerikasaan, Analisa dan Tindak Lanjut <br> Subjective, Objective, Asesmen, Planning
                            <br> (SOAP) / ADIME <br>
                            Tulis, Baca, Konfirmasi (TULBAKON) <br>
                            (dituliskan dengan format SOAP, disertai dengan sasaran/target yang terukur, evaluasi hasil
                            tata laksana dituliskan ddalam asesmen, harap bubuhkan nama dan paraf pada setiap akhir
                            catatan)
                        </th>
                        <th class="m-0">
                            Instruksi Tenaga <br>Kesehatan termasuk <br>pasca Bedah / Prosedur <br>
                        </th>
                        <th>
                            Review dan <br>Verifikasi DPJP <br>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item->rmeCppts as $cppt)
                        @php
                            $soap = str_replace(
                                [
                                    '<p><strong>SUBJECTIVE (S):&nbsp;</strong></p>',
                                    '<p><strong>OBJECTIVE (O):&nbsp;</strong></p>',
                                    '<p><strong>ASSESMEN (A):&nbsp;</strong></p>',
                                    '<p><strong>PLANING (P):&nbsp;</strong></p>',
                                ],
                                [
                                    '<p><strong>(S):&nbsp;</strong></p>',
                                    '<p><strong>(O):&nbsp;</strong></p>',
                                    '<p><strong>(A):&nbsp;</strong></p>',
                                    '<p><strong>(P):&nbsp;</strong></p>',
                                ],
                                $cppt->soap,
                            );
                            $soap = str_replace(['|', ',', '&nbsp;'], '', $soap);
                            $soap = str_replace('</p>', '', $soap);
                            $soap = str_replace('</ol>', '</ol></p>', $soap);
                            $soap = str_replace(['<p>', '</p>'], ['<table><tr>', '</span></td> </tr></table>'], $soap);
                            $soap = str_replace(['<strong>', '</strong>'], ['<td style="vertical-align: top"><strong>', '</strong></td> <td><span>'], $soap);
                            $soap = str_replace(['<ol><li>', '</li></ol>'], '', $soap);
                            $soap = str_replace('</li><li>', '; ', $soap);
                        @endphp
                        <tr class="small {{ $cppt->user->hasRole('Perawat Rajal') ? 'text-primary' : ''  }}">
                            <td class="text-center">{{ $cppt->tanggal ?? '' }}</td>
                            <td class="text-center">{{ $cppt->user->name ?? '' }} ({{ $cppt->user->staff_id ?? '' }})
                            </td>
                            <td class="P-2">
                                {!! $soap ?? '' !!}

                                {{-- tanda tangan PPA --}}
                                <div class="row mb-2">
                                    <div class="col-6 text-center">
                                        @if ($cppt->ttd_user)
                                            <img src="{{ Storage::url($cppt->ttd_user) }}" alt=""
                                                class="img-thumbnail">
                                            <span class="fw-bold">({{ $cppt->user->name }})</span>
                                        @else
                                            <span class="fw-bold border">MENUNGGU PENGESAHAN PPA</span><br>
                                        @endif
                                    </div>
                                </div>
                                @if ($cppt->tipe_cppt == 'SBAR')
                                    <table class="table">
                                        <thead class="text-nowrap">
                                            <th class="text-body">
                                                {{ $cppt->tipe_cppt }}
                                            </th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    @if ($cppt->rajalCpptSbarPatient)
                                                        @php
                                                            $tanggal = Carbon\Carbon::parse($cppt->rajalCpptSbarPatient->tanggal);
                                                        @endphp
                                                        <span>Dikonfirmasi oleh pemberi intruksi </span><br>
                                                        <span class="fw-bold">{{ $tanggal->format('d M Y') }}</span> <br>
                                                        <img src="{{ Storage::url($cppt->rajalCpptSbarPatient->ttd ?? '') }}" alt="" class="img-thumbnail" width="130" height="130"> <br>
                                                        <span class="fw-bold"> ({{ $cppt->rajalCpptSbarPatient->user->name ?? '' }})</span>
                                                    @else
                                                        @if (auth()->user()->id == $queue->doctorPatient->user_id)
                                                            <span><button class="btn btn-sm btn-dark" type="button" onclick="openModal({{ $cppt->id }}, 'ttd')">Konfirmasi</button></span>
                                                        @else
                                                            <span class="fw-bold">MENUNGGU KONFIRMASI DPJP</span>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif

                                {{-- SERAH TERIMA PERAWAT --}}
                                @if ($cppt->serah_terima)
                                    <table class="table">
                                        <thead class="text-nowrap">
                                            <th class="text-body">
                                                SERAH TERIMA
                                            </th>
                                        </thead>
                                        <tbody>
                                            <tr class="text-primary">
                                                <td>
                                                    @if ($cppt->rajalCpptSerahTerimaPatient)
                                                        @php
                                                            $tanggalTerima = Carbon\Carbon::parse(
                                                                $cppt->rajalCpptSerahTerimaPatient->tanggal,
                                                            );
                                                        @endphp
                                                        <span>Diterima Perawat <br>
                                                            <span
                                                                class="fw-bold">{{ $tanggalTerima->format('d M Y') }}</span><br>
                                                            <img src="{{ Storage::url($cppt->rajalCpptSerahTerimaPatient->ttd) }}"
                                                                alt="" class="img-thumbnail" width="130"
                                                                height="130"><br>
                                                            <span
                                                                class="fw-bold">({{ $cppt->rajalCpptSerahTerimaPatient->user->name ?? '' }})</span>
                                                        @else
                                                            <span class="fw-bold border">MENUNGGU TANGGAPAN</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </td>
                            <td>{!! $cppt->intruksi !!}</td>
                            <td class="text-center">
                                @if ($cppt->ttd_dpjp)
                                    @php
                                        $tanggalValidasiDpjp = Carbon\Carbon::parse(
                                            $cppt->tanggal_dpjp,
                                        );
                                    @endphp
                                    <img src="{{ Storage::url($cppt->ttd_dpjp) }}" alt="" class="img-thumbnail">
                                    <span class="text-center">
                                        ({{ $queue->doctorPatient->user->name ?? '' }}) <br>
                                        {{ $tanggalValidasiDpjp->format('d M Y') }}
                                    </span>
                                @else
                                    @if ($cppt->user_id != $queue->doctorPatient->user_id)                                    
                                        <span class="fw-bold">MENUNGGU VERIFIKASI DPJP</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
