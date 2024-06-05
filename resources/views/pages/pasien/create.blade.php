@extends('layouts.backend.main')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h5>Entri Data Pasien</h5>
    <form action="{{ route('pasien.store') }}" method="POST">
        @csrf
        <input type="hidden" value="{{ $previousUrl ?? '' }}" name="previous">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control form-control-sm" id="defaultFormControlInput"
                                name="name" placeholder="" aria-describedby="defaultFormControlHelp" value=""
                                required />
                        </div>
                        <div class="row">
                            <div class="col col-6">
                                <label for="defaultFormControlInput" class="form-label">NIK</label>
                                <input type="number" class="form-control form-control-sm" id="defaultFormControlInput"
                                    name="nik"
                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                    maxlength="16" />
                            </div>
                            <div class="col col-6">
                                <label for="defaultFormControlInput" class="form-label">No Kartu Bpjs</label>
                                <input type="text" class="form-control form-control-sm" id="defaultFormControlInput"
                                    name="noka"/>
                        </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-8">
                                    <label for="defaultFormControlInput" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control form-control-sm col-7"
                                        id="defaultFormControlInput" name="tempat_lhr" placeholder=""
                                        aria-describedby="defaultFormControlHelp" required />
                                </div>
                                <div class="col-4">
                                    <label for="defaultFormControlInput" class="form-label">Tanggal Lahir</label>
                                    <input type="text" id="tanggal-lahir" placeholder="Tanggal Lahir"
                                        class="form-control form-control-sm" name="tanggal_lhr">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <label for="exampleFormControlSelect1" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select form-select-sm" id="exampleFormControlSelect1"
                                        aria-label="Default select example" name="jenis_kelamin">
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
                                <div class="col-4">
                                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                                    <select class="form-select form-select-sm" id="exampleFormControlSelect1"
                                        aria-label="Default select example" name="status">
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
                                <div class="col-4">
                                    <label for="exampleFormControlSelect1" class="form-label">Agama</label>
                                    <select class="form-select form-select-sm" id="exampleFormControlSelect1"
                                        aria-label="Default select example" name="agama">
                                        <option selected disabled>Pilih</option>
                                        @foreach ($agama as $agama)
                                            @if (old('agama') == $agama)
                                                <option value="{{ $agama }}" selected>{{ $agama }}
                                                </option>
                                            @else
                                                <option value="{{ $agama }}">{{ $agama }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <label for="defaultFormControlInput" class="form-label">Nama Ayah</label>
                                    <input type="text" class="form-control form-control-sm"
                                        id="defaultFormControlInput" placeholder="" name="nm_ayah"
                                        aria-describedby="defaultFormControlHelp" />
                                </div>
                                <div class="col-4">
                                    <label for="defaultFormControlInput" class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control form-control-sm"
                                        id="defaultFormControlInput" placeholder="" name="nm_ibu"
                                        aria-describedby="defaultFormControlHelp" />
                                </div>
                                <div class="col-4">
                                    <label for="defaultFormControlInput" class="form-label">Nama Wali</label>
                                    <input type="text" class="form-control form-control-sm"
                                        id="defaultFormControlInput" placeholder="" name="nm_wali"
                                        aria-describedby="defaultFormControlHelp" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Telp</label>
                            <input type="number" class="form-control form-control-sm" id="defaultFormControlInput"
                                placeholder="" name="telp" aria-describedby="defaultFormControlHelp" min="0" />
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="exampleFormControlSelect1" class="form-label">Pendidikan Terakhir</label>
                                    <select class="form-select form-select-sm" id="exampleFormControlSelect1"
                                        aria-label="Default select example" name="pendidikan">
                                        <option selected disabled>Pilih</option>
                                        @foreach ($pendidikan as $pend)
                                            @if (old('pendidikan') == $pend)
                                                <option value="{{ $pend }}" selected>{{ $pend }}</option>
                                            @else
                                                <option value="{{ $pend }}">{{ $pend }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-7">
                                    <label for="exampleFormControlSelect1" class="form-label">Pekerjaan</label>
                                    <select class="form-select form-select-sm" id="exampleFormControlSelect1"
                                        aria-label="Default select example" name="job_id">
                                        <option selected disabled>Pilih</option>
                                        @foreach ($jobs as $job)
                                            @if (old('job_id') == $job->id)
                                                <option value="{{ $job->id }}" selected>{{ $job->name }}</option>
                                            @else
                                                <option value="{{ $job->id }}">{{ $job->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-8">
                                    <label for="defaultFormControlInput" class="form-label">Alamat</label>
                                    <input type="text" class="form-control form-control-sm"
                                        id="defaultFormControlInput" placeholder="" name="alamat"
                                        aria-describedby="defaultFormControlHelp" />
                                </div>
                                <div class="col-2">
                                    <label for="defaultFormControlInput" class="form-label">RW</label>
                                    <input type="number" class="form-control form-control-sm"
                                        id="defaultFormControlInput" placeholder="" name="rw" min="0"
                                        aria-describedby="defaultFormControlHelp" />
                                </div>
                                <div class="col-2">
                                    <label for="defaultFormControlInput" class="form-label">RT</label>
                                    <input type="number" class="form-control form-control-sm"
                                        id="defaultFormControlInput" placeholder="" name="rt" min="0"
                                        aria-describedby="defaultFormControlHelp" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-7">
                                    <label for="exampleFormControlSelect1" class="form-label">Provinsi</label>
                                    <select class="select2-custom-size form-select select2 " id="provinsi_id"
                                        aria-label="Default select example" name="province_id" onchange="getKota()">
                                        <option selected disabled>Pilih Provinsi</option>
                                        @foreach ($provinsi as $prov)
                                            @if (old('provinsi') == $prov->id)
                                                <option value="{{ $prov->id }}" selected>{{ $prov->name }}</option>
                                            @else
                                                <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-5">
                                    <label for="exampleFormControlSelect1" class="form-label">Kab / Kota</label>
                                    <select class="form-select form-select-sm" id="kota_id"
                                        aria-label="Default select example" name="city_id" onchange="getKecamatan()">
                                        <option selected disabled>Pilih Kota</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="exampleFormControlSelect1" class="form-label">Kecamatan</label>
                                    <select class="form-select form-select-sm" id="kecamatan_id"
                                        aria-label="Default select example" name="district_id" onchange="getDesa()">
                                        <option selected>Pilih Kecamatan</option>

                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlSelect1" class="form-label">Kel / Desa</label>
                                    <select class="form-select form-select-sm" id="desa_id"
                                        aria-label="Default select example" name="village_id">
                                        <option selected>Pilih Kelurahan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-7">
                                    <label for="bangsa" class="form-label">Kewarganegaraan</label>
                                    <select class="form-select form-select-sm" id="bangsa"
                                        aria-label="Default select example" onchange="enableNegara(this)">
                                        <option selected disabled>Pilih</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Asing">Asing</option>
                                    </select>
                                </div>
                                <div class="col-5">
                                    <label for="negara_asing" class="form-label">Nama Negara</label>
                                    <input type="text" class="form-control form-control-sm" id="negara_asing"
                                        placeholder="" aria-describedby="defaultFormControlHelp" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="defaultFormControlInput" class="form-label">Suku Bangsa</label>
                            <input type="text" class="form-control form-control-sm" id="defaultFormControlInput"
                                placeholder="" name="suku" aria-describedby="defaultFormControlHelp" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Daftar Alergi Pasien</label>
                            <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" name="alergi" rows="3">{{ old('alergi') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="isKaryawan" id="isKaryawan">
                                <label class="form-check-label" for="isKaryawan">Pasien adalah karyawan rumah
                                    sakit</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-dark mb-3">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark mb-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>


    {{-- modal --}}
    <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-xl" id="showModal">

        </div>
    </div>


    {{-- getKota --}}
    <script>
        function getKota() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: "{{ URL::route('get/wilayah.kota') }}",
                data: {
                    province_id: $('#provinsi_id').val()
                },
                success: function(data) {
                    $('#kota_id').attr('disabled', false);
                    $('#kota_id').html(data);

                    $('#kecamatan_id').attr('disabled', true);
                    $('#kecamatan_id').html('<option selected>Pilih Kecamatan</option>');

                    $('#desa_id').html('<option selected>Pilih Kelurahan</option>');
                    $('#desa_id').attr('disabled', true);
                },
                error: function() {
                    $('#kota_id').html('<option selected>Pilih Kota</option>');
                    $('#kota_id').attr('disabled', true);

                    $('#kecamatan_id').attr('disabled', true);
                    $('#kecamatan_id').html('<option selected>Pilih Kecamatan</option>');

                    $('#desa_id').html('<option selected>Pilih Kelurahan</option>');
                    $('#desa_id').attr('disabled', true);
                },
            })
        }

        //get Kecamatan
        function getKecamatan() {
            $.ajax({
                type: 'POST',
                url: "{{ URL::route('get/wilayah.kecamatan') }}",
                data: {
                    city_id: $('#kota_id').val()
                },
                success: function(data) {
                    $('#kecamatan_id').attr('disabled', false);
                    $('#kecamatan_id').html(data);

                    $('#desa_id').html('<option selected>Pilih Kelurahan</option>');
                    $('#desa_id').attr('disabled', true);

                },
                error: function() {
                    $('#kecamatan_id').attr('disabled', true);
                    $('#kecamatan_id').html('<option selected>Pilih Kecamatan</option>');

                    $('#desa_id').html('<option selected>Pilih Kelurahan</option>');
                    $('#desa_id').attr('disabled', true);
                }
            })
        }

        //get Desa
        function getDesa() {
            $.ajax({
                type: 'POST',
                url: "{{ URL::route('get/wilayah.kelurahan') }}",
                data: {
                    district_id: $('#kecamatan_id').val()
                },
                success: function(data) {
                    $('#desa_id').attr('disabled', false);
                    $('#desa_id').html(data);
                },
                error: function() {
                    $('#desa_id').html('<option selected>Pilih Kelurahan</option>');
                    $('#desa_id').attr('disabled', true);
                }
            })
        }

        function enableNegara(element) {
            var value = $(element).val();
            if (value == 'Asing') {
                $('#bangsa').removeAttr('name');
                $('#negara_asing').attr('name', 'bangsa');
                $('#negara_asing').attr('disabled', false);
            }
            if (value == 'Indonesia') {
                $('#bangsa').attr('name', 'bangsa');
                $('#negara_asing').removeAttr('name');
                $('#negara_asing').attr('disabled', true);
            }
        }
    </script>
@endsection
