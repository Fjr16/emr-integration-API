@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('forbidden'))
        <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('forbidden') }}
        </div>
    @endif
    <div class="card p-3 mt-5">
        <div class="row">
            <div class="col-md-10">
                <h4 class="align-self-center m-0">
                    Resep Obat
                    <span
                        class="text text-primary text-uppercase fw-bold fs-7">{{ $item->queue->patient->name ?? '' }}</span>
                </h4>
            </div>
            <div class="col-md-2">
                <a class="btn btn-success btn-sm text-white" href="{{ route('ranap/resep/dokter.create', $item->id) }}"><i
                        class="bx bx-plus"></i>Tambah Resep Dokter</a>
            </div>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-nowrap">
            <table id="example" class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Tanggal</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item->ranapMedicineReceipts->sortByDesc('created_at') as $mr)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mr->user->name ?? '-' }}</td>
                            <td>{{ $mr->created_at->format('Y-m-d') ?? '-' }}</td>
                            <td>

                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('ranap/resep/dokter.edit', $mr->id) }}">
                                            <i class="bx bx-plus"></i>
                                            Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('ranap/resep/dokter.show', $mr->id) }}"
                                            target="_blank">
                                            <i class="bx bx-printer"></i>
                                            Print
                                        </a>
                                        <form action="{{ route('ranap/resep/dokter.destroy', $mr->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Yakin Ingin Menghapus Data ?')">
                                                <i class="bx bx-trash"></i>
                                                Hapus
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
