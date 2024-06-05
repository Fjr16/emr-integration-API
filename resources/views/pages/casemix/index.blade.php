@extends('layouts.backend.main')

@section('content')
    <div class="card p-3 mt-5">
        <div class="row">
            <div class="col-md-9">
                <h4 class="align-self-center m-0">
                    {{-- Daftar Pasien --}}
                    {{-- <span class="text text-primary text-uppercase fw-bold fs-7">Rawat Inap</span> --}}
                </h4>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table id="example" class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>Nama</th>
                        <th>No Rekam Medis</th>
                        <th>Jenis Kelamin</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td class="text-center">
                                <a class="btn btn-dark btn-sm"
                                    {{-- href="{{ url('/casemix/queue/' . $item->PatientIdEncrypt) }}"> --}}
                                    href="{{ route('casemix.queue', encrypt($item->id)) }}">
                                    <i class='bx bx-show-alt me-1'></i>
                                    Queue
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    {{-- <tr>
                    <td>Nur Khairiyah</td>
                    <td>123-087</td>
                    <td>Perempuan</td>
                      <td class="text-center">
                          <a class="btn btn-dark btn-sm"
                              href="{{ route('casemix.queue') }}">
                              <i class='bx bx-show-alt me-1'></i>
                              Queue
                          </a>
                      </td>
                  </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
