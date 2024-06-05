@extends('layouts.backend.main')

@section('content')
@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
@if (session()->has('error'))
      <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('error') }}
      </div>
  @endif
<div class="card mb-4">
  <div class="card-header m-0">
      <h5 class="mb-0 m-0">Tambah Return Obat</h5>
  </div>
  <div class="card-body" id="bodyy">
    <hr class="m-0 mb-3">
      <form method="POST" action="{{ route('farmasi/obat/return.store', $faktur->id) }}">
        @csrf
        <div id="containerInput">
          <div class="row mb-3">
            <div class="col-11">
              <div class="row">
                <div class="col-sm-3">
                  <label class="row-sm-1 col-form-label" for="basic-default-name">Dari Unit</label>
                  <select class="form-select select2" id="unit_category_id" name="unit_category_id[]" aria-label="Default select example" onchange="resetJumlah(this)" required>
                      <option selected disabled>Pilih</option>
                      @foreach ($unitCategory as $category)
                      @if (old('unit_category_id') == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->unit->name }} - {{ $category->unitCategoryPivot->name }} </option>
                      @else
                        <option value="{{ $category->id }}">{{ $category->unit->name }} - {{ $category->unitCategoryPivot->name }} </option>
                      @endif
                      @endforeach
                  </select>
                </div>
                <div class="col-sm-3">
                  <label for="select2Basic" class="row-sm-1 col-form-label">Nama Obat</label>
                  <select id="medicine_id" name="medicine_id[]" class="select2 form-select" data-allow-clear="true" onchange="getSatuanAwal(this)" required>
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
                    <input type="text" id="jumlah_awal" class="form-control" value="{{ old('jumlah_awal') }}" onkeyup="enableSatuanAwal(this)" @disabled(true) required />
                </div>
                <div class="col-sm-2">
                    <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Satuan Obat</label>
                    <select class="form-select" id="satuan_awal" aria-label="Default select example" onchange="getSatuan(this)" @disabled(true)>
                        <option selected disabled>Pilih</option>
                        {{-- @foreach ($satuans as $satuanAwal)
                            @if (old('satuan_awal') == $satuanAwal->name)
                              <option value="{{ $satuanAwal->name }}" selected>{{ $satuanAwal->name }}</option>
                            @else
                              <option value="{{ $satuanAwal->name }}">{{ $satuanAwal->name }}</option>    
                            @endif
                        @endforeach --}}
                    </select>
                </div>
                <div class="col-sm-2">
                  <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Konversi Ke</label>
                  <select class="form-select" id="satuan" name="satuan[]" aria-label="Default select example" onchange="getTotal()" @disabled(true)>
                      <option selected disabled>Pilih</option>
                      {{-- @foreach ($satuans as $satuan)
                          @if (old('satuan') == $satuan->name)
                            <option value="{{ $satuan->name }}" selected>{{ $satuan->name }}</option>
                          @else
                            <option value="{{ $satuan->name }}">{{ $satuan->name }}</option>    
                          @endif
                      @endforeach --}}
                  </select>
                </div>
                <div class="col-sm-2">
                  <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Total Obat</label>
                    <input type="text" id="jumlah" name="jumlah[]" class="form-control" value="{{ old('jumlah') }}" required readonly />
                </div>
                <div class="col-sm-2">
                  <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Total Harga Beli</label>
                    <input type="text" name="harga[]" class="form-control" id="basic-default-name" value="{{ old('harga') }}" required />
                </div>
                <div class="col-sm-2">
                  <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Diskon (Rupiah)</label>
                    <input type="text" name="diskon[]" class="form-control" id="basic-default-name" value="" required />
                </div>
                <div class="col-sm-2">
                  <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Nomor Batch</label>
                  <input type="text" name="no_batch[]" class="form-control" id="basic-default-name" value="{{ old('no_batch') }}" required />
                </div>
                <div class="col-sm-2">
                  <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Production Date</label>
                  <input type="date" name="production_date[]" class="form-control" id="basic-default-name" value="{{ old('production_date') }}" required />
                </div>
                <div class="col-sm-2">
                  <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Expired Date</label>
                  <input type="date" name="exp_date[]" class="form-control" id="basic-default-name" value="{{ old('exp_date') }}" required />
                </div>
              </div>
            </div>
            <div class="col-sm-1 d-flex align-self-center text-center">
              <br>
              <button type="button" class="btn btn-sm btn-dark" onclick="tambahInput()"><i class="bx bx-plus"></i></button>
            </div>
          </div>
        </div>
        <hr class="m-0 mt-2 mb-3">

        <div class="text-end mt-3 mb-3">
          <button class="btn btn-sm btn-dark">Simpan</button>
        </div>
      </form>
          <hr class="m-0 mt-2 mb-3">
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr class="text-nowrap bg-dark">
                  <th>No</th>
                  <th>Diterima Unit</th>
                  <th>Nama Obat</th>
                  <th>Batch</th>
                  <th>Production Date</th>
                  <th>Expire</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                  <th>Harga Beli</th>
                  <th>Diskon</th>
                  <th>Total Rp.</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($faktur->medicineTransactions as $transaksi)
                  <tr>
                    <th scope="row">{{ $loop->iteration ?? '' }}</th>
                    <td>{{ $transaksi->unitCategory->unit->name ?? '' }} - {{ $transaksi->unitCategory->unitCategoryPivot->name ?? '' }} </td>
                    <td>{{ $transaksi->medicine->name ?? '' }}</td>
                    <td>{{ $transaksi->no_batch ?? '' }}</td>
                    <td>{{ $transaksi->production_date ?? '' }}</td>
                    <td>{{ $transaksi->exp_date ?? '' }}</td>
                    <td>{{ $transaksi->jumlah ?? '' }}</td>
                    <td>{{ $transaksi->satuan ?? '' }}</td>
                    <td>Rp. {{ number_format($transaksi->harga) ?? '' }}</td>
                    <td>Rp. {{ number_format($transaksi->diskon) ?? '' }}</td>
                    <?php $total =  $transaksi->harga-$transaksi->diskon  ?>
                    <td>
                      Rp. {{ number_format($total) ?? '' }}
                    </td>
                    <td>
                        <form action="{{ route('farmasi/obat/return.destroy', $transaksi->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="dropdown-item"
                                onclick="return confirm('Yakin ingin menghapus data?')"><i
                                    class="bx bx-trash me-1"></i></button>
                        </form>
                    </td>
                  </tr>
                @endforeach

                <tr>
                  <td>Total Kotor</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Rp. {{ number_format($faktur->total_kotor) }}</td>
                  <td></td>
                </tr>
                <tr>
                  <td>PPN</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <?php  $ppn = $faktur->total_kotor*($faktur->ppn/100); ?>
                  <td>Rp. {{ number_format($ppn) }}</td>
                  <td></td>
                </tr>
                <tr>
                  <td>Materai</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Rp. {{ number_format($faktur->materai) }}</td>
                  <td></td>
                </tr>
                <tr>
                  <td>Discount Faktur</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Rp. {{ number_format($faktur->diskon) }}</td>
                  <td></td>
                </tr>
                <tr>
                  <td>Total Bayar</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Rp. {{ number_format($faktur->total_bayar) }}</td>
                  <td></td>
                </tr>
                </tbody>
            </table>
          </div>                  
  </div>
