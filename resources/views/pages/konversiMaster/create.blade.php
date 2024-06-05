@extends('layouts.backend.main')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Tambah Satuan</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('farmasi/obat/master/konversi.store') }}">
          @csrf
          <div class="row mb-3">
              <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Satuan</label>
              <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="basic-default-name" value="{{ old('name') }}" required />
              </div>
          </div>
          <div class="row justify-content-end">
              <div class="col-sm-10">
                  <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
              </div>
          </div>
      </form>
  </div>
  <div class="card p-3 mt-2">
    <hr class="m-0 mt-2 mb-3">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>No</th>
            <th>Nama Satuan</th>
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
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('farmasi/obat/master/konversi.edit', $item->id) }}">
                            <i class="bx bx-edit-alt me-1"></i>
                            Edit
                        </a>
                        <form action="{{ route('farmasi/obat/master/konversi.destroy', $item->id) }}" method="POST">
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
  </div>
</div>
<div class="d-flex justify-content-end">
  <div class="row-mx-2">
      <a href="{{ route('farmasi/obat/konversi.index') }}" class="btn btn-sm btn-danger">Kembali</a>
  </div>
</div>
@endsection