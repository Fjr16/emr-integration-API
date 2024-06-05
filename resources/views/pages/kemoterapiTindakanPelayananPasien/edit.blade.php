@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Tindakan Pelayanan Pasien</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th class="text-body">No</th>
                        <th class="text-body">LAB</th>
                        <th class="text-body">ECG</th>
                        <th class="text-body">Tindakan</th>
                        <th class="text-body">PA</th>
                        <th class="text-body">Oksigen</th>
                        <th class="text-body">Lain-Lain</th>
                        <th class="text-body">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $data)
                        <tr>
                            <td>
                                <p>{{ $loop->iteration }}</p>
                            </td>
                            <td>
                                <p>{{ $data->lab }}</p>
                            </td>
                            <td>
                                <p>{{ $data->ecg }}</p>
                            </td>
                            <td>
                                <p>{{ $data->tindakan }}</p>
                            </td>
                            <td>
                                <p>{{ $data->pa }}</p>
                            </td>
                            <td>
                                <p>{{ $data->oksigen }}</p>
                            </td>
                            <td>
                                {!! $data->lain !!}
                            </td>
                            <td class="d-flex">
                                <p>
                                    <a href="{{ route('kemoterapi/tindakan/pelayanan/pasien/detail.editDetail', $data->id) }}"
                                        class="btn btn-warning btn-sm mx-2"><i class='bx bx-edit'></i></a>
                                    <a href="{{ route('kemoterapi/tindakan/pelayanan/pasien/detail.destroyDetail', $data->id) }}"
                                        class="btn btn-danger btn-sm mx-2"
                                        onclick="return confirm('Yakin ingin menghapus data?')"><i class="bx bx-trash"></i>
                                    </a>
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script></script>
