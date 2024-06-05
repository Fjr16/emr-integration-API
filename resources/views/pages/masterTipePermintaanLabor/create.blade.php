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
      <h5 class="mb-0">Tambah Tipe Permintaan Labor PK</h5>
    </div>
    <div class="col-1 text-end">
      <button class="btn btn-sm btn-success" onclick="history.back()">Kembali</button>
    </div>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('laboratorium/pk/tipe/permintaan.store') }}">
          @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Tipe</label>
              <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name') }}" required />
              </div>
          </div>
          <div class="row mb-3">
              <div class="col-sm-2"></div>
              <div class="col-sm-10 d-flex">
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="0" name="isPrioritas" id="flexRadioDefault1" checked>
                  <label class="form-check-label" for="flexRadioDefault1">
                    Non Prioritas (Reguler)
                  </label>
                </div>
                <div class="form-check mx-4">
                  <input class="form-check-input" type="radio" value="1" name="isPrioritas" id="flexRadioDefault2">
                  <label class="form-check-label" for="flexRadioDefault2">
                    Prioritas (Cito)
                  </label>
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
      <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-nowrap">
            <table class="table">
            <thead>
                <tr class="text-nowrap bg-dark">
                <th>No</th>
                <th>Nama</th>
                <th>Prioritas / Non Prioritas</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->name ?? '' }}</td>
                    <td>{{ ($item->isPrioritas == true) ? 'Prioritas' : 'Non Prioritas' }}</td>
                    <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('laboratorium/pk/tipe/permintaan.edit', $item->id) }}">
                                <i class="bx bx-edit-alt me-1"></i>
                                Edit
                            </a>
                            <form action="{{ route('laboratorium/pk/tipe/permintaan.destroy', $item->id) }}" method="POST">
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
@endsection
