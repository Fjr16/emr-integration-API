@extends('layouts.backend.main')

@section('content')

    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #fafafa;
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .bg-gray {
            background-color: #d3d3d3
        }

        .page {
            /* height: 210mm; */
            height: auto;
            /* width: 297mm; */
            width: 210mm;
            min-height: 13.97cm;
            padding: 15mm;
            margin: 15mm auto;
            border: 1px #d3d3d3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 257mm;
            outline: 2cm #ffeaea solid;
        }

        th {
            font-size: 10pt !important;
        }

        .borderhr {
            color: black;
            background-color: black;
            border-color: black;
            height: 5px;
            opacity: 100;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }

        .compact-table th,
        .compact-table td {
            padding: 2px 5px;
            /* Reduce padding */
            font-size: 10.5px;
            /* Smaller font size */
        }

        .compact-table th {
            /* white-space: nowrap; */
            /* Prevent header text from wrapping */
        }

        @page {
            size: A4;
            /* Specify A4 size */
            margin: 0;
            margin-top: 10mm;
            margin-bottom: 10mm;
        }

        @media print {

            *,
            *:before,
            *:after {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 15mm;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
    {{-- Informasi Pasien --}}
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <h4 class="mb-1 text-primary d-flex">
                        {{ $item->queue->patient->name }} ({{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }})
                        <span class="ms-2 badge {{ $item->queue->patient->jenis_kelamin == 'Wanita' ? 'bg-danger' : 'bg-info' }}">{{ $item->queue->patient->jenis_kelamin == 'Wanita' ? 'P' : 'L' }}</span> 
                    </h4>
                    <h6 class="mb-1">{{ $item->queue->dpjp->name }} ({{ $item->queue->dpjp->staff_id }})</h6>
                    <h6 class="mb-1">{{ $item->queue->dpjp->poliklinik->name ?? '' }}<h6>
                    @if ($item->status == 'WAITING')                                    
                        <span class="badge bg-warning">PERMINTAAN</span>
                    @elseif ($item->status == 'ONGOING')
                        <span class="badge bg-info">DITERIMA</span>
                    @elseif ($item->status == 'FINISHED')
                        <span class="badge bg-success">SUDAH DIAMBIL</span>
                    @else
                        <span class="badge bg-success">TIDAK DIKETAHUI</span>
                    @endif
                </div>
                <div class="col-8 text-end">
                    <p class="mb-0">No. Antrian : <span class="fst-italic fw-bold">{{ $item->queue->no_antrian ?? '' }}</span></p>
                    <p class="mb-0">Tanggungan : <span class="fw-bold fst-italic">{{ $item->queue->patientCategory->name }}</span></p>
                    <p class="mb-0">Tgl. Lahir : <span class="fw-bold fst-italic">{{ $item->queue->patient->tanggal_lhr }}</span></p>
                </div>
            </div>
        </div>
    </div>
    {{-- end Informasi Pasien --}}
    <div class="row">
        <div class="accordion accordion-header-primary" id="form-tambah-obat">
            <div class="accordion-item card">
                <h2 class="accordion-header">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#form-tambah-obat-1" aria-expanded="false">
                    <i class="bx bx-book me-2"></i> Resep Dokter
                </button>
                </h2>
            
                <div id="form-tambah-obat-1" class="accordion-collapse collapse" data-bs-parent="#form-tambah-obat">
                <div class="accordion-body" id="form-input">
                    <div class="page">
                        <div class="header">
                            <div class="row justify-content-center">
                                <div class="col-8 text-center justify-content-center">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold fs-5">{{ $item->queue->dpjp->name ?? '....' }}</span>
                                        <hr class="my-0 border border-dark border-1">
                                        <span class="fw-bold">SIP : {{ $item->queue->dpjp->sip ?? '....' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">{{ $item->queue->patient->name ?? '....' }} / {{ implode('-', str_split(str_pad($item->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) ?? '....' }}</span>
                                        @php
                                            $tanggalLahir = new DateTime($item->queue->patient->tanggal_lhr);
                                            $now = new DateTime();
                                            $ageDiff = $now->diff($tanggalLahir);
                                            $ageString = $ageDiff->format('%y tahun %m bulan');
                                        @endphp
                                        <span class="fw-bold">BB : {{ $item->queue->perawatInitialAssesment->bb ?? '...' }} kg</span>
                                        <span class="fw-bold">Usia : {{ $ageString ?? '....' }}</span>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">R.S **F**F* **F***F** XYZ</span>
                                        <span>Jl. Air Tawar Barat Padang</span>
                                        <span>Telp. ***** - *****</span>
                                    </div>
                                </div>
                            </div>
                            <hr class="border border-dark border-3 opacity-100">
                        </div>
                
                        <div class="content mt-4">
                            <div class="row my-5">
                                @foreach ($item->queue->medicineReceipt->medicineReceiptDetails as $detail)
                                    <div class="col-12 mt-3">
                                        <div class="d-flex flex-row">
                                            <div class="d-flex align-items-center" style="min-width: 150px"><span class="fw-bold fs-4">R
                                                    / &nbsp;</span>
                                                <span class="fs-6">{{ $detail->medicine ? ($detail->medicine->name ?? '') : ($detail->nama_obat_custom ?? '') }}</span>
                                            </div>
                                            <div class="d-flex align-items-center ms-3">
                                                <span class="fw-bold fs-5">NO.
                                                    {{ $detail->jumlah ?? 0 }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 ps-4">
                                        <div class="d-flex flex-row">
                                            <span class="fs-1">S</span>
                                            <div class="d-flex flex-row align-items-center ms-1 pt-3">
                                                <div class="mx-2">{{ $detail->aturan_pakai ?? '' }}</div>
                                                <div class="">{{ $detail->other ?? '' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
        @php
            $totalAkhir = 0;
        @endphp
        <div class="card">
             {{-- alert --}}
             @if (session()->has('success'))
             <div class="alert alert-success d-flex" role="alert">
                 <span class="alert-icon rounded-circle"><i class='bx bxs-check-circle' style="font-size: 40px"></i></span>
                 <div class="d-flex flex-column ps-1">
                     <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">BERHASIL !!</h6>
                     <span>{{ session('success') }}</span>
                 </div>
             </div>
             @endif
             @if (session()->has('error'))
             <div class="alert alert-danger d-flex" role="alert">
                 <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
                 <div class="d-flex flex-column ps-1">
                     <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
                     <span>{{ session('error') }}</span>
                 </div>
             </div>
             @endif
             @if (session()->has('errors'))
             <div class="alert alert-danger d-flex" role="alert">
                 <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
                 <div class="d-flex flex-column ps-1">
                     <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
                     <span>
                     @foreach (session('errors') as $err)
                         {{ $err ?? '' }} <br>
                     @endforeach
                     </span>
                 </div>
             </div>
             @endif
             
            <div id="show-alert" class="row mb-0 mt-0"></div>
            {{-- end alert --}}

            <div class="card-body mb-0 pb-0">
                <form action="{{ route('rajal/farmasi/create', encrypt($item->id)) }}" method="GET">
                    <div class="row mb-0">
                        <div class="col-sm-11">
                            <label for="" class="form-label">Unit Asal Obat</label>
                            <select name="unit_id" id="unit_id" class="form-control select2">
                                @foreach ($units as $unit)
                                @if ($unit->id == decrypt($unitIdSelected))
                                    <option value="{{ $unit->id }}" selected>{{ $unit->name }}</option>
                                @else
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endif
                                @endforeach
                            </select>
                            <label class="col-sm-12 small text-warning fst-italic">*Hati-hati dalam memilih unit asal obat, stok obat dikurangi berdasarkan unit yang dipilih</label>
                        </div>
                        <div class="col-sm-1 mt-2">
                            <label for="" class="form-label"></label>
                            <button type="submit" class="btn btn-outline-warning">Change</button>
                        </div>
                    </div>
                </form>
            </div>
            <form action="{{ route('rajal/farmasi/store', encrypt($item->id)) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-6 text-start">
                        <button type="button" class="btn btn-sm btn-outline-primary fst-italic" onclick="tambahInput()"><i class="bx bx-plus"></i> Tambah Input</button>
                    </div>
                    <div class="col-6 text-end">
                    <a href="{{ route('rajal/farmasi/index') }}" class="ms-3 btn btn-sm btn-outline-danger"><i class='bx bx-left-arrow me-1'></i>Kembali</a>
                    </div>
                </div>
                <div class="col-sm-12 mt-3 mb-4">
                    <table class="table" id="example1">
                        <thead>
                            <tr class="text-nowrap bg-dark">
                                <th>Action</th>
                                @if ($item->queue->patientCategory->name != 'Umum')
                                <th>Dijamin</th>
                                @endif
                                <th>Nama Obat</th>
                                <th>Aturan Pakai</th>
                                <th>Diminta</th>
                                <th>Diserahkan</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody class="dinamic-input">
                            @foreach ($item->queue->medicineReceipt->medicineReceiptDetails as $key => $detail)
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="hapusInput(this)"><i class="bx bx-x"></i></button>
                                    </td>
                                    <td {{ $item->queue->patientCategory->name != 'Umum' ? '' : 'hidden' }}>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" name="include[]" onchange="getHargaSatuan(this)" {{ $detail->medicine_id ? 'checked' : 'disabled' }}>
                                            <input type="hidden" name="ditanggung_asuransi[]" value="1" {{ $detail->medicine_id ? '' : 'disabled' }}>
                                        </div>
                                    </td>
                                    <td style="width:25%">
                                        <input type="hidden" name="unit_id" value="{{ decrypt($unitIdSelected) }}">
                                        @if ($detail->medicine_id)  
                                            <div class="mb-2">
                                                <select id="medicine_id{{ $key }}" name="medicine_id[]" class="form-select form-select-sm select2 medicine_id" data-allow-clear="true" placeholder="placeholder-element-id" style="width: 100%" onchange="showStok(this)">
                                                    <option value="" selected disabled></option>
                                                    @foreach ($medicines as $obat)
                                                        @if (old('medicine_id', $detail->medicine->id) == $obat->id)
                                                            <option value="{{ $obat->id ?? '' }}" data-satuan="{{ $obat->small_unit ?? '' }}" selected >{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                                                        @else
                                                            <option value="{{ $obat->id ?? '' }}" data-satuan="{{ $obat->small_unit ?? '' }}">{{ $obat->kode ?? '...' }} / {{ $obat->name ?? '...' }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div> 
                                            <div class="">
                                                <select id="medicine_stok_id{{ $key }}" name="medicine_stok_id[]" class="form-select form-select-sm select2-w-placeholder-medicine" data-allow-clear="true" style="width: 100%" @disabled(true)>
                                                    {{-- diisi dari js --}}
                                                </select>
                                            </div>  
                                        @else
                                            <input type="text" class="form-control" name="nama_obat_custom[]" value="{{ $detail->nama_obat_custom ?? '' }}">
                                        @endif
                                    </td>
                                    <td style="width:20%">
                                        @if ($detail->medicine_id)
                                            <input type="text" name="aturan_pakai[]" class="form-control" id="aturan_pakai" placeholder="Aturan Pakai" value="{{ $detail->aturan_pakai ?? '' }}"></input>
                                        @else
                                            <input type="text" name="aturan_pakai_custom[]" class="form-control" id="aturan_pakai_custom" placeholder="Aturan Pakai" value="{{ $detail->aturan_pakai ?? '' }}"></input>
                                        @endif
                                    </td>
                                    <td style="width:16%">
                                        <div class="input-group input-group-merge">
                                            @if ($detail->medicine_id)
                                                <input type="number" class="form-control" value="{{ $detail->jumlah }}" disabled/>
                                            @else
                                                <input type="number" class="form-control" name="jumlah_custom[]" value="{{ $detail->jumlah ?? 0 }}" readonly/>
                                                <input type="hidden" name="satuan_obat_custom[]" value="{{ $detail->satuan_obat_custom ?? '' }}"/>
                                            @endif
                                            <span class="input-group-text text-dark satuan_obat_1">{{ $detail->medicine_id ? $detail->medicine->small_unit : $detail->satuan_obat_custom }}</span>
                                        </div>
                                    </td>
                                    <td style="width:14%">
                                        <div class="input-group input-group-merge">
                                            @if ($detail->medicine_id)
                                                <input type="number" class="form-control" name="jumlah[]" aria-label="Amount" onkeyup="updateHarga(this)" value="{{ $detail->jumlah ?? '' }}"/>
                                            @else
                                                <input type="number" class="form-control" aria-label="Amount" value="0" disabled/>
                                            @endif
                                            <span class="input-group-text text-dark satuan_obat_2">{{ $detail->medicine_id ? $detail->medicine->small_unit : '' }}</span>
                                        </div>
                                    </td>
                                    <td style="width:12%">
                                        <input type="number" class="form-control" name="harga_satuan[]" aria-label="Amount" value="0" {{ $detail->medicine_id ? 'readonly' : 'disabled' }} />
                                    </td>
                                    <td style="width:13%">
                                        <input type="number" name="sub_total[]" value="0" class="form-control" {{ $detail->medicine_id ? 'readonly' : 'disabled' }}>
                                    </td>
                                </tr>
                            @endforeach
    
                        </tbody>
                    </table>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-9">
                        <span class="fw-bold fst-italic text-uppercase" colspan="3">Total Akhir</span>
                    </div>
                    <div class="col-sm-2 text-end pe-4 fw-bold">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text text-dark satuan_obat_2">Rp. </span>
                            <input type="text" class="form-control text-center pe-5" id="total-harga" aria-label="Amount" value="0" readonly/>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="mt-4 me-4 text-end">
                    <button type="submit" class="btn btn-md btn-primary me-1">Submit</button>
                </div>
            </div>
            </form>
        </div>
               {{-- @canany(['edit resep obat', 'print resep obat'])
                                    <td class="text-center">
                                        @can('edit resep obat')
                                            <a href="{{ route('rajal/farmasi/edit', $invoice->id) }}"
                                                class="btn btn-sm btn-warning"><i class="bx bx-edit"></i></a>
                                        @endcan
                                        @can('print resep obat')
                                            <a href="{{ route('rajal/farmasi/show', $invoice->id) }}" target="blank"
                                                class="btn btn-sm btn-dark"><i class="bx bx-printer"></i></a>
                                        @endcan
                                    </td>
                                @endcanany --}}
     
    </div>

    <script>
        // untuk dinamic select stok obat
        const elementAlert = document.getElementById('show-alert');
        const dataStok = @json($medicineStokAll);
        const dataMedicine = @json($medicines);
        const patientCategoryId = @json($item->queue->patientCategory->id);
        const patientCategoryAll = @json($tanggungans);
        // DONE
        function showStok(element) {
            // satuan otomatis
            const satuanObat1 = element.parentNode.parentNode.parentNode.querySelector('.satuan_obat_1');
            const satuanObat2 = element.parentNode.parentNode.parentNode.querySelector('.satuan_obat_2');
            const selectedOption = $(element).select2('data')[0];
            const satuan = selectedOption.element.dataset.satuan;
            satuanObat1.textContent = satuan;
            satuanObat2.textContent = satuan;
            //end satuan otomatis

            const unitId = $('#unit_id').val();
            // let selectStok = element.parentNode.parentNode.parentNode.querySelector('input[name="medicine_stok_id[]');
            let selectStok = element.parentNode.parentNode.querySelector('select[name="medicine_stok_id[]"]');
            if (!unitId) {
                alertShow('Error !!', 'Unit Asal Obat Harus Diisi', elementAlert);
            }

            // get data stok berdasarkan unit_id dan id obat
            let dataSelectStok = dataStok.filter(function(item){
                return item.unit_id == unitId && item.medicine.id == element.value;
            });
            
            if (dataSelectStok.length == 0) {
                selectStok.disabled = true;
                $(selectStok).html(`<option value="null" selected>Tidak Ada Stok</option>`);
            }else{
                selectStok.disabled = false;
                let temp = '<option value="" selected disabled></option>';
                dataSelectStok.forEach(function(item){
                    temp += `<option value="${item.id}" data-foo="harga awal : ${item.medicine.base_harga ?? '...'} Rp | Stok : ${item.stok ?? '...'} ${item.medicine.small_unit ?? '...'} | Batch : ${item.no_batch ?? '...'} (${item.production_date ?? '...'} / ${item.exp_date ?? '...'})" data-satuan="${item.medicine.small_unit ?? ''}">${item.medicine.kode ?? '...'} / ${item.medicine.name ?? '...'}</option>`;
                });
                $(selectStok).html(temp);
            }

            // panggil function getHargaSatuan()
            const elementCheckPenjamin = element.parentNode.parentNode.parentNode.querySelector('input[name="include[]"]');
            getHargaSatuan(elementCheckPenjamin);
            
        }

        //DONE
        function getHargaSatuan(element){
            const elementInputTanggungan = element.parentNode.querySelector('input[name="ditanggung_asuransi[]"]');
            let Elementharga = element.parentNode.parentNode.parentNode.querySelector('input[name="harga_satuan[]"]');
            const medicineSelectedId = element.parentNode.parentNode.parentNode.querySelector('select[name="medicine_id[]"]').selectedOptions[0].value;
            let penjaminItem = null;
            if (element.checked) {
                penjaminItem = patientCategoryAll.find(function(item){
                    return item.id == patientCategoryId;
                });
                elementInputTanggungan.value = 1;
            } else {
                penjaminItem = patientCategoryAll.find(function(item){
                    return item.name == 'Umum';
                });
                elementInputTanggungan.value = 0;
            }

            if (penjaminItem == null) {
                alertShow('Error !!', 'Terjadi Kesalahan, Penjamin Pasien Tidak Ditemukan', elementAlert);
            }

            const harga = sumHargaObat(penjaminItem, medicineSelectedId, elementAlert);
            Elementharga.value = harga;
            updateHarga(element);
        }

        // DONE
        function updateHarga(element) {
            let jumlah = element.parentNode.parentNode.parentNode.querySelector('input[name="jumlah[]"]').value;
            let harga_satuan = element.parentNode.parentNode.parentNode.querySelector('input[name="harga_satuan[]"]').value;

            // menghitung subTotal
            let subTotalInput = element.parentNode.parentNode.parentNode.querySelector('input[name="sub_total[]"]');
            const subTotal = jumlah * harga_satuan;
            subTotalInput.value = subTotal;

            getTotalAkhir();
        }

        // DONE
        const ElementTotal = document.getElementById('total-harga');
        function getTotalAkhir(){
            let totalAkhir = 0;
            let subTotalAll = document.querySelectorAll('input[name="sub_total[]"]');
            subTotalAll.forEach(function(item){
                totalAkhir += parseInt(item.value);
            });
            ElementTotal.value = totalAkhir;
        }

        let counter = 0;
        function tambahInput() {
            counter = counter+1;
            const rowInput = document.querySelector('.dinamic-input');
            const content = `
            <tr>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="hapusInput(this)"><i class="bx bx-x"></i></button>
                </td>
                <td {{ $item->queue->patientCategory->name != 'Umum' ? '' : 'hidden' }}>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="include[]" checked onchange="getHargaSatuan(this)">
                        <input type="hidden" name="ditanggung_asuransi[]" value="1">
                    </div>
                </td>
                <td style="width:30%">
                    <div class="mb-2">
                        <select id="medicine_id_${counter}" name="medicine_id[]" class="form-select form-select-sm select2 medicine_id" data-allow-clear="true" placeholder="placeholder-element-id" style="width: 100%" onchange="showStok(this)">
                            <option value="" selected disabled></option>
                            @foreach ($medicines as $obat)
                                <option value="{{ $obat->id ?? '' }}" data-satuan="{{ $obat->small_unit ?? '' }}">{{ $obat->kode ?? '...' }} / {{ $obat->name ?? '...' }}</option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="">
                        <select id="medicine_stok_id_${counter}" name="medicine_stok_id[]" class="form-select form-select-sm select2-w-placeholder-medicine" data-allow-clear="true" style="width: 100%" @disabled(true)>
                            {{-- diisi dari js --}}
                        </select>
                    </div>  
                    <input type="hidden" class="form-control" name="nama_obat[]" value="{{ $detail->medicine->name ?? '' }}">
                </td>
                <td style="width:20%">
                    <input type="text" name="aturan_pakai[]" class="form-control" id="aturan_pakai" placeholder="Aturan Pakai" value=""></input>
                </td>
                <td style="width:15%">
                    <div class="input-group input-group-merge">
                        <input type="number" class="form-control" value=""/>
                        <span class="input-group-text text-dark satuan_obat_1"></span>
                    </div>
                </td>
                <td style="width:15%">
                    <div class="input-group input-group-merge">
                        <input type="number" class="form-control" name="jumlah[]" aria-label="Amount" onkeyup="updateHarga(this)" value=""/>
                        <span class="input-group-text text-dark satuan_obat_2"></span>
                        <input type="hidden" class="form-control" name="satuan_obat[]" value=""/>
                    </div>
                </td>
                <td style="width:10%">
                    <input type="number" class="form-control" name="harga_satuan[]" aria-label="Amount" value="0" readonly/>
                </td>
                <td style="width:10%">
                    <input type="number" name="sub_total[]" value="0" class="form-control" readonly>
                </td>
            </tr>`;

            rowInput.insertAdjacentHTML('beforeend', content);
            $('#medicine_stok_id_' + counter).select2({
                placeholder : 'Pilih Stok',
                allowClear : true,
                matcher: matchCustom,
                templateResult: formatCustom
            });
            $('#medicine_id_' + counter).select2({
                placeholder : 'Pilih Obat',
                allowClear : true,
            });
        }
        function hapusInput(element) {
            var inputToRemove = element.closest('tr');
            inputToRemove.remove();
        }

        // DONE
        // merender stok untuk reload halaman pertamakali
        document.addEventListener('DOMContentLoaded', function(){
            const selectMedicineAll = document.querySelectorAll('.medicine_id');
            selectMedicineAll.forEach(function(element){
                showStok(element);
            });
        });

    </script>
@endsection
