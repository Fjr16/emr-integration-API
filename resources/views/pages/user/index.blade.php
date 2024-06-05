@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">

  <div class="d-flex">
      <h4 class="align-self-center m-0">Daftar Staff</h4>
      <a href="{{ route('user.create') }}" class="btn btn-success ms-auto btn-sm m-0">+ Tambah Staff</a>
    </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          {{-- <th>No</th> --}}
          <th>Staff Id</th>
          <th>NIK</th>
          {{-- <th>Name</th> --}}
          <th>Email</th>
          {{-- <th>Nama Ayah</th> --}}
          {{-- <th>Nama Ibu</th> --}}
          <th>Jenis Kelamin</th>
          {{-- <th>status Kawin</th> --}}
          {{-- <th>Jumlah Anak</th> --}}
          {{-- <th>Tanggal Lahir</th> --}}
          {{-- <th>Tanggal Gabung</th> --}}
          {{-- <th>No Telp</th> --}}
          {{-- <th>Alamat Sesuai KTP</th> --}}
          {{-- <th>Alamat Domisili</th> --}}
          {{-- <th>Nama Kontak Darurat</th> --}}
          {{-- <th>No Telp Kontak Darurat</th> --}}
          {{-- <th>Alamat Kontak Darurat</th> --}}
          {{-- <th>Pendidikan Terakhir</th> --}}
          {{-- <th>Pengalaman Kerja</th> --}}
          {{-- <th>Nama Rekening Bank</th> --}}
          {{-- <th>No Rekening</th> --}}
          {{-- <th>Catatan</th> --}}
          <th>Role</th>
          <th>Unit / Departemen</th>
          <th>Poli</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($data as $item)
          <tr>
            {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
            <td>{{ $item->staff_id ?? '' }}</td>
            <td>{{ $item->nik ?? '' }}</td>
            {{-- <td>{{ $item->name ?? '' }}</td> --}}
            <td>{{ $item->email ?? '' }}</td>
            {{-- <td>{{ $item->ayah ?? '' }}</td> --}}
            {{-- <td>{{ $item->ibu ?? '' }}</td> --}}
            <td>{{ $item->gender ?? '' }}</td>
            {{-- <td>{{ $item->status_kawin ?? '' }}</td> --}}
            {{-- <td>{{ $item->jumlah_anak ?? '' }}</td> --}}
            {{-- <td>{{ $item->tgl_lahir ?? '' }}</td> --}}
            {{-- <td>{{ $item->tgl_masuk ?? '' }}</td> --}}
            {{-- <td>{{ $item->telp ?? '' }}</td> --}}
            {{-- <td>{{ $item->alamat_ktp ?? '' }}</td> --}}
            {{-- <td>{{ $item->alamat_domisili ?? '' }}</td> --}}
            {{-- <td>{{ $item->nama_kontak_darurat ?? '' }}</td> --}}
            {{-- <td>{{ $item->no_kontak_darurat ?? '' }}</td> --}}
            {{-- <td>{{ $item->alamat_kontak_darurat ?? '' }}</td> --}}
            {{-- <td>{{ $item->pendidikan ?? '' }}</td> --}}
            {{-- <td>{{ $item->pengalaman ?? '' }}</td> --}}
            {{-- <td>{{ $item->nama_rekening ?? '' }}</td> --}}
            {{-- <td>{{ $item->no_rekening ?? '' }}</td> --}}
            {{-- <td>{{ $item->catatan ?? '' }}</td> --}}
            <td>{{ $item->roles->first()->name ?? '' }}</td>
            <td>{{ $item->unitCategory->unit->name ?? '' }} / {{ $item->unitCategory->unitCategoryPivot->name ?? '' }}</td>
            <td>{{ $item->roomDetail->name ?? 'Tidak Dalam Poli' }}</td>
            <td>{{ $item->status ?? '' }}</td>
            {{-- <td>{{ $item->unitAccesses->unit }}</td> --}}
            <td>
              <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                      data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('user.edit', $item->id) }}">
                          <i class="bx bx-edit-alt me-1"></i>
                          Edit
                      </a>
                      <form action="{{ route('user.destroy', $item->id) }}" method="POST">
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
