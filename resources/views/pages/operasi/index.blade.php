@extends('layouts.backend.main')

@section('content')
<div class="card p-3 mt-5">
    <div class="d-flex">
      <h4 class="align-self-center m-0">Operasi</h4>
      <div class="ms-auto">
        <a href="{{ route('surgery.create') }}" class="btn btn-success btn-sm m-0">+ Tambah Operasi</a>
        <a href="{{ route('surgery/category.create') }}" class="btn btn-success btn-sm m-0 mx-2">+ Tambah Jasa</a>
      </div>
    </div>
    <hr class="m-0 mt-2 mb-3">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>No</th>
            <th>Nama Operasi</th>
            <th>Tarif</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $item->name }}</td>
              <td><a href="{{ route('surgery/rates.index', $item->id) }}" class="btn"><i class='bx bxs-file-doc'></a></i></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"
                      ><i class="bx bx-edit-alt me-1"></i> Edit</a
                    >
                    <a class="dropdown-item" href="javascript:void(0);"
                      ><i class="bx bx-trash me-1"></i> Delete</a
                    >
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