@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif

<div class="d-flex">
    <h4 class="align-self-center m-0">Sub Unit</h4>
    <a href="{{ route('sub-unit.create') }}" class="btn btn-success ms-auto btn-sm m-0">+ Tambah Sub Unit</a>
  </div>
  <hr class="m-0 mt-2 mb-3">
<div class="table-responsive text-nowrap">
<table class="table">
    <thead>
    <tr class="text-nowrap bg-dark">
        <th>No</th>
        <th>Nama Sub Unit</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($sub_unit as $sub)
        <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $sub->name }}</td>
        <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                    data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('sub-unit.edit', $sub->id) }}">
                        <i class="bx bx-edit-alt me-1"></i>
                        Edit
                    </a>
                    <form action="{{ route('sub-unit.destroy', $sub->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item"
                            onclick="return confirm('Yakin ingin menghapus data?')"><i
                                class="bx bx-trash me-1"></i>Hapus</button>
                    </form>
                </div>
            </div>
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<hr class="m-0 mt-2 mb-3">

<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Unit</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('unit.store') }}">
          @csrf
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Unit</label>
              <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="basic-default-name" required />
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
@endsection