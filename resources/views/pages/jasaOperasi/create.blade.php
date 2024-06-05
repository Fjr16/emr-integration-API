@extends('layouts.backend.main')

@section('content')
<div class="card p-3 mt-5 mb-5">
    <div class="d-flex">
      <h4 class="align-self-center m-0">Jasa Operasi</h4>
    </div>
    <hr class="m-0 mt-2 mb-3">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>No</th>
            <th>Nama Jasa Operasi</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $item->name }}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('surgery/category.edit', $item->id) }}"
                      ><i class="bx bx-edit-alt me-1"></i> Edit</a
                    >
                    <form action="{{ route('surgery/category.destroy', $item->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button type="submit">
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
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Jasa Operasi</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('surgery/category.store') }}">
          @csrf
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Jasa Operasi</label>
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