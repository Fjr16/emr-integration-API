@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Dokter</h4>
    <a href="{{ route('dokter/category.create') }}" class="btn btn-success ms-auto btn-sm m-0 mx-3">+ Tambah Kategori Dokter</a>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Kategori</th>
          <th class="text-center">Tambah Dokter</th>
          <th>Kode Dokter</th>
          <th>Nama Dokter</th>
          <th>Telp Dokter</th>
          <th>Poli</th>
          <th>Alamat Dokter</th>
          <th>Action Dokter</th>
          <th>Action Category</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->name }}</td>
            <td class="text-center">
              <a href="{{ route('dokter.create', $item->id) }}" class="btn btn-success btn-sm">
                +Tambah Dokter</i>
              </a>
            </td>
            <td>
              @foreach ($item->doctor as $doctor)
                <p class="p-0 m-0">{{ $doctor->kode ?? '' }}</p> <br>
              @endforeach
            </td>
            <td>
              @foreach ($item->doctor as $doctor)
                <p class="p-0 m-0">{{ $doctor->name ?? '' }}</p> <br>
              @endforeach
            </td>
            <td>
              @foreach ($item->doctor as $doctor)
                <p class="p-0 m-0">{{ $doctor->telp ?? '' }}</p> <br>
              @endforeach
            </td>
            <td>
              @foreach ($item->doctor as $doctor)
                <p class="p-0 m-0">{{$doctor->poli->name ?? 'Tidak Dalam Poli' }}</p> <br>
              @endforeach
            </td>
            <td>
              @foreach ($item->doctor as $doctor)
                <p class="p-0 m-0">{{ $doctor->alamat ?? '' }}</p> <br>
              @endforeach
            </td>
            <td>
              @foreach ($item->doctor as $doctor)
                <div class="d-flex justify-content-between mb-3">
                  <a class="btn btn-danger btn-sm" href="{{ route('dokter.edit', $doctor->id) }}">
                    <i class="fs-6 bx bx-edit-alt"></i>
                  </a>
                  <form class="" action="{{ route('dokter.destroy', $doctor->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-primary" type="submit">
                      <i class="fs-6 bx bx-trash"></i>
                    </button>
                  </form>
                </div>
              @endforeach
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('dokter/category.edit', $item->id) }}">
                    <i class="bx bx-edit-alt me-1"></i>
                    Edit
                  </a>
                  <form action="{{ route('dokter/category.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item" onclick="return confirm('Yakin ingin menghapus data?')">
                      <i class="bx bx-trash me-1"></i>Hapus
                    </button>
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