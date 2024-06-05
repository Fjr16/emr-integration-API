@extends('layouts.backend.main')

@section('content')
    <div class="card row mx-1 px-3">

        <div class="col-12 col-md-4 py-2  row align-items-center">
            <table>
               
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $item->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Rekam Medis</td>
                        <td>:</td>
                        <td>{{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $item->jenis_kelamin ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card p-3 mt-5">
        <div class="row">
            <div class="col-md-9">
                <h4 class="align-self-center m-0">
                    {{-- Daftar Pasien --}}
                    {{-- <span class="text text-primary text-uppercase fw-bold fs-7">Rawat Inap</span> --}}
                </h4>
            </div>
        </div>
        <h4>List Antrian Pasien</h4>
        <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-nowrap">
            <table id="example" class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>Nomor</th>
                        <th>Tanggal Antrian</th>
                        <th>Nomor Rujukan</th>
                        <th>Kategori</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item->queues->where('patient_category_id', $statusBpjs->id) as $queue)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $queue->tgl_antrian ?? '' }}</td>
                            <td>{{ $queue->no_rujukan ?? 'Tidak Ada' }}</td>
                            <td>{{ $queue->category ?? '' }}</td>
                            <td class="text-center">
                                <a class="btn btn-dark btn-sm"
                                    href="{{ route('casemix/queue.show', encrypt($queue->id)) }}">
                                    <i class='bx bx-show-alt me-1'></i>
                                    Coding
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
