@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah Permintaan Laboratorium</h5>
        </div>
        <form action="{{ route($routeStore, $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row mb-3">
                            <label for="tipe_permintaan" class="col-form-label col-3">Kategori Permintaan</label>
                            <div class="col-9">
                                <select name="tipe_permintaan" class="form-select" id="tipe_permintaan">
                                    <option value="Reguler" selected>Reguler</option>
                                    <option value="Urgent">Urgent</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal" class="col-form-label col-3">Tanggal Pengambilan Sampel</label>
                            <div class="col-9">
                                <input type="hidden" name="room_detail_id" value="{{ $item->doctorPatient->user->roomDetail->id ?? '' }}"></input>
                                <input class="form-control" type="date" value="{{ date('Y-m-d') }}" name="tanggal_sampel" id="tanggal" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row mb-3">
                            <label for="diagnosa" class="col-form-label col-3">Diagnosa</label>
                            <div class="col-9">
                                <input class="form-control" type="text" name="diagnosa" required>{{ $diagnosa }}</input>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="catatan" class="col-form-label col-3">Catatan</label>
                            <div class="col-9">
                                <textarea class="form-control" type="text" name="catatan">{!! $catatan ?? '' !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <select name="laboratorium_master_template_id[]" id="laboratorium_master_template_id" class="form-control form-select select2" onchange="getTemplate(this)">
                            <option selected disabled>Pilih Template</option>
                            @foreach ($templates as $template)
                                @if (old('laboratorium_master_template_id') == $template->id)
                                    <option value="{{ $template->id }}" selected>{{ $template->name }}</option>
                                @else
                                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="my-4 divAdd">
                    <div class="row">
                        <div class="col-5">
                            <h6 class="mb-2">Nama Tindakan</h6>
                        </div>
                        <div class="col-6">
                            <h6 class="mb-2">Keterangan</h6>
                        </div>
                    </div>
                    <div class="row loopHere">
                        <div class="col-5">
                            <select name="action_id[]" id="action_id_1" class="form-control form-select select2">
                                @foreach ($data as $item)
                                    @if (old('action_id', $item->id))
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <textarea name="keterangan[]" class="form-control" id="keterangan_{{ $item->id }}" cols="30" rows="1" placeholder="Tambahkan Keterangan Untuk Pemeriksaan Disini ..."></textarea>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-success" onclick="addInput(this)"><i class="bx bx-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row" id="inputTemplate">
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="generate_template" id="generate_template" onclick="createTemplate(this)">
                            <label class="form-check-label fw-bold fst-italic" for="generate_template">Generate template dari list permintaan</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control col-4" value="" name="name" id="template_name" placeholder="Nama Template" required disabled>
                    </div>
                </div>

                {{-- tanda tangan --}}
                <div class="d-flex flex-row justify-content-end mt-5">
                    <span>Padang, Tanggal</span>
                    <div class="ms-2">
                        <input type="date" name="date" class="form-control form-control-sm"
                            value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                    </div>
                    <span class="ms-3">Pukul</span>
                    <div class="ms-2"><input type="time" name="time" class="form-control form-control-sm"
                            value="{{ \Carbon\Carbon::now()->format('H:i') }}">
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
                                        <textarea id="ttd_user" name="ttd_dokter" style="display: none;" required></textarea>
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

                <div class="mb-3 text-start">
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

    @section('script')
    <script>
        // get Ttd User modal
        function openModal(element) {
            $('#getTtdModal').modal('show');
        }
        // get Ttd modal from user tabel
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

        // untuk menambahkan input dinamis
        let counter = 1;
        function addInput(add){
            counter = counter+1;
            var row = add.closest('.divAdd');
            var newDiv = document.createElement('div');
            newDiv.className = 'row loopHere my-2';
            newDiv.innerHTML = `
            <div class="col-5">
                <select name="action_id[]" id="action_id_${counter}" class="form-control form-select">
                    @foreach ($data as $item)
                        @if (old('action_id', $item->id))
                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <textarea name="keterangan[]" class="form-control" id="" cols="30" rows="1" placeholder="Tambahkan Keterangan Untuk Pemeriksaan Disini ..."></textarea>
            </div>
            <div class="col-1">
                <button type="button" class="btn btn-danger" onclick="removeInputNew(this)"><i class="bx bx-minus"></i></button>
            </div>
            `;
            
            row.appendChild(newDiv);
            $(`#action_id_${counter}`).select2();
        }
        // untuk menghapus input dinamis
        function removeInputNew(element) {
            var row = element.closest('.row');
            row.remove();
        }

        // untuk membuat template
        function createTemplate(element){
            var inputName = element.closest('.row').querySelector('#template_name');
            if (element.checked) {
                inputName.disabled = false;
            }else{
                inputName.disabled = true;
            }
        }

        // get Template
        function getTemplate(element){
            $.ajax({
                type : 'get',
                url : "{{ route('laboratorium/request.getTemplate', '') }}/"+element.value,
                success: function(res) {
                    handleActionTemplate(res);
                }
            })
        }
        function handleActionTemplate(data){
            var divAdd = document.querySelector('.divAdd');
            var htmlData;

            //remove current data
            var loopHere = divAdd.querySelectorAll('.loopHere');
            loopHere.forEach(function(loopItemToRemove){
                loopItemToRemove.remove();
            });

            //add data from template
            data.details.forEach(function(item, index){
                //create element select dinamis
                var selectedOpt = item.action_id;
                var elementSelect = document.createElement('select');
                elementSelect.name = 'action_id[]';
                elementSelect.id = `action_id_${counter}`;
                elementSelect.className = 'form-control form-select select2';
                response = selectOptions(data.actions, selectedOpt, elementSelect);

                counter = counter+1;
                var classRow = (index !== 0) ? 'my-2' : ''; // Add class only for subsequent rows
                var btn = (index !== 0) ? '<button type="button" class="btn btn-danger" onclick="removeInputNew(this)"><i class="bx bx-minus"></i></button>' : '<button type="button" class="btn btn-success" onclick="addInput(this)"><i class="bx bx-plus"></i></button>';

                var newRow = document.createElement('div')
                newRow.className = 'row loopHere ' + classRow;
                var newCol = document.createElement('div');
                newCol.className = 'col-5';
                newCol.appendChild(response);
                newRow.appendChild(newCol);
                htmlAdditional = ` 
                        <div class="col-6">
                            <textarea name="keterangan[]" class="form-control" id="keterangan_${counter}" cols="30" rows="1" placeholder="Tambahkan Keterangan Untuk Pemeriksaan Disini ...">${item.keterangan}</textarea>
                        </div>
                        <div class="col-1">
                            ${btn}
                        </div>`;
                newRow.insertAdjacentHTML('beforeend', htmlAdditional);
                divAdd.appendChild(newRow); 
            });
            var select2 = document.querySelectorAll('.select2');
            select2.forEach(function(sel){
                $(sel).select2();
            });
        }

        function selectOptions(data, selectedOptId, selectElement){
            data.forEach(function(dt) {
                var option = document.createElement('option');
                option.text = dt.name;
                option.value = dt.id;
                option.selected = dt.id === selectedOptId;
                selectElement.appendChild(option);
            });
            return selectElement;
        }
    </script>
    @endsection
@endsection

