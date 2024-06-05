@extends('layouts.backend.main')

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        @can('daftar resep dokter')
            <div class="col-sm-7">
                {{-- <a href="{{ route('clear/farmasi/medicine') }}" class="btn btn-success">Reset Farmasi Gudang</a> --}}
                {{-- <a href="{{ route('clear/farmasi/rajal') }}" class="btn btn-success">Reset Farmasi Rajal</a> --}}
                <h6 class="m-0 mb-2">Daftar Resep Dokter</h6>
                {{-- <table class="table table-bordered w-100">
        <thead class="bg-dark">
          <tr class="text-center">
            <th>Tanggal / Jam</th>
            <th>Nama Dokter</th>
            <th>Nama Pasien</th>
            <th>Daftar Resep</th>
            <th>Nama Obat</th>
            <th>Jumlah Obat</th>
            <th>Aturan Pakai</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($item->rawatJalanPatient->rawatJalanPoliPatient->medicineReceipts as $receipt)
          <tr class="text-center">
            <td>{{ $receipt->created_at->format('Y-m-d') ?? '' }}</td>
            <td>{{ $receipt->user->name ?? '' }}</td>
            <td>{{  $receipt->patient->name ?? '' }}</td>
            <td>
              @foreach ($receipt->medicineReceiptDetails as $detail)
                  {{ $detail->medicine->name ?? '-'}} | {{ $detail->jumlah ?? '-' }} | {{ $detail->aturan_pakai ?? '-' }} | {{ $detail->keterangan ?? '-' }} | {!! $detail->other ?? '' !!} <br>
              @endforeach
            </td>
          </tr>
          @endforeach
        </tbody>
      </table> --}}

                <div class="card p-4 rounded-5">
                    <div class="card-header">
                        <div class="row justify-content-center">
                            <div class="col-8 text-center justify-content-center">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold fs-5">dr. HAMZAH MUHAMMAD ZEIN, Sp.JP</span>
                                    <hr class="my-0 border border-dark">
                                    <span class="fw-bold">SIP : 1155/891/DKK/IV/2022</span>
                                    <span>Spesialis Jantung</span>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-flex flex-column">
                                    <span class="fw-bold">Praktek :</span>
                                    <span class="fw-bold">R.S. Khusus Bedah Ropanasuri</span>
                                    <span>Jl. Aur No. 8 Padang</span>
                                    <span>Telp. 31938 - 33854</span>
                                </div>
                            </div>
                        </div>
                        <hr class="border border-dark border-2 opacity-100">
                    </div>

                    <div class="card-body">
                        <div class="row ">
                            <div class="col-6">
                                <span>Ruangan</span>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        UGD
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Poliklinik
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Ranap
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <span>Tanggal :
                                    {{ $etc->created_at->format('d-m-Y') ?? 'N/A' }}
                                </span>
                                <p class="mb-0">Riwayat Alergi Obat</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Tidak
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Ya, Nama Obat ........
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 mb-5">
                            @php
                                function toRoman($number)
                                {
                                    $lookup = [
                                        1000 => 'M',
                                        900 => 'CM',
                                        500 => 'D',
                                        400 => 'CD',
                                        100 => 'C',
                                        90 => 'XC',
                                        50 => 'L',
                                        40 => 'XL',
                                        10 => 'X',
                                        9 => 'IX',
                                        5 => 'V',
                                        4 => 'IV',
                                        1 => 'I',
                                    ];
                                    $result = '';
                                    foreach ($lookup as $value => $symbol) {
                                        while ($number >= $value) {
                                            $result .= $symbol;
                                            $number -= $value;
                                        }
                                    }
                                    return $result;
                                }
                            @endphp
                            @foreach ($item->rawatJalanPatient->rawatJalanPoliPatient->medicineReceipts as $receipt)
                                @foreach ($receipt->medicineReceiptDetails as $detail)
                                    <div class="col-12">
                                        <div class="d-flex flex-row">
                                            <div class="d-flex align-items-center" style="min-width: 150px"><span
                                                    class="fw-bold">R / </span>
                                                {{ $detail->medicine->name ?? '' }}</div>
                                            <div class="row" style="max-width: 300px">
                                                <div class="col-3">
                                                    <span style="font-size:70px" class="fw-light">&int;</span>
                                                </div>
                                                <div class="col-7 d-flex align-items-center">
                                                    <div class="row">
                                                        <div class="col-12">{{ $detail->aturan_pakai ?? '' }}</div>
                                                        <div class="col-12">{{ $detail->keterangan ?? '' }}</div>
                                                        <div class="col-12">{{ $detail->other ?? '' }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-2 d-flex align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <span class="fw-bold">{{ toRoman($detail->jumlah ?? 0) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <table>
                                    <tr>
                                        <td>Nama Pasien</td>
                                        <td>:</td>
                                        <td class="ps-2">
                                            {{ $etc->patient->name ?? '....' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No Rekam Medis</td>
                                        <td>:</td>
                                        <td class="ps-2">
                                            {{ implode('-', str_split(str_pad($etc->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) ?? '....' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir Umur</td>
                                        <td>:</td>
                                        @php
                                            $tanggalLahir = new DateTime($etc->patient->tanggal_lhr);
                                            $now = new DateTime();
                                            $ageDiff = $now->diff($tanggalLahir);
                                            $ageString = $ageDiff->format('%y tahun %m bulan');
                                        @endphp
                                        <td class="ps-2">{{ $tanggalLahir->format('d-m-Y') ?? '....' }}
                                            <span>({{ $ageString ?? '....' }})</span>
                                        </td>
                                        {{-- <td class="ps-2">
                                            {{ $item->rawatJalanPatient->rawatJalanPoliPatient->medicineReceipts->first()->patient->tanggal_lhr }}
                                        </td> --}}
                                    </tr>
                                    <tr>
                                        <td>NIK</td>
                                        <td>:</td>
                                        <td class="ps-2">
                                            {{ $etc->patient->nik ?? '....' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Berat Badan</td>
                                        <td>:</td>
                                        <td class="ps-2">
                                            {{ $etc->patient->berat_badan ?? '....' }}
                                            kg</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Dokter</td>
                                        <td>:</td>
                                        <td class="ps-2">
                                            {{ $etc->user->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No SIP</td>
                                        <td>:</td>
                                        <td class="ps-2">{{ $etc->user->sip ?? '' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endcan
        @can('input resep obat')
            <div class="col-sm-5">
                <form action="{{ route('rajal/farmasi/store') }}" method="POST">
                    @csrf
                    <h6 class="m-0">Form Input Obat Pasien</h6>
                    <input type="hidden" name="rajal_farmasi_patient_id" class="form-control" value="{{ $item->id }}"
                        required />
                    <input type="hidden" name="patient_id" class="form-control"
                        value="{{ $item->rawatJalanPatient->queue->patient_id }}" required />

                    <div class="card mt-2">
                        <div class="card-body">
                            <div id="input-obat">
                                <div class="row mt-2">
                                    <div class="col-10">
                                        <div class="row">
                                            {{-- <div class="col-sm-12 mb-2">
                                                <label for="unit_id" class="form-label">Unit Asal Obat</label>
                                                <input type="hidden" id="unit_id" name="unit_id"
                                                    value="{{ auth()->user()->unitCategory->unit->id }}" />
                                                <input type="text" class="form-control"
                                                    value="{{ auth()->user()->unitCategory->unit->name ?? 'Unknown' }}"
                                                    required readonly />
                                            </div> --}}
                                            <div class="col-sm-6 mb-2">
                                                <label for="medicine_id_1" class="form-label">Nama Obat</label>
                                                <select id="medicine_id_1" name="medicine_id[]"
                                                    class="form-select form-select-sm medicineId" data-allow-clear="true"
                                                    onchange="showStok(this)" required>
                                                    <option selected disabled>Pilih</option>
                                                    @foreach ($dataObat as $obat)
                                                        @if (old('medicine_id') == $obat->id)
                                                            <option value="{{ $obat->id }}" selected>
                                                                {{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                                                        @else
                                                            <option value="{{ $obat->id }}">
                                                                {{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="form-label" for="basic-default-name">Stock</label>
                                                <input type="number" id="stok" class="form-control" value=""
                                                    required disabled />
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="form-label" for="basic-default-name">Jumlah</label>
                                                <input type="number" class="form-control" name="jumlah[]" id="jumlah"
                                                    onkeyup="getTotalHarga(this)" required />
                                            </div>
                                            <div class="col-sm-4 mb-2">
                                                <label for="patient_category_id" class="form-label">Tanggungan</label>
                                                <select id="patient_category_id" name="patient_category_id[]"
                                                    class="form-select form-select-md" data-allow-clear="true" required
                                                    onchange="showStok(this)">
                                                    {{-- <option selected disabled>Pilih</option> --}}
                                                    @foreach ($tanggungans as $tanggungan)
                                                        @if (old('patient_category_id') == $tanggungan->id)
                                                            <option value="{{ $tanggungan->id }}" selected>
                                                                {{ $tanggungan->name ?? '' }}</option>
                                                        @else
                                                            <option value="{{ $tanggungan->id }}">
                                                                {{ $tanggungan->name ?? '' }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label" for="basic-default-name">Harga Satuan</label>
                                                <input type="number" id="harga" name="harga[]" class="form-control"
                                                    value="" required readonly />
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label" for="basic-default-name">Total Harga</label>
                                                <input type="number" name="total_harga[]" id="total_harga"
                                                    class="form-control" value="" required readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 d-flex align-self-center">
                                        <button type="button" class="btn btn-sm btn-dark mx-auto" onclick="tambahInput()"><i
                                                class="bx bx-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <button class="btn btn-dark btn-sm">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endcan
        @can('daftar resep obat')
            <div class="col-sm-12 mt-3 mb-3">
                <table class="table" id="example1">
                    <thead>
                        <tr class="text-nowrap bg-dark">
                            <th>No</th>
                            <th>No Resep</th>
                            <th>Nama Petugas</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal / Jam</th>
                            @canany(['edit resep obat', 'print resep obat'])
                                <th class="text-center">Action</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item->rajalFarmasiObatInvoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invoice->no_faktur ?? '' }}</td>
                                <td>{{ $invoice->user->name ?? '' }}</td>
                                <td>{{ $invoice->patient->name ?? '' }}</td>
                                <td>{{ $invoice->created_at ?? '' }}</td>
                                @canany(['edit resep obat', 'print resep obat'])
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
                                @endcanany
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endcan
        @can('perbarui status farmasi rajal')
            <div class="text-end mt-3">
                <form action="{{ route('rajal/farmasi/update/status.updateStatus', $item->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-success" name="status" value="SELESAI"
                        onclick="return confirm('Yakin Ingin Melanjutkan ? ')">Selesai</button>
                </form>
            </div>
        @endcan
    </div>

    <script>
        function enableMedicine(element) {
            $(element).closest('.row').find('#medicine_id').val('Pilih').trigger('change');
            $(element).closest('.row').find('#stok').val(null);
            $(element).closest('.row').find('#jumlah').val(null);
            $(element).closest('.row').find('#harga').val(null);
            $(element).closest('.row').find('#total_harga').val(null);
        }

        function showStok(element) {
            var unitId = $('#unit_id').val();
            var medicine = $(element).closest('.row').find('.medicineId').val();
            var tanggunganId = $(element).closest('.row').find('#patient_category_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ URL::route('farmasi/obat/get/medicineStok/all.create') }}",
                data: {
                    medicine_id: medicine,
                    unit_id: unitId,
                    tanggungan_id: tanggunganId,
                },
                success: function(data) {
                    if (data.stok && data.harga) {
                        $(element).closest('.row').find('#stok').val(data.stok || 0);
                        $(element).closest('.row').find('#harga').val(data.harga || 0);
                        $(element).closest('.row').find('#jumlah').val(null);
                        $(element).closest('.row').find('#total_harga').val(null);
                    } else {
                        $(element).closest('.row').find('#stok').val(0);
                        $(element).closest('.row').find('#harga').val(0);
                        $(element).closest('.row').find('#jumlah').val(null);
                        $(element).closest('.row').find('#total_harga').val(null);
                    }
                }
            });
        }

        function getTotalHarga(element) {
            const jumlah = $(element).val();
            const harga_satuan = $(element).closest('.row').find('#harga').val();

            const total_harga = jumlah * harga_satuan;
            $(element).closest('.row').find('#total_harga').val(total_harga);
        }

        let count = 1;

        function tambahInput() {
            count++;
            var rowInput = document.getElementById('input-obat');
            var data = `
          <div class="row mt-2">
            <div class="col-10">
              <div class="row">
                <div class="col-sm-6 mb-2">
                  <label for="medicine_id_${count}" class="form-label">Nama Obat</label>
                  <select id="medicine_id_${count}" name="medicine_id[]" class="select4 form-select form-select-sm medicineId" data-allow-clear="true" onchange="showStok(this)" required>
                    <option selected disabled>Pilih</option>
                    @foreach ($dataObat as $obat)
                          <option value="{{ $obat->id }}">{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-3">
                  <label class="form-label" for="basic-default-name">Stock</label>
                  <input type="number" id="stok" class="form-control" value="" required disabled />
                </div>
                <div class="col-sm-3">
                  <label class="form-label" for="basic-default-name">Jumlah</label>
                  <input type="number" class="form-control" name="jumlah[]" id="jumlah" onkeyup="getTotalHarga(this)" required />
                </div>
                <div class="col-sm-4 mb-2">
                  <label for="patient_category_id" class="form-label">Tanggungan</label>
                  <select id="patient_category_id" name="patient_category_id[]" class="form-select form-select-md" data-allow-clear="true" required onchange="showStok(this)">
                    @foreach ($tanggungans as $tanggungan)
                        @if (old('patient_category_id') == $tanggungan->id)
                          <option value="{{ $tanggungan->id }}" selected>{{ $tanggungan->name ?? '' }}</option>
                        @else
                          <option value="{{ $tanggungan->id }}">{{ $tanggungan->name ?? '' }}</option>
                        @endif
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="form-label" for="basic-default-name">Harga Satuan</label>
                  <input type="number" id="harga" name="harga[]" class="form-control" value="" required readonly />
                </div>
                <div class="col-sm-4">
                  <label class="form-label" for="basic-default-name">Total Harga</label>
                  <input type="number" name="total_harga[]" id="total_harga" class="form-control" value="" required readonly />
                </div>
              </div>
            </div>
            <div class="col-sm-2 d-flex align-self-center">
              <button type="button" class="btn btn-sm btn-danger mx-auto" onclick="hapusInput(this)"><i class="bx bx-minus"></i></button>
            </div>
          </div>
        `;

            rowInput.insertAdjacentHTML('beforeend', data);
            $('#medicine_id_' + count).select2();
        }

        function hapusInput(button) {
            var inputToRemove = button.parentNode.parentNode;
            inputToRemove.parentNode.removeChild(inputToRemove);
        }
    </script>
@endsection
