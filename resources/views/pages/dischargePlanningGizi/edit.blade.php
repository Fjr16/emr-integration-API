@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content; left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-3 mt-5 ">
        <div class="d-flex">
            <h4 class="align-self-center m-0">Edit RENCANA PULANG (<em>DISCHARGE PLANNING</em>)

            </h4>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <form action="{{ route('checklist/rencana/pulang/page/two.update', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @method('PUT')
            @csrf
            <div class="card-body">
                <table class="table table-bordered mb-3">
                    <thead>
                        <tr>
                            <td class="fw-bold fz-6">
                                TATA LAKSANA GIZI PASIEN DI RUMAH
                            </td>
                            <td>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="fw-semibold">DIET</span>
                                <div class="row">
                                    @foreach ($arrDiet as $diet)                                        
                                    <div class="col-12 form-check form-check-inline mt-3 ">
                                        <input class="form-check-input" type="checkbox" id="{{ $diet }}" value="{{ $diet }}" name="diet[]" {{ in_array($diet, $item->ranapDischargePlanningNutritions->pluck('diet')->toArray()) ? 'checked' : '' }}/>
                                        <label class="form-check-label" for="{{ $diet }}">{{ $diet }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <textarea name="keterangan" id="editor">{!! $item->keterangan_gizi ?? '' !!}</textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="7" class="fw-bold fz-6">
                                PEMBERIAN OBAT PULANG
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="7" class="fw-bold fz-6">
                                DAFTAR NAMA OBAT - OBAT
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>NAMA OBAT</td>
                            <td>INDIKASI</td>
                            <td>DOSIS</td>
                            <td>WAKTU PEMBERIAN</td>
                            <td>CARA PEMBERIAN OBAT</td>
                            <td>ACTION</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item->ranapDischargePlanningPharmacies as $farmasi)    
                        <tr>
                            <td class="text-center">
                                <select name="medicine_id[]" id="medicine_id_{{ $loop->iteration }}" class="form-control form-control-sm">
                                    @foreach ($medicines as $medicine)
                                        @if ($farmasi->medicine->id == $medicine->id)
                                            <option value="{{ $medicine->id }}" selected>{{ $medicine->kode }} - {{ $medicine->name }}</option>
                                        @else
                                            <option value="{{ $medicine->id }}">{{ $medicine->kode }} - {{ $medicine->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="indikasi[]" value="{{ $farmasi->indikasi ?? '' }}" required>
                            </td>
                            <td><input type="text" class="form-control form-control-sm" name="dosis[]" value="{{ $farmasi->dosis ?? '' }}" required></td>
                            <td><input type="datetime-local" class="form-control form-control-sm" name="waktu_pemberian[]" value="{{ date('Y-m-d H:i:s', strtotime($farmasi->waktu_pemberian)) ?? date('Y-m-d H:i:s') }}" required></td>
                            <td><input type="text" class="form-control form-control-sm" name="cara_pemberian[]" value="{{ $farmasi->cara_pemberian ?? '' }}" required></td>
                            <td class="text-center">
                                @if ($loop->last)
                                <button type="button" class="btn btn-sm btn-dark" onclick="tambahInput(this)"><i class="bx bx-plus"></i></button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>Instruksi Rencana Pemulangan Pasien ini telah dijelaskan kepada pasien dan / atau keluarga</p>

                <div class="row mb-5 mt-5">
                    <div class="col-4 text-center">
                        Telah Dibaca dan dimengerti <br>Pasien / Keluarga Pasien
                    </div>
                    <div class="col-4 text-center">
                        Farmasi Klinis
                    </div>
                    <div class="col-4 text-center">
                        Dietisien
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-4 text-center">
                        <img src="{{ asset('storage/' . $item->ttd_wali) }}" alt="" id="ImgTtdKeluargaPasien">
                        <textarea id="ttd" name="ttd_wali" style="display: none;">{{ $item->ttd_wali ?? '' }}</textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModalTtdBottom(this, 'ImgTtdKeluargaPasien', 'ttd')">Tanda
                            Tangan</button>
                    </div>
                    <div class="col-4 text-center">
                        <img src="{{ asset('storage/' . $item->ttd_petugas_gizi) }}" alt="" id="ImgTtdDietisien">
                        <textarea id="ttdDietisien" name="ttd_petugas_gizi" style="display: none;">{{ $item->ttd_petugas_gizi ?? '' }}</textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModal(this, 'ImgTtdDietisien', 'ttdDietisien', 'nm_petugas_gizi')">Tanda
                            Tangan</button>
                    </div>
                    <div class="col-4 text-center">
                        <img src="{{ asset('storage/' . $item->ttd_petugas_farmasi) }}" alt="" id="ImgTtdFarmasi">
                        <textarea id="ttdFarmasi" name="ttd_petugas_farmasi" style="display: none;">{{ $item->ttd_petugas_farmasi ?? '' }}</textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModal(this, 'ImgTtdFarmasi', 'ttdFarmasi', 'nm_petugas_farmasi')">Tanda
                            Tangan</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 text-center">
                        <input type="text" class="form-control text-center" name="nm_wali" id="pasien_name" placeholder="Nama Pasien / Keluarga Pasien" value="{{ $item->nm_wali ?? '' }}">
                    </div>
                    <div class="col-4 text-center">
                        <input type="text" class="form-control text-center" name="nm_petugas_gizi" id="nm_petugas_gizi" placeholder="Nama Dietisien" value="{{ $item->nm_petugas_gizi ?? '' }}" @readonly(true)>
                    </div>
                    <div class="col-4 text-center d-flex">
                        <input type="text" class="form-control text-center" name="nm_petugas_farmasi" id="nm_petugas_farmasi" placeholder="Nama Farmasi Klinis" value="{{ $item->nm_petugas_farmasi ?? '' }}" @readonly(true)>
                    </div>
                </div>

                <div class="mb-3 mt-5  text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>

        {{-- modal create ttd --}}
        <div class="modal fade" id="signaturePadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
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

    {{--modal get ttd --}}
    <div class="modal fade" id="getTtdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <button type="button" class="btn btn-sm btn-secondary" data-action="clearInput">Clear</button>
                        <button type="button" class="btn btn-sm btn-primary" data-action="saveInput">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let count = 100;
        function tambahInput(element){
            var tbody = element.parentNode.parentNode.parentNode;

            var tr = document.createElement('tr');
            tr.innerHTML = `
                    <td class="text-center">
                        <select name="medicine_id[]" id="medicine_id_${count}" class="form-control form-control-sm">
                            @foreach ($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->kode }} - {{ $medicine->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" name="indikasi[]" required>
                    </td>
                    <td><input type="text" class="form-control form-control-sm" name="dosis[]" required></td>
                    <td><input type="datetime-local" class="form-control form-control-sm" name="waktu_pemberian[]" value="{{ date('Y-m-d H:i:s') }}" required></td>
                    <td><input type="text" class="form-control form-control-sm" name="cara_pemberian[]" required></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeInputObat(this)"><i class="bx bx-minus"></i></button>
                    </td>
            `;

            tbody.appendChild(tr);

            $('#medicine_id_' + count).select2();
            count++;
        }

        function removeInputObat(element){
            var tr = element.parentNode.parentNode;
            tr.remove();
        }
    </script>
     <script>
        let tempElementImage;
        let tempTextArea;
        let tempPetugasName;

        function openModal(element, elementImg, elementTextArea, elementPetugasName){
            tempElementImage = $(element).closest('.row').find('#' + elementImg);
            tempTextArea = $(element).closest('.row').find('#' + elementTextArea);
            tempPetugasName = $('#'+elementPetugasName);
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
        
            clearButtonInput.addEventListener('click', function(e){
                e.preventDefault();
                signaturePad.clear();
            });
        
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
                        tempElementImage.attr('src', newSrc);
                        tempTextArea.val(data);
                        tempPetugasName.val(`{{ auth()->user()->name }}`);
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
@endsection
