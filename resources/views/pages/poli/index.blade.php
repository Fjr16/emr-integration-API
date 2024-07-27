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
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Daftar Poli</h4>
    <a href="{{ route('poliklinik.create') }}" class="btn btn-success ms-auto btn-sm m-0">+ Tambah Poli</a>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Nama Poli</th>
          <th>Dokter Praktek</th>
          <th>Tarif</th>
          <th>Hari</th>
          <th>Waktu</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($data as $item)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name ?? '' }}</td>
            <td colspan="4" class="p-0">
              <table class="table">
                  @foreach ($item->jadwalDokter as $jadwal)
                  <tr>
                    <td style="width: 40%">
                      {{ ($jadwal->user->staff_id ?? '') . ' / ' . ($jadwal->user->name) }}
                    </td>
                    <td style="width: 20%">
                      Rp. {{ number_format($jadwal->tarif ?? 0) }}
                    </td>
                    <td style="width: 18%">
                      {{ $jadwal->day ?? '-' }}
                    </td>
                    <td style="width: 22%">
                      {{ ($jadwal->start_at ?? '00:00'). ' - ' . ($jadwal->ends_at ?? '00:00') }}
                    </td>
                  </tr>
                    @endforeach
              </table>
            </td>
            <td>
              <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                      data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('poliklinik.edit', $item->id) }}">
                          <i class="bx bx-edit-alt me-1"></i>
                          Edit
                      </a>
                      <form action="{{ route('poliklinik.destroy', $item->id) }}" method="POST">
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