@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('rajal/rmedokter/assesmenawal.store', $item->id) }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Tambah Assesmen Awal</h5>
                <button type="button" class="btn btn-success btn-sm" onclick="history.back()">Kembali</button>
            </div>
            <div class="card-body">
                <p class="m-0 fw-bold">Anamnesis</p>
                <p class="m-0 fw-bold">Data diperoleh dari</p>
                <div class="form-check">
                    <input name="isPasien" class="form-check-input" type="radio" value="1" id="pasien"
                        onclick="disabledForm()" checked />
                    <label class="form-check-label" for="pasien">
                        Pasien
                    </label>
                </div>
                <div class="form-check">
                    <input name="isPasien" class="form-check-input" type="radio" value="0" id="notPasien"
                        onclick="enableForm()" />
                    <label class="form-check-label d-flex" for="notPasien">
                        Orang Lain(Alloanamnesa)
                        <span class="mx-2"><input type="text" class="form-control form-control-sm"
                                value="{{ old('name') }}" name="name" id="name"
                                aria-describedby="floatingInputHelp" disabled /></span>
                        Hubungan dengan pasien
                        <span class="mx-2"><input type="text" class="form-control form-control-sm"
                                value="{{ old('hubungan') }}" name="hubungan" id="hubungan"
                                aria-describedby="floatingInputHelp" disabled /></span>
                    </label>
                </div>
                <p class="m-0 fw-bold">Keluhan Utama</p>
                <textarea id="editor5" class="form-control" id="exampleFormControlTextarea1" name="keluhan" rows="2"></textarea>
                <p class="m-0 fw-bold mt-4">Riwayat Penyakit Sekarang</p>
                <textarea id="editor1" class="form-control" id="exampleFormControlTextarea1" name="riwayat_penyakit_sekarang"
                    rows="2"></textarea>
                <p class="m-0 fw-bold mt-4">Riwayat Penyakit Dahulu</p>
                <textarea id="editor2" class="form-control" id="exampleFormControlTextarea1" name="riwayat_penyakit_dahulu"
                    rows="2"></textarea>
                <p class="m-0 fw-bold mt-4">Riwayat Penggunaan Obat</p>
                <textarea id="editor3" class="form-control" id="exampleFormControlTextarea1" name="riwayat_penggunaan_obat"
                    rows="2"></textarea>
                <p class="m-0 fw-bold mt-4">Riwayat Penyakit Keluarga</p>
                <textarea id="editor4" class="form-control" id="exampleFormControlTextarea1" name="riwayat_penyakit_keluarga"
                    rows="2"></textarea>
                <p class="m-0 fw-bold mt-4">Pemeriksaan Fisik</p>
                <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-body fw-bold">Keterangan</th>
                            <th class="text-body fw-bold">Normal</th>
                            <th class="text-body fw-bold">Jelaskan jika Tidak Normal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataPemeriksaan as $index => $pemeriksaan)
                            <tr id="row">
                                <td>
                                    {{ $pemeriksaan }}
                                    <input type="hidden" name="fisik[{{ $index }}][name]"
                                        value="{{ $pemeriksaan }}">
                                </td>
                                <td>
                                    <div class="form-check form-check-sm form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="fisik[{{ $index }}][isNormal]" id="fisik[{{ $index }}]1"
                                            value="1" checked onclick="disabledInputAlasan(this)" />
                                        <label class="form-check-label" for="fisik[{{ $index }}]1">YA</label>
                                    </div>
                                    <div class="form-check form-check-sm form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="fisik[{{ $index }}][isNormal]" id="fisik[{{ $index }}]2"
                                            value="0" onclick="enableInputAlasan(this)" />
                                        <label class="form-check-label" for="fisik[{{ $index }}]2">Tidak</label>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" name="fisik[{{ $index }}][alasan]" id="alasan"
                                        class="form-control form-control-sm" id="floatingInput"
                                        aria-describedby="floatingInputHelp" disabled />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="m-0 fw-bold mt-4">Status Lokalis</p>
                <textarea id="editor6" class="form-control" id="exampleFormControlTextarea1" name="status_lokalis"
                    rows="2"></textarea>
                <p class="m-0 fw-bold my-4">Hasil Pemeriksaan Penunjang</p>
                <div class="row mb-3">
                    <label for="" class="form-label col-sm-2 fw-bold" id="label-kolom">Labor</label>
                    <div class="col-sm-10">
                        <textarea class="form-control w-100" rows="2" oninput="concatLabel(this)"></textarea>
                        <textarea id="value-kolom" class="form-control w-100" name="hasil_pemeriksaan[]" rows="2" hidden></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="" class="form-label col-sm-2 fw-bold" id="label-kolom">Radiologi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control w-100" rows="2" oninput="concatLabel(this)"></textarea>
                        <textarea id="value-kolom" class="form-control w-100" name="hasil_pemeriksaan[]" rows="2" hidden></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-9">
                        <textarea class="form-control w-100" rows="2" name="hasil_pemeriksaan[]"></textarea>
                    </div>
                    <div class="col-1 d-flex align-self-center">
                        <button type="button" class="btn btn-dark btn-sm"
                            onclick="tambahInputPemeriksaan(this)">+</button>
                    </div>
                </div>

                <p class="m-0 fw-bold mt-4">Diagnosa Kerja</p>
                <textarea id="editor7" class="form-control" id="exampleFormControlTextarea1" name="diagnosa_kerja"
                    rows="2"></textarea>
                <p class="m-0 fw-bold mt-4">Diagnosa Banding</p>
                <textarea id="editor8" class="form-control" id="exampleFormControlTextarea1" name="diagnosa_banding"
                    rows="2"></textarea>
                <p class="m-0 fw-bold mt-4 mb-3">Terapi / Instruksi (Standing Order)</p>
                {{-- <textarea class="form-control" id="exampleFormControlTextarea1" name="terapi" rows="2"></textarea> --}}
                <div class="row mb-3">
                    <label class="form-label col-sm-2 fw-bold" id="label-kolom">Medical Mentosa:</label>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="medicine_id" class="form-label">Nama Obat</label>
                            <select id="medicine_id_1" name="medicine_id[]" class="form-select form-select-sm"
                                data-allow-clear="true">
                                <option selected disabled>Pilih</option>
                                @foreach ($dataObat as $obat)
                                    @if (old('medicine_id') == $obat->id)
                                        <option value="{{ $obat->id }}" selected>
                                            {{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                                    @else
                                        <option value="{{ $obat->id }}">
                                            {{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <label class="form-label" for="basic-default-name">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah[]" id="jumlah" />
                        </div>
                        <div class="col-sm-2">
                            <label class="form-label" for="basic-default-name">Aturan Penggunaan</label>
                            <input type="text" class="form-control" name="aturan_pakai[]" id="aturan_pakai" />
                        </div>
                        <div class="col-sm-2">
                            <label for="keterangan" class="form-label">Keterangan Penggunaan</label>
                            <select name="keterangan[]" class="form-select form-select-md" data-allow-clear="true">
                                <option selected disabled>Pilih</option>
                                <option value="Sebelum Makan">Sebelum Makan</option>
                                <option value="Sesudah Makan">Sesudah Makan</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="keterangan" class="form-label">Keterangan Lainnya</label>
                            <textarea name="other[]" class="form-control" id="other" cols="30" rows="1"></textarea>
                        </div>
                        <div class="col-sm-1 d-flex align-self-center mt-4">
                            <button type="button" class="btn btn-sm btn-dark" onclick="tambahResep(this)"><i
                                    class="bx bx-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="form-label col-sm-2 fw-bold" id="label-kolom">Non Medical Mentosa:</label>
                    <div class="col-sm-12">
                        <textarea id="editor" name="terapi" class="form-control"></textarea>
                    </div>
                </div>
                <p class="m-0 fw-bold mb-3">Rencana</p>
                <div class="row mb-3">
                    <label class="form-label col-sm-2 fw-bold" id="label-kolom">Tindakan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="2" oninput="concatLabel(this)"></textarea>
                        <textarea class="form-control" id="value-kolom" name="rencana[]" rows="2" hidden></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="form-label col-sm-2 fw-bold" id="label-kolom">Dirawat di ruang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm w-100" value=""
                            oninput="concatLabel(this)" />
                        <input type="text" class="form-control form-control-sm w-100" id="value-kolom"
                            name="rencana[]" value="" placeholder="Ruang" aria-describedby="floatingInputHelp"
                            hidden />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="form-label col-sm-2 fw-bold" id="label-kolom">Diet</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm w-100" value=""
                            oninput="concatLabel(this)" />
                        <input type="text" class="form-control form-control-sm w-100" id="value-kolom"
                            name="rencana[]" value="" placeholder="Diet" aria-describedby="floatingInputHelp"
                            hidden />
                    </div>
                </div>

                <div class="row mb-3" id="tambah">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-9">
                        <textarea class="form-control" cols="50" rows="2" name="rencana[]"></textarea>
                    </div>
                    <div class="col-1 d-flex align-self-center">
                        <button type="button" class="btn btn-dark btn-sm" onclick="tambahInput(this)">+</button>
                    </div>
                </div>
                <p class="m-0 fw-bold">Kebutuhan Edukasi</p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Penggunaan obat secara efektif dan aman"
                        id="defaultCheck1" name="edukasi[]" />
                    <label class="form-check-label d-flex" for="defaultCheck1">
                        Penggunaan obat secara efektif dan aman
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Penggunaan peralatan medis yang aman"
                        id="defaultCheck2" name="edukasi[]" />
                    <label class="form-check-label d-flex" for="defaultCheck2">
                        Penggunaan peralatan medis yang aman
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Potensi interaksi obat dan makanan"
                        id="defaultCheck3" name="edukasi[]" />
                    <label class="form-check-label d-flex" for="defaultCheck3">
                        Potensi interaksi obat dan makanan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Teknik Rehabilitasi" id="defaultCheck4"
                        name="edukasi[]" />
                    <label class="form-check-label d-flex" for="defaultCheck4">
                        Teknik Rehabilitasi
                    </label>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-md" name="edukasi[]">
                    </div>
                    <div class="col-8 d-flex align-self-center">
                        <button type="button" class="btn btn-dark btn-sm" onclick="tambahEdukasi(this)">+</button>
                    </div>
                </div>
            </div>
            <div class="mb-3 mt-2 mx-3 parent row d-flex justify-content-between">
                @php
                    // $ttd_dokter = '';
                    // $ttd_perawat = '';
                    // $nama_dokter = '';
                    // $nama_perawat = '';
                    $ttd_dokter = '';
                    $ttd_pasien = '';
                    $nama_dokter = '';
                    $nama_pasien = '';
                @endphp
                <div class="col-md-5 row d-flex justify-content-center">
                    <h6 class="fw-bold text-center mb-4">Tanda Tangan Dokter</h6>
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $ttd_dokter) }}" alt="" id="ImgTtdDokter" style="max-width: 200px">
                        <textarea id="ttdDokter" name="ttd_dokter" style="display: none;">{{ $ttd_dokter }}</textarea>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="col-12 btn btn-sm btn-dark"
                                        onclick="openModal(this, 'ImgTtdDokter', 'ttdDokter', 'nm_dokter')">Tanda
                                        Tangan</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="col-12 btn btn-sm btn-secondary"
                                        id="clearImgDokter">Clear</button>
                                </div>
                                <div class="col-12 mt-2">
                                    <input type="text" class="form-control form-control-sm text-center"
                                        name="nm_dokter" id="nm_dokter" value="{{ $nama_dokter }}"
                                        placeholder="Nama Lengkap" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 row d-flex justify-content-center">
                    <h6 class="fw-bold text-center mb-4">Tanda tangan Pasien/Wali</h6>
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $ttd_pasien) }}" alt="" id="ImgTtdKeluargaPasien" style="max-width: 200px">
                        {{-- <textarea id="ttdPerawat" name="ttd_perawat" style="display: none;">{{ $ttd_perawat }}</textarea> --}}
                        <textarea id="ttd" name="ttd" style="display: none;">{{ $item->patient->name }}</textarea>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    {{-- <button type="button" class="col-12 btn btn-sm btn-dark"
                                        onclick="openModal(this, 'ImgTtdPerawat', 'ttdPerawat', 'nm_perawat')">Tanda
                                        Tangan</button> --}}
                                    <button type="button" class="col-12 btn btn-sm btn-dark"
                                        onclick="openModalTtdBottom(this, 'ImgTtdKeluargaPasien', 'ttd')">Tanda
                                        Tangan</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="col-12 btn btn-sm btn-secondary"
                                        id="clearImgPerawat">Clear</button>
                                </div>
                                <div class="col-12 mt-2">
                                    <input type="text" class="form-control form-control-sm text-center"
                                        name="nm_pasien" id="nm_pasien" value="{{ $item->patient->name }}"
                                        placeholder="Nama Lengkap" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-success btn-sm mx-3">Simpan</button>
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

    {{-- modal create ttd pasien --}}
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
    <script>
        let tempElementImage;
        let tempTextArea;
        let tempPetugasName;

        function openModal(element, elementImg, elementTextArea, elementPetugasName) {
            tempElementImage = $(element).closest('.parent').find('#' + elementImg);
            tempTextArea = $(element).closest('.parent').find('#' + elementTextArea);
            tempPetugasName = $('#' + elementPetugasName);
            $('#getTtdModal').modal('show');
        }

        function openModalTtdBottom(element, elementImg, elementTextArea) {
            // console.log(element.closest('td'));
            tempElementImage = $(element).closest('.parent').find('#' + elementImg);
            tempTextArea = $(element).closest('.parent').find('#' + elementTextArea);
            $('#signaturePadModal').modal('show');
        }

        document.addEventListener("DOMContentLoaded", function() {
            // start get ttd from user table
            var wrapper = document.getElementById("signaturePadModal");
            var modal = document.getElementById("getTtdModal");
            var clearImageDokter = document.getElementById("clearImgDokter");
            var clearImagePerawat = document.getElementById("clearImgPerawat");

            var clearButtonInput = modal.querySelector("[data-action=clearInput]");
            var saveButtonInput = modal.querySelector("[data-action=saveInput]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');

            var clearButton = wrapper.querySelector("[data-action=clear]");
            var saveButton = wrapper.querySelector("[data-action=save]");
            var canvas = wrapper.querySelector("canvas");
            var signaturePad;

            // Initialize SignaturePad
            // agar library signature pad dapat digunakan pada modal
            signaturePad = new SignaturePad(canvas);

            clearImageDokter.addEventListener('click', function(e) {
                var img = document.getElementById("ImgTtdDokter");
                var source = document.getElementById("ttdDokter");
                var name = document.getElementById("nm_dokter");
                img.setAttribute('src', '');
                source.value = '';
                name.value = '';
            });

            clearButton.addEventListener("click", function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            saveButton.addEventListener("click", function(e) {
                e.preventDefault();
                var signatureData = signaturePad.toDataURL();
                tempElementImage.attr('src', signatureData);
                tempTextArea.val(signatureData);
                // document.getElementById("signature64").value = signatureData;
                signaturePad.clear();

                //close modal
                $('#signaturePadModal').modal('hide');
            });

            clearImagePerawat.addEventListener('click', function(e) {
                var img = document.getElementById("ImgTtdPerawat");
                var source = document.getElementById("ttdPerawat");
                var name = document.getElementById("nm_perawat");
                img.setAttribute('src', '');
                source.value = '';
                name.value = '';
            });

            clearButtonInput.addEventListener('click', function(e) {
                e.preventDefault();
                inputPass.value = '';
            });

            saveButtonInput.addEventListener("click", function(e) {
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




        function concatLabel(input) {
            var label = input.closest('.row').querySelector('#label-kolom').textContent;
            var newValue = label + ' ' + input.value;
            input.closest('.row').querySelector('#value-kolom').value = newValue;
        }

        function tambahInput(add) {
            var row = add.closest('.row');

            var newDiv = document.createElement('div');
            newDiv.className = 'col-sm-2';
            var divText = document.createElement('div');
            divText.className = 'col-sm-9';
            divText.innerHTML = `
            <textarea class="form-control" cols="50" rows="2" name="rencana[]"></textarea>
      `;
            var divButton = document.createElement('div');
            divButton.className = 'col-1 d-flex align-self-center';
            divButton.innerHTML = `
            <button type="button" class="btn btn-danger btn-sm" onclick="hapusInput(this)">-</button>
      `;

            elements = [newDiv, divText, divButton];
            row.append(...elements);
        }

        function tambahInputPemeriksaan(add) {
            var i = 2;
            var row = add.closest('.row');

            var newDiv = document.createElement('div');
            newDiv.className = 'col-sm-2';
            var divText = document.createElement('div');
            divText.className = 'col-sm-9';
            divText.innerHTML = `
            <textarea class="form-control w-100" rows="2" name="hasil_pemeriksaan[keterangan[]]"></textarea>
      `;
            var divButton = document.createElement('div');
            divButton.className = 'col-1 d-flex align-self-center';
            divButton.innerHTML = `
            <button type="button" class="btn btn-danger btn-sm" onclick="hapusInput(this)">-</button>
      `;

            elements = [newDiv, divText, divButton];
            row.append(...elements);
        }

        function tambahEdukasi(add) {
            var row = add.closest('.row');

            var divText = document.createElement('div');
            divText.className = 'col-sm-4 mt-1';
            divText.innerHTML = `
        <input type="text" class="form-control form-control-md" name="edukasi[]">
      `;
            var divButton = document.createElement('div');
            divButton.className = 'col-8 d-flex align-self-center';
            divButton.innerHTML = `
            <button type="button" class="btn btn-danger btn-sm" onclick="hapusInputEdukasi(this)">-</button>
      `;

            elements = [divText, divButton];
            row.append(...elements);
        }

        let clickCount = 2;

        function tambahResep(element) {
            var row = element.closest('.row').parentNode;

            var div = document.createElement('div');
            div.className = 'row';
            div.innerHTML = `
          <div class="col-sm-3">
            <label for="medicine_id" class="form-label">Nama Obat</label>
            <select id="medicine_id_${clickCount}" name="medicine_id[]" class="form-select form-select-sm" data-allow-clear="true">
              <option selected disabled>Pilih</option>
              @foreach ($dataObat as $obat)
                  @if (old('medicine_id') == $obat->id)
                    <option value="{{ $obat->id }}" selected>{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                  @else
                    <option value="{{ $obat->id }}">{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                  @endif
              @endforeach
            </select>
          </div>
          <div class="col-sm-1">
            <label class="form-label" for="basic-default-name">Jumlah</label>
            <input type="number" class="form-control" name="jumlah[]" id="jumlah" />
          </div>
          <div class="col-sm-2">
            <label class="form-label" for="basic-default-name">Aturan Pakai</label>
            <input type="text" class="form-control" name="aturan_pakai[]" id="aturan_pakai" />
          </div>
          <div class="col-sm-2">
              <label for="keterangan" class="form-label">Keterangan Penggunaan</label>
              <select name="keterangan[]" class="form-select form-select-md" data-allow-clear="true">
                <option selected disabled>Pilih</option>
                <option value="Sebelum Makan">Sebelum Makan</option>
                <option value="Sesudah Makan">Sesudah Makan</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="keterangan" class="form-label">Keterangan Lainnya</label>
              <textarea name="other[]" class="form-control" id="other" cols="30" rows="1"></textarea>
            </div>
          <div class="col-sm-1 d-flex align-self-center mt-4">
            <button type="button" class="btn btn-sm btn-danger" onclick="hapusResep(this)"><i class="bx bx-minus"></i></button>
          </div>`;

            row.appendChild(div);
            $('#medicine_id_' + clickCount).select2();
            clickCount++;
        }

        function hapusInput(input) {
            var divButton = input.parentNode;
            var divText = divButton.previousElementSibling;
            var newDiv = divText.previousElementSibling;

            divButton.remove()
            divText.remove()
            newDiv.remove()
        }

        function hapusInputEdukasi(input) {
            var divButton = input.parentNode;
            var divText = divButton.previousElementSibling;

            divButton.remove()
            divText.remove()
        }

        function hapusResep(element) {
            var root = element.closest('.row');
            root.remove();
        }

        function enableForm() {
            $('#name').attr('disabled', false);
            $('#hubungan').attr('disabled', false);
        }

        function disabledForm() {
            $('#name').attr('disabled', true);
            $('#hubungan').attr('disabled', true);
        }

        function enableInputAlasan(element) {
            $(element).closest('#row').find('#alasan').attr('disabled', false);
        }

        function disabledInputAlasan(element) {
            $(element).closest('#row').find('#alasan').attr('disabled', true);
        }
    </script>



@endsection
