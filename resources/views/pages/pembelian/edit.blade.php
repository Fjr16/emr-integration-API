@extends('layouts.backend.main')

@section('content')
@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card mb-4">
  <div class="card-header m-0">
      <h5 class="mb-0 m-0">Edit Pembelian Obat</h5>
  </div>
  <div class="card-body">
    <hr class="m-0 mb-3">
      <form method="POST" action="{{ route('farmasi/obat/pembelian.update', $item->id) }}">
        @method('PUT')
        @csrf
          <div class="row mb-3">
            <label class="col-sm-1 col-form-label form-label-sm" for="basic-default-name">Nama PBF</label>
            <div class="col-sm-5">
              <select class="form-select form-select-sm select2" name="supplier_id" aria-label="Default select example" required>
                <option selected disabled>Pilih</option>
                @foreach ($suppliers as $supplier)
                @if ($item->supplier->id == $supplier->id)
                  <option value="{{ $supplier->id }}" selected>{{ $supplier->name ?? '' }}</option>
                @else
                  <option value="{{ $supplier->id }}">{{ $supplier->name ?? '' }}</option>
                @endif
                @endforeach
              </select>
            </div>
            <label class="col-sm-1 col-form-label form-label-sm" for="basic-default-name">Tanggal</label>
            <div class="col-sm-5">
                <input type="date" name="tanggal" class="form-control form-control-sm" id="basic-default-name" value="{{ $item->tanggal ?? date('Y-m-d') }}" required />
            </div>
          </div>
          <hr>
          {{--  --}}
            @foreach ($item->medicineTransactions as $trans)    
              <div class="row mb-3 dinamic-input">
                <div class="col-11">
                  <div class="row">
                    <div class="col-sm-3">
                      <label for="select2Basic" class="row-sm-1 col-form-label">Nama Obat</label>
                      <select id="medicine_id" name="medicine_id[]" class="select2 form-select" data-allow-clear="true" onchange="getSatuanAwal(this)" required>
                        <option selected disabled>Pilih</option>
                        @foreach ($obats as $obat)
                          @if (old('medicine_id', $trans->medicine_id) == $obat->id)
                            <option value="{{ $obat->id }}" selected>{{ $obat->name }}</option>
                          @else
                            <option value="{{ $obat->id }}">{{ $obat->name }}</option>
                          @endif
                        @endforeach
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Jumlah Obat</label>
                        <input type="number" id="jumlah_awal" class="form-control" value="{{ old('jumlah_awal') }}" onkeyup="getTotal(this)" required disabled/>
                    </div>
                    <div class="col-sm-2">
                        <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Satuan Pembelian</label>
                        <select class="form-select" id="satuan_awal" aria-label="Default select example" onchange="getTotal(this)" disabled>
                            <option selected disabled>Pilih</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                      <label class=" col-form-label form-label-sm" for="basic-default-name">Total Obat</label>
                        <div class="input-group">
                          <input class="form-control" id="jumlah" name="jumlah[]" value="{{ old('jumlah', $trans->jumlah) }}" required readonly></input>
                          <span class="input-group-text" id="satuan-terkecil">{{ $trans->medicine->small_unit ?? '' }}</span>
                        </div>
                    </div>
                    <div class="col-sm-2">
                      <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Total Harga (Rp)</label>
                        <input type="text" id="totalHarga" name="total_harga[]" class="form-control" id="basic-default-name" value="{{ old('total_harga', $trans->total_harga) }}" onkeyup="getHargaSatuan(this)" required disabled/>
                    </div>
                    <div class="col-sm-2">
                      <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Nomor Batch</label>
                      <input type="text" name="no_batch[]" class="form-control" id="basic-default-name" value="{{ old('no_batch', $trans->no_batch) }}" required />
                    </div>
                    <div class="col-sm-2">
                      <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Prod Date</label>
                      <input type="date" name="production_date[]" class="form-control " id="basic-default-name" value="{{ old('production_date', $trans->production_date) }}" required />
                    </div>
                    <div class="col-sm-2">
                      <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Exp Date</label>
                      <input type="date" name="exp_date[]" class="form-control " id="basic-default-name" value="{{ old('exp_date', $trans->exp_date) }}" required />
                    </div>
                    <div class="col-sm-2">
                      <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Pajak (Rp)</label>
                        <input type="text" id="pajak" name="pajak[]" class="form-control" id="basic-default-name" value="{{ old('pajak', $trans->pajak) }}" />
                    </div>
                    <div class="col-sm-1">
                      <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Disc (%)</label>
                        <input type="text" id="diskon_persen" name="diskon_persen[]" class="form-control" id="basic-default-name" onkeyup="hitungDiskon(this)"/>
                    </div>
                    <div class="col-sm-1">
                      <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Disc (Rp)</label>
                        <input type="text" id="diskon" name="diskon[]" class="form-control" id="basic-default-name" value="{{ old('diskon', $trans->diskon) }}" required />
                    </div>
                    <div class="col-sm-2">
                      <label class="col-form-label form-label-sm" for="basic-default-name">Harga Satuan (Rp)</label>
                        <input type="text" id="harga" name="harga[]" class="form-control" id="basic-default-name" value="{{ $trans->harga }}" required readonly/>
                    </div>
                  </div>
                </div>
                @if ($loop->last)
                <div class="col-sm-1 d-flex align-self-center text-center">
                  <br>
                  <button type="button" class="btn btn-sm btn-dark" onclick="tambahInput(this)"><i class="bx bx-plus"></i></button>
                </div>
                @endif
              </div>
            @endforeach
          <hr class="m-0 mt-2 mb-3">
          <div class="row mb-3">
            <label class="col-sm-8 col-form-label form-label-sm" for="basic-default-name">Total (Rp)</label>
            <div class="col-sm-4">
                <input type="text" id="total_kotor" name="total_kotor" class="form-control form-control-sm text-end" id="basic-default-name" value="{{ $item->total_kotor ?? '0' }}" required readonly />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-8 col-form-label form-label-sm" for="basic-default-name">Total Diskon (Rp)</label>
            <div class="col-sm-4">
                <input type="text" id="diskon_faktur" name="diskon_faktur" class="form-control form-control-sm text-end" id="basic-default-name" value="{{ $item->total_diskon ?? '0' }}" required readonly/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-8 col-form-label form-label-sm" for="basic-default-name">Total Pajak (Rp)</label>
            <div class="col-sm-4">
                <input type="text" id="ppn" name="ppn" class="form-control form-control-sm text-end" id="basic-default-name" value="{{ $item->total_pajak ?? '0' }}" required readonly/>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-8 col-form-label form-label-sm" for="basic-default-name">Total Bayar (Rp)</label>
            <div class="col-sm-4">
                <input type="text" id="total_bayar" name="total_bayar" class="form-control form-control-sm text-end" id="basic-default-name" value="{{ $item->total_bayar ?? '0' }}" required readonly />
            </div>
          </div>
          <div class="text-end mt-3 mb-3">
            <button type="button" class="btn btn-sm btn-dark" onclick="sumAll()"><i class="bx bx-bar-chart"></i>Hitung</button>
            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
          </div>
        </form>
  </div>
