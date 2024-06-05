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
            <h4 class="align-self-center m-0">EDIT PEMBERIAN INFORMASI DAN
                PERSETUJUAN TINDAKAN BEDAH {{ $item->rawatInapPatient->queue->patient->name }}
            </h4>
            {{-- <div class="ms-auto">
                <a href="{{ route('farmasi/obat/konversi.create') }}" class="btn btn-success btn-sm m-0">+ Tambah Konversi</a>
                <a href="{{ route('farmasi/obat/master/konversi.create') }}" class="btn btn-success btn-sm m-0 mx-2">+ Tambah
                    Satuan</a>
            </div> --}}
        </div>
        <hr class="m-0 mt-2 mb-3">
        <form action="{{ route('persetujuan/tindakan/bedah.update', $item->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h5 class="m-0 mb-1">Dokter Pelaksana Tindakan</h5>
                    </div>
                    <div class="col-8">
                        <input class="form-control form-control-md" type="text" value="{{ $item->user->name ?? '' }}"
                            disabled />
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-4">
                        <h5 class="m-0 mb-1">Pemberi Informasi
                        </h5>
                    </div>
                    <div class="col-8">
                        <input class="form-control form-control-md" type="text" value="{{ $item->user->name ?? '' }}"
                            name="petugas" disabled />
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-4">
                        <h5 class="m-0 mb-1">Penerima Informasi / Pemberi Persetujuan*
                        </h5>
                    </div>
                    <div class="col-8">
                        <div class="col">
                            @if ($item->patient->name == $item->name)
                                <div class="form-check form-check-inline mt-3 ">
                                    <input class="form-check-input" type="radio" name="name" id="isPasien"
                                        value="{{ $item->name }}" checked onclick="TruePasien()" />
                                    <label class="form-check-label" for="isPasien">Pasien</label>
                                </div>
                                <div class="form-check form-check-inline mt-3 ">
                                    <input class="form-check-input" type="radio" id="radio_notPasien" name="name"
                                        onclick="notPasien()" />
                                    <input type="text" class="form-control form-control-sm" id="input_notPasien"
                                        value="" disabled onchange="tfValueNotPasien(this.value)">
                                </div>
                            @else
                                <div class="form-check form-check-inline mt-3 ">
                                    <input class="form-check-input" type="radio" name="name" id="isPasien"
                                        value="{{ $item->patient->name }}" onclick="TruePasien()" />
                                    <label class="form-check-label" for="isPasien">Pasien</label>
                                </div>
                                <div class="form-check form-check-inline mt-3 ">
                                    <input class="form-check-input" type="radio" id="radio_notPasien" checked
                                        name="name" onclick="notPasien()" />
                                    <input type="text" class="form-control form-control-sm" id="input_notPasien"
                                        value="{{ $item->name }}" onchange="tfValueNotPasien(this.value)">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <div class="row">
                        <table class=" table table-bordered m-0 mt-3 p-0">
                            <tr class="text-center fw-bold">
                                <td>No</td>
                                <td class="w-25">JENIS INFORMASI</td>
                                <td class="w-50">ISI INFORMASI </td>
                                <td> <span>
                                        PARAF PASIEN /
                                        KELUARGA
                                    </span>
                                </td>
                            </tr>


                            @foreach ($item->ranapDetailPersetujuanTindakanBedahPatients as $jenis)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <input type="hidden" name="id[]" value="{{ $jenis->id }}" />
                                    <td class="w-25">
                                        {{ $jenis->jenis }}
                                        <input type="hidden" name="jenis[]" value="{{ $jenis->jenis }}" />
                                    </td>
                                    <td>
                                        <input class="m-0 form-control form-control-sm " type="text" name="isi[]"
                                            value="{{ $jenis->isi }}" />
                                    </td>
                                    <td class="w-50" id="row-ttd-pasien">
                                        <img src="{{ Storage::url($jenis->ttd) }}" alt="" id="ttdImage{{ $loop->iteration }}">
                                        <button type="button" class="col-12 btn btn-sm btn-dark"
                                            onclick="openModal(this, {{ $loop->iteration }})">Tanda Tangan</button>
                                        <textarea id="ttd{{ $loop->iteration }}" name="ttd[]" value="" style="display: none;">{{ $jenis->ttd }}</textarea>
                                    </td>
                                </tr>
                                @php
                                    $ttd = $loop->iteration;
                                @endphp
                            @endforeach
                            {{-- @dd($ttd) --}}
                            <tr>
                                @php
                                    $parameter = $ttd++;
                                @endphp
                                <td>
                                    <button type="button" class="btn btn-sm btn-dark"
                                        onclick="tambahInputJenis(this)"><i class="bx bx-plus"></i></button>
                                </td>
                                <td class="w-25">
                                    <input class="m-0 form-control form-control-sm" type="text" name="jenis[]" />
                                </td>
                                <td>
                                    <input class="m-0 form-control form-control-sm" type="text" name="isi[]" />
                                </td>
                                <td class="w-50" id="row-ttd-pasien">
                                    <img src="" alt="" id="ttdImage{{ $parameter }}">
                                    <button type="button" class="col-12 btn btn-sm btn-dark"
                                        onclick="openModal(this, {{ $parameter }})">Tanda Tangan</button>
                                    <textarea id="ttd{{ $parameter }}" name="ttd[]" value="" style="display: none;">{{ $jenis->ttd }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p>Dengan ini menyatakan bahwa saya telah menerangkan hal-hal di atas secara Tanda
                                        Tangan
                                        benar dan jelas dan memberikan kesempatan untuk bertanya dan/atau berdiskus</p>
                                </td>
                                <td class="text-center">
                                    <img src="{{ Storage::url($item->ttdKet1) }}" alt="" id="imgTtdKet1">
                                    <textarea id="ttdKet1" name="ttdKet1" value="" style="display: none;">{{ $item->ttdKet1 }}</textarea>
                                    <button type="button" class="col-12 btn btn-sm btn-dark"
                                        onclick="openModalTtdBottom(this, 'imgTtdKet1', 'ttdKet1')">Tanda Tangan</button>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <p>Dengan ini menyatakan bahwa saya telah menerima informasi sebagaimana Tanda Tangan
                                        di atas yang saya beri tanda/paraf di kolom kanannya, dan telah memahaminya </p>
                                </td>
                                <td class="text-center">
                                    <img src="{{ Storage::url($item->ttdKet2) }}" alt="" id="imgTtdKet2">
                                    <textarea id="ttdKet2" name="ttdKet2" value="" style="display: none;">{{ $item->ttdKet2 }}</textarea>
                                    <button type="button" class="col-12 btn btn-sm btn-dark"
                                        onclick="openModalTtdBottom(this, 'imgTtdKet2', 'ttdKet2')">Tanda Tangan</button>
                                </td>
                            </tr>
                        </table>
                    </div>


                    <p class="fs-6 mt-1">* Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima
                        informasi adalah wali
                        atau keluarga terdekat</p>
                </div>
                <h3 class="bg-dark py-1 text-white text-center">PERSETUJUAN TINDAKAN ANESTESI
                </h3>
                <div>
                    <div id="form-dinamis">
                        <div class="row w-100">
                            <p class="col-auto">Yang bertandatangan di bawah ini, saya , nama</p>
                            <span class="col-6">
                                <input class="m-0 form-control form-control-sm " type="text" name="name"
                                    value="{{ $item->name }}" />
                            </span>
                            <p class="col-auto">, umur</p>
                            <span class="col-1">
                                <input class=" m-0 form-control form-control-sm " type="text" name="umur"
                                    value="{{ $item->umur }}" />
                            </span>
                            <p class="col-1">tahun,</p>
                        </div>
                        <div class="row">
                            <div class="d-flex col-3">
                                <select name="jenis_kelamin" id="" class="form-control form-control-sm">
                                    <option selected disabled>Pilih</option>
                                    @foreach ($jks as $jk)
                                    @if ($jk == $item->jenis_kelamin)
                                        <option value="{{ $jk }}" selected>{{ $jk }}</option>
                                    @else
                                        <option value="{{ $jk }}">{{ $jk }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <span class="col-1">alamat,</span>
                            <div class="col-8 ">
                                <input type="text" class="form-control form-control-sm" name="alamat"
                                    value="{{ $item->alamat }}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        @if ($item->hubungan == 'saya')
                            <div class="col-6 d-flex">
                                dengan ini menyatakan persetujuan untuk dilakukannya tindakan bedah terhadap
                                <input class="form-check-input mx-1" type="radio" id="saya" value="saya"
                                    name="hubungan" onclick="disableHubungan()" checked />
                                <label class="form-check-label" for="saya">saya</label>
                            </div>
                            <div class="col-6 d-flex">
                                /
                                <input class="form-check-input col-2 mx-1" type="radio" id="radio_hubungan"
                                    value="" onclick="enableHubungan()" />
                                <p class="col d-flex">
                                    <input type="text" class="form-control form-control-sm" id="input_hubungan"
                                        disabled name="hubungan" onchange="transferValueHubungan(this.value)">
                                </p>
                            </div>
                        @else
                            <div class="col-6 d-flex">
                                dengan ini menyatakan persetujuan untuk dilakukannya tindakan bedah terhadap
                                <input class="form-check-input mx-1" type="radio" id="saya" value="saya"
                                    name="hubungan" onclick="disableHubungan()" />
                                <label class="form-check-label" for="saya">saya</label>
                            </div>
                            <div class="col-6 d-flex">
                                /
                                <input class="form-check-input col-2 mx-1" type="radio" id="radio_hubungan"
                                    value="{{ $item->hubungan }}" onclick="enableHubungan()" checked />
                                <p class="col d-flex">
                                    <input type="text" class="form-control form-control-sm" id="input_hubungan"
                                        name="hubungan" value="{{ $item->hubungan }}"
                                        onchange="transferValueHubungan(this.value)">
                                </p>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="row">
                                <div class="col-3">
                                    <label class="form-check-label">saya bernama</label>
                                </div>
                                <div class="col-9">
                                    <input class=" m-0 form-control form-control-sm d-flex" type="text"
                                        value="{{ $item->rawatInapPatient->queue->patient->name }}" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="row">
                                <div class="col-1">
                                    <label class="form-check-label">umur</label>
                                </div>
                                <div class="col-4">
                                    <input class="m-0 form-control form-control-sm " type="text"
                                        value="{{ $umur }}" disabled />
                                </div>
                                <div class="col-2">
                                    tahun,
                                </div>
                                <div class="col-5">
                                    <input class=" m-0 form-control form-control-sm " type="text"
                                        value="{{ $item->rawatInapPatient->queue->patient->jenis_kelamin }}" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <span class="col-1">alamat,</span>
                    <div class="col-11">
                        <input type="text" class="form-control form-control-sm"
                            value="{{ $item->rawatInapPatient->queue->patient->alamat }}" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p>Saya memahami perlunya dan manfaat tindakan tersebut sebagaimana telah dijelaskan seperti di atas
                            kepada saya, termasuk resiko dan komplikasi yang mungkin timbul.
                            Saya juga menyadari bahwa oleh karena ilmu kedokteran bukanlah ilmu pasti,maka keberhasilan
                            tindakan
                            kedokteran bukanlah keniscayaan, melainkan sangat bergantung kepada izin Tuhan Yang Maha Esa.
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-2">Padang, Tanggal</div>
                    @php
                        $tanggal = $item->tanggal;
                        $date = Carbon\Carbon::parse($tanggal)->format('Y-m-d');
                        $time = Carbon\Carbon::parse($tanggal)->format('H:i');
                    @endphp
                    <div class="col-2"><input type="date" name="date" class="form-control form-control-sm"
                            value="{{ $date }}"></div>
                    <div class="col-1">Pukul</div>
                    <div class="col-1"> <input type="time" name="time" class="form-control form-control-sm"
                            value="{{ $time }}"></div>
                </div>
                <div class="row mb-5">
                    <div class="col-4">Yang, Menyatakan*,</div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-3">
                                Hubungan:
                            </div>
                            <div class="col-7">
                                <input type="text" name="hub1" class="form-control form-control-sm"
                                    value="{{ $item->hub1 }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-3">
                                Hubungan:
                            </div>
                            <div class="col-7">
                                <input type="text" name="hub2" class="form-control form-control-sm"
                                    value="{{ $item->hub2 }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-4 text-center">
                        <img src="{{ Storage::url($item->ttdPenerimaInformasi) }}" alt="" id="ImgTtdPenerimaInformasi">
                        <textarea id="ttdPenerimaInformasi" name="ttdPenerimaInformasi" value="" style="display: none;">{{ $item->ttdPenerimaInformasi }}</textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModalTtdBottom(this, 'ImgTtdPenerimaInformasi', 'ttdPenerimaInformasi')">Tanda
                            Tangan</button>
                    </div>
                    <div class="col-4 text-center">
                        <img src="{{ Storage::url($item->ttdHub1) }}" alt="" id="ImgTtdHub1">
                        <textarea id="ttdHub1" name="ttdHub1" value="" style="display: none;">{{ $item->ttdHub1 }}</textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModalTtdBottom(this, 'ImgTtdHub1', 'ttdHub1')">Tanda Tangan</button>
                    </div>
                    <div class="col-4 text-center">
                        <img src="{{ Storage::url($item->ttdHub2) }}" alt="" id="ImgTtdHub2">
                        <textarea id="ttdHub2" name="ttdHub2" value="" style="display: none;">{{ $item->ttdHub2 }}</textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModalTtdBottom(this, 'ImgTtdHub2', 'ttdHub2')">Tanda
                            Tangan</button>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm"
                            value="{{ $item->name }}" placeholder="Nama Lengkap">
                    </div>
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm" name="namaHub1"
                            value="{{ $item->namaHub1 }}" placeholder="Nama Lengkap">
                    </div>
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm" name="namaHub2"
                            value="{{ $item->namaHub2 }}" placeholder="Nama Lengkap">
                    </div>
                </div>
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
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

    <script>
        let tempElementImage;
        let tempTextArea;

        function openModal(element, iteration) {
            tempElementImage = $(element).closest('#row-ttd-pasien').find('#ttdImage' + iteration);
            tempTextArea = $(element).closest('#row-ttd-pasien').find('#ttd' + iteration);
            $('#signaturePadModal').modal('show');
        }

        function openModalTtdBottom(element, elementImg, elementTextArea) {
            console.log(element.closest('td'));
            tempElementImage = $(element).closest('.row').find('#' + elementImg);
            tempTextArea = $(element).closest('.row').find('#' + elementTextArea);
            $('#signaturePadModal').modal('show');
        }

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
                // document.getElementById("signature64").value = signatureData;
                signaturePad.clear();

                //close modal
                $('#signaturePadModal').modal('hide');
            });

            var saya = document.getElementById('saya');
            if (saya.checked) {
                //form dinamis
                var formDinamis = document.getElementById('form-dinamis');
                formDinamis.innerHTML = `
                            <div class="row w-100">
                                <p class="col-auto">Yang bertandatangan di bawah ini, saya , nama</p>
                                <span class="col-6">
                                    <input class="m-0 form-control form-control-sm " type="text" value="{{ $item->rawatInapPatient->queue->patient->name }}" readonly/>
                                </span>
                                <p class="col-auto">, umur</p>
                                <span class="col-1">
                                    <input class=" m-0 form-control form-control-sm " type="text" value="{{ $umur }}" name="umur" readonly/>
                                </span>
                                <p class="col-1">tahun,</p>
                            </div>
                            <div class="row">
                                <div class="d-flex col-3">
                                    <input class=" m-0 form-control form-control-sm " type="text" value="{{ $item->rawatInapPatient->queue->patient->jenis_kelamin }}" name="jenis_kelamin" readonly/>
                                </div>
                                <span class="col-1">alamat,</span>
                                <div class="col-8 ">
                                    <input type="text" class="form-control form-control-sm" name="alamat" value="{{ $item->rawatInapPatient->queue->patient->alamat }}" readonly>
                                </div>
                            </div>
                `;
            }
           
        });
    </script>

    <script>
        function enableInput() {
            var input = document.getElementById('input_jenis_anestesi');
            input.disabled = false;
        }

        function disableInput() {
            var input = document.getElementById('input_jenis_anestesi');
            input.disabled = true;
            input.value = '';
        }

        function transferValue(value) {
            var radio = document.getElementById('jenis_anestesi_lain');
            radio.value = value;
        }

        function TruePasien() {
            var notPasien = document.getElementById('input_notPasien');
            notPasien.value = '';
            notPasien.disabled = true;


            var radioHubungan = document.getElementById('radio_hubungan');
            radioHubungan.checked = false;
            var inputHubungan = document.getElementById('input_hubungan');
            inputHubungan.disabled = true;
            inputHubungan.value = '';


            var saya = document.getElementById('saya');
            saya.checked = true;

            //form dinamis
            var formDinamis = document.getElementById('form-dinamis');
            formDinamis.innerHTML = `
                        <div class="row w-100">
                            <p class="col-auto">Yang bertandatangan di bawah ini, saya , nama</p>
                            <span class="col-6">
                                <input class="m-0 form-control form-control-sm " type="text" value="{{ $item->rawatInapPatient->queue->patient->name }}" readonly/>
                            </span>
                            <p class="col-auto">, umur</p>
                            <span class="col-1">
                                <input class=" m-0 form-control form-control-sm " type="text" value="{{ $umur }}" name="umur" readonly/>
                            </span>
                            <p class="col-1">tahun,</p>
                        </div>
                        <div class="row">
                            <div class="d-flex col-3">
                                <input class=" m-0 form-control form-control-sm " type="text" value="{{ $item->rawatInapPatient->queue->patient->jenis_kelamin }}" name="jenis_kelamin" readonly/>
                            </div>
                            <span class="col-1">alamat,</span>
                            <div class="col-8 ">
                                <input type="text" class="form-control form-control-sm" name="alamat" value="{{ $item->rawatInapPatient->queue->patient->alamat }}" readonly>
                            </div>
                        </div>
            `;
        }

        function notPasien() {
            var notPasien = document.getElementById('input_notPasien');
            notPasien.disabled = false;

            var saya = document.getElementById('saya');
            saya.checked = false;

            //form dinamis
            var formDinamis = document.getElementById('form-dinamis');
            formDinamis.innerHTML = `
                        <div class="row w-100">
                            <p class="col-auto">Yang bertandatangan di bawah ini, saya , nama</p>
                            <span class="col-6">
                                <input class="m-0 form-control form-control-sm " type="text" name="name"/>
                            </span>
                            <p class="col-auto">, umur</p>
                            <span class="col-1">
                                <input class=" m-0 form-control form-control-sm " type="text" name="umur"/>
                            </span>
                            <p class="col-1">tahun,</p>
                        </div>
                        <div class="row">
                            <div class="d-flex col-3">
                                <select name="jenis_kelamin" id="" class="form-control form-control-sm">
                                    @foreach ($jks as $jk)
                                    <option value="{{ $jk }}">{{ $jk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="col-1">alamat,</span>
                            <div class="col-8 ">
                                <input type="text" class="form-control form-control-sm" name="alamat">
                            </div>
                        </div>
            `;
        }

        function tfValueNotPasien(value) {
            var radio = document.getElementById('radio_notPasien');
            radio.value = value;
        }
    </script>
    <script>
        function disableHubungan() {
            var inputHubungan = document.getElementById('input_hubungan');

            inputHubungan.disabled = true;
            inputHubungan.value = '';

            var radioHubungan = document.getElementById('radio_hubungan');
            radioHubungan.checked = false;
        }

        function enableHubungan() {
            var inputHubungan = document.getElementById('input_hubungan');
            inputHubungan.disabled = false;

            var saya = document.getElementById('saya');
            saya.checked = false;
        }

        function transferValueHubungan(value) {
            var radioHubungan = document.getElementById('radio_hubungan');
            radioHubungan.value = value;
        }
    </script>
    <script>
        function tambahInputJenis(element) {
            var parent = element.parentNode.parentNode;
            var tr = document.createElement('tr');
            tr.innerHTML = `
                                @php
                                    $parameter = $ttd++;
                                @endphp
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeInputJenis(this)"><i class="bx bx-minus"></i></button>
                </td>
                <td class="w-25">
                    <input class="m-0 form-control form-control-sm" type="text" name="jenis[]"/>
                </td>
                <td>
                    <input class="m-0 form-control form-control-sm" type="text" name="isi[]"/>
                </td>
                <td class="w-50" id="row-ttd-pasien">
                    <img src="" alt="" id="ttdImage{{ $parameter }}">
                    <button type="button" class="col-12 btn btn-sm btn-dark"
                        onclick="openModal(this, {{ $parameter }})">Tanda Tangan</button>
                    <textarea id="ttd{{ $parameter }}" name="ttd[]" value="" style="display: none;">{{ $jenis->ttd }}</textarea>
                </td>
            `;
            parent.insertAdjacentElement('afterend', tr);
        }

        function removeInputJenis(element) {
            var parent = element.parentNode.parentNode;
            parent.remove();
        }
    </script>
@endsection
