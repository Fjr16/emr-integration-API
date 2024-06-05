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
    <div class="col-11 d-flex">
      <h5 class="mb-0">Edit Variabel Pemeriksaan Labor PK</h5>
    </div>
    <div class="col-1 text-end">
      <a class="btn btn-sm btn-success" href="{{ route('laboratorium/pk/variabel/pemeriksaan.create') }}">Kembali</a>
    </div>
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('laboratorium/pk/variabel/pemeriksaan.update', $item->id) }}">
      @csrf
      @method('PUT')
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Kategori Pemeriksaan</label>
        <div class="col-sm-10">
          <select name="laboratorium_request_category_master_id" class="select2 form-select" aria-label="Default select example">
            <option selected disabled> Pilih</option>
            @foreach ($categories as $category)
              @if (old('laboratorium_request_category_master_id', $item->laboratoriumRequestCategoryMaster->id) == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
              @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-default-name">Variabel Pemeriksaan</label>
        <div class="col-sm-10">
          <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name', $item->name) }}" required />
        </div>
          @error('name')
          <div class="text-danger">
            *Nama Variabel Pemeriksaan Tidak Boleh Kosong
          </div>
          @enderror
      </div>
      <div class="row mb-5">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
        </div>
      </div>
    </form>

      <div class="row mb-3">
        <h5 class="mb-0">Kondisi Normal <span class="text-primary">{{ $item->name ?? '' }}</span>:</h5>
      </div>
      <form method="POST" action="{{ route('laboratorium/pk/kondisi/normal/variabel.store', $item->id) }}">
        @csrf
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Kategori</label>
            <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name') }}"/>
            </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Alias</label>
            <div class="col-sm-10">
            <input type="text" name="alias" class="form-control" id="basic-default-name" value="{{ old('alias') }}"/>
            </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Nilai Kondisi Normal</label>
            <div class="col-sm-3">
              <input type="number" name="from" class="form-control" id="basic-default-name" value="{{ old('from') }}" required />
            </div>
            <div class="col-sm-1 align-self-center"><small>SAMPAI</small></div>
            <div class="col-sm-3">
              <input type="number" name="to" class="form-control" id="basic-default-name" value="{{ old('to') }}" required />
            </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Satuan</label>
            <div class="col-sm-10">
            <input type="text" name="unit" class="form-control" id="basic-default-name" value="{{ old('unit') }}" required />
            </div>
        </div>
        <div class="row mb-3">
          <div class="col-sm-2"></div>
          <div class="col-sm-10">
              <button type="submit" class="btn btn-sm btn-success">Simpan</button>
          </div>
        </div>
      </form>

      <hr class="m-0 mt-5 mb-3">
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr class="text-nowrap bg-dark">
              <th>No</th>
              <th>Kategori</th>
              <th>Alias</th>
              <th>Kondisi Normal</th>
              <th>Satuan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $detail)
              <tr>
                <th class="text-dark" scope="row">{{ $loop->iteration }}</th>
                <td>{{ $detail->name ?? '-' }}</td>
                <td>{{ $detail->alias ?? '-' }}</td>
                <td>
                  {{ $detail->from ?? '' }} - {{ $detail->to ?? '' }}
                </td>
                <td>{{ $detail->unit ?? '-' }}</td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('laboratorium/pk/kondisi/normal/variabel.edit', $detail->id) }}">
                            <i class="bx bx-edit-alt me-1"></i>
                            Edit
                        </a>
                        <form action="{{ route('laboratorium/pk/kondisi/normal/variabel.destroy', $detail->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                            <button type="submit" class="dropdown-item" onclick="return confirm('Yakin ingin menghapus data?')"><i class="bx bx-trash me-1"></i>Hapus</button>
                        </form>
                    </div>
                </div>
                </td>
              </tr>
              @endforeach
            </tbody>
        </table>
      </div>
  </div>
</div>

<script>
  function multipleInputDetail(element){
    var row = element.closest('.row');
    var div = document.createElement('div');
    div.className = 'row mb-3';
    div.innerHTML = `
        <div class="col-sm-2"></div>
        <div class="col-sm-9">
          <input type="text" name="keterangan[]" class="form-control" id="basic-default-name"/>
        </div>
        <div class="col-sm-1 align-self-center">
          <button type="button" class="btn btn-sm btn-danger" onclick="multipleInputDelete(this)"><i class="bx bx-minus"></i></button>
        </div>
                    `;
    row.insertAdjacentElement('afterend', div);
  }

  function multipleInputDelete(element){
    var row = element.closest('.row');
    row.remove();
  }

</script>
@endsection
