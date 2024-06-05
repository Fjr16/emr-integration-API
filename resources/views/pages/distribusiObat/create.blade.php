@extends('layouts.backend.main')

@section('content')
@if (session()->has('error'))
      <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('error') }}
      </div>
  @endif
<div class="card mb-4">
  <div class="card-header m-0">
      <h5 class="mb-0 m-0">Tambah Distribusi Ke Unit {{ $category->unit->name }} - {{ $category->unitCategoryPivot->name }} </h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('farmasi/obat/distribusi.store') }}">
        @csrf
          <hr class="m-0 mb-3">
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Ke Unit</label>
            <div class="col-sm-10">
              <select class="form-select form-select-sm" name="unit_category_id" aria-label="Default select example">
                <option selected value="{{ $category->id }}">{{ $category->unit->name }} - {{ $category->unitCategoryPivot->name }}</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Tanggal Transaksi</label>
            <div class="col-sm-10">
                <input type="date" name="tanggal" class="form-control form-control-sm" id="basic-default-name" value="{{ $tgl }}" required />
            </div>
          </div>
          <div class="row mb-3">
            <label for="select2Basic" class="col-sm-2 col-form-label">Nama Obat</label>
            <div class="col-sm-10">
              <select id="select2Basic" class="select2 form-select form-select-sm" name="medicine_id" data-allow-clear="true">
                <option selected disabled>Pilih</option>
                  @foreach ($medicines as $medicine)
                  @if (old('medicine_id') == $medicine->id)
                    <option value="{{ $medicine->id }}" selected>{{ $medicine->name }}</option>
                  @else
                    <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>    
                  @endif
              @endforeach
              </select>
            </div>
          </div>
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
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Total Obat</label>
            <div class="col-sm-10">
                <input type="text" id="jumlah" name="jumlah" class="form-control form-control-sm" value="{{ old('jumlah') }}" required readonly />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Harga Satuan</label>
            <div class="col-sm-10">
              <input type="text" name="harga" class="form-control form-control-sm" id="basic-default-name" value="" required />
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Nomor Batch</label>
            <div class="col-sm-3">
              <input type="text" name="no_batch" class="form-control form-control-sm" id="basic-default-name" value="{{ old('no_batch') }}" required />
            </div>
            <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Production Date</label>
            <div class="col-sm-2">
              <input type="date" name="production_date" class="form-control form-control-sm" id="basic-default-name" value="{{ old('production_date') }}" required />
            </div>
            <label class="col-sm-1 col-form-label form-label-sm" for="basic-default-name">Expired Date</label>
            <div class="col-sm-2">
              <input type="date" name="exp_date" class="form-control form-control-sm" id="basic-default-name" value="{{ old('exp_date') }}" required />
            </div>
          </div>
          {{-- <div class="row mb-3">
            <label class="col-sm-2 col-form-label form-label-sm" for="basic-default-name">Nomor Batch</label>
            <div class="col-sm-5">
              <input type="text" name="no_batch" class="form-control form-control-sm" id="basic-default-name" value=""  required />
            </div>
            <label class="col-sm-1 col-form-label form-label-sm" for="basic-default-name">Expire</label>
            <div class="col-sm-4">
                <input type="date" name="exp_date" class="form-control form-control-sm" id="basic-default-name" value="" required />
            </div>
          </div> --}}
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button class="btn btn-sm btn-dark">Simpan</button>
            </div>
          </div>
          <hr class="m-0 mt-2 mb-3">
      </form>
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