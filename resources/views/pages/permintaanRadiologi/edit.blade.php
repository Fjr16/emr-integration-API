@extends('layouts.backend.main')

@section('content')
    <style>
        td {
            padding-top: 5px;
            vertical-align: top;
        }
    </style>
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="card mb-4">
        <div class="card-header d-flex">
            <div class="col-10 d-flex align-items-center">
                <h5 class="mb-0">Edit Permintaan Radiologi</h5>
            </div>
            <div class="col-2 text-end">
                <a href="{{ $urlParent }}" class="btn btn-success btn-sm text-end">Kembali</a>
                {{-- <button type="button" class="btn btn-success btn-sm text-end" onclick="history.back()">Kembali</button> --}}
            </div>
        </div>
        <form action="{{ route('rajal/permintaan/radiologi.update', [$item->id, $dataRadiologi->id]) }}" method="POST"
            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <input type="hidden" value="{{ $urlParent ?? '' }}" name="urlParent">
            <div class="card-body">
                <div class="mb-3">
                    <input type="hidden" name="patient_id" value="{{ $item->patient->id }}" />
                    <h6>Asal Ruangan</h6>
                    <input type="hidden" name="room_detail_id"
                        value="{{ $item->doctorPatient->user->roomDetail->id ?? '' }}" />
                    <input type="text" value="{{ $item->doctorPatient->user->roomDetail->name ?? '' }}"
                        class="form-control" id="floatingInput" placeholder="" aria-describedby="floatingInputHelp"
                        readonly />
                </div>
                <div class="mb-3">
                    <h6>Diagnosa Klinis</h6>
                    <textarea name="diagnosa_klinis" id="editor">{{ $dataRadiologi->diagnosa_klinis ?? '' }}</textarea>
                </div>

                <div class="table-responsive">
                    <table class="table-bordered w-100">
                        <tbody>
                            <tr>
                                <td colspan="3" class="text-center text-black fw-bold py-2">X-RAY</td>
                            </tr>

                            <tr>
                                {{-- EKSTREMITAS ATAS --}}
                                <td class="text-black p-2" style="min-width: 400px">
                                    <span class="fw-bold mb-5">EKSTREMITAS ATAS :</span>
                                    @php
                                        $options = [
                                            'Clavicula' => 'Clavicula-Radio',
                                            'Shoulder' => 'Shoulder-Radio',
                                            'Humerus' => 'Humerus-Radio',
                                            'Elbow Joint' => 'Elbow-Joint-Radio',
                                            'Antebrachii' => 'Antebrachii-Radio',
                                            'Wrist Joint' => 'Wrist-Joint-Radio',
                                            'Manus' => 'Manus-Radio',
                                        ];
                                    @endphp

                                    @foreach ($options as $key => $radioName)
                                        @php
                                            $isChecked = isset($dataEkstrimitasAtas[$key]);
                                            $radioValue = $isChecked ? $dataEkstrimitasAtas[$key]['value'] : '';
                                            if ($key == 'Elbow Joint') {
                                                $nameAttribute = 'Elbow-Joint';
                                            } elseif ($key == 'Wrist Joint') {
                                                $nameAttribute = 'Wrist-Joint';
                                            } else {
                                                $nameAttribute = $key;
                                            }
                                        @endphp

                                        <div class="mt-2 mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex col-3">
                                                    <input class="form-check-input" type="checkbox" id="{{ $key }}"
                                                        value="{{ $key }}" name="{{ $nameAttribute }}"
                                                        onchange="toggleRadioVisibility(this, '{{ $radioName }}')"
                                                        {{ $isChecked ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-2" for="{{ $key }}">
                                                        {{ $key }}
                                                    </label>
                                                </div>
                                                <div class="ms-5">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="{{ $radioName }}" id="{{ $key }}1"
                                                            value="Dextra" {{ $radioValue == 'Dextra' ? 'checked' : '' }}
                                                            {{ $isChecked ? '' : 'disabled' }}>
                                                        <label class="form-check-label"
                                                            for="{{ $key }}1">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="{{ $radioName }}" id="{{ $key }}2"
                                                            value="Sinitra" {{ $radioValue == 'Sinitra' ? 'checked' : '' }}
                                                            {{ $isChecked ? '' : 'disabled' }}>
                                                        <label class="form-check-label"
                                                            for="{{ $key }}2">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- Lainnya --}}
                                    @foreach ($dataEkstrimitasAtas as $item)
                                        @if (is_null($item['value']))
                                            <div class="mb-0 mt-2 adime">
                                                <div class="d-flex flex-row mb-1">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form form-control form-control-sm"
                                                            id="ekstremitasAtas" name="ekstremitasAtas[]"
                                                            value="{{ $item['name'] }}">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="deleteForm(this)"><i class="bx bx-minus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="mb-0 mt-2 adime">
                                        <div class="d-flex flex-row mb-1">
                                            <div class="col-sm-6">
                                                <input type="text" class="form form-control form-control-sm"
                                                    id="ekstremitasAtas" name="ekstremitasAtas[]">
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="button" class="btn btn-sm btn-dark"
                                                    onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Lainnya --}}
                                </td>
                                {{-- end EKSTREMITAS ATAS --}}

                                {{-- EKSTREMITAS BAWAH --}}
                                <td class="text-black p-2" style="min-width: 380px">
                                    <span class="fw-bold mb-5">EKSTREMITAS BAWAH :</span>
                                    @php
                                        $options = [
                                            'Femur' => 'Femur-Radio',
                                            'Genu' => 'Genu-Radio',
                                            'Cruris' => 'Cruris-Radio',
                                            'Ankle Joint' => 'Ankle-Joint-Radio',
                                            'Calcaneus' => 'Calcaneus-Radio',
                                            'Pedis' => 'Pedis-Radio',
                                        ];
                                    @endphp

                                    @foreach ($options as $key => $radioName)
                                        @php
                                            $isChecked = isset($dataEkstrimitasBawah[$key]);
                                            $radioValue = $isChecked ? $dataEkstrimitasBawah[$key]['value'] : '';
                                            $nameAttribute = $key == 'Ankle Joint' ? 'Ankle-Joint' : $key;
                                        @endphp

                                        <div class="mt-2 mb-0">
                                            <div class="d-flex flex-row">
                                                <div class="form-check d-flex col-3">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="{{ $key }}" value="{{ $key }}"
                                                        name="{{ $nameAttribute }}"
                                                        onchange="toggleRadioVisibility(this, '{{ $radioName }}')"
                                                        {{ $isChecked ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-2" for="{{ $key }}">
                                                        {{ $key }}
                                                    </label>
                                                </div>
                                                <div class="ms-5">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="{{ $radioName }}" id="{{ $key }}1"
                                                            value="Dextra" {{ $radioValue == 'Dextra' ? 'checked' : '' }}
                                                            {{ $isChecked ? '' : 'disabled' }}>
                                                        <label class="form-check-label"
                                                            for="{{ $key }}1">Dextra</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="{{ $radioName }}" id="{{ $key }}2"
                                                            value="Sinitra"
                                                            {{ $radioValue == 'Sinitra' ? 'checked' : '' }}
                                                            {{ $isChecked ? '' : 'disabled' }}>
                                                        <label class="form-check-label"
                                                            for="{{ $key }}2">Sinitra</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- Lainnya --}}
                                    @foreach ($dataEkstrimitasBawah as $item)
                                        @if (is_null($item['value']))
                                            <div class="mb-0 mt-2 adime">
                                                <div class="d-flex flex-row mb-1">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form form-control form-control-sm"
                                                            id="ekstremitasBawah" name="ekstremitasBawah[]"
                                                            value="{{ $item['name'] }}">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="deleteForm(this)"><i
                                                                class="bx bx-minus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="mb-0 mt-2 adime">
                                        <div class="d-flex flex-row mb-1">
                                            <div class="col-sm-6">
                                                <input type="text" class="form form-control form-control-sm"
                                                    id="ekstremitasBawah" name="ekstremitasBawah[]">
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="button" class="btn btn-sm btn-dark"
                                                    onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Lainnya --}}
                                </td>
                                {{-- end EKSTREMITAS BAWAH --}}

                                {{-- LAIN-LAIN --}}
                                <td class="text-black p-2">
                                    <span class="fw-bold mb-5">LAIN-LAIN :</span>
                                    {{-- Thorax --}}
                                    <div class="mt-2 mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Thorax"
                                                    value="Thorax" name="Thorax"
                                                    onchange="toggleRadioVisibility(this, 'Thorax-Radio')"
                                                    @if (isset($nameValuePairs['Thorax'])) checked @endif>
                                                <label class="form-check-label ms-2" for="Thorax">
                                                    Thorax
                                                </label>
                                            </div>
                                            <div class="ms-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Thorax-Radio"
                                                        id="Thorax1" value="AP"
                                                        @if (isset($nameValuePairs['Thorax']) && $nameValuePairs['Thorax'] == 'AP') checked @endif>
                                                    <label class="form-check-label" for="Thorax1">AP</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Thorax-Radio"
                                                        id="Thorax2" value="PA"
                                                        @if (isset($nameValuePairs['Thorax']) && $nameValuePairs['Thorax'] == 'PA') checked @endif>
                                                    <label class="form-check-label" for="Thorax2">PA</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Thorax-Radio"
                                                        id="Thorax3" value="Lat"
                                                        @if (isset($nameValuePairs['Thorax']) && $nameValuePairs['Thorax'] == 'Lat') checked @endif>
                                                    <label class="form-check-label" for="Thorax3">Lat</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Thorax-Radio"
                                                        id="Thorax4" value="Top Lordotik"
                                                        @if (isset($nameValuePairs['Thorax']) && $nameValuePairs['Thorax'] == 'Top Lordotik') checked @endif>
                                                    <label class="form-check-label" for="Thorax4">Top Lordotik</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Thorax --}}

                                    {{-- Foto Polos Abdomen --}}
                                    <div class="mb-0">
                                        <div class="form-check d-flex">
                                            <input class="form-check-input" type="checkbox" id="Foto Polos Abdomen"
                                                value="Foto Polos Abdomen" name="Foto-Polos-Abdomen"
                                                @if ($nameValuePairs->has('Foto Polos Abdomen')) checked @endif>
                                            <label class="form-check-label ms-2" for="Foto Polos Abdomen">
                                                Foto Polos Abdomen
                                            </label>
                                        </div>
                                    </div>

                                    {{-- end Foto Polos Abdomen --}}

                                    {{-- Abdomen --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Abdomen"
                                                    value="Abdomen" name="Abdomen"
                                                    onchange="toggleRadioVisibility(this, 'Abdomen-Radio')"
                                                    @if (isset($nameValuePairs['Abdomen'])) checked @endif>
                                                <label class="form-check-label ms-2" for="Abdomen">
                                                    Abdomen
                                                </label>
                                            </div>
                                            <div class="ms-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Abdomen-Radio"
                                                        id="Abdomen1" value="2 Posisi"
                                                        @if (isset($nameValuePairs['Abdomen']) && $nameValuePairs['Abdomen'] == '2 Posisi') checked @endif>
                                                    <label class="form-check-label" for="Abdomen1">2 Posisi</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Abdomen-Radio"
                                                        id="Abdomen2" value="3 Posisi"
                                                        @if (isset($nameValuePairs['Abdomen']) && $nameValuePairs['Abdomen'] == '3 Posisi') checked @endif>
                                                    <label class="form-check-label" for="Abdomen2">3 Posisi</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Abdomen --}}

                                    {{-- Pelvic --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Pelvic"
                                                    value="Pelvic" name="Pelvic"
                                                    @if ($nameValuePairs->has('Pelvic')) checked @endif>
                                                <label class="form-check-label ms-2" for="Pelvic">
                                                    Pelvic
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Pelvic --}}

                                    {{-- Schedel --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Schedel"
                                                    value="Schedel" name="Schedel"
                                                    onchange="toggleRadioVisibility(this, 'Schedel-Radio')"
                                                    @if (isset($nameValuePairs['Schedel'])) checked @endif>
                                                <label class="form-check-label ms-2" for="Schedel">
                                                    Schedel
                                                </label>
                                            </div>
                                            <div class="ms-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Schedel-Radio"
                                                        id="Schedel1" value="Cranial AP"
                                                        @if (isset($nameValuePairs['Schedel']) && $nameValuePairs['Schedel'] == 'Cranial AP') checked @endif>
                                                    <label class="form-check-label" for="Schedel1">Cranial AP</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Schedel-Radio"
                                                        id="Schedel2" value="Lat"
                                                        @if (isset($nameValuePairs['Schedel']) && $nameValuePairs['Schedel'] == 'Lat') checked @endif>
                                                    <label class="form-check-label" for="Schedel2">Lat</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Schedel --}}

                                    {{-- Waters --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Waters"
                                                    value="Waters" name="Waters"
                                                    @if ($nameValuePairs->has('Waters')) checked @endif>
                                                <label class="form-check-label ms-2" for="Waters">
                                                    Waters
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Waters --}}

                                    {{-- SPN 2 Posisi --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="SPN 2 Posisi"
                                                    value="SPN 2 Posisi" name="SPN-2-Posisi"
                                                    @if ($nameValuePairs->has('SPN 2 Posisi')) checked @endif>
                                                <label class="form-check-label ms-2" for="SPN 2 Posisi">
                                                    SPN 2 Posisi
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end SPN 2 Posisi --}}

                                    {{-- Vertebrae Cervical --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Vertebrae Cervical"
                                                    value="Vertebrae Cervical" name="Vertebrae-Cervical"
                                                    onchange="toggleRadioVisibility(this, 'Vertebrae-Cervical-Radio')"
                                                    @if (isset($nameValuePairs['Vertebrae Cervical'])) checked @endif>
                                                <label class="form-check-label ms-2" for="Vertebrae Cervical">
                                                    Vertebrae Cervical
                                                </label>
                                            </div>
                                            <div class="ms-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Vertebrae-Cervical-Radio" id="Vertebrae Cervical1"
                                                        value="AP" @if (isset($nameValuePairs['Vertebrae Cervical']) && $nameValuePairs['Vertebrae Cervical'] == 'AP') checked @endif>
                                                    <label class="form-check-label" for="Vertebrae Cervical1">AP</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Vertebrae-Cervical-Radio" id="Vertebrae Cervical2"
                                                        value="Lat" @if (isset($nameValuePairs['Vertebrae Cervical']) && $nameValuePairs['Vertebrae Cervical'] == 'Lat') checked @endif>
                                                    <label class="form-check-label" for="Vertebrae Cervical2">Lat</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Vertebrae-Cervical-Radio" id="Vertebrae Cervical3"
                                                        value="3 posisi"
                                                        @if (isset($nameValuePairs['Vertebrae Cervical']) && $nameValuePairs['Vertebrae Cervical'] == '3 posisi') checked @endif>
                                                    <label class="form-check-label" for="Vertebrae Cervical3">3
                                                        posisi</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Vertebrae Cervical --}}

                                    {{-- Vertebrae Thoracal --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Vertebrae Thoracal"
                                                    value="Vertebrae Thoracal" name="Vertebrae-Thoracal"
                                                    onchange="toggleRadioVisibility(this, 'Vertebrae-Thoracal-Radio')"
                                                    @if (isset($nameValuePairs['Vertebrae Thoracal'])) checked @endif>
                                                <label class="form-check-label ms-2" for="Vertebrae Thoracal">
                                                    Vertebrae Thoracal
                                                </label>
                                            </div>
                                            <div class="ms-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Vertebrae-Thoracal-Radio" id="Vertebrae Thoracal1"
                                                        value="AP" @if (isset($nameValuePairs['Vertebrae Thoracal']) && $nameValuePairs['Vertebrae Thoracal'] == 'AP') checked @endif>
                                                    <label class="form-check-label" for="Vertebrae Thoracal1">AP</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Vertebrae-Thoracal-Radio" id="Vertebrae Thoracal2"
                                                        value="Lat" @if (isset($nameValuePairs['Vertebrae Thoracal']) && $nameValuePairs['Vertebrae Thoracal'] == 'Lat') checked @endif>
                                                    <label class="form-check-label" for="Vertebrae Thoracal2">Lat</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Vertebrae Thoracal --}}

                                    {{-- Vertebrae Thoracolumbal --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox"
                                                    id="Vertebrae Thoracolumbal" value="Vertebrae Thoracolumbal"
                                                    name="Vertebrae-Thoracolumbal"
                                                    @if ($nameValuePairs->has('Vertebrae Thoracolumbal')) checked @endif>
                                                <label class="form-check-label ms-2" for="Vertebrae Thoracolumbal">
                                                    Vertebrae Thoracolumbal
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Vertebrae Thoracolumbal --}}

                                    {{-- Vertebrae Lumbosacral --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox"
                                                    id="Vertebrae Lumbosacral" value="Vertebrae Lumbosacral"
                                                    name="Vertebrae-Lumbosacral"
                                                    @if ($nameValuePairs->has('Vertebrae Lumbosacral')) checked @endif>
                                                <label class="form-check-label ms-2" for="Vertebrae Lumbosacral">
                                                    Vertebrae Lumbosacral
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Vertebrae Lumbosacral --}}

                                    {{-- Sacrum --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Sacrum"
                                                    value="Sacrum" name="Sacrum"
                                                    @if ($nameValuePairs->has('Sacrum')) checked @endif>
                                                <label class="form-check-label ms-2" for="Sacrum">
                                                    Sacrum
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Sacrum --}}

                                    {{-- Coccygeus --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Coccygeus"
                                                    value="Coccygeus" name="Coccygeus"
                                                    @if ($nameValuePairs->has('Coccygeus')) checked @endif>
                                                <label class="form-check-label ms-2" for="Coccygeus">
                                                    Coccygeus
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Coccygeus --}}

                                    {{-- Mastoid --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Mastoid"
                                                    value="Mastoid" name="Mastoid"
                                                    @if ($nameValuePairs->has('Mastoid')) checked @endif>
                                                <label class="form-check-label ms-2" for="Mastoid">
                                                    Mastoid
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Mastoid --}}

                                    {{-- TMJ --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="TMJ"
                                                    value="TMJ" name="TMJ"
                                                    @if ($nameValuePairs->has('TMJ')) checked @endif>
                                                <label class="form-check-label ms-2" for="TMJ">
                                                    TMJ
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end TMJ --}}

                                    {{-- Nasal --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Nasal"
                                                    value="Nasal" name="Nasal"
                                                    @if ($nameValuePairs->has('Nasal')) checked @endif>
                                                <label class="form-check-label ms-2" for="Nasal">
                                                    Nasal
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Nasal --}}

                                    {{-- Maxila --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Maxila"
                                                    value="Maxila" name="Maxila"
                                                    @if ($nameValuePairs->has('Maxila')) checked @endif>
                                                <label class="form-check-label ms-2" for="Maxila">
                                                    Maxila
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Maxila --}}

                                    {{-- Mandibula --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Mandibula"
                                                    value="Mandibula" name="Mandibula"
                                                    @if ($nameValuePairs->has('Mandibula')) checked @endif>
                                                <label class="form-check-label ms-2" for="Mandibula">
                                                    Mandibula
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Mandibula --}}

                                    {{-- Lainnya --}}
                                    @php
                                        $excludeList = [
                                            'Thorax',
                                            'Foto Polos Abdomen',
                                            'Abdomen',
                                            'Pelvic',
                                            'Schedel',
                                            'Waters',
                                            'SPN 2 Posisi',
                                            'Vertebrae Cervical',
                                            'Vertebrae Thoracal',
                                            'Vertebrae Thoracolumbal',
                                            'Vertebrae Lumbosacral',
                                            'Sacrum',
                                            'Coccygeus',
                                            'Mastoid',
                                            'TMJ',
                                            'Nasal',
                                            'Maxila',
                                            'Mandibula',
                                        ];
                                    @endphp

                                    @foreach ($dataLainLain2 as $item)
                                        @if (is_null($item['value']) && !in_array($item['name'], $excludeList))
                                            <div class="mb-0 mt-2 adime">
                                                <div class="d-flex flex-row mb-1">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form form-control form-control-sm"
                                                            id="lain-lain" name="lain-lain[]"
                                                            value="{{ $item['name'] }}">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="deleteForm(this)"><i
                                                                class="bx bx-minus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="mb-0 mt-2 adime">
                                        <div class="d-flex flex-row mb-1">
                                            <div class="col-sm-6">
                                                <input type="text" class="form form-control form-control-sm"
                                                    id="lain-lain" name="lain-lain[]">
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="button" class="btn btn-sm btn-dark"
                                                    onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Lainnya --}}
                                </td>
                                {{-- end LAIN-LAIN --}}
                            </tr>
                        </tbody>

                        <tbody>
                            <tr>
                                {{-- USG --}}
                                <td class="text-black p-2">
                                    <span class="fw-bold mb-5">USG :</span>
                                    {{-- Leher / Thyroid --}}
                                    <div class="mt-2 mb-0">
                                        <div class="d-flex flex-row">
                                            {{-- <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Leher/Thyroid"
                                                    value="Leher/Thyroid" name="Leher/Thyroid"
                                                    onchange="toggleRadioVisibility(this, 'Leher/Thyroid-Radio')">
                                                <label class="form-check-label ms-2" for="Leher/Thyroid">
                                                Leher/Thyroid
                                            </label>
                                            </div> --}}
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Leher/Thyroid-Radio" id="Leher/Thyroid1" value="Leher"
                                                        @if ($nameValuePairsUsg->has('Leher')) checked @endif>
                                                    <label class="form-check-label" for="Leher/Thyroid1">Leher</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Leher/Thyroid-Radio" id="Leher/Thyroid2" value="Thyroid"
                                                        @if ($nameValuePairsUsg->has('Thyroid')) checked @endif>
                                                    <label class="form-check-label" for="Leher/Thyroid2">Thyroid</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Leher / Thyroid --}}

                                    {{-- Mammae --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Mammae"
                                                    value="Mammae" name="Mammae"
                                                    @if ($nameValuePairsUsg->has('Mammae')) checked @endif>
                                                <label class="form-check-label ms-2" for="Mammae">
                                                    Mammae
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Mammae --}}

                                    {{-- Abdomen Atas --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Abdomen Atas"
                                                    value="Abdomen Atas" name="Abdomen-Atas"
                                                    @if ($nameValuePairsUsg->has('Abdomen Atas')) checked @endif>
                                                <label class="form-check-label ms-2" for="Abdomen Atas">
                                                    Abdomen Atas
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Abdomen Atas --}}

                                    {{-- Abdomen Bawah / Pelvis --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Abdomen-2"
                                                    value="Abdomen 2" name="Abdomen-2"
                                                    onchange="toggleRadioVisibility(this, 'Abdomen-2-Radio')"
                                                    @if (isset($nameValuePairsUsg['Abdomen 2'])) checked @endif>
                                                <label class="form-check-label ms-2" for="Abdomen-2">
                                                    Abdomen
                                                </label>
                                            </div>
                                            <div class="ms-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Abdomen-2-Radio"
                                                        id="Abdomen21" value="Bawah"
                                                        @if (isset($nameValuePairsUsg['Abdomen 2']) && $nameValuePairsUsg['Abdomen 2'] == 'Bawah') checked @endif>
                                                    <label class="form-check-label" for="Abdomen21">Bawah</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Abdomen-2-Radio"
                                                        id="Abdomen22" value="Pelvis"
                                                        @if (isset($nameValuePairsUsg['Abdomen 2']) && $nameValuePairsUsg['Abdomen 2'] == 'Pelvis') checked @endif>
                                                    <label class="form-check-label" for="Abdomen22">Pelvis</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Abdomen Bawah / Pelvis --}}

                                    {{-- Urologi --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Urologi"
                                                    value="Urologi" name="Urologi"
                                                    @if ($nameValuePairsUsg->has('Urologi')) checked @endif>
                                                <label class="form-check-label ms-2" for="Urologi">
                                                    Urologi
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Urologi --}}

                                    {{-- Prostat --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Prostat"
                                                    value="Prostat" name="Prostat"
                                                    @if ($nameValuePairsUsg->has('Prostat')) checked @endif>
                                                <label class="form-check-label ms-2" for="Prostat">
                                                    Prostat
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Prostat --}}

                                    {{-- Testis --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Testis"
                                                    value="Testis" name="Testis"
                                                    @if ($nameValuePairsUsg->has('Testis')) checked @endif>
                                                <label class="form-check-label ms-2" for="Testis">
                                                    Testis
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Testis --}}

                                    {{-- Testis-Dople --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Testis-Dople"
                                                    value="Testis Dople" name="Testis-Dople"
                                                    @if ($nameValuePairsUsg->has('Testis Dople')) checked @endif>
                                                <label class="form-check-label ms-2" for="Testis-Dople">
                                                    Testis-Dople
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Testis-Dople --}}

                                    {{-- Lainnya --}}
                                    @php
                                        $excludeListUsg = [
                                            'Mammae',
                                            'Abdomen Atas',
                                            'Abdomen',
                                            'Urologi',
                                            'Prostat',
                                            'Testis',
                                            'Testis Dople',
                                            'Leher',
                                            'Thyroid',
                                        ];
                                    @endphp

                                    @foreach ($dataUsg2 as $item)
                                        @if (is_null($item['value']) && !in_array($item['name'], $excludeListUsg))
                                            <div class="mb-0 mt-2 adime">
                                                <div class="d-flex flex-row mb-1">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form form-control form-control-sm"
                                                            id="usg" name="usg[]" value="{{ $item['name'] }}">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="deleteForm(this)"><i
                                                                class="bx bx-minus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="mb-0 mt-2 adime">
                                        <div class="d-flex flex-row mb-1">
                                            <div class="col-sm-6">
                                                <input type="text" class="form form-control form-control-sm"
                                                    id="usg" name="usg[]">
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="button" class="btn btn-sm btn-dark"
                                                    onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Lainnya --}}
                                </td>
                                {{-- end USG --}}

                                {{-- KONTRAS --}}
                                <td class="text-black p-2">
                                    <span class="fw-bold mb-5">KONTRAS* :</span>
                                    {{-- Appendicogram --}}
                                    <div class="mt-2 mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Appendicogram"
                                                    value="Appendicogram" name="Appendicogram"
                                                    @if ($nameValuePairsKontras->has('Appendicogram')) checked @endif>
                                                <label class="form-check-label ms-2" for="Appendicogram">
                                                    Appendicogram
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Appendicogram --}}

                                    {{-- Cystography --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Cystography"
                                                    value="Cystography" name="Cystography"
                                                    @if ($nameValuePairsKontras->has('Cystography')) checked @endif>
                                                <label class="form-check-label ms-2" for="Cystography">
                                                    Cystography
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Cystography --}}

                                    {{-- BNO / IVP --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            {{-- <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="BNO/IVP"
                                                    value="BNO/IVP" name="BNO/IVP"
                                                    onchange="toggleRadioVisibility(this, 'BNO/IVP-Radio')">
                                                <label class="form-check-label ms-2" for="BNO/IVP">
                                                BNO/IVP
                                            </label>
                                            </div> --}}
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="BNO/IVP-Radio"
                                                        id="BNO/IVP1" value="BNO"
                                                        @if ($nameValuePairsKontras->has('BNO')) checked @endif>
                                                    <label class="form-check-label" for="BNO/IVP1">BNO</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="BNO/IVP-Radio"
                                                        id="BNO/IVP2" value="IVP"
                                                        @if ($nameValuePairsKontras->has('IVP')) checked @endif>
                                                    <label class="form-check-label" for="BNO/IVP2">IVP</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end BNO / IVP --}}

                                    {{-- Lainnya --}}
                                    @php
                                        $excludeListKontras = ['Appendicogram', 'Cystography', 'BNO', 'IVP'];
                                    @endphp

                                    @foreach ($dataKontras2 as $item)
                                        @if (is_null($item['value']) && !in_array($item['name'], $excludeListKontras))
                                            <div class="mb-0 mt-2 adime">
                                                <div class="d-flex flex-row mb-1">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form form-control form-control-sm"
                                                            id="kontras" name="kontras[]" value="{{ $item['name'] }}">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="deleteForm(this)"><i
                                                                class="bx bx-minus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="mb-0 mt-2 adime">
                                        <div class="d-flex flex-row mb-1">
                                            <div class="col-sm-6">
                                                <input type="text" class="form form-control form-control-sm"
                                                    id="kontras" name="kontras[]">
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="button" class="btn btn-sm btn-dark"
                                                    onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Lainnya --}}
                                </td>
                                {{-- end KONTRAS --}}

                                {{-- PEMERIKSAAN LAINNYA --}}
                                <td class="text-black p-2">
                                    <span class="fw-bold mb-5">PEMERIKSAAN LAINNYA :</span>
                                    {{-- CT-Scan --}}
                                    <div class="mt-2 mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <div class="col-4">
                                                    <input class="form-check-input" type="checkbox" id="CT-Scan"
                                                        value="CT-Scan" name="CT-Scan"
                                                        onchange="toggleTextInput(this, 'CT-Scan-input')"
                                                        @if ($nameValuePairsPemeriksaLainnya->has('CT-Scan')) checked @endif>
                                                    <label class="form-check-label" for="CT-Scan">
                                                        CT-Scan
                                                    </label>
                                                </div>
                                                <div class="">
                                                    <input type="text" name="CT-Scan-input" id="CT-Scan-input"
                                                        class="form-control form-control-sm"
                                                        @if (!$nameValuePairsPemeriksaLainnya->has('CT-Scan')) disabled @endif
                                                        @if (isset($nameValuePairsPemeriksaLainnya['CT-Scan'])) value="{{ $nameValuePairsPemeriksaLainnya['CT-Scan'] }}" @endif>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end CT-Scan --}}

                                    {{-- MRI --}}
                                    <div class="mt-2 mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <div class="col-4">
                                                    <input class="form-check-input" type="checkbox" id="MRI"
                                                        value="MRI" name="MRI"
                                                        onchange="toggleTextInput(this, 'MRI-input')"
                                                        @if ($nameValuePairsPemeriksaLainnya->has('MRI')) checked @endif>
                                                    <label class="form-check-label" for="MRI">
                                                        MRI
                                                    </label>
                                                </div>
                                                <div class="ms-2">
                                                    <input type="text" name="MRI-input" id="MRI-input"
                                                        class="form-control form-control-sm"
                                                        @if (!$nameValuePairsPemeriksaLainnya->has('MRI')) disabled @endif
                                                        @if (isset($nameValuePairsPemeriksaLainnya['MRI'])) value="{{ $nameValuePairsPemeriksaLainnya['MRI'] }}" @endif>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end MRI --}}

                                    {{-- Lainnya --}}
                                    @php
                                        $excludeListPemeriksaLainnya = ['CT-Scan', 'MRI'];
                                    @endphp

                                    @foreach ($dataPemeriksaLainnya2 as $item)
                                        @if (is_null($item['value']) && !in_array($item['name'], $excludeListPemeriksaLainnya))
                                            <div class="mb-0 mt-2 adime">
                                                <div class="d-flex flex-row mb-1">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form form-control form-control-sm"
                                                            id="pemeriksaanLainnya" name="pemeriksaanLainnya[]"
                                                            value="{{ $item['name'] }}">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="deleteForm(this)"><i
                                                                class="bx bx-minus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="mb-0 mt-2 adime">
                                        <div class="d-flex flex-row mb-1">
                                            <div class="col-sm-6">
                                                <input type="text" class="form form-control form-control-sm"
                                                    id="pemeriksaanLainnya" name="pemeriksaanLainnya[]">
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="button" class="btn btn-sm btn-dark"
                                                    onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Lainnya --}}
                                </td>
                                {{-- end PEMERIKSAAN LAINNYA --}}

                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="my-3">
                    <h6 class="mb-0">Catatan</h6>
                    <textarea class="form-control" name="catatan" cols="30" rows="10">{{ $dataRadiologi->catatan }}</textarea>
                    {{-- <input type="text" name="catatan" class="form-control" id="floatingInput"
                        value="{{ $catatan ?? '' }}" placeholder="" aria-describedby="floatingInputHelp" /> --}}
                </div>
                <div class="d-flex flex-row justify-content-end mt-5">
                    <span>Padang, Tanggal</span>
                    <div class="ms-2">
                        <input type="date" name="date" class="form-control form-control-sm"
                            value="{{ \Carbon\Carbon::parse($asesmentKeperawatanRencanaAsuhan->tanggal ?? \Carbon\Carbon::now())->format('Y-m-d') }}">
                    </div>
                    <span class="ms-3">Pukul</span>
                    <div class="ms-2"><input type="time" name="time" class="form-control form-control-sm"
                            value="{{ \Carbon\Carbon::parse($asesmentKeperawatanRencanaAsuhan->tanggal ?? \Carbon\Carbon::now())->format('H:i') }}">
                    </div>
                </div>

                <div class="row justify-content-center justify-content-lg-end">
                    <div class="col-4">
                        <div class="d-flex justify-content-center pt-3">
                            <div class="d-flex flex-column">
                                <div class="text-center" style="min-width: 300px">
                                    <label class="form-label fw-bold" id="label-kolom">Dokter yang meminta</label>
                                    <div class="d-flex flex-column">
                                        @if ($dataRadiologi->ttd_dokter)
                                            <img src="{{ Storage::url($dataRadiologi->ttd_dokter) }}" alt=""
                                                id="ImgTtdUser">
                                        @else
                                            <img src="" alt="" id="imgTtdUser" class="">
                                        @endif
                                        <textarea id="ttd_user" name="ttd_user" style="display: none;">{{ $dataRadiologi->ttd_dokter }}</textarea>
                                        <button type="button" class="btn btn-sm btn-dark px-lg-5 mb-2"
                                            onclick="openModal(this)">Tanda
                                            Tangan</button>

                                        <input type="text" class="form-control form-control-sm text-center"
                                            value="{{ auth()->user()->name ?? '' }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    {{-- modal create ttd --}}
    <div class="modal fade" id="getTtdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalScrollableTitle">Masukkan Password Akun Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="signature-pad" class="m-signature-pad">
                        <div class="m-signature-pad--body mb-3">
                            <input type="password" class="form-control form-control-sm" name="password_user">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        </div>

                        <div class="m-signature-pad--footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-action="clear">Clear</button>
                            <button type="button" class="btn btn-sm btn-primary" data-action="save">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(element) {
            $('#getTtdModal').modal('show');
        }

        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById("getTtdModal");
            var clearBtn = modal.querySelector("[data-action=clear]");
            var saveBtn = modal.querySelector("[data-action=save]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');

            var tipeCppt = document.getElementById('tipe_cppt');
            var formParaf = document.getElementById('formParafUser');

            // function clear input ttd
            clearBtn.addEventListener('click', function(clear) {
                clear.preventDefault();
                inputPass.value = '';
            });

            // function save ttd
            saveBtn.addEventListener('click', function(save) {
                save.preventDefault();
                $.ajax({
                    type: 'get',
                    url: "{{ route('ranap/cppt.getTtd') }}",
                    data: {
                        user_id: inputUserId.value,
                        password: inputPass.value,
                    },
                    success: function(data) {
                        var newSrc = `{{ Storage::url('${data}') }}`;
                        $('#imgTtdUser').attr('src', newSrc);
                        $('#ttd_user').val(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log();
                        var errorResponse = jqXHR.responseJSON;
                        if (errorResponse && errorResponse.error) {
                            alert(errorResponse.error)
                        } else {
                            alert('Terjadi Kesalahan Dalam Pengambilan Data');
                        }
                    }
                });

                inputPass.value = '';

                $('#getTtdModal').modal('hide');
            });
        });
    </script>

    <script>
        function addAdime(element) {
            var adimeClass = element.closest('.adime');
            var input = adimeClass.querySelector('input');
            var inputName = input.getAttribute('name');
            var div = document.createElement('div');
            div.className = 'd-flex flex-row mb-1';
            div.innerHTML = `
        <div class="col-sm-6">
            <input type="text" class="form form-control form-control-sm" name="${inputName}">
        </div>
        <div class="col-sm-1">
            <button type="button" class="btn btn-sm btn-danger" onclick="deleteForm(this)"><i
                    class="bx bx-minus"></i></button>
        </div>
    `;

            adimeClass.appendChild(div);
        }
    </script>

    <script>
        function deleteForm(element) {
            var row = element.closest('.d-flex');
            row.remove();
        }
    </script>

    <script>
        function uncheckRadio(radioGroupName) {
            var radios = document.getElementsByName(radioGroupName);
            for (var i = 0; i < radios.length; i++) {
                radios[i].checked = false;
            }
        }

        function toggleRadioVisibility(checkbox, radioGroupName) {
            var radios = document.getElementsByName(radioGroupName);
            for (var i = 0; i < radios.length; i++) {
                radios[i].disabled = !checkbox.checked;
            }
            // Memastikan radio tidak dicentang saat checkbox tidak dicentang
            if (!checkbox.checked) {
                uncheckRadio(radioGroupName);
            }
        }

        function toggleTextInput(checkbox, inputName) {
            var input = document.getElementsByName(inputName)[0];
            input.disabled = !checkbox.checked;
            // Misalkan Anda juga ingin mengosongkan input teks saat checkbox tidak dicentang
            if (!checkbox.checked) {
                input.value = "";
            }
        }
    </script>
@endsection
