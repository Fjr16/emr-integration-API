@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('rajal/sbpk.store', ['id' => $item->id]) }}" method="POST">
        @csrf
        <div class="card mb-4">
            <div class="card-header m-0">
                <h5 class="mb-0 m-0">Surat Bukti Pelayanan Kesehatan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="mb-3 row">
                            <label for="no_rm" class="col-md-3 col-form-label">No Rekam Medis</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text"
                                    value="{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}"
                                    id="no_rm" disabled />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama-pasien" class="col-md-3 col-form-label">Nama Pasien</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" value="{{ $item->patient->name ?? '' }}"
                                    id="nama-pasien" disabled />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-md-9">
                                <input class="form-control" type="date" name="tanggal"
                                    value="{{ $item->patient->tanggal_lhr ?? date('Y-m-d') }}" id="html5-date-input"
                                    readonly />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama-pasien" class="col-md-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="jenis_kelamin"
                                    value="{{ $item->patient->jenis_kelamin }}" readonly />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-3 col-form-label">Jam Keluar</label>
                            <div class="col-md-9">
                                <input class="form-control" type="time" name="jam_keluar" value="{{ date('H:i') }}"
                                    id="html5-date-input" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-3 col-form-label">Tanggal Masuk RS</label>
                            <div class="col-md-9">
                                <input class="form-control" type="date" name="tanggal_masuk" value="{{ date('Y-m-d') }}"
                                    id="html5-date-input" />
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mx-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="keterangan" value="Kunjungan Awal"
                                    id="defaultRadio1" @checked(true) />
                                <label class="form-check-label" for="defaultRadio1">
                                    Kunjungan Awal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="keterangan" value="Kunjungan Lanjutan"
                                    id="defaultRadio2" />
                                <label class="form-check-label" for="defaultRadio2">
                                    Kunjungan Lanjutan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="keterangan" value="Observasi"
                                    id="defaultRadio3" />
                                <label class="form-check-label" for="defaultRadio3">
                                    Observasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="keterangan" value="Post Operasi"
                                    id="defaultRadio4" />
                                <label class="form-check-label" for="defaultRadio4">
                                    Post Operasi
                                </label>
                            </div>
                            <div class="mb-3 row">
                                <label for="html5-date-input" class="col-md-4 col-form-label">Berat Badan / BB</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="berat"
                                        value="{{ $item->diagnosisKeperawatanPatien->statusFisikDiagnosaKeperawatanPatient->bb ?? '' }}"
                                        placeholder="Berat Badan / BB" required id="html5-date-input" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="editor" class="form-label">Anamnesa</label>
                            <input type="text" class="form-control" name="anamnesa">
                        </div>
                    </div>
                </div>
                <table class="table table-bordered mb-3">
                    <thead>
                        <tr class="text-center">
                            <th class="text-body">Poliklinik / Penunjang</th>
                            <th class="text-body">Diagnosa</th>
                            <th class="text-body">ICDX</th>
                            <th class="text-body">Tindakan / Pemeriksaan Penunjang / Tetap </th>
                            <th class="text-body">TDT & Nama Jelas Dokter / Petugas</th>
                            <th class="text-body">action</th>
                        </tr>
                    </thead>
                    <tbody id="detailSbpk">
                        <tr>
                            <td>
                                <input class="form-control" type="text" name="poliklinik[]" value="" />
                            </td>
                            <td>
                                <input class="form-control" type="text" name="diagnosa[]" value=""
                                    id="diagnosa" />
                            </td>
                            <td>
                                <input class="form-control" type="text" name="icd[]" value=""
                                    id="icd" />
                            </td>
                            <td>
                                <input class="form-control" type="text" name="nama_tindakan[]" value=""
                                    id="nama_tindakan" />
                            </td>
                            <td>
                                <input class="form-control tdt" type="text" name="tdt[]" value="" disabled />
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-dark btn-sm" id="tambah_detail">+</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="editor" class="form-label">Konsultasi</label>
                            <input type="text" class="form-control" name="konsultasi">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="editor" class="form-label">USG</label>
                            <input type="text" class="form-control" name="usg">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="editor" class="form-label">Tindakan</label>
                            <input type="text" class="form-control" name="tindakan">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="editor" class="form-label">Rontgen</label>
                            <input type="text" class="form-control" name="rontgen">
                        </div>
                    </div>
                </div>
                <table class="table table-bordered mb-3">
                    <thead>
                        <tr class="text-center">
                            <th class="text-body" colspan="2">Diagnosis</th>
                            <th class="text-body">Kode ICDX</th>
                            <th class="text-body">action</th>
                        </tr>
                    </thead>
                    <tbody id="diagnosaTambahan">
                        <tr>
                            <td>
                                Diagnosis Utama
                            </td>
                            <td>
                                <input class="form-control" type="text" value="" name="diagnosis_utama"
                                    id="diagnosis_utama" />
                            </td>
                            <td>
                                <input class="form-control" type="text" value="" name="icdx"
                                    id="icdx" />
                            </td>
                            <td class="text-center">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Diagnosis Tambahan
                            </td>
                            <td>
                                <input class="form-control" type="text" value="" name="diagnosa_name[]" />
                            </td>
                            <td>
                                <input class="form-control" type="text" value="" name="diagnosa_icdx[]" />
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-dark btn-sm" id="tambah_diagnosa">+</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered mb-3">
                    <thead>
                        <tr class="text-center">
                            <th class="text-body" colspan="2">Tindakan / Prosedur</th>
                            <th class="text-body">Kode ICD-G</th>
                            <th class="text-body">action</th>
                        </tr>
                    </thead>
                    <tbody id="tindakanTambahan">
                        <tr>
                            <td>
                                Tindakan Utama
                            </td>
                            <td>
                                <input class="form-control" type="text" value="" name="tindakan_utama"
                                    id="tindakan_utama" />
                            </td>
                            <td>
                                <input class="form-control" type="text" value="" name="icdg"
                                    id="icdg" />
                            </td>
                            <td class="text-center">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tindakan Tambahan
                            </td>
                            <td>
                                <input class="form-control" type="text" name="action_name[]" />
                            </td>
                            <td>
                                <input class="form-control" type="text" name="action_icdg[]" />
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-dark btn-sm" id="tambah_tindakan">+</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="my-5 mx-5">
                    <div class="row mb-5 mt-5">
                        <div class="col-6 text-center">
                            Dokter Penanggung jawab pasien
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-center">
                            <img src="" alt="" id="ImgTtdDietisien" style="max-width: 200px">
                            <textarea id="ttdDietisien" name="ttd_dokter" style="display: none;"></textarea>
                            <button type="button" class="col-12 btn btn-sm btn-dark mt-1"
                                onclick="openModal(this, 'ImgTtdDietisien', 'ttdDietisien', 'nama_dokter')">Tanda
                                Tangan</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-center">
                            <input type="text" class="form-control" name="nama_dokter" id="nama_dokter"
                                placeholder="Nama Dokter Penanggung Jawab" readonly>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="text-end">
                        <button type="submit" class="btn btn-sm btn-dark">Lanjutan</button>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="history.back()">Batal</button>
                    </div>
                </div>
            </div>
    </form>

    <div class="modal fade" id="getTtdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalScrollableTitle">Masukkan Password Akun Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
            tempElementImage = $('#' + elementImg);
            tempTextArea = $('#' + elementTextArea);
            tempPetugasName = $('#' + elementPetugasName);
            $('#getTtdModal').modal('show');
        }

        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("getTtdModal");
            var clearButtonInput = modal.querySelector("[data-action=clearInput]");
            var saveButtonInput = modal.querySelector("[data-action=saveInput]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');
            var textAreaDietisien = document.getElementById('ttdDietisien');

            clearButtonInput.addEventListener('click', function(e) {
                e.preventDefault();
                inputPass.value = '';
            });

            saveButtonInput.addEventListener("click", function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: "{{ route('rajal/sbpk.ttd') }}",
                    data: {
                        user_id: inputUserId.value,
                        password: inputPass.value,
                    },
                    success: function(data) {
                        var newSrc = `{{ Storage::url('${data}') }}`;
                        tempElementImage.attr('src', newSrc);
                        tempTextArea.val(data);
                        tempPetugasName.val(`{{ auth()->user()->name }}`);

                        // Isi semua elemen dengan kelas 'tdt'
                        $('.tdt').val(`{{ auth()->user()->name }}`);
                        // Mengisi textarea dengan ID ttdDietisien
                        textAreaDietisien.value = data;

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var errorResponse = jqXHR.responseJSON;
                        if (errorResponse && errorResponse.error) {
                            alert(errorResponse.error);
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
        document.getElementById("tambah_detail").addEventListener("click", tambahDetail);

        function tambahDetail() {
            var tBody = document.getElementById('detailSbpk');

            var newTr = document.createElement('tr');
            newTr.innerHTML = `
                <td>
                  <input class="form-control" type="text" name="poliklinik[]" value="" />
                </td>
                <td>
                  <input class="form-control" type="text" name="diagnosa[]"/>
                </td>
                <td>
                  <input class="form-control" type="text" name="icd[]"/>
                </td>
                <td>
                  <input class="form-control" type="text" name="nama_tindakan[]" />
                </td>
                <td>
                    <input class="form-control tdt" type="text" name="tdt[]" value="" disabled />
                </td>

                <td class="text-center">
                  <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)">-</button>
                </td>
            `;
            tBody.appendChild(newTr);

        }
    </script>
    <script>
        document.getElementById("tambah_tindakan").addEventListener("click", tambahTindakan);

        function tambahTindakan() {
            var tBody = document.getElementById('tindakanTambahan');
            var newTr = document.createElement('tr');
            newTr.innerHTML = `
                <tr>
                  <td>
                  </td>
                  <td>
                    <input class="form-control" type="text" value="" name="action_name[]"/>
                  </td>
                  <td>
                    <input class="form-control" type="text" value="" name="action_icdg[]"/>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)">-</button>
                  </td>
                </tr>
              `;
            tBody.appendChild(newTr);
        }
    </script>
    <script>
        document.getElementById("tambah_diagnosa").addEventListener("click", tambahDiagnosa);

        function tambahDiagnosa() {
            var tBody = document.getElementById('diagnosaTambahan');
            var newTr = document.createElement('tr');
            newTr.innerHTML = `
                <tr>
                  <td>
                  </td>
                  <td>
                    <input class="form-control" type="text" value="" name="diagnosa_name[]"/>
                  </td>
                  <td>
                    <input class="form-control" type="text" value="" name="diagnosa_icdx[]"/>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeElement(this)">-</button>
                  </td>
                </tr>
              `;
            tBody.appendChild(newTr);
        }
    </script>
    <script>
        function removeElement(element) {
            element.parentNode.parentNode.remove();
        }
    </script>
@endsection
