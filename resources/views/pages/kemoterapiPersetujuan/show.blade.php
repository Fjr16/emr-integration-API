<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PEMBERIAN INFORMASI PERSETUJUAN TINDAKAN KEMOTERAPI</title>
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
                <div class="col-3">
                    <img src="logo.png" alt="" />
                </div>
                <div class="col-6 d-flex align-self-center">
                    <h1 class="text-center">
                        PEMBERIAN INFORMASI DAN PERSETUJUAN TINDAKAN KEMOTERAPI
                    </h1>
                </div>
                <div class="col-3">
                    <!-- <div
                            class="border border-3 border-rounded py-4 px-5"
                        ></div> -->
                </div>
            </div>
        </div>

        <div class="content">
            <table class="table-bordered w-100 mt-2">
                <tbody>
                    <tr class="">
                        <td class="fw-bold text-center">
                            PEMBERIAN INFORMASI
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table-bordered w-100">
                                <tr>
                                    <td colspan="2" class="w-50 ps-2">
                                        Dokter Pelaksana Tindakan
                                    </td>
                                    <td colspan="2" class="ps-2">{{ $item->user->name }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="ps-2">Pemberi Informasi</td>
                                    <td colspan="2" class="ps-2">{{ $item->petugas }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="ps-2">
                                        Penerima Informasi / Pemberi
                                        Persetujuan*
                                    </td>
                                    <td colspan="2" class="ps-2">{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-center">NO</td>
                                    <td class="fw-bold text-center">
                                        JENIS INFORMASI
                                    </td>
                                    <td class="fw-bold text-center">
                                        ISI INFORMASI
                                    </td>
                                    <td class="fw-bold text-center w-25">
                                        PARAF PASIEN / KELUARGA
                                    </td>
                                </tr>
                                @foreach ($item->kemoterapiPersetujuanDetail as $detail)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="ps-2">{{ $detail->jenis }}</td>
                                        <td class="ps-2">{{ $detail->isi }}</td>
                                        <td><img src="{{ Storage::url($detail->ttd) }}" class="rounded mx-auto d-block"
                                                alt="" height="70px"></td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="3">
                                        Dengan ini menyatakan bahwa saya
                                        telah menerangkan hal-hal di atas
                                        secara benar dan jelas dan
                                        memberikan kesempatan untuk bertanya
                                        dan/atau berdiskusi
                                    </td>
                                    <td><img src="{{ Storage::url($item->ttdKet1) }}" class="rounded mx-auto d-block" alt=""
                                            height="70px"></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        Dengan ini menyatakan bahwa saya
                                        telah menerima informasi sebagaimana
                                        di atas yang saya beri tanda/paraf
                                        di kolom kanannya, dan telah
                                        memahaminya
                                    </td>
                                    <td><img src="{{ Storage::url($item->ttdKet2) }}" class="rounded mx-auto d-block" alt=""
                                            height="70px"></td>
                                </tr>
                            </table>
                            <small>* Bila pasien tidak kompeten atau tidak mau
                                menerima informasi, maka penerima informasi
                                adalah wali atau keluarga terdekat</small>
                        </td>
                    </tr>
                    <tr class="bg-secondary">
                        <td class="fw-bold text-center">
                            PERSETUJUAN TINDAKAN KEMOTERAPI
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="m-0">
                                Yang bertandatangan di bawah ini, saya, nama
                                {{ $item->name ?? '.....................................................................' }}
                                , umur {{ $item->umur ?? '..........' }} tahun, jenis kelamin
                                {{ $item->jenis_kelamin ?? '....................' }}, alamat
                                {{ $item->alamat ?? '......................................................................................................................................' }}
                                dengan ini menyatakan persetujuan untuk
                                dilakukannya tindakan kemoterapi terhadap
                                {{ $item->hubungan ?? '........................................................' }}
                                saya* bernama
                                {{ $item->patient->name ?? '..............................................................' }}
                                umur
                                {{ $umur ?? '.............' }} tahun, {{ $item->patient->jenis_kelamin }}
                                Alamat
                                {{ $item->patient->alamat ?? '..............................................................................................................................................................................' }}
                            </p>
                            <p class="m-0">
                                Saya memahami perlunya dan manfaat tindakan
                                tersebut sebagaimana telah dijelaskan
                                seperti di atas kepada saya, termasuk resiko
                                dan komplikasi yang mungkin timbul.
                            </p>
                            <p class="m-0">
                                Saya juga menyadari bahwa oleh karena ilmu
                                kedokteran bukanlah ilmu pasti, maka
                                keberhasilan tindakan kedokteran bukanlah
                                keniscayaan, melainkan sangat bergantung
                                kepada izin Tuhan Yang Maha Esa.
                            </p>
                            @php
                                $formatId = Carbon\Carbon::parse($item->tanggal)->isoformat('D MMM Y');
                                $pukul = Carbon\Carbon::parse($item->tanggal)->format('H:i');
                            @endphp
                            <p class="mt-3">
                                Padang, Tanggal
                                {{ $formatId ?? '................................. 20....' }}
                                Pukul {{ $pukul ?? '.......................' }}
                            </p>
                            <div class="row">
                                <div class="col-3 text-center">
                                    <p class="text-start m-0 fw-bold">
                                        Yang Menyatakan*,
                                    </p>
                                    <img src="{{ Storage::url($item->ttdPenerimaInformasi) }}" class="rounded mx-auto d-block"
                                        alt="" height="70px">
                                    <p class="m-0">
                                        {{ $item->name ?? '(...................................................................)' }}
                                    </p>
                                </div>
                                <div class="col-4 text-center">
                                    <p class="m-0 fw-bold">
                                        Hubungan :
                                        {{ $item->hub1 ?? '.............................' }}
                                    </p>
                                    <img src="{{ Storage::url($item->ttdHub1) }}" class="rounded mx-auto d-block" alt=""
                                        height="70px">
                                    <p class="m-0">
                                        {{ $item->namaHub1 ?? '(...................................................................)' }}
                                    </p>
                                </div>
                                <div class="col-5 text-center">
                                    <p class="m-0 fw-bold">
                                        Hubungan :
                                        {{ $item->hub2 ?? '.............................' }}
                                    </p>
                                    <img src="{{ Storage::url($item->ttdHub2) }}" class="rounded mx-auto d-block" alt=""
                                        height="70px">
                                    <p class="m-0">
                                        {{ $item->namaHub2 ?? '(...................................................................)' }}
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
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
