@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">General Consent Pasien 
                <span class="text-primary">{{ $item->queue->patient->name ?? '' }}</span>
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('igd/general/consent.store', $item->id) }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Nama</label>
                            <div class="col-sm-7">
                                <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ $item->queue->patient->name ?? '' }}"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Jenis Kelamin</label>
                            <div class="col-sm-7">
                                <select class="form-control select2" name="kelamin" @required(true)>
                                    @foreach ($kelamin as $sex)
                                    @if ($item->queue->patient->jenis_kelamin == $sex)
                                        <option value="{{ $sex }}" selected>{{ $sex }}</option>
                                    @else
                                        <option value="{{ $sex }}">{{ $sex }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Tanggal Lahir</label>
                            <div class="col-sm-7">
                                <input type="date" name="tgl_lhr" class="form-control" id="basic-default-name" value="{{ $item->queue->patient->tanggal_lhr ?? '' }}"
                                    @required(true)>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Alamat</label>
                            <div class="col-sm-7">
                                <input type="text" name="alamat" class="form-control" id="basic-default-name" value="{{ $item->queue->patient->alamat ?? '' }}"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Telpon</label>
                            <div class="col-sm-7">
                                <input type="number" name="phone" class="form-control" id="basic-default-name" value="{{ $item->queue->patient->telp ?? '' }}"
                                    @required(true)>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-5 col-form-label" for="basic-default-name">Hubungan Dengan Pasien</label>
                            <div class="col-sm-7">
                                <select class="form-control select2" name="hubungan" onchange="hubunganSelect(this)" @required(true)>
                                    @foreach ($status as $stat)
                                    @if ($stat == 'Diri Sendiri')
                                        <option value="{{ $stat }}" selected>{{ $stat }}</option>
                                    @else
                                        <option value="{{ $stat }}">{{ $stat }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">PERSETUJUAN UNTUK PERAWATAN DAN PENGOBATAN</h6>
                    <p class="">
                        Saya menyetujui untuk perawatan di RSK Bedah Ropanasuri sebagai pasien rawat jalan tergantung kepada rencana asuhan sesuai dengan kebutuhan pasien. 
                    </p>
                    <p>
                      Saya mengetahui bahwa saya memiliki kondisi yang membutuhkan perawatan medis, saya mengizinkan dokter dan profesional kesehatan lainnya untuk melakukan prosedur diagnostik dan untuk memberikan pengobatan medis seperti yang diperlukan dalam profesional mereka. Prosedur diagnostik dan perawatan medis termasuk terapi tidak terbatas pada electrocardiogram, x-ray (radiologi), tes darah, terapi fisik, pemberian obat (kecuali yang membutuhkan persetujuan khusus / tertulis), perawatan rutin dan prosedur seperti pemasangan infus. pemasangan kateter, spalak, pemberian oksigen, dan suntikan.
                    </p>
                    <p>
                      Saya sadar bahwa praktik kedokteran bukanlah ilmu pasti dan saya mengakui bahwa tidak ada jaminan atas hasil apapun, terhadap perawatan prosedur atau pemeriksaan apapun yang dilakukan kepada saya.
                    </p>
                    <p>
                      Persetujuan yang saya berikan tidak termasuk prosedur pembedahan atau tindakan invasif, anestesi, sedasi, penggunaan darah dan produk darah, perataan atau tindakan berisiko tinggi maka diperlukan persetujuan tindakan secara terpisah (informed consent).
                    </p>
                    <div class="">
                      <p>
                        Saya mengerti dan memahami bahwa:
                      </p>
                      <p class="mx-2">
                        Saya memiliki hak untuk mendapatkan akses terhadap informasi kesehatan saya dan mengajukan pertanyaan tentang pengobatan yang diusulkan (termasuk identitas setiap orang yang memberikan atau mengamati pengobatan) setiap saat.
                      </p>
                      <p class="mx-2">
                        Saya mengerti dan memahami bahwa saya memiliki hak untuk menyetujui atau menolak persetujuan, untuk setiap prosedur / terapi dan saya memahami dan menyadari bahwa RSK Bedah Ropanasuri atau dokter tidak bertanggung jawab atas hasil yang merugikan saya.
                      </p>
                    </div>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                      HAK DAN TANGGUNG JAWAB PASIEN
                    </h6>
                    <p>
                      Saya memiliki hak untuk mengambil bagian dalam keputusan mengenai penyakit saya dan dalam hal perawatan medis dan rencana pengobatan.
                    </p>
                    <p>
                      Saya telah mendapat informasi tentang "Hak dan Tanggung jawab Pasien di RSK Bedah Ropanasuri Padang melalui banner, leaflet, dan form tertulis yang disediakan oleh petugas.
                    </p>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                      KEBUTUHAN PRIVASI
                    </h6>
                    <p class="d-flex">
                      Saya 
                      <span class="col-sm-2 mx-2">
                          <select class="form-control form-control-sm" name="kebutuhan_privasi1" @required(true)>
                              <option value="mengizinkan">mengizinkan</option>
                              <option value="tidak mengizinkan">tidak mengizinkan</option>
                          </select>
                      </span>
                      RSK Bedah Ropanasuri untuk difoto/direkam dan dikutsertakan dalam survei.
                    </p>
                    <div class="">
                      <p class="d-flex">
                        Saya
                        <span class="col-2 mx-2">
                            <select class="form-control form-control-sm" name="kebutuhan_privasi2" @required(true)>
                                <option value="menginginkan">menginginkan</option>
                                <option value="tidak menginginkan">tidak menginginkan</option>
                            </select>
                        </span>
                        privasi khusus sebutkan bila ada permintaan privasi khusus 
                      </p>

                        <input type="text" name="kebutuhan_privasi_khusus" class="form-control" id="basic-default-name" value="{{ $item->kebutuhan_privasi }}">
                    </div>
                </div>
                {{-- page2 --}}
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                      HARTA BENDA MILIK PASIEN
                    </h6>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="radioHarta1" name="harta_benda" value="Saya telah memahami bahwa RSK Bedah Ropanasuri bertanggung jawab atas semua harta benda yang dibawa pasien ODC (Pelayanan Satu Hani) pasien rawat inap, serta untuk pasien yang tidak mampu mengamb keputusan untuk menjaga keamanan harta benda mereka karena tidak sadarkan diri atau tidak didampingi penunggu. Dan apabila saya membutuhkan, maka saya dapat menitipkan barang-barang saya kepada Rumah Sakit" @checked(true)>
                        <label class="form-check-label" for="radioHarta1">
                            Saya telah memahami bahwa RSK Bedah Ropanasuri bertanggung jawab atas semua harta benda yang dibawa pasien ODC (Pelayanan Satu Hani), pasien rawat inap, serta untuk pasien yang tidak mampu mengambil keputusan untuk menjaga keamanan harta benda mereka karena tidak sadarkan diri atau tidak didampingi penunggu. Dan apabila saya membutuhkan, maka saya dapat menitipkan barang-barang saya kepada Rumah Sakit.
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="radioHarta2" name="harta_benda" value="Saya secara pribadi bertanggung jawab atas barang-barang berharga yang saya miliki namun tidak terbatas pada uang, perhiasan, buku, kartu ATM, kartu kredit, handphone atau barang lainnya. Dan apabila saya membutuhkan maka saya dapat menitipkan barang-barang saya kepada Rumah Sakit">
                        <label class="form-check-label" for="radioHarta2">
                            Saya secara pribadi bertanggung jawab atas barang-barang berharga yang saya miliki namun tidak terbatas pada uang, perhiasan, buku, kartu ATM, kartu kredit, handphone atau barang lainnya. Dan apabila saya membutuhkan maka saya dapat menitipkan barang-barang saya kepada Rumah Sakit
                        </label>
                    </div>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                      PERSETUJUAN PELEPASAN INFORMASI
                    </h6>
                    <p>
                      Saya memahami informasi yang ada di dalam diri saya, termasuk diagnosis, hasil laboratorium, dan hasil tes diagnostik yang akan digunakan untuk perawatan medis, RSK Bedah Ropanasuri akan menjamin kerahasiaannya.
                    </p>
                    <p>
                      Saya memberi wewenang kepada RSK Bedah Ropanasuri untuk memberikan informasi tentang rahasia kedokteran saya bila diperlukan untuk memproses klaim Asuransi termasuk namun tidak terbatas pada BPJS Kesehatan, BPJS Ketenagakerjaan, asuransi kesehatan lainnya, Perusahaan, Dinas Kesehatan, atau Lembaga Pemerintah lainnya.
                    </p>
                    <div class="mb-2">
                      {{-- <form action="{{ route('general-consent-ranap.update', $item->id) }}" method="POST">
                      @csrf
                      @method('PUT') --}}
                      <p class="d-flex">
                        Saya
                        <span class="mx-2 col-1">
                            <select class="form-control form-control-sm" name="persetujuan_pelepasan_informasi">
                                <option value="ya" {{ $item->persetujuan_pelepasan_informasi == 'ya' ? 'selected' : '' }}>menyetujui</option>
                                <option value="tidak" {{ $item->persetujuan_pelepasan_informasi == 'tidak' ? 'selected' : '' }}>tidak menyetujui</option>
                            </select>
                        </span>
                        pelepasan informasi (diagnosis, hasil pelayanan, dan pengobatan) terkait perawatan saya kepada anggota keluarga saya (termasuk kondisi kritis atau situasi tertentu), 
                      </p>
                      <p class="d-flex">
                        nama : 
                        <span class="col-2 mx-2">
                            <input type="text" class="form-control form-control-sm" id="nama" value="{{ $item->queue->patient->name ?? '' }}" disabled>,
                        </span>
                        hubungan dengan pasien : 
                        <span class="col-2 mx-2">
                            <input type="text" class="form-control form-control-sm" id="hub" value="Diri Sendiri" disabled>
                        </span>
                      </p>
                      {{-- <button class="btn btn-sm btn-success">Submit</button>
                      </form> --}}
                    </div>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                      PENDAPAT KEDUA (SECOND OPINION)
                    </h6>
                    <p>
                      RSK Bedah Ropanasuri memfasilitasi permintaan pasien untuk mencari pendapat kedua (second opinion) tanpa perlu khawatir akan mempengaruhi perawatannya selama di dalam/luar Rumah Sakit
                    </p>
                  </div>
                  <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                      PENYAMPAIAN KELUHAN/PENDAPAT SELAMA PERAWATAN
                    </h6>
                    <p>
                      RSK Bedah Ropanasuri meneydiakan fasilitas kepada pasien dan keluarga untuk menyampaikan keluhan/pendapat sejak pasien mengakses pelayanan, selama menjalani masa perawatan dan pada proses pemulangan melalui:
                    </p>
                    <p>
                      a. Pengisian kotak saran yang berada di IGD/Rawat jalan/Rawat Inap
                    </p>
                    <p>
                      b. Melalul layanan pengaduan di Aplikasi WhatsApp: 0812-6729-2974
                    </p>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                      INFORMASI TATA TERTIB BAGI PASIEN, PENGUNJUNG DAN PENUNGGU PASIEN
                    </h6>
                    <p>
                      Saya telah menerima informasi tentang tata tertib yang diberlakukan oleh RSK Bedah Ropanasuri dan saya beserta keluarga bersedia untuk mematuhinya.
                    </p>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                      INFORMASI BIAYA
                    </h6>
                    <p>
                        Pasien umum / pribadi pembiayaan yang dikenakan mengacu kepada tarif pelayanan yang ada di RSK Bedah Ropanasuri Padang.                        
                    </p>
                </div>
                <div class="">
                    <h6 class="text-center bg-dark text-white py-2">
                      PERSETUJUAN UMUM (GENERAL CONSENT)
                    </h6>
                    <p class="fw-bold">
                        Dengan tanda tangan saya dibawah ini, saya menyatakan bahwa saya telah menerima informasi, membaca, dan memahami item pada Persetujuan Umum / General Consent.
                    </p>
                </div>
                {{-- ttd --}}
                <div class="row mb-3">
                    <div class="col-4 text-center">
                        Petugas Admisi
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4 text-center">
                        Padang, {{ date('d  M  Y') }} <br>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4 text-center">
                        <img src="" alt="" id="ImgTtdPpj">
                        <textarea id="ttdPpj" name="ttd_admisi" style="display: none;"></textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModal(this)">Tanda
                            Tangan</button>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4 text-center">
                        <img src="" alt="" id="ImgTtdKeluargaPasien">
                        <textarea id="ttd" name="ttd" style="display: none;"></textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModalTtdBottom(this, 'ImgTtdKeluargaPasien', 'ttd')">Tanda
                            Tangan</button>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm text-center" value="{{ auth()->user()->name ?? '' }}" disabled>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm text-center" id="nameTtd" value="{{ $item->queue->patient->name ?? '' }}" disabled>
                    </div>
                </div>
                <div class="col-sm-10 mt-2">
                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>

    {{-- modal create ttd --}}
    <div class="modal fade" id="signaturePadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
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

      {{--modal get ttd --}}
      <div class="modal fade" id="getTtdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <button type="button" class="btn btn-sm btn-secondary" data-action="clearInput">Clear</button>
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

            
            // start get ttd from user table
            var modal = document.getElementById("getTtdModal");
            var clearButtonInput = modal.querySelector("[data-action=clearInput]");
            var saveButtonInput = modal.querySelector("[data-action=saveInput]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');
        
            saveButtonInput.addEventListener("click", function (e) {
                e.preventDefault();
                $.ajax({
                    type : 'get',
                    url : "{{ route('ranap/cppt.getTtd') }}",
                    data : {
                        user_id : inputUserId.value,
                        password : inputPass.value,
                    }, success: function(data){
                        var newSrc = `{{ Storage::url('${data}') }}`;
                        $('#ImgTtdPpj').attr('src', newSrc);
                        $('#ttdPpj').val(data);
                        $('#petugas_name').val(`{{ auth()->user()->name }}`);
                    }, error: function(jqXHR, textStatus, errorThrown){
                        console.log();
                        var errorResponse = jqXHR.responseJSON;
                        if (errorResponse && errorResponse.error) {
                            alert(errorResponse.error)
                        }else{
                            alert('Terjadi Kesalahan Dalam Pengambilan Data');
                        }
                    }
                });

                inputPass.value = '';

                $('#getTtdModal').modal('hide');
            });
        });

        document.addEventListener('DOMContentLoaded', function(){
            var name = document.querySelector('input[name="name"]');
            var namaDis = document.getElementById('nama');
            var nameTtd = document.getElementById('nameTtd');

            name.addEventListener('change', function(){
                namaDis.value = name.value;
                nameTtd.value = name.value;
            });
        });
        function hubunganSelect(element){
            var hubDis = document.getElementById('hub');
            hubDis.value = element.value;
        }
    </script>
@endsection
