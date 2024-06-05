@extends('layouts.backend.main')

@section('content')
@if (session()->has('error'))
      <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('error') }}
      </div>
  @endif
  <div class="row">
    <form action="{{ route('rajal/farmasi/update', $item->id) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="col-sm-12">
      <div class="card p-3">
        <h6 class="m-0 mb-3">Edit Faktur Obat</h6>
          <table class="table">
            <thead>
              <tr class="text-nowrap bg-dark">
                <th class="text-center">No</th>
                <th style="width: 250px">Nama Obat</th>
                <th class="text-center">Stock</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Harga Satuan</th>
                <th class="text-center">Total Harga</th>
                <th class="text-center">Tanggungan</th>
                {{-- <th class="text-center">Action</th> --}}
              </tr>
            </thead>
            <tbody id="input-obat">
              <input type="hidden" id="unit_id" name="unit_id" value="{{ auth()->user()->unitCategory->unit->id }}">
                @foreach ($item->rajalFarmasiObatDetails as $detail)    
                <tr id="row">
                <td>
                    <input type="hidden" value="{{ $detail->id }}" name="detail_id[]">
                    {{ $loop->iteration }}
                </td>
                  <td>
                    <select id="medicine_id" name="medicine_id[]" class="form-select form-select-md medicineId" data-allow-clear="true" onchange="showStok(this)" required>
                        <option selected disabled>Pilih</option>
                        @foreach ($dataObat as $obat)
                            @if (old('medicine_id', $detail->medicine_id) == $obat->id)
                              <option value="{{ $obat->id }}" selected>{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                            @else
                              <option value="{{ $obat->id }}">{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                            @endif
                        @endforeach
                      </select>
                  </td>
                  <td>
                    <input type="number" id="stok" class="form-control" value="{{ $detail->medicineStok->stok ?? '' }}" required disabled />
                  </td>
                  <td>
                    <input type="number" class="form-control" name="jumlah[]" id="jumlah" value="{{ $detail->jumlah ?? '' }}" onkeyup="getTotalHarga(this)" required />
                  </td>
                  <td>
                    <input type="number" id="harga" name="harga[]" class="form-control" value="{{ $detail->harga_satuan ?? '' }}" required readonly />
                  </td>
                  <td>
                    <input type="number" name="total_harga[]" id="total_harga" value="{{ $detail->total_harga ?? '' }}" class="form-control" value="" required readonly />
                  </td>
                  <td>
                    <select id="patient_category_id" name="patient_category_id[]" class="form-select form-select-md" data-allow-clear="true" required onchange="showStok(this)">
                        <option selected disabled>Pilih</option>
                        @foreach ($tanggungans as $tanggungan)
                            @if (old('patient_category_id', $detail->patient_category_id) == $tanggungan->id)
                              <option value="{{ $tanggungan->id }}" selected>{{ $tanggungan->name ?? '' }}</option>
                            @else
                              <option value="{{ $tanggungan->id }}">{{ $tanggungan->name ?? '' }}</option>
                            @endif
                        @endforeach
                      </select>
                  </td>
                  {{-- <td class="text-center">
                    <button type="button" class="btn btn-sm btn-dark mx-auto" onclick="tambahInput()" ><i class="bx bx-plus"></i></button>
                  </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end m-4">
            <button class="btn btn-success btn-sm">Simpan</button>
        </div>
      </div>
    </div>
    </form>
  </div>

  <script>

  function enableMedicine(element){
    $(element).closest('#row').find('#medicine_id').val('Pilih').trigger('change');
    $(element).closest('#row').find('#stok').val(null);
    $(element).closest('#row').find('#jumlah').val(null);
    $(element).closest('#row').find('#harga').val(null);
    $(element).closest('#row').find('#total_harga').val(null);
  }

  function showStok(element){
      var unitId = $('#unit_id').val();
      var medicine = $(element).closest('#row').find('.medicineId').val();
      var tanggunganId = $(element).closest('#row').find('#patient_category_id').val();
      $.ajaxSetup({
        headers : {
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type : 'POST',
        url : "{{ URL::route('farmasi/obat/get/medicineStok/all.create') }}",
        data : {
          medicine_id : medicine,
          unit_id : unitId,
          tanggungan_id : tanggunganId,
        },
        success :function(data){
          if(data.stok && data.harga){
            $(element).closest('#row').find('#stok').val(data.stok || 0);
            $(element).closest('#row').find('#harga').val(data.harga || 0);
            $(element).closest('#row').find('#jumlah').val(null);
            $(element).closest('#row').find('#total_harga').val(null);
          }else{
            $(element).closest('#row').find('#stok').val(0);
            $(element).closest('#row').find('#harga').val(0);
            $(element).closest('#row').find('#jumlah').val(null);
            $(element).closest('#row').find('#total_harga').val(null);
          }
        }
      });
  }

    function getTotalHarga(element){
      const jumlah = $(element).val();
      const harga_satuan = $(element).closest('#row').find('#harga').val();

      const total_harga = jumlah*harga_satuan;
      $(element).closest('#row').find('#total_harga').val(total_harga);
    }
  </script>
@endsection