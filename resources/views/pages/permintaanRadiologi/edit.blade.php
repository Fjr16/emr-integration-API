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
                        {{ $queue->patient->name }} ({{ $queue->patient->no_rm ?? '' }})
                        <span class="ms-2 badge {{ $queue->patient->jenis_kelamin == 'Wanita' ? 'bg-danger' : 'bg-info' }}">{{ $queue->patient->jenis_kelamin == 'Wanita' ? 'P' : 'L' }}</span> 
                    </h4>
                    <h6 class="mb-1">{{ $queue->dpjp->name }} ({{ $queue->dpjp->staff_id }}) / <span class="fw-bold">{{ $queue->dpjp->poliklinik->name ?? '' }}</span></h6>
                    <h6 class="mb-1"><h6>
                    @if ($queue->rawatJalanPoliPatient->status == 'WAITING')                                    
                        <span class="badge bg-danger">BELUM DILAYANI</span>
                    @elseif ($queue->rawatJalanPoliPatient->status == 'ONGOING')
                        <span class="badge bg-warning">DALAM PERAWATAN</span>
                    @elseif ($queue->rawatJalanPoliPatient->status == 'FINISHED')
                        <span class="badge bg-success">SUDAH DILAYANI</span>
                    @else
                        <span class="badge bg-success">TIDAK DIKETAHUI</span>
                    @endif
                </div>
                <div class="col-8 text-end">
                    <p class="mb-0">No. Antrian : <span class="fst-italic fw-bold">{{ $queue->no_antrian ?? '' }}</span></p>
                    <p class="mb-0">Tanggungan : <span class="fw-bold fst-italic">{{ $queue->patientCategory->name }}</span></p>
                    <p class="mb-0">Tgl. Lahir : <span class="fw-bold fst-italic">{{ $queue->patient->tanggal_lhr }}</span></p>
                </div>
            </div>
        </div>
    </div>
    {{-- end Informasi Pasien --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Edit Permintaan Radiologi</h5>
        </div>
        <form action="{{ route('rajal/permintaan/radiologi.update', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <h6>Diagnosa Klinis</h6>
                    <input type="text" class="form-control" name="diagnosa_klinis" value="{{ $item->diagnosa_klinis ?? '' }}"></input>
                </div>
                <div class="my-3">
                    <h6 class="mb-0">Catatan</h6>
                    <textarea class="form-control" name="catatan" cols="30" rows="4">{{ $item->catatan ?? '' }}</textarea>
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

                    <div class="row">
                        <input type="hidden" name="radiologi_detail_id[]" value="{{ $item->radiologiFormRequestDetails[0]->id }}">
                        <div class="col-5">
                            <select name="action_id[]" id="action_id_1" class="form-control form-select select2-action">
                                @foreach ($data as $act)
                                <option {{ old('action_id.' . 0, $item->radiologiFormRequestDetails[0]->action_id ?? '') ? '' : 'selected' }} disabled></option>
                                    @if (old('action_id.' . 0, $item->radiologiFormRequestDetails[0]->action_id) == $act->id)
                                        <option value="{{ $act->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($act->actionRates->where('patient_category_id', $queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}" selected>{{ $act->name ?? '' }}</option>
                                    @else
                                        <option value="{{ $act->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($act->actionRates->where('patient_category_id', $queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}">{{ $act->name ?? '' }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <textarea name="keterangan[]" class="form-control" id="" cols="30" rows="1" placeholder="Tambahkan Keterangan Untuk Setiap Tindakan Jika diperlukan ...">{{ old('keterangan.' . 0, $item->radiologiFormRequestDetails[0]->keterangan ?? '') }}</textarea>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-success addInput"><i class="bx bx-plus"></i></button>
                        </div>
                    </div>
                    @if (session('_old_input'))
                        @foreach (collect(old('action_id'))->skip(1) as $key => $actionId)
                            <input type="hidden" name="radiologi_detail_id[{{ $key }}]" value="{{ old('radiologi_detail_id.' . $key) }}">
                            <div class="row my-2">
                                <div class="col-5">
                                    <select name="action_id[{{ $key }}]" id="action_id{{ $key }}" class="form-control form-select select2-action" data-allow-clear="true">
                                        @foreach ($data as $act)
                                        <option {{ $actionId ? '' : 'selected' }} disabled></option>
                                            @if ($actionId == $act->id)
                                                <option value="{{ $act->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($act->actionRates->where('patient_category_id', $queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}" selected>{{ $act->name ?? '' }}</option>
                                            @else
                                                <option value="{{ $act->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($act->actionRates->where('patient_category_id', $queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}">{{ $act->name ?? '' }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <textarea name="keterangan[{{ $key }}]" class="form-control" id="" cols="30" rows="1" placeholder="Tambahkan Keterangan Untuk Setiap Tindakan Jika diperlukan ...">{{ old('keterangan.' . $key) }}</textarea>
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn btn-danger" onclick="removeInputNew(this)"><i class="bx bx-minus"></i></button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach ($item->radiologiFormRequestDetails->skip(1) as $detail)    
                        <input type="hidden" name="radiologi_detail_id[]" value="{{ $detail->id }}">
                            <div class="row my-2">
                                <div class="col-5">
                                    <select name="action_id[]" id="action_id_{{ $detail->id }}" class="form-control form-select select2-action" data-allow-clear="true">
                                        @foreach ($data as $action)
                                            @if (old('action_id', $action->id) == $detail->action->id)
                                                <option value="{{ $action->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($action->actionRates->where('patient_category_id', $queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}" selected>{{ $action->name }}</option>
                                            @else
                                                <option value="{{ $action->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($action->actionRates->where('patient_category_id', $queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}">{{ $action->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <textarea name="keterangan[]" id="keterangan_{{ $detail->id }}" class="form-control" id="" cols="30" rows="1" placeholder="Tambahkan Keterangan Untuk Pemeriksaan Disini ...">{!! $detail->keterangan ?? '' !!}</textarea>
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn btn-danger" onclick="removeInputNew(this)"><i class="bx bx-minus"></i></button>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>

                <div class="row justify-content-center justify-content-lg-end">
                    <div class="col-4">
                        <div class="d-flex justify-content-center pt-3">
                            <div class="d-flex flex-column">
                                <div class="text-center" style="min-width: 300px">
                                    <label class="form-label fw-bold" id="label-kolom">Dokter yang meminta</label>
                                    <div class="d-flex flex-column">
                                        @if ($item->ttd_dokter)
                                            <img src="{{ Storage::url($item->ttd_dokter) }}" alt=""
                                                id="ImgTtdUser">
                                        @else
                                            <img src="" alt="" id="imgTtdUser" class="">
                                        @endif
                                        <textarea id="ttd_user" name="ttd_user" style="display: none;">{{ $item->ttd_dokter ?? '' }}</textarea>
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
                    <button type="submit" class="btn btn-outline-primary me-2"><i class="bx bx-save"></i> Update</button>
                    {{ session()->flash('btn', 'penunjang'); }}
                    {{ session()->flash('penunjang', 'radiologi'); }}
                    <a href="{{ route('rajal/show', ['id' => encrypt($queue->id), 'title' => encrypt('Rawat Jalan')]) }}" class="btn btn-outline-danger"><i class="bx bx-left-arrow"></i> Kembali</a>
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
            var countCurrent = document.querySelectorAll('select[name="action_id[]"]');
            let counter = [...countCurrent].length;
            $(document).ready(function(){
                var btnAdds = document.querySelectorAll('.addInput');
                btnAdds.forEach(function(add){
                    add.addEventListener('click', function(){
                        counter = counter+1;
                        var row = add.closest('.divAdd');
                        var newDiv = document.createElement('div');
                        newDiv.className = 'row my-2';
                        newDiv.innerHTML = `
                        <div class="col-5">
                        <select name="action_id[]" id="action_id_${counter}" class="form-control form-select select2-action">
                            @foreach ($data as $act)
                                <option value="{{ $act->id }}" data-foo="Tarif Pemeriksaan : Rp. {{ number_format($act->actionRates->where('patient_category_id', $queue->patientCategory->id ?? '')->pluck('tarif')->first()) }}">{{ $act->name }}</option>
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
                    });
                });
            });
            // untuk menghapus input dinamis
            function removeInputNew(element) {
                var row = element.closest('.row');
                row.remove();
            }
        </script>
    @endsection
@endsection
