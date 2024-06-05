<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ROPANASURI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

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

        .content {
            font-size: 10pt;
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
                <div class="col-7 d-flex align-self-center">
                    <h1 class="mx-auto text-uppercase text-center ">FORMULIR PERMINTAAN LABORATORIUM</h1>
                </div>
                <div class="col-3">
                <div class="border border-3 border-rounded py-4 px-5"></div>
                </div>
            </div>
        </div>

        <div class="content">
            <table class="mt-3">
                <tr>
                  <td style="width: 160px">No Registrasi Labor</td>
                  <td>:</td>
                  <td>41231</td>
                </tr>
                <tr>
                    <td>Nama Pasien</td>
                    <td>:</td>
                    <td>Nama</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td>Nama</td>
                </tr>
                <tr>
                    <td>No RM</td>
                    <td>:</td>
                    <td>12313</td>
                </tr>
                <tr>
                    <td>Diagnosa</td>
                    <td>:</td>
                    <td>afas</td>
                </tr>
                <tr>
                    <td>Tanggungan</td>
                    <td>:</td>
                    <td>afas</td>
                </tr>
                <tr>
                    <td>Jam Pengambilan Sampel</td>
                    <td>:</td>
                    <td>afas</td>
                </tr>
              </table>
              {{-- @dd($item->laboratoriumRequestDetails->where('category', 'Diabetes')) --}}
              {{-- @dd($item->laboratoriumRequestDetails->where('category', 'Diabetes')) --}}
              {{-- @php
                  $data = DB::table('laboratorium_request_details')->where('laboratorium_request_id', $item->id)->where('name', 'LIKE', '%Sliding Scale Jam%')->pluck('name')->first();
              @endphp
              @dd($data); --}}
              {{-- @dd($item->laboratoriumRequestDetails->where('name', 'LIKE', 'Sliding Scale Jam%')->get()) --}}
              <p class="fw-bold mb-0 mt-2">PERSIAPAN OPERASI</p>
                <div class="">
                    <div class="form-check mt-1">
                        <input type="radio" name="operasi" class="form-check-input" style="pointer-events: none;" {{ ($item->laboratoriumRequestDetails->where('name', 'Darah Rutin : Hb, Leu, Trom')->first()) ? 'checked': '' }} />
                        <label class="form-check-label m-0">
                        Darah Rutin : Hb, Leu, Trom
                        </label>
                    </div>
                    <div class="form-check mt-1">
                        <input type="radio" name="operasi" class="form-check-input" style="pointer-events: none;" {{ ($item->laboratoriumRequestDetails->where('name', 'Darah Lengkap : Hb, Leu, Trom, Creat, OT, PT, GDR')->first()) ? 'checked': ''  }} />
                        <label class="form-check-label m-0">
                        Darah Lengkap : Hb, Leu, Trom, Creat, OT, PT, GDR
                        </label>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-4">
                        <p class="fw-bold mb-0">HEMATOLOGI</p>
                        @php
                            $hematologi = $item->laboratoriumRequestDetails->where('category', 'Hematologi')->pluck('name')->toArray();
                        @endphp
                        <div class="mb-3">
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hematologi[]" style="pointer-events: none;" class="form-check-input" {{ in_array('Haemoglobin', $hematologi) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Haemoglobin
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hematologi[]" style="pointer-events: none;" class="form-check-input" {{ in_array('Leukosit', $hematologi) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Leukosit
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hematologi[]" style="pointer-events: none;" class="form-check-input" {{ in_array('Trombosit', $hematologi) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Trombosit
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hematologi[]" style="pointer-events: none;" class="form-check-input" {{ in_array('Hitung Jenis', $hematologi) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Hitung Jenis
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hematologi[]" style="pointer-events: none;" class="form-check-input" {{ in_array('Eritrosit', $hematologi) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Eritrosit
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hematologi[]" style="pointer-events: none;" class="form-check-input" {{ in_array('LED', $hematologi) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                LED
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hematologi[]" style="pointer-events: none;" class="form-check-input" {{ in_array('Retikulosit', $hematologi) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Retikulosit
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hematologi[]" style="pointer-events: none;" class="form-check-input" {{ in_array('Hematokrit', $hematologi) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Hematokrit
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hematologi[]" style="pointer-events: none;" class="form-check-input" {{ in_array('MCV, MCH, MCHC', $hematologi) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                MCV, MCH, MCHC
                                </label>
                            </div>
                        </div>
                            <p class="fw-bold mb-0">HEMOSTASIS</p>
                            @php
                                $hemos = $item->laboratoriumRequestDetails->where('category', 'Hemostasis')->pluck('name')->toArray();
                            @endphp
                            <div class="mb-3">
                                <div class="form-check mt-1">
                                    <input type="checkbox" name="hemostasis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Waktu Pendarahan', $hemos) ? 'checked' : '' }} />
                                    <label class="form-check-label m-0">
                                    Waktu Pendarahan
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input type="checkbox" name="hemostasis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Waktu Pembekuan', $hemos) ? 'checked' : '' }} />
                                    <label class="form-check-label m-0">
                                    Waktu Pembekuan
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input type="checkbox" name="hemostasis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('PT', $hemos) ? 'checked' : '' }} />
                                    <label class="form-check-label m-0">
                                    PT
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input type="checkbox" name="hemostasis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('APTT', $hemos) ? 'checked' : '' }} />
                                    <label class="form-check-label m-0">
                                    APTT
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input type="checkbox" name="hemostasis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('INR', $hemos) ? 'checked' : '' }} />
                                    <label class="form-check-label m-0">
                                    INR
                                    </label>
                                </div>
                                <div class="form-check mt-1">
                                    <input type="checkbox" name="hemostasis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('D-DIMER', $hemos) ? 'checked' : '' }} />
                                    <label class="form-check-label m-0">
                                    D-DIMER
                                    </label>
                                </div>
                            </div>
                            <p class="fw-bold mb-0">ELEKTROLIT</p>
                                @php
                                    $elektrolit = $item->laboratoriumRequestDetails->where('category', 'Elektrolit')->pluck('name')->toArray();
                                @endphp
                                <div class="mb-3">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="elekrolit[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Natrium', $elektrolit) ? 'checked' : '' }} />
                                        <label class="form-check-label m-0">
                                        Natrium
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="elekrolit[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Kalium', $elektrolit) ? 'checked' : '' }} />
                                        <label class="form-check-label m-0">
                                        Kalium
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="elekrolit[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Clorida', $elektrolit) ? 'checked' : '' }} />
                                        <label class="form-check-label m-0">
                                        Clorida
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="elekrolit[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Calsium', $elektrolit) ? 'checked' : '' }} />
                                        <label class="form-check-label m-0">
                                        Calsium
                                        </label>
                                    </div>
                               </div>
                               <p class="fw-bold mb-0">MIKROBIOLOGI</p>
                               @php
                                   $mikrob = $item->laboratoriumRequestDetails->where('category', 'Mikrobiologi')->pluck('name')->toArray();
                               @endphp
                               <div class="mb-3">
                                   <div class="form-check mt-1">
                                       <input type="checkbox" name="mikrobiologi[]" class="form-check-input" style="pointer-events: none;" {{ in_array('BTA', $mikrob) ? 'checked' : '' }} />
                                       <label class="form-check-label m-0">
                                       BTA
                                       </label>
                                   </div>
                                   <div class="form-check mt-1">
                                       <input type="checkbox" name="mikrobiologi[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Kultur Pus & sensitivity', $mikrob) ? 'checked' : '' }}/>
                                       <label class="form-check-label m-0">
                                       Kultur Pus & sensitivity
                                       </label>
                                   </div>
                                   <div class="form-check mt-1">
                                       @php
                                           $bahanArr = array_filter($mikrob, function($mik){
                                               return strpos(strtolower($mik), 'kultur bahan') !== false;
                                           });
                                           $bahan = reset($bahanArr);
                                       @endphp
                                       {{-- @dd($bahan); --}}
                                       <input type="checkbox" name="mikrobiologi[]" class="form-check-input" style="pointer-events: none;" {{ ($bahan != false ? 'checked' : '') }}/>
                                       <label class="form-check-label m-0">
                                       {{ ($bahan != false) ? $bahan : 'Kultur Bahan:' }}
                                       </label>
                                   </div>
                               </div>
                               <p class="fw-bold mb-0">SEROLOGI</p>
                               @php
                                   $serologi = $item->laboratoriumRequestDetails->where('category', 'Serologi')->pluck('name')->toArray();
                               @endphp
                               <div class="mb-3">
                                   <div class="form-check mt-1">
                                       <input type="checkbox" name="serologi[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Widal', $serologi) ? 'checked' : '' }}/>
                                       <label class="form-check-label m-0">
                                       Widal
                                       </label>
                                   </div>
                                   <div class="form-check mt-1">
                                       <input type="checkbox" name="serologi[]" class="form-check-input" style="pointer-events: none;" {{ in_array('VDRL', $serologi) ? 'checked' : '' }}/>
                                       <label class="form-check-label m-0">
                                       VDRL
                                       </label>
                                   </div>
                                   <div class="form-check mt-1">
                                       <input type="checkbox" name="serologi[]" class="form-check-input" style="pointer-events: none;" {{ in_array('TPHA', $serologi) ? 'checked' : '' }}/>
                                       <label class="form-check-label m-0">
                                       TPHA
                                       </label>
                                   </div>
                                   <div class="form-check mt-1">
                                       <input type="checkbox" name="serologi[]"  class="form-check-input" style="pointer-events: none;" {{ in_array('RF FAKTOR', $serologi) ? 'checked' : '' }}/>
                                       <label class="form-check-label m-0">
                                       RF FAKTOR
                                       </label>
                                   </div>
                                   <div class="form-check mt-1">
                                       <input type="checkbox" name="serologi[]" class="form-check-input" style="pointer-events: none;" {{ in_array('HIV', $serologi) ? 'checked' : '' }}/>
                                       <label class="form-check-label m-0">
                                       HIV
                                       </label>
                                   </div>
                               </div>
                               <div class="form-check mt-1">
                                <input type="checkbox" name="urine"  class="form-check-input" style="pointer-events: none;" {{ ($item->laboratoriumRequestDetails->where('category', 'Urine')->where('name', 'URINE LENGKAP')->first()) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0 fw-bold">
                                URINE LENGKAP
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="plano"  class="form-check-input" style="pointer-events: none;" {{ ($item->laboratoriumRequestDetails->where('category', 'Plano')->where('name', 'PLANO TEST')->first()) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0 fw-bold">
                                PLANO TEST
                                </label>
                            </div>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold mb-0">DIABETES</p>
                        @php
                            $diabetes = $item->laboratoriumRequestDetails->where('category', 'Diabetes')->pluck('name')->toArray();
                        @endphp
                        <div class="mb-3">
                            <div class="form-check mt-1">
                                <input type="checkbox" name="diabetes[]" style="pointer-events: none;" class="form-check-input" {{ in_array('Glukosa Darah Random', $diabetes) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Glukosa Darah Random
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="diabetes[]" style="pointer-events: none;" class="form-check-input" {{ in_array('Glukosa Darah Nuchter', $diabetes) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Glukosa Darah Nuchter
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="diabetes[]" style="pointer-events: none;" class="form-check-input" {{ in_array('Glukosa Darah 2 Jam PP', $diabetes) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Glukosa Darah 2 Jam PP
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="diabetes[]" style="pointer-events: none;" class="form-check-input" {{ in_array('HBA1C', $diabetes) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                HBA1C
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                @php
                                    $scales = array_filter($diabetes, function($diabet){
                                        return strpos($diabet, 'Sliding Scale Jam') !== false;
                                    });
                                    $scale = reset($scales);
                                @endphp
                                <input type="checkbox" name="diabetes[]" style="pointer-events: none;" class="form-check-input" {{ ($scale != false) ? 'checked' : '' }}  />
                                <label class="form-check-label m-0">
                                    {{ ($scale != false) ? $scale : 'Sliding Scale Jam' }}
                                </label>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">FAAL GINJAL</p>
                        @php
                            $ginjal = $item->laboratoriumRequestDetails->where('category', 'Faal Ginjal')->pluck('name')->toArray();
                        @endphp
                        <div class="mb-3">
                            <div class="form-check mt-1">
                                <input type="checkbox" name="faal[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Ureum', $ginjal) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Ureum
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="faal[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Creatinin', $ginjal) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Creatinin
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="faal[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Uric Acid', $ginjal) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Uric Acid
                                </label>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">FAAL HEPAR</p>
                        @php
                            $hepar = $item->laboratoriumRequestDetails->where('category', 'Faal Hepar')->pluck('name')->toArray();
                        @endphp
                        <div class="mb-3">
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepar[]" class="form-check-input" style="pointer-events: none;" {{ in_array('SGOT', $hepar) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                SGOT
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepar[]" class="form-check-input" style="pointer-events: none;" {{ in_array('SGPT', $hepar) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                SGPT
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepar[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Total Protein', $hepar) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Total Protein
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepar[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Albumin', $hepar) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Albumin
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepar[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Globulin', $hepar) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Globulin
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepar[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Total Bilirubin', $hepar) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Total Bilirubin
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepar[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Bilirubin Direct', $hepar) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Bilirubin Direct
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepar[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Bilirubin Indirect', $hepar) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Bilirubin Indirect
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepar[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Alkali Phospatase', $hepar) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Alkali Phospatase
                                </label>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">LEMAK</p>
                        @php
                            $lemak = $item->laboratoriumRequestDetails->where('category', 'Lemak')->pluck('name')->toArray();
                        @endphp
                        <div class="mb-3">
                            <div class="form-check mt-1">
                                <input type="checkbox" name="lemak[]"  class="form-check-input" style="pointer-events: none;" {{ in_array('Total Cholesterol', $lemak) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Total Cholesterol
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="lemak[]" class="form-check-input" style="pointer-events: none;" {{ in_array('HDL', $lemak) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                HDL
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="lemak[]" class="form-check-input" style="pointer-events: none;" {{ in_array('LDL', $lemak) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                LDL
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="lemak[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Trigliserida', $lemak) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Trigliserida
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold mb-0">TUMOR MARKER</p>
                        @php
                            $tumor = $item->laboratoriumRequestDetails->where('category', 'Tumor Marker')->pluck('name')->toArray();
                        @endphp
                        <div class="mb-3">
                            <div class="form-check mt-1">
                                <input type="checkbox" name="tumor-marker[]" class="form-check-input" style="pointer-events: none;" {{ in_array('AFP', $tumor) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                AFP
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="tumor-marker[]" class="form-check-input" style="pointer-events: none;" {{ in_array('CEA', $tumor) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                CEA
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="tumor-marker[]" class="form-check-input" style="pointer-events: none;" {{ in_array('PSA Total', $tumor) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                PSA Total
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="tumor-marker[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Free PSA', $tumor) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Free PSA
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="tumor-marker[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Ca 15-3', $tumor) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Ca 15-3
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="tumor-marker[]"class="form-check-input" style="pointer-events: none;" {{ in_array('Ca 125', $tumor) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Ca 125
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="tumor-marker[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Ca 19-9', $tumor) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Ca 19-9
                                </label>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">ENDOKRIN</p>
                        @php
                            $endokrin = $item->laboratoriumRequestDetails->where('category', 'Endokrin')->pluck('name')->toArray();
                        @endphp
                        <div class="mb-3">
                            <div class="form-check mt-1">
                                <input type="checkbox" name="endokrin[]" class="form-check-input" style="pointer-events: none;" {{ in_array('T3', $endokrin) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                T3
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="endokrin[]" class="form-check-input" style="pointer-events: none;" {{ in_array('T4', $endokrin) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                T4
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="endokrin[]" class="form-check-input" style="pointer-events: none;" {{ in_array('TSHs', $endokrin) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                TSHs
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="endokrin[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Free T4', $endokrin) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Free T4
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="endokrin[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Free T3', $endokrin) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Free T3
                                </label>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">HEPATITIS</p>
                        @php
                            $heptt = $item->laboratoriumRequestDetails->where('category', 'Hepatitis')->pluck('name')->toArray();
                        @endphp
                        <div class="mb-3">
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepatitis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('HBsAg', $heptt) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                HBsAg
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepatitis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Anti HBs', $heptt) ? 'checked' : '' }} />
                                <label class="form-check-label m-0">
                                Anti HBs
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepatitis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Anti Hbc IgG', $heptt) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Anti Hbc IgG
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepatitis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Anti HBc IgM', $heptt) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Anti HBc IgM
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepatitis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('HBeAg', $heptt) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                HBeAg
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepatitis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Anti Hbe', $heptt) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Anti Hbe
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepatitis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Anti HAV IgG', $heptt) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Anti HAV IgG
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepatitis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Anti HAV IgM', $heptt) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Anti HAV IgM
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="hepatitis[]" class="form-check-input" style="pointer-events: none;" {{ in_array('Anti HCV', $heptt) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Anti HCV
                                </label>
                            </div>
                        </div>
                        <p class="fw-bold mb-0">JANTUNG</p>
                        @php
                            $jantung = $item->laboratoriumRequestDetails->where('category', 'Jantung')->pluck('name')->toArray();
                        @endphp
                        <div class="mb-3">
                            <div class="form-check mt-1">
                                <input type="checkbox" name="jantung[]" class="form-check-input" style="pointer-events: none;" {{ in_array('CKMB', $jantung) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                CKMB
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="jantung[]"  class="form-check-input" style="pointer-events: none;" {{ in_array('CK NAC', $jantung) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                CK NAC
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="jantung[]"  class="form-check-input" style="pointer-events: none;" {{ in_array('Troponin T', $jantung) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Troponin T
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="jantung[]"  class="form-check-input" style="pointer-events: none;" {{ in_array('Troponin I', $jantung) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                Troponin I
                                </label>
                            </div>
                            <div class="form-check mt-1">
                                <input type="checkbox" name="jantung[]" class="form-check-input" style="pointer-events: none;" {{ in_array('LDH', $jantung) ? 'checked' : '' }}/>
                                <label class="form-check-label m-0">
                                LDH
                                </label>
                            </div>
                        </div>
                    </div>
                  
                <div class="row">
                    <div class="col-6 ">
                    </div>
                    @php
                        $bulanArray = [
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember',
                        ];
                    @endphp
                    <div class="col-6">
                        <p class="text-end" style="margin: 3mm;">Padang, {{ $item->created_at->format('d'). ' ' . $bulanArray[$item->created_at->format('n')]. ' ' . $item->created_at->format('Y') ?? '' }}</p>
                        <p class="text-end" style="margin: 3mm;">Dokter yang Meminta</p>
                        <br>
                        <br>
                        <p class="text-end mx-3">{{ $item->user->name ?? '' }}</p>
                    </div>
                </div>
              
        
             

        </div>
    </div>

</body>

</html>