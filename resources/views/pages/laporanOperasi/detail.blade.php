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
            <h4 class="align-self-center m-0">Laporan Operasi</h4>
            <a href="{{ route('laporan/operasi.create', $item->id) }}" class="btn btn-success ms-auto btn-sm m-0 mx-3">+
                Tambah Data</a>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>No</th>
                        <th>Nama Ahli Bedah</th>
                        <th>Asisten Bedah</th>
                        <th>Nama Ahli Anestesi</th>
                        <th>Jenis Anestesi</th>
                        <th>Tingkatan Operasi</th>
                        <th>Diagnosis Pra Operasi</th>
                        <th>Diagnosis Pasca Operasi</th>
                        <th>Nama Operasi</th>
                        <th>Komplikasi</th>
                        <th>Spesimen Operasi Untuk PA</th>
                        <th>Jumlah Pendarahan (cc)</th>
                        <th>Jumlah Darah Ditransfusi (unit)</th>
                        <th>Tanggal</th>
                        <th>Jam Dimulai</th>
                        <th>Jam Selesai</th>
                        <th>Lama Operasi</th>
                        <th>Prosedur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_ahli_bedah }}</td>
                            <td>{{ $item->asisten_bedah }}</td>
                            <td>{{ $item->nama_ahli_anestesi }}</td>
                            <td>{{ $item->jenis_anestesi }}</td>
                            <td>{{ $item->tingkatan_operasi }}</td>
                            <td>{{ $item->diagnosis_pra_operasi }}</td>
                            <td>{{ $item->diagnosis_pasca_operasi }}</td>
                            <td>{{ $item->nama_operasi }}</td>
                            <td>{{ $item->komplikasi }}</td>
                            <td>{{ $item->spesimen_operasi_pemeriksaan_pa }}</td>
                            <td>{{ $item->jumlah_pendarahan }}</td>
                            <td>{{ $item->jumlah_ditransfusi }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->jam_dimulai }}</td>
                            <td>{{ $item->jam_selesai }}</td>
                            <td>{{ $item->lama_operasi }}</td>
                            <td>{{ $item->prosedur_operasi }}</td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('laporan/operasi.edit', $item->id) }}">
                                            <i class="bx bx-edit-alt me-1"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('laporan/operasi.destroy', $item->id) }}" method="POST">
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
