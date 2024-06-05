<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Resep Dokter</title>
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

        .bg-gray {
            background-color: #d3d3d3
        }

        .page {
            /* height: 210mm; */
            height: auto;
            /* width: 297mm; */
            width: 210mm;
            min-height: 13.97cm;
            padding: 15mm;
            margin: 15mm auto;
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

        .compact-table th,
        .compact-table td {
            padding: 2px 5px;
            /* Reduce padding */
            font-size: 10.5px;
            /* Smaller font size */
        }

        .compact-table th {
            /* white-space: nowrap; */
            /* Prevent header text from wrapping */
        }

        @page {
            size: A4;
            /* Specify A4 size */
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
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 15mm;
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
    {{-- adsa --}}
    <div class="page">
        <div class="header">
            {{-- <div class="row">
                <div class="col-2">
                    <img src="{{ asset('/assets/img/logo.png') }}" alt="" />
                </div>
                <div class="col-7 text-center">
                    <h1>DAFTAR RESEP DOKTER</h1>
                </div>
                <div class="col-3">
                    <div class="border border-3 border-rounded py-4 px-5">
                    </div>
                </div>
            </div> --}}
            <div class="row justify-content-center">
                <div class="col-8 text-center justify-content-center">
                    <div class="d-flex flex-column">
                        <span class="fw-bold fs-5">{{ $item->user->name ?? '....' }}</span>
                        <hr class="my-0 border border-dark border-1">
                        <span class="fw-bold">SIP : {{ $item->user->sip ?? '....' }}</span>
                        {{-- <span>Spesialis {{ Auth::user()->specialists->name }}</span> --}}
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="d-flex flex-column">
                        <span class="fw-bold">Praktek :</span>
                        <span class="fw-bold">R.S. Khusus Bedah Ropanasuri</span>
                        <span>Jl. Aur No. 8 Padang</span>
                        <span>Telp. 31938 - 33854</span>
                    </div>
                </div>
            </div>
            <hr class="border border-dark border-3 opacity-100">
        </div>

        <div class="content mt-4">
            {{-- <table class="table table-bordered text-center">
                <thead>
                    <tr class="bg-light">
                        <td>Tanggal / Jam</td>
                        <td>Nama Dokter</td>
                        <td>Nama Obat</td>
                        <td>Jumlah</td>
                        <td>Aturan Penggunaan</td>
                        <td>Keterangan Penggunaan</td>
                        <td>Keterangan Lainnya</td>
                        <td>Nama & Paraf</td>
                    </tr>
                </thead>
                <tbody class="small">
                    <tr>
                        <td>{{ $item->created_at->format('Y-m-d / H:i') }}</td>
                        <td>{{ $item->user->name ?? '' }}</td>
                        <td>
                            @foreach ($item->medicineReceiptDetails as $detail)
                                <table>
                                    <tr>
                                        <td>{{ $detail->medicine->name ?? '' }}</td>
                                    </tr>
                                </table>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($item->medicineReceiptDetails as $detail)
                                <table>
                                    <tr>
                                        <td>{{ $detail->jumlah ?? '' }}</td>
                                    </tr>
                                </table>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($item->medicineReceiptDetails as $detail)
                                <table>
                                    <tr>
                                        <td>{{ $detail->aturan_pakai ?? '' }}</td>
                                    </tr>
                                </table>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($item->medicineReceiptDetails as $detail)
                                <table>
                                    <tr>
                                        <td>{{ $detail->keterangan ?? '' }}</td>
                                    </tr>
                                </table>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($item->medicineReceiptDetails as $detail)
                                <table>
                                    <tr>
                                        <td>{{ $detail->other ?? '' }}</td>
                                    </tr>
                                </table>
                            @endforeach
                        </td>
                        <td>Nama & Paraf</td>
                    </tr>
                </tbody>
            </table> --}}
            {{-- <div class="row border">
                <div class="col-sm-1 fw-bold border">
                    Tanggal / Jam
                </div>
                <div class="col-sm-1 fw-bold border">
                    Nama Dokter
                </div>
                <div class="col-sm-2 fw-bold border">
                    Nama Obat
                </div>
                <div class="col-sm-1 fw-bold border">
                    Jumlah
                </div>
                <div class="col-sm-2 fw-bold border">
                    Aturan Penggunaan
                </div>
                <div class="col-sm-2 fw-bold border">
                    Keterangan Penggunaan
                </div>
                <div class="col-sm-2 fw-bold border">
                    Keterangan Lainnya
                </div>
                <div class="col-sm-1 fw-bold border">
                    Nama & Paraf
                </div>
            </div>
            <div class="row border">
                <div class="col-sm-1">
                    {{ $item->created_at->format('Y-m-d / H:i') }}
                </div>
                <div class="col-sm-1">
                    {{ $item->user->name ?? '' }}
                </div>
                <div class="col border">
                    @foreach ($item->medicineReceiptDetails as $detail)
                        <div class="row">
                            <div class="col border-bottom">
                                {{ $detail->medicine->name ?? '' }}
                            </div>
                            <div class="col-2 text-center border-bottom border-start">
                                {{ $detail->jumlah ?? '' }}
                            </div>
                            <div class="col border-bottom border-start">
                                {{ $detail->aturan_pakai ?? '' }}
                            </div>
                            <div class="col border-bottom border-start">
                                {{ $detail->keterangan ?? '' }}
                            </div>
                            <div class="col border-bottom border-start">
                                {{ $detail->other ?? '' }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-1">
                    Nama & Paraf
                </div>
            </div> --}}
            <div class="row small">
                <div class="col-6">
                    <span>Ruangan</span>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            UGD
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Poliklinik
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Ranap
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <span>Tanggal :</span>
                    <p>Riwayat Alergi Obat</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Tidak
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Ya, Nama Obat ........
                        </label>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                @php
                    function toRoman($number)
                    {
                        $lookup = [
                            1000 => 'M',
                            900 => 'CM',
                            500 => 'D',
                            400 => 'CD',
                            100 => 'C',
                            90 => 'XC',
                            50 => 'L',
                            40 => 'XL',
                            10 => 'X',
                            9 => 'IX',
                            5 => 'V',
                            4 => 'IV',
                            1 => 'I',
                        ];
                        $result = '';
                        foreach ($lookup as $value => $symbol) {
                            while ($number >= $value) {
                                $result .= $symbol;
                                $number -= $value;
                            }
                        }
                        return $result;
                    }
                @endphp

                @foreach ($item->medicineReceiptDetails as $detail)
                    <div class="col-12">
                        <div class="d-flex flex-row">
                            <div class="d-flex align-items-center" style="min-width: 150px"><span class="fw-bold">R /
                                </span>
                                {{ $detail->medicine->name ?? '' }}</div>
                            <div class="row" style="max-width: 300px">
                                <div class="col-2">
                                    <span style="font-size:70px" class="fw-light">&int;</span>
                                </div>
                                <div class="col-7 d-flex align-items-center">
                                    <div class="row">
                                        {{-- <div class="col-12">{{ $detail->jumlah ?? '' }}</div> --}}
                                        <div class="col-12">{{ $detail->aturan_pakai ?? '' }}</div>
                                        <div class="col-12">{{ $detail->keterangan ?? '' }}</div>
                                        <div class="col-12">{{ $detail->other ?? '' }}</div>
                                    </div>
                                </div>
                                <div class="col-2 d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="fw-bold">{{ toRoman($detail->jumlah ?? 0) }}</span>
                                        {{-- <span class="fw-bold">{{ $detail->jumlah ?? 0 }}</span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <table>
                        <tr>
                            <td>Nama Pasien</td>
                            <td>:</td>
                            <td class="ps-2">{{ $item->patient->name ?? '....' }}</td>
                        </tr>
                        <tr>
                            <td>No Rekam Medis</td>
                            <td>:</td>
                            <td class="ps-2">
                                {{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) ?? '....' }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir Umur</td>
                            <td>:</td>
                            @php
                                $tanggalLahir = new DateTime($item->patient->tanggal_lhr);
                                $now = new DateTime();
                                $ageDiff = $now->diff($tanggalLahir);
                                $ageString = $ageDiff->format('%y tahun %m bulan');
                            @endphp
                            <td class="ps-2">{{ $tanggalLahir->format('d-m-Y') ?? '....' }}
                                <span>({{ $ageString ?? '....' }})</span>
                            </td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td class="ps-2">{{ $item->patient->nik ?? '....' }}</td>
                        </tr>
                        <tr>
                            <td>Berat Badan</td>
                            <td>:</td>
                            <td class="ps-2">{{ $statusFisikDiagnosaKeperawatanPatient->bb ?? '....' }} kg</td>
                        </tr>
                        <tr>
                            <td>Nama Dokter</td>
                            <td>:</td>
                            <td class="ps-2">{{ $item->user->name ?? '....' }}</td>
                        </tr>
                        <tr>
                            <td>No SIP</td>
                            <td>:</td>
                            <td class="ps-2">{{ $item->user->sip ?? '....' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="page">
        {{-- VERIFIKASI RESEP --}}
        <div class="header text-center small">
            VERIFIKASI RESEP
        </div>
        <div class="content small">
            <table class="table table-bordered border-dark compact-table">
                <thead>
                    <tr class="text-center small bg-gray">
                        <td class="fw-bold">NO</td>
                        <td class="fw-bold" style="min-width: 170px;">VERIFIKASI</td>
                        <td class="fw-bold">YA</td>
                        <td class="fw-bold">TIDAK</td>
                        <td class="fw-bold">KETERANGAN</td>
                        <td class="fw-bold" style="max-width: 80px;">NAMA/PARAF PETUGAS</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Kejelasan Tulisan Resep</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="14">2</td>
                        <td>Kelengkapan Resep</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-2">a. Administrasi</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-3">Identitas Pasien</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-3">Berat Badan (Pasien Anak)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-3">Nama Dokter</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-3">SIP Dokter</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-3">Paraf Dokter</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-3">Tanggal Resep</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-2">b. Farmasetik</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-3">Nama Obat</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-3">Bentuk dan kekuatan Sediaan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-3">Dosis dan Jumlah Obat</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-3">Frekuensi/Aturan Pakai</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-3">Rute</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td rowspan="7">3</td>
                        <td>Klinis</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-2">Tepat Indikasi</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-2">Tepat Dosis</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-2">Duplikasi Obat</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-2">Alergi Obat</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-2">Kontra Indikasi</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="ps-2">Interaksi Obat</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Kesesuaian Formularium RS</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Kesesuaian Formas</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- VERIFIKASI OBAT --}}
        <div class="header text-center small">
            VERIFIKASI OBAT
        </div>
        <div class="content small">
            <table class="table table-bordered border-dark compact-table">
                <thead>
                    <tr class="text-center small bg-gray">
                        <td class="fw-bold">NO</td>
                        <td class="fw-bold" style="min-width: 170px;">VERIFIKASI OBAT</td>
                        <td class="fw-bold">PARAF PETUGAS (PENYIAPAN BAHAN)</td>
                        <td class="fw-bold">PARAF PETUGAS (PENYERAHAN OBAT)</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Benar Identitas Pasien</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Benar Nama Obat</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Benar Dosis</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Benar Frekuensi Pemberian</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Benar Rute Pemberian</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- EDUKASI OBAT --}}
        <div class="content small border border-dark">
            <div class="header text-center">
                EDUKASI OBAT
            </div>
            <div class="row mt-2">
                <div class="col-6 px-5 small">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="namaObat">
                                <label class="form-check-label" for="namaObat">
                                    Nama Obat
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="indikasiObat">
                                <label class="form-check-label" for="indikasiObat">
                                    Indikasi Obat
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="aturanPakai">
                                <label class="form-check-label" for="aturanPakai">
                                    Aturan Pakai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="caraPenggunaan">
                                <label class="form-check-label" for="caraPenggunaan">
                                    Cara Penggunaan Obat
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="penyimpananObat">
                                <label class="form-check-label" for="penyimpananObat">
                                    Penyimpanan Obat
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="kadaluarsa">
                                <label class="form-check-label" for="kadaluarsa">
                                    Kadaluarsa
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="dll">
                                <label class="form-check-label" for="dll">
                                    .............
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 px-5 small">
                    <div class="row">
                        <p>Tanggal .................</p>
                        <div class="col-6">
                            <p>Apoteker/TTK</p>
                            <p></p>
                            <p class="pt-3">(......................................)</p>
                        </div>
                        <div class="col-6">
                            <p>Pasien/Keluarga</p>
                            <p></p>
                            <p class="pt-3">(......................................)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
