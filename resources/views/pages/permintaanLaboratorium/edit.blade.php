@extends('layouts.backend.main')

@section('content')
@if (session()->has('success'))
<div class="alert alert-success d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-check-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">BERHASIL !!</h6>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>{{ session('error') }}</span>
    </div>
</div>
@endif
@if (session()->has('exceptions'))
<div class="alert alert-danger d-flex" role="alert">
<span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
<div class="d-flex flex-column ps-1">
    <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
    <span>
    @foreach (session('exceptions') as $error)
        <li>{{ $error }}</li>
    @endforeach
    </span>
</div>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger d-flex" role="alert">
<span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
<div class="d-flex flex-column ps-1">
    <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
    <span>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </span>
</div>
</div>
@endif
    <div id="success-message"></div>
         {{-- Informasi Pasien --}}
         <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h4 class="mb-1 text-primary d-flex">
                            {{ $item->queue->patient->name }} ({{ $item->queue->patient->no_rm ?? }})
                            <span class="ms-2 badge {{ $item->queue->patient->jenis_kelamin == 'Wanita' ? 'bg-danger' : 'bg-info' }}">{{ $item->queue->patient->jenis_kelamin == 'Wanita' ? 'P' : 'L' }}</span> 
                        </h4>
                        <h6 class="mb-1">{{ $item->queue->dpjp->name }} ({{ $item->queue->dpjp->staff_id }}) / <span class="fw-bold">{{ $item->dpjp->poliklinik->name ?? '' }}</span></h6>
                        <h6 class="mb-1"><h6>
                        @if ($item->queue->rawatJalanPoliPatient->status == 'WAITING')                                    
                            <span class="badge bg-danger">BELUM DILAYANI</span>
                        @elseif ($item->queue->rawatJalanPoliPatient->status == 'ONGOING')
                            <span class="badge bg-warning">DALAM PERAWATAN</span>
                        @elseif ($item->queue->rawatJalanPoliPatient->status == 'FINISHED')
                            <span class="badge bg-success">SUDAH DILAYANI</span>
                        @else
                            <span class="badge bg-success">TIDAK DIKETAHUI</span>
                        @endif
                    </div>
                    <div class="col-8 text-end">
                        <p class="mb-0">No. Antrian : <span class="fst-italic fw-bold">{{ $item->queue->no_antrian ?? '' }}</span></p>
                        <p class="mb-0">Tanggungan : <span class="fw-bold fst-italic">{{ $item->queue->patientCategory->name }}</span></p>
                        <p class="mb-0">Tgl. Lahir : <span class="fw-bold fst-italic">{{ $item->queue->patient->tanggal_lhr }}</span></p>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Informasi Pasien --}}
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah Permintaan Laboratorium</h5>
        </div>
        <form action="{{ route('rajal/laboratorium/request.update', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row mb-3">
                            <label for="tipe_permintaan" class="col-form-label col-3">Kategori Permintaan</label>
                            <div class="col-9">
                                <select name="tipe_permintaan" class="form-select" id="tipe_permintaan">
                                    <option value="Reguler" {{ old('tipe_permintaan', $item->tipe_permintaan) == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                                    <option value="Urgent" {{ old('tipe_permintaan', $item->tipe_permintaan) == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal" class="col-form-label col-3">Tanggal Pengambilan Sampel</label>
                            <div class="col-9">
                                <input class="form-control" type="date" value="{{ old('tanggal_sampel', $item->tanggal_sampel ?? date('Y-m-d')) }}" name="tanggal_sampel" id="tanggal" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row mb-3">
                            <label for="diagnosa" class="col-form-label col-3">Diagnosa Klinis</label>
                            <div class="col-9">
                                <input class="form-control" type="text" name="diagnosa" value="{{ old('diagnosa', $item->diagnosa) }}" required></input>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="catatan" class="col-form-label col-3">Catatan</label>
                            <div class="col-9">
                                <textarea class="form-control" type="text" name="catatan">{!! old('catatan', $item->catatan ?? '') !!}</textarea>
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
                            <select name="action_id[]" id="action_id_1" class="form-control form-select select2-action">
                                @foreach ($data as $act)
                                    @if (old('action_id.' . 0, $item->laboratoriumRequestDetails[0]->action_id) == $act->id)
                                        <option value="{{ $act->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($act->actionRates->where('patient_category_id', $item->queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}" selected>{{ $act->name }}</option>
                                    @else
                                        <option value="{{ $act->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($act->actionRates->where('patient_category_id', $item->queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}">{{ $act->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <textarea name="keterangan[]" class="form-control" id="keterangan_{{ $act->id }}" cols="30" rows="1" placeholder="Tambahkan Keterangan Untuk Pemeriksaan Disini ...">{{ old('keterangan.' . 0, $item->laboratoriumRequestDetails[0]->keterangan) }}</textarea>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-success" onclick="addInput(this)"><i class="bx bx-plus"></i></button>
                        </div>
                    </div>
                    @if (session('_old_input'))
                        @foreach (collect(old('action_id'))->skip(1) as $key => $actionId)
                        <div class="row loopHere my-2">
                            <div class="col-5">
                                <select name="action_id[{{ $key }}]" id="action_id{{ $key }}" class="form-control form-select select2-action">
                                    @foreach ($data as $act)
                                        @if ($actionId == $act->id)
                                            <option value="{{ $act->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($act->actionRates->where('patient_category_id', $item->queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}" selected>{{ $act->name }}</option>
                                        @else
                                            <option value="{{ $act->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($act->actionRates->where('patient_category_id', $item->queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}">{{ $act->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <textarea name="keterangan[{{ $key }}]" class="form-control" id="keterangan{{ $key }}" cols="30" rows="1" placeholder="Tambahkan Keterangan Untuk Pemeriksaan Disini ...">{{ old('keterangan.' . 0) }}</textarea>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-danger" onclick="removeInputNew(this)"><i class="bx bx-minus"></i></button>
                            </div>
                        </div>
                        @endforeach
                    @else
                        @foreach ($item->laboratoriumRequestDetails->skip(1) as $index => $detail)
                        <div class="row loopHere my-2">
                            <div class="col-5">
                                <select name="action_id[{{ $index }}]" id="action_id{{ $index }}" class="form-control form-select select2-action">
                                    @foreach ($data as $act)
                                        @if (($detail->action_id ?? '') == $act->id)
                                            <option value="{{ $act->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($act->actionRates->where('patient_category_id', $item->queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}" selected>{{ $act->name }}</option>
                                        @else
                                            <option value="{{ $act->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($act->actionRates->where('patient_category_id', $item->queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}">{{ $act->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <textarea name="keterangan[{{ $index }}]" class="form-control" id="keterangan{{ $index }}" cols="30" rows="1" placeholder="Tambahkan Keterangan Untuk Pemeriksaan Disini ...">{{ $detail->keterangan ?? '' }}</textarea>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-danger" onclick="removeInputNew(this)"><i class="bx bx-minus"></i></button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="row" id="inputTemplate">
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="generate_template" id="generate_template" onclick="createTemplate(this)" {{ old('generate_template') ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold fst-italic" for="generate_template">Generate template dari list permintaan</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control col-4" value="{{ old('name') }}" name="name" id="template_name" placeholder="Nama Template" required disabled>
                    </div>
                </div>

                {{-- tanda tangan --}}

                <div class="row justify-content-center justify-content-lg-end">
                    <div class="col-4">
                        <div class="d-flex justify-content-center pt-3">
                            <div class="d-flex flex-column">
                                <div class="text-center" style="min-width: 300px">
                                    <label class="form-label fw-bold" id="label-kolom">Dokter yang meminta</label>
                                    <div class="d-flex flex-column">
                                        <img src="{{ Storage::url($item->ttd_dokter ?? '') }}" alt="" id="imgTtdUser" class="">
                                        <textarea id="ttd_user" name="ttd_dokter" style="display: none;">{{ $item->ttd_dokter ?? null }}</textarea>
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
                <hr class="my-5">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary me-2"><i class="bx bx-save"></i> Submit</button>
                    {{ session()->flash('btn', 'penunjang'); }}
                    {{ session()->flash('penunjang', 'laboratorium'); }}
                    <a href="{{ route('rajal/show', ['id' => encrypt($item->queue->id), 'title' => encrypt('Rawat Jalan')]) }}" class="btn btn-outline-danger"><i class="bx bx-left-arrow"></i> Kembali</a>
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
        var patientCategoryId = @json($item->queue->patient_category_id ?? '');
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
                <select name="action_id[]" id="action_id_${counter}" class="form-control form-select select2-action">
                    @foreach ($data as $act)
                        <option value="{{ $act->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($act->actionRates->where('patient_category_id', $item->queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}">{{ $act->name }}</option>
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
            regenerateSelect('select2-action', 'Pilih Tindakan');
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
                inputName.value = '';
            }
        }

        // get Template
        function getTemplate(element){
            const dataTemplate = @json($templates);
            const dataActions = @json($data);
            const selectedTemplate = dataTemplate.find(item => item.id == element.value);
            handleActionTemplate(selectedTemplate, dataActions);
        }
        function handleActionTemplate(template, actions){
            var divAdd = document.querySelector('.divAdd');
            var htmlData;

            //remove current data
            var loopHere = divAdd.querySelectorAll('.loopHere');
            loopHere.forEach(function(loopItemToRemove){
                loopItemToRemove.remove();
            });

            //add data from template
            template.laboratorium_master_template_details.forEach(function(item, index){
                //create element select dinamis
                var selectedOpt = item.action_id;
                var elementSelect = document.createElement('select');
                elementSelect.name = 'action_id[]';
                elementSelect.id = `action_id_${index}`;
                elementSelect.className = 'form-control form-select select2-action';
                response = selectOptions(actions, selectedOpt, elementSelect);

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
         
            regenerateSelect('select2-action', 'Pilih Tindakan');
        }

        function selectOptions(data, selectedOptId, selectElement){
            data.forEach(function(dt) {
                const actionRate = dt.action_rates.find(rate => rate.patient_category_id == patientCategoryId);
                const tarif = (actionRate ? (actionRate.tarif ?? 0) : 0);
                const harga = toRupiah(tarif);

                var option = document.createElement('option');
                option.text = dt.name;
                option.value = dt.id;
                option.selected = dt.id === selectedOptId;
                option.dataset.foo = 'Tarif Pemeriksaan : Rp. ' + harga;
                selectElement.appendChild(option);
            });
            return selectElement;
        }

        function toRupiah(harga){
            return harga.toLocaleString('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 });
        }
    </script>
    @endsection
@endsection

