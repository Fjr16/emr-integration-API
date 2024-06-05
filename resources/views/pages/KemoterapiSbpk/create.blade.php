@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('kemoterapi/sbpk.store', $item->id) }}" method="POST">
        @csrf
        <div class="card mb-4">
            <div class="card-header m-0">
                <h5 class="mb-0 m-0">Surat Bukti Pelayanan Kesehatan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        {{-- <div class="row mb-3">
              <label for="defaultFormControlInput" class="col-md-3 col-form-label">No Rekam Medis</label>
              <div class="col-md-9">
                <select class="form-control select2" id="patient_id" name="patient_id" onchange="getPatient()">
                  <option value="" selected>Pilih</option>
sbpkKemoterapi                  <option value="si anu">Si Anu</option>
                  <option value="si anu">ssi annu</option>
                </select>
              </div>
            </div>  --}}
                        <div class="mb-3 row">
                            <label for="no_rm" class="col-md-3 col-form-label">No Rekam Medis</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text"
                                    value="{{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}"
                                    id="no_rm" disabled />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama-pasien" class="col-md-3 col-form-label">Nama Pasien</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" value="{{ $item->queue->patient->name ?? '' }}"
                                    id="nama-pasien" disabled />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="jenis_kelamin"
                                    value="{{ $item->queue->patient->jenis_kelamin }}" readonly />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-3 col-form-label">Tanggal Masuk RS</label>
                            <div class="col-md-9">
                                <input class="form-control" type="date" name="tanggal_masuk" id="html5-date-input" />
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
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="editor" class="form-label">Anamnesa</label>
                            <textarea class="form-control" id="editor" name="anamnesa"></textarea>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered mb-3">
                    <thead>
                        <tr class="text-center">
                            {{-- <th class="text-body">Poliklinik / Penunjang</th> --}}
                            <th class="text-body">Diagnosa</th>
                            <th class="text-body">ICDX</th>
                            <th class="text-body">Tindakan / Pemberi Penunjang</th>
                            <th class="text-body">action</th>
                        </tr>
                    </thead>
                    <tbody id="detailSbpk">
                        <tr>
                            {{-- <td>
                <select class="form-control select3" id="poliklinik-penunjang" name="poliklinik-penunjang" style="width: 100%">
                  <option value="" selected>Pilih</option>
                  <option value="si anu">Si Anu</option>
                  <option value="si anu">ssi annu</option>
                </select>
              </td> --}}
                            {{-- <td>
                <input class="form-control" type="text" value="{{ $item->patient->name ?? '' }}" disabled/>
              </td> --}}
                            <td>
                                <input class="form-control" type="text" name="diagnosa[]" value=""
                                    id="diagnosa" />
                            </td>
                            <td>
                                <input class="form-control" type="text" name="icd[]" value="" id="icd" />
                            </td>
                            <td>
                                <input class="form-control" type="text" name="nama_tindakan[]" value=""
                                    id="nama_tindakan" />
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-dark btn-sm" id="tambah_detail">+</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                                <input class="form-control" type="number" value="" name="icdx"
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
                                <input class="form-control" type="number" value="" name="diagnosa_icdx[]" />
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
                            <th class="text-body">Kode ICD 9 CM</th>
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
                                <input class="form-control" type="number" value="" name="icdg"
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
                                <input class="form-control" type="number" name="action_icdg[]" />
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-dark btn-sm" id="tambah_tindakan">+</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mb-3 justify-content-end">
                    <div class="col-4 text-center">
                        <img src="" alt="" id="ImgTtdPpj">
                        <textarea id="ttdPpj" name="ttd_admisi" style="display: none;"></textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark" onclick="openModal(this)">Tanda
                            Tangan</button>
                    </div>
                </div>
                <div class="row mb-4 justify-content-end">
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm text-center"
                            value="{{ auth()->user()->name ?? '' }}" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="text-end">
                        <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="history.back()">Batal</button>
                    </div>
                </div>
            </div>
    </form>

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

        function openModal(element) {
            $('#getTtdModal').modal('show');
        }

        function openModalTtdBottom(element, elementImg, elementTextArea) {
            console.log(element.closest('td'));
            tempElementImage = $(element).closest('.row').find('#' + elementImg);
            tempTextArea = $(element).closest('.row').find('#' + elementTextArea);
            $('#signaturePadModal').modal('show');
        }

        document.addEventListener("DOMContentLoaded", function() {
            var signaturePad;

            // start get ttd from user table
            var modal = document.getElementById("getTtdModal");
            var clearButtonInput = modal.querySelector("[data-action=clearInput]");
            var saveButtonInput = modal.querySelector("[data-action=saveInput]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');

            saveButtonInput.addEventListener("click", function (e) {
                e.preventDefault();
                $.ajax({
                    type : 'get',
                    url : "{{ route('ranap/cppt.getTtd') }}",
                    data : {
                        user_id : inputUserId.value,
                        password : inputPass.value,
                    }, success: function(data){
                        var newSrc = `{{ Storage::url('${data}') }}`;
                        $('#ImgTtdPpj').attr('src', newSrc);
                        $('#ttdPpj').val(data);
                        $('#petugas_name').val(`{{ auth()->user()->name }}`);
                    }, error: function(jqXHR, textStatus, errorThrown){
                        console.log();
                        var errorResponse = jqXHR.responseJSON;
                        if (errorResponse && errorResponse.error) {
                            alert(errorResponse.error)
                        }else{
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
                  <input class="form-control" type="text" name="diagnosa[]"/>
                </td>
                <td>
                  <input class="form-control" type="text" name="icd[]"/>
                </td>
                <td>
                  <input class="form-control" type="text" name="nama_tindakan[]" />
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
                    <input class="form-control" type="number" value="" name="action_icdg[]"/>
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
                    <input class="form-control" type="number" value="" name="diagnosa_icdx[]"/>
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
