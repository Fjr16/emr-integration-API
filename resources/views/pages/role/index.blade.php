@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif

<div class="card mb-4 mt-5">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0">Daftar Role</span></h5>
      <a href="{{ route('user/role.create') }}" class="btn btn-success btn-sm">Tambah Role</a>
  </div>
  <div class="card-body">
      <hr class="m-0 mt-2 mb-3">
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr class="text-nowrap bg-dark">
              <th>No</th>
              <th>Nama Role</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $item)
              <tr>
                <th scope="row" class="text-body">{{ $loop->iteration }}</th>
                <td>{{ $item->name }}</td>
                <td class="d-flex">
                  <a href="{{ route('user/role.edit', $item->id) }}" class="btn btn-warning btn-sm mx-2"><i class="bx bx-edit me-2"></i>Edit</a>
                  <form action="{{ route('user/role.destroy', $item->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm"
                          onclick="return confirm('Yakin ingin menghapus data?')"><i
                              class="bx bx-trash me-2"></i>Hapus</button>
                  </form>
              </td>
              </tr>
              @endforeach
            </tbody>
        </table>
      </div>
  </div>
</div>
@endsection