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
                        <th>No Antrian</th>
                        <th>Norm</th>
                        <th>Tanggal Berobat</th>
                        <th>Nama</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                        <th>Poli / Dokter</th>
                        <th>Penjamin</th>
                        <th>No Kartu BPJS</th>
                        <th>No Rujukan / Kontrol</th>
                        <th>Diagnosa Terakhir</th>
                        <th>Petugas</th>
                        <th>Kuota</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->no_antrian ?? '' }}</td>
                            <td>{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                            </td>
                            <td>{{ $item->tgl_antrian ?? '' }}</td>
                            <td>{{ $item->patient->name }}</td>
                            <td>{{ $item->patient->telp ?? '' }}</td>
                            <td>{{ $item->patient->alamat ?? '' }}</td>
                            <td>{{ $item->doctorPatient->user->roomDetail->name ?? '' }} /
                                {{ $item->doctorPatient->user->name ?? '' }}</td>
                            <td>{{ $item->patientCategory->name ?? '' }}</td>
                            <td>-</td>
                            <td>{{ $item->no_rujukan ?? '-' }}</td>
                            <td>{{ $item->last_diagnostic ?? '-' }}</td>
                            <td>{{ $item->user->name ?? '' }}</td>
                            <td>{{ $item->kuota ?? '' }}</td>
                            {{-- <td>
            <select class="form-select form-select-sm" id="exampleFormControlSelect1" aria-label="Default select example">
              <option value="1" selected>Belum</option>
              <option value="2">Sudah</option>
            </select>
          </td> --}}
                            <td>
                                <button class="btn btn-success btn-sm"
                                    onclick="registerQueue({{ $item->id }})">Daftarkan</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="openModal" data-bs-backdrop="static" tabindex="-1">

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
    </script>
@endsection
