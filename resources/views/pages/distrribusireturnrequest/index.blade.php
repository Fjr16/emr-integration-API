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
  
  <form action="{{ route('farmasi/obat/distribusi/return/request.store') }}" method="POST">
    @csrf
    <div class="d-flex">
      <h4 class="align-self-center m-0">Return Obat Ke Gudang</h4>
    </div>
    <hr class="m-0 mt-2 mb-3">
    <div class="row mb-3">
      <label for="select2Basic" class="col-sm-2 col-form-label">Dari Unit</label>
      <div class="col-sm-10">
        <select id="select2Basic" class="select2 form-select form-select-sm" data-allow-clear="true">
          <option value="{{ Auth::user()->unit_category_id }}" selected>{{ Auth::user()->unitCategory->unit->name }} - {{ Auth::user()->unitCategory->unitCategoryPivot->name }}</option>
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <label for="select2Basic" class="col-sm-2 col-form-label">Ke Unit</label>
      <div class="col-sm-10">
        <select id="unit_category_id" name="unit_category_id" class="select2 form-select form-select-sm" data-allow-clear="true">
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
    <div class="row mb-3">
      <label for="select2Basic" class="col-sm-2 col-form-label">Nama Obat / Alkes</label>
      <div class="col-sm-10">
        <select id="medicine_id" name="medicine_id" class="select2 form-select form-select-sm" data-allow-clear="true">
          <option selected disabled>Pilih</option>
          @foreach ($medicines as $medicine)
              @if (old('medicine_id') == $medicine->id)
                <option value="{{ $medicine->id }}" selected>{{ $medicine->kode }}/{{ $medicine->name }}</option>
              @else
                <option value="{{ $medicine->id }}">{{ $medicine->kode }}/{{ $medicine->name }}</option>
              @endif
          @endforeach
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label" for="basic-default-name">Harga Satuan</label>
      <div class="col-sm-10">
          <input type="text" class="form-control" name="harga" value="{{ old('harga') }}" required/>
      </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label" for="basic-default-name">Nomor Batch</label>
      <div class="col-sm-3">
          <input type="text" class="form-control" name="no_batch" value="{{ old('no_batch') }}" required/>
      </div>
      <label class="col-sm-2 col-form-label" for="basic-default-name">Production Date</label>
      <div class="col-sm-2">
          <input type="date" name="production_date" class="form-control form-control-sm" id="basic-default-name" value="{{ old('production_date') }}" required />
      </div>
      <label class="col-sm-1 col-form-label" for="basic-default-name">Expire Date</label>
      <div class="col-sm-2">
          <input type="date" name="exp_date" class="form-control form-control-sm" id="basic-default-name" value="{{ old('exp_date') }}" required />
      </div>
    </div>
    <div class="row mb-3">
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Jumlah Obat</label>
        <div class="col-sm-2">
            <input type="text" id="jumlah_awal" class="form-control form-control-sm" value="{{ old('jumlah_awal') }}" required />
        </div>
        <label class="col-sm-1 col-form-label form-label-sm" for="basic-default-name">Satuan Obat</label>
          <div class="col-sm-3">
            <select class="form-select form-select-sm" id="satuan_awal" aria-label="Default select example">
                <option selected disabled>Pilih</option>
                @foreach ($satuans as $satuanAwal)
                    @if (old('satuan_awal') == $satuanAwal->name)
                      <option value="{{ $satuanAwal->name }}" selected>{{ $satuanAwal->name }}</option>
                    @else
                      <option value="{{ $satuanAwal->name }}">{{ $satuanAwal->name }}</option>    
                    @endif
                @endforeach
            </select>
          </div>
        <label class="col-sm-1 col-form-label form-label-sm" for="basic-default-name">Konversi Ke</label>
        <div class="col-sm-3">
          <select class="form-select form-select-sm" id="satuan" name="satuan" aria-label="Default select example" onchange="getTotal()">
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
      </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Total Obat</label>
      <div class="col-sm-10">
          <input type="text" id="jumlah" name="jumlah" class="form-control form-control-sm" value="{{ old('jumlah') }}" required readonly />
      </div>
    </div>
    <div class="row justify-content-end mb-3">
      <div class="col-sm-10">
          <button type="submit" class="btn btn-sm btn-dark">Kirim</button>
      </div>
    </div>
  </form>

  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          {{-- <th>Nomor Distribusi</th> --}}
          <th>Dari Unit</th>
          <th>Ke Unit</th>
          <th>Tanggal</th>
          <th>Kode Obat / Alkes</th>
          <th>Nama Obat / Alkes</th>
          <th>Jumlah</th>
          <th class="text-center">Status</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item) 
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          {{-- <td>557757</td> --}}
          <td>{{ $item->medicineDistributionRequest->unitCategory->unit->name }} - {{ $item->medicineDistributionRequest->unitCategory->unitCategoryPivot->name }}</td>
          <td>{{ $item->unitCategory->unit->name }} - {{ $item->unitCategory->unitCategoryPivot->name }}</td>
          <td>{{ $item->created_at }}</td>
          <td>{{ $item->medicineDistributionRequest->medicine->kode }}</td>
          <td>{{ $item->medicineDistributionRequest->medicine->name }}</td>
          <td>{{ $item->medicineDistributionRequest->jumlah }}</td>
          <td>
              <button class="btn btn-sm btn-dark" disabled>{{ $item->status }}</button>
          </td>
          <td>
            <form action="{{ route('farmasi/obat/distribusi/return/request.update', $item->id) }}" method="POST">
              @method('PUT')
              @csrf
              @if ($item->status == 'PENDING')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin membatalkan return ?')" name="status" value="BATAL">Batalkan</button>  
              @elseif($item->status == 'SELESAI')
                <button class="btn btn-sm btn-success" disabled>Return Selesai</button>
              @elseif($item->status == 'DITERIMA')
                <button class="btn btn-sm btn-success" disabled>In Progress</button>
              @elseif($item->status == 'BATAL')
                <button class="btn btn-sm btn-danger" disabled>Return Batal</button>
              @elseif($item->status == 'DITOLAK')
                <button class="btn btn-sm btn-warning" disabled>Return Ditolak</button>
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
  function getTotal() {

    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
      type : 'POST',
      url : "{{ URL::route('farmasi/obat/pembelian.getJumlah') }}",
      data : {
        jumlah_awal : $('#jumlah_awal').val(),
        satuan_awal : $('#satuan_awal').val(),
        satuan : $('#satuan').val()
      },
      success : function(data){
        $('#jumlah').val(data);
      },
      error : function(xhr, status, error) {
        var errorMessage = xhr.responseText;
        var errorDiv = document.getElementById('errorJs');
        errorDiv.innerHTML =  ' <div id="errorMessage" class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content; left: 50%;transform: translate(-50%, -50%);" role="alert" id="errorJs">'+errorMessage+'</div>';
      }
    });
  }
  function showError(errorMessage) {
  
}
</script>
@endsection