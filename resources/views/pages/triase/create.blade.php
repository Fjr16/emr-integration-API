@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header m-0 d-flex">
            <h5 class="mb-0 m-0 ">Triase</h5>
            {{ session()->flash('active', 'triase') }}
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-success ms-auto"><i class="bx bx-left-arrow-alt"></i>
                Kembali</a>
        </div>
        <form action="{{ route('igd/triase.store', $item->id) }}" method="POST">
            @csrf

            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        {{-- <h6 class="m-0"> </h6> --}}
                        <div class="row">
                            <label for="html5-datetime-local-input" class="col-md-3 col-form-label">Tanggal/Jam Masuk
                                :</label>
                            <div class="col-md-6">
                                <input class="form-control" type="datetime-local" name="tanggal_masuk"
                                    value="{{ $today }}" id="html5-datetime-local-input" />
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <input type="hidden" name="patient_id" value="{{ $igd_patient->queue->patient_id }}">
                            <label for="html5-time-input" class="col-md-2 col-form-label ms-auto">Jam Respon :</label>
                            <div class="col-md-3">
                                <input class="form-control" type="time" name="jam_respon" value="{{ $time }}"
                                    id="html5-time-input" />
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="m-0 mt-3">
                <div class="row">
                    <div class="col-4">
                        <p class="fw-bold m-0 mt-2">Cara Masuk IGD :</p>
                        <div class="mb-3 mx-3" id="radio_cara_masuk">
                            @foreach ($cara_masuk as $in)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cara_masuk"
                                        value="{{ $in }}" id="cara_masuk{{ $loop->iteration }}" />
                                    <label class="form-check-label" for="cara_masuk{{ $loop->iteration }}">
                                        {{ $in ?? '' }}
                                    </label>
                                </div>
                            @endforeach
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" name="cara_masuk_input"
                                        placeholder="Cara Masuk Lainnya" aria-describedby="floatingInputHelp"
                                        onfocus="clearRadio('radio_cara_masuk')" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold m-0 mt-2">Asal Masuk :</p>
                        <div class="mb-3 mx-3" id="radio_asal_masuk">
                            @foreach ($asal_masuk as $asal)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="asal_masuk"
                                        value="{{ $asal }}" id="asal_masuk{{ $loop->iteration }}" />
                                    <label class="form-check-label" for="asal_masuk{{ $loop->iteration }}">
                                        {{ $asal ?? '' }}
                                    </label>
                                </div>
                            @endforeach
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" name="asal_masuk_input"
                                        placeholder="Asal Masuk Lainnya" aria-describedby="floatingInputHelp"
                                        onfocus="clearRadio('radio_asal_masuk')" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <p class="fw-bold m-0 mt-2">Jenis Kasus :</p>
                        <div class="mb-3 mx-3">
                            @foreach ($jenis_kasus as $kasus)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kasus"
                                        value="{{ $kasus }}" id="jenis_kasus{{ $loop->iteration }}" />
                                    <label class="form-check-label" for="jenis_kasus{{ $loop->iteration }}">
                                        {{ $kasus ?? '' }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr class="m-0">
                <p class="fw-bold m-0 mt-2 mb-3 text-start">Keluhan Utama :
                    <button type="button" class="btn btn-success ms-auto btn-sm m-0" onclick="createScale()">Tambah
                        Skala</button>
                    <button type="button" class="btn btn-success ms-auto btn-sm m-0" onclick="createCategory()">Tambah
                        Kategori Pemeriksaan</button>
                    <button type="button" class="btn btn-success ms-auto btn-sm m-0" onclick="createCheckup()">Tambah
                        Pemeriksaan</button>
                </p>
                <div class="row mb-3">
                    <label for="defaultSelect" class="col-md-2 col-form-label">Skala</label>
                    <div class="col-md-10">
                        <select id="skala" class="form-select" onchange="getPemeriksaan()">
                            <option selected disabled>Pilih</option>
                            @foreach ($dataSkala as $skala)
                                <option value="{{ $skala->id }}">{{ $skala->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row" id="showCheckup">

                </div>
                <hr class="m-0">
                <p class="fw-bold m-0 mt-2">Death On Arrival :
                </p>
                <div class="col-4">
                    <div class="mx-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="kehidupan"
                                value="Tidak ada tanda kehidupan" id="kehidupan" />
                            <label class="form-check-label" for="kehidupan">
                                Tidak ada tanda kehidupan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="nadi" value="Tidak ada denyut nadi"
                                id="nadi" />
                            <label class="form-check-label" for="nadi">
                                Tidak ada denyut nadi
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="reflek" value="Reflek cahaya (-/-)"
                                id="reflek" />
                            <label class="form-check-label" for="reflek">
                                Reflek cahaya (-/-)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ekg" value="Ekg Flat"
                                id="ekg" />
                            <label class="form-check-label" for="ekg">
                                Ekg Flat
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label mx-3">Jam DOA</label>
                        <div class="col-md-8">
                            <input class="form-control form-control-sm" type="time" name="jam_doa" value=""
                                id="html5-date-input" />
                        </div>
                    </div>
                </div>

                <p class="fw-bold">Ket : Pada tingkat kegawatan, berikan tanda centang (√) , pada kolom yang tersedia</p>
                <p class="text-uppercase fw-bold">intervensi dan responsnya <br>tindakan/medikamentosa</p>
                <table class="table table-bordered">
                    <tr class="border border-1">
                        <td>Jalan Nafas</td>
                        <td><input type="text" name="jalan_nafas" class="form-control form-control-sm"
                                placeholder="Jalan Nafas"></td>
                    </tr>
                    <tr class="border border-1">
                        <td>Pernapasan</td>
                        <td><input type="text" name="pernapasan" class="form-control form-control-sm"
                                placeholder="Pernapasan"></td>
                    </tr>
                    <tr class="border border-1">
                        <td>Sirkulasi</td>
                        <td><input type="text" name="sirkulasi" class="form-control form-control-sm"
                                placeholder="Sirkulasi"></td>
                    </tr>
                    <tr class="border border-1">
                        <td>Disabilitas</td>
                        <td><input type="text" name="disabilitas" class="form-control form-control-sm"
                                placeholder="Disabilitas"></td>
                    </tr>
                    <tr class="border border-1">
                        <td>Lain-lain</td>
                        <td><input type="text" name="lain" class="form-control form-control-sm"
                                placeholder="Lain-Lain"></td>
                    </tr>
                </table>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success btn-sm"
                        onclick="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">Simpan</button>
                </div>
            </div>
            {{-- modal --}}
            <div class="modal fade" id="modal_triase" tabindex="-1" aria-labelledby="modalScrollableTitle"
                aria-hidden="true">
            </div>

        </form>
    </div>

    <script>
        function getPemeriksaan() {
            var skala_id = $('#skala').val();
            $.ajax({
                type: 'get',
                url: "{{ url('igd/triase/get/checkup') }}/" + skala_id,

                success: function(data) {
                    var row = document.getElementById('showCheckup');
                    row.innerHTML = data;
                }
            });
        }

        function createScale() {
            $.ajax({
                type: 'get',
                url: "{{ URL::route('igd/triase/skala.create') }}",
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
                    div.innerHTML = data;

                    $('#modal_triase').html(div);
                    $('#modal_triase').modal('show');
                }
            });
        }

        function createCategory() {
            $.ajax({
                type: 'get',
                url: "{{ URL::route('igd/triase/kategori.create') }}",
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
                    div.innerHTML = data;

                    $('#modal_triase').html(div);
                    $('#modal_triase').modal('show');
                }
            });
        }

        function createCheckup() {
            $.ajax({
                type: 'get',
                url: "{{ URL::route('igd/triase/pemeriksaan.create') }}",
                success: function(data) {
                    var div = document.createElement('div');
                    div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
                    div.innerHTML = data;

                    $('#modal_triase').html(div);
                    $('#modal_triase').modal('show');
                }
            });
        }

        function clearRadio(id) {
            var all_input = $('#' + id).find('.form-check-input');
            all_input.each(function() {
                $(this).prop('checked', false);
            });
        }
    </script>
@endsection
