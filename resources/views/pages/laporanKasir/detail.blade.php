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

    {{-- nav tab --}}
    <div class="card">
        <div class="card-header">
            <h4 class="m-0">Riwayat Pembayaran <span class="
                text-primary">{{ $item->name }}</span></h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th class="">Tanggal</th>
                        <th class="">No Antrian</th>
                        <th class="">Petugas</th>
                        <th class="">status</th>
                        <th class="">Total Biaya</th>
                        <th class="">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item->queues as $queue)
                        @if($queue->rawatJalanPatient)
                            @if ($queue->rawatJalanPatient->kasirPatient)
                                @if ($queue->rawatJalanPatient->kasirPatient->status == 'SELESAI')
                                    <tr>
                                        <td>{{ $queue->created_at->format('Y/m/d') }}</th>
                                        <td>{{ $queue->no_antrian ?? '' }}</td>
                                        <td>{{ $queue->rawatJalanPatient->kasirPatient->user->name ?? '' }}</td>
                                        <td>{{ $queue->rawatJalanPatient->kasirPatient->status ?? '' }}</td>
                                        <td>Rp. {{ number_format($queue->rawatJalanPatient->kasirPatient->total ?? '') }}</td>
                                        <td>
                                            <a class="btn btn-dark btn-sm"
                                                href="{{ route('laporan/kasir.show', $queue->rawatJalanPatient->kasirPatient->id ?? '') }}">
                                                <i class='bx bx-show-alt me-1'></i>
                                                Show
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
