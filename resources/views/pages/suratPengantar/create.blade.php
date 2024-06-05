@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Buat Surat Pengantar Rawat</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('suratpengantar.store', $item->id) }}">
                @csrf
                {{-- <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Pilih Pasien</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="patient_id" required>
                            <option value="">Pilih Pasien...</option>
                            @foreach ($data as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->patient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Diagnosa Primer</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="queue_id" value="{{ $item->id }}" />
                        <input type="hidden" name="patient_id" value="{{ $item->patient->id }}" />
                        <input type="text" name="diagnosa_primer" class="form-control" id="basic-default-name" value="{{ $diagnosa[0] ?? '' }}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Diagnosa Sekunder</label>
                    <div class="col-sm-10">
                        <div id="diagnosa_sekunder_container">
                            @if (empty($diagnosaSekunder))
                            <div class="input-group mb-2">
                                <input type="text" name="diagnosa_sekunder[]" class="form-control me-1 rounded" id="basic-default-name"/>
                                    <div class="input-group-addon">
                                        <button type="button" class="btn btn-dark" id="tambah"><i
                                            class="bi bi-plus">Tambah</i></button>
                                    </div>
                            </div>
                            @else
                            @foreach ($diagnosaSekunder as $sekunder)
                            <div class="input-group mb-2">
                                <input type="text" name="diagnosa_sekunder[]" class="form-control me-1 rounded" id="basic-default-name" value="{{ $sekunder ?? '' }}"/>
                                @if ($loop->first)
                                    <div class="input-group-addon">
                                        <button type="button" class="btn btn-dark" id="tambah"><i
                                            class="bi bi-plus">Tambah</i></button>
                                    </div>
                                @endif
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Rencana Tindakan</label>
                    <div class="col-sm-10">
                        <div id="diagnosa_sekunder_container">
                            {{-- @if (empty($diagnosaSekunder))
                            <div class="input-group mb-2">
                                <input type="text" name="diagnosa_sekunder[]" class="form-control me-1 rounded" id="basic-default-name"/>
                                    <div class="input-group-addon">
                                        <button type="button" class="btn btn-dark" id="tambah"><i
                                            class="bi bi-plus">Tambah</i></button>
                                    </div>
                            </div>
                            @else
                            @foreach ($diagnosaSekunder as $sekunder) --}}
                            <div class="input-group mb-2">
                                <input type="text" name="rencana_tindakan[]" class="form-control me-1 rounded" id="basic-default-name" value="{{ $sekunder ?? '' }}"/>
                                {{-- @if ($loop->first) --}}
                                    <div class="input-group-addon">
                                        <button type="button" class="btn btn-dark" id="tambah"><i
                                            class="bi bi-plus">Tambah</i></button>
                                    </div>
                                {{-- @endif --}}
                            {{-- </div>
                            @endforeach
                            @endif --}}
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Persiapan Operasi</label>
                    <div class="col-sm-10">
                        @if ($itemReqLab)
                            @foreach ($itemReqLab->laboratoriumRequestDetails as $reqLab)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan_operasi[]" value="{{ $reqLab->laboratoriumRequestMasterVariable->name }}" checked>
                                    <label class="form-check-label" for="basic-default-name">{{ $reqLab->laboratoriumRequestMasterVariable->name ?? '' }}</label>
                                </div>
                            @endforeach
                        @endif
                        @if ($itemReqRadio)
                            @foreach ($itemReqRadio->radiologiFormRequestMasters as $reqRadio)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan_operasi[]" value="{{ $reqRadio->name }}" checked>
                                    <label class="form-check-label" for="basic-default-name">{{ $reqRadio->name ?? '' }}</label>
                                </div>
                            @endforeach
                        @endif
                        @if (!$itemReqLab && !$itemReqRadio)
                            {{ 'belum ada pemeriksaan penunjang yang terdaftar' }}
                        @endif
                        @error('persiapan_operasi')
                        <div class="text-danger">
                            <small>*Persiapan operasi tidak boleh kosong</small>
                        </div>
                        @enderror
                    </div>

                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal / Jam Operasi</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="tgl_operasi" class="form-control" id="tgl_operasi" value="{{ date('Y-m-d H:i') }}"/>
                        @error('tgl_operasi')
                        <div class="text-danger">
                            <small>*tanggal operasi tidak boleh kosong</small>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Terapi</label>
                    <div class="col-sm-10">
                        <div id="terapi_container">
                            <div class="input-group mb-2">
                                <input type="terapi" name="terapi[]" class="form-control me-1 rounded"
                                    id="basic-default-name" />
                                <div class="input-group-addon">
                                    <button type="button" class="btn btn-dark" id="tambah_terapi"><i
                                            class="bi bi-plus">Tambah</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Alat</label>
                    <div class="col-sm-10">
                        <input type="alat" name="alat" class="form-control" id="basic-default-name" value="{{ old('alat') }}" />
                        @error('alat')
                        <div class="text-danger">
                            <small>*form alat tidak boleh kosong</small>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Prioritas Kebutuhan</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="prioritas_kebutuhan[]"
                                value="Preventif">
                            <label class="form-check-label" for="basic-default-name">Preventif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="prioritas_kebutuhan[]"
                                value="Paliatif">
                            <label class="form-check-label" for="basic-default-name">Paliatif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="prioritas_kebutuhan[]"
                                value="Ruangan Biasa">
                            <label class="form-check-label" for="basic-default-name">Ruangan Biasa</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="prioritas_kebutuhan[]"
                                value="Kuratif">
                            <label class="form-check-label" for="basic-default-name">Kuratif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="prioritas_kebutuhan[]"
                                value="Rehabilitatif">
                            <label class="form-check-label" for="basic-default-name">Rehabilitatif</label>
                        </div>
                        @error('prioritas_kebutuhan')
                        <div class="text-danger">
                            <small>*prioritas Kebutuhan tidak boleh kosong</small>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Ruangan</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ruangan" value="Ruangan Biasa">
                            <label class="form-check-label" for="basic-default-name">Ruangan Biasa</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ruangan" value="Ruangan Isolasi">
                            <label class="form-check-label" for="basic-default-name">Ruangan Isolasi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ruangan" value="HCU">
                            <label class="form-check-label" for="basic-default-name">ICU</label>
                        </div>
                        @error('ruangan')
                        <div class="text-danger">
                            <small>*Ruangan tidak boleh kosong</small>
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script>
        // tambah diagnosa sekunder
        function tambah() {
            var inputGroup = document.createElement("div");
            inputGroup.className = "input-group mb-2";

            var input = document.createElement("input");
            input.type = "text";
            input.name = "diagnosa_sekunder[]";
            input.className = "form-control me-1 rounded";

            var inputGroupAddon = document.createElement("div");
            inputGroupAddon.className = "input-group-addon";

            var button = document.createElement("button");
            button.type = "button";
            button.className = "btn btn-danger btn-remove";
            button.innerText = "Hapus";

            // Attach a click event to the remove button to remove the input group.
            button.addEventListener("click", function() {
                inputGroup.remove();
            });

            inputGroupAddon.appendChild(button);
            inputGroup.appendChild(input);
            inputGroup.appendChild(inputGroupAddon);

            document.getElementById("diagnosa_sekunder_container").appendChild(inputGroup);
        }

        // Attach the click event handler to the "Tambah" button.
        document.getElementById("tambah").addEventListener("click", tambah);

        function tambahTerapi() {
            var inputGroup = document.createElement("div");
            inputGroup.className = "input-group mb-2";

            var input = document.createElement("input");
            input.type = "terapi";
            input.name = "terapi[]";
            input.className = "form-control me-1 rounded";

            var button = document.createElement("button");
            button.type = "button";
            button.className = "btn btn-danger btn-remove";
            button.innerText = "Hapus";

            // Attach a click event to the remove button to remove the input group.
            button.addEventListener("click", function() {
                inputGroup.remove();
            });

            var inputGroupAddon = document.createElement("div");
            inputGroupAddon.className = "input-group-addon";
            inputGroupAddon.appendChild(button);

            inputGroup.appendChild(input);
            inputGroup.appendChild(inputGroupAddon);

            document.getElementById("terapi_container").appendChild(inputGroup);
        }

        // Attach the click event handler to the "Tambah Terapi" button.
        document.getElementById("tambah_terapi").addEventListener("click", tambahTerapi);
    </script>
@endsection
