@extends('layouts.backend.main')

@section('content')
    <style>
        td {
            padding-top: 5px;
            vertical-align: top;
        }
    </style>
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="card mb-4">
        <div class="card-header d-flex">
            <div class="col-10 d-flex align-items-center">
                <h5 class="mb-0">Tambah Permintaan Radiologi</h5>
            </div>
            <div class="col-2 text-end">
                <a href="{{ $urlParent }}" class="btn btn-success btn-sm text-end">Kembali</a>
                {{-- <button type="button" class="btn btn-success btn-sm text-end" onclick="history.back()">Kembali</button> --}}
            </div>
        </div>
        <form action="{{ route('rajal/permintaan/radiologi.store', $item->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <input type="hidden" value="{{ $urlParent ?? '' }}" name="urlParent">
            <div class="card-body">
                <div class="mb-3">
                    <input type="hidden" name="patient_id" value="{{ $item->patient->id }}" />
                    <h6>Asal Ruangan</h6>
                    <input type="hidden" name="room_detail_id"
                        value="{{ $item->doctorPatient->user->roomDetail->id ?? '' }}" />
                    <input type="text" value="{{ $item->doctorPatient->user->roomDetail->name ?? '' }}"
                        class="form-control" id="floatingInput" placeholder="" aria-describedby="floatingInputHelp"
                        readonly />
                </div>
                <div class="mb-3">
                    <h6>Diagnosa Klinis</h6>
                    <input type="text" class="form-control" name="diagnosa_klinis">{{ $diagnosa ?? '' }}</input>
                </div>
                <div class="my-3">
                    <h6>Catatan</h6>
                    <textarea class="form-control" name="catatan" cols="30" rows="4"></textarea>
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
                            <textarea name="keterangan[]" class="form-control" id="" cols="30" rows="1" placeholder="Tambahkan Keterangan Untuk Pemeriksaan Disini ..."></textarea>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-success addInput"><i class="bx bx-plus"></i></button>
                        </div>
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
                                        <textarea id="ttd_user" name="ttd_user" style="display: none;"></textarea>
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
                <div class="my-3 text-end">
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
