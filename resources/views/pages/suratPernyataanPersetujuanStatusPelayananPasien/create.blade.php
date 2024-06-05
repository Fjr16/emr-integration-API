@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="mb-5 border alert alert-success w-100 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="mb-4 card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Surat Pernyataan Persetujuan Status Pelayanan Pasien
            </h5>
        </div>
        <form action="{{ route('surat/pernyataan/persetujuan/status/pelayanan.store', $item->id) }}" method="POST"
            onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="mb-3 col">
                    <p>Saya yang bertanda tangan di bawah ini
                        :</p>
                    <div class="mb-3 ms-5 row">
                        <label for="nmDkr" class="col-form-label col-2">Nama
                        </label>
                        <input class="ml-1 form-control form-control-sm col" type="text" name="name" value="" />
                    </div>
                    <div class="mb-3 ms-5 row">
                        <label for="umurDkr" class="col-form-label col-2">Umur
                        </label>
                        <input class="ml-1 form-control form-control-sm col" type="number" name="umur" value="" />
                    </div>
                    <div class="ms-5 row">
                        <label for="almDkr" class="col-form-label col-2">Alamat
                        </label>
                        <input class="ml-1 form-control form-control-sm col" type="text" name="alamat" value="" />
                    </div>
                </div>
                <div class="mb-3 col">
                    <div class="d-flex align-items-center">
                        <label for="adlhPasien" class="p-2 col-form-label align-items-center">Adalah</label>
                        <div class="p-2 w-25">
                            <select name="hubungan" class="form-select form-select-sm" id="">
                                @foreach ($hubs as $hub)
                                    <option value="{{ $hub }}">{{ $hub }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="pihak-rumahsakit" class="col-form-label align-items-center">dari Pasien:</label>
                    </div>

                    <div class="mb-3 ms-5 row">
                        <label for="psnNama" class="col-form-label col-2">Nama
                        </label>
                        <input class="ml-1 form-control form-control-sm col" type="text"
                            value="{{ $item->queue->patient->name }}" disabled />
                    </div>
                    <div class="mb-3 ms-5 row">
                        <label for="psnUmur" class="col-form-label col-2">Umur</label>
                        <input class="ml-1 form-control form-control-sm col" type="number" value="{{ $umur }}"
                            disabled />
                    </div>
                    <div class="mb-3 ms-5 row">
                        <label for="psnAlm" class="col-form-label col-2">Alamat</label>
                        <input class="ml-1 form-control form-control-sm col" type="text"
                            value="{{ $item->queue->patient->alamat }}" disabled />
                    </div>
                    <div class="ms-5 row">
                        <label for="psnAlm" class="col-form-label col-2">Kelas Rawatan</label>
                        <input class="ml-1 form-control form-control-sm col" type="text"
                            value="{{ $item->queue->patientCategory->name }}" disabled />
                    </div>
                </div>
                <div class="mb-3 col">
                    <div class="row">
                        <div class="col-10">
                            <label for="pihak-rumahsakit" class="col-form-label">Menyatakan bahwa: (Ceklis salah
                                satu)</label>
                        </div>
                        <div class="col-2 text-center">
                            <label for="pihak-rumahsakit" class="col-form-label">Paraf</label>
                        </div>
                    </div>
                    <div class="mb-3 row align-items-center">
                        <div class="col-10">
                            <div class="d-flex">
                                <div class="me-3">
                                    <input class="form-check-input" type="radio" name="header" value="KHUSUS PASIEN UMUM"
                                        id="umum" onclick="enableElement(this)" />
                                </div>
                                <div class="col">
                                    <label class="fw-bold text-decoration-underline form-check-label" for="umum">
                                        KHUSUS PASIEN UMUM
                                    </label>
                                    <p>Pasien yang tersebut diatas tidak akan menggunakan jaminan kesehatan / asuransi
                                        apapun. Dan bersedia
                                        dilayani sebagai pasien umum yang akan dikenakan biaya sesuai dengan ketentuan RSK
                                        Bedah Ropanasuri.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <img src="" alt="" id="ImgParafKeluargaPasien">
                            <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                            <button type="button" class="col-12 btn btn-sm btn-dark" id="btnUmum" disabled
                                onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                        </div>
                    </div>
                    <div class="mb-4 col align-items-center">
                        <div class="row">
                            <div class="col-10">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <input name="header" class="form-check-input" type="radio"
                                            value="KHUSUS PASIEN BPJS" id="bpjs" onclick="enableElement(this)" />
                                    </div>
                                    <div class="col">
                                        <div class="">

                                            <label class="fw-bold text-decoration-underline form-check-label"
                                                for="bpjs">
                                                KHUSUS PASIEN BPJS
                                            </label>
                                            <p>Akan menggunakan Jaminan Kesehatan Nasional / JKN (BPJS) dan akan menyerahkan
                                                kelengkapan
                                                administrasi sampai batas waktu yang ditentukan / sebelum pasien pulang.
                                                Jika
                                                tidak
                                                dapat melengkapi
                                                administrasi sampai batas waktu yang ditentukan, saya bersedia membayar
                                                biaya
                                                pelayanan sesuai tarif
                                                umum RSK Bedah Ropanasuri.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <img src="" alt="" id="ImgParafKeluargaPasien">
                                <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                <button type="button" class="col-12 btn btn-sm btn-dark" id="btnBpjs" disabled
                                    onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                            </div>
                        </div>

                        <div class="ms-5">
                            <p>Kelengkapan Administrasi </p>
                            <div class="row">
                                <div class="col-6 ms-4">
                                    <div class="mb-3 col-9">
                                        <div class="row align-items-center">
                                            <label class="col-form-label col-1" for="klngAdm1">1.</label>
                                            <input class="form-control form-control-sm col" type="text"
                                                value="KTP / KK" name="kelAdm[]" id="klngAdm1" disabled />
                                        </div>
                                    </div>
                                    <div class="mb-3 col-9">
                                        <div class="row align-items-center">
                                            <label class="col-form-label col-1" for="klngAdm2">2.</label>
                                            <input class="form-control form-control-sm col" type="text"
                                                value="Kartu BPJS" name="kelAdm[]" id="klngAdm2" disabled />
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="row align-items-center">
                                            <label class="col-form-label col-1" for="klngAdm3">3.</label>
                                            <input class="form-control form-control-sm col" type="text" value=""
                                                name="kelAdm[]" id="klngAdm3" disabled />

                                            <div class="col-auto">
                                                <button type="button" class="btn btn-sm btn-dark" disabled
                                                    id="tambah">
                                                    <i class="bi bi-plus"></i> lainnya
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-2 form-check col">
                                        <input class="form-check-input" type="radio" value="1" name="statusAdm"
                                            id="klngAdmYa" disabled />
                                        <label class="form-check-label" for="klngAdmYa">
                                            Lengkap
                                        </label>
                                    </div>
                                    <div class="mb-2 form-check col">
                                        <input name="statusAdm" class="form-check-input" type="radio" value="0"
                                            id="klngAdmTidak" disabled />
                                        <label class="form-check-label" for="klngAdmTidak">
                                            Belum Lengkap
                                        </label>
                                    </div>
                                    <div class="col">
                                        <p>(Batas melengkapi: X 24 jam/Sebelum pulang)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 col">
                        <div class="mb-3 row align-items-center">
                            <div class="col-10">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <input name="header" class="form-check-input" type="radio"
                                            value="KHUSUS PASIEN JAMINAN KESEHATAN LAIN / ASURANSI LAIN / PERUSAHAAN"
                                            id="asuransi" onclick="enableElement(this)" />
                                    </div>
                                    <div class="col">
                                        <label class="fw-bold text-decoration-underline form-check-label" for="asuransi">
                                            KHUSUS PASIEN JAMINAN KESEHATAN LAIN / ASURANSI LAIN / PERUSAHAAN
                                        </label>
                                        <div>
                                            <p class="m-0 mb-3 d-flex">
                                                <span>
                                                    Akan menggunakan jaminan Kesehatan Lain / Asuransi lain /
                                                    Perusahaan yaitu :
                                                </span>
                                                <input style="max-width: 150px;" type="text"
                                                    class="mx-3 form-control form-control-sm" name="jaminan"
                                                    id="jaminan" disabled>
                                                <span>dan bersedia mengikuti</span>
                                            </p>
                                            <p class="m-0">
                                                aturan yang berlaku sesuai dengan
                                                kontrak kerjasama dengan pihak RSK Bedah Ropanasuri
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <img src="" alt="" id="ImgParafKeluargaPasien">
                                <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                <button type="button" class="col-12 btn btn-sm btn-dark" id="btnJaminan" disabled
                                    onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 col">
                        <div class="mb-3 row align-items-center">
                            <div class="col-10">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <input name="header" class="form-check-input" type="radio"
                                            value="KHUSUS PASIEN NAIK KELAS RAWATAN" id="rawatan"
                                            onclick="enableElement(this)" />
                                    </div>
                                    <div class="col">
                                        <label class="fw-bold text-decoration-underline form-check-label" for="rawatan">
                                            KHUSUS PASIEN NAIK KELAS RAWATAN
                                        </label>
                                        <p class="m-0 d-flex">Saya meminta pihak rumah sakit untuk dipindahkan kelas
                                            rawatan
                                            dari ( kelas : <input type="text" class="mx-1 form-control form-control-sm"
                                                name="dariKelas" id="dariKelas" disabled style="max-width: 100px"> )

                                            <span>ke ( kelas :</span>
                                            <input type="text" class="mx-1 form-control form-control-sm "
                                                name="keKelas" id="keKelas" disabled style="max-width: 150px;"> )
                                        </p>

                                        <span>
                                            Dan
                                            bersedia
                                            menanggung segala biaya yang diakibatkan oleh perpindahan kelas tersebut
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <img src="" alt="" id="ImgParafKeluargaPasien">
                                <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                <button type="button" class="col-12 btn btn-sm btn-dark" id="btnKelas" disabled
                                    onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 col align-items-center">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <input name="header" class="form-check-input" type="radio"
                                            value="KHUSUS PASIEN KECELAKAAN LALU LINTAS (JASA RAHARJA)" id="jasa_raharja"
                                            onclick="enableElement(this)" />
                                    </div>
                                    <div class="col">
                                        <label class="fw-bold text-decoration-underline form-check-label"
                                            for="jasa_raharja">
                                            KHUSUS PASIEN KECELAKAAN LALU LINTAS (JASA RAHARJA)
                                        </label>
                                        <p>Setelah mendapat informasi yang cukup mengenai peraturan
                                            pelayanan pasien
                                            kecelakaan lalu lintas, maka saya menyatakan bahwa :</p>
                                        <p class="px-3">Akan mengurus Jasa Raharja dan bersedia melengkapi semua
                                            kelengkapaan
                                            klaim (BAP / Berita Acara Pemeriksaan Kepolisian) selama dalam perawatan
                                            dan bersedia memberikan kuasa terhadap rumah sakit untuk mengklaim ke
                                            pigak Jasa Raharja. <br>
                                            jika saya tidak melengkapi, maka bersedia dilayani sebgai pasien umum.
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <img src="" alt="" id="ImgParafKeluargaPasien">
                                <textarea id="paraf" name="paraf[]" style="display: none;"></textarea>
                                <button type="button" class="col-12 btn btn-sm btn-dark" id="btnAnsuransi" disabled
                                    onclick="openModalTtdBottom(this, 'ImgParafKeluargaPasien', 'paraf')">Paraf</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-2">
                            <p class="fw-bold text-decoration-underline">
                                CATATAN KHUSUS
                            </p>
                        </div>
                        <div class="col-10">
                            <textarea class="form-control" id="editor" rows="4" name="ctt_khusus"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-10">

                        </div>
                    </div>
                    <div class="mb-3 col">
                        <div class="px-4">
                            Demikianlah pernyataan ini saya buat dengan penuh kesadaran dan telah mendapatkan informasi yang
                            selengkap-lengkapnya.
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4 text-center">
                            <img src="" alt="" id="ImgTtdKeluargaPasien">
                            <textarea id="ttd" name="ttd" style="display: none;"></textarea>
                            <button type="button" class="col-12 btn btn-sm btn-dark"
                                onclick="openModalTtdBottom(this, 'ImgTtdKeluargaPasien', 'ttd')">Tanda
                                Tangan Keluarga Pasien</button>
                        </div>
                    </div>

                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
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
            tempElementImage = $(element).closest('#row-ttd-pasien').find('#parafImage' + iteration);
            tempTextArea = $(element).closest('#row-ttd-pasien').find('#paraf' + iteration);
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
        function enableElement(element) {

            var allParaf = document.querySelectorAll('.paraf');
            allParaf.forEach(function(item) {
                item.disabled = true;
            });


            var paraf = $(element).closest('.row').find('.paraf');
            paraf.prop('disabled', false);


            var adm1 = document.getElementById('klngAdm1');
            var adm2 = document.getElementById('klngAdm2');
            var adm3 = document.getElementById('klngAdm3');
            var admYa = document.getElementById('klngAdmYa');
            var admNo = document.getElementById('klngAdmTidak');
            var jaminan = document.getElementById('jaminan');
            var dari = document.getElementById('dariKelas');
            var ke = document.getElementById('keKelas');
            var btnUmum = document.getElementById('btnUmum');
            var btnBpjs = document.getElementById('btnBpjs');
            var btnJaminan = document.getElementById('btnJaminan');
            var btnKelas = document.getElementById('btnKelas');
            var btnAnsuransi = document.getElementById('btnAnsuransi');
            var btnTambah = document.getElementById('tambah');


            if (element.value == 'KHUSUS PASIEN UMUM') {
                adm1.disabled = true;
                adm2.disabled = true;
                adm3.disabled = true;
                admYa.disabled = true;
                admNo.disabled = true;
                jaminan.disabled = true;
                dari.disabled = true;
                ke.disabled = true;

                btnUmum.disabled = false;
                btnBpjs.disabled = true;
                btnJaminan.disabled = true;
                btnKelas.disabled = true;
                btnAnsuransi.disabled = true;

                paraf.value = '';
            } else if (element.value == 'KHUSUS PASIEN BPJS') {
                adm1.disabled = false;
                adm2.disabled = false;
                adm1.readOnly = true;
                adm2.readOnly = true;
                adm3.disabled = false;
                btnTambah.disabled = false;
                admYa.disabled = false;
                admNo.disabled = false;


                jaminan.disabled = true;

                dari.disabled = true;
                ke.disabled = true;

                btnUmum.disabled = true;
                btnBpjs.disabled = false;
                btnJaminan.disabled = true;
                btnKelas.disabled = true;
                btnAnsuransi.disabled = true;

                paraf.value = '';
            } else if (element.value == 'KHUSUS PASIEN JAMINAN KESEHATAN LAIN / ASURANSI LAIN / PERUSAHAAN') {
                jaminan.disabled = false;

                adm1.disabled = true;
                adm2.disabled = true;
                adm3.disabled = true;
                admYa.disabled = true;
                admNo.disabled = true;

                dari.disabled = true;
                ke.disabled = true;

                btnUmum.disabled = true;
                btnBpjs.disabled = true;
                btnJaminan.disabled = false;
                btnKelas.disabled = true;
                btnAnsuransi.disabled = true;

                paraf.value = '';
            } else if (element.value == 'KHUSUS PASIEN NAIK KELAS RAWATAN') {
                dari.disabled = false;
                ke.disabled = false;

                adm1.disabled = true;
                adm2.disabled = true;
                adm3.disabled = true;
                admYa.disabled = true;
                admNo.disabled = true;

                jaminan.disabled = true;

                btnUmum.disabled = true;
                btnBpjs.disabled = true;
                btnJaminan.disabled = true;
                btnKelas.disabled = false;
                btnAnsuransi.disabled = true;

                paraf.value = '';
            } else {
                adm1.disabled = true;
                adm2.disabled = true;
                adm3.disabled = true;
                admYa.disabled = true;
                admNo.disabled = true;
                jaminan.disabled = true;
                dari.disabled = true;
                ke.disabled = true;

                btnUmum.disabled = true;
                btnBpjs.disabled = true;
                btnJaminan.disabled = true;
                btnKelas.disabled = true;
                btnAnsuransi.disabled = false;
            }
        }
    </script>

    <script>
        // tambah kelengkapan administrasi
        function tambah() {
            // Cek apakah elemen dengan ID "klngAdm3" ada
            var kelAdm3 = document.getElementById("klngAdm3");
            if (kelAdm3) {
                var inputGroup = document.createElement("div");
                inputGroup.className = "input-group mb-2";

                var input = document.createElement("input");
                input.type = "text";
                input.name = "kelAdm[]";
                input.className = "form-control form-control-sm col";

                var inputGroupAddon = document.createElement("div");
                inputGroupAddon.className = "input-group-addon";

                var button = document.createElement("button");
                button.type = "button";
                button.className = "btn btn-danger btn-remove";
                button.innerText = "Hapus";

                // Attach a click event to the remove button to remove the input group.
                button.addEventListener("click", function() {
                    inputGroup.remove();
                });

                inputGroupAddon.appendChild(button);
                inputGroup.appendChild(input);
                inputGroup.appendChild(inputGroupAddon);

                document.getElementById("klngAdm3").parentNode.appendChild(inputGroup);
            }
        }

        // Attach the click event handler to the "Tambah" button.
        document.getElementById("tambah").addEventListener("click", tambah);
    </script>
@endsection
