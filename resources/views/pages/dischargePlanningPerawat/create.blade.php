@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content; left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-3 mt-5 ">
        <div class="card-header">
            <div class="d-flex">
                <h4 class="align-self-center m-0">RENCANA PULANG (<em>DISCHARGE PLANNING</em>)</h4>
            </div>
            <hr class="m-0 mt-2 mb-3">
        </div>
        <div class="card-body">
            <form action="{{ route('checklist/rencana/pulang/page/one.store', $item->id) }}" method="POST"
                onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
                @csrf
                <table class="table table-bordered">
                    <tr class="text-center fw-bold">
                        <td class="w-50"> KEGIATAN
                        </td>
                        <td class="w-50">CATATAN </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-12 ps-3">
                                    <input type="hidden" value="AKTIFITAS, EDUKASI, DAN LATIHAN" name="kegiatan_aktifitas">
                                    <h5>AKTIFITAS, EDUKASI, DAN LATIHAN</h5>
                                </div>
                                @foreach ($arrAktivitas as $aktivitas)
                                    <div class="col-12 form-check form-check-inline my-4 ">
                                        <input class="form-check-input" type="checkbox" id="{{ $aktivitas }}"
                                            value="{{ $aktivitas }}" name="aktivitas[]" />
                                        <label class="form-check-label"
                                            for="{{ $aktivitas }}">{{ $aktivitas }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                @foreach ($arrAktivitas as $aktivitas)
                                    <div class="col-12 mt-4">
                                        <textarea class="form-control form-control-sm" rows="2" placeholder="Catatan {{ $aktivitas }}"
                                            name="catatan_aktifitas[]"></textarea>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-12 ps-3">
                                    <input type="hidden"
                                        value="FASILITAS KESEHATAN YANG BISA DIHUBUNGI JIKA TERJADI KEDARURATAN"
                                        name="kegiatan_fasilitas">
                                    <h5>FASILITAS KESEHATAN YANG BISA DIHUBUNGI JIKA TERJADI KEDARURATAN</h5>
                                </div>

                                @foreach ($arrFasilitas as $fasilitas)
                                    <div class="col-12 form-check form-check-inline my-3 ">
                                        <input class="form-check-input" type="checkbox" id="{{ $fasilitas }}"
                                            value="{{ $fasilitas }}" name="fasilitas[]" />
                                        <label class="form-check-label"
                                            for="{{ $fasilitas }}">{{ $fasilitas }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-12 mt-5">
                                    @foreach ($arrFasilitas as $fasilitas)
                                        <textarea class="form-control form-control-sm my-3" rows="2" placeholder="Catatan Untuk {{ $fasilitas }}"
                                            name="catatan_fasilitas[]"></textarea>
                                    @endforeach

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-12 ps-3">
                                    <input type="hidden" value="RINCIAN PEMULANGAN" name="kegiatan_rincian">
                                    <h5>RINCIAN PEMULANGAN</h5>
                                </div>
                            </div>
                            @foreach ($arrRincian as $rincian)
                                <div class="col-12 form-check form-check-inline mt-3 ">
                                    @if ($rincian == 'Tanggal Kontrol')
                                        <input hidden class="form-control" type="datet" id="{{ $rincian }}"
                                            value="{{ $rincian }}" name="rincian[]" />
                                        Tannggal Kontrol
                                    @else
                                        <input class="form-check-input" type="checkbox" id="{{ $rincian }}"
                                            value="{{ $rincian }}" name="rincian[]" />
                                        <label class="form-check-label"
                                            for="{{ $rincian }}">{{ $rincian }}</label>
                                    @endif

                                </div>
                                @if ($loop->first)
                                    <div class="col-12 form-check form-check-inline mt-3 ">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type="hidden" value="Pendamping:" name="pendamping_name" />
                                                <label class="form-check-label">Pendamping:</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 form-check form-check-inline mt-3 ">
                                        <div class="row">
                                            <div class="col-5">
                                                <input type="hidden" value="Transportasi Yang Digunakan:"
                                                    name="transportasi_name" />
                                                <label class="form-check-label">Transportasi Yang Digunakan:</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($loop->last)
                                    <div class="col-12 form-check form-check-inline mt-3 ">
                                        <input type="hidden" value="Kelengkapan Administrasi" name="adm_name" />
                                        <label class="form-check-label">Kelengkapan Administrasi:</label>
                                    </div>
                                @endif
                            @endforeach

                        </td>
                        <td>
                            <div class="row">
                                <div class="col-12">
                                    @foreach ($arrRincian as $rincian)
                                        <div class="col-12 form-check form-check-inline mt-3 ">
                                            @if ($rincian == 'Tanggal Kontrol')
                                                <input class="form-control" type="date" id="{{ $rincian }}"
                                                    value="{{ $rincian }}" name="catatan_rincian[]" />
                                            @else
                                                <textarea class="form-control form-control-sm" rows="1" placeholder="Catatan Untuk {{ $rincian }}"
                                                    name="catatan_rincian[]"></textarea>
                                            @endif
                                        </div>
                                        @if ($loop->first)
                                            <div class="col-12 form-check form-check-inline mt-3 ">
                                                <div class="row">
                                                    @foreach ($arrPendamping as $pendamping)
                                                        <div class="col-2">
                                                            <input class="form-check-input" type="radio"
                                                                id="{{ $pendamping }}" value="{{ $pendamping }}"
                                                                name="pendamping" />
                                                            <label class="form-check-label"
                                                                for="{{ $pendamping }}">{{ $pendamping }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-12 form-check form-check-inline mt-3 ">
                                                <div class="row">
                                                    @foreach ($arrTrans as $transportasi)
                                                        <div class="col-3">
                                                            <input class="form-check-input" type="radio"
                                                                id="{{ $transportasi }}" value="{{ $transportasi }}"
                                                                name="transportasi" />
                                                            <label class="form-check-label"
                                                                for="{{ $transportasi }}">{{ $transportasi }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        @if ($loop->last)
                                            <div class="col-12 row px-5">
                                                <div class="row mx-3">
                                                    @foreach ($arrKelAdm as $adm)
                                                        <div class="form-check form-check-inline mt-3 col-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="{{ $adm }}" value="{{ $adm }}"
                                                                name="adm[]" />
                                                            <label class="form-check-label"
                                                                for="{{ $adm }}">{{ $adm }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>

                        </td>
                    </tr>
                </table>

                <p class="mt-2">NB: *) <span class="fw-bold">SKD</span> surat keterangan dirawat , <span
                        class="fw-bold">SKI</span> :
                    surat keterangan istirahat </p>
                <p style="margin: -3mm 1mm;"><span style="color: transparent">NB:</span>*) Aktifitas , edukasi dan latihan
                    ipilih dengan sesui kebutuhan
                    pasien </p>

                <div class="row mb-5 mt-5">
                    <div class="col-4 text-center">
                        Pasien / Keluarga Pasien
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4 text-center d-flex">
                        Padang, <input type="datetime-local" name="tanggal" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-4 text-center">
                        <img src="" alt="" id="ImgTtdKeluargaPasien">
                        <textarea id="ttd" name="ttd_pasien" style="display: none;"></textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModalTtdBottom(this, 'ImgTtdKeluargaPasien', 'ttd')">Tanda
                            Tangan</button>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4 text-center">
                        <img src="" alt="" id="ImgTtdPpj">
                        <textarea id="ttdPpj" name="ttd_petugas" style="display: none;"></textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark" onclick="openModal(this)">Tanda
                            Tangan</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 text-center">
                        <input type="text" class="form-control" name="pasien_name" id="pasien_name"
                            placeholder="Nama Pasien / Keluarga Pasien">
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4 text-center d-flex">
                        <input type="text" class="form-control" name="petugas_name" id="petugas_name"
                            placeholder="Nama Perawat Penanggung Jawap Pasien" @readonly(true)>
                    </div>
                </div>

                <div class="mb-3 mt-5  text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
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

        function openModal(element) {
            $('#getTtdModal').modal('show');
        }

        function openModalTtdBottom(element, elementImg, elementTextArea) {
            console.log(element.closest('td'));
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
    </script>
@endsection
