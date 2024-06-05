@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="mb-5 border alert alert-success w-100 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="mb-4 card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Assesmen PRA Anestesi - PRA Induksi
            </h5>
        </div>
        <form action="{{ route('assesmen/pra/anestesi/pra/induksi.store', $item->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="tglAssesment" class="form-label col-2">Tanggal Assesment</label>
                    <div class="col-4">

                        <input type="date" name="tanggal" id="tglAssesment" class="form-control form-control-sm"
                            value="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div class="mb-4 border rounded">
                    <div class="row row-cols-2">

                        <div class="col border-end">
                            <div class="p-2 ">
                                <div class="mb-3 row">
                                    <label for="dokterAnestesi" class="col-form-label col-3">Dokter Anestesi</label>
                                    <div class="col-9">
                                        <select class="form-control form-control-sm col select2" id="dokterAnestesi"
                                            name="dokter_anestesi" required>
                                            <option value="">Pilih Dokter Anestesi</option>
                                            @foreach ($dokter as $dokters)
                                                <option value="{{ $dokters->name }}"
                                                    {{ $dokters->id == Auth::user()->id ? 'selected' : '' }}>
                                                    {{ $dokters->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="asistenAnestesi" class="col-form-label col-3">Asisten Anestesi</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-sm" type="text" id="asistenAnestesi"
                                            name="asisten_anestesi" />
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="dokterBedah" class="col-form-label col-3">Dokter Bedah</label>
                                    <div class="col-9">
                                        <select class="form-control form-control-sm col select2" id="dokterBedah"
                                            name="dokter_bedah" onchange="getPatient()" required>
                                            <option value="">Pilih Dokter Bedah</option>
                                            @foreach ($dokter as $dokters)
                                                <option value="{{ $dokters->name }}"
                                                    {{ $dokters->id == $dokterBedah->user_id ? 'selected' : '' }}>
                                                    {{ $dokters->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-2">
                                <div class="mb-3 row">
                                    <label for="diagnosisPraBedah" class="col-form-label col-4">Diagnosis Pra Bedah</label>
                                    <div class="col-8">
                                        <input class="form-control form-control-sm" type="text"
                                            value="{{ $laporanOperasi->diagnosis_pra_operasi ?? '' }}"
                                            id="diagnosisPraBedah" name="diagnosis_pra_bedah" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="jenisPembedahan" class="col-form-label col-4">Jenis Pembedahan</label>
                                    <div class="col-8">
                                        <input class="form-control form-control-sm"
                                            value="{{ $laporanOperasi->nama_operasi ?? '' }}" type="text"
                                            id="jenisPembedahan" name="jenis_pembedahan" />
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="diagnosisPascaBedah" class="col-form-label col-4">Diagnosis Pasca
                                        Bedah</label>
                                    <div class="col-8">
                                        <input class="form-control form-control-sm"
                                            value="{{ $laporanOperasi->diagnosis_pasca_operasi ?? '' }}" type="text"
                                            id="diagnosisPascaBedah" name="diagnosis_pasca_bedah" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mb-4 col">
                    <div class="mb-3 row row-cols-2">
                        <div class="col">
                            <div class="mb-3 row align-items-center">
                                <div class="col-6">
                                    <div class="col align-items-center">
                                        <p class="m-0">Rencana Operasi </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row align-items-center">
                                        <label for="rencanaOperasiJam" class="m-0 form-label col-2">Jam</label>
                                        <div class="col">
                                            <input type="time" class="form-control form-control-sm"
                                                id="rencanaOperasiJam" name="jam_operasi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <p class="m-0 col-3">Status Fisik</p>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="form-check col">
                                            <input name="alergi-obat" class="form-check-input" type="checkbox"
                                                value="ASA" name="status_fisik[]" id="statusFisikASA" />
                                            <label class="form-check-label" for="statusFisikASA">
                                                ASA
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                name="status_fisik[]" id="statusFisik1" />
                                            <label class="form-check-label" for="statusFisik1">
                                                1
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="checkbox" value="2"
                                                name="status_fisik[]" id="statusFisik2" />
                                            <label class="form-check-label" for="statusFisik2">
                                                2
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="checkbox" value="3"
                                                name="status_fisik[]" id="statusFisik3" />
                                            <label class="form-check-label" for="statusFisik3">
                                                3
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="checkbox" value="4"
                                                name="status_fisik[]" id="statusFisik4" />
                                            <label class="form-check-label" for="statusFisik4">
                                                4
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="checkbox" value="5"
                                                name="status_fisik[]" id="statusFisik5" />
                                            <label class="form-check-label" for="statusFisik5">
                                                5
                                            </label>
                                        </div>
                                        <div class="form-check col">
                                            <input class="form-check-input" type="checkbox" value="E"
                                                name="status_fisik[]" id="statusFisikE" />
                                            <label class="form-check-label" for="statusFisikE">
                                                E
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3 row align-items-center">
                                <label for="puasaMulaiJam" class="m-0 form-label col-4">Puasa mulai jam</label>
                                <div class="col-8">
                                    <input type="time" class="form-control form-control-sm" id="puasaMulaiJam"
                                        name="puasa_jam">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <label for="" class="m-0 form-label col-3">Alergi</label>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="1"
                                                    id="alergiYa" name="isAlergi" />
                                                <label class="form-check-label" for="alergiYa">
                                                    Ya
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" value="0"
                                                    id="alergiTidak" name="isAlergi" />
                                                <label class="form-check-label" for="alergiTidak">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <p class="m-0 col-2">Penyulit Pra Anestesi</p>
                        <div class="col-10">
                            <textarea class="form-control" id="editor" rows="3" name="penyulit_pra_anestesi"></textarea>
                        </div>
                    </div>
                </div>

                {{-- anestesi ceklis --}}
                <div class="mb-4 col border-bottom">
                    <p>Cek List Persiapan Anestesi</p>
                    <div class="pb-3 row row-cols-4">
                        @foreach ($dataCeklist as $ceklist)
                            <div class="col">
                                <div class="form-check">
                                    <input name="anestesi_checklist[]" class="form-check-input" type="checkbox"
                                        value="{{ $ceklist }}" id="{{ $ceklist }}" />
                                    <label class="form-check-label" for="{{ $ceklist }}">
                                        {{ $ceklist }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- anestesi teknik --}}
                <div class="mb-4 col border-bottom">
                    <p>Teknik Anestesi</p>
                    <div class="pb-3 row row-cols-2">
                        @foreach ($dataTeknik as $teknik)
                            <div class="col ">
                                @if ($loop->iteration % 2 == 0)
                                    <div class="form-check">
                                        <input name="anestesi_technique[]" class="form-check-input" type="checkbox"
                                            value="{{ $teknik }}" id="{{ $teknik }}" />
                                        <label class="form-check-label" for="{{ $teknik }}">
                                            {{ $teknik }}
                                        </label>
                                    </div>
                                @else
                                    <div class="mb-3 row">
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input name="anestesi_teknik_temp_name[]" class="form-check-input"
                                                    type="checkbox" value="{{ $teknik }}"
                                                    id="{{ $teknik }}" onclick="enableInput(this)" />
                                                <label class="form-check-label" for="{{ $teknik }}">
                                                    {{ $teknik }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control form-control-sm input-anestesi" type="text"
                                                name="anestesi_teknik_temp_value[]" value="" disabled />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- special tools --}}
                <div class="mb-4 col border-bottom">
                    <p>Teknik dan Alat Khusus :</p>
                    <div class="pb-3 col" id="specialTool">
                        <div class="form-check">
                            <input name="special_tool[]" class="form-check-input" type="checkbox" value="Hipotensi"
                                id="Hipotensi" />
                            <label class="form-check-label" for="Hipotensi">
                                Hipotensi
                            </label>
                        </div>
                        <div class="row mb-2">
                            <div class="col-2">
                                <input class="form-control form-control-sm" type="text" name="special_tool[]"
                                    value="" />
                            </div>
                            <div class="col-1">
                                <button class="btn btn-dark btn-sm" type="button"
                                    onclick="tambahInputLain('special_tool[]')">
                                    <i class="bx bx-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- monitoring --}}
                <div class="mb-4 col border-bottom">
                    <p>Monitoring :</p>
                    <div class="pb-3 row row-cols-6" id="partMonitoring">
                        @foreach ($dataMonitoring as $monitoring)
                            <div class="col mb-2">
                                <div class="form-check">
                                    <input name="monitoring[]" class="form-check-input" type="checkbox"
                                        value="{{ $monitoring }}" id="{{ $monitoring }}" />
                                    <label class="form-check-label" for="{{ $monitoring }}">
                                        {{ $monitoring }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        <div class="col mb-2">
                            <div class="row">
                                <div class="col-9">
                                    <input class="form-control form-control-sm" type="text" name="monitoring[]" />
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-dark btn-sm" type="button"
                                        onclick="tambahInputLain('monitoring[]')">
                                        <i class="bx bx-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- pra induksi --}}
                <div class="mb-4 col border-bottom">
                    <p>Penilaian Pra Induksi :</p>
                    <div class="mb-3 row">
                        <label for="Keluhan" class="col-form-label col-2">Keluhan</label>
                        <div class="col-4">
                            <input class="form-control form-control-sm" type="text" name="keluhan" id="Keluhan" />
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <div class="row">
                                <label for="kesadaran" class="col-form-label col-4">Kesadaran</label>
                                <div class="col-8">
                                    <input class="form-control form-control-sm" type="text" id="kesadaran"
                                        name="kesadaran" />
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <label for="TD" class="col-form-label me-2">TD</label>
                                        <input class="form-control form-control-sm me-2" type="number" id="TD"
                                            name="td" style="max-width: 200px;" />
                                        <span>mmHg</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <label for="HR" class="col-form-label me-2">HR</label>
                                        <input class="form-control form-control-sm me-2" type="number" id="HR"
                                            name="hr" style="max-width: 200px;" />
                                        <span>x/mnt</span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <label for="RR" class="col-form-label me-2">RR</label>
                                        <input class="form-control form-control-sm me-2" type="number" id="RR"
                                            name="rr" style="max-width: 200px;" />
                                        <span>x/mnt </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <div class="row align-items-center">
                                <label for="temperatur" class="col-form-label col-4">Temperatur</label>
                                <div class="col-2">
                                    <div class="d-flex align-items-center">
                                        <input class="form-control form-control-sm me-2" type="number" id="temperatur"
                                            name="temperature" />
                                        <span>C</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row align-items-center">
                                <label for="saturasiO2" class="col-form-label col-2">Saturasi O2 </label>
                                <div class="col-2">
                                    <div class="d-flex align-items-center">
                                        <input class="form-control form-control-sm me-2" type="number" id="saturasiO2"
                                            name="saturasi" />
                                        <span>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="praInduksiLainLain" class="col-form-label col-2">Lain - lain</label>
                        <div class="col-10">
                            <textarea class="form-control" id="editor1" name="lainnya"></textarea>
                        </div>
                    </div>

                    <div class="row mb-5 mt-4">
                        <div class="col-9"></div>
                        <div class="col-3 text-center">Dokter Anestesi</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-9"></div>
                        <div class="col-3 text-center">
                            <img src="" alt="" id="ttdImage" class="border">
                            <textarea id="ttdTextArea" name="ttd_dokter_anestesi" style="display: none;"></textarea>
                            <button type="button" class="col-12 btn btn-sm btn-dark" onclick="openModal(this)">Tanda
                                Tangan</button>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-9"></div>
                        <div class="col-3 text-center">
                            <input type="text" class="form-control form-control-sm text-center" id="nama_user"
                                name="nama_dokter_anestesi" placeholder="Nama Lengkap" @readonly(true)>
                        </div>
                    </div>
                </div>

                <div class="mb-3 text-start">
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
        function enableInput(element) {
            if (element.checked == true) {
                $(element).closest('.row').find('.input-anestesi').attr('disabled', false);
            } else {
                $(element).closest('.row').find('.input-anestesi').val('');
                $(element).closest('.row').find('.input-anestesi').attr('disabled', true);
            }
        }
    </script>
    <script>
        function tambahInputLain(name) {
            if (name == 'special_tool[]') {
                var parent = document.getElementById('specialTool');
                var newDiv = document.createElement('div');
                newDiv.className = 'row mb-2';
                newDiv.innerHTML = `
                        <div class="col-2">
                            <input class="form-control form-control-sm" type="text" name="special_tool[]" value="" />
                        </div>
                        <div class="col-1">
                            <button class="btn btn-danger btn-sm" type="button" onclick="removeInputLain(this)">
                                <i class="bx bx-minus"></i>
                            </button>
                        </div>
                `;

                parent.append(newDiv);
            } else if (name == 'monitoring[]') {
                var parent = document.getElementById('partMonitoring');
                var newDiv = document.createElement('div');
                newDiv.className = 'col mb-2';
                newDiv.innerHTML = `
                        <div class="row">
                            <div class="col-9">
                                <input class="form-control form-control-sm" type="text" name="monitoring[]"/>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-danger btn-sm" type="button" onclick="removeInputMonitoring(this)">
                                    <i class="bx bx-minus"></i>
                                </button>
                            </div>
                        </div>
                `;
                parent.append(newDiv);

            }

        }

        function removeInputLain(element) {
            var parent = element.parentNode.parentNode;
            parent.remove();
        }

        function removeInputMonitoring(element) {
            var parent = element.parentNode.parentNode.parentNode;
            parent.remove();
        }
    </script>
    <script>
        function openModal(element) {
            $('#getTtdModal').modal('show');
        }

        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("getTtdModal");
            var clearButton = modal.querySelector("[data-action=clear]");
            var saveButton = modal.querySelector("[data-action=save]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');

            clearButton.addEventListener('click', function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            saveButton.addEventListener("click", function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: "{{ route('ranap/cppt.getTtd') }}",
                    data: {
                        user_id: inputUserId.value,
                        password: inputPass.value,
                    },
                    success: function(data) {
                        var newSrc = `{{ Storage::url('${data}') }}`;
                        $('#ttdImage').attr('src', newSrc);
                        $('#ttdTextArea').val(data);
                        $('#nama_user').val(`{{ auth()->user()->name }}`);
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
@endsection
