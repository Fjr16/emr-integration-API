@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Lembar Konsul Pasien
                <span class="text-primary">Nama Pasien</span>
            </h5>
        </div>
        <div class="card-body mt-3">
            <form action="#" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mx-5">
                        <div class="row mb-3">
                            <label for="namaPasien" class="col-12 col-md-6 col-lg-2 text-capitalize">Nama
                                Pasien</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="text" value="" name="namaPasien" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="umur" class="col-12 col-md-6 col-lg-2 text-capitalize">Umur</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="number" value="" name="umur" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="noRekamMedis" class="col-12 col-md-6 col-lg-2 text-capitalize">No.
                                Rekam Medis</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="text" value="" name="noRekamMedis" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="diagnosaAkhir" class="col-12 col-md-6 col-lg-2 text-capitalize">Diagnosa
                                Akhir</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="text" value="" name="diagnosaAkhir" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="terapi" class="col-12 col-md-6 col-lg-2 text-capitalize">Terapi
                                yang diberikan</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="text" value="" name="terapi" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal" class="col-12 col-md-6 col-lg-2 text-capitalize">Pada
                                Tanggal</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="date" value="" name="tanggal" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pukul" class="col-12 col-md-6 col-lg-2 text-capitalize">Pukul</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="time" value="" name="pukul" />
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-end">
                        <div class="col col-12 col-lg-4 text-center pt-3">
                            <div class="col-12 text-center">
                                Petugas Admisi
                            </div>
                            <div class="col-12"></div>
                            <div class="col-12 text-center">
                                Padang, {{ date('d  M  Y') }} <br>
                            </div>
                            <div class="">
                                <div class="col-12 text-center">
                                    <img src="" alt="" id="ImgTtdPpj">
                                    <textarea id="ttdPpj" name="ttd_perawat" style="display: none;"></textarea>
                                    <button type="button" class="col-12 btn btn-sm btn-dark"
                                        onclick="openModal(this)">Tanda
                                        Tangan</button>
                                </div>
                            </div>
                            <div class="mt-3">
                                <input type="text" class="form-control form-control-sm text-center"
                                    value="{{ auth()->user()->name ?? '' }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 text-end mt-3">
                        <button type="submit" class="btn btn-success btn-sm">Edit</button>
                    </div>
                </div>
            </form>
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
            // start get ttd from user table
            var modal = document.getElementById("getTtdModal");
            var clearButtonInput = modal.querySelector("[data-action=clearInput]");
            var saveButtonInput = modal.querySelector("[data-action=saveInput]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');

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
                        $('#ImgTtdPpj').attr('src', newSrc);
                        $('#ttdPpj').val(data);
                        $('#petugas_name').val(`{{ auth()->user()->name }}`);
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

        document.addEventListener('DOMContentLoaded', function() {
            var name = document.querySelector('input[name="name"]');
            var namaDis = document.getElementById('nama');
            var nameTtd = document.getElementById('nameTtd');

            name.addEventListener('change', function() {
                namaDis.value = name.value;
                nameTtd.value = name.value;
            });
        });

        function hubunganSelect(element) {
            var hubDis = document.getElementById('hub');
            hubDis.value = element.value;
        }
    </script>
@endsection
