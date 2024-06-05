@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header m-0">
            <div class="row">
                <div class="col-9">
                    <h5 class="mb-0 m-0">Asesmen Awal Keperawatan <span
                            class="fs-4 fw-bold text-primary">{{ $item->queue->patient->name ?? '' }}</span></h5>
                </div>
                <div class="col-3 m-0 text-end">
                    @php
                        session()->flash('active', 'asesmenperawat');
                    @endphp
                    <a href="{{ route('igd/patient/rme.show', $currentIgdPatientId ?? $item->id) }}"
                        class="btn btn-success btn-sm">Kembali</a>
                </div>
            </div>
            <div class="row m-auto mt-2">
                <a href="{{ route('igd/asesmen/status/fisik.index', $item->id) }}"
                    class="btn {{ Route::is('igd/asesmen/status/fisik.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Status
                    Fisik</a>
                <a href="{{ route('igd/asesmen/skrining/resiko/jatuh.index', $item->id) }}"
                    class="btn {{ Route::is('igd/asesmen/skrining/resiko/jatuh.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Skrining
                    Resiko Jatuh</a>
                <a href="{{ route('igd/asesmen/diagnosis/keperawatan.index', $item->id) }}"
                    class="btn {{ Route::is('igd/asesmen/diagnosis/keperawatan.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Diagnosis
                    Keperawatan</a>
                <a href="{{ route('igd/asesmen/rencana/asuhan.index', $item->id) }}"
                    class="btn {{ Route::is('igd/asesmen/rencana/asuhan.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Rencana
                    Asuhan</a>
            </div>
        </div>

        <div class="card-body">
            <h6 class="text-center bg-dark text-white py-2">RENCANA ASUHAN</h6>
            <div class="row mb-3">
                <form action="{{ route('igd/asesmen/rencana/asuhan.store', $item->id) }}" method="POST">
                    @csrf
                    <div class="col-sm-4 ">
                        <div class="mx-2">
                            @foreach ($rencanaAsuhan as $asuhan)
                                @php
                                    $checked = null;
                                    if ($detailRencana) {
                                        $detail = $detailRencana->where('name', $asuhan)->first();
                                        if ($detail) {
                                            $checked = 'checked';
                                        }
                                    }
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input" type="hidden" value="{{ $asuhan }}"
                                        name="rencana-asuhan[]" id="defaultCheck1" />
                                    <input class="form-check-input" type="checkbox" value="{{ $asuhan }}"
                                        name="asuhan[]" id="{{ $asuhan }}" {{ $checked }} />
                                    <label class="form-check-label" for="{{ $asuhan }}">
                                        {{ $asuhan }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row mb-3 text-end">
                        <div class="col-7"></div>
                        @php
                            $formatTanggal = Carbon\Carbon::parse($item->igdAseKepPatient->tgl_selesai_asesmen ?? '');
                        @endphp
                        <div class="col-3">Tanggal / Jam selesai asesmen :</div>
                        <div class="col-2"><input type="datetime-local" name="date" class="form-control form-control-sm"
                                value="{{ $formatTanggal ?? date('Y-m-d H:i') }}"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 text-center">Diriview</div>
                        <div class="col-4"></div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-4 text-center">Dokter IGD</div>
                        <div class="col-4"></div>
                        <div class="col-4 text-center">Perawat Yang Melakukan Pengkajian</div>
                    </div>
                    <div class="row mb-2 parent">
                        @php
                            $ttd_dokter = null;
                            $ttd_perawat = null;
                            $nama_dokter = null;
                            $nama_perawat = null;
                            if ($item->igdAseKepPatient) {
                                $ttd_dokter = $item->igdAseKepPatient->ttdDokter ?? '';
                                $ttd_perawat = $item->igdAseKepPatient->ttdPerawat ?? '';
                                $nama_dokter = $item->igdAseKepPatient->nm_dokter ?? '';
                                $nama_perawat = $item->igdAseKepPatient->nm_perawat ?? '';
                            }
                        @endphp
                        <div class="col-4 text-center">
                            <img src="{{ asset('storage/' . $ttd_dokter) }}" alt="" id="ImgTtdDokter">
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
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-center"></div>
                        <div class="col-4 text-center">
                            <img src="{{ asset('storage/' . $ttd_perawat) }}" alt="" id="ImgTtdPerawat">
                            <textarea id="ttdPerawat" name="ttd_perawat" style="display: none;">{{ $ttd_perawat }}</textarea>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="col-12 btn btn-sm btn-dark"
                                            onclick="openModal(this, 'ImgTtdPerawat', 'ttdPerawat', 'nm_perawat')">Tanda
                                            Tangan</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="col-12 btn btn-sm btn-secondary"
                                            id="clearImgPerawat">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-4 text-center">
                            <input type="text" class="form-control form-control-sm text-center" name="nm_dokter"
                                id="nm_dokter" value="{{ $nama_dokter }}" placeholder="Nama Lengkap" readonly>
                        </div>
                        <div class="col-4 text-center"></div>
                        <div class="col-4 text-center">
                            <input type="text" class="form-control form-control-sm text-center" name="nm_perawat"
                                id="nm_perawat" value="{{ $nama_perawat }}" placeholder="Nama Lengkap" readonly>
                        </div>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
            </div>
            </form>
            <div class="mb-3">
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
        let tempPetugasName;

        function openModal(element, elementImg, elementTextArea, elementPetugasName) {
            tempElementImage = $(element).closest('.parent').find('#' + elementImg);
            tempTextArea = $(element).closest('.parent').find('#' + elementTextArea);
            tempPetugasName = $('#' + elementPetugasName);
            $('#getTtdModal').modal('show');
        }

        document.addEventListener("DOMContentLoaded", function() {
            // start get ttd from user table
            var modal = document.getElementById("getTtdModal");
            var clearImageDokter = document.getElementById("clearImgDokter");
            var clearImagePerawat = document.getElementById("clearImgPerawat");

            var clearButtonInput = modal.querySelector("[data-action=clearInput]");
            var saveButtonInput = modal.querySelector("[data-action=saveInput]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');

            clearImageDokter.addEventListener('click', function(e) {
                var img = document.getElementById("ImgTtdDokter");
                var source = document.getElementById("ttdDokter");
                var name = document.getElementById("nm_dokter");
                img.setAttribute('src', '');
                source.value = '';
                name.value = '';
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
    </script>
@endsection
