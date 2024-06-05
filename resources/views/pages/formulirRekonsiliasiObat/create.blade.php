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
            <h5 class="mb-0">Formulir Rekonsiliasi Obat
            </h5>
        </div>
        <form action="{{ route('formulir/rekonsilasi/obat.store', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="mb-3 row align-items-center">
                    <label for="rohaniawan_dari" class="col-form-label col-2">Alergi Obat</label>
                    <div class="col-3">
                        <div class="row align-items-center">
                            <div class="form-check col">
                                <input class="form-check-input" type="radio" name="isAlergiObat" value="0"
                                    id="alergi-obat-tidak" @checked(true) onclick="enableAlergiObat(this.value)"/>
                                <label class="form-check-label" for="alergi-obat-tidak">
                                    Tidak
                                </label>
                            </div>
                            <div class="form-check col">
                                <input class="form-check-input" type="radio" name="isAlergiObat" value="1"
                                    id="alergi-obat-ya" onclick="enableAlergiObat(this.value)"/>
                                <label class="form-check-label" for="alergi-obat-ya">
                                    Ya, nama obat:
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="row align-items-center">
                                    <label class="col-form-label col-2" for="algObatNm1">1.</label>
                                    <input class="form-control col" type="text" id="algObatNm1" name="alergi_obat[]" disabled/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row align-items-center">
                                    <label class="col-form-label col-2" for="algObatNm2">2.</label>
                                    <input class="form-control col" type="text" name="alergi_obat[]" disabled/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row align-items-center">
                                    <label class="col-form-label col-2" for="algObatNm3">3.</label>
                                    <input class="form-control col" type="text" name="alergi_obat[]" disabled/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="hasil_pemeriksaan_penunjang" class="col-form-label">Apakah pasien menggunakan obat
                        dalam 3 (tiga) bulan terakhir?
                    </label>
                    <div class="row-cols-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isMinumObat" value="0"
                                id="riwayat_minum_obat_tidak" @checked(true) onclick="enableRiwayatObat(this.value)"/>
                            <label class="form-check-label" for="riwayat_minum_obat_tidak">
                                Tidak Ada
                            </label>
                        </div>
                    </div>
                    <div class="row-cols-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isMinumObat" value="1"
                                id="riwayat_minum_obat_ya" onclick="enableRiwayatObat(this.value)"/>
                            <label class="form-check-label" for="riwayat_minum_obat_ya">
                                Ada, sebutkan (Semua Jenis Obat termasuk Obat Bebas, Herbal, atau Traditional Chinese
                                Medicine
                                yang digunakan)
                            </label>
                        </div>
                        <input type="text" class="form-control form-control-sm" name="riwayat_minum_obat" id="riwayat_minum_obat" disabled>
                    </div>
                </div>

                {{-- form multiple --}}
                <div id="form-multiple">
                    @foreach ($item->ranapMedicineReceipts as $medicineReceipt)
                    @foreach ($medicineReceipt->ranapMedicineReceiptDetails as $index => $detail)                            
                        <div class="mb-3 row">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-name">Tanggal</label>
                                    <input type="datetime-local" name="tanggal[]" class="form-control" value="{{ $detail->created_at->format('Y-m-d H:i:s') }}" id="basic-default-name" @required(true) readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-name">Nama Obat</label>
                                    {{-- <select class="form-control select2" name="medicine_id[]" @required(true)> --}}
                                        {{-- @foreach ($data as $medicine) --}}
                                            {{-- @if ($medicine->id == $detail->medicine_id) --}}
                                                {{-- <option value="{{ $medicine->id }}" selected>{{ $medicine->name }}</option> --}}
                                            {{-- @else --}}
                                                {{-- <option value="{{ $medicine->id }}">{{ $medicine->name }}</option> --}}
                                            {{-- @endif --}}
                                        {{-- @endforeach --}}
                                        <input type="hidden" name="medicine_id[]" value="{{ $detail->medicine_id }}">
                                        <input type="text" class="form-control" value="{{ $detail->medicine->name }}" disabled>
                                    {{-- </select> --}}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-name">Frekuensi</label>
                                    <input type="text" name="frekuensi[]" class="form-control" id="basic-default-name" value="{{ $detail->aturan_pakai ?? '' }}" @required(true) readonly>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-name">Rute</label>
                                    <input type="text" name="rute[]" class="form-control" id="basic-default-name" @required(true)>
                                </div>
                            </div>
                            @can('formulir rekonsiliasi dokter')           
                                {{-- dokter 
                                    buat kan permission untuk form isian dokter dan apoteker--}}
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">dilanjutkan saat admisi</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="saat_admisi_{{ $index }}" id="saat_admisi_ya_{{ $index }}" value="1" />
                                            <label class="form-check-label" for="saat_admisi_ya_{{ $index }}">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="saat_admisi_{{ $index }}" id="saat_admisi_tidak_{{ $index }}" value="0" />
                                            <label class="form-check-label" for="saat_admisi_tidak_{{ $index }}">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                {{-- </dokter --}}
                            @endcan
                            @can('formulir rekonsiliasi apoteker')    
                                {{-- apoteker --}}
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">dilanjutkan transfer I</label><br>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-name">Ruangan</label>
                                            <select class="form-control" id="ruang_tf1_1" name="ruang_tf_1[]" @required(true)>
                                                <option selected>Pilih</option>
                                                @foreach ($rooms as $room)
                                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="tf1_{{ $index }}" id="tf1_ya_{{ $index }}" value="1" />
                                            <label class="form-check-label" for="tf1_ya_{{ $index }}">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="tf1_{{ $index }}" id="tf1_tidak_{{ $index }}" value="0" />
                                            <label class="form-check-label" for="tf1_tidak_{{ $index }}">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">dilanjutkan transfer II</label><br>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-name">Ruangan</label>
                                            <select class="form-control" id="ruang_tf2_1" name="ruang_tf_2[]" @required(true)>
                                                <option selected>Pilih</option>
                                                @foreach ($rooms as $room)
                                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="tf2_{{ $index }}" id="tf2_ya_{{ $index }}" value="1" />
                                            <label class="form-check-label" for="tf2_ya_{{ $index }}">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="tf2_{{ $index }}" id="tf2_tidak_{{ $index }}" value="0" />
                                            <label class="form-check-label" for="tf2_tidak_{{ $index }}">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">dilanjutkan transfer III</label><br>
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-name">Ruangan</label>
                                            <select class="form-control" id="ruang_tf3_1" name="ruang_tf_3[]" @required(true)>
                                                <option selected>Pilih</option>
                                                @foreach ($rooms as $room)
                                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="tf3_{{ $index }}" id="tf3_ya_{{ $index }}" value="1" />
                                            <label class="form-check-label" for="tf3_ya_{{ $index }}">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="tf3_{{ $index }}" id="tf3_tidak_{{ $index }}" value="0" />
                                            <label class="form-check-label" for="tf3_tidak_{{ $index }}">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label class="form-label">dilanjutkan saat pulang</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="saat_pulang_{{ $index }}" id="saat_pulang_ya_{{ $index }}" value="1" />
                                            <label class="form-check-label" for="saat_pulang_ya_{{ $index }}">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="saat_pulang_{{ $index }}" id="saat_pulang_tidak_{{ $index }}" value="0" />
                                            <label class="form-check-label" for="saat_pulang_tidak_{{ $index }}">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                                {{-- </apoteker  --}}
                            @endcan
                            {{-- <div class="col-1 d-flex align-items-center">
                                <button class="btn btn-sm btn-dark" onclick="tambahInputRekonsiliasi()"><i class="bx bx-plus"></i></button>
                            </div> --}}
                        </div>
                        @endforeach
                    @endforeach
                </div>

                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">simpan</button>
                </div>


            </div>
        </form>
    </div>

    <script>
        function enableRiwayatObat(nilai){
            var formRiwayat = document.getElementById('riwayat_minum_obat');
            if(nilai == 1){
                formRiwayat.disabled = false;
            }else{
                formRiwayat.disabled = true;
            }
        }
        </script>
    <script>
        function enableAlergiObat(nilai){
            var formAlergis = document.querySelectorAll('input[name="alergi_obat[]"]');
            if(nilai == 1){
                formAlergis.forEach(function(item){
                    item.disabled = false;
                });
            }else{
                formAlergis.forEach(function(item){
                    item.disabled = true;
                });
            }
        }
    </script>
    
    <script>
        // let count = 2;
        // function tambahInputRekonsiliasi(){
            // var multipleInput = document.getElementById('form-multiple');
            // var row = document.createElement('div');
            // row.className = 'row mb-3';

            // row.innerHTML = `
            //             <div class="col-11">
            //                 <div class="row">
            //                     <div class="col-3">
            //                         <div class="mb-3">
            //                             <label class="form-label" for="basic-default-name">Tanggal</label>
            //                             <input type="date" name="tanggal[]" class="form-control" value="{{ date('Y-m-d') }}" id="basic-default-name" @required(true)>
            //                         </div>
            //                     </div>
            //                     <div class="col-3">
            //                         <div class="mb-3">
            //                             <label class="form-label" for="basic-default-name">Nama Obat</label>
            //                             <select class="form-control" id="medicine_id_${count}" name="medicine_id[]" @required(true)>
            //                                 @foreach ($data as $medicine)
            //                                     <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
            //                                 @endforeach
            //                             </select>
            //                         </div>
            //                     </div>
            //                     <div class="col-3">
            //                         <div class="mb-3">
            //                             <label class="form-label" for="basic-default-name">Frekuensi & Dosis</label>
            //                             <input type="text" name="dosis[]" class="form-control" id="basic-default-name" @required(true)>
            //                         </div>
            //                     </div>
            //                     <div class="col-3">
            //                         <div class="mb-3">
            //                             <label class="form-label" for="basic-default-name">Rute</label>
            //                             <input type="text" name="rute[]" class="form-control" id="basic-default-name" @required(true)>
            //                         </div>
            //                     </div>
            //                     @can('formulir rekonsiliasi dokter')           
            //                         {{-- dokter 
            //                             buat kan permission untuk form isian dokter dan apoteker--}}
            //                         <div class="col-3">
            //                             <div class="mb-3">
            //                                 <label class="form-label">dilanjutkan saat admisi</label><br>
            //                                 <div class="form-check form-check-inline">
            //                                     <input class="form-check-input" type="radio" name="saat_admisi[]" id="saat_admisi_ya_${count}" value="1" />
            //                                     <label class="form-check-label" for="saat_admisi_ya_${count}">Ya</label>
            //                                 </div>
            //                                 <div class="form-check form-check-inline">
            //                                     <input class="form-check-input" type="radio" name="saat_admisi[]" id="saat_admisi_tidak_${count}" value="0" />
            //                                     <label class="form-check-label" for="saat_admisi_tidak_${count}">Tidak</label>
            //                                 </div>
            //                             </div>
            //                         </div>
            //                         {{-- </dokter --}}
            //                     @endcan
            //                     @can('formulir rekonsiliasi apoteker')     
            //                         {{-- apoteker --}}
            //                         <div class="col-3">
            //                             <div class="mb-3">
            //                                 <label class="form-label">dilanjutkan transfer I</label><br>
            //                                 <div class="mb-3">
            //                                     <label class="form-label" for="basic-default-name">Ruangan</label>
            //                                     <select class="form-control" id="ruang_tf1_${count}" name="ruang_tf_1[]" @required(true)>
            //                                         @foreach ($rooms as $room)
            //                                             <option value="{{ $room->id }}">{{ $room->name }}</option>
            //                                         @endforeach
            //                                     </select>
            //                                 </div>
            //                                 <div class="form-check form-check-inline">
            //                                     <input class="form-check-input" type="radio" name="tf_1[]" id="tf1_ya_${count}" value="1" />
            //                                     <label class="form-check-label" for="tf1_ya_${count}">Ya</label>
            //                                 </div>
            //                                 <div class="form-check form-check-inline">
            //                                     <input class="form-check-input" type="radio" name="tf_1[]" id="tf1_tidak_${count}" value="0" />
            //                                     <label class="form-check-label" for="tf1_tidak_${count}">Tidak</label>
            //                                 </div>
            //                             </div>
            //                         </div>
            //                         <div class="col-3">
            //                             <div class="mb-3">
            //                                 <label class="form-label">dilanjutkan transfer II</label><br>
            //                                 <div class="mb-3">
            //                                     <label class="form-label" for="basic-default-name">Ruangan</label>
            //                                     <select class="form-control" id="ruang_tf2_${count}" name="ruang_tf_2[]" @required(true)>
            //                                         @foreach ($rooms as $room)
            //                                             <option value="{{ $room->id }}">{{ $room->name }}</option>
            //                                         @endforeach
            //                                     </select>
            //                                 </div>
            //                                 <div class="form-check form-check-inline">
            //                                     <input class="form-check-input" type="radio" name="tf2[]" id="tf2_ya_${count}" value="1" />
            //                                     <label class="form-check-label" for="tf2_ya_${count}">Ya</label>
            //                                 </div>
            //                                 <div class="form-check form-check-inline">
            //                                     <input class="form-check-input" type="radio" name="tf2[]" id="tf2_tidak_${count}" value="0" />
            //                                     <label class="form-check-label" for="tf2_tidak_${count}">Tidak</label>
            //                                 </div>
            //                             </div>
            //                         </div>
            //                         <div class="col-3">
            //                             <div class="mb-3">
            //                                 <label class="form-label">dilanjutkan transfer III</label><br>
            //                                 <div class="mb-3">
            //                                     <label class="form-label" for="basic-default-name">Ruangan</label>
            //                                     <select class="form-control" id="ruang_tf3_${count}" name="ruang_tf_3[]" @required(true)>
            //                                         @foreach ($rooms as $room)
            //                                             <option value="{{ $room->id }}">{{ $room->name }}</option>
            //                                         @endforeach
            //                                     </select>
            //                                 </div>
            //                                 <div class="form-check form-check-inline">
            //                                     <input class="form-check-input" type="radio" name="tf3[]" id="tf3_ya_${count}" value="1" />
            //                                     <label class="form-check-label" for="tf3_ya_${count}">Ya</label>
            //                                 </div>
            //                                 <div class="form-check form-check-inline">
            //                                     <input class="form-check-input" type="radio" name="tf3[]" id="tf3_tidak_${count}" value="0" />
            //                                     <label class="form-check-label" for="tf3_tidak_${count}">Tidak</label>
            //                                 </div>
            //                             </div>
            //                         </div>
            //                         <div class="col-3">
            //                             <div class="mb-3">
            //                                 <label class="form-label">dilanjutkan saat pulang</label><br>
            //                                 <div class="form-check form-check-inline">
            //                                     <input class="form-check-input" type="radio" name="saat_pulang[]" id="saat_pulang_ya_${count}" value="1" />
            //                                     <label class="form-check-label" for="saat_pulang_ya_${count}">Ya</label>
            //                                 </div>
            //                                 <div class="form-check form-check-inline">
            //                                     <input class="form-check-input" type="radio" name="saat_pulang[]" id="saat_pulang_tidak_${count}" value="0" />
            //                                     <label class="form-check-label" for="saat_pulang_tidak_${count}">Tidak</label>
            //                                 </div>
            //                             </div>
            //                         </div>
            //                         {{-- </apoteker  --}}
            //                     @endcan
            //                 </div>
            //             </div>
            //             <div class="col-1 d-flex align-items-center">
            //                 <button class="btn btn-sm btn-danger" onclick="kurangInputRekonsiliasi(this)"><i class="bx bx-minus"></i></button>
            //             </div>
            // `;

            // multipleInput.append(row);

            // $('#ruang_tf1_' + count).select2();
            // $('#ruang_tf2_' + count).select2();
            // $('#ruang_tf3_' + count).select2();
            // $('#medicine_id_' + count).select2();
            // count = count+1;

        // }
    </script>
    {{-- <script>
        function kurangInputRekonsiliasi(element){
        var row = element.parentNode.parentNode;
        row.remove();
        }
    </script> --}}
@endsection
