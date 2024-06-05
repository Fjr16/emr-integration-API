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
            <h4 class="align-self-center m-0">Daftar Antrian Pasien (Registrasi Ulang)</h4>
        </div>
        <hr class="m-0 mt-2 mb-3">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>Action</th>
                        <th>No Antrian</th>
                        <th>Norm</th>
                        <th>Tanggal Berobat</th>
                        <th>Nama</th>
                        <th>Poli / Dokter</th>
                        <th>No Kartu BPJS</th>
                        <th>Diagnosa</th>
                        {{-- <th>Status</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                @if ($item->status_antrian == 'CHECKIN')
                                    {{-- @can('perbarui status antrian') --}}
                                        <a class="btn btn-success btn-sm text-white"
                                            onclick="konfirmasiAntrian({{ $item->id }})">Panggil</a>
                                    {{-- @endcan --}}
                                    <form action="{{ route('antrian/konfirmasi.store', $item->id) }}" class="d-inline"
                                        method="POST">
                                        @csrf
                                        <button class="btn btn-danger btn-sm text-white" name="status_antrian"
                                            value="BATAL"
                                            onclick="return confirm('Apakah Anda Yakin Ingin Membatalkan Antrian ?')">Batal</button>
                                    </form>
                                @elseif ($item->status_antrian == 'TIDAK HADIR')
                                    {{-- @can('perbarui status antrian') --}}
                                        <a class="btn btn-warning btn-sm text-white"
                                            onclick="konfirmasiAntrian({{ $item->id }})">Panggil Ulang</a>
                                    {{-- @endcan --}}
                                @elseif ($item->status_antrian == 'BATAL')
                                    {{-- @can('perbarui status antrian') --}}
                                        <a class="btn btn-danger disabled btn-sm text-white">Dibatalkan</a>
                                    {{-- @endcan --}}
                                @elseif ($item->status_antrian == 'DIPANGGIL')
                                    <button class="btn btn-success btn-sm"
                                        onclick="registerQueue({{ $item->id }})">Daftarkan</button>
                                @endif
                            </td>
                            <td>{{ $item->no_antrian ?? '' }}</td>
                            <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                            </td>
                            @php
                                $tglAntrian = new DateTime($item->tgl_antrian);
                            @endphp
                            <td>{{ $tglAntrian->format('d-m-Y') ?? '' }}</td>
                            <td>{{ $item->patient->name }}</td>
                            <td>{{ $item->doctorPatient->user->roomDetail->name ?? '' }} /
                                {{ $item->doctorPatient->user->name ?? '' }}</td>
                            <td>{{ $item->patient->noka ?? '' }}</td>
                            <td>{{ $item->last_diagnostic ?? '-' }}</td>
                            {{-- <td>{{ $item->status_antrian ?? '' }}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="openModal" data-bs-backdrop="static" tabindex="-1">

    </div>

    {{-- Store modal --}}
    <div class="modal fade" id="openStoreModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-xl" id="showStoreModal">

        </div>
    </div>
    {{-- modal --}}
    <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-xl" id="showModal">

        </div>
    </div>
    <div class="modal fade" id="konfirmasi-antrian" data-bs-backdrop="static" tabindex="-1">

    </div>

    <script>
        function registerQueue(id) {
            $.ajax({
                type: 'get',
                url: "{{ route('antrian/konfirmasi.edit', '') }}/" + id,
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog';
                    div.innerHTML = data;

                    $('#openModal').html(div);
                    $('#openModal').modal('show');
                }
            })
        }


        function konfirmasiAntrian(id) {
            $.ajax({
                type: 'get',
                url: "{{ route('antrian/konfirmasi/ulang.create', '') }}/" + id,
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog';
                    div.innerHTML = data;
                    $('#konfirmasi-antrian').html(div);
                    $('#konfirmasi-antrian').modal('show');
                }
            });
        }
    </script>
@endsection
