@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
<div class="alert alert-success d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-check-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">BERHASIL !!</h6>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>{{ session('error') }}</span>
    </div>
</div>
@endif
@if (session()->has('errors'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>
        @foreach (session('errors') as $err)
            {{ $err ?? '' }} <br>
        @endforeach
        </span>
    </div>
</div>
@endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Daftar Penjamin Pasien</h4>
    <a href="{{ route('pasien/category.create') }}" class="btn btn-success ms-auto btn-sm m-0 mx-3">+ Tambah Penjamin</a>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Nama Penjamin</th>
          <th>Margin Obat</th>
          <th>Rumus Penjualan Obat</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($data as $item)
          <tr>
            <th scope="row" class="text-dark">{{ $loop->iteration }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->margin ?? 0 }} %</td>
            <td>
              {{ '(Harga Awal)'. ($item->include_margin_obt ? ' + (margin)' : '') . ($item->include_pajak_obt ? ' + (pajak)' : '') . ($item->include_disc_obt ? ' - (disc)' : '') }}
            </td>
            <td>
              <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                      data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('pasien/category.edit', $item->id) }}">
                        <i class="bx bx-edit-alt me-1"></i>
                        Edit
                    </a>
                    <form action="{{ route('pasien/category.destroy', $item->id) }}" method="POST">
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