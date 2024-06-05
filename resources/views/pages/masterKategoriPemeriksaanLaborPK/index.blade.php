@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <div class="col-11 d-flex">
        <h4 class="align-self-center m-0 mx-2">Kategori Pemeriksaan Labor PK</h4>
        <a href="{{ route('laboratorium/pk/category/pemeriksaan.create') }}" class="btn btn-success btn-sm">+ Tambah Kategori</a>
        <a href="{{ route('laboratorium/pk/subkategori/pemeriksaan.create') }}" class="btn btn-sm btn-success mx-2">Tambah Sub Kategori</a>
        <a href="{{ route('laboratorium/pk/variabel/pemeriksaan.create') }}" class="btn btn-sm btn-success">Tambah Variabel Pemeriksaan</a>
      </div>
      <div class="col-1 text-end">
        <button class="btn btn-sm btn-success" onclick="history.back()">Kembali</button>
      </div>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Kategori</th>
          {{-- <th>Daftar Paket Pemeriksaan</th>
          <th>Daftar Variabel Pemeriksaan</th> --}}
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row" class="text-dark">{{ $loop->iteration }}</th>
            <td>{{ $item->name ?? '' }}</td>
            {{-- @foreach ($item->paketPemeriksaanLaboratoriumRequests as $paketPemeriksaan)
            <td>
                {{ $paketPemeriksaan->name ?? '' }}
                <td>
                  @foreach ($paketPemeriksaan->paketPemeriksaanLaboratoriumRequestDetails as $detail)
                  {{ $detail->laboratoriumRequestMaster->name ?? '' }} <br>
                  @endforeach
                </td>
              </td>
              @endforeach --}}
            <td>
              <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                      data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('laboratorium/pk/category/pemeriksaan.edit', $item->id) }}">
                          <i class="bx bx-edit-alt me-1"></i>
                          Edit
                      </a>
                      <form action="{{ route('laboratorium/pk/category/pemeriksaan.destroy', $item->id) }}" method="POST">
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