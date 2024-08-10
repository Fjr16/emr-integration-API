@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
<div class="alert alert-success d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-check-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">BERHASIL !!</h6>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>{{ session('error') }}</span>
    </div>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </span>
    </div>
</div>
@endif
<div class="d-flex mb-3">
    <h5 class="align-self-center m-0">Entri Antrian Pasien
        {{-- <span class="text text-primary text-uppercase fw-bold fs-5">Umum</span> --}}
    </h5>
    <a href="{{ route('pasien.create') }}" class="btn btn-success ms-auto btn-sm m-0">+ Pasien Baru</a>
</div>
<div class="row">
    <div class="col-6">
        <div class="card mb-4">
            <div class="card-body">
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">No Rekam Medis</label>
                    <select class="form-control select2" id="patient_id" name="patient_id" onchange="getPatient()">
                        <option value="" selected>Pilih</option>
                        @foreach ($patients as $patient)
                        {{-- @if (old('patient_id') == $patient->id)
                        <option value="{{ $patient->id }}" selected>
                            {{ $patient->no_rm ?? '' }}
                            / {{ $patient->name }}
                        </option>
                        @else --}}
                        <option value="{{ $patient->id }}">
                            {{ $patient->no_rm ?? '' }}
                            / {{ $patient->name }}
                        </option>
                        {{-- @endif --}}
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" aria-describedby="defaultFormControlHelp" value="" disabled/>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-8">
                            <label for="defaultFormControlInput" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control col-7" id="tempat_lhr" name="tempat_lhr" placeholder="" aria-describedby="defaultFormControlHelp" disabled/>
                        </div>
                        <div class="col-4">
                            <label for="defaultFormControlInput" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control col-5" id="tanggal_lhr" name="tanggal_lhr" placeholder="" aria-describedby="defaultFormControlHelp" disabled/>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-5">
                            <label for="exampleFormControlSelect1" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" aria-label="Default select example" name="jenis_kelamin" disabled>
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
                            <select class="form-select" id="status" aria-label="Default select example" name="status" disabled>
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
                    <input type="number" class="form-control" id="telp" name="telp" placeholder="" aria-describedby="defaultFormControlHelp" value="" disabled/>
                </div>
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">Alamat</label>
                    <input type="text" class="form-control" placeholder="" id="alamat" name="alamat" aria-describedby="defaultFormControlHelp" disabled/>
                </div>
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">NIK</label>
                    <input type="number" class="form-control" id="nik" name="nik" placeholder="" aria-describedby="defaultFormControlHelp" value="" disabled/>
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
                {{-- <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">No Rujukan / No Kontrol</label>
                    <input type="text" class="form-control" id="no_rujukan" name="no_rujukan"
                        placeholder="" aria-describedby="defaultFormControlHelp"/>
                </div>
                <div class="row mb-3" id="diagnosa">
                    <div class="col-4">
                        <label for="kodeDiagnosa" class="form-label">Kode Diagnosa</label>
                        <input type="text" class="form-control" id="kodeDiagnosa" name="kodeDiagnosa" placeholder="" aria-describedby="defaultFormControlHelp" readonly/>
                    </div>
                    <div class="col-8">
                        <label for="last_diagnostic" class="form-label">Nama Diagnosa</label>
                        <input type="text" class="form-control" id="last_diagnostic" name="last_diagnostic"
                            placeholder="" aria-describedby="defaultFormControlHelp" readonly/>
                    </div>
                </div> --}}
                <div class="mb-3">
                    <label for="defaultFormControlInput" class="form-label">Poli / Dokter</label>
                    <select class="form-control select2 doctor_id" id="doctor_id" name="doctor_id" required>
                        <option value="" selected>Pilih</option>
                        @foreach ($dokters as $dokter)
                            @if (old('doctor_id') == $dokter->id)
                                <option value="{{ $dokter->id }}" selected>{{ $dokter->poliklinik->name ?? '' }} / {{ $dokter->name ?? '' }}</option>
                            @else
                                <option value="{{ $dokter->id }}">{{ $dokter->poliklinik->name ?? '' }} / {{ $dokter->name ?? '' }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3" id="jadwalAntrian" style="display: none">
                    <table class="table" id="tableJadwal">
                        <thead>
                            <tr class="text-nowrap bg-dark">
                                <th>#</th>
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
                <button type="button" id="storeModal" class="btn btn-sm btn-outline-success mb-3" onclick="">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="card p-3 mt-3">
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
                    <th class="text-center">Action</th>
                    <th>Poli</th>
                    <th>No Antrian</th>
                    <th>Tgl Berobat</th>
                    <th>Nama / No. RM</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>status Antrian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($antrians as $antrian)
                    <tr class="text-wrap">
                        <td>
                            <a class="btn btn-dark btn-sm text-white" onclick="showAntrian({{ $antrian->id }})">Lihat</a>
                        </td>
                        <td>{{ $antrian->dpjp->poliklinik->name ?? '' }}</td>
                        <td>{{ $antrian->no_antrian ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($antrian->tgl_antrian)->format('d-m-Y') ?? '' }}</td>
                        <td>{{ ($antrian->patient->name ?? '') . ' / ' . ($antrian->patient->no_rm ?? '') }}</td>
                        <td>{{ $antrian->patient->jenis_kelamin ?? '-' }}
                        </td>
                        <td>{{ ($antrian->patient->alamat ?? '-'). ', ' . ($antrian->patient->village->name ?? '-') . ', ' . ($antrian->patient->district->name ?? '-') . ', ' . ($antrian->patient->city->name ?? '-') . ' ' . ($antrian->patient->province->name ?? '-')  }}</td>
                        <td>
                            @if ($antrian->status_antrian == 'FINISHED')
                                <span class="badge bg-success">SUDAH DILAYANI</span>
                            @elseif ($antrian->status_antrian == 'WAITING')
                                <span class="badge bg-warning">BELUM DILAYANI</span>
                            @elseif ($antrian->status_antrian == 'ARRIVED')
                                <span class="badge bg-primary">SEDANG DILAYANI</span>
                            @elseif ($antrian->status_antrian == 'CANCEL')
                                <span class="badge bg-danger">ANTRIAN BATAL</span>
                            @else
                                <span class="badge bg-danger">TIDAK DIKETAHUI</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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

    // modal konfirmasi sebelum disimpan pada db
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

    // mentransfer data tanggal ke tanggal berobat
    function transferDate(tanggal){
        const date = new Date(tanggal);
        const tgl = date.toISOString().slice(0, 10);
        $('#tanggal_antrian').val(tgl);

    }
</script>

{{-- mengambil jadwal dokter --}}
<script>
    $(document).ready(function() {
        var table = $('#tableJadwal tbody');

        $('#doctor_id').on('change', function() {
            var dokterId = $(this).val();
            if (dokterId) {
                $.ajax({
                    url: '/antrian/jadwalDokter/' + dokterId,
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
                                    $('<td>').html(`<button class="btn btn-sm btn-outline-primary" value="${date}" type="button" onclick="transferDate(this.value)">choose</button>`),
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
