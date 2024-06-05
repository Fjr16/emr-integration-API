@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Surat Pengantar Rawat 
                <span class="text text-primary">{{ $item->patient->name ?? '' }}</span>
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('igd/suratpengantar.update', $item->id) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Diagnosa Primer</label>
                    <div class="col-sm-10">
                        <input type="text" name="diagnosa_primer" class="form-control" id="basic-default-name" value="{{ $item->primer ?? '' }}">
                        <input type="hidden" name="previous_url" value="{{ $previousUrl }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Diagnosa Sekunder</label>
                    <div class="col-sm-10">
                        @if ($data4->isEmpty())
                        <div id="diagnosa_sekunder_container">
                        <div class="input-group mb-2">
                            <input type="text" name="diagnosa_sekunder[]" class="form-control me-1 rounded" id="basic-default-name"/>
                            <div class="input-group-addon">
                                <button type="button" class="btn btn-dark" id="tambah"><i
                                    class="bi bi-plus">Tambah</i></button>
                            </div>
                        </div>
                        </div>
                        @else
                            @foreach ($data4 as $sekunder)
                                <input type="text" name="diagnosa_sekunder[]" class="form-control mb-3"
                                    id="basic-default-name" value="{{ $sekunder->name }}">
                            @endforeach
                        @endif

                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Persiapan Operasi</label>
                    <div class="col-sm-10">
                        @if ($data2->isEmpty())
                            {{ 'Tidak ada pemeriksaan penunjang yang terdaftar' }}
                        @else       
                            @foreach ($data2 as $operasi)    
                            <div class="form-check">
                                <input class="form-check-input" id="persiapan_operasi{{ $operasi->id }}" type="checkbox" name="persiapan_operasi[]" value="{{ $operasi->name ?? '' }}" checked>
                                <label class="form-check-label" for="persiapan_operasi{{ $operasi->id }}">{{ $operasi->name ?? '' }}</label>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal / Jam Operasi</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="tgl_operasi" class="form-control" id="tgl_operasi" value="{{ $item->tgl_operasi, date('Y-m-d H:i') }}"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Terapi</label>
                    <div class="col-sm-10">
                        @if ($data3->isEmpty())
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
                        @else    
                        @foreach ($data3 as $terapi)
                            <input type="terapi" name="terapi[]" class="form-control" id="basic-default-name"
                                value="{{ $terapi->name }}">
                            <br>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Alat</label>
                    <div class="col-sm-10">
                        <input type="alat" name="alat" class="form-control" id="basic-default-name"
                            value="{{ $item->alat }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Prioritas Kebutuhan</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="prioritas_kebutuhan[]" id="Preventif"
                                value="Preventif" {{ in_array('Preventif', $data5) ? 'checked' : '' }}> 
                            <label class="form-check-label" for="Preventif">Preventif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="prioritas_kebutuhan[]" id="Paliatif"
                                value="Paliatif" {{ in_array('Paliatif', $data5) ? 'checked' : '' }}> 
                            <label class="form-check-label" for="Paliatif">Paliatif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="prioritas_kebutuhan[]" id="Ruangan-Biasa-p"
                                value="Ruangan Biasa" {{ in_array('Ruangan Biasa', $data5) ? 'checked' : '' }}> 
                            <label class="form-check-label" for="Ruangan-Biasa-p">Ruangan Biasa</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="prioritas_kebutuhan[]" value="Kuratif" id="Kuratif"
                                {{ in_array('Kuratif', $data5) ? 'checked' : '' }}> 
                            <label class="form-check-label" for="Kuratif">Kuratif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="prioritas_kebutuhan[]" id="Rehabilitatif"
                                value="Rehabilitatif" {{ in_array('Rehabilitatif', $data5) ? 'checked' : '' }}>
                            <label class="form-check-label" for="Rehabilitatif">Rehabilitatif</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Ruangan</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ruangan" value="Ruangan Biasa" id="Ruangan Biasa"
                                {{ $item->ruangan == 'Ruangan Biasa' ? 'checked' : '' }}>
                            <label class="form-check-label" for="Ruangan Biasa">Ruangan Biasa</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ruangan" value="Ruangan Isolasi" id="Ruangan Isolasi"
                                {{ $item->ruangan == 'Ruangan Isolasi' ? 'checked' : '' }}>
                            <label class="form-check-label" for="Ruangan Isolasi">Ruangan Isolasi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ruangan" value="HCU" id="HCU"
                                {{ $item->ruangan == 'HCU' ? 'checked' : '' }}>
                            <label class="form-check-label" for="HCU">ICU</label>
                        </div>

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

    </script>
    <script>
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
