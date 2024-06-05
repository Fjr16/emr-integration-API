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
            <h4 class="align-self-center m-0">Daftar Pasien Admisi Ranap</h4>
            {{-- <a href="{{ route('suratpengantar.create') }}" class="btn btn-dark btn-sm m-0 mx-3">+</a> --}}
        </div>
        <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>No</th>
                        <th>ID Pasien</th>
                        <th>Alat</th>
                        <th>Ruangan</th>
                        @canany(['tambah surat pengantar ranap', 'edit surat pengantar ranap'])
                            <th class="text-center">Surat Pengantar</th>
                        @endcanany
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</th>
                            <td>{{ $item->queue->patient->name }}</td>
                            <td>{{ $item->suratPengantarRawatJalanPatient->alat ?? 'Belum di isi' }}</td>
                            <td>{{ $item->suratPengantarRawatJalanPatient->ruangan ?? 'Belum di isi' }}</td>
                            @canany('edit surat pengantar ranap')
                                <td class="text-center">
                                    @isset($item->suratPengantarRawatJalanPatient->id)
                                        @if ($item->suratPengantarRawatJalanPatient->status != 'waiting')
                                            <button class="btn btn-success btn-sm" @disabled(true)>Perbarui</button>
                                        @else
                                            <a href="{{ route('suratpengantar.edit', $item->suratPengantarRawatJalanPatient->id) }}"
                                                class="btn btn-success btn-sm">Perbarui</a>
                                        @endif
                                    @else
                                        <button class="btn btn-warning btn-sm" @disabled(true)>Tidak Ditemukan</button>
                                    @endisset
                                </td>
                            @endcanany
                            <td class="text-center">
                                @isset($item->suratPengantarRawatJalanPatient->id)
                                    @if ($item->suratPengantarRawatJalanPatient->status == 'waiting')
                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('rawat/inap.cancel', $item->id) }}">
                                            <i class='bx bx-x'></i>
                                            Cancel
                                        </a>
                                        <a class="btn btn-dark btn-sm" href="{{ route('rawat/inap.room', $item->id) }}">
                                            <i class='bx bx-check me-1'></i>
                                            Terima
                                        </a>
                                    @else
                                        <button class="btn btn-sm {{ $item->suratPengantarRawatJalanPatient->status == 'terima' ? 'btn-dark' : 'btn-danger' }}" @disabled(true)>
                                            {{ $item->suratPengantarRawatJalanPatient->status == 'terima' ? 'Selesai' : 'Dibatalkan' }}
                                        </button>
                                    @endif
                                    {{-- <a class="btn btn-dark btn-sm" href="{{ route('rawat/inap.show', $item->id) }}">
                                        <i class='bx bx-show-alt me-1'></i>
                                        show
                                    </a> --}}
                                @else
                                    <button class="btn btn-dark btn-sm" @disabled(true)>
                                        <i class='bx bx-show-alt me-1'></i>
                                        show
                                    </button>
                                @endisset
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
