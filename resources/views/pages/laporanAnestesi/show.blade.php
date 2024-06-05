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
                font-size: 8pt !important;
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
                        <h1 class="text-center uppercase mt-2">
                            LAPORAN ANESTESI
                        </h1>
                    </div>
                </div>
            </div>

            <div class="content">
                <section class="mt-5">
                    <div>
                        <div>
                            <div class="flex gap-x-3">
                                <p>1.</p>
                                <p>Infus Perifer : Tempat dan Ukuran</p>
                            </div>
                            <div class="pl-6">
                                <div class="flex gap-x-1">
                                    <p>1.</p>
                                    <div class="flex w-full pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->perifer_first ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-x-1">
                                    <p>2.</p>
                                    <div class="flex w-full pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->perifer_second ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="flex py-1 gap-x-2">
                                    <p class="w-[40px]">CVC :</p>
                                    <div class="flex w-full pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->perifer_cvc ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="flex gap-x-3">
                                <p>2.</p>
                                <p>Posisi</p>
                            </div>
                            <div class="grid grid-cols-12 py-1 pl-6">
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox" style="pointer-events: none;"
                                    {{ $item->posisi == 'Telentang' ? 'checked' : '' }}/>
                                    <p>Telentang</p>
                                </div>
                                <div class="flex col-span-10 gap-x-2">
                                    <input type="checkbox" style="pointer-events: none;"
                                    {{ $item->posisi == 'Lateral Kiri' ? 'checked' : '' }}/>
                                    <p>Lateral Kiri</p>
                                </div>
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox" style="pointer-events: none;"
                                    {{ $item->posisi == 'Lithotomi' ? 'checked' : '' }}/>
                                    <p>Lithotomi</p>
                                </div>
                                <div class="flex col-span-6 gap-x-2">
                                    <input type="checkbox" style="pointer-events: none;"
                                    {{ $item->posisi == 'Lateral Kanan' ? 'checked' : '' }}/>
                                    <p>Lateral Kanan</p>
                                </div>
                                <div class="flex col-span-6 gap-x-2">
                                    <input type="checkbox" style="pointer-events: none;"
                                    {{ $item->posisi == 'Prone' ? 'checked' : '' }}/>
                                    <p>Prone</p>
                                </div>
                                <div class="flex col-span-12 gap-x-2">
                                    @php
                                        $posisi = null;
                                        if (!in_array($item->posisi, $posisis)){
                                            $posisi = $item->posisi;
                                        }
                                    @endphp
                                    <input type="checkbox" style="pointer-events: none;"
                                    {{ $posisi ? 'checked' : '' }}/>
                                    <p class="w-[95px]">Lain - lain</p>
                                    <div class="flex w-full pb-1">
                                        <p
                                            class="w-[50%] border-b border-black"
                                        >{{ $posisi ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-x-20">
                            <div class="flex gap-x-3">
                                <p>3.</p>
                                <p>Perlindungan Mata :</p>
                            </div>
                            <div class="flex gap-x-2">
                                <input type="checkbox" {{ $item->perlindungan_mata == 'Kanan' ? 'checked' : '' }}
                                @style('pointer-events:none;')/>
                                <p>Kanan</p>
                            </div>
                            <div class="flex gap-x-2">
                                <input type="checkbox" {{ $item->perlindungan_mata == 'Kiri' ? 'checked' : '' }}
                                @style('pointer-events:none;')/>
                                <p>Kiri</p>
                            </div>
                        </div>

                        <div class="">
                            <div class="flex gap-x-3">
                                <p>4.</p>
                                <p>Premedikasi</p>
                            </div>
                            <div class="grid grid-cols-12 py-1 pl-6">
                                <div class="flex col-span-1 gap-x-2">
                                    <input type="checkbox"  {{ $item->pre_oral ? 'checked' : '' }}
                                    @style('pointer-events:none;')/>
                                    <p>Oral</p>
                                </div>
                                <div class="col-span-1">
                                    <p class="px-2 text-end">:</p>
                                </div>
                                <div class="flex w-full col-span-10 pb-1">
                                    <p class="w-full border-b border-black">{{ $item->pre_oral ?? '' }}</p>
                                </div>

                                <div class="flex col-span-1 gap-x-2">
                                    <input type="checkbox" {{ $item->pre_im ? 'checked' : '' }}
                                    @style('pointer-events:none;')/>
                                    <p>I.M</p>
                                </div>
                                <div class="col-span-1">
                                    <p class="px-2 text-end">:</p>
                                </div>
                                <div class="flex w-full col-span-10 pb-1">
                                    <p class="w-full border-b border-black">{{ $item->pre_im ?? '' }}</p>
                                </div>

                                <div class="flex col-span-1 gap-x-2">
                                    <input type="checkbox" {{ $item->pre_iv ? 'checked' : '' }}
                                    @style('pointer-events:none;')/>
                                    <p>I.V</p>
                                </div>
                                <div class="col-span-1">
                                    <p class="px-2 text-end">:</p>
                                </div>
                                <div class="flex w-full col-span-10 pb-1">
                                    <p class="w-full border-b border-black">{{ $item->pre_iv ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="flex gap-x-3">
                                <p>5.</p>
                                <p>Induksi</p>
                            </div>
                            <div class="grid grid-cols-12 py-1 pl-6">
                                <div class="flex col-span-1 gap-x-2">
                                    <input type="checkbox" {{ $item->induksi_intravena ? 'checked' : '' }}
                                    @style('pointer-events:none;')/>
                                    <p>Intravena</p>
                                </div>
                                <div class="col-span-1">
                                    <p class="px-2 text-end">:</p>
                                </div>
                                <div class="flex w-full col-span-10 pb-1">
                                    <p class="w-full border-b border-black">{{ $item->induksi_intravena ?? '' }}</p>
                                </div>

                                <div class="flex col-span-1 gap-x-2">
                                    <input type="checkbox" {{ $item->induksi_inhalasi ? 'checked' : '' }}
                                    @style('pointer-events:none;')/>
                                    <p>Inhalasi</p>
                                </div>
                                <div class="col-span-1">
                                    <p class="px-2 text-end">:</p>
                                </div>
                                <div class="flex w-full col-span-10 pb-1">
                                    <p class="w-full border-b border-black">{{ $item->induksi_inhalasi ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="flex gap-x-3">
                                <p>6.</p>
                                <p>Tata Laksana Jalan Nafas</p>
                            </div>
                            <div class="grid grid-cols-12 py-1 pl-6">
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox" {{ $item->anestesiReportAirway->face_mask_no ? 'checked' : '' }}
                                    @style('pointer-events:none;')/>
                                    <p>Face Mask</p>
                                </div>
                                <div class="flex col-span-10 gap-x-2">
                                    <p>No</p>
                                    <div class="flex w-[10%] pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->anestesiReportAirway->face_mask_no ?? '' }}</p>
                                    </div>
                                    <p>Oro/Nasopharing</p>
                                </div>
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox"     {{ $item->anestesiReportAirway->ett_no ? 'checked' : '' }}
                                    @style('pointer-events:none;')/>
                                    <p>ETT</p>
                                </div>
                                <div class="flex col-span-10 gap-x-2">
                                    <p>No</p>
                                    <div class="flex w-[10%] pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->anestesiReportAirway->ett_no ?? '' }}</p>
                                    </div>
                                    <p>Jenis</p>
                                    <div class="flex w-[20%] pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->anestesiReportAirway->ett_jenis ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox" {{ $item->anestesiReportAirway->lma_no ? 'checked' : '' }}
                                    @style('pointer-events:none;')/>
                                    <p>LMA</p>
                                </div>
                                <div class="flex col-span-10 gap-x-2">
                                    <p>No</p>
                                    <div class="flex w-[10%] pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->anestesiReportAirway->lma_no ?? '' }}</p>
                                    </div>
                                    <p>Jenis</p>
                                    <div class="flex w-[20%] pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->anestesiReportAirway->lma_jenis ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox" {{ $item->anestesiReportAirway->trakheostomi_no ? 'checked' : '' }}
                                    @style('pointer-events:none;')/>
                                    <p>Trakheostomi</p>
                                </div>
                                <div class="flex col-span-10 gap-x-2">
                                    <p>No</p>
                                    <div class="flex w-[10%] pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->anestesiReportAirway->trakheostomi_no ?? '' }}</p>
                                    </div>
                                    <p>Jenis</p>
                                    <div class="flex w-[20%] pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->anestesiReportAirway->trakheostomi_jenis ?? '' }}</p>
                                    </div>
                                </div>
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox" {{ $item->anestesiReportAirway->glidescope_no ? 'checked' : '' }}
                                    @style('pointer-events:none;')/>
                                    <p>Glidescope</p>
                                </div>
                                <div class="flex col-span-10 gap-x-2">
                                    <p>No</p>
                                    <div class="flex w-[10%] pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->anestesiReportAirway->glidescope_no ?? '' }}</p>
                                    </div>
                                </div>
                                <div
                                    class="flex col-span-10 col-start-3 gap-x-2"
                                >
                                    <p>Fiksasi</p>
                                    <div class="flex w-[10%] pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->anestesiReportAirway->glidescope_fiksasi ?? '' }}</p>
                                    </div>
                                    <p>cm</p>
                                </div>
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox" {{ $item->anestesiReportAirway->other_airway ? 'checked' : '' }}
                                    @style('pointer-events:none;')/>
                                    <p>Lain-lain</p>
                                </div>
                                <div class="flex col-span-10 gap-x-2">
                                    <div class="flex w-[37%] pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->anestesiReportAirway->other_airway ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="flex gap-x-3">
                                <p>7.</p>
                                <p>Intubasi</p>
                            </div>
                            <div class="grid grid-cols-12 py-1 pl-6">
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox" {{ in_array('Sesudah Tidur', $item->anestesiReportIntubasis->pluck('name')->toArray()) ? 'checked' : '' }}
                                    @style('pointer-events:none;')/>
                                    <p>Sesudah tidur</p>
                                </div>
                                <div class="flex col-span-10 gap-x-2">
                                    <input type="checkbox"  @style('pointer-events:none;')
                                    {{ in_array('Blind', $item->anestesiReportIntubasis->pluck('name')->toArray()) ? 'checked' : '' }}/>
                                    <p>Blind</p>
                                </div>
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox" @style('pointer-events:none;')
                                    {{ in_array('Oral', $item->anestesiReportIntubasis->pluck('name')->toArray()) ? 'checked' : '' }}/>
                                    <p>Oral</p>
                                </div>
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox" @style('pointer-events:none;')
                                    {{ in_array('Nasal Kanan', $item->anestesiReportIntubasis->pluck('name')->toArray()) ? 'checked' : '' }}/>
                                    <p>Nasal Kanan</p>
                                </div>
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox" @style('pointer-events:none;')
                                    {{ in_array('Nasal Kiri', $item->anestesiReportIntubasis->pluck('name')->toArray()) ? 'checked' : '' }}/>
                                    <p>Nasal Kiri</p>
                                </div>
                                <div class="flex col-span-12 gap-x-2">
                                    <input type="checkbox" @style('pointer-events:none;')
                                    {{ in_array('Trakheostomi', $item->anestesiReportIntubasis->pluck('name')->toArray()) ? 'checked' : '' }}/>
                                    <p>Trakheostomi</p>
                                </div>
                                <div
                                    class="grid grid-cols-12 col-span-12 gap-x-2"
                                >
                                    <div class="flex col-span-2 gap-x-2">
                                        <input type="checkbox" @style('pointer-events:none;')
                                        {{ in_array('Sulit ventilasi', $item->anestesiReportIntubasis->pluck('name')->toArray()) ? 'checked' : '' }}/>
                                        <p>Sulit ventilasi</p>
                                    </div>
                                    <div class="flex col-span-10 gap-x-2">
                                        <p>:</p>
                                        <div class="flex w-full pb-1">
                                            <p
                                                class="w-full border-b border-black"
                                            >{{ $item->anestesiReportIntubasis->where('name', 'Sulit ventilasi')->pluck('value')->first() ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-12 col-span-12 gap-x-2"
                                >
                                    <div class="flex col-span-2 gap-x-2">
                                        <input type="checkbox" @style('pointer-events:none;')
                                        {{ in_array('Sulit intubasi', $item->anestesiReportIntubasis->pluck('name')->toArray()) ? 'checked' : '' }}/>
                                        <p>Sulit intubasi</p>
                                    </div>
                                    <div class="flex col-span-10 gap-x-2">
                                        <p>:</p>
                                        <div class="flex w-full pb-1">
                                            <p
                                                class="w-full border-b border-black"
                                            >{{ $item->anestesiReportIntubasis->where('name', 'Sulit intubasi')->pluck('value')->first() ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox" @style('pointer-events:none;')
                                    {{ in_array('Dengan Stilet', $item->anestesiReportIntubasis->pluck('name')->toArray()) ? 'checked' : '' }}/>
                                    <p>Dengan Stilet</p>
                                </div>
                                <div class="flex col-span-10 gap-x-2">
                                    <input type="checkbox" @style('pointer-events:none;')
                                    {{ in_array('Level ETT', $item->anestesiReportIntubasis->pluck('name')->toArray()) ? 'checked' : '' }}/>
                                    <p>Level ETT</p>
                                </div>
                                <div class="flex col-span-2 gap-x-2">
                                    <input type="checkbox" @style('pointer-events:none;')
                                    {{ in_array('Cuff', $item->anestesiReportIntubasis->pluck('name')->toArray()) ? 'checked' : '' }}/>
                                    <p>Cuff</p>
                                </div>
                                <div class="flex col-span-10 gap-x-2">
                                    <input type="checkbox" @style('pointer-events:none;')
                                    {{ in_array('Pack', $item->anestesiReportIntubasis->pluck('name')->toArray()) ? 'checked' : '' }}/>
                                    <p>Pack</p>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="flex gap-x-3">
                                <p>8.</p>
                                <p>Ventilasi</p>
                            </div>
                            <div class="grid grid-cols-12 py-1 pl-6">
                                <div class="flex col-span-12 gap-x-2">
                                    <input type="checkbox" {{ in_array('Spontan', $item->anestesiReportVentilations->pluck('name')->toArray()) ? 'checked' : '' }}
                                    @style('pointer-events:none;')/>
                                    <p>Spontan</p>
                                </div>
                                <div class="flex col-span-12 gap-x-2">
                                    <input type="checkbox" @style('pointer-events:none;') {{ in_array('Kendali', $item->anestesiReportVentilations->pluck('name')->toArray()) ? 'checked' : '' }}/>
                                    <p>Kendali</p>
                                </div>
                                <div class="grid grid-cols-12 col-span-12 gap-x-2">
                                    @php
                                        $checkOrNot = '';
                                        if (in_array('TV', $item->anestesiReportVentilations->pluck('name')->toArray()) || in_array('RR', $item->anestesiReportVentilations->pluck('name')->toArray()) || in_array('PEEP', $item->anestesiReportVentilations->pluck('name')->toArray())) {
                                            $checkOrNot = 'checked';
                                        }

                                        $otherVentilator = null;
                                        foreach ($item->anestesiReportVentilations as $ventilasi) {
                                            if (!in_array($ventilasi->name, ['Spontan', 'Kendali', 'TV', 'RR', 'PEEP'])) {
                                                $otherVentilator = $ventilasi->name;
                                            }
                                        }
                                    @endphp
                                    <div class="flex col-span-2 gap-x-2">
                                        <input type="checkbox" @style('pointer-events:none;') {{ $checkOrNot ?? '' }} />
                                        <p>Ventilator</p>
                                    </div>
                                    <div class="flex col-span-10 gap-x-2">
                                        <p>:</p>
                                        <p>TV</p>
                                        <div class="flex w-[10%] pb-1">
                                            <p
                                                class="w-full border-b border-black"
                                            >{{ $item->anestesiReportVentilations->where('name', 'TV')->pluck('value')->first() ?? '' }}</p>
                                        </div>
                                        <p>RR</p>
                                        <div class="flex w-[10%] pb-1">
                                            <p
                                                class="w-full border-b border-black"
                                            >{{ $item->anestesiReportVentilations->where('name', 'RR')->pluck('value')->first() ?? '' }}</p>
                                        </div>
                                        <p>PEEP</p>
                                        <div class="flex w-[10%] pb-1">
                                            <p
                                                class="w-full border-b border-black"
                                            >{{ $item->anestesiReportVentilations->where('name', 'PEEP')->pluck('value')->first() ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-12 col-span-12 gap-x-2"
                                >
                                    <div class="flex col-span-2 gap-x-2">
                                        <input type="checkbox" {{ $otherVentilator ? 'checked' : '' }}
                                        @style('pointer-events:none;')/>
                                        <p>Lain-lain</p>
                                    </div>
                                    <div class="flex col-span-10 gap-x-2">
                                        <p>: {{ $otherVentilator ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="flex gap-x-3">
                                <p>9.</p>
                                <p>Teknik Regional/Blok Perifer</p>
                            </div>
                            <div class="py-1 pl-6">
                                <div class="grid grid-cols-12 gap-x-2">
                                    <div class="flex col-span-2 gap-x-2">
                                        <p>Jenis</p>
                                    </div>
                                    <div class="flex col-span-10 gap-x-2">
                                        <p>:</p>
                                        <div class="flex w-full pb-1">
                                            <p
                                                class="w-full border-b border-black"
                                            >{!! $item->anestesiReportPerifer->jenis ?? '' !!} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-x-2">
                                    <div
                                        class="flex col-span-10 col-start-3 py-4 pl-3 gap-x-2"
                                    >
                                        <div class="flex w-full">
                                            <p
                                                class="w-full border-b border-black"
                                            ></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-x-2">
                                    <div class="flex col-span-2 gap-x-2">
                                        <p>Lokasi</p>
                                    </div>
                                    <div class="flex col-span-10 gap-x-2">
                                        <p>:</p>
                                        <div class="flex w-full pb-1">
                                            <p
                                                class="w-full border-b border-black"
                                            >{{ $item->anestesiReportPerifer->lokasi ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-x-2">
                                    <div class="flex col-span-2 gap-x-2">
                                        <p>Jenis Jarum / No</p>
                                    </div>
                                    <div class="flex col-span-10 gap-x-2">
                                        <p>:</p>
                                        <div class="flex w-full pb-1">
                                            <p
                                                class="w-full border-b border-black"
                                            >{{ $item->anestesiReportPerifer->jenis_jarum ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-x-2">
                                    <div class="flex col-span-2 gap-x-2">
                                        <p>Kateter</p>
                                    </div>
                                    <div class="flex col-span-10 gap-x-2">
                                        <p>:</p>
                                        <div class="flex gap-x-2">
                                            <input type="checkbox" @style('pointer-events:none;')
                                            {{ $item->anestesiReportPerifer->kateter == true ? 'checked' : ''  }}/>
                                            <p>Ya</p>
                                        </div>
                                        <div class="flex px-10 gap-x-2">
                                            <input type="checkbox" @style('pointer-events:none;')
                                            {{ $item->anestesiReportPerifer->kateter == false ? 'checked' : ''  }}/>
                                            <p>Tidak</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-x-2">
                                    <div
                                        class="flex col-span-10 col-start-3 pl-3 gap-x-2"
                                    >
                                        <p>Fiksasi</p>
                                        <div class="flex w-[10%] pb-1">
                                            <p
                                                class="w-full border-b border-black"
                                            >{{ $item->anestesiReportPerifer->kateter_fiksasi ?? '' }}</p>
                                        </div>
                                        <p>cm</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-x-2">
                                    <div class="flex col-span-2 gap-x-2">
                                        <p>Obat - obat</p>
                                    </div>
                                    <div class="flex col-span-10 gap-x-2">
                                        <p>:</p>
                                        <div class="flex w-full pb-1">
                                            <p
                                                class="w-full border-b border-black"
                                            >{!!  $item->anestesiReportPerifer->obat ?? ''  !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-x-2">
                                    <div
                                        class="flex col-span-10 col-start-3 py-4 pl-3 gap-x-2"
                                    >
                                        <div class="flex w-full">
                                            <p
                                                class="w-full border-b border-black"
                                            ></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-x-2">
                                    <div class="flex col-span-2 gap-x-2">
                                        <p>Komplikasi</p>
                                    </div>
                                    <div class="flex col-span-10 gap-x-2">
                                        <p>:</p>
                                        <div class="flex w-full pb-1">
                                            <p
                                                class="w-full border-b border-black"
                                            >{!! $item->anestesiReportPerifer->komplikasi ?? '' !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-x-2">
                                    <div
                                        class="flex col-span-10 col-start-3 py-4 pl-3 gap-x-2"
                                    >
                                        <div class="flex w-full">
                                            <p
                                                class="w-full border-b border-black"
                                            ></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-x-2">
                                    <div class="flex col-span-2 gap-x-2">
                                        <p>Hasil</p>
                                    </div>
                                    <div class="flex col-span-10 gap-x-2">
                                        <p>:</p>
                                        <div class="flex gap-x-2">
                                            <input type="checkbox" @style('pointer-events:none;')
                                            {{ $item->anestesiReportPerifer->hasil == 'Total Blok' ? 'checked' : '' }}/>
                                            <p>Total Blok</p>
                                        </div>
                                        <div class="flex px-10 gap-x-2">
                                            <input type="checkbox" @style('pointer-events:none;')
                                            {{ $item->anestesiReportPerifer->hasil == 'Partial' ? 'checked' : '' }}/>
                                            <p>Partial</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-x-2">
                                    <div
                                        class="flex col-span-10 col-start-3 pl-3 gap-x-2"
                                    >
                                        <div class="flex gap-x-2">
                                            <input type="checkbox" @style('pointer-events:none;')
                                            {{ $item->anestesiReportPerifer->hasil == 'Gagal' ? 'checked' : '' }}/>
                                            <p>Gagal</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="page">
            <div class="header">
                <div class="grid grid-cols-4 gap-4">
                    <div class="...">
                        <img src="logo.png" alt="" />
                    </div>
                    <div class="col-span-2">
                        <h1 class="text-center uppercase mt-2">
                            LAPORAN ANESTESI
                        </h1>
                    </div>
                </div>
            </div>

            <div class="content">
                <section>
                    <div>
                        <table class="my-4">
                            <thead>
                                <tr>
                                    <td class="w-56 text-center">
                                        Obat - obatan / infus
                                    </td>
                                    <script>
                                        for (var i = 0; i < 4; i++) {
                                            document.write("<td></td>");
                                        }
                                    </script>
                                    <td class="w-20 text-center">Jumlah</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->anestesiReportMedicine->anestesiReportMedicineDetails as $detailMedicine)
                                    <tr>
                                        <td class="px-2 border border-black">
                                            {{ $detailMedicine->medicine->name ?? '' }}
                                        </td>
                                        <td class="border border-black w-5">
                                            {{ $detailMedicine->medicine_value ?? '' }}
                                        </td>
                                        <td class="border border-black w-5"></td>
                                        <td class="border border-black w-5"></td>
                                        <td class="border border-black w-5"></td>
                                        <td class="border border-black w-5"></td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="px-2 border border-black">
                                        N2O
                                    </td>
                                    <td class="border border-black w-5">{{ $item->anestesiReportMedicine->nitrogen_oksida ?? '' }}</td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                </tr>
                                <tr>
                                    <td class="px-2 border border-black">
                                        <p>
                                            O<sub class="text-xs align-sub"
                                                >2</sub
                                            >
                                        </p>
                                    </td>
                                    <td class="border border-black w-5">{{ $item->anestesiReportMedicine->oksigen ?? '' }}</td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                </tr>
                                <tr>
                                    <td class="px-2 border border-black">
                                        Air
                                    </td>
                                    <td class="border border-black w-5">{{ $item->anestesiReportMedicine->air ?? '' }}</td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                </tr>
                                <tr>
                                    <td class="px-2 border border-black">
                                        Isof
                                    </td>
                                    <td class="border border-black w-5">{{ $item->anestesiReportMedicine->isof ?? '' }}</td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                </tr>
                                <tr>
                                    <td class="px-2 border border-black">
                                        Sevo
                                    </td>
                                    <td class="border border-black w-5">{{ $item->anestesiReportMedicine->sevo ?? '' }}</td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                </tr>
                                <tr>
                                    <td class="px-2 border border-black">
                                        Des
                                    </td>
                                    <td class="border border-black w-5">{{ $item->anestesiReportMedicine->des ?? '' }}</td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="">
                            <thead>
                                <tr>
                                    <td class="px-8 border border-black"></td>
                                    <td
                                        class="px-8 text-center border border-black"
                                    >
                                        R
                                    </td>
                                    <td
                                        class="px-8 text-center border border-black"
                                    >
                                        N
                                    </td>
                                    <td
                                        class="px-8 text-center border border-black"
                                    >
                                        TD
                                    </td>

                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        8
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        220
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td>220</td>
                                </tr>
                                <tr>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        20
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        200
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td>200</td>
                                </tr>
                                <tr>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        16
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        180
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td>180</td>
                                </tr>
                                <tr>
                                    <td class="pl-4 border-black border-x">
                                        X N
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        12
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        160
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td>160</td>
                                </tr>
                                <tr>
                                    <td class="pl-4 border-black border-x">
                                        v Sis
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        8
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        180
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        140
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td>140</td>
                                </tr>
                                <tr>
                                    <td class="pl-4 border-black border-x">
                                        <div class="flex items-center gap-x-1">
                                            <div class="rotate-180">v</div>
                                            Dis
                                        </div>
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        160
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        120
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td>120</td>
                                </tr>
                                <tr>
                                    <td class="pl-4 border-black border-x">
                                        0 R
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        140
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        100
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td>100</td>
                                </tr>
                                <tr>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        120
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        80
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td>80</td>
                                </tr>
                                <tr>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        100
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        60
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td>60</td>
                                </tr>
                                <tr>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        80
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        40
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td>40</td>
                                </tr>
                                <tr>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        60
                                    </td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        20
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td>20</td>
                                </tr>
                                <tr>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    ></td>
                                    <td
                                        class="text-center border-black border-x"
                                    >
                                        0
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td>0</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex pl-32 gap-x-2">
                            <p class="py-3">Mulai anestesia X</p>
                            <p class="text-4xl font-normal">→</p>
                        </div>

                        <div class="flex pl-32 gap-x-40">
                            <div class="flex gap-x-2">
                                <p>Intubasi</p>
                                <div class="font-bold text-md">↑</div>
                            </div>
                            <div class="flex gap-x-2">
                                <p>Ekstubasi</p>
                                <div class="font-bold text-md">↓</div>
                            </div>
                        </div>

                        <table class="my-2">
                            <thead>
                                <tr>
                                    <td class="px-2 w-52">Pemantauan</td>

                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-2 border border-black">
                                        <div class="grid grid-cols-12">
                                            <p class="col-span-4">SpO2</p>
                                            <p class="col-span-8">%</p>
                                        </div>
                                    </td>
                                    <td class="border border-black w-5">dsasd</td>
                                    <td class="border border-black w-5">aa</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="px-2 border border-black">
                                        <div class="grid grid-cols-12">
                                            <p class="col-span-4">PE Co2</p>
                                            <p class="col-span-8">mm Hg</p>
                                        </div>
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="px-2 border border-black">
                                        FiO2
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="px-2 border border-black">
                                        Lain-lain
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td
                                        class="w-32 text-center border border-black"
                                    >
                                        Jumlah
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-2 border border-black">
                                        <div class="grid grid-cols-12">
                                            <p class="col-span-6">
                                                Cairan Infus
                                            </p>
                                            <p class="col-span-6 text-end">
                                                ml
                                            </p>
                                        </div>
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td
                                        class="w-32 text-center border border-black"
                                    ></td>
                                </tr>
                                <tr>
                                    <td class="px-2 border border-black">
                                        <div class="grid grid-cols-12">
                                            <p class="col-span-6">Darah</p>
                                            <p class="col-span-6 text-end">
                                                ml
                                            </p>
                                        </div>
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td
                                        class="w-32 text-center border border-black"
                                    ></td>
                                </tr>
                                <tr>
                                    <td class="px-2 border border-black">
                                        <div class="grid grid-cols-12">
                                            <p class="col-span-6">Urin</p>
                                            <p class="col-span-6 text-end">
                                                ml
                                            </p>
                                        </div>
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td
                                        class="w-32 text-center border border-black"
                                    ></td>
                                </tr>
                                <tr>
                                    <td class="px-2 border border-black">
                                        <div class="grid grid-cols-12">
                                            <p class="col-span-6">Perdarahan</p>
                                            <p class="col-span-6 text-end">
                                                ml
                                            </p>
                                        </div>
                                    </td>
                                    <td class="border border-black w-5"></td>
                                    <td class="border border-black w-5"></td>
                                    <td
                                        class="w-32 text-center border border-black"
                                    ></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="pl-10">
                            <div class="grid grid-cols-12 w-[65%]">
                                <p class="col-span-3">Lama Pembiusan</p>
                                <p class="col-span-1 px-2 text-end">:</p>
                                <div class="flex col-span-8 gap-x-1">
                                    <div class="flex w-[10%] pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->lama_pembiusan_jam ?? '' }}</p>
                                    </div>
                                    <p>jam</p>
                                    <div class="flex w-[10%] pb-1 pl-2">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->lama_pembiusan_menit ?? '' }}</p>
                                    </div>
                                    <p>menit</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-12 w-[65%]">
                                <p class="col-span-3">Lama Pembedahan</p>
                                <p class="col-span-1 px-2 text-end">:</p>
                                <div class="flex col-span-8 gap-x-1">
                                    <div class="flex w-[10%] pb-1">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->lama_pembedahan_jam ?? '' }}</p>
                                    </div>
                                    <p>jam</p>
                                    <div class="flex w-[10%] pb-1 pl-2">
                                        <p
                                            class="w-full border-b border-black"
                                        >{{ $item->lama_pembedahan_menit ?? '' }}</p>
                                    </div>
                                    <p>menit</p>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div>
                                <p>Keterangan / Catatan Intra Anestesi</p>
                            </div>
                            <div class="w-full py-5 pb-1">
                                    {!! $item->keterangan ?? '' !!}
                            </div>
                            {{-- <div class="flex w-full py-5 pb-1">
                                <p class="w-full border-b border-black"></p>
                            </div>
                            <div class="flex w-full py-5 pb-1">
                                <p class="w-full border-b border-black"></p>
                            </div>
                            <div class="flex w-full py-5 pb-1">
                                <p class="w-full border-b border-black"></p>
                            </div>
                            <div class="flex w-full py-5 pb-1">
                                <p class="w-full border-b border-black"></p>
                            </div>
                            <div class="flex w-full py-5 pb-1">
                                <p class="w-full border-b border-black"></p>
                            </div>
                            <div class="flex w-full py-5 pb-1">
                                <p class="w-full border-b border-black"></p>
                            </div>
                            <div class="flex w-full py-5 pb-1">
                                <p class="w-full border-b border-black"></p>
                            </div>
                            <div class="flex w-full py-5 pb-1">
                                <p class="w-full border-b border-black"></p>
                            </div> --}}
                        </div>

                        <div class="grid grid-cols-12 py-4">
                            <div
                                class="flex flex-col items-center justify-center col-span-3 col-start-8"
                            >
                                <div class=" {{ $item->ttd_penata_anestesi ? '' : 'pb-10' }}">Penata Anestesi</div>
                                <img src="{{ asset('storage/' . $item->ttd_penata_anestesi ?? '') }}" alt="">
                                <div
                                    class="flex items-center justify-center gap-x-40"
                                >
                                    <p>({{ $item->nama_penata_anestesi ?? '' }})</p>
                                </div>
                            </div>
                            <div
                                class="flex flex-col items-center justify-center col-span-3 col-start-11"
                            >
                                <div class="{{ $item->ttd_dokter_anestesi ? '' : 'pb-10' }}">Dokter Anestesi</div>
                                <img src="{{ asset('storage/' . $item->ttd_dokter_anestesi ?? '') }}" alt="">
                                <div class="flex items-center justify-center gap-x-40">
                                    <p>({{ $item->nama_dokter_anestesi ?? '' }})</p>
                                </div>
                            </div>
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