</div>

<script>
  function hitungDiskon(element){
    diskonPersen = $(element).val();
    totalHarga = $(element).closest('.row').find('#totalHarga').val();
    konversiPersenToRp = totalHarga * diskonPersen / 100;
    $(element).closest('.row').find('#diskon').val(konversiPersenToRp);
  }
  function sumAll(){
    totalKotor = 0;
    totalHargas = document.querySelectorAll('#totalHarga');
    totalHargas.forEach(function(total){
      totalKotor += parseInt(total.value);
    });
    $('#total_kotor').val(totalKotor);

    totalDiskon = 0;
    tDiskons = document.querySelectorAll('#diskon');
    tDiskons.forEach(function(diskon){
      totalDiskon += parseInt(diskon.value);
    });
    $('#diskon_faktur').val(totalDiskon);

    totalPajak = 0;
    tPajaks = document.querySelectorAll('#pajak');
    tPajaks.forEach(function(pajak){
      totalPajak += parseInt(pajak.value);
    });
    $('#ppn').val(totalPajak);

    total_bayar = totalKotor + totalPajak - totalDiskon;
    $('#total_bayar').val(total_bayar);
  }

  var medium_to_small = null,
  big_to_medium = null,
  small_unit = null,
  medium_unit = null;
  big_unit = null;

  function getSatuanAwal(element){
   medicine_id = $(element).val();
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
      type : 'post',
      url : "{{ URL::route('konversi/obat/get/satuan/awal.create') }}",
      data : {
        id : medicine_id,
      },
      success : function(data){
        if (data.message) {
          alert(data.message);
        }else{
          small_unit = data.small_unit ?? null;
          medium_unit = data.medium_unit ?? null;
          big_unit = data.big_unit ?? null;

          var smallUnitContent = data.small_unit != null ? `<option value="${data.small_unit}" selected>${data.small_unit}</option>` : '';
          var mediumUnitContent = data.medium_unit != null ? `<option value="${data.medium_unit}">${data.medium_unit}</option>` : '';
          var bigUnitContent = data.big_unit != null ? `<option value="${data.big_unit}">${data.big_unit}</option>` : '';
          medium_to_small = data.medium_to_small;
          big_to_medium = data.big_to_medium;

          $(element).closest('.row').find('#jumlah_awal').val(1);
          $(element).closest('.row').find('#jumlah_awal').attr('disabled', false);
          $(element).closest('.row').find('#satuan_awal').attr('disabled', false);
          $(element).closest('.row').find('#satuan_awal').html(smallUnitContent + mediumUnitContent + bigUnitContent);
          $(element).closest('.row').find('#satuan-terkecil').text(data.small_unit ?? '-');
          $(element).closest('.row').find('#satuan').html('<option selected disabled>Pilih</option>');
          $(element).closest('.row').find('#satuan').attr('disabled', true);
          $(element).closest('.row').find('#jumlah').val(1);
          $(element).closest('.row').find('#totalHarga').val(null);
          $(element).closest('.row').find('#totalHarga').attr('disabled', false);
          $(element).closest('.row').find('#harga').val(null);
          $(element).closest('.row').find('#diskon_persen').val(null);
          $(element).closest('.row').find('#diskon').val(null);
          $(element).closest('.row').find('#pajak').val(null);
        }
      }
    });
  }

  function getTotal(element) {
    const jml = $(element).closest('.row').find('#jumlah_awal').val();
    const sat_awal = $(element).closest('.row').find('#satuan_awal').val();
    let equals = 1;
    if (sat_awal == medium_unit) {
      equals = medium_to_small;
    }else if(sat_awal == big_unit){
      equals = big_to_medium;
    }
    
    const jumlah = equals * jml;
    $(element).closest('.row').find('#jumlah').val(jumlah);
  }

  function getHargaSatuan(element){
    var total_harga = $(element).val();
    var jumlah_obat = $(element).closest('.row').find('#jumlah').val();

    var harga = total_harga / jumlah_obat;

    $(element).closest('.row').find('#harga').val(harga);
    $(element).closest('.row').find('#diskon_persen').val(null);
    $(element).closest('.row').find('#diskon').val(null);
  }

  let count = 0;
  function tambahInput(element){
    count = count+1;
    var contentToAdd = `
    <hr class="m-0 mt-2 mb-3">
      <div class="col-sm-11">
        <div class="row">
          <div class="col-sm-3">
            <label for="select2Basic" class="row-sm-1 col-form-label">Nama Obat</label>
                  <select id="medicine_id_${count}" name="medicine_id[]" class="form-select" data-allow-clear="true" onchange="getSatuanAwal(this)">
                    <option selected disabled>Pilih</option>
                    @foreach ($obats as $obat)
                      @if (old('medicine_id') == $obat->id)
                        <option value="{{ $obat->id }}" selected>{{ $obat->name }}</option>
                      @else
                        <option value="{{ $obat->id }}">{{ $obat->name }}</option>
                      @endif
                    @endforeach
                  </select>
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Jumlah Obat</label>
              <input type="number" id="jumlah_awal" class="form-control" value="{{ old('jumlah_awal') }}" onkeyup="getTotal(this)" @disabled(true) required />
          </div>
          <div class="col-sm-2">
              <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Satuan Pembelian</label>
              <select class="form-select" id="satuan_awal" aria-label="Default select example" onchange="getTotal(this)" @disabled(true)>
                  <option selected disabled>Pilih</option>
              </select>
          </div>
          <div class="col-sm-3">
            <label class="col-form-label form-label-sm" for="basic-default-name">Total Obat</label>
            <div class="input-group">
              <input class="form-control" id="jumlah" name="jumlah[]" value="{{ old('jumlah') }}"  required readonly></input>
              <span class="input-group-text" id="satuan-terkecil">-</span>
            </div>
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Total Harga (Rp)</label>
                    <input type="text" id="totalHarga" name="total_harga[]" class="form-control" id="basic-default-name" value="{{ old('total_harga') }}" onkeyup="getHargaSatuan(this)" required disabled/>
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Nomor Batch</label>
                  <input type="text" name="no_batch[]" class="form-control" id="basic-default-name" value="{{ old('no_batch') }}" required />
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Prod Date</label>
                  <input type="date" name="production_date[]" class="form-control " id="basic-default-name" value="{{ old('production_date') }}" required />
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Exp Date</label>
                  <input type="date" name="exp_date[]" class="form-control " id="basic-default-name" value="{{ old('exp_date') }}" required />
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Pajak (Rp)</label>
              <input type="text" id="pajak" name="pajak[]" class="form-control" id="basic-default-name" />
          </div>
          <div class="col-sm-1">
                <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Disc (%)</label>
                <input type="text" id="diskon_persen" name="diskon_persen[]" class="form-control" id="basic-default-name" onkeyup="hitungDiskon(this)"/>
            </div>
          <div class="col-sm-1">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Disc (Rp)</label>
              <input type="text" id="diskon" name="diskon[]" class="form-control" id="basic-default-name" value="{{ old('diskon', 0) }}" required />
          </div>
          <div class="col-sm-2">
              <label class="col-form-label form-label-sm" for="basic-default-name">Harga Satuan (Rp)</label>
              <input type="text" id="harga" name="harga[]" class="form-control" id="basic-default-name" value="{{ old('harga') }}" required readonly/>
          </div>
        </div>
      </div>
      <div class="col-sm-1 d-flex align-self-center text-center">
        <br>
        <button type="button" class="btn btn-sm btn-danger" onclick="removeInputDinamic(this)"><i class="bx bx-minus"></i></button>
      </div>
    `;
    dinamicInput(element, contentToAdd, `medicine_id_${count}`, 'Pilih Obat', true);
  }
</script>
@endsection