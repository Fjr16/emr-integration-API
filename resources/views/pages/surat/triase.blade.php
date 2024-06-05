<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Triase</title>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css"
        />
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
                height: 29.7cm;
                min-height: 13.97cm;
                padding: 15mm;
                margin: 10mm auto;
                border: 1px #d3d3d3 solid;
                border-radius: 5px;
                background: white;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
                position: relative;
                font-size: 10pt;
            }

            .subpage {
                padding: 1cm;
                border: 5px red solid;
                height: 257mm;
                outline: 2cm #ffeaea solid;
            }

            /* table td {
                font-size: 8pt;
            } */

            .table-triase {
                font-size: 7pt;
            }

            .table-triase-2 {
                font-size: 8pt;
                padding: 0;
                margin: 0;
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
                    height: 29.7cm;
                }

                .page {
                    margin: 0;
                    border: initial;
                    border-radius: initial;
                    width: initial;
                    min-height: initial;
                    box-shadow: initial;
                    page-break-after: always;
                }
            }
        </style>
    </head>
    <body>
        @if (Route::is('igd/triase/print.allPrint', $item->id))
            @foreach ($item->queue->patient->igdTriages as $triage)
            <div class="page">
                <div class="header">
                    <div class="row">
                        <div class="col-2">
                            <img src="logo.png" alt="" />
                        </div>
                        <div class="col-7 d-flex align-self-center">
                            <h1 class="mx-auto">TRIASE</h1>
                        </div>
                        <div class="col-3">
                            <div
                                class="border border-3 border-rounded py-4 px-5"
                            ></div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <table class="table-bordered w-100 mt-2">
                        <tbody>
                            <tr>
                                <td class="px-2">
                                    <div class="row">
                                        <div class="col-6">
                                            Tanggal / Jam Masuk : {{ $triage->tanggal_masuk ? date('Y-m-d H:i', strtotime($triage->tanggal_masuk)) : '.............' }}
                                        </div>
                                        <div class="col-6 text-end">
                                            Jam Respon : {{ ($triage->jam_respon ?? '...............') }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row m-0 p-0">
                                        <div class="col-7 m-0 p-0">
                                            <p class="fw-bold m-0">
                                                Cara Masuk IGD :
                                            </p>
                                            <div class="mx-3">
                                                @foreach ($cara_masuk as $in)
                                                <div class="form-check form-check-inline">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="defaultCheck1"
                                                        {{ (($triage->cara_masuk ?? '') == $in) ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                    {{ (($triage->cara_masuk == $in) ? $triage->cara_masuk : $in) }}
                                                    </label>
                                                </div>
                                                @endforeach
                                                @if (!in_array($triage->cara_masuk, $cara_masuk))    
                                                <div class="form-check form-check-inline">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="defaultCheck1"
                                                        style="pointer-events: none;"
                                                        checked
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                    {{ $triage->cara_masuk ?? '' }}
                                                    </label>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-5 m-0 p-0">
                                            <p class="fw-bold m-0">Jenis Kasus :</p>
                                            <div class="mx-3">
                                                @foreach ($jenis_kasus as $kasus)
                                                    <div
                                                        class="form-check form-check-inline"
                                                    >
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            value=""
                                                            id="defaultCheck1"
                                                            {{ (($triage->jenis_kasus ?? '') == $kasus) ? 'checked' : '' }}
                                                            style="pointer-events: none;"
                                                        />
                                                        <label
                                                            class="form-check-label"
                                                        >
                                                            {{ $kasus ?? '' }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-7 m-0 p-0">
                                            <p class="fw-bold m-0">Asal Masuk :</p>
                                            <div class="mx-3">
                                                @foreach ($asal_masuk as $asal)    
                                                <div
                                                    class="form-check form-check-inline"
                                                >
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="defaultCheck1"
                                                        {{ (($triage->asal_masuk ?? '') == $asal) ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        {{ $asal }}
                                                    </label>
                                                </div>
                                                @endforeach
                                                @if (!in_array($triage->asal_masuk, $asal_masuk))
                                                <div class="form-check form-check-inline">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="defaultCheck1"
                                                        style="pointer-events: none;"
                                                        checked
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        {{ $triage->asal_masuk }}
                                                    </label>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="fw-bold m-0">Keluhan Utama :</p>
                                    <table
                                        class="table table-bordered table-triase"
                                    >
                                        <tr>
                                            <td rowspan="2">PEMERIKSAAN</td>
                                            <td colspan="10" class="text-center">
                                                SKALA
                                            </td>
                                            <td></td>
                                        </tr>
                                            @php
                                                $skala = $triage->igdTriageCheckups->first();
                                            @endphp
                                        <tr>
                                            <td
                                                colspan="6"
                                                class="bg-danger text-center"
                                            >
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="flexCheckDefault"
                                                        {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 1') ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        <span
                                                            class="fw-bold text-black"
                                                            >TRIASE 1 <br />
                                                            (RESUSITASI) <br />0
                                                            MENIT</span
                                                        >
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="bg-warning text-center">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="flexCheckDefault"
                                                        {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 2') ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        <span
                                                            class="fw-bold text-black"
                                                            >TRIASE 2 <br />
                                                            (EMERGENCY) <br />10
                                                            MENIT</span
                                                        >
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="bg-success text-center">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="flexCheckDefault"
                                                        {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 3') ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        <span
                                                            class="fw-bold text-black"
                                                            >TRIASE 3 <br />
                                                            (URGENT) <br />30
                                                            MENIT</span
                                                        >
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="bg-primary text-center">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="flexCheckDefault"
                                                        {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 4') ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        <span
                                                            class="fw-bold text-black"
                                                            >TRIASE 4 <br />
                                                            (LESS URGENT) <br />60
                                                            MENIT</span
                                                        >
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="flexCheckDefault"
                                                        {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 5') ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        <span
                                                            class="fw-bold text-black"
                                                            >TRIASE 5 <br />
                                                            (NON URGENT) <br />120
                                                            MENIT</span
                                                        >
                                                    </label>
                                                </div>
                                            </td>
                                            <td
                                                class="bg-dark text-light text-center"
                                            >
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="flexCheckDefault"
                                                        {{ $triage->igdTriageDoa ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        <span
                                                            class="fw-bold text-black"
                                                            >DEATH ON ARRIVAL <br />
                                                            (DOA)</span
                                                        >
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @foreach ($categories as $category)    
                                        <tr>
                                            <td colspan="6">{{ $category->name ?? '' }}</td>
                                            @foreach ($skalas as $skala)
                                            @foreach ($category->igdTriageCheckups->where('igd_triage_scale_id', $skala->id)->groupBy('igd_triage_scale_id') as $index => $checkups)
                                            @php
                                                $jml = $checkups->count();   
                                            @endphp
                                            <td>
                                                <div class="form-check">
                                                @for ($j = 0; $j<$jml; $j++)
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    value=""
                                                    id="{{ $checkups[$j]->id }}"
                                                    {{ (in_array($checkups[$j]->id, $triage->igdTriageCheckups->pluck('id')->toArray())) ? 'checked' : '' }}
                                                    style="pointer-events: none;"
                                                />
                                                
                                                <label class="form-check-label">
                                                    {{ $checkups[$j]->name ?? '' }}
                                                </label>
                                                <br>
                                                @endfor
                                                </div>
                                            </td>
                                            @endforeach
                                            @endforeach
                                            @if ($loop->first)  
                                            <td rowspan="6">
                                            <div class="form-check">
                                                <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="flexCheckDefault"
                                                {{ ($triage->igdTriageDoa->kehidupan ?? '' != null) ? 'checked' : '' }}
                                                style="pointer-events: none;"
                                                />
                                                <label class="form-check-label">
                                                tidak ada
                                                tanda kehidupan</label
                                                ><br />
                                                <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="flexCheckDefault"
                                                {{ ($triage->igdTriageDoa->nadi ?? '' != null) ? 'checked' : '' }}
                                                style="pointer-events: none;"
                                                />
                                                <label class="form-check-label">
                                                tidak ada enyut nadi</label
                                                ><br />
                                                <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="flexCheckDefault"
                                                {{ ($triage->igdTriageDoa->reflek ?? '' != null) ? 'checked' : '' }}
                                                style="pointer-events: none;"
                                                />
                                                <label class="form-check-label">
                                                reflek cahaya (-/-)</label
                                                ><br />
                                                <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="flexCheckDefault"
                                                {{ ($triage->igdTriageDoa->ekg ?? '' != null) ? 'checked' : '' }}
                                                style="pointer-events: none;"
                                                />
                                                <label class="form-check-label">
                                                ekg flat</label
                                                ><br />
                                                <p>jam doa <b>{{ ($triage->igdTriageDoa->jam_doa ?? '' != null) ? $triage->igdTriageDoa->jam_doa : '.......' }}</b></p>
                                            </div>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                        
                                        
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="fw-bold m-0">
                                        Ket : Pada tingkat kegawatan, berikan tanda
                                        centang (√) , pada kolom yang tersedia
                                    </p>
                                    <p class="text-uppercase fw-bold m-0">
                                        intervensi dan responsnya
                                        <br />tindakan/medikamentosa
                                    </p>
                                    <table
                                        class="table-bordered text-uppercase w-100 table-triase-2"
                                    >
                                        <tr class="border border-1">
                                            <td class="fw-bold" style="width: 20%">jalan nafas</td>
                                            <td>{{ $triage->jalan_nafas ?? '' }}</td>
                                        </tr>
                                        <tr class="border border-1">
                                            <td class="fw-bold"  style="width: 20%">pernapasan</td>
                                            <td>{{ $triage->pernapasan ?? '' }}</td>
                                        </tr>
                                        <tr class="border border-1">
                                            <td class="fw-bold"  style="width: 20%">sirkulasi</td>
                                            <td>{{ $triage->sirkulasi ?? '' }}</td>
                                        </tr>
                                        <tr class="border border-1">
                                            <td class="fw-bold"  style="width: 20%">disabilitas</td>
                                            <td>{{ $triage->disabilitas ?? '' }}</td>
                                        </tr>
                                        <tr class="border border-1">
                                            <td class="fw-bold"  style="width: 20%">lain-lain</td>
                                            <td>{{ $triage->lain ?? '' }}</td>
                                        </tr>
                                    </table>
                                    <div class="row mt-2">
                                        <div class="col-2"></div>
                                        <div class="col-3 text-center">
                                            Dokter IGD
                                            <br /><br /><br /><br />
                                            ({{ $item->user->name ?? '' }})
                                        </div>
                                        <div class="col-2"></div>
                                        <div class="col-3 text-center">
                                            Petugas Triase
                                            <br /><br /><br /><br />
                                            ({{ $triage->user->name ?? '' }})
                                        </div>
                                        <div class="col-2"></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        @else
            <div class="page">
                <div class="header">
                    <div class="row">
                        <div class="col-2">
                            <img src="logo.png" alt="" />
                        </div>
                        <div class="col-7 d-flex align-self-center">
                            <h1 class="mx-auto">TRIASE</h1>
                        </div>
                        <div class="col-3">
                            <div
                                class="border border-3 border-rounded py-4 px-5"
                            ></div>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <table class="table-bordered w-100 mt-2">
                        <tbody>
                            <tr>
                                <td class="px-2">
                                    <div class="row">
                                        <div class="col-6">
                                            Tanggal / Jam Masuk : {{ $item->tanggal_masuk ? date('Y-m-d H:i', strtotime($item->tanggal_masuk)) : '.............' }}
                                        </div>
                                        <div class="col-6 text-end">
                                            Jam Respon : {{ ($item->jam_respon ?? '...............') }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="row m-0 p-0">
                                        <div class="col-7 m-0 p-0">
                                            <p class="fw-bold m-0">
                                                Cara Masuk IGD :
                                            </p>
                                            <div class="mx-3">
                                                @foreach ($cara_masuk as $in)
                                                <div class="form-check form-check-inline">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="defaultCheck1"
                                                        {{ (($item->cara_masuk ?? '') == $in) ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                    {{ (($item->cara_masuk == $in) ? $item->cara_masuk : $in) }}
                                                    </label>
                                                </div>
                                                @endforeach
                                                @if (!in_array($item->cara_masuk, $cara_masuk))    
                                                <div class="form-check form-check-inline">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="defaultCheck1"
                                                        style="pointer-events: none;"
                                                        checked
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                    {{ $item->cara_masuk ?? '' }}
                                                    </label>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-5 m-0 p-0">
                                            <p class="fw-bold m-0">Jenis Kasus :</p>
                                            <div class="mx-3">
                                                @foreach ($jenis_kasus as $kasus)
                                                    <div
                                                        class="form-check form-check-inline"
                                                    >
                                                        <input
                                                            class="form-check-input"
                                                            type="checkbox"
                                                            value=""
                                                            id="defaultCheck1"
                                                            {{ (($item->jenis_kasus ?? '') == $kasus) ? 'checked' : '' }}
                                                            style="pointer-events: none;"
                                                        />
                                                        <label
                                                            class="form-check-label"
                                                        >
                                                            {{ $kasus ?? '' }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-7 m-0 p-0">
                                            <p class="fw-bold m-0">Asal Masuk :</p>
                                            <div class="mx-3">
                                                @foreach ($asal_masuk as $asal)    
                                                <div
                                                    class="form-check form-check-inline"
                                                >
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="defaultCheck1"
                                                        {{ (($item->asal_masuk ?? '') == $asal) ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        {{ $asal }}
                                                    </label>
                                                </div>
                                                @endforeach
                                                @if (!in_array($item->asal_masuk, $asal_masuk))
                                                <div class="form-check form-check-inline">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="defaultCheck1"
                                                        style="pointer-events: none;"
                                                        checked
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        {{ $item->asal_masuk }}
                                                    </label>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="fw-bold m-0">Keluhan Utama :</p>
                                    <table
                                        class="table table-bordered table-triase"
                                    >
                                        <tr>
                                            <td rowspan="2">PEMERIKSAAN</td>
                                            <td colspan="10" class="text-center">
                                                SKALA
                                            </td>
                                            <td></td>
                                        </tr>
                                            @php
                                                $skala = $item->igdTriageCheckups->first();
                                            @endphp
                                        <tr>
                                            <td
                                                colspan="6"
                                                class="bg-danger text-center"
                                            >
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="flexCheckDefault"
                                                        {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 1') ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        <span
                                                            class="fw-bold text-black"
                                                            >TRIASE 1 <br />
                                                            (RESUSITASI) <br />0
                                                            MENIT</span
                                                        >
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="bg-warning text-center">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="flexCheckDefault"
                                                        {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 2') ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        <span
                                                            class="fw-bold text-black"
                                                            >TRIASE 2 <br />
                                                            (EMERGENCY) <br />10
                                                            MENIT</span
                                                        >
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="bg-success text-center">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="flexCheckDefault"
                                                        {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 3') ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        <span
                                                            class="fw-bold text-black"
                                                            >TRIASE 3 <br />
                                                            (URGENT) <br />30
                                                            MENIT</span
                                                        >
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="bg-primary text-center">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="flexCheckDefault"
                                                        {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 4') ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        <span
                                                            class="fw-bold text-black"
                                                            >TRIASE 4 <br />
                                                            (LESS URGENT) <br />60
                                                            MENIT</span
                                                        >
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="flexCheckDefault"
                                                        {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 5') ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        <span
                                                            class="fw-bold text-black"
                                                            >TRIASE 5 <br />
                                                            (NON URGENT) <br />120
                                                            MENIT</span
                                                        >
                                                    </label>
                                                </div>
                                            </td>
                                            <td
                                                class="bg-dark text-light text-center"
                                            >
                                                <div class="form-check">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        value=""
                                                        id="flexCheckDefault"
                                                        {{ $item->igdTriageDoa ? 'checked' : '' }}
                                                        style="pointer-events: none;"
                                                    />
                                                    <label
                                                        class="form-check-label"
                                                    >
                                                        <span
                                                            class="fw-bold text-black"
                                                            >DEATH ON ARRIVAL <br />
                                                            (DOA)</span
                                                        >
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @foreach ($categories as $category)    
                                        <tr>
                                            <td colspan="6">{{ $category->name ?? '' }}</td>
                                            @foreach ($skalas as $skala)
                                            @foreach ($category->igdTriageCheckups->where('igd_triage_scale_id', $skala->id)->groupBy('igd_triage_scale_id') as $index => $checkups)
                                            @php
                                                $jml = $checkups->count();   
                                            @endphp
                                            <td>
                                                <div class="form-check">
                                                @for ($j = 0; $j<$jml; $j++)
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    value=""
                                                    id="{{ $checkups[$j]->id }}"
                                                    {{ (in_array($checkups[$j]->id, $item->igdTriageCheckups->pluck('id')->toArray())) ? 'checked' : '' }}
                                                    style="pointer-events: none;"
                                                />
                                                
                                                <label class="form-check-label">
                                                    {{ $checkups[$j]->name ?? '' }}
                                                </label>
                                                <br>
                                                @endfor
                                                </div>
                                            </td>
                                            @endforeach
                                            @endforeach
                                            @if ($loop->first)  
                                            <td rowspan="6">
                                            <div class="form-check">
                                                <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="flexCheckDefault"
                                                {{ ($item->igdTriageDoa->kehidupan ?? '' != null) ? 'checked' : '' }}
                                                style="pointer-events: none;"
                                                />
                                                <label class="form-check-label">
                                                tidak ada
                                                tanda kehidupan</label
                                                ><br />
                                                <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="flexCheckDefault"
                                                {{ ($item->igdTriageDoa->nadi ?? '' != null) ? 'checked' : '' }}
                                                style="pointer-events: none;"
                                                />
                                                <label class="form-check-label">
                                                tidak ada enyut nadi</label
                                                ><br />
                                                <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="flexCheckDefault"
                                                {{ ($item->igdTriageDoa->reflek ?? '' != null) ? 'checked' : '' }}
                                                style="pointer-events: none;"
                                                />
                                                <label class="form-check-label">
                                                reflek cahaya (-/-)</label
                                                ><br />
                                                <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="flexCheckDefault"
                                                {{ ($item->igdTriageDoa->ekg ?? '' != null) ? 'checked' : '' }}
                                                style="pointer-events: none;"
                                                />
                                                <label class="form-check-label">
                                                ekg flat</label
                                                ><br />
                                                <p>jam doa <b>{{ ($item->igdTriageDoa->jam_doa ?? '' != null) ? $item->igdTriageDoa->jam_doa : '.......' }}</b></p>
                                            </div>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                        
                                        
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="fw-bold m-0">
                                        Ket : Pada tingkat kegawatan, berikan tanda
                                        centang (√) , pada kolom yang tersedia
                                    </p>
                                    <p class="text-uppercase fw-bold m-0">
                                        intervensi dan responsnya
                                        <br />tindakan/medikamentosa
                                    </p>
                                    <table
                                        class="table-bordered text-uppercase w-100 table-triase-2"
                                    >
                                        <tr class="border border-1">
                                            <td class="fw-bold" style="width: 20%">jalan nafas</td>
                                            <td>{{ $item->jalan_nafas ?? '' }}</td>
                                        </tr>
                                        <tr class="border border-1">
                                            <td class="fw-bold"  style="width: 20%">pernapasan</td>
                                            <td>{{ $item->pernapasan ?? '' }}</td>
                                        </tr>
                                        <tr class="border border-1">
                                            <td class="fw-bold"  style="width: 20%">sirkulasi</td>
                                            <td>{{ $item->sirkulasi ?? '' }}</td>
                                        </tr>
                                        <tr class="border border-1">
                                            <td class="fw-bold"  style="width: 20%">disabilitas</td>
                                            <td>{{ $item->disabilitas ?? '' }}</td>
                                        </tr>
                                        <tr class="border border-1">
                                            <td class="fw-bold"  style="width: 20%">lain-lain</td>
                                            <td>{{ $item->lain ?? '' }}</td>
                                        </tr>
                                    </table>
                                    <div class="row mt-2">
                                        <div class="col-2"></div>
                                        <div class="col-3 text-center">
                                            Dokter IGD
                                            <br /><br /><br /><br />
                                            ({{ $dokter->name ?? '' }})
                                        </div>
                                        <div class="col-2"></div>
                                        <div class="col-3 text-center">
                                            Petugas Triase
                                            <br /><br /><br /><br />
                                            ({{ $item->user->name ?? '' }})
                                        </div>
                                        <div class="col-2"></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif



        <script>
            // Mendapatkan tanggal saat ini
            var today = new Date();
            var options = { year: "numeric", month: "long", day: "numeric" };
            document.getElementById("tanggal").innerText =
                today.toLocaleDateString("id-ID", options);
        </script>
    </body>
</html>