</div>

<script>
  function resetJumlah(element){
    $(element).closest('.row').find('#jumlah_awal').val(null);
    $(element).closest('.row').find('#satuan_awal').html('<option selected disabled>Pilih</option>');
    $(element).closest('.row').find('#satuan_awal').attr('disabled', true);
    $(element).closest('.row').find('#satuan').html('<option selected disabled>Pilih</option>');
    $(element).closest('.row').find('#satuan').attr('disabled', true);
    $(element).closest('.row').find('#jumlah').val(null);
  }
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
        $(element).closest('.row').find('#jumlah_awal').val(null);
        $(element).closest('.row').find('#jumlah_awal').attr('disabled', false);
        $(element).closest('.row').find('#satuan_awal').html(data);
        $(element).closest('.row').find('#satuan').html('<option selected disabled>Pilih</option>');
        $(element).closest('.row').find('#satuan').attr('disabled', true);
        $(element).closest('.row').find('#jumlah').val(null);
      }
    });
  }

  function enableSatuanAwal(element){
    var medicine_id = $(element).closest('.row').find('#medicine_id').val();
    var unitCategoryId = $(element).closest('.row').find('#unit_category_id').val();
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
      type : 'post',
      url : "{{ URL::route('konversi/obat/get/satuan/awal.create') }}",
      data : {
        unit_id : unitCategoryId,
        id : medicine_id,
      },
      success : function(data){
        $(element).closest('.row').find('#satuan_awal').attr('disabled', false);
        $(element).closest('.row').find('#satuan_awal').html(data);
        $(element).closest('.row').find('#satuan').html('<option selected disabled>Pilih</option>');
        $(element).closest('.row').find('#satuan').attr('disabled', true);
        $(element).closest('.row').find('#jumlah').val(null);
      }
    });
  }

  function getSatuan(element){
    var satuan_awal = $(element).val();
    var medicine_id = $(element).closest('.row').find('#medicine_id').val();
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
      type : 'post',
      url : "{{ URL::route('konversi/obat/get/satuan.index') }}",
      data : {
        satuan : satuan_awal,
        id : medicine_id,
      },
      success: function(data){
        $(element).closest('.row').find('#jumlah').val(null);
        $(element).closest('.row').find('#satuan').attr('disabled', false);
        $(element).closest('.row').find('#satuan').html(data);
      }
    })
  }

  function getTotal(element) {
    var jml = $(element).closest('.row').find('#jumlah_awal').val();
    var sat_awal = $(element).closest('.row').find('#satuan_awal').val();
    var sat = $(element).val();

    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
      type : 'POST',
      url : "{{ URL::route('konversi/obat/get.jumlah') }}",
      data : {
        jumlah_awal : jml,
        satuan_awal : sat_awal,
        satuan : sat,
      },
      success : function(data){
        $(element).closest('.row').find('#jumlah').val(data);
      }
    });
  }

  function tambahInput(){
    // Buat elemen-elemen input baru
    var container = document.getElementById('containerInput');
    var newInput = document.createElement('div');
    newInput.classList.add('row', 'mb-3');
    newInput.innerHTML = `
      <div class="col-sm-11">
        <div class="row">
          <div class="col-sm-3">
            <label class="row-sm-1 col-form-label" for="basic-default-name">Unit</label>
                  <select class="form-select select2" id="unit_category_id" name="unit_category_id[]" aria-label="Default select example" onchange="resetJumlah(this)" required>
                      <option selected disabled>Pilih</option>
                      @foreach ($unitCategory as $category)
                      @if (old('unit_category_id') == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->unit->name }} - {{ $category->unitCategoryPivot->name }} </option>
                      @else
                        <option value="{{ $category->id }}">{{ $category->unit->name }} - {{ $category->unitCategoryPivot->name }} </option>
                      @endif
                      @endforeach
                  </select>
          </div>
          <div class="col-sm-3">
            <label for="select2Basic" class="row-sm-1 col-form-label">Nama Obat</label>
                  <select id="medicine_id" name="medicine_id[]" class="select2 form-select" data-allow-clear="true" onchange="getSatuanAwal(this)" required>
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
                    <input type="text" id="jumlah_awal" class="form-control" value="{{ old('jumlah_awal') }}" onkeyup="enableSatuanAwal(this)" @disabled(true) required />
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Satuan Obat</label>
                    <select class="form-select" id="satuan_awal" aria-label="Default select example" onchange="getSatuan(this)" @disabled(true)>
                        <option selected disabled>Pilih</option>
                       
                    </select>
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Konversi Ke</label>
                  <select class="form-select" id="satuan" name="satuan[]" aria-label="Default select example" onchange="getTotal()" @disabled(true)>
                      <option selected disabled>Pilih</option>
                      
                  </select>
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Total Obat</label>
                    <input type="text" id="jumlah" name="jumlah[]" class="form-control" value="{{ old('jumlah') }}" required readonly />
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Total Harga Beli</label>
                    <input type="text" name="harga[]" class="form-control" id="basic-default-name" value="{{ old('harga') }}" required />
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Diskon (Rupiah)</label>
                    <input type="text" name="diskon[]" class="form-control" id="basic-default-name" value="{{ old('diskon') }}" required />
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Nomor Batch</label>
                  <input type="text" name="no_batch[]" class="form-control" id="basic-default-name" value="{{ old('no_batch') }}" required />
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Production Date</label>
                  <input type="date" name="production_date[]" class="form-control " id="basic-default-name" value="{{ old('production_date') }}" required />
          </div>
          <div class="col-sm-2">
            <label class="row-sm-1 col-form-label form-label-sm" for="basic-default-name">Expired Date</label>
                  <input type="date" name="exp_date[]" class="form-control " id="basic-default-name" value="{{ old('exp_date') }}" required />
          </div>
        </div>
      </div>
      <div class="col-sm-1 d-flex align-self-center text-center">
        <br>
        <button type="button" class="btn btn-sm btn-dark" onclick="hapusInput(this)"><i class="bx bx-minus"></i></button>
      </div>
    `;

    // Tambahkan elemen input baru ke dalam container
    container.appendChild(newInput);
  }

  function hapusInput(button) {
    // Hapus elemen input yang sesuai dengan tombol "Hapus" yang diklik
    var inputToRemove = button.parentNode.parentNode;
    inputToRemove.parentNode.removeChild(inputToRemove);
  }
</script>
@endsection