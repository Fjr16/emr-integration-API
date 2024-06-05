@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-3 mt-5">
        <div class="d-flex">
            <h4 class="align-self-center m-0">Daftar Pasien</h4>
            @can('tambah pasien rumah sakit')
                <a href="{{ route('pasien.create', $route) }}" class="btn btn-success ms-auto btn-sm m-0 mx-3">+ Tambah Pasien</a>
            @endcan
        </div>
        <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-nowrap">
            <table class="table" id="example">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>No</th>
                        <th>No Rekam Medis</th>
                        <th>No Kartu</th>
                        {{-- <th>NIK</th> --}}
                        <th>Nama</th>
                        {{-- <th>Tempat / Tanggal Lahir</th>
                        <th>Jenis Kelamin</th> --}}
                        <th>Telp</th>
                        {{-- <th>Agama</th>
                        <th>Bangsa</th>
                        <th>Alamat</th>
                        <th>RW</th>
                        <th>RT</th>
                        <th>Kelurahan / Desa</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten / Kota</th>
                        <th>Provinsi</th>
                        <th>Suku Bangsa</th>
                        <th>Pekerjaan</th>
                        <th>Pendidikan</th>
                        <th>Status</th>
                        <th>Nama Ayah</th>
                        <th>Nama Ibu</th>
                        <th>Nama Wali</th> --}}
                        <th>Alergi</th>
                        {{-- <th>Karyawan</th> --}}
                        @canany(['edit pasien rumah sakit', 'delete pasien rumah sakit'])
                            <th>Action</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
                            <td>{{ $item->noka ?? '--' }}</td>
                            {{-- <td>{{ $item->nik ?? '-' }}</td> --}}
                            <td>{{ $item->name ?? '-' }}</td>
                            {{-- <td>{{ $item->tempat_lhr ?? '-' }} / {{ $item->tanggal_lhr ?? '-' }}</td>
                            <td>{{ $item->jenis_kelamin ?? '-' }}</td> --}}
                            <td>{{ $item->telp ?? '-' }}</td>
                            {{-- <td>{{ $item->agama ?? '-' }}</td>
                            <td>{{ $item->bangsa ?? '-' }}</td>
                            <td>{{ $item->alamat ?? '-' }}</td>
                            <td>{{ $item->rw ?? '-' }}</td>
                            <td>{{ $item->rt ?? '-' }}</td>
                            <td>{{ $item->village->name ?? '-' }}</td>
                            <td>{{ $item->district->name ?? '-' }}</td>
                            <td>{{ $item->city->name ?? '-' }}</td>
                            <td>{{ $item->province->name ?? '-' }}</td>
                            <td>{{ $item->suku ?? '-' }}</td>
                            <td>{{ $item->job->name ?? '-' }}</td>
                            <td>{{ $item->pendidikan ?? '-' }}</td>
                            <td>{{ $item->status ?? '-' }}</td>
                            <td>{{ $item->nm_ayah ?? '-' }}</td>
                            <td>{{ $item->nm_ibu ?? '-' }}</td>
                            <td>{{ $item->nm_wali ?? '-' }}</td> --}}
                            <td>{{ $item->alergi ?? '-' }}</td>
                            {{-- <td>{{ $item->isKaryawan == true ? 'YA' : 'TIDAK' }}</td> --}}
                            @canany(['edit pasien rumah sakit', 'delete pasien rumah sakit'])
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('pasien.detail', $item->id) }}">
                                                <i class='bx bx-show-alt me-1'></i>
                                                Show
                                            </a>
                                            @can('edit pasien rumah sakit')
                                                <a class="dropdown-item" href="{{ route('pasien.edit', $item->id) }}">
                                                    <i class='bx bx-edit-alt me-1'></i>
                                                    Edit
                                                </a>
                                            @endcan
                                            @can('delete pasien rumah sakit')
                                                <form action="{{ route('pasien.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item"
                                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                            class="bx bx-trash me-1"></i>Hapus</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            @endcanany
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
