@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Hasil Pemeriksaan {{ Auth::user()->name }}</h4>
    <a href="{{ route('dokter/diagnosis/report.create') }}" class="btn btn-success ms-auto btn-sm m-0 mx-3">+ Tambah Hasil Pemeriksaan</a>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table id="example" class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Nama Pasien</th>
          <th>Nama Dokter</th>
          <th>Rawat Inap</th>
          <th>Diagnosis Dokter</th>
          <th>List Tindakan</th>
          <th>Pemeriksaan Penunjang</th>
          <th>Daftar Resep Obat</th>
          <th>Keterangan</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item) 
        <tr>
          <th scope="row" class="text-dark">{{ $loop->iteration }}</th>
          <td>{{ $item->patient->name ?? '' }}</td>
          <td>{{ $item->user->name ?? '' }}</td>
          <td>{{ $item->rawat_inap ? 'Ya' : 'Tidak'}}</td>
          <td>{!! $item->diagnosis ?? '' !!}</td>
          <td>
            @foreach ($item->actionMembers as $action)
            <table>
              {{ $action->name ?? '' }}
            </table>
            @endforeach
          </td>
          <td>{{ $item->penunjang ? 'Ya' : 'Tidak' }}</td>
          <td>{!! $item->resep_obat ?? '' !!}</td>
          <td>{!! $item->keterangan ?? '' !!}</td>
          <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                    data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('dokter/diagnosis/report.edit', $item->id) }}">
                        <i class="bx bx-edit-alt me-1"></i>
                        Edit
                    </a>
                    <form action="{{ route('dokter/diagnosis/report.destroy', $item->id) }}" method="POST">
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