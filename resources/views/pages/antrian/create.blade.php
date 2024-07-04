@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
<div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
    {{ session('success') }}
</div>
@endif
<div class="d-flex mb-3">
    @can('tambah antrian')
    <h5 class="align-self-center m-0">Entri Antrian Pasien
        {{-- <span class="text text-primary text-uppercase fw-bold fs-5">Umum</span> --}}
    </h5>
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
                            / {{ $patient->name }}
                        </option>
                        @else
                        <option value="{{ $patient->id }}">
                            {{ implode('-', str_split(str_pad($patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                            / {{ $patient->name }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-8">
                            <label for="defaultFormControlInput" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control col-7" id="tempat_lhr" name="tempat_lhr" placeholder="" aria-describedby="defaultFormControlHelp" />
                        </div>
                        <div class="col-4">
                            <label for="defaultFormControlInput" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control col-5" id="tanggal_lhr" name="tanggal_lhr" placeholder="" aria-describedby="defaultFormControlHelp" />
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-5">
                            <label for="exampleFormControlSelect1" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" aria-label="Default select example" name="jenis_kelamin">
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
                            <select class="form-select" id="status" aria-label="Default select example" name="status">
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
                    <input type="number" class="form-control" id="telp" name="telp" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
                </div>
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">Alamat</label>
                    <input type="text" class="form-control" placeholder="" id="alamat" name="alamat" aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">NIK</label>
                    <input type="number" class="form-control" id="nik" name="nik" placeholder="" aria-describedby="defaultFormControlHelp" value="" />
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
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-body">
                <div class="mb-3">
                    <label for="noka" class="form-label">Nomor Kartu BPJS</label>
                    <input type="text" class="form-control" id="noka" name="noka" placeholder="" aria-describedby="defaultFormControlHelp" />
                </div>
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">No Rujukan / No Kontrol</label>
                    <input type="text" class="form-control" id="no_rujukan" name="no_rujukan"
                        placeholder="" aria-describedby="defaultFormControlHelp"/>
                </div>
                <div class="mb-3">
                    <label for="kodeDiagnosa" class="form-label">Kode Diagnosa</label>
                    <input type="text" class="form-control" id="kodeDiagnosa" name="kodeDiagnosa" placeholder=""
                        aria-describedby="defaultFormControlHelp"/>
                </div>
                <div class="mb-3">
                    <label for="last_diagnostic" class="form-label">Nama Diagnosa</label>
                    <input type="text" class="form-control" id="last_diagnostic" name="last_diagnostic"
                        placeholder="" aria-describedby="defaultFormControlHelp"/>
                </div>
                <div class="mb-3" id="diagnosa">
                </div>
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">Poli / Dokter</label>
                    <select class="form-control select2 doctor_id" id="doctor_id" name="doctor_id" required>
                        <option value="" selected>Pilih</option>
                        @foreach ($doctors as $doctor)
                            @if (old('doctor_id') == $doctor->id)
                                <option value="{{ $doctor->id }}" selected>
                                    {{ $doctor->roomDetail->name ?? '' }} /
                                    {{ $doctor->name ?? '' }}</option>
                            @else
                                <option value="{{ $doctor->id }}">{{ $doctor->roomDetail->name ?? '' }} /
                                    {{ $doctor->name ?? '' }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3" id="jadwalAntrian" style="display: none">
                    <table class="table" id="tableJadwal">
                        <thead>
                            <tr class="text-nowrap bg-dark">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Hari</th>
                                <th>Total Antrian</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">Tanggal Berobat</label>
                    <input type="date" class="form-control" value="{{ old('tgl_antrian', $now) }}"
                        name="tgl_antrian" id="tanggal_antrian" />
                </div>
                <button type="button" id="storeModal" class="btn btn-sm btn-dark mb-3"
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
                    <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search">
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
                    @canany(['perbarui status antrian', 'lihat antrian'])
                    <th class="text-center">Action</th>
                    @endcanany
                    <th>No Antrian</th>
                    <th>Tgl Berobat</th>
                    <th>Nama</th>
                    <th>Norm</th>
                    <th>Poli</th>
                    <th>Diagnosa Terakhir</th>
                    <th>status Antrian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($antrians as $antrian)
                    <tr>
                        @canany(['perbarui status antrian', 'lihat antrian'])
                        <td class="d-flex">
                            @can('lihat antrian')
                                <a class="btn btn-dark btn-sm text-white"
                                    onclick="showAntrian({{ $antrian->id }})">Lihat</a>
                            @endcan
                        </td>
                        @endcanany
                        <td>{{ $antrian->no_antrian ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($antrian->tgl_antrian)->format('d-m-Y') ?? '' }}</td>
                        <td>{{ $antrian->patient->name ?? '' }}</td>
                        <td>{{ implode('-', str_split(str_pad($antrian->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}
                        </td>
                        <td>{{ $antrian->doctorPatient->user->roomDetail->name ?? '' }}</td>
                        <td>{{ $antrian->last_diagnostic ?? '--' }}</td>
                        <td>
                            <span class="badge {{ $antrian->status_antrian == 'ARRIVED' ?  'bg-primary' : ($antrian->status_antrian == 'FINISHED' ? 'bg-sucess' : ($antrian->status_antrian == 'CANCEL' ? 'bg-danger' : 'bg-warning') ) }}">
                                {{ $antrian->status_antrian == 'ARRIVED' ?  'SEDANG DILAYANI' : ($antrian->status_antrian == 'FINISHED' ? 'SELESAI' : ($antrian->status_antrian == 'CANCEL' ? 'ANTRIAN BATAL' : 'BELUM DILAYANI') ) }}
                            </span>
                        </td>
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

@section('script')
<script>
    //menampilkan pop up setelah antrian berhasil dibuat untuk mendapatkan pesan wa
    $(document).ready(function(){
        @if (session('queue_id')) 
            var antrianId = "{{ session('queue_id') }}";
            showAntrian(antrianId);
        @endif
    });
    function getPatient() {
        var categories = @json($categories);
        var bpjsCategoryId = categories.find(category => category.name.toLowerCase() === 'bpjs').id;
        var other = categories.find(category => category.name.toLowerCase() === 'umum').id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: "{{ URL::route('antrian/get/pasien.getPasien') }}",
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
                $('#noka').val(data.noka)
                var categoryId = data.noka != null ? bpjsCategoryId : other;
                $('#patient_category_id').select2().val(categoryId).trigger('change');
                categoryId != bpjsCategoryId ? $('#noka').prop('readonly', true) : $('#noka').prop(
                    'readonly', false);;
                var button = document.getElementById('storeModal');
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

    function openModal(id) {
        if (id) {
            $.ajax({
                type: 'get',
                url: "{{ route('antrian.edit', '') }}" + "/" + id,
                data: {
                    doctor_id: $('#doctor_id').val(),
                    tgl_antrian: $('#tanggal_antrian').val(),
                    no_rujukan: $('#no_rujukan').val(),
                    last_diagnostic: $('#last_diagnostic').val(),
                    patient_category_id: $('#patient_category_id').val(),
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
</script>

{{-- mengambil jadwal dokter --}}
<script>
    $(document).ready(function() {
        var table = $('#tableJadwal tbody');

        $('#doctor_id').on('change', function() {
            var dokterID = $(this).val();
            if (dokterID) {
                $.ajax({
                    url: '/antrian/jadwalDokter/' + dokterID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        table.empty();
                        table.find("tr:gt(0)").remove();
                        if (data && data.length > 0) {
                            $('#jadwalAntrian').show();
                            $.each(data, function(key, list) {
                                var date = new Date(list.created_at);
                                var formattedDate = date.toLocaleDateString(
                                    'en-GB', {
                                        day: '2-digit',
                                        month: '2-digit',
                                        year: 'numeric',

                                    });
                                var row = $('<tr>').append(
                                    $('<td>').text(key + 1),
                                    $('<td>').text(formattedDate),
                                    $('<td>').text(list.day),
                                    $('<td>').text(list.totalAntrian),
                                );
                                table.append(row);
                            });
                        } else {
                            $('#jadwalAntrian').hide();
                            table.find("tr:gt(0)").remove();
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error if any
                        $('#jadwalAntrian').hide();
                        table.find("tr:gt(0)").remove();
                        alert(xhr.responseJSON.message);
                    }
                });
            } else {
                console.log('berh');
                $('#jadwalAntrian').hide();
                table.find("tr:gt(0)").remove();
            }
        });
    });
</script>

@endsection

@endsection
