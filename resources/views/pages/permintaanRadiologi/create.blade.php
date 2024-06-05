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
                <h5 class="mb-0">Tambah Permintaan Radiologi</h5>
            </div>
            <div class="col-2 text-end">
                <a href="{{ $urlParent }}" class="btn btn-success btn-sm text-end">Kembali</a>
                {{-- <button type="button" class="btn btn-success btn-sm text-end" onclick="history.back()">Kembali</button> --}}
            </div>
        </div>
        <form action="{{ route('rajal/permintaan/radiologi.store', $item->id) }}" method="POST"
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
                    <textarea name="diagnosa_klinis" id="editor">{{ $diagnosa ?? '' }}</textarea>
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
                                    {{-- Clavicula --}}
                                    <div class="mt-2 mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex col-3">
                                                <input class="form-check-input" type="checkbox" id="Clavicula"
                                                    value="Clavicula" name="Clavicula"
                                                    onchange="toggleRadioVisibility(this, 'Clavicula-Radio')">
                                                <label class="form-check-label ms-2" for="Clavicula">
                                                    Clavicula
                                                </label>
                                            </div>
                                            <div class="ms-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Clavicula-Radio"
                                                        id="Clavicula1" value="Dextra" disabled>
                                                    <label class="form-check-label" for="Clavicula1">Dextra</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Clavicula-Radio"
                                                        id="Clavicula2" value="Sinitra" disabled>
                                                    <label class="form-check-label" for="Clavicula2">Sinitra</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Clavicula --}}

                                    {{-- Shoulder --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex col-3">
                                                <input class="form-check-input" type="checkbox" id="Shoulder"
                                                    value="Shoulder" name="Shoulder"
                                                    onchange="toggleRadioVisibility(this, 'Shoulder-Radio')">
                                                <label class="form-check-label ms-2" for="Shoulder">
                                                    Shoulder
                                                </label>
                                            </div>
                                            <div class="ms-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Shoulder-Radio"
                                                        id="Shoulder1" value="Dextra" disabled>
                                                    <label class="form-check-label" for="Shoulder1">Dextra</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Shoulder-Radio"
                                                        id="Shoulder2" value="Sinitra" disabled>
                                                    <label class="form-check-label" for="Shoulder2">Sinitra</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Shoulder --}}

                                    {{-- Humerus --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex col-3">
                                                <input class="form-check-input" type="checkbox" id="Humerus"
                                                    value="Humerus" name="Humerus"
                                                    onchange="toggleRadioVisibility(this, 'Humerus-Radio')">
                                                <label class="form-check-label ms-2" for="Humerus">
                                                    Humerus
                                                </label>
                                            </div>
                                            <div class="ms-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Humerus-Radio"
                                                        id="Humerus1" value="Dextra" disabled>
                                                    <label class="form-check-label" for="Humerus1">Dextra</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Humerus-Radio"
                                                        id="Humerus2" value="Sinitra" disabled>
                                                    <label class="form-check-label" for="Humerus2">Sinitra</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Humerus --}}

                                    {{-- Elbow Joint --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex col-3">
                                                <input class="form-check-input" type="checkbox" id="Elbow Joint"
                                                    value="Elbow Joint" name="Elbow-Joint"
                                                    onchange="toggleRadioVisibility(this, 'Elbow-Joint-Radio')">
                                                <label class="form-check-label ms-2" for="Elbow Joint">
                                                    Elbow Joint
                                                </label>
                                            </div>
                                            <div class="ms-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Elbow-Joint-Radio" id="Elbow Joint1" value="Dextra"
                                                        disabled>
                                                    <label class="form-check-label" for="Elbow Joint1">Dextra</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Elbow-Joint-Radio" id="Elbow Joint2" value="Sinitra"
                                                        disabled>
                                                    <label class="form-check-label" for="Elbow Joint2">Sinitra</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Elbow Joint --}}

                                    {{-- Antebrachii --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex col-3">
                                                <input class="form-check-input" type="checkbox" id="Antebrachii"
                                                    value="Antebrachii" name="Antebrachii"
                                                    onchange="toggleRadioVisibility(this, 'Antebrachii-Radio')">
                                                <label class="form-check-label ms-2" for="Antebrachii">
                                                    Antebrachii
                                                </label>
                                            </div>
                                            <div class="ms-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Antebrachii-Radio" id="Antebrachii1" value="Dextra"
                                                        disabled>
                                                    <label class="form-check-label" for="Antebrachii1">Dextra</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Antebrachii-Radio" id="Antebrachii2" value="Sinitra"
                                                        disabled>
                                                    <label class="form-check-label" for="Antebrachii2">Sinitra</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Antebrachii --}}

                                    {{-- Wrist Joint --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex col-3">
                                                <input class="form-check-input" type="checkbox" id="Wrist Joint"
                                                    value="Wrist Joint" name="Wrist-Joint"
                                                    onchange="toggleRadioVisibility(this, 'Wrist-Joint-Radio')">
                                                <label class="form-check-label ms-2" for="Wrist Joint">
                                                    Wrist Joint
                                                </label>
                                            </div>
                                            <div class="ms-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Wrist-Joint-Radio" id="Wrist Joint1" value="Dextra"
                                                        disabled>
                                                    <label class="form-check-label" for="Wrist Joint1">Dextra</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Wrist-Joint-Radio" id="Wrist Joint2" value="Sinitra"
                                                        disabled>
                                                    <label class="form-check-label" for="Wrist Joint2">Sinitra</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Wrist Joint --}}

                                    {{-- Manus --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex col-3">
                                                <input class="form-check-input" type="checkbox" id="Manus"
                                                    value="Manus" name="Manus"
                                                    onchange="toggleRadioVisibility(this, 'Manus-Radio')">
                                                <label class="form-check-label ms-2" for="Manus">
                                                    Manus
                                                </label>
                                            </div>
                                            <div class="ms-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Manus-Radio"
                                                        id="Manus1" value="Dextra" disabled>
                                                    <label class="form-check-label" for="Manus1">Dextra</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Manus-Radio"
                                                        id="Manus2" value="Sinitra" disabled>
                                                    <label class="form-check-label" for="Manus2">Sinitra</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Manus --}}

                                    {{-- Lainnya --}}
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
                                    {{-- Femur --}}
                                    <div class="mt-2 mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex col-3">
                                                <input class="form-check-input" type="checkbox" id="Femur"
                                                    value="Femur" name="Femur"
                                                    onchange="toggleRadioVisibility(this, 'Femur-Radio')">
                                                <label class="form-check-label ms-2" for="Femur">
                                                    Femur
                                                </label>
                                            </div>
                                            <div class="ms-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Femur-Radio"
                                                        id="Femur1" value="Dextra" disabled>
                                                    <label class="form-check-label" for="Femur1">Dextra</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Femur-Radio"
                                                        id="Femur2" value="Sinitra" disabled>
                                                    <label class="form-check-label" for="Femur2">Sinitra</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Femur --}}

                                    {{-- Genu --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex col-3">
                                                <input class="form-check-input" type="checkbox" id="Genu"
                                                    value="Genu" name="Genu"
                                                    onchange="toggleRadioVisibility(this, 'Genu-Radio')">
                                                <label class="form-check-label ms-2" for="Genu">
                                                    Genu
                                                </label>
                                            </div>
                                            <div class="ms-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Genu-Radio"
                                                        id="Genu1" value="Dextra" disabled>
                                                    <label class="form-check-label" for="Genu1">Dextra</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Genu-Radio"
                                                        id="Genu2" value="Sinitra" disabled>
                                                    <label class="form-check-label" for="Genu2">Sinitra</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Genu --}}

                                    {{-- Cruris --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex col-3">
                                                <input class="form-check-input" type="checkbox" id="Cruris"
                                                    value="Cruris" name="Cruris"
                                                    onchange="toggleRadioVisibility(this, 'Cruris-Radio')">
                                                <label class="form-check-label ms-2" for="Cruris">
                                                    Cruris
                                                </label>
                                            </div>
                                            <div class="ms-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Cruris-Radio"
                                                        id="Cruris1" value="Dextra" disabled>
                                                    <label class="form-check-label" for="Cruris1">Dextra</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Cruris-Radio"
                                                        id="Cruris2" value="Sinitra" disabled>
                                                    <label class="form-check-label" for="Cruris2">Sinitra</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Cruris --}}

                                    {{-- Ankle Joint --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex col-3">
                                                <input class="form-check-input" type="checkbox" id="Ankle Joint"
                                                    value="Ankle Joint" name="Ankle-Joint"
                                                    onchange="toggleRadioVisibility(this, 'Ankle-Joint-Radio')">
                                                <label class="form-check-label ms-2" for="Ankle Joint">
                                                    Ankle Joint
                                                </label>
                                            </div>
                                            <div class="ms-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Ankle-Joint-Radio" id="Ankle Joint1" value="Dextra"
                                                        disabled>
                                                    <label class="form-check-label" for="Ankle Joint1">Dextra</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Ankle-Joint-Radio" id="Ankle Joint2" value="Sinitra"
                                                        disabled>
                                                    <label class="form-check-label" for="Ankle Joint2">Sinitra</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Ankle Joint --}}

                                    {{-- Calcaneus --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex col-3">
                                                <input class="form-check-input" type="checkbox" id="Calcaneus"
                                                    value="Calcaneus" name="Calcaneus"
                                                    onchange="toggleRadioVisibility(this, 'Calcaneus-Radio')">
                                                <label class="form-check-label ms-2" for="Calcaneus">
                                                    Calcaneus
                                                </label>
                                            </div>
                                            <div class="ms-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Calcaneus-Radio"
                                                        id="Calcaneus1" value="Dextra" disabled>
                                                    <label class="form-check-label" for="Calcaneus1">Dextra</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Calcaneus-Radio"
                                                        id="Calcaneus2" value="Sinitra" disabled>
                                                    <label class="form-check-label" for="Calcaneus2">Sinitra</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Calcaneus --}}

                                    {{-- Pedis --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex col-3">
                                                <input class="form-check-input" type="checkbox" id="Pedis"
                                                    value="Pedis" name="Pedis"
                                                    onchange="toggleRadioVisibility(this, 'Pedis-Radio')">
                                                <label class="form-check-label ms-2" for="Pedis">
                                                    Pedis
                                                </label>
                                            </div>
                                            <div class="ms-5">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Pedis-Radio"
                                                        id="Pedis1" value="Dextra" disabled>
                                                    <label class="form-check-label" for="Pedis1">Dextra</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Pedis-Radio"
                                                        id="Pedis2" value="Sinitra" disabled>
                                                    <label class="form-check-label" for="Pedis2">Sinitra</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Pedis --}}

                                    {{-- Lainnya --}}
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
                                                    onchange="toggleRadioVisibility(this, 'Thorax-Radio')">
                                                <label class="form-check-label ms-2" for="Thorax">
                                                    Thorax
                                                </label>
                                            </div>
                                            <div class="ms-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Thorax-Radio"
                                                        id="Thorax1" value="AP" disabled>
                                                    <label class="form-check-label" for="Thorax1">AP</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Thorax-Radio"
                                                        id="Thorax2" value="PA" disabled>
                                                    <label class="form-check-label" for="Thorax2">PA</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Thorax-Radio"
                                                        id="Thorax3" value="Lat" disabled>
                                                    <label class="form-check-label" for="Thorax3">Lat</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Thorax-Radio"
                                                        id="Thorax4" value="Top Lordotik" disabled>
                                                    <label class="form-check-label" for="Thorax4">Top Lordotik</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Thorax --}}

                                    {{-- Foto Polos Abdomen --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Foto Polos Abdomen"
                                                    value="Foto Polos Abdomen" name="Foto-Polos-Abdomen">
                                                <label class="form-check-label ms-2" for="Foto Polos Abdomen">
                                                    Foto Polos Abdomen
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Foto Polos Abdomen --}}

                                    {{-- Abdomen --}}
                                    <div class="mb-0">
                                        <div class="d-flex flex-row">
                                            <div class="form-check d-flex">
                                                <input class="form-check-input" type="checkbox" id="Abdomen"
                                                    value="Abdomen" name="Abdomen"
                                                    onchange="toggleRadioVisibility(this, 'Abdomen-Radio')">
                                                <label class="form-check-label ms-2" for="Abdomen">
                                                    Abdomen
                                                </label>
                                            </div>
                                            <div class="ms-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Abdomen-Radio"
                                                        id="Abdomen1" value="2 Posisi" disabled>
                                                    <label class="form-check-label" for="Abdomen1">2 Posisi</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Abdomen-Radio"
                                                        id="Abdomen2" value="3 Posisi" disabled>
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
                                                    value="Pelvic" name="Pelvic">
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
                                                    onchange="toggleRadioVisibility(this, 'Schedel-Radio')">
                                                <label class="form-check-label ms-2" for="Schedel">
                                                    Schedel
                                                </label>
                                            </div>
                                            <div class="ms-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Schedel-Radio"
                                                        id="Schedel1" value="Cranial AP" disabled>
                                                    <label class="form-check-label" for="Schedel1">Cranial AP</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Schedel-Radio"
                                                        id="Schedel2" value="Lat" disabled>
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
                                                    value="Waters" name="Waters">
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
                                                    value="SPN 2 Posisi" name="SPN-2-Posisi">
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
                                                    onchange="toggleRadioVisibility(this, 'Vertebrae-Cervical-Radio')">
                                                <label class="form-check-label ms-2" for="Vertebrae Cervical">
                                                    Vertebrae Cervical
                                                </label>
                                            </div>
                                            <div class="ms-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Vertebrae-Cervical-Radio" id="Vertebrae Cervical1"
                                                        value="AP" disabled>
                                                    <label class="form-check-label" for="Vertebrae Cervical1">AP</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Vertebrae-Cervical-Radio" id="Vertebrae Cervical2"
                                                        value="Lat" disabled>
                                                    <label class="form-check-label" for="Vertebrae Cervical2">Lat</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Vertebrae-Cervical-Radio" id="Vertebrae Cervical3"
                                                        value="3 posisi" disabled>
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
                                                    onchange="toggleRadioVisibility(this, 'Vertebrae-Thoracal-Radio')">
                                                <label class="form-check-label ms-2" for="Vertebrae Thoracal">
                                                    Vertebrae Thoracal
                                                </label>
                                            </div>
                                            <div class="ms-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Vertebrae-Thoracal-Radio" id="Vertebrae Thoracal1"
                                                        value="AP" disabled>
                                                    <label class="form-check-label" for="Vertebrae Thoracal1">AP</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Vertebrae-Thoracal-Radio" id="Vertebrae Thoracal2"
                                                        value="Lat" disabled>
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
                                                    name="Vertebrae-Thoracolumbal">
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
                                                    name="Vertebrae-Lumbosacral">
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
                                                    value="Sacrum" name="Sacrum">
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
                                                    value="Coccygeus" name="Coccygeus">
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
                                                    value="Mastoid" name="Mastoid">
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
                                                    value="TMJ" name="TMJ">
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
                                                    value="Nasal" name="Nasal">
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
                                                    value="Maxila" name="Maxila">
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
                                                    value="Mandibula" name="Mandibula">
                                                <label class="form-check-label ms-2" for="Mandibula">
                                                    Mandibula
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Mandibula --}}

                                    {{-- Lainnya --}}
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
                                                        name="Leher/Thyroid-Radio" id="Leher/Thyroid1" value="Leher">
                                                    <label class="form-check-label" for="Leher/Thyroid1">Leher</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="Leher/Thyroid-Radio" id="Leher/Thyroid2" value="Thyroid">
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
                                                    value="Mammae" name="Mammae">
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
                                                    value="Abdomen Atas" name="Abdomen-Atas">
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
                                                    onchange="toggleRadioVisibility(this, 'Abdomen-2-Radio')">
                                                <label class="form-check-label ms-2" for="Abdomen-2">
                                                    Abdomen
                                                </label>
                                            </div>
                                            <div class="ms-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Abdomen-2-Radio"
                                                        id="Abdomen21" value="Bawah" disabled>
                                                    <label class="form-check-label" for="Abdomen21">Bawah</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="Abdomen-2-Radio"
                                                        id="Abdomen22" value="Pelvis" disabled>
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
                                                    value="Urologi" name="Urologi">
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
                                                    value="Prostat" name="Prostat">
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
                                                    value="Testis" name="Testis">
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
                                                    value="Testis Dople" name="Testis-Dople">
                                                <label class="form-check-label ms-2" for="Testis-Dople">
                                                    Testis-Dople
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Testis-Dople --}}

                                    {{-- Lainnya --}}
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
                                                    value="Appendicogram" name="Appendicogram">
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
                                                    value="Cystography" name="Cystography">
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
                                                        id="BNO/IVP1" value="BNO">
                                                    <label class="form-check-label" for="BNO/IVP1">BNO</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="BNO/IVP-Radio"
                                                        id="BNO/IVP2" value="IVP">
                                                    <label class="form-check-label" for="BNO/IVP2">IVP</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end BNO / IVP --}}

                                    {{-- Lainnya --}}
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
                                                        onchange="toggleTextInput(this, 'CT-Scan-input')">
                                                    <label class="form-check-label" for="CT-Scan">
                                                        CT-Scan
                                                    </label>
                                                </div>
                                                <div class="">
                                                    <input type="text" name="CT-Scan-input" id=""
                                                        class="form-control form-control-sm" disabled>
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
                                                        onchange="toggleTextInput(this, 'MRI-input')">
                                                    <label class="form-check-label" for="MRI">
                                                        MRI
                                                    </label>
                                                </div>
                                                <div class="ms-2">
                                                    <input type="text" name="MRI-input" id=""
                                                        class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end MRI --}}

                                    {{-- Lainnya --}}
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
                    <textarea class="form-control" name="catatan" cols="30" rows="10"></textarea>
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
                                        <img src="" alt="" id="imgTtdUser" class="">
                                        <textarea id="ttd_user" name="ttd_user" style="display: none;"></textarea>
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


                {{-- start --}}
                {{-- <div class="row mb-3 mx-1 mt-3">
                    <div class="col-12 text-center border fw-bold text-black pt-2">
                        <p>X-RAY</p>
                    </div>
                    @foreach ($data as $item)
                        @if ($item->name === 'EKSTREMITAS ATAS')
                            <div class="col-4 mb-1 border">
                                <p class="fw-bold text-black m-0">{{ $item->name ?? '' }} :</p>
                                <div class="mb-3 mx-0">
                                    @foreach ($item->radiologiFormRequestMasters->where('isActive', true) as $index => $variabel)
                                        <div class="row mb-2">
                                            <div class="col-6 row">
                                                @if ($variabel->input_type == 'text')
                                                    <div class="d-none">
                                                        <input type="hidden"
                                                            name="lainnya[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                            value="{{ $variabel->id }}"
                                                            id="defaultCheck{{ $variabel->id }}" />
                                                    </div>
                                                @endif
                                                @if ($variabel->input_type == 'checkbox')
                                                    <div class="col-3">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="data[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                            value="{{ $variabel->id }}"
                                                            id="defaultCheck{{ $variabel->id }}" />
                                                    </div>
                                                @endif
                                                <div class="col-7 row">
                                                    <div class="col-4 ">
                                                        <label class="form-check-label"
                                                            for="defaultCheck{{ $variabel->id }}">
                                                            {{ $variabel->name ?? '' }}
                                                        </label>
                                                    </div>
                                                </div>
                                                @if ($variabel->input_type == 'text')
                                                    <div class="col-5">
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="lainnya[{{ $variabel->id }}][nilai]" />
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                @foreach ($variabel->radiologiFormRequestMasterDetails->where('isActive', true) as $detail)
                                                    <input class="form-check-input" type="radio"
                                                        name="data[{{ $variabel->id }}][radiologi_form_request_master_detail_id]"
                                                        value="{{ $detail->id }}"
                                                        id="d{{ $detail->id }}{{ $variabel->id }}" />
                                                    <label class="form-check-label"
                                                        for="d{{ $detail->id }}{{ $variabel->id }}">{{ $detail->name ?? '' }}</label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if ($item->name === 'EKSTREMITAS BAWAH')
                            <div class="col-4 mb-1 border">
                                <p class="fw-bold text-black m-0">{{ $item->name ?? '' }} :</p>
                                <div class="mb-3 mx-0">
                                    @foreach ($item->radiologiFormRequestMasters->where('isActive', true) as $index => $variabel)
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                @if ($variabel->input_type == 'text')
                                                    <input type="hidden"
                                                        name="lainnya[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                        value="{{ $variabel->id }}"
                                                        id="defaultCheck{{ $variabel->id }}" />
                                                @endif
                                                @if ($variabel->input_type == 'checkbox')
                                                    <input class="form-check-input" type="checkbox"
                                                        name="data[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                        value="{{ $variabel->id }}"
                                                        id="defaultCheck{{ $variabel->id }}" />
                                                @endif

                                                <label class="form-check-label mx-2"
                                                    for="defaultCheck{{ $variabel->id }}">
                                                    {{ $variabel->name ?? '' }}
                                                </label>
                                            </div>

                                            @if ($variabel->input_type == 'text')
                                                <div class="col-4">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="lainnya[{{ $variabel->id }}][nilai]" />
                                                </div>
                                            @endif
                                            <div class="col-auto ">
                                                @foreach ($variabel->radiologiFormRequestMasterDetails->where('isActive', true) as $detail)
                                                    <input class="form-check-input" type="radio"
                                                        name="data[{{ $variabel->id }}][radiologi_form_request_master_detail_id]"
                                                        value="{{ $detail->id }}"
                                                        id="d{{ $detail->id }}{{ $variabel->id }}" />
                                                    <label class="form-check-label"
                                                        for="d{{ $detail->id }}{{ $variabel->id }}">{{ $detail->name ?? '' }}</label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if ($item->name === 'LAIN-LAIN')
                            <div class="col-4 mb-1 border">
                                <p class="fw-bold text-black m-0">{{ $item->name ?? '' }} :</p>
                                <div class="mb-3 mx-0">
                                    @foreach ($item->radiologiFormRequestMasters->where('isActive', true) as $index => $variabel)
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                @if ($variabel->input_type == 'text')
                                                    <input type="hidden"
                                                        name="lainnya[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                        value="{{ $variabel->id }}"
                                                        id="defaultCheck{{ $variabel->id }}" />
                                                @endif
                                                @if ($variabel->input_type == 'checkbox')
                                                    <input class="form-check-input" type="checkbox"
                                                        name="data[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                        value="{{ $variabel->id }}"
                                                        id="defaultCheck{{ $variabel->id }}" />
                                                @endif

                                                <label class="form-check-label mx-2"
                                                    for="defaultCheck{{ $variabel->id }}">
                                                    {{ $variabel->name ?? '' }}
                                                </label>
                                            </div>

                                            @if ($variabel->input_type == 'text')
                                                <div class="col-4">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="lainnya[{{ $variabel->id }}][nilai]" />
                                                </div>
                                            @endif
                                            <div class="col-auto ">
                                                @foreach ($variabel->radiologiFormRequestMasterDetails->where('isActive', true) as $detail)
                                                    <input class="form-check-input" type="radio"
                                                        name="data[{{ $variabel->id }}][radiologi_form_request_master_detail_id]"
                                                        value="{{ $detail->id }}"
                                                        id="d{{ $detail->id }}{{ $variabel->id }}" />
                                                    <label class="form-check-label"
                                                        for="d{{ $detail->id }}{{ $variabel->id }}">{{ $detail->name ?? '' }}</label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if ($item->name === 'USG')
                            <div class="col-4 mb-1 border">
                                <p class="fw-bold text-black m-0">{{ $item->name ?? '' }} :</p>
                                <div class="mb-3 mx-0">
                                    @foreach ($item->radiologiFormRequestMasters->where('isActive', true) as $index => $variabel)
                                        <div class="row mb-2">
                                            <div class="col-9">
                                                @if ($variabel->input_type == 'text')
                                                    <input type="hidden"
                                                        name="lainnya[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                        value="{{ $variabel->id }}"
                                                        id="defaultCheck{{ $variabel->id }}" />
                                                @endif
                                                @if ($variabel->input_type == 'checkbox')
                                                    <input class="form-check-input" type="checkbox"
                                                        name="data[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                        value="{{ $variabel->id }}"
                                                        id="defaultCheck{{ $variabel->id }}" />
                                                @endif

                                                <label class="form-check-label mx-2"
                                                    for="defaultCheck{{ $variabel->id }}">
                                                    {{ $variabel->name ?? '' }}
                                                </label>
                                            </div>

                                            @if ($variabel->input_type == 'text')
                                                <div class="col-4">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="lainnya[{{ $variabel->id }}][nilai]" />
                                                </div>
                                            @endif
                                            <div class="col-auto ">
                                                @foreach ($variabel->radiologiFormRequestMasterDetails->where('isActive', true) as $detail)
                                                    <input class="form-check-input" type="radio"
                                                        name="data[{{ $variabel->id }}][radiologi_form_request_master_detail_id]"
                                                        value="{{ $detail->id }}"
                                                        id="d{{ $detail->id }}{{ $variabel->id }}" />
                                                    <label class="form-check-label"
                                                        for="d{{ $detail->id }}{{ $variabel->id }}">{{ $detail->name ?? '' }}</label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if ($item->name === 'KONTRAS')
                            <div class="col-4 mb-1 border">
                                <p class="fw-bold text-black m-0">{{ $item->name ?? '' }} :</p>
                                <div class="mb-3 mx-0">
                                    @foreach ($item->radiologiFormRequestMasters->where('isActive', true) as $index => $variabel)
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                @if ($variabel->input_type == 'text')
                                                    <input type="hidden"
                                                        name="lainnya[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                        value="{{ $variabel->id }}"
                                                        id="defaultCheck{{ $variabel->id }}" />
                                                @endif
                                                @if ($variabel->input_type == 'checkbox')
                                                    <input class="form-check-input" type="checkbox"
                                                        name="data[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                        value="{{ $variabel->id }}"
                                                        id="defaultCheck{{ $variabel->id }}" />
                                                @endif

                                                <label class="form-check-label mx-2"
                                                    for="defaultCheck{{ $variabel->id }}">
                                                    {{ $variabel->name ?? '' }}
                                                </label>
                                            </div>

                                            @if ($variabel->input_type == 'text')
                                                <div class="col-4">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="lainnya[{{ $variabel->id }}][nilai]" />
                                                </div>
                                            @endif
                                            <div class="col-auto ">
                                                @foreach ($variabel->radiologiFormRequestMasterDetails->where('isActive', true) as $detail)
                                                    <input class="form-check-input" type="radio"
                                                        name="data[{{ $variabel->id }}][radiologi_form_request_master_detail_id]"
                                                        value="{{ $detail->id }}"
                                                        id="d{{ $detail->id }}{{ $variabel->id }}" />
                                                    <label class="form-check-label"
                                                        for="d{{ $detail->id }}{{ $variabel->id }}">{{ $detail->name ?? '' }}</label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if ($item->name === 'PEMERIKSAAN LAINNYA')
                            <div class="col-4 mb-1 border">
                                <p class="fw-bold text-black m-0">{{ $item->name ?? '' }} :</p>
                                <div class="mb-3 mx-0">
                                    @foreach ($item->radiologiFormRequestMasters->where('isActive', true) as $index => $variabel)
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                @if ($variabel->input_type == 'text')
                                                    <input type="hidden"
                                                        name="lainnya[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                        value="{{ $variabel->id }}"
                                                        id="defaultCheck{{ $variabel->id }}" />
                                                @endif
                                                @if ($variabel->input_type == 'checkbox')
                                                    <input class="form-check-input" type="checkbox"
                                                        name="data[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                        value="{{ $variabel->id }}"
                                                        id="defaultCheck{{ $variabel->id }}" />
                                                @endif

                                                <label class="form-check-label mx-2"
                                                    for="defaultCheck{{ $variabel->id }}">
                                                    {{ $variabel->name ?? '' }}
                                                </label>
                                            </div>

                                            @if ($variabel->input_type == 'text')
                                                <div class="col-4">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="lainnya[{{ $variabel->id }}][nilai]" />
                                                </div>
                                            @endif
                                            <div class="col-auto ">
                                                @foreach ($variabel->radiologiFormRequestMasterDetails->where('isActive', true) as $detail)
                                                    <input class="form-check-input" type="radio"
                                                        name="data[{{ $variabel->id }}][radiologi_form_request_master_detail_id]"
                                                        value="{{ $detail->id }}"
                                                        id="d{{ $detail->id }}{{ $variabel->id }}" />
                                                    <label class="form-check-label"
                                                        for="d{{ $detail->id }}{{ $variabel->id }}">{{ $detail->name ?? '' }}</label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div> --}}
                {{-- ORI --}}
                {{-- <div class="col-4 bg-danger mb-1 border">
                        <p class="fw-bold text-black m-0">{{ $item->name ?? '' }} :</p>
                        <div class="mb-3 mx-0">
                            @foreach ($item->radiologiFormRequestMasters->where('isActive', true) as $index => $variabel)
                                <div class="row mb-2">
                                    <div class="col-3">
                                        @if ($variabel->input_type == 'text')
                                            <input type="hidden"
                                                name="lainnya[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                value="{{ $variabel->id }}"
                                                id="defaultCheck{{ $variabel->id }}" />
                                        @endif
                                        @if ($variabel->input_type == 'checkbox')
                                            <input class="form-check-input" type="checkbox"
                                                name="data[{{ $variabel->id }}][radiologi_form_request_master_id]"
                                                value="{{ $variabel->id }}"
                                                id="defaultCheck{{ $variabel->id }}" />
                                        @endif

                                        <label class="form-check-label mx-2" for="defaultCheck{{ $variabel->id }}">
                                            {{ $variabel->name ?? '' }}
                                        </label>
                                    </div>

                                    @if ($variabel->input_type == 'text')
                                        <div class="col-4">
                                            <input type="text" class="form-control form-control-sm"
                                                name="lainnya[{{ $variabel->id }}][nilai]" />
                                        </div>
                                    @endif
                                    <div class="col-auto ">
                                        @foreach ($variabel->radiologiFormRequestMasterDetails->where('isActive', true) as $detail)
                                            <input class="form-check-input" type="radio"
                                                name="data[{{ $variabel->id }}][radiologi_form_request_master_detail_id]"
                                                value="{{ $detail->id }}"
                                                id="d{{ $detail->id }}{{ $variabel->id }}" />
                                            <label class="form-check-label"
                                                for="d{{ $detail->id }}{{ $variabel->id }}">{{ $detail->name ?? '' }}</label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> --}}
                {{-- END ORI --}}
                <div class="my-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    {{-- modal create ttd --}}
    <div class="modal fade" id="getTtdModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
