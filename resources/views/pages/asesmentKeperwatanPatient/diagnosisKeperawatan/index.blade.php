@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header m-0">
            <div class="row">
                <div class="col-9">
                    <h5 class="mb-0 m-0">Asesmen Perawat <span
                            class="fs-4 fw-bold text-primary">{{ $item->patient->name ?? '' }}</span></h5>
                </div>
                <div class="col-3 m-0 text-end">
                    <a href="{{ route('rajal/show', ['id' => $item->id, 'title' => 'Rawat Jalan']) }}"
                        class="btn btn-success btn-sm">Kembali</a>
                </div>
            </div>
            <div class="row m-auto mt-2">
                <a href="{{ route('rajal/asesmen/status/fisik.index', $item->id) }}"
                    class="btn {{ Route::is('rajal/asesmen/status/fisik.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Status
                    Fisik</a>
                <a href="{{ route('rajal/asesmen/skrining/resiko/jatuh.index', $item->id) }}"
                    class="btn {{ Route::is('rajal/asesmen/skrining/resiko/jatuh.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Skrining
                    Resiko Jatuh</a>
                <a href="{{ route('rajal/asesmen/diagnosis/keperawatan.index', $item->id) }}"
                    class="btn {{ Route::is('rajal/asesmen/diagnosis/keperawatan.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Diagnosis
                    Keperawatan</a>
                <a href="{{ route('rajal/asesmen/rencana/asuhan.index', $item->id) }}"
                    class="btn {{ Route::is('rajal/asesmen/rencana/asuhan.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Rencana
                    Asuhan</a>
            </div>
        </div>

        <div class="card-body">
            <h6 class="text-center bg-dark text-white py-2">DIAGNOSIS KEPERAWATAN</h6>
            <form action="{{ route('rajal/asesmen/diagnosis/keperawatan.store', $item->id) }}" method="POST">
                @csrf
                <!-- Diagnosis Ansietas -->
                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input" type="checkbox" name="diagnosis-keperawatan[]" value="Ansietas"
                            id="ansietasCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Ansietas')->first() ? 'checked' : '' }} />
                        <label class="form-check-label" for="ansietasCheck">
                            Ansietas
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdAnsietas as $bd)
                            @php
                                $checked = null;
                                if ($detailDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $bd)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                    }
                                }
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input ansietas-option" type="checkbox" value="{{ $bd }}"
                                    name="ansietas[]" id="ansietasOption{{ $loop->index + 2 }}" disabled
                                    {{ $checked }} />
                                <label class="form-check-label" for="ansietasOption{{ $loop->index + 2 }}">
                                    {{ $bd }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Diagnosis Nyeri Akut -->
                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input" type="checkbox" value="Nyeri Akut" name="diagnosis-keperawatan[]"
                            id="nyeriAkutCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Nyeri Akut')->first() ? 'checked' : '' }} />
                        <label class="form-check-label" for="nyeriAkutCheck">
                            Nyeri Akut
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdNyeri as $key => $subOptions)
                            @php
                                $checked = null;
                                $selectedDetail = null;

                                if ($detailDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $key)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                        $selectedDetail = $detail->detail_name;
                                    }
                                }
                            @endphp

                            <div class="form-check">
                                <input class="form-check-input nyeri-akut-option" type="checkbox" name="nyeri-akut[]"
                                    value="{{ $key }}" id="nyeriAkutOption{{ $loop->index }}"
                                    {{ $checked }}>
                                <label class="form-check-label" for="nyeriAkutOption{{ $loop->index }}">
                                    {{ $key }}
                                </label>
                            </div>
                            <div id="subOptions{{ $loop->index }}" class="sub-options"
                                style="display: none; margin-left: 20px;">
                                @foreach ($subOptions as $subOption)
                                    @php
                                        $subChecked = $selectedDetail == $subOption ? 'checked' : '';
                                    @endphp
                                    <div class="form-check">
                                        <input class="form-check-input nyeri-akut-sub" type="radio"
                                            name="detail-nyeri[{{ $key }}]" value="{{ $subOption }}"
                                            id="subOption{{ $loop->parent->index }}{{ $loop->index }}"
                                            {{ $subChecked }}>
                                        <label class="form-check-label"
                                            for="subOption{{ $loop->parent->index }}{{ $loop->index }}">
                                            {{ $subOption }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- Diagnosis Nyeri Kronis -->
                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input" type="checkbox" value="Nyeri Kronis" name="diagnosis-keperawatan[]"
                            id="nyeriKronisCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Nyeri Kronis')->first() ? 'checked' : '' }} />
                        <label class="form-check-label" for="nyeriKronisCheck">
                            Nyeri Kronis
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdNyeriKronis as $key => $subOptions)
                            @php
                                $checked = null;
                                $selectedDetail = null;

                                if ($detailDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $key)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                        $selectedDetail = $detail->detail_name;
                                    }
                                }
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input nyeri-kronis-option" type="checkbox" name="nyeri-kronis[]"
                                    value="{{ $key }}" id="nyeriKronisOption{{ $loop->index }}"
                                    {{ $checked }} disabled>
                                <label class="form-check-label" for="nyeriKronisOption{{ $loop->index }}">
                                    {{ $key }}
                                </label>
                            </div>
                            @if (!empty($subOptions))
                                <div id="subOptionsKronis{{ $loop->index }}" class="sub-options"
                                    style="display: none; margin-left: 20px;">
                                    @foreach ($subOptions as $subOption)
                                        @php
                                            $subChecked = $selectedDetail == $subOption ? 'checked' : '';
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input nyeri-kronis-sub" type="radio"
                                                name="detail-nyeri[{{ $key }}]" value="{{ $subOption }}"
                                                id="subOptionKronis{{ $loop->parent->index }}{{ $loop->index }}"
                                                {{ $subChecked }}>
                                            <label class="form-check-label"
                                                for="subOptionKronis{{ $loop->parent->index }}{{ $loop->index }}">
                                                {{ $subOption }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Diagnosis Gangguan Mobilitas Fisik -->
                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input" type="checkbox" value="Gangguan Mobilitas Fisik"
                            name="diagnosis-keperawatan[]" id="mobilitasCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Gangguan Mobilitas Fisik')->first() ? 'checked' : '' }} />
                        <label class="form-check-label" for="mobilitasCheck">
                            Gangguan Mobilitas Fisik
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdFisik as $bd)
                            @php
                                $checked = null;
                                if ($asesmenDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $bd)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                    }
                                }
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input mobilitas-option" type="checkbox"
                                    value="{{ $bd }}" name="gangguan-mobilitas-fisik[]"
                                    id="mobilitasOption{{ $loop->index + 2 }}" disabled {{ $checked }} />
                                <label class="form-check-label" for="mobilitasOption{{ $loop->index + 2 }}">
                                    {{ $bd }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Diagnosis Gangguan Integritas Kulit -->
                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input" type="checkbox" value="Gangguan Integritas Kulit"
                            name="diagnosis-keperawatan[]" id="kulitCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Gangguan Integritas Kulit')->first() ? 'checked' : '' }} />
                        <label class="form-check-label" for="kulitCheck">
                            Gangguan Integritas Kulit
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdKulit as $key => $subOptions)
                            @php
                                $checked = null;
                                $selectedDetail = null;

                                if ($detailDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $key)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                        $selectedDetail = $detail->detail_name;
                                    }
                                }
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input kulit-option" type="checkbox"
                                    name="gangguan-integritas-kulit[]" value="{{ $key }}"
                                    id="kulitOption{{ $loop->index }}" {{ $checked }} disabled>
                                <label class="form-check-label" for="kulitOption{{ $loop->index }}">
                                    {{ $key }}
                                </label>
                            </div>
                            @if (!empty($subOptions))
                                <div id="subOptionsKulit{{ $loop->index }}" class="sub-options"
                                    style="display: none; margin-left: 20px;">
                                    @foreach ($subOptions as $subOption)
                                        @php
                                            $subChecked = $selectedDetail == trim($subOption) ? 'checked' : '';
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input kulit-sub" type="radio"
                                                name="detail-nyeri[{{ $key }}]" value="{{ trim($subOption) }}"
                                                id="subOptionKulit{{ $loop->parent->index }}{{ $loop->index }}"
                                                {{ $subChecked }}>
                                            <label class="form-check-label"
                                                for="subOptionKulit{{ $loop->parent->index }}{{ $loop->index }}">
                                                {{ trim($subOption) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- Diagnosis Gangguan Integritas Jaringan -->
                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input" type="checkbox" value="Gangguan Integritas Jaringan"
                            name="diagnosis-keperawatan[]" id="jaringanCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Gangguan Integritas Jaringan')->first() ? 'checked' : '' }} />
                        <label class="form-check-label" for="jaringanCheck">
                            Gangguan Integritas Jaringan
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdJaringan as $key => $subOptions)
                            @php
                                $checked = null;
                                $selectedDetail = null;

                                if ($detailDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $key)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                        $selectedDetail = $detail->detail_name;
                                    }
                                }
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input jaringan-option" type="checkbox"
                                    name="gangguan-integritas-jaringan[]" value="{{ $key }}"
                                    id="jaringanOption{{ $loop->index }}" {{ $checked }} disabled>
                                <label class="form-check-label" for="jaringanOption{{ $loop->index }}">
                                    {{ $key }}
                                </label>
                            </div>
                            @if (!empty($subOptions))
                                <div id="subOptionsJaringan{{ $loop->index }}" class="sub-options"
                                    style="display: none; margin-left: 20px;">
                                    @foreach ($subOptions as $subOption)
                                        @php
                                            $subChecked = $selectedDetail == trim($subOption) ? 'checked' : '';
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input jaringan-sub" type="radio"
                                                name="detail-nyeri[{{ $key }}]" value="{{ trim($subOption) }}"
                                                id="subOptionJaringan{{ $loop->parent->index }}{{ $loop->index }}"
                                                {{ $subChecked }}>
                                            <label class="form-check-label"
                                                for="subOptionJaringan{{ $loop->parent->index }}{{ $loop->index }}">
                                                {{ trim($subOption) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>


                <!-- Diagnosis Retensi Urine -->
                <div class="row mb-3">
                    <div class="col-sm-3 form-check mx-4">
                        <input class="form-check-input" type="checkbox" value="Retensi Urine"
                            name="diagnosis-keperawatan[]" id="urineCheck"
                            {{ $asesmenDiagnosa->where('diagnosa', 'Retensi Urine')->first() ? 'checked' : '' }} />
                        <label class="form-check-label" for="urineCheck">
                            Retensi Urine
                        </label>
                    </div>
                    <div class="col-sm-1">
                        <p class="m-0 fw-bold">b.d.</p>
                    </div>
                    <div class="col-sm-7">
                        @foreach ($bdUrine as $key => $subOptions)
                            @php
                                $checked = null;
                                $selectedDetail = null;

                                if ($detailDiagnosa) {
                                    $detail = $detailDiagnosa->where('name', $key)->first();
                                    if ($detail) {
                                        $checked = 'checked';
                                        $selectedDetail = $detail->detail_name;
                                    }
                                }
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input urine-option" type="checkbox" name="retensi-urine[]"
                                    value="{{ $key }}" id="urineOption{{ $loop->index }}" {{ $checked }}
                                    disabled>
                                <label class="form-check-label" for="urineOption{{ $loop->index }}">
                                    {{ $key }}
                                </label>
                            </div>
                            @if (!empty($subOptions))
                                <div id="subOptionsUrine{{ $loop->index }}" class="sub-options"
                                    style="display: none; margin-left: 20px;">
                                    @foreach ($subOptions as $subOption)
                                        @php
                                            $subChecked = $selectedDetail == trim($subOption) ? 'checked' : '';
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input urine-sub" type="radio"
                                                name="detail-nyeri[{{ $key }}]" value="{{ trim($subOption) }}"
                                                id="subOptionUrine{{ $loop->parent->index }}{{ $loop->index }}"
                                                {{ $subChecked }}>
                                            <label class="form-check-label"
                                                for="subOptionUrine{{ $loop->parent->index }}{{ $loop->index }}">
                                                {{ trim($subOption) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Input Lainnya -->
                @php
                    $excludedDiagnoses = [
                        'Ansietas',
                        'Nyeri Akut',
                        'Nyeri Kronis',
                        'Retensi Urine',
                        'Gangguan Mobilitas Fisik',
                        'Gangguan Integritas Kulit',
                        'Gangguan Integritas Jaringan',
                    ];
                    $otherDiagnosis = $asesmenDiagnosa
                        ->filter(function ($diagnosa) use ($excludedDiagnoses) {
                            return !in_array($diagnosa->diagnosa, $excludedDiagnoses);
                        })
                        ->first();
                @endphp

                <div class="row mb-3">
                    <div class="col-sm-3 form-check">
                        <div class="d-flex align-items-center">
                            <label class="form-control-label col-sm-4" for="lainnya">Lainnya</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="lainnya"
                                    name="diagnosis-lainnya" placeholder="" aria-describedby="floatingInputHelp"
                                    value="{{ $asesmenDiagnosa->whereNotIn('diagnosa', $excludedDiagnoses)->pluck('diagnosa')->first() }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1 mx-4">
                        <p class="fw-bold mx-4">b.d.</p>
                    </div>
                    <div class="col-sm-4">
                        <div id="input-container1" class="row">
                            @foreach ($detailDiagnosa->whereNotIn('diagnosa', $excludedDiagnoses) as $detail)
                                <input class="form-control form-control-sm mx-3 mb-2" style="max-width: 300px"
                                    name="lainnya[]" value="{{ $detail->name }}" type="text"
                                    aria-label=".form-control-sm example">
                            @endforeach
                            <a class="btn btn-sm btn-dark text-white" style="max-width: 40px"
                                onclick="addInput('input-container1')">+</a>
                        </div>

                    </div>
                </div>

                <h6 class="text-center bg-dark text-white py-2">MASALAH KEPERAWATAN</h6>
                <!-- Input Masalah Keperawatan -->
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <div class="mx-2">


                            @foreach ($masalahKeperawatan as $keperawatan)
                                @php
                                    $checked = null;
                                    if ($masalah) {
                                        $detail = $masalah->where('diagnosa', $keperawatan)->first();
                                        if ($detail) {
                                            $checked = 'checked';
                                        }
                                    }
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input masalah-keperawatan" type="checkbox"
                                        value="{{ $keperawatan }}" name="masalah-keperawatan[]"
                                        id="masalah_{{ $keperawatan }}" {{ $checked }} />
                                    <label class="form-check-label" for="masalah_{{ $keperawatan }}">
                                        {{ $keperawatan }}
                                    </label>
                                </div>
                            @endforeach

                            <div class="" id="masalahKeperawatanList">
                                <!-- Opsi masalah keperawatan akan ditambahkan secara otomatis oleh JavaScript -->
                            </div>

                            @php
                                $masalahKeperawatanLainnya = $masalah
                                    ->whereNotIn('diagnosa', $masalahKeperawatan)
                                    ->pluck('diagnosa')
                                    ->first();
                            @endphp
                            @if ($masalahKeperawatanLainnya)
                                <div class="form-check" id="otherDiagnosisContainer">
                                    <input class="form-check-input masalah-keperawatan" type="checkbox"
                                        value="{{ $masalahKeperawatanLainnya }}" name="masalah-keperawatan[]"
                                        id="masalah_lainnya" checked />
                                    <label class="form-check-label" for="masalah_lainnya">
                                        {{ $masalahKeperawatanLainnya }}
                                    </label>
                                </div>
                            @endif




                        </div>
                    </div>
                </div>

                <button class="btn btn-sm btn-primary" type="submit">Submit</button>
            </form>
        </div>

    </div>

    <script>
        // Fungsi untuk menambahkan input field secara dinamis
        function addInput(containerId) {
            var container = document.getElementById(containerId);
            var inputCount = container.querySelectorAll('.lainnya-input').length;

            var newInput = document.createElement('input');
            newInput.setAttribute('type', 'text');
            newInput.setAttribute('class', 'form-control form-control-sm mx-3 mb-2 lainnya-input');
            newInput.setAttribute('name', 'lainnya[]');
            newInput.setAttribute('placeholder', 'Inputkan lainnya');
            newInput.setAttribute('aria-label', '.form-control-sm example');
            newInput.setAttribute('id', 'lainnya_' + inputCount);
            container.innerHTML = ''; // Menghapus semua input sebelum menambahkan yang baru
            container.appendChild(newInput);
        }

        // Fungsi untuk memperbarui diagnosa lainnya ke masalah keperawatan
        function updateOtherDiagnosisInNursingProblems(diagnosis) {
            var otherDiagnosisContainer = document.getElementById('otherDiagnosisContainer');

            if (otherDiagnosisContainer) {
                // Jika sudah ada, perbarui label dan nilai
                var existingCheckbox = document.getElementById('masalah_lainnya');
                if (existingCheckbox) {
                    existingCheckbox.value = diagnosis;
                    existingCheckbox.checked = true;
                }
                var existingLabel = document.querySelector('label[for="masalah_lainnya"]');
                if (existingLabel) {
                    existingLabel.textContent = diagnosis;
                }
            } else {
                // Jika belum ada, tambahkan yang baru
                var nursingProblemList = document.getElementById('masalahKeperawatanList');

                var div = document.createElement('div');
                div.setAttribute('class', 'form-check');
                div.setAttribute('id', 'otherDiagnosisContainer');

                var checkbox = document.createElement('input');
                checkbox.setAttribute('class', 'form-check-input masalah-keperawatan');
                checkbox.setAttribute('type', 'checkbox');
                checkbox.setAttribute('value', diagnosis);
                checkbox.setAttribute('name', 'masalah-keperawatan[]');
                checkbox.setAttribute('id', 'masalah_lainnya');
                checkbox.setAttribute('checked', 'true'); // Check otomatis saat ditambahkan
                div.appendChild(checkbox);

                var label = document.createElement('label');
                label.setAttribute('class', 'form-check-label');
                label.setAttribute('for', 'masalah_lainnya');
                label.textContent = diagnosis;
                div.appendChild(label);

                nursingProblemList.appendChild(div);
            }
        }

        // Tambahkan event listener untuk input "Lainnya"
        var otherDiagnosisInput = document.getElementById('lainnya');
        otherDiagnosisInput.addEventListener('input', function() {
            var diagnosis = otherDiagnosisInput.value.trim();
            if (diagnosis !== '') {
                updateOtherDiagnosisInNursingProblems(diagnosis);
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var checks = [{
                    main: document.getElementById('jaringanCheck'),
                    options: document.querySelectorAll('.jaringan-option'),
                    subOptions: document.querySelectorAll('.jaringan-sub')
                },
                {
                    main: document.getElementById('urineCheck'),
                    options: document.querySelectorAll('.urine-option'),
                    subOptions: document.querySelectorAll('.urine-sub')
                },
                {
                    main: document.getElementById('nyeriAkutCheck'),
                    options: document.querySelectorAll('.nyeri-akut-option'),
                    subOptions: document.querySelectorAll('.nyeri-akut-sub')
                },
                {
                    main: document.getElementById('nyeriKronisCheck'),
                    options: document.querySelectorAll('.nyeri-kronis-option'),
                    subOptions: document.querySelectorAll('.nyeri-kronis-sub')
                },
                {
                    main: document.getElementById('kulitCheck'),
                    options: document.querySelectorAll('.kulit-option'),
                    subOptions: document.querySelectorAll('.kulit-sub')
                }
            ];

            // Fungsi untuk mengatur status disabled dan mengosongkan nilai
            function toggleOptions(mainCheck, options, subOptions) {
                if (mainCheck.checked) {
                    options.forEach(function(option) {
                        option.disabled = false;
                    });
                    subOptions.forEach(function(subOption) {
                        subOption.disabled = false;
                    });
                } else {
                    options.forEach(function(option) {
                        option.checked = false;
                        option.disabled = true;
                    });
                    subOptions.forEach(function(subOption) {
                        subOption.checked = false;
                        subOption.disabled = true;
                    });
                }
            }

            // Event listener untuk checkbox utama
            checks.forEach(function(check) {
                check.main.addEventListener('change', function() {
                    toggleOptions(check.main, check.options, check.subOptions);
                });
            });

            // Set initial state based on the checkbox status
            checks.forEach(function(check) {
                toggleOptions(check.main, check.options, check.subOptions);
            });
        });
    </script>
    <script>
        function handleCheckboxChange(mainCheckboxId, optionClass) {
            var mainCheckbox = document.getElementById(mainCheckboxId);
            var options = document.querySelectorAll('.' + optionClass);

            function toggleOptions() {
                options.forEach(function(option) {
                    var radioButtons = document.querySelectorAll('.nyeri-kronis-sub');

                    if (!mainCheckbox.checked) {
                        if (option.type === 'checkbox') {
                            option.checked = false;
                            option.disabled =
                                true; // Set sub-checkboxes to unchecked when main checkbox is unchecked

                            // Loop melalui setiap radio button dan atur nilainya menjadi kosong dan nonaktifkan
                            // radioButtons.forEach(function(radioButton) {
                            //     radioButton.checked = ''; // Mengosongkan nilai
                            //     radioButton.disabled = true; // Menonaktifkan
                            // });
                        }
                    } else {
                        option.disabled = false; // Enable sub-options
                    }
                });

                // Reset radio buttons inside sub-options
                if (!mainCheckbox.checked) {
                    options.forEach(function(option) {
                        if (option.type === 'radio') {
                            option.checked = false; // Uncheck radio buttons when main checkbox is unchecked
                        }
                    });
                }
            }

            mainCheckbox.addEventListener('change', toggleOptions);
            toggleOptions(); // Ensure correct initial state
        }

        handleCheckboxChange('ansietasCheck', 'ansietas-option');
        handleCheckboxChange('nyeriAkutCheck', 'nyeri-akut-option');
        handleCheckboxChange('nyeriKronisCheck', 'nyeri-kronis-option');
        handleCheckboxChange('mobilitasCheck', 'mobilitas-option');
        handleCheckboxChange('kulitCheck', 'kulit-option');
        handleCheckboxChange('jaringanCheck', 'jaringan-option');
        handleCheckboxChange('urineCheck', 'urine-option');
    </script>
    <script>
        document.querySelectorAll('.nyeri-akut-option').forEach(option => {
            option.addEventListener('change', function() {
                const subOptionsDiv = document.getElementById('subOptions' + this.id.replace(
                    'nyeriAkutOption', ''));
                if (this.checked) {
                    subOptionsDiv.style.display = 'block';
                } else {
                    subOptionsDiv.style.display = 'none';
                    subOptionsDiv.querySelectorAll('input[type="radio"]').forEach(radio => radio.checked =
                        false);
                }
            });

            // On page load, show sub-options if checkbox is already checked
            if (option.checked) {
                document.getElementById('subOptions' + option.id.replace('nyeriAkutOption', '')).style.display =
                    'block';
            }
        });


        document.querySelectorAll('.nyeri-kronis-option').forEach(option => {
            option.addEventListener('change', function() {
                const subOptionsDiv = document.getElementById('subOptionsKronis' + this.id.replace(
                    'nyeriKronisOption', ''));
                if (this.checked) {
                    subOptionsDiv.style.display = 'block';
                } else {
                    subOptionsDiv.style.display = 'none';
                    // Reset semua radio button di dalam sub options
                    subOptionsDiv.querySelectorAll('input[type="radio"]').forEach(radio => radio.checked =
                        false);
                }
            });

            // On page load, show sub-options if checkbox is already checked
            if (option.checked) {
                const subOptionsDiv = document.getElementById('subOptionsKronis' + option.id.replace(
                    'nyeriKronisOption', ''));
                subOptionsDiv.style.display = 'block';
            } else {
                const subOptionsDiv = document.getElementById('subOptionsKronis' + option.id.replace(
                    'nyeriKronisOption', ''));
                subOptionsDiv.style.display = 'none';
                // Reset semua radio button di dalam sub options
                subOptionsDiv.querySelectorAll('input[type="radio"]').forEach(radio => radio.checked = false);
            }
        });

        document.querySelectorAll('.kulit-option').forEach(option => {
            option.addEventListener('change', function() {
                const subOptionsDivId = 'subOptionsKulit' + this.id.replace('kulitOption', '');
                const subOptionsDiv = document.getElementById(subOptionsDivId);
                console.log('Looking for element with ID:', subOptionsDivId); // Debugging

                // Pastikan subOptionsDiv ditemukan sebelum memanipulasinya
                if (subOptionsDiv) {
                    if (this.checked) {
                        subOptionsDiv.style.display = 'block';
                    } else {
                        subOptionsDiv.style.display = 'none';
                        subOptionsDiv.querySelectorAll('input[type="radio"]').forEach(radio => radio
                            .checked = false);
                    }
                } else {
                    console.log('No sub-options found for:', this.id);
                }
            });

            // On page load, show sub-options if checkbox is already checked
            if (option.checked) {
                const subOptionsDivId = 'subOptionsKulit' + option.id.replace('kulitOption', '');
                const subOptionsDiv = document.getElementById(subOptionsDivId);
                console.log('On page load, looking for element with ID:', subOptionsDivId); // Debugging

                // Pastikan subOptionsDiv ditemukan sebelum memanipulasinya
                if (subOptionsDiv) {
                    subOptionsDiv.style.display = 'block';
                } else {
                    console.log('No sub-options found on page load for:', option.id);
                }
            }
        });

        document.querySelectorAll('.jaringan-option').forEach(option => {
            option.addEventListener('change', function() {
                const subOptionsDivId = 'subOptionsJaringan' + this.id.replace('jaringanOption', '');
                const subOptionsDiv = document.getElementById(subOptionsDivId);
                console.log('Looking for element with ID:', subOptionsDivId); // Debugging

                // Pastikan subOptionsDiv ditemukan sebelum memanipulasinya
                if (subOptionsDiv) {
                    if (this.checked) {
                        subOptionsDiv.style.display = 'block';
                    } else {
                        subOptionsDiv.style.display = 'none';
                        subOptionsDiv.querySelectorAll('input[type="radio"]').forEach(radio => radio
                            .checked = false);
                    }
                } else {
                    console.log('No sub-options found for:', this.id);
                }
            });

            // On page load, show sub-options if checkbox is already checked
            if (option.checked) {
                const subOptionsDivId = 'subOptionsJaringan' + option.id.replace('jaringanOption', '');
                const subOptionsDiv = document.getElementById(subOptionsDivId);
                console.log('On page load, looking for element with ID:', subOptionsDivId); // Debugging

                // Pastikan subOptionsDiv ditemukan sebelum memanipulasinya
                if (subOptionsDiv) {
                    subOptionsDiv.style.display = 'block';
                } else {
                    console.log('No sub-options found on page load for:', option.id);
                }
            }
        });



        document.querySelectorAll('.urine-option').forEach(option => {
            option.addEventListener('change', function() {
                const subOptionsDivId = 'subOptionsUrine' + this.id.replace('urineOption', '');
                const subOptionsDiv = document.getElementById(subOptionsDivId);
                console.log('Looking for element with ID:', subOptionsDivId); // Debugging

                // Pastikan subOptionsDiv ditemukan sebelum memanipulasinya
                if (subOptionsDiv) {
                    if (this.checked) {
                        subOptionsDiv.style.display = 'block';
                    } else {
                        subOptionsDiv.style.display = 'none';
                        subOptionsDiv.querySelectorAll('input[type="radio"]').forEach(radio => radio
                            .checked = false);
                    }
                } else {
                    console.log('No sub-options found for:', this.id);
                }
            });

            // On page load, show sub-options if checkbox is already checked
            if (option.checked) {
                const subOptionsDivId = 'subOptionsUrine' + option.id.replace('urineOption', '');
                const subOptionsDiv = document.getElementById(subOptionsDivId);
                console.log('On page load, looking for element with ID:', subOptionsDivId); // Debugging

                // Pastikan subOptionsDiv ditemukan sebelum memanipulasinya
                if (subOptionsDiv) {
                    subOptionsDiv.style.display = 'block';
                } else {
                    console.log('No sub-options found on page load for:', option.id);
                }
            }
        });


        // Fungsi untuk menangani perubahan pada checkbox diagnosis
        function handleDiagnosisCheckboxChange(diagnosisCheckbox) {
            diagnosisCheckbox.addEventListener('change', function() {
                // Mendapatkan nilai diagnosis yang dipilih
                var diagnosis = diagnosisCheckbox.value;

                // Mendapatkan masalah keperawatan yang sesuai dengan diagnosis
                var correspondingMasalah = document.getElementById('masalah_' + diagnosis);

                // Jika checkbox diagnosis dicentang, isi masalah keperawatan sesuai dengan diagnosis
                if (diagnosisCheckbox.checked) {
                    // Memeriksa apakah masalah keperawatan ada
                    if (correspondingMasalah) {
                        correspondingMasalah.checked = true;
                    }
                } else {
                    // Jika checkbox diagnosis tidak dicentang, kosongkan masalah keperawatan yang sesuai dengan diagnosis
                    if (correspondingMasalah) {
                        correspondingMasalah.checked = false;
                    }
                }
            });
        }

        // Mendapatkan semua checkbox diagnosis
        var diagnosisCheckboxes = document.querySelectorAll('[name="diagnosis-keperawatan[]"]');

        // Menangani perubahan pada setiap checkbox diagnosis
        diagnosisCheckboxes.forEach(function(diagnosisCheckbox) {
            handleDiagnosisCheckboxChange(diagnosisCheckbox);

        });
    </script>
@endsection
