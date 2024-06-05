@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Konversi</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('farmasi/obat/konversi.store') }}">
          @csrf
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Kode / Nama Obat</label>
              <div class="col-sm-10">
                <select class="form-select select2" id="medicine_id" name="medicine_id" aria-label="Default select example" onchange="getSatuan(this)">
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
              <label class="col-sm-2 col-form-label" for="basic-default-name">Dari Satuan</label>
              <div class="col-sm-10">
                <select class="form-select" name="unit_from" aria-label="Default select example">
                    <option selected disabled>Pilih</option>
                    @foreach ($data as $item)
                        @if (old('unit_from') == $item->name)
                          <option value="{{ $item->name }}" selected>{{ $item->name }}</option>
                        @else
                          <option value="{{ $item->name }}">{{ $item->name }}</option>    
                        @endif
                    @endforeach
                </select>
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Satuan Obat</label>
              <div class="col-sm-10">
                <select class="form-select" id="unit_to" name="unit_to" aria-label="Default select example" @disabled(true)>
                    <option selected disabled>Pilih</option>
                </select>
              </div>
          </div>
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Nilai</label>
              <div class="col-sm-10">
                  <input type="number" name="nilai" class="form-control" id="basic-default-name" value="{{ old('nilai') }}" required />
              </div>
          </div>
          <div class="row justify-content-end">
              <div class="col-sm-10">
                  <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
              </div>
          </div>
      </form>
  </div>
</div>

<script>
  function getSatuan(element){
    var medicine_id = $(element).closest('.row').find('#medicine_id').val();
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
      type : 'post',
      url : "{{ URL::route('farmasi/obat/konversi.show') }}",
      data : {
        id : medicine_id,
      },
      success:function(data){
        $('#unit_to').attr('disabled', false);
        $('#unit_to').html(data);
      }
    });
  }
</script>
@endsection