@extends('layouts.backend.main')

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex mb-3">
        @can('tambah antrian')
            <h5 class="align-self-center m-0">Entri Antrian Pasien <span
                    class="text text-primary text-uppercase fw-bold fs-5">Urologi</span></h5>
        @endcan
        @can('tambah pasien rumah sakit')
            <a href="{{ route('pasien.create') }}" class="btn btn-success ms-auto btn-sm m-0">+ Pasien Baru</a>
        @endcan
    </div>
    @can('tambah antrian')
        <div class="row">
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">No Rekam Medis</label>
                            <select class="form-control select2" id="patient_id" name="patient_id" onchange="getPatient()">
                                <option value="" selected>Pilih</option>
                                @foreach ($patients as $patient)
                                    @if (old('patient_id') == $patient->id)
                                        <option value="{{ $patient->id }}" selected>
                                            {{ implode('-', str_split(str_pad($patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                            / {{ $patient->name }}</option>
                                    @else
                                        <option value="{{ $patient->id }}">
                                            {{ implode('-', str_split(str_pad($patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                            / {{ $patient->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder=""
                                aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-8">
                                    <label for="defaultFormControlInput" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control col-7" id="tempat_lhr" name="tempat_lhr"
                                        placeholder="" aria-describedby="defaultFormControlHelp" />
                                </div>
                                <div class="col-4">
                                    <label for="defaultFormControlInput" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control col-5" id="tanggal_lhr" name="tanggal_lhr"
                                        placeholder="" aria-describedby="defaultFormControlHelp" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="exampleFormControlSelect1" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" aria-label="Default select example"
                                        name="jenis_kelamin">
                                        <option selected disabled>Pilih</option>
                                        @foreach ($jk as $jk)
                                            @if (old('jenis_kelamin') == $jk)
                                                <option value="{{ $jk }}" selected>{{ $jk }}</option>
                                            @else
                                                <option value="{{ $jk }}">{{ $jk }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-7">
                                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                                    <select class="form-select" id="status" aria-label="Default select example"
                                        name="status">
                                        <option selected disabled>Pilih</option>
                                        @foreach ($status as $status)
                                            @if (old('status') == $status)
                                                <option value="{{ $status }}" selected>{{ $status }}</option>
                                            @else
                                                <option value="{{ $status }}">{{ $status }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">No Telp</label>
                            <input type="number" class="form-control" id="telp" name="telp" placeholder=""
                                aria-describedby="defaultFormControlHelp" value="" />
                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Alamat</label>
                            <input type="text" class="form-control" placeholder="" id="alamat" name="alamat"
                                aria-describedby="defaultFormControlHelp" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">NIK</label>
                            <input type="number" class="form-control" id="nik" name="nik" placeholder=""
                                aria-describedby="defaultFormControlHelp" value="" />
                            <div class="d-flex">
                                <a href="#" id="checkPesertaButton" class="btn mt-2 btn-success btn-sm">Check peserta
                                    BPJS</a>
                                <a href="{{ route('noka.getNokaNik', ['nik' => 1801154907820001, 'tgl' => '2023-10-22']) }}"
                                    target="_blank" class="btn mx-2 mt-2 btn-primary btn-sm">Check peserta BPJS</a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Penjamin</label>
                            <select class="form-control select2" id="patient_category_id" name="patient_category_id">
                                @foreach ($categories as $category)
                                    @if (old('patient_category_id') == $category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Tanggal Berobat</label>
                            <input type="date" class="form-control" value="{{ old('tgl_antrian', $now) }}"
                                name="tgl_antrian" id="tanggal_antrian" />
                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Poli / Dokter</label>
                            <select class="form-control select2" id="doctor_id" name="doctor_id" required>
                                <option value="" selected>Pilih</option>
                                @foreach ($doctors as $doctor)
                                    @if (old('doctor_id') == $doctor->id)
                                        <option value="{{ $doctor->id }}" selected>{{ $doctor->roomDetail->name ?? '' }} /
                                            {{ $doctor->name ?? '' }}</option>
                                    @else
                                        <option value="{{ $doctor->id }}">{{ $doctor->roomDetail->name ?? '' }} /
                                            {{ $doctor->name ?? '' }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">No Rujukan / No Kontrol</label>
                            <input type="number" class="form-control" id="no_rujukan" name="no_rujukan" placeholder=""
                                aria-describedby="defaultFormControlHelp" onkeyup="showDiagnosa()" />
                        </div>
                        <div class="mb-3" id="diagnosa">

                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Kuota</label>
                            <select class="form-control" id="kuota" name="kuota" required>
                                <option value="" selected disabled>Pilih</option>
                                @foreach ($kuotas as $kuota)
                                    @if (old('kuota') == $kuota)
                                        <option value="{{ $kuota }}" selected>{{ $kuota }}</option>
                                    @else
                                        <option value="{{ $kuota }}">{{ $kuota }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="button" id="storeModalUrologi" class="btn btn-sm btn-dark mb-3"
                            onclick="">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @can('daftar antrian')
        <div class="card p-3 mt-5">
            <div class="row">
                <div class="col-md-9">
                    <h4 class="align-self-center m-0">Daftar Antrian Pasien</h4>
                </div>
                <div class="col-md-3">
                    <form action="{{ route('antrian.create') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="m-0 mt-2 mb-3">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap bg-dark">
                            <th>No Antrian</th>
                            <th>Tgl Berobat</th>
                            <th>Nama</th>
                            <th>Norm</th>
                            <th>Tgl Lahir</th>
                            <th>Telp</th>
                            <th>Poli</th>
                            <th>Penjamin</th>
                            <th>No Rujukan / Kontrol</th>
                            <th>Diagnosa Terakhir</th>
                            <th>Petugas</th>
                            <th>status Antrian</th>
                            <th>Kuota</th>
                            @canany(['perbarui status antrian', 'lihat antrian'])
                                <th class="text-center">Action</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($antrians as $antrian)
                            <tr>
                                <td>{{ $antrian->no_antrian ?? '' }}</td>
                                <td>{{ $antrian->tgl_antrian ?? '' }}</td>
                                <td>{{ $antrian->patient->name ?? '' }}</td>
                                <td>{{ implode('-', str_split(str_pad($antrian->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                                </td>
                                <td>{{ $antrian->patient->tanggal_lhr ?? '' }}</td>
                                <td>{{ $antrian->patient->telp ?? '' }}</td>
                                <td>{{ $antrian->doctorPatient->user->roomDetail->name ?? '' }}</td>
                                <td>{{ $antrian->patientCategory->name ?? '' }}</td>
                                <td>{{ $antrian->no_rujukan ?? '--' }}</td>
                                <td>{{ $antrian->last_diagnostic ?? '--' }}</td>
                                <td>{{ $antrian->user->name ?? '' }}</td>
                                <td>{{ $antrian->status_antrian ?? '-' }}</td>
                                <td>{{ $antrian->kuota ?? '-' }}</td>
                                @canany(['perbarui status antrian', 'lihat antrian'])
                                    <td class="d-flex">
                                        @if ($antrian->status_antrian == 'WAITING')
                                            @can('perbarui status antrian')
                                                <a class="btn btn-success btn-sm text-white"
                                                    onclick="konfirmasiAntrian({{ $antrian->id }})">Panggil</a>
                                                <form action="{{ route('antrian/konfirmasi.store', $antrian->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm text-white" name="status_antrian"
                                                        value="BATAL"
                                                        onclick="return confirm('Apakah Anda Yakin Ingin Membatalkan Antrian ?')">Batal</button>
                                                </form>
                                            @endcan
                                        @elseif ($antrian->status_antrian == 'TIDAK HADIR')
                                            @can('perbarui status antrian')
                                                <a class="btn btn-success btn-sm text-white"
                                                    onclick="konfirmasiAntrian({{ $antrian->id }})">Panggil</a>
                                            @endcan
                                        @else
                                            @can('lihat antrian')
                                                <a class="btn btn-dark btn-sm text-white"
                                                    onclick="showAntrian({{ $antrian->id }})">Lihat</a>
                                            @endcan
                                        @endif
                                    </td>
                                @endcanany
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endcan

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
        function getPatient() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: "{{ URL::route('antrian/get/pasien/urologi.getPasien') }}",
                data: {
                    patient_id: $('#patient_id').val()
                },
                success: function(data) {
                    $('#name').val(data.name)
                    $('#nik').val(data.nik)
                    $('#tempat_lhr').val(data.tempat_lhr)
                    $('#tanggal_lhr').val(data.tanggal_lhr)
                    $('#jenis_kelamin').val(data.jenis_kelamin)
                    $('#status').val(data.status)
                    $('#telp').val(data.telp)
                    $('#alamat').val(data.alamat)
                    var button = document.getElementById('storeModalUrologi');
                    button.setAttribute('onclick', 'openModal("' + data.id + '")');
                }
            })
        }

        function showAntrian(id) {
            $.ajax({
                type: 'get',
                url: "{{ route('antrian.show', '') }}" + "/" + id,
                success: function(data) {
                    $('#backDropModal').modal('show');
                    $('#showModal').html(data);
                }
            })
        }

        function showDiagnosa() {
            let exist = $('#no_rujukan').val();
            if (exist) {
                $('#showdiagnosa').remove();
                $('#diagnosa').append(
                    '<div id="showdiagnosa"><label for="defaultFormControlInput" class="form-label">Diagnosa</label> <input type="text" class="form-control form-control-sm" name="last_diagnostic" id="last_diagnostic" aria-describedby="defaultFormControlHelp"/> </div>'
                )
            } else {
                $('#showdiagnosa').remove();
            }
        }

        function openModal(id) {
            if (id) {
                $.ajax({
                    type: 'get',
                    url: "{{ route('antrian-urologi.edit', '') }}" + "/" + id,
                    data: {
                        doctor_id: $('#doctor_id').val(),
                        tgl_antrian: $('#tanggal_antrian').val(),
                        no_rujukan: $('#no_rujukan').val(),
                        last_diagnostic: $('#last_diagnostic').val(),
                        patient_category_id: $('#patient_category_id').val(),
                        kuota: $('#kuota').val(),
                    },
                    success: function(data) {
                        $('#openStoreModal').modal('show');
                        $('#showStoreModal').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                        console.log(status);
                        console.log(xhr);
                    }
                })
            }
        }

        function konfirmasiAntrian(id) {
            $.ajax({
                type: 'get',
                url: "{{ route('antrian/konfirmasi.create', '') }}/" + id,
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

    <script>
        // Mengambil tombol "Check peserta BPJS" dan input dengan ID "nik"
        const checkPesertaButton = document.getElementById('checkPesertaButton');
        const nikInput = document.getElementById('nik');

        // Menambahkan event listener untuk mengubah URL saat tombol diklik
        checkPesertaButton.addEventListener('click', function() {
            const nikValue = nikInput.value; // Mengambil nilai dari input

            // Membuat URL dengan nilai NIK yang diambil dari input
            const url = `/Peserta/nik/${nikValue}/tglSEP/2023-10-22`;

            // Mengarahkan ke URL yang baru
            window.open(url, '_blank');
        });
    </script>
@endsection
