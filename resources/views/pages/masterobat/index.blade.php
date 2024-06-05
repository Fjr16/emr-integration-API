@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Master Obat</h4>
    <a href="{{ route('farmasi/obat.create') }}" class="btn btn-success ms-auto btn-sm m-0">+ Tambah Master Obat</a>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Kode</th>
          <th>Nama</th>
          <th>Jenis</th>
          <th>Sediaan</th>
          <th>Golongan</th>
          <th>Satuan Obat</th>
          {{-- <th>Pabrik</th> --}}
          <th class="text-center">Live Saving</th>
          <th class="text-center">Antibiotik</th>
          <th class="text-center">High Alert</th>
          <th class="text-center">Interaksi</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item) 
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->kode }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->medicineType->name }}</td>
            <td>{{ $item->medicineForm->name }}</td>
            <td>{{ $item->medicineCategory->name }}</td>
            <td>{{ $item->unitConversionMaster->name }}</td>
            {{-- <td>{{  }}</td> --}}
            <td class="text-center">
              <button class="btn btn-sm"><i class='bx bx-check'></i></button>
              <button class="btn btn-sm"><i class='bx bx-x' ></i></button>
            </td>
            <td class="text-center">
              <button class="btn btn-sm"><i class='bx bx-check'></i></button>
              <button class="btn btn-sm"><i class='bx bx-x' ></i></button>
            </td>
            <td class="text-center">
              <button class="btn btn-sm"><i class='bx bx-check'></i></button>
              <button class="btn btn-sm"><i class='bx bx-x' ></i></button>
            </td>
            <td class="text-center">
              <a href="/interaksi-obat" class="btn btn-sm">
                <i class='bx bxs-right-arrow-square' ></i>
              </a>
            </td>
            <td>
              <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                      data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('farmasi/obat.edit', $item->id) }}">
                          <i class="bx bx-edit-alt me-1"></i>
                          Edit
                      </a>
                      <form action="{{ route('farmasi/obat.destroy', $item->id) }}" method="POST">
                          @method('DELETE')
                          @csrf
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