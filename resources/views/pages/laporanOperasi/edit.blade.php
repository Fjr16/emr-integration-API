@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Laporan Operasi</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('laporan/operasi.update', $item->id) }}">
                @csrf
                @method('PUT')
                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Ahli Bedah : </label>
                        <div class="col-sm-4">
                            <input type="text" name="nama_ahli_bedah" class="form-control" id="basic-default-name"
                                value="{{ $item->nama_ahli_bedah }}" />
                        </div>
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Asisten Bedah : </label>
                        <div class="col-sm-4">
                            <input type="text" name="asisten_bedah" class="form-control" id="basic-default-name"
                                value="{{ $item->asisten_bedah }}" />
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row mb-3">
                    </div>
                </td>
                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Ahli Anestesi : </label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_ahli_anestesi" class="form-control" id="basic-default-name"
                                value="{{ $item->nama_ahli_anestesi }}" />
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Jenis Anestesi : </label>
                        <div class="col-sm-10">
                            <input type="radio" name="jenis_anestesi" value="Umum"
                                {{ $item->jenis_anestesi === 'Umum' ? 'checked' : '' }}>
                            Umum

                            <input type="radio" name="jenis_anestesi" value="Spinal"
                                {{ $item->jenis_anestesi === 'Spinal' ? 'checked' : '' }}>
                            Spinal

                            <input type="radio" name="jenis_anestesi" value="Epidural"
                                {{ $item->jenis_anestesi === 'Epidural' ? 'checked' : '' }}>
                            Epidural

                            <input type="radio" name="jenis_anestesi" value="Lokal"
                                {{ $item->jenis_anestesi === 'Lokal' ? 'checked' : '' }}>
                            Lokal

                            <input type="radio" name="jenis_anestesi" value="Lain-lain"
                                {{ $item->jenis_anestesi === 'Lain-lain' ? 'checked' : '' }}>
                            Lain-lain

                        </div>
                    </div>
                </td>
                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Tingkatan Operasi : </label>
                        <div class="col-sm-10">
                            <input type="radio" name="tingkatan_operasi" value="Ex. Mayor"
                                {{ $item->tingkatan_operasi === 'Ex. Mayor' ? 'checked' : '' }}>
                            Ex. Mayor
                            <input type="radio" name="tingkatan_operasi" value="Sp. Mayor"
                                {{ $item->tingkatan_operasi === 'Sp. Mayor' ? 'checked' : '' }}>
                            Sp. Mayor
                            <input type="radio" name="tingkatan_operasi" value="Mayor"
                                {{ $item->tingkatan_operasi === 'Mayor' ? 'checked' : '' }}>
                            Mayor
                            <input type="radio" name="tingkatan_operasi" value="Medium II"
                                {{ $item->tingkatan_operasi === 'Medium II' ? 'checked' : '' }}>
                            Medium II
                            <input type="radio" name="tingkatan_operasi" value="Medium I"
                                {{ $item->tingkatan_operasi === 'Medium I' ? 'checked' : '' }}>
                            Medium I
                            <input type="radio" name="tingkatan_operasi" value="Minor"
                                {{ $item->tingkatan_operasi === 'Minor' ? 'checked' : '' }}>
                            Minor
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Diagnosis Pra Operasi : </label>
                        <div class="col-sm-10">
                            <input type="text" name="diagnosis_pra_operasi" class="form-control" id="basic-default-name"
                                value="{{ $item->diagnosis_pra_operasi }}" />
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Diagnosis Pasca Operasi : </label>
                        <div class="col-sm-10">
                            <input type="text" name="diagnosis_pasca_operasi" class="form-control"
                                id="basic-default-name" value="{{ $item->diagnosis_pasca_operasi }}" />
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Operasi : </label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_operasi" class="form-control" id="basic-default-name"
                                value="{{ $item->nama_operasi }}" />
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Komplikasi : </label>
                        <div class="col-sm-10">
                            <input type="text" name="komplikasi" class="form-control" id="basic-default-name"
                                value="{{ $item->komplikasi }}" />
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Spesimen Operasi yang Dikirim
                            Untuk Pemeriksaan PA : </label>
                        <div class="col-sm-10">
                            <select name="spesimen_operasi_pemeriksaan_pa" class="form-select form-control"
                                id="" required>
                                <option value="">Pilih Spesimen Operasi </option>
                                <option value="Kultur"
                                    {{ $item->spesimen_operasi_pemeriksaan_pa == 'Kultur' ? 'selected' : '' }}>Kultur
                                </option>
                                <option value="PA"
                                    {{ $item->spesimen_operasi_pemeriksaan_pa == 'PA' ? 'selected' : '' }}>PA</option>
                                <option value="Sitologi"
                                    {{ $item->spesimen_operasi_pemeriksaan_pa == 'Sitologi' ? 'selected' : '' }}>Sitologi
                                </option>
                            </select>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Jumlah Pendarahan : </label>
                        <div class="col-sm-3">
                            <input type="text" name="jumlah_pendarahan" class="form-control" id="basic-default-name"
                                value="{{ $item->jumlah_pendarahan }}" />
                        </div>
                        <div class="col-sm-1">
                            cc
                        </div>
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Jumlah darah yang ditransfusi :
                        </label>
                        <div class="col-sm-3">
                            <input type="text" name="jumlah_darah_ditransfusi" class="form-control"
                                id="basic-default-name" value="{{ $item->jumlah_darah_ditransfusi }}" />
                        </div>
                        <div class="col-sm-1">
                            unit
                        </div>
                    </div>
                </td>

                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Tanggal Operasi : </label>
                        <div class="col-sm-2">
                            <input type="date" name="tanggal" class="form-control" id="basic-default-name"
                                value="{{ $item->tanggal }}" />
                        </div>
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Jam Operasi Dimulai : </label>
                        <div class="col-sm-2">
                            <input type="time" name="jam_dimulai" class="form-control" id="jam_dimulai"
                                value="{{ $item->jam_dimulai }}" />
                        </div>
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Jam Operasi Selesai : </label>
                        <div class="col-sm-2">
                            <input type="time" name="jam_selesai" class="form-control" id="jam_selesai"
                                value="{{ $item->jam_selesai }}" />
                        </div>
                    </div>
                </td>

                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Lama Operasi Berlangsung :
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="lama_operasi" class="form-control" id="lama_operasi"
                                value="{{ $item->lama_operasi }}" readonly />
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Prosedur Operasi : </label>
                        <div class="col-sm-10">
                            <textarea type="text" name="prosedur_operasi" class="form-control" id="basic-default-name"
                                style="height: 150px;"> {{ $item->prosedur_operasi }}
            </textarea>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nomor Implan Prosedur Operasi :
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="nomor_implan" class="form-control" id="basic-default-name"
                                value="{{ $item->nomor_implan }}" />
                        </div>
                    </div>
                </td>
                <hr>
                <td>
                    <div class="row mb-3">
                        <div class="text-center">
                            <h5>CARE PLAN POST OPERATIF</h5>
                        </div>
                    </div>
                </td>
                <hr>
                <td>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Instruksi Ruangan: </label>
                        <div class="col-sm-10">
                            <textarea type="text" name="instruksi_ruangan" class="form-control" id="basic-default-name"
                                style="height: 200px;">{{ $item->instruksi_ruangan }}
            </textarea>
                        </div>
                    </div>
                </td>
                <td>
                    Perencanaan Diet :
                </td>
                <td>
                    <div class="row mb-3">
                        @foreach ($perencanaanDiets as $perencanaanDiet)
                            <div class="col-sm-6">
                                <input type="checkbox" name="perencanaan-diet[]" value="{{ $perencanaanDiet }}"
                                    {{ $detail->contains('name', $perencanaanDiet) ? 'checked' : '' }}>
                                {{ $perencanaanDiet }}
                            </div>
                        @endforeach
                    </div>
                </td>

                <div class="my-5 mx-5">
                    <div class="row mb-5 mt-5">
                        <div class="col-6 text-center">
                            Telah Dibaca dan dimengerti <br>Pasien / Keluarga Pasien
                        </div>
                        <div class="col-6 text-center">
                            Petugas
                        </div>

                    </div>
                    <div class="row mb-5">
                        <div class="col-6 text-center">
                            <img src="" alt="" id="ImgTtdKeluargaPasien">
                            <textarea id="ttd" name="ttd_pasien" style="display: none;"></textarea>
                            <button type="button" class="col-12 btn btn-sm btn-dark"
                                onclick="openModalTtdBottom(this, 'ImgTtdKeluargaPasien', 'ttd')">Tanda
                                Tangan</button>
                        </div>
                        <div class="col-6 text-center">
                            <img src="" alt="" id="ImgTtdDietisien">
                            <textarea id="ttdDietisien" name="ttd_petugas" style="display: none;"></textarea>
                            <button type="button" class="col-12 btn btn-sm btn-dark"
                                onclick="openModal(this, 'ImgTtdDietisien', 'ttdDietisien', 'nama_petugas')">Tanda
                                Tangan</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-center">
                            <input type="text" class="form-control" name="nm_wali" id="pasien_name"
                                placeholder="Nama Pasien / Keluarga Pasien" value="{{ $item->diJelaskan }}" required>
                        </div>
                        <div class="col-6 text-center">
                            <input type="text" class="form-control" name="nama_petugas" id="nama_petugas"
                                placeholder="Nama Dietisien" @readonly(true)>
                        </div>
                    </div>

                </div>

                <br>
                <div class="row justify-content-end">
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- modal create ttd --}}
    <div class="modal fade" id="signaturePadModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalScrollableTitle">Signature Pad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="signature-pad" class="m-signature-pad">
                        <div class="m-signature-pad--body">
                            <canvas style="border: 3px dashed #ccc"></canvas>
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

    {{-- modal get ttd --}}
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
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-action="clearInput">Clear</button>
                            <button type="button" class="btn btn-sm btn-primary" data-action="saveInput">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        let tempElementImage;
        let tempTextArea;
        let tempPetugasName;

        function openModal(element, elementImg, elementTextArea, elementPetugasName) {
            tempElementImage = $(element).closest('.row').find('#' + elementImg);
            tempTextArea = $(element).closest('.row').find('#' + elementTextArea);
            tempPetugasName = $('#' + elementPetugasName);
            $('#getTtdModal').modal('show');
        }

        function openModalTtdBottom(element, elementImg, elementTextArea) {
            tempElementImage = $(element).closest('.row').find('#' + elementImg);
            tempTextArea = $(element).closest('.row').find('#' + elementTextArea);
            $('#signaturePadModal').modal('show');
        }

        // start create new ttd
        document.addEventListener("DOMContentLoaded", function() {
            var wrapper = document.getElementById("signaturePadModal");
            var clearButton = wrapper.querySelector("[data-action=clear]");
            var saveButton = wrapper.querySelector("[data-action=save]");
            var canvas = wrapper.querySelector("canvas");
            var signaturePad;

            // Initialize SignaturePad
            // agar library signature pad dapat digunakan pada modal
            signaturePad = new SignaturePad(canvas);

            // Event handler untuk tombol clear
            clearButton.addEventListener("click", function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            // Event handler untuk tombol save
            saveButton.addEventListener("click", function(e) {
                e.preventDefault();
                var signatureData = signaturePad.toDataURL();
                tempElementImage.attr('src', signatureData);
                tempTextArea.val(signatureData);
                signaturePad.clear();

                //close modal
                $('#signaturePadModal').modal('hide');
            });
            //  end create new ttd

            // start get ttd from user table
            var modal = document.getElementById("getTtdModal");
            var clearButtonInput = modal.querySelector("[data-action=clearInput]");
            var saveButtonInput = modal.querySelector("[data-action=saveInput]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');

            clearButtonInput.addEventListener('click', function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            saveButtonInput.addEventListener("click", function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: "{{ route('laporan/operasi.ttd') }}",
                    data: {
                        user_id: inputUserId.value,
                        password: inputPass.value,
                    },
                    success: function(data) {
                        var newSrc = `{{ Storage::url('${data}') }}`;
                        tempElementImage.attr('src', newSrc);
                        tempTextArea.val(data);
                        tempPetugasName.val(`{{ auth()->user()->name }}`);
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
        document.addEventListener('DOMContentLoaded', function() {
            var jamMulaiInput = document.getElementById('jam_dimulai');
            var jamSelesaiInput = document.getElementById('jam_selesai');
            var lamaOperasiInput = document.getElementById('lama_operasi');

            jamMulaiInput.addEventListener('change', hitungLamaOperasi);
            jamSelesaiInput.addEventListener('change', hitungLamaOperasi);

            hitungLamaOperasi(); // Panggil fungsi saat halaman dimuat

            function hitungLamaOperasi() {
                var waktuMulai = jamMulaiInput.value.split(':');
                var waktuSelesai = jamSelesaiInput.value.split(':');

                var jamMulai = parseInt(waktuMulai[0], 10);
                var menitMulai = parseInt(waktuMulai[1], 10);
                var jamSelesai = parseInt(waktuSelesai[0], 10);
                var menitSelesai = parseInt(waktuSelesai[1], 10);

                var lamaJam, lamaMenit;

                if (jamSelesai < jamMulai || (jamSelesai === jamMulai && menitSelesai < menitMulai)) {
                    lamaJam = 24 - jamMulai + jamSelesai;
                } else {
                    lamaJam = jamSelesai - jamMulai;
                }

                if (menitSelesai < menitMulai) {
                    lamaJam--;
                    lamaMenit = 60 - (menitMulai - menitSelesai);
                } else {
                    lamaMenit = menitSelesai - menitMulai;
                }

                var lamaOperasi = lamaJam.toString().padStart(2, '0') + ' jam, ' + lamaMenit.toString().padStart(2,
                    '0') + ' Menit';
                lamaOperasiInput.value = lamaOperasi;

                console.log("Lama operasi:", lamaOperasi);
            }
        });
    </script>
@endsection
