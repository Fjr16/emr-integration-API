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
  <div class="card-header d-flex">
    <div class="col-4 d-flex">
      <h5 class="mb-0">Tambah Variabel Pemeriksaan Labor PK</h5>
    </div>
    <div class="col-8 d-flex">
      <a href="{{ route('laboratorium/pk/category/pemeriksaan.create') }}" class="btn btn-success btn-sm ms-auto">+ Kategori</a>
      <a href="{{ route('laboratorium/pk/tipe/permintaan.create') }}" class="btn btn-sm btn-success mx-2">+ Tipe Permintaan</a>
      <a href="{{ route('laboratorium/pk/tarif/pemeriksaan.index') }}" class="btn btn-success btn-sm ">+ Tarif Pemeriksaan</a>
    </div>
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('laboratorium/pk/variabel/pemeriksaan.store') }}">
      @csrf
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Kategori Pemeriksaan</label>
        <div class="col-sm-10">
          <select name="laboratorium_request_category_master_id" class="select2 form-select" aria-label="Default select example">
            <option selected disabled> Pilih</option>
            @foreach ($data as $item)
              @if (old('laboratorium_request_category_master_id') == $item->id)
                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
              @else
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endif
            @endforeach
          </select>
          @error('laboratorium_request_category_master_id')
            <div class="text-danger">
              *Kategori Pemeriksaan Tidak Boleh Kosong
            </div>
          @enderror
        </div>
      </div>
      <div class="variabelPemeriksaan">
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Variabel Pemeriksaan</label>
          <div class="col-sm-9">
            <input type="text" name="variable[{{ $counter }}][name]" class="form-control" id="basic-default-name" required/>
          </div>
          <div class="col-sm-1 align-self-center">
            <button type="button" class="btn btn-sm btn-dark" onclick="multipleInputVariabel(this)"><i class="bx bx-plus"></i></button>
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Kode ICD</label>
          <div class="col-sm-9">
              <input type="text" name="variable[{{ $counter }}][icd_code]" class="form-control" id="basic-default-name" required />
          </div>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
        </div>
      </div>
    </form>

    <div class="card-header">
      <a href="{{ route('clear/labor/request/hasil') }}" class="btn btn-warning btn-sm ms-auto">Clear</a>
      <a href="{{ route('seed/labor/master.database') }}" class="btn btn-secondary btn-sm ms-auto">Seeding</a>
      <h4 class="mb-0">Daftar Variabel Pemeriksaan Labor PK</h4>
    </div>
    <div class="card-body mx-1">
      <div class="row mb-3">
        @foreach ($data as $item)
        <div class="col-6 mb-4">
            <div class="row">
                <div class="col-8">
                    <h5>{{ $item->name ?? '' }}</h5>
                </div>
                <div class="col-4">
                    <div class="text-end d-flex">
                        <a class="btn btn-sm btn-dark ms-auto" href="{{ route('laboratorium/pk/category/pemeriksaan.edit', $item->id) }}">Edit</a>
                        <form action="{{ route('laboratorium/pk/category/pemeriksaan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin Ingin Menghapus data ?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger mx-2">
                              Hapus
                          </button>
                        </form>
                      </div>
                </div>
            </div>

          @foreach ($item->laboratoriumRequestMasterVariables->where('isActive', true) as $variabel)
          <div class="mt-1 mx-1 d-flex">
              <p class="mb-0">{{ $variabel->name ?? '' }}</p>
              @foreach ($variabel->laboratoriumRequestMasterDetails as $detailVariabel)
                @php
                  $jmlDigitFrom = strlen((string) $detailVariabel->from);
                  $jmlDigitTo = strlen((string) $detailVariabel->to);
                @endphp
                  <small class="mx-3">
                    ({{ $detailVariabel->alias ? $detailVariabel->alias .':' : '' }}
                    @if ($jmlDigitFrom != null)
                      @if ($jmlDigitFrom >= 4)
                        {{ number_format($detailVariabel->from ?? '') }}-
                      @else
                        {{ $detailVariabel->from ?? '' }}-
                      @endif
                    @endif
                    @if ($jmlDigitFrom != null)
                      @if ($jmlDigitFrom >= 4)
                        {{ number_format($detailVariabel->to ?? '') }}
                      @else
                        {{ $detailVariabel->to ?? '' }}
                      @endif
                    @endif
                    {{ $detailVariabel->unit ?? '' }})
                  </small>
              @endforeach
              <div class="ms-auto d-flex">
                <a class="btn btn-sm" href="{{ route('laboratorium/pk/variabel/pemeriksaan.edit', $variabel->id) }}"><i class="text-warning bx bx-edit"></i></a>
                <form action="{{ route('laboratorium/pk/variabel/pemeriksaan.destroy', $variabel->id) }}" method="POST" onsubmit="return confirm('Yakin Ingin Menghapus data ?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm ms-auto">
                      <i class="text-danger bx bx-trash"></i>
                  </button>
                </form>
              </div>
          </div>
          @endforeach
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<script>
  let counter = 0;
  function multipleInputVariabel(element){
    counter++;
    var row = element.closest('.variabelPemeriksaan');
    var div = document.createElement('div');
    div.className = 'variabelPemeriksaan';
    div.innerHTML  = `
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Variabel Pemeriksaan</label>
                <div class="col-sm-9">
                  <input type="text" name="variable[${counter}][name]" class="form-control" id="basic-default-name" required/>
                </div>
                <div class="col-sm-1 align-self-center">
                  <button type="button" class="btn btn-sm btn-danger" onclick="deleteElementMultiple(this)"><i class="bx bx-minus"></i></button>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode ICD</label>
                <div class="col-sm-9">
                    <input type="text" name="variable[${counter}][icd_code]" class="form-control" id="basic-default-name" required />
                </div>
              </div>
                    `;
    row.insertAdjacentElement('afterend', div);
  }

  function deleteElementMultiple(element){
    var row = element.closest('.variabelPemeriksaan');
    row.remove();
  }
</script>
@endsection
