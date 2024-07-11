@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Master Obat</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('farmasi/obat.store') }}">
        @csrf
        <div class="row">
          <div class="col-5">
            <div class="row mb-3">
              <div class="col-12">
                <label class="form-label" for="basic-default-name">Kode Obat</label>
                <input type="text" name="kode" class="form-control" id="basic-default-name" value="" required />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <label class="form-label" for="basic-default-name">Nama Obat</label>
                <input type="text" name="name" class="form-control" id="basic-default-name" value="" required />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <label class="form-label" for="basic-default-name">Jenis Obat</label>
                <select class="form-select" name="medicine_type_id" aria-label="Default select example">
                    <option selected disabled>Pilih</option>
                    @foreach ($jenis as $type)
                        @if (old('medicine_type_id') == $type->id)
                          <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                        @else
                          <option value="{{ $type->id }}">{{ $type->name }}</option>    
                        @endif
                    @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <label class="form-label" for="basic-default-name">Golongan Obat</label>
                <select class="form-select" name="medicine_category_id" aria-label="Default select example">
                    <option selected disabled>Pilih</option>
                    @foreach ($golongan as $category)
                        @if (old('medicine_category_id') == $category->id)
                          <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                          <option value="{{ $category->id }}">{{ $category->name }}</option>    
                        @endif
                    @endforeach
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <label for="select2Basic" class="form-label">Jenis Sediaan</label>
                <select id="select2Basic" class="select2 form-select" name="medicine_form_id" data-allow-clear="true">
                  <option selected disabled>Pilih</option>
                    @foreach ($sediaan as $form)
                      @if (old('medicine_form_id') == $form->id)
                        <option value="{{ $form->id }}" selected>{{ $form->name }}</option>
                      @else
                        <option value="{{ $form->id }}">{{ $form->name }}</option>    
                      @endif
                    @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="col-7">
            <div class="row mb-3">
              <div class="col-12">
                <label for="select2Basic" class="form-label">Satuan Terkecil</label>
                <input type="text" class="form-control" name="small_unit" id="satuan_terkecil" placeholder="Satuan Terkecil Obat">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <label class="form-label">Satuan Sedang</label>
                <div class="input-group">
                  <input type="text" name="medium_unit" id="satuan_sedang" class="form-control" placeholder="Satuan Sedang" />
                  <span class="input-group-text" id="get-satuan-sedang-awal">-</span>
                  
                  <input type="text" class="form-control" id="small_to_medium" name="small_to_medium" placeholder="nilai konversi ke satuan terkecil"/>
                  <span class="input-group-text" id="get-satuan-kecil">-</span>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-12">
                <label class="form-label">Satuan Terbesar</label>
                <div class="input-group">
                  <input type="text" name="big_unit" id="satuan_terbesar" class="form-control" placeholder="Satuan Terbesar" />
                  <span class="input-group-text" id="get-satuan-besar">-</span>
  
                  <input type="text" class="form-control" id="medium_to_big" name="medium_to_big" placeholder="nilai konversi ke satuan sedang"/>
                  <span class="input-group-text" id="get-satuan-sedang-akhir">-</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 text-start">
                  <button type="submit" class="btn btn-md btn-dark">Simpan</button>
              </div>
            </div>
          </div>
        </div>
      </form>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function(){
    var satuanTerkecil = document.getElementById('satuan_terkecil');
    var satuanSedang = document.getElementById('satuan_sedang');
    var satuanTerbesar = document.getElementById('satuan_terbesar');

    var setSatuanKecil = document.getElementById('get-satuan-kecil');
    var setSatuanSedang1 = document.getElementById('get-satuan-sedang-awal');
    var setSatuanSedang2 = document.getElementById('get-satuan-sedang-akhir');
    var setSatuanBesar = document.getElementById('get-satuan-besar');


    satuanTerkecil.addEventListener('keyup', function(){
        setSatuanKecil.textContent = satuanTerkecil.value;
    });
    satuanTerbesar.addEventListener('keyup', function(){
        setSatuanBesar.textContent = '1 ' + satuanTerbesar.value + ' =';
    });
   
    satuanSedang.addEventListener('keyup', function(){
      setSatuanSedang1.textContent = '1 ' + satuanSedang.value + ' =';
      setSatuanSedang2.textContent = satuanSedang.value;
    });
  })
</script>
@endsection