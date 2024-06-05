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
<div class="card p-3 mt-5">
  
  <form action="{{ route('farmasi/obat/distribusi/request.store') }}" method="POST">
    @csrf
    <div class="d-flex">
      <h4 class="align-self-center m-0">Distribusi Request</h4>
    </div>
    <div id="containerInput">
    <hr class="m-0 mt-2 mb-3">
    <div class="row mb-3">
      <label for="select2Basic" class="col-sm-2 col-form-label">Dari Unit</label>
      <div class="col-sm-4">
        <select id="select2Basic" class="select2 form-select form-select-sm" data-allow-clear="true">
          <option value="{{ Auth::user()->unit_category_id }}" selected>{{ Auth::user()->unitCategory->unit->name ?? ''}} - {{ Auth::user()->unitCategory->unitCategoryPivot->name ?? ''}}</option>
        </select>
      </div>
      <label for="select2Basic" class="col-sm-2 col-form-label">Ke Unit</label>
      <div class="col-sm-4">
        <select id="unit_category_id" name="unit_category_id" class="select2 form-select form-select-sm" data-allow-clear="true" onchange="clearMedicine()" required>
          <option selected disabled>Pilih</option>
          @foreach ($categories as $category)
              @if (old('unit_category_id') == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->unit->name }} - {{ $category->unitCategoryPivot->name }}</option>
              @else
                <option value="{{ $category->id }}">{{ $category->unit->name }} - {{ $category->unitCategoryPivot->name }}</option>   
              @endif
          @endforeach
        </select>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-3">
        <label for="select2Basic" class="form-label">Nama Obat / Alkes</label>
        <select id="medicine_id" name="medicine_id[]" class="select2 form-select form-select-sm" data-allow-clear="true" onchange="getStok(this)" required>
          <option selected disabled>Pilih</option>
            @foreach ($medicines as $item)              
              @if (old('medicine_id') == $item->id)
                <option selected value="{{ $item->id }}">{{ $item->kode }}/{{ $item->name }}</option>
              @else
                <option value="{{ $item->id }}">{{ $item->kode }}/{{ $item->name }}</option>
              @endif
            @endforeach
        </select>
      </div>
      <div class="col-sm-1">
        <label class="form-label" for="basic-default-name">Stock</label>
        <input type="number" id="stok" class="form-control" value="" required disabled />
      </div>
    
      <div class="col-sm-1">
        <label class="form-label" for="basic-default-name">Jumlah</label>
        <input type="number" class="form-control" id="jumlah_awal" onkeyup="getSatuanAwal(this)" required />
      </div>
      <div class="col-sm-2">
        <label class="form-label" for="basic-default-name">Satuan Obat</label>
        <select class="form-select" id="satuan_awal" aria-label="Default select example" onchange="getSatuan(this)" @disabled(true)>
          <option selected disabled>Pilih</option>
          @foreach ($satuans as $satuan)
              @if (old('satuan') == $satuan->name)
                <option value="{{ $satuan->name }}" selected>{{ $satuan->name }}</option>
              @else
                <option value="{{ $satuan->name }}">{{ $satuan->name }}</option>    
              @endif
          @endforeach
      </select>
      </div>
      <div class="col-sm-2">
        <label class="form-label" for="basic-default-name">Konversi Ke</label>
        <select class="form-select" id="satuan" name="satuan[]" aria-label="Default select example" onchange="getTotal(this)" @disabled(true)>
          <option selected disabled>Pilih</option>
          @foreach ($satuans as $satuan)
              @if (old('satuan') == $satuan->name)
                <option value="{{ $satuan->name }}" selected>{{ $satuan->name }}</option>
              @else
                <option value="{{ $satuan->name }}">{{ $satuan->name }}</option>    
              @endif
          @endforeach
      </select>
      </div>
      <div class="col-sm-2">
        <label class="form-label" for="basic-default-name">Total Obat</label>
        <input type="number" id="jumlah" name="jumlah[]" class="form-control" required readonly/>
      </div>
      <div class="col-sm-1 d-flex align-self-center">
        <button class="btn btn-sm btn-dark mx-auto" onclick="tambahInput()"><i class="bx bx-plus"></i></button>
      </div>
    </div>
    <hr>
  </div>
    <div class="text-end mb-3">
      <button type="submit" class="btn btn-sm btn-dark me-3">Kirim</button>
    </div>
  </form>

  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Dari Unit</th>
          <th>Ke Unit</th>
          <th>Tanggal</th>
          <th>Kode Obat / Alkes</th>
          <th>Nama Obat / Alkes</th>
          <th>Jumlah</th>
          <th>Satuan</th>
          <th class="text-center">Status</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item) 
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $item->unitCategory->unit->name }} - {{ $item->unitCategory->unitCategoryPivot->name }}</td>
          <td>{{ $item->medicineDistributionResponse->unitCategory->unit->name }} - {{ $item->medicineDistributionResponse->unitCategory->unitCategoryPivot->name }}</td>
          <td>{{ $item->created_at }}</td>
          <td>
            <table>
          @foreach ($item->medicineDistributionDetails as $detail)
            <tr>
              <td>{{ $detail->medicine->kode }}</td>
            </tr>
            @endforeach
            </table>
          </td>
          <td>
            <table>
          @foreach ($item->medicineDistributionDetails as $detail)
            <tr>
              <td>{{ $detail->medicine->name }}</td>
            </tr>
            @endforeach
            </table>
          </td>
          <td>
            <table>
          @foreach ($item->medicineDistributionDetails as $detail)
            <tr>
              <td>{{ $detail->jumlah }}</td>
            </tr>
            @endforeach
            </table>
          </td>
          <td>
            <table>
          @foreach ($item->medicineDistributionDetails as $detail)
            <tr>
              <td>{{ $detail->satuan }}</td>
            </tr>
            @endforeach
            </table>
          </td>
          <td>
            @if ($item->status == 'DITERIMA')
              <button class="btn btn-sm btn-dark" disabled>Dalam Pengantaran</button>
            @else
              <button class="btn btn-sm btn-dark" disabled>{{ $item->medicineDistributionResponse->status }}</button>
            @endif
          </td>
          <td>
            <form action="{{ route('farmasi/obat/distribusi/request.update', $item->medicineDistributionResponse->id) }}" method="POST">
              @method('PUT')
              @csrf
              @if ($item->status == 'PENDING')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin membatalkan request ?')" name="status" value="BATAL">Batalkan</button>  
              @elseif($item->status == 'SELESAI')
                <button class="btn btn-sm btn-success" disabled>Distribusi Selesai</button>
              @elseif($item->status == 'DITERIMA')
                <button class="btn btn-sm btn-success" onclick="return confirm('Status selesai jika anda telah menerima barang, Apakah anda ingin melanjutkan ?')" name="status" value="SELESAI">Selesai</button>
              @elseif($item->status == 'BATAL')
                <button class="btn btn-sm btn-danger" disabled>Distribusi Batal</button>
              @elseif($item->status == 'DITOLAK')
                <button class="btn btn-sm btn-warning" disabled>Distribusi Ditolak</button>
              @endif
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
  
  function clearMedicine(){

    $('#medicine_id').each(function(){
      $(this).val('Pilih').trigger('change');
    })

    var medicineAll = document.querySelectorAll('#medicine_id');
    medicineAll.forEach(function(select){
      select.value = 'Pilih';
      select.dispatchEvent(new Event('change'));
    });
  }

  function getSatuanAwal(element){
    var medicine_id = $(element).closest('.row').find('#medicine_id').val();
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
        $(element).closest('.row').find('#satuan').attr('disabled', false);
        $(element).closest('.row').find('#satuan').html(data);
        $(element).closest('.row').find('#jumlah').val(null);

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

  function getStok(element){
    var id_obat = $(element).val();
    var id_category = $('#unit_category_id').val();
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
      type : 'POST',
      url : "{{ URL::route('farmasi/obat/get/stok.index') }}",
      data : {
        medicine_id : id_obat,
        unit_category_id : id_category,
      },
      success:function (data){
        if(data){
          $(element).closest('.row').find('#satuan_awal').html('<option selected disabled>Pilih<option>');
          $(element).closest('.row').find('#satuan_awal').attr('disabled', true);
          $(element).closest('.row').find('#satuan').html('<option selected disabled>Pilih<option>');
          $(element).closest('.row').find('#satuan').attr('disabled', true);
          $(element).closest('.row').find('#jumlah_awal').val(null);
          $(element).closest('.row').find('#jumlah').val(null);
          $(element).closest('.row').find('#stok').val(data);
        }else{
          $(element).closest('.row').find('#satuan_awal').html('<option selected disabled>Pilih<option>');
          $(element).closest('.row').find('#satuan_awal').attr('disabled', true);
          $(element).closest('.row').find('#satuan').html('<option selected disabled>Pilih<option>');
          $(element).closest('.row').find('#satuan').attr('disabled', true);
          $(element).closest('.row').find('#jumlah_awal').val(null);
          $(element).closest('.row').find('#jumlah').val(null);
          $(element).closest('.row').find('#stok').val(0);
        }
      }
    })
  }

  function tambahInput(){
    var container = document.getElementById('containerInput');
    var newInput = document.createElement('div');
    newInput.classList.add('row');
    newInput.innerHTML = `
      <div class="col-sm-3">
        <label for="select2Basic" class="form-label">Nama Obat / Alkes</label>
        <select id="medicine_id" name="medicine_id[]" class="select2 form-select form-select-sm" data-allow-clear="true" onchange="getStok(this)" required>
          <option selected disabled>Pilih</option>
          @foreach ($medicines as $item)              
              @if (old('medicine_id') == $item->id)
                <option selected value="{{ $item->id }}">{{ $item->kode }}/{{ $item->name }}</option>
              @else
                <option value="{{ $item->id }}">{{ $item->kode }}/{{ $item->name }}</option>
              @endif
            @endforeach
        </select>
      </div>
      <div class="col-sm-1">
        <label class="form-label" for="basic-default-name">Stock</label>
        <input type="number" id="stok" class="form-control" value="" required disabled />
      </div>
    
      <div class="col-sm-1">
        <label class="form-label" for="basic-default-name">Jumlah</label>
        <input type="number" class="form-control" id="jumlah_awal" onkeyup="getSatuanAwal(this)" required />
      </div>
      <div class="col-sm-2">
        <label class="form-label" for="basic-default-name">Satuan Obat</label>
        <select class="form-select" id="satuan_awal" aria-label="Default select example" onchange="getSatuan(this)" @disabled(true)>
          <option selected disabled>Pilih</option>
          @foreach ($satuans as $satuan)
              @if (old('satuan') == $satuan->name)
                <option value="{{ $satuan->name }}" selected>{{ $satuan->name }}</option>
              @else
                <option value="{{ $satuan->name }}">{{ $satuan->name }}</option>    
              @endif
          @endforeach
      </select>
      </div>
      <div class="col-sm-2">
        <label class="form-label" for="basic-default-name">Konversi Ke</label>
        <select class="form-select" id="satuan" name="satuan[]" aria-label="Default select example" onchange="getTotal(this)" @disabled(true)>
          <option selected disabled>Pilih</option>
          @foreach ($satuans as $satuan)
              @if (old('satuan') == $satuan->name)
                <option value="{{ $satuan->name }}" selected>{{ $satuan->name }}</option>
              @else
                <option value="{{ $satuan->name }}">{{ $satuan->name }}</option>    
              @endif
          @endforeach
      </select>
      </div>
      <div class="col-sm-2">
        <label class="form-label" for="basic-default-name">Total Obat</label>
        <input type="number" id="jumlah" name="jumlah[]" class="form-control" required readonly/>
      </div>
      <div class="col-sm-1 d-flex align-self-center">
        <button type="button" class="btn btn-sm btn-dark" onclick="hapusInput(this)"><i class="bx bx-minus"></i></button>
      </div>`;

    container.appendChild(newInput);
  }
  function hapusInput(button) {
    // Hapus elemen input yang sesuai dengan tombol "Hapus" yang diklik
    var inputToRemove = button.parentNode.parentNode;
    inputToRemove.parentNode.removeChild(inputToRemove);
  }
</script>
@endsection