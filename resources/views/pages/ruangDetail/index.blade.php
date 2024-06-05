@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <div class="col-9">
      <h4 class="align-self-center m-0">Daftar Ruang</h4>
    </div>
    <div class="col-3 text-end">
      <a href="{{ route('ruang.create') }}" class="btn btn-success btn-sm m-0 mx-1">+ Tambah Ruangan</a>
      <a href="" class="btn btn-success btn-sm m-0">+ Tambah Detail Ruangan</a>
    </div>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Nama Ruang</th>
          <th>Detail Ruang</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($data as $item)
          <tr>
            <th class="text-dark" scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->name }}</td>
            <td>
              <table>
                {{ $item->name }} <br>
                {{ $item->name }} <br>
                {{ $item->name }} <br>
                {{ $item->name }} <br>
                {{ $item->name }}
              </table>
            </td>
            <td>
              <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                      data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('ruang.edit', $item->id) }}">
                          <i class="bx bx-edit-alt me-1"></i>
                          Edit
                      </a>
                      <form action="{{ route('ruang.destroy', $item->id) }}" method="POST">
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
@endsection