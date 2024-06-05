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
                    <h5 class="mb-0 m-0">Asesmen Perawat <span
                            class="fs-4 fw-bold text-primary">{{ $item->patient->name ?? '' }}</span></h5>
                </div>
                <div class="col-3 m-0 text-end">
                    <a href="{{ route('rajal/show', ['id' => $item->id, 'title' => 'Rawat Jalan']) }}"
                        class="btn btn-success btn-sm">Kembali</a>
                </div>
            </div>
            <div class="row m-auto mt-2">
                <a href="{{ route('rajal/asesmen/status/fisik.index', $item->id) }}"
                    class="btn {{ Route::is('rajal/asesmen/status/fisik.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Status
                    Fisik</a>
                <a href="{{ route('rajal/asesmen/skrining/resiko/jatuh.index', $item->id) }}"
                    class="btn {{ Route::is('rajal/asesmen/skrining/resiko/jatuh.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Skrining
                    Resiko Jatuh</a>
                <a href="{{ route('rajal/asesmen/diagnosis/keperawatan.index', $item->id) }}"
                    class="btn {{ Route::is('rajal/asesmen/diagnosis/keperawatan.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Diagnosis
                    Keperawatan</a>
                <a href="{{ route('rajal/asesmen/rencana/asuhan.index', $item->id) }}"
                    class="btn {{ Route::is('rajal/asesmen/rencana/asuhan.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Rencana
                    Asuhan</a>
            </div>
        </div>

        <div class="card-body">
            <h6 class="text-center bg-dark text-white py-2">RENCANA ASUHAN</h6>
            <div class="row mb-3">
                <form action="{{ route('rajal/asesmen/rencana/asuhan.store', $item->id) }}" method="POST">
                    @csrf
                    <div class="col-sm-4 ">
                        <div class="mx-2">
                            {{-- @foreach ($rencanaAsuhan as $asuhan)
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
                            @endforeach --}}

                            @php
                            // Definisikan rencana asuhan yang tersedia
                            $rencanaAsuhan = [
                                'Reduksi Ansietas',
                                'Manajemen Nyeri',
                                'Dukungan Mobilitas',
                                'Perawatan Luka',
                                'Perawatan Retensi Urine',
                                'Perawatan Kateter Urine',
                            ];
                        @endphp
                        
                        @foreach ($rencanaAsuhan as $asuhan)
                            @php
                                $checked = in_array($asuhan, $selectedAsuhan) ? 'checked' : '';
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input" type="hidden" value="{{ $asuhan }}" name="rencana-asuhan[]" id="defaultCheck1" />
                                <input class="form-check-input" type="checkbox" value="{{ $asuhan }}" name="asuhan[]" id="{{ $asuhan }}" {{ $checked }} />
                                <label class="form-check-label" for="{{ $asuhan }}">
                                    {{ $asuhan }}
                                </label>
                            </div>
                        @endforeach
                        
                        

                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-4 text-center mt-5">
                            <p class="mb-0">Direview</p>
                            Dokter Penanggung Jawab Pelayanan
                        </div>
                        <div class="col-4"></div>
                        <div class="col-4 text-center pt-3 mt-1">
                            <span>Padang, </span>

                            {{-- <input type="date" name="date" class="form-control form-control-sm"
                                        value="{{ \Carbon\Carbon::parse($asesmentKeperawatanRencanaAsuhan->tanggal ?? \Carbon\Carbon::now())->format('Y-m-d') }}"> --}}
                            {{ \Carbon\Carbon::parse($asesmentKeperawatanRencanaAsuhan->tanggal ?? \Carbon\Carbon::now())->format('Y-m-d') }}
                            <input type="hidden" name="date"
                                value="{{ \Carbon\Carbon::parse($asesmentKeperawatanRencanaAsuhan->tanggal ?? \Carbon\Carbon::now())->format('Y-m-d') }}">

                            {{-- <div class="ms-2"><input type="time" name="time" class="form-control form-control-sm"
                                        value="{{ \Carbon\Carbon::parse($asesmentKeperawatanRencanaAsuhan->tanggal ?? \Carbon\Carbon::now())->format('H:i') }}">
                                </div> --}}
                            <input type="hidden" name="time"
                                value="{{ \Carbon\Carbon::parse($asesmentKeperawatanRencanaAsuhan->tanggal ?? \Carbon\Carbon::now())->format('H:i') }}">

                            {{ \Carbon\Carbon::parse($asesmentKeperawatanRencanaAsuhan->tanggal ?? \Carbon\Carbon::now())->format('H:i') }}
                            WIB <br> <br>
                            <span class="">Perawat yang Melakukan Pengkajian</span>
                        </div>
                    </div>
                    <div class="row mb-2 parent">
                        @php
                            $ttd_DPJP = null;
                            $ttdPPJA = null;
                            $nama_dpjp = null;
                            $nama_ppja = null;

                            if ($asesmentKeperawatanRencanaAsuhan && $asesmentKeperawatanRencanaAsuhan->item) {
                                $ttd_DPJP = $asesmentKeperawatanRencanaAsuhan->item->ttddpjp ?? '';
                                $ttdPPJA = $asesmentKeperawatanRencanaAsuhan->item->ttdppja ?? '';
                                $nama_dpjp = $asesmentKeperawatanRencanaAsuhan->item->namadpjp ?? '';
                                $nama_ppja = $asesmentKeperawatanRencanaAsuhan->item->namappja ?? '';
                            }
                        @endphp

                        <div class="col-4 text-center">

                            <img src="{{ Storage::url($asesmentKeperawatanRencanaAsuhan->ttddpjp ?? '') }}" alt=""
                                id="ImgTtdDPJP" style="max-width: 200px">

                            <textarea id="ttdDPJP" name="ttddpjp" style="display: none;">
                                {{ $asesmentKeperawatanRencanaAsuhan->ttddpjp ?? '' }}
                            </textarea>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="col-12 btn btn-sm btn-dark"
                                            onclick="openModal(this, 'ImgTtdDPJP', 'ttdDPJP', 'namadpjp')">Tanda
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

                            <img src="{{ Storage::url($asesmentKeperawatanRencanaAsuhan->ttdppja ?? '') }}" alt=""
                                id="ImgTtdPPJA" style="max-width: 200px">

                            <textarea id="ttdPPJA" name="ttdppja" style="display: none;">{{ $asesmentKeperawatanRencanaAsuhan->ttdppja ?? '' }}</textarea>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="col-12 btn btn-sm btn-dark"
                                            onclick="openModal(this, 'ImgTtdPPJA', 'ttdPPJA', 'namappja')">Tanda
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
                            <input type="text" class="form-control form-control-sm text-center" name="namadpjp"
                                id="namadpjp" value="{{ $asesmentKeperawatanRencanaAsuhan->namadpjp ?? '' }}"
                                placeholder="Nama Lengkap" readonly>
                        </div>
                        <div class="col-4 text-center"></div>
                        <div class="col-4 text-center">
                            <input type="text" class="form-control form-control-sm text-center" name="namappja"
                                id="namappja" value="{{ $asesmentKeperawatanRencanaAsuhan->namappja ?? '' }}"
                                placeholder="Nama Lengkap" readonly>
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
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
                var img = document.getElementById("ImgTtdDPJP");
                var source = document.getElementById("ttdDPJP");
                var name = document.getElementById("namadpjp");
                img.setAttribute('src', '');
                source.value = '';
                name.value = '';
            });
            clearImagePerawat.addEventListener('click', function(e) {
                var img = document.getElementById("ImgTtdPPJA");
                var source = document.getElementById("ttdPPJA");
                var name = document.getElementById("namappja");
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
