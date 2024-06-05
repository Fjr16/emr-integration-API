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
                PERSETUJUAN TINDAKAN ANESTESI {{$item->patient->name}}
            </h4>
            {{-- <div class="ms-auto">
                <a href="{{ route('farmasi/obat/konversi.create') }}" class="btn btn-success btn-sm m-0">+ Tambah Konversi</a>
                <a href="{{ route('farmasi/obat/master/konversi.create') }}" class="btn btn-success btn-sm m-0 mx-2">+ Tambah
                    Satuan</a>
            </div> --}}
        </div>
        <hr class="m-0 mt-2 mb-3">
        <form action="{{ route('pemberian/informasi/persetujuan/tindakan/anestesi.update', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h5 class="m-0 mb-1">Dokter Pelaksana Tindakan</h5>
                    </div>
                    <div class="col-8">
                        <select class="form-control form-control-sm select2" name="user_id" id="">
                            @foreach ($dokters as $dokter)
                            <option value="{{ $dokter->id }}">{{ $dokter->name }} / {{ $dokter->roomDetail->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-4">
                        <h5 class="m-0 mb-1">Pemberi Informasi
                        </h5>
                    </div>
                    <div class="col-8">
                        <input class="form-control form-control-md" type="text" value="{{ Auth::user()->name ?? '' }}" name="petugas" readonly/>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-4">
                        <h5 class="m-0 mb-1">Penerima Informasi / Pemberi Persetujuan*
                        </h5>
                    </div>
                    <div class="col-8">
                        <div class="col">
                            <div class="form-check form-check-inline mt-3 ">
                                @if ($item->name == $item->patient->name)
                                    <input class="form-check-input" type="radio" name="name" id="isPasien" value="{{ $item->name }}" onclick="TruePasien()" checked/>
                                    <label class="form-check-label" for="isPasien">Pasien</label>
                                @else
                                    <input class="form-check-input" type="radio" name="name" id="isPasien" value="" onclick="TruePasien()"/>
                                    <label class="form-check-label" for="isPasien">Pasien</label>
                                @endif
                            </div>
                            <div class="form-check form-check-inline mt-3 ">
                                @if ($item->name != $item->patient->name)
                                    <input class="form-check-input" type="radio" id="radio_notPasien" name="name" onclick="notPasien()" checked/>
                                    <input type="text" class="form-control form-control-sm" id="input_notPasien" value="{{$item->name}}" disabled onchange="tfValueNotPasien(this.value)">
                                @else
                                    <input class="form-check-input" type="radio" id="radio_notPasien" name="name" onclick="notPasien()"/>
                                    <input type="text" class="form-control form-control-sm" id="input_notPasien" value="" disabled onchange="tfValueNotPasien(this.value)">
                                @endif
                            </div>
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


                            @foreach ($item->ranapDetailPersetujuanTindakanAnestesiPatient as $jenis)
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
                                            onclick="openModal(this, {{ $loop->iteration }})">Paraf</button>
                                        <textarea id="ttd{{ $loop->iteration }}" name="ttd[]" value="" style="display: none;">{{ $jenis->ttd }}</textarea>
                                    </td>
                                </tr>
                                @php
                                    $ttd = $loop->iteration;
                                @endphp
                            @endforeach
                            <tr>
                                @php
                                    $parameter = $ttd++;
                                @endphp
                                <td>
                                    <button type="button" class="btn btn-sm btn-dark" onclick="tambahInputJenis(this)"><i
                                            class="bx bx-plus"></i></button>
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
                                        onclick="openModal(this, {{ $parameter }})">Paraf</button>
                                    <textarea id="ttd{{ $parameter }}" name="ttd[]" style="display: none;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p>Dengan ini menyatakan bahwa saya telah menerangkan hal-hal di atas secara Tanda
                                        Tangan
                                        benar dan jelas dan memberikan kesempatan untuk bertanya dan/atau berdiskusi</p>
                                </td>
                                <td class="text-center">
                                    <img src="{{Storage::url($item->ttdKet1)}}" alt="" id="imgTtdKet1">
                                    <textarea id="ttdKet1" name="ttdKet1" style="display: none;"></textarea>
                                    <button type="button" class="col-12 btn btn-sm btn-dark"
                                        onclick="openModalTtdBottom(this, 'imgTtdKet1', 'ttdKet1')">Tanda Tangan Petugas</button>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <p>Dengan ini menyatakan bahwa saya telah menerima informasi sebagaimana Tanda Tangan
                                        di atas yang saya beri tanda/paraf di kolom kanannya, dan telah memahaminya </p>
                                </td>
                                <td class="text-center">
                                    <img src="{{Storage::url($item->ttdKet2)}}" alt="" id="imgTtdKet2">
                                    <textarea id="ttdKet2" name="ttdKet2" style="display: none;"></textarea>
                                    <button type="button" class="col-12 btn btn-sm btn-dark"
                                        onclick="openModalTtdBottom(this, 'imgTtdKet2', 'ttdKet2')">Tanda Tangan Penerima</button>
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
                                <input class="m-0 form-control form-control-sm " type="text" name="name" value="{{$item->name}}"/>
                            </span>
                            <p class="col-auto">, umur</p>
                            <span class="col-1">
                                <input class=" m-0 form-control form-control-sm " type="text" name="umur" value="{{$item->umur}}"/>
                            </span>
                            <p class="col-1">tahun,</p>
                        </div>
                        <div class="row">
                            <div class="d-flex col-3">
                                <select name="jenis_kelamin" id="" class="form-control form-control-sm">
                                    @foreach ($jks as $jk)
                                    <option value="{{ $jk }}" {{$item->jenis_kelamin == $jk ? 'selected' : ''}}>{{ $jk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="col-1">alamat,</span>
                            <div class="col-8 ">
                                <input type="text" class="form-control form-control-sm" name="alamat" value="{{$item->alamat}}">
                            </div>
                        </div>
                    </div>
                    <p class="my-2">dengan ini menyatakan persetujuan untuk dilakukannya tindakan anestesi : (centang
                        (√) salah satu)
                    </p>

                    <div class="row text-center">
                        <div class="col-6 row">
                            @foreach ($jenisAnestesis as $jenisAnestesi)
                            <div class="col">
                                <div class="form-check form-check-inline mt-3 ">
                                    <input class="form-check-input" type="radio" id="{{ $jenisAnestesi }}" value="{{ $jenisAnestesi }}" name="jenis_anestesi" onclick="disableInput()" {{ $item->jenis_anestesi == $jenisAnestesi ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="{{ $jenisAnestesi }}">{{ $jenisAnestesi }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if ($item->jenis_anestesi != 'Lokal' && $item->jenis_anestesi != 'Umum' && $item->jenis_anestesi != 'Spinal')
                            @if ($item->jenis_anestesi != 'Umum')
                                @if ($item->jenis_anestesi != 'Spinal')
                                    <div class="col">
                                        <div class="form-check form-check-inline mt-3 ">
                                            <input class="form-check-input" type="radio" id="jenis_anestesi_lain" name="jenis_anestesi" value="" onclick="enableInput()" checked/>
                                            <input type="text" class="form-control form-control-sm" id="input_jenis_anestesi" value="{{$item->jenis_anestesi}}" disabled onchange="transferValue(this.value)">
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="col">
                                <div class="form-check form-check-inline mt-3 ">
                                    <input class="form-check-input" type="radio" id="jenis_anestesi_lain" name="jenis_anestesi" value="" onclick="enableInput()"/>
                                    <input type="text" class="form-control form-control-sm" id="input_jenis_anestesi" disabled onchange="transferValue(this.value)">
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row w-100 mt-4">
                        <p class="col">
                            <label class="form-check-label mx-3">terhadap</label>
                            @if ($item->hubungan == 'saya')
                                <input class="form-check-input" type="radio" id="saya" value="saya" name="hubungan" onclick="disableHubungan()" checked/>
                                <label class="form-check-label" for="saya"> saya</label>
                            @else
                                <input class="form-check-input" type="radio" id="saya" value="saya" name="hubungan" onclick="disableHubungan()"/>
                                <label class="form-check-label" for="saya"> saya</label>
                            @endif
                        </p>
                        <p class="col d-flex">
                            <label class="form-check-label mx-4">/</label>
                            @if ($item->hubungan != 'saya')
                                <input class="form-check-input col-2 mx-1" type="radio" id="radio_hubungan" name="hubungan" value="" onclick="enableHubungan()" checked/>
                                <input type="text" class="form-control form-control-sm" id="input_hubungan" value="{{$item->hubungan}}" disabled onchange="transferValueHubungan(this.value)">
                            @else
                                <input class="form-check-input col-2 mx-1" type="radio" id="radio_hubungan" name="hubungan" value="" onclick="enableHubungan()"/>
                                <input type="text" class="form-control form-control-sm" id="input_hubungan" disabled onchange="transferValueHubungan(this.value)">
                            @endif
                        </p>
                        <p class="col">. saya bernama</p>
                        <span class="col">
                            <input class=" m-0 form-control form-control-sm " type="text" value="{{ $item->patient->name }}" disabled/>
                        </span>
                        <p class="col">umur,</p>
                        <span class="col">
                            <input class=" m-0 form-control form-control-sm " type="text" value="{{ $umur }}" disabled/>
                        </span>
                        <p class="col">tahun</p>
                    </div>

                </div>

                <div class="row">
                    <div class="d-flex col-3">
                        <input class=" m-0 form-control form-control-sm " type="text" value="{{ $item->patient->jenis_kelamin }}" disabled/>
                    </div>
                    <span class="col-1">alamat,</span>
                    <div class="col-8 ">
                        <input type="text" class="form-control form-control-sm" value="{{ $item->patient->alamat }}" disabled>
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
                <div class="row mb-3">
                    <div class="col-7"></div>
                    <div class="col-5">Saksi</div>
                </div>
                <div class="row mb-5">
                    <div class="col-4">Yang, Menyatakan*,</div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-3">
                                Hubungan:
                            </div>
                            <div class="col-7">
                                <input type="text" name="hub1" value="{{$item->hub1}}" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-3">
                                Hubungan:
                            </div>
                            <div class="col-7">
                                <input type="text" name="hub2" value="{{$item->hub2}}" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-4 text-center">
                        <img src="{{Storage::url($item->ttdPenerimaInformasi)}}" alt="" id="ImgTtdPenerimaInformasi">
                        <textarea id="ttdPenerimaInformasi" name="ttdPenerimaInformasi" style="display: none;"></textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModalTtdBottom(this, 'ImgTtdPenerimaInformasi', 'ttdPenerimaInformasi')">Tanda
                            Tangan</button>
                    </div>
                    <div class="col-4 text-center">
                        <img src="{{Storage::url($item->ttdHub1)}}" alt="" id="ImgTtdHub1">
                        <textarea id="ttdHub1" name="ttdHub1" style="display: none;"></textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModalTtdBottom(this, 'ImgTtdHub1', 'ttdHub1')">Tanda Tangan</button>
                    </div>
                    <div class="col-4 text-center">
                        <img src="{{Storage::url($item->ttdHub2)}}" alt="" id="ImgTtdHub2">
                        <textarea id="ttdHub2" name="ttdHub2" style="display: none;"></textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModalTtdBottom(this, 'ImgTtdHub2', 'ttdHub2')">Tanda
                            Tangan</button>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm" name="namaPenerimaInformasi"
                            placeholder="Nama Lengkap" value="{{$item->name}}" id="namaPenerimaInformasi" @readonly(true)>
                    </div>
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm" name="namaHub1" value="{{$item->namaHub1}}"
                            placeholder="Nama Lengkap">
                    </div>
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm" name="namaHub2" value="{{$item->namaHub2}}"
                            placeholder="Nama Lengkap">
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

            // Fungsi untuk mengatur ukuran canvas
            // function resizeCanvas() {
            //     var ratio = window.devicePixelRatio || 1;
            //     canvas.width = canvas.offsetWidth * ratio;
            //     canvas.height = canvas.offsetHeight * ratio;
            //     canvas.getContext("2d").scale(ratio, ratio);

            //     // Reinitialize SignaturePad setelah meresize canvas
            //     signaturePad = new SignaturePad(canvas);
            // }

            // resizeCanvas();

            // Initialize SignaturePad
            // agar library signature pad dapat digunakan pada modal
            signaturePad = new SignaturePad(canvas);

            // Event handler untuk tombol clear
            clearButton.addEventListener("click", function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            // Event handler untuk tombol save
            // var ttd = document.getElementById('ttd1');
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


            // Event listener untuk meresize canvas saat window diubah ukurannya
            // window.addEventListener("resize", resizeCanvas);
        });
    </script>

    <script>
        function enableInput(){
            var input = document.getElementById('input_jenis_anestesi');
            input.disabled = false;
        }
        function disableInput(){
            var input = document.getElementById('input_jenis_anestesi');
            input.disabled = true;
            input.value = '';
        }
        function transferValue(value){
            var radio = document.getElementById('jenis_anestesi_lain');
            radio.value = value;
        }

        function TruePasien(){
            var notPasien = document.getElementById('input_notPasien');
            notPasien.value = '';
            notPasien.disabled = true;

            var saya = document.getElementById('saya');
            saya.checked = true;

            //form dinamis
            var formDinamis = document.getElementById('form-dinamis');
            formDinamis.innerHTML = `
                        <div class="row w-100">
                            <p class="col-auto">Yang bertandatangan di bawah ini, saya , nama</p>
                            <span class="col-6">
                                <input class="m-0 form-control form-control-sm " type="text" value="{{ $item->patient->name }}" readonly/>
                            </span>
                            <p class="col-auto">, umur</p>
                            <span class="col-1">
                                <input class=" m-0 form-control form-control-sm " type="text" value="{{ $umur }}" name="umur" readonly/>
                            </span>
                            <p class="col-1">tahun,</p>
                        </div>
                        <div class="row">
                            <div class="d-flex col-3">
                                <input class=" m-0 form-control form-control-sm " type="text" value="{{ $item->patient->jenis_kelamin }}" name="jenis_kelamin" readonly/>
                            </div>
                            <span class="col-1">alamat,</span>
                            <div class="col-8 ">
                                <input type="text" class="form-control form-control-sm" name="alamat" value="{{ $item->patient->alamat }}" readonly>
                            </div>
                        </div>
            `;
        }
        function notPasien(){
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
        function tfValueNotPasien(value){
            var radio = document.getElementById('radio_notPasien');
            radio.value = value;
        }
    </script>
    <script>
        function disableHubungan(){
            var inputHubungan = document.getElementById('input_hubungan');

            inputHubungan.disabled = true;
            inputHubungan.value = '';
        }
        function enableHubungan(){
            var inputHubungan = document.getElementById('input_hubungan');
            inputHubungan.disabled = false;
        }
        function transferValueHubungan(value){
            var radioHubungan = document.getElementById('radio_hubungan');
            radioHubungan.value = value;
        }
    </script>
    <script>
        function tambahInputJenis(element){
            var parent = element.parentNode.parentNode;
            var tr = document.createElement('tr');
            tr.innerHTML = `
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
                        onclick="openModal(this, {{ $parameter }})">Paraf</button>
                    <textarea id="ttd{{ $parameter }}" name="ttd[]" style="display: none;"></textarea>
                </td>
            `;
            parent.insertAdjacentElement('afterend', tr);
        }
        function removeInputJenis(element){
            var parent = element.parentNode.parentNode;
            parent.remove();
        }
    </script>
@endsection
