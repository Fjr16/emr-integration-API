@extends('layouts.backend.main')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah Monitoring Tindakan Kemoterapi
                <span class="text-primary">{{ $item->queue->patient->name ?? '' }}</span>
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('kemoterapi/monitoring-tindakan.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <p>PREKEMO</p>
                    <div class="mx-5">
                        <div class="row mb-3">
                            <label for="TD" class="col-form-label col-12 col-md-6 col-lg-2 text-capitalize">TD
                                (MmHg)</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="number" value="{{ $item->prekemo->first()->td }}"
                                    name="prekemoTD" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Nadi" class="col-form-label col-12 col-md-6 col-lg-2 text-capitalize">Nadi
                                (X/Menit)</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="number" value="{{ $item->prekemo->first()->nadi }}"
                                    name="prekemoNadi" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="RR" class="col-form-label col-12 col-md-6 col-lg-2 text-capitalize">RR
                                (X/Menit)</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="number" value="{{ $item->prekemo->first()->rr }}"
                                    name="prekemoRR" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Suhu" class="col-form-label col-12 col-md-6 col-lg-2 text-capitalize">Suhu
                                (°C)</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="number" value="{{ $item->prekemo->first()->suhu }}"
                                    name="prekemoSuhu" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ruangan" class="col-form-label col-12 col-md-6 col-lg-2 text-capitalize">Nama
                                Perawat</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="text"
                                    value="{{ $item->prekemo->first()->nama_perawat }}" name="prekemoNamaPerawat" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="regimen" class="col-form-label col-12 col-md-6 col-lg-2 text-capitalize">Regimen
                                Cairan
                                dan Obat</label>
                            <div class="col-12 col-lg-10">
                                {{-- check 1 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                name="prekemoCheck[]" value="Cairan NaCl 0,9 %"
                                                @if ($item->prekemo->first()->kemoterapiRegimen->first()->name == 'Cairan NaCl 0,9 %') checked @endif />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Cairan NaCl 0,9 % </div>
                                                <div class="ms-2"><input class="form-control" type="number"
                                                        value="{{ $item->prekemo->first()->kemoterapiRegimen->first()->keterangan }}"
                                                        name="prekemoInput[]" />
                                                </div>
                                                <div class="ms-2 pt-2">cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="prekemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="prekemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 2 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                name="prekemoCheck[]" value="Injeksi Dexametasone 5 mg / 1 amp"
                                                @if ($item->prekemo->first()->kemoterapiRegimen->first()->name == 'Injeksi Dexametasone 5 mg / 1 amp') checked @endif />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Injeksi Dexametasone 5 mg /
                                                    1 amp</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="prekemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="prekemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 3 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                name="prekemoCheck[]" value="Injeksi Ranitidine 50 mg / 1 amp"
                                                @if ($item->prekemo->first()->kemoterapiRegimen->first() == 'Injeksi Ranitidine 50 mg /1 amp') checked @endif />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Injeksi Ranitidine 50 mg /
                                                    1
                                                    amp</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="prekemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="prekemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 4 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                name="prekemoCheck[]" value="Injeksi Ondansentrone 8 mg / 1 amp"
                                                @if ($item->prekemo->first()->kemoterapiRegimen->first()->name == 'Injeksi Ondansentrone 8 mg / 1 amp') checked @endif />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Injeksi Ondansentrone 8 mg
                                                    / 1
                                                    amp</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="prekemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="prekemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 5 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                name="prekemoCheck[]" value="Injeksi Diphenhidramine 10 mg / 1 amp"
                                                @if ($item->prekemo->first()->kemoterapiRegimen->first()->name == 'Injeksi Diphenhidramine 10 mg / 1 amp') checked @endif />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Injeksi Diphenhidramine 10
                                                    mg
                                                    / 1 amp</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="prekemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="prekemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check lainnya --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <input type="text" class="form-control pt-2" name="prekemoCheck[]">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="prekemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="prekemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <button type="button" class="btn btn-dark"
                                                    onclick="tambahPrekemo([this])">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <P>INTRAKEMO</P>
                    <div class="mx-5">
                        <div class="row mb-3">
                            <label for="TD" class="col-form-label col-12 col-md-6 col-lg-2 text-capitalize">TD
                                (MmHg)</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="number" value="{{ $item->intrakemo->first()->td }}"
                                    name="intrakemoTD" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Nadi" class="col-form-label col-12 col-md-6 col-lg-2 text-capitalize">Nadi
                                (X/Menit)</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="number" value="{{ $item->intrakemo->first()->nadi }}"
                                    name="intrakemoNadi" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="RR" class="col-form-label col-12 col-md-6 col-lg-2 text-capitalize">RR
                                (X/Menit)</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="number" value="{{ $item->intrakemo->first()->rr }}"
                                    name="intrakemoRR" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Suhu" class="col-form-label col-12 col-md-6 col-lg-2 text-capitalize">Suhu
                                (°C)</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="number" value="{{ $item->intrakemo->first()->suhu }}"
                                    name="intrakemoSuhu" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ruangan" class="col-form-label col-12 col-md-6 col-lg-2 text-capitalize">Nama
                                Perawat</label>
                            <div class="col-12 col-lg-10">
                                <input class="form-control" type="text"
                                    value="{{ $item->intrakemo->first()->nama_perawat }}" name="intrakemoNamaPerawat" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="regimen" class="col-form-label col-12 col-md-6 col-lg-2 text-capitalize">Regimen
                                Cairan Dan Obat</label>
                            <div class="col-12 col-lg-10">
                                {{-- check 1 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Bilas cairan NaCl 0,9 %" name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Bilas cairan NaCl 0,9 %
                                                </div>
                                                <div class="ms-2"><input class="form-control" type="number"
                                                        name="intrakemoInput[]" />
                                                </div>
                                                <div class="ms-2 pt-2">cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 2 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Docetaxel ... mg di dalam Dextrose 5 % 250 cc"
                                                name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Docetaxel</div>
                                                <div class="ms-2"><input class="form-control" type="number"
                                                        value="" name="intrakemoInput[]" />
                                                </div>
                                                <div class="ms-2 pt-2 pt-lg-0 col-form-label text-capitalize">mg di dalam
                                                    Dextrose 5 %
                                                    250 cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 3 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="defaultCheck1"
                                                value="Brexel ... mg didalam Dextrose 5 % 250 cc"
                                                name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Brexel</div>
                                                <div class="ms-2"><input class="form-control" type="number"
                                                        value="" name="intrakemoInput[]" />
                                                </div>
                                                <div class="ms-2 pt-2 pt-lg-0 col-form-label text-capitalize">mg didalam
                                                    Dextrose 5 %
                                                    250 cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 4 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Novelbin / Vinocal ... mg didalam NaCl 0,9 % 50 cc"
                                                name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 pt-lg-0 col-form-label text-capitalize">Novelbin / Vinocal
                                                </div>
                                                <div class="ms-2"><input class="form-control" type="number"
                                                        value="" name="intrakemoInput[]" />
                                                </div>
                                                <div class="ms-2 pt-2 pt-lg-0 col-form-label text-capitalize">mg didalam
                                                    NaCl
                                                    0,9 % 50
                                                    cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 5 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Bilas cairan NaCl 0,9 % ... cc" name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Bilas cairan NaCl 0,9 %
                                                </div>
                                                <div class="ms-2"><input class="form-control" type="number"
                                                        value="" name="intrakemoInput[]" />
                                                </div>
                                                <div class="ms-2 pt-2 col-form-label text-capitalize">cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 6 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Doxorubicin ... mg di dalam NaCl 0,9 % 100 cc"
                                                name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Doxorubicin</div>
                                                <div class="ms-2"><input class="form-control" type="number"
                                                        value="" name="intrakemoInput[]" />
                                                </div>
                                                <div class="ms-2 pt-2 pt-lg-0 col-form-label text-capitalize">mg di dalam
                                                    NaCl
                                                    0,9 %
                                                    100 cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 7 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Epirubicin ... mg di dalam NaCl 0,9 % 100 cc"
                                                name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Epirubicin</div>
                                                <div class="ms-2"><input class="form-control" type="number"
                                                        value="" name="intrakemoInput[]" />
                                                </div>
                                                <div class="ms-2 pt-2 pt-lg-0 col-form-label text-capitalize">mg di dalam
                                                    NaCl
                                                    0,9 % 100 cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 8 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Bilas cairan NaCl 0,9 % ... cc" name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Bilas cairan NaCl 0,9 %
                                                </div>
                                                <div class="ms-2"><input class="form-control" type="number"
                                                        value="" name="intrakemoInput[]" />
                                                </div>
                                                <div class="ms-2 pt-2">cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 9 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Zoledronic 4 mg infus" name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Zoledronic 4 mg infus
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 10 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Bilas cairan NaCl 0,9 % ... cc" name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Bilas cairan NaCl 0,9 %
                                                </div>
                                                <div class="ms-2"><input class="form-control" type="number"
                                                        value="" name="intrakemoInput[]" />
                                                </div>
                                                <div class="ms-2 pt-2">cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 11 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Cyclovid 600 mg / 800 mg dalam nacl 250cc"
                                                name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Cyclovid 600 mg / 800 mg
                                                    dalam
                                                    nacl 250cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 12 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Bilas cairan NaCl 0,9 % ... cc" name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Bilas cairan NaCl 0,9 %
                                                </div>
                                                <div class="ms-2"><input class="form-control" type="number"
                                                        value="" name="intrakemoInput[]" />
                                                </div>
                                                <div class="ms-2 pt-2">cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 13 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Curacil 500 mg /750 mg dalam nacl 250 cc"
                                                name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Curacil 500 mg /750 mg
                                                    dalam
                                                    nacl 250 cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 14 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Bilas cairan NaCl 0,9 % ... cc" name="intrakemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Bilas cairan NaCl 0,9 %
                                                </div>
                                                <div class="ms-2"><input class="form-control" type="number"
                                                        value="" name="intrakemoInput[]" />
                                                </div>
                                                <div class="ms-2 pt-2">cc</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check lainnya --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <input type="text" class="form-control" name="intrakemoCheck[]">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="intrakemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <button type="button" class="btn btn-dark"
                                                    onclick="tambahIntrakemo([this, 'intrakemoCheck[]'])">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <P>POSTKEMO</P>
                    <div class="mx-5">
                        <div class="row mb-3">
                            <label for="TD" class="col-form-label col-2 text-capitalize">TD (MmHg)</label>
                            <div class="col-10">
                                <input class="form-control" type="number" value="{{ $item->postkemo->first()->td }}"
                                    name="postkemoTD" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Nadi" class="col-form-label col-2 text-capitalize">Nadi (X/Menit)</label>
                            <div class="col-10">
                                <input class="form-control" type="number" value="{{ $item->postkemo->first()->nadi }}"
                                    name="postkemoNadi" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="RR" class="col-form-label col-2 text-capitalize">RR (X/Menit)</label>
                            <div class="col-10">
                                <input class="form-control" type="number" value="{{ $item->postkemo->first()->rr }}"
                                    name="postkemoRR" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Suhu" class="col-form-label col-2 text-capitalize">Suhu (°C)</label>
                            <div class="col-10">
                                <input class="form-control" type="number" value="{{ $item->postkemo->first()->suhu }}"
                                    name="postkemoSuhu" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ruangan" class="col-form-label col-2 text-capitalize">Nama Perawat</label>
                            <div class="col-10">
                                <input class="form-control" type="text"
                                    value="{{ $item->postkemo->first()->nama_perawat }}" name="postkemoNamaPerawat" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="regimen" class="col-form-label col-12 col-md-6 col-lg-2 text-capitalize">Regimen
                                Cairan
                                dan Obat</label>
                            <div class="col-12 col-lg-10">
                                {{-- check 1 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Injeksi Dexametasone 5 mg / 1 amp" name="postkemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Injeksi Dexametasone 5 mg
                                                    / 1
                                                    amp</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="postkemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="postkemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 2 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Injeksi Ranitidine 50 mg / 1 amp" name="postkemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Injeksi Ranitidine 50 mg /
                                                    1
                                                    amp</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="postkemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="postkemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 3 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Injeksi Ondansentrone 8 mg / 1 amp" name="postkemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Injeksi Ondansentrone 8 mg
                                                    /
                                                    1
                                                    amp</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="postkemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="postkemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check 4 --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="form-check">
                                            <input class="form-check-input mt-2" type="checkbox" id="defaultCheck1"
                                                value="Injeksi Lasix 20 mg / 1 amp" name="postkemoCheck[]" />
                                            <div class="d-flex flex-row">
                                                <div class="pt-2 col-form-label text-capitalize">Injeksi Lasix 20 mg / 1
                                                    amp
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="postkemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="postkemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- check lainnya --}}
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <input type="text" class="form-control" name="postkemoCheck[]">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="d-flex flex-row mb-3">
                                            <div class="ms-3">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                        Mulai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="postkemoCheckMulai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <div class="d-flex flex-row mb-3">
                                                    <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                        Selesai</label>
                                                    <div class="ms-2">
                                                        <input class="form-control" type="time" value=""
                                                            name="postkemoCheckSelesai[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <button type="button" class="btn btn-dark"
                                                    onclick="tambahPostkemo([this, 'postkemoCheck[]'])">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col col-12 col-lg-4">
                            <p class="col-form-label text-capitalize">Catatan : Reaksi selama pemasangan obat kemoterapi
                            </p>
                            <p>
                            <div class="d-flex flex-row mb-3">
                                <div class="mt-1">
                                    <div class="form-check">
                                        <span class="col-form-label text-capitalize">Alergi:</span>
                                    </div>
                                </div>
                                <div class="mt-1 ms-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="tidakAlergi"
                                            name="alergi" value="Tidak" checked />
                                        <span class="col-form-label text-capitalize">Tidak &nbsp;</span>
                                    </div>
                                </div>
                                <div class="ms-2">
                                    <div class="form-check">
                                        <div class="d-flex flex-row">
                                            <div class="">
                                                <input class="form-check-input col-3 mt-2" type="radio"
                                                    id="yaAlergi" name="alergi" value="Ya" />
                                            </div>
                                            <span class="col-form-label text-capitalize col-4">Ya, sebutkan</span>
                                            <input class="form-control" type="text" name="alergiKeterangan"
                                                id="alergiKeterangan" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </p>
                            <p>
                            <div class="d-flex flex-row mb-3">
                                <div class="mt-1">
                                    <div class="form-check">
                                        <span class="col-form-label text-capitalize">Ekstravasasi:</span>
                                    </div>
                                </div>
                                <div class="mt-1 ms-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="tidakEkstravasasi"
                                            name="ekstravasasi" value="Tidak" checked />
                                        <span class="col-form-label text-capitalize">Tidak &nbsp;</span>
                                    </div>
                                </div>
                                <div class="ms-2">
                                    <div class="form-check">
                                        <div class="d-flex flex-row">
                                            <div class="">
                                                <input class="form-check-input col-3 mt-2" type="radio"
                                                    id="yaEkstravasasi" name="ekstravasasi" value="Ya" />
                                            </div>
                                            <span class="col-form-label text-capitalize col-4">Ya, sebutkan</span>
                                            <input class="form-control" type="text" value=""
                                                name="ekstravasasiKeterangan" id="ekstravasasiKeterangan" disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>

                        <div class="col col-12 col-lg-4"></div>

                        <div class="col col-12 col-lg-4 text-center pt-3">
                            <div class="col-12 text-center">
                                Petugas Admisi
                            </div>
                            <div class="col-12"></div>
                            <div class="col-12 text-center">
                                Padang, {{ date('d  M  Y') }} <br>
                            </div>
                            <div class="">
                                <div class="col-12 text-center">
                                    <img src="" alt="" id="ImgTtdPpj">
                                    <textarea id="ttdPpj" name="ttd_perawat" style="display: none;"></textarea>
                                    <button type="button" class="col-12 btn btn-sm btn-dark"
                                        onclick="openModal(this)">Tanda
                                        Tangan</button>
                                </div>
                            </div>
                            <div class="mt-3">
                                <input type="text" class="form-control form-control-sm text-center"
                                    value="{{ auth()->user()->name ?? '' }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </div>


                {{-- modal create ttd --}}
                {{-- <div class="modal fade" id="signaturePadModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalScrollableTitle">Signature Pad</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="signature-pad" class="m-signature-pad">
                                <div class="m-signature-pad--body">
                                    <canvas style="border: 3px dashed #ccc"></canvas>
                                </div>

                                <div class="m-signature-pad--footer">
                                    <button type="button" class="btn btn-sm btn-secondary"
                                        data-action="clear">Clear</button>
                                    <button type="button" class="btn btn-sm btn-primary"
                                        data-action="save">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            </form>
        </div>
    </div>

    {{-- modal create ttd --}}
    <div class="modal fade" id="signaturePadModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalScrollableTitle">Signature Pad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="signature-pad" class="m-signature-pad">
                        <div class="m-signature-pad--body">
                            <canvas style="border: 3px dashed #ccc"></canvas>
                        </div>

                        <div class="m-signature-pad--footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-action="clear">Clear</button>
                            <button type="button" class="btn btn-sm btn-primary" data-action="save">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal get ttd --}}
    <div class="modal fade" id="getTtdModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalScrollableTitle">Masukkan Password Akun Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="signature-pad" class="m-signature-pad">
                        <div class="m-signature-pad--body mb-3">
                            <input type="password" class="form-control form-control-sm" name="password_user">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        </div>

                        <div class="m-signature-pad--footer">
                            <button type="button" class="btn btn-sm btn-secondary"
                                data-action="clearInput">Clear</button>
                            <button type="button" class="btn btn-sm btn-primary"
                                data-action="saveInput">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let tempElementImage;
        let tempTextArea;

        function openModal(element) {
            $('#getTtdModal').modal('show');
        }

        function openModalTtdBottom(element, elementImg, elementTextArea) {
            console.log(element.closest('td'));
            tempElementImage = $(element).closest('.row').find('#' + elementImg);
            tempTextArea = $(element).closest('.row').find('#' + elementTextArea);
            $('#signaturePadModal').modal('show');
        }

        document.addEventListener("DOMContentLoaded", function() {
            var wrapper = document.getElementById("signaturePadModal");
            var clearButton = wrapper.querySelector("[data-action=clear]");
            var saveButton = wrapper.querySelector("[data-action=save]");
            var canvas = wrapper.querySelector("canvas");
            var signaturePad;

            // Initialize SignaturePad
            // agar library signature pad dapat digunakan pada modal
            signaturePad = new SignaturePad(canvas);

            // Event handler untuk tombol clear
            clearButton.addEventListener("click", function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            // Event handler untuk tombol save
            // var ttd = document.getElementById('ttd1');
            saveButton.addEventListener("click", function(e) {
                e.preventDefault();
                var signatureData = signaturePad.toDataURL();
                tempElementImage.attr('src', signatureData);
                tempTextArea.val(signatureData);
                // document.getElementById("signature64").value = signatureData;
                signaturePad.clear();

                //close modal
                $('#signaturePadModal').modal('hide');
            });


            // start get ttd from user table
            var modal = document.getElementById("getTtdModal");
            var clearButtonInput = modal.querySelector("[data-action=clearInput]");
            var saveButtonInput = modal.querySelector("[data-action=saveInput]");
            var inputPass = modal.querySelector('input[name="password_user"]');
            var inputUserId = modal.querySelector('input[name="user_id"]');

            saveButtonInput.addEventListener("click", function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: "{{ route('ranap/cppt.getTtd') }}",
                    data: {
                        user_id: inputUserId.value,
                        password: inputPass.value,
                    },
                    success: function(data) {
                        var newSrc = `{{ Storage::url('${data}') }}`;
                        $('#ImgTtdPpj').attr('src', newSrc);
                        $('#ttdPpj').val(data);
                        $('#petugas_name').val(`{{ auth()->user()->name }}`);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log();
                        var errorResponse = jqXHR.responseJSON;
                        if (errorResponse && errorResponse.error) {
                            alert(errorResponse.error)
                        } else {
                            alert('Terjadi Kesalahan Dalam Pengambilan Data');
                        }
                    }
                });

                inputPass.value = '';

                $('#getTtdModal').modal('hide');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var name = document.querySelector('input[name="name"]');
            var namaDis = document.getElementById('nama');
            var nameTtd = document.getElementById('nameTtd');

            name.addEventListener('change', function() {
                namaDis.value = name.value;
                nameTtd.value = name.value;
            });
        });

        function hubunganSelect(element) {
            var hubDis = document.getElementById('hub');
            hubDis.value = element.value;
        }
    </script>

    <script>
        function tambahPrekemo(add) {
            var row = add[0].closest('.row');

            // Create div for text input
            var divText = document.createElement('div');
            divText.className = 'col-12 col-lg-4 mt-1';
            divText.innerHTML = `<input type="text" class="form-control pt-2" name="prekemoCheck[]">`;

            // Create div for start time input
            var divStart = document.createElement('div');
            divStart.className = 'col-12 col-lg-3 mt-1';
            divStart.innerHTML = `<div class="d-flex flex-row mb-3 ms-3">
                                                <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                    Mulai</label>
                                                <div class="ms-2">
                                                    <input class="form-control" type="time" value=""
                                                        name="prekemoCheckMulai[]" />
                                                </div>
                                            </div>`;

            // Create div for end time input
            var divEnd = document.createElement('div');
            divEnd.className = 'col-12 col-lg-3 mt-1';
            divEnd.innerHTML = `<div class="d-flex flex-row mb-3">
                                                <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                    Selesai</label>
                                                <div class="ms-2">
                                                    <input class="form-control" type="time" value=""
                                                        name="prekemoCheckSelesai[]" />
                                                </div>
                                            </div>`;

            // Create div for delete button
            var divButton = document.createElement('div');
            divButton.className = 'col-12 col-lg-1 mt-1 ps-1';
            divButton.innerHTML =
                `<button type="button" class="btn btn-danger" onclick="hapusInputPrekemo(this)">-</button>`;

            // Append all created elements to the row
            elements = [divText, divStart, divEnd, divButton];
            let test = row.append(...elements);
        }



        function hapusInputPrekemo(input) {
            var divButton = input.parentNode;
            var divEnd = divButton.previousElementSibling;
            var divStart = divEnd.previousElementSibling;
            var divText = divStart.previousElementSibling;

            divButton.remove();
            divEnd.remove();
            divStart.remove();
            divText.remove();
        }

        function tambahIntrakemo([add, name]) {
            var row = add.closest('.row');

            // Create div for text input
            var divText = document.createElement('div');
            divText.className = 'col-12 col-lg-4 mt-1';
            divText.innerHTML = `<input type="text" class="form-control pt-2" name="intrakemoCheck[]">`;

            // Create div for start time input
            var divStart = document.createElement('div');
            divStart.className = 'col-12 col-lg-3 mt-1';
            divStart.innerHTML = `<div class="d-flex flex-row mb-3 ms-3">
                                                <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                    Mulai</label>
                                                <div class="ms-2">
                                                    <input class="form-control" type="time" value=""
                                                        name="intrakemoCheckMulai[]" />
                                                </div>
                                            </div>`;

            // Create div for end time input
            var divEnd = document.createElement('div');
            divEnd.className = 'col-12 col-lg-3 mt-1';
            divEnd.innerHTML = `<div class="d-flex flex-row mb-3">
                                                <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                    Selesai</label>
                                                <div class="ms-2">
                                                    <input class="form-control" type="time" value=""
                                                        name="intrakemoCheckSelesai[]" />
                                                </div>
                                            </div>`;

            // Create div for delete button
            var divButton = document.createElement('div');
            divButton.className = 'col-12 col-lg-1 mt-1 ps-1';
            divButton.innerHTML =
                `<button type="button" class="btn btn-danger" onclick="hapusInputIntrakemo(this)">-</button>`;

            // Append all created elements to the row
            elements = [divText, divStart, divEnd, divButton];
            row.append(...elements);
        }

        function hapusInputIntrakemo(input) {
            var divButton = input.parentNode;
            var divEnd = divButton.previousElementSibling;
            var divStart = divEnd.previousElementSibling;
            var divText = divStart.previousElementSibling;

            divButton.remove();
            divEnd.remove();
            divStart.remove();
            divText.remove();
        }

        function tambahPostkemo([add, name]) {
            var row = add.closest('.row');

            // Create div for text input
            var divText = document.createElement('div');
            divText.className = 'col-12 col-lg-4 mt-1';
            divText.innerHTML = `<input type="text" class="form-control pt-2" name="postkemoCheck[]">`;

            // Create div for start time input
            var divStart = document.createElement('div');
            divStart.className = 'col-12 col-lg-3 mt-1';
            divStart.innerHTML = `<div class="d-flex flex-row mb-3 ms-3">
                                                <label for="jamMulai" class="col-form-label text-capitalize">Jam
                                                    Mulai</label>
                                                <div class="ms-2">
                                                    <input class="form-control" type="time" value=""
                                                        name="postkemoCheckMulai[]" />
                                                </div>
                                            </div>`;

            // Create div for end time input
            var divEnd = document.createElement('div');
            divEnd.className = 'col-12 col-lg-3 mt-1';
            divEnd.innerHTML = `<div class="d-flex flex-row mb-3">
                                                <label for="jamSelesai" class="col-form-label text-capitalize">Jam
                                                    Selesai</label>
                                                <div class="ms-2">
                                                    <input class="form-control" type="time" value=""
                                                        name="postkemoCheckSelesai[]" />
                                                </div>
                                            </div>`;

            // Create div for delete button
            var divButton = document.createElement('div');
            divButton.className = 'col-12 col-lg-2 mt-1 ps-1';
            divButton.innerHTML =
                `<button type="button" class="btn btn-danger" onclick="hapusInputPostkemo(this)">-</button>`;

            // Append all created elements to the row
            elements = [divText, divStart, divEnd, divButton];
            row.append(...elements);
        }

        function hapusInputPostkemo(input) {
            var divButton = input.parentNode;
            var divEnd = divButton.previousElementSibling;
            var divStart = divEnd.previousElementSibling;
            var divText = divStart.previousElementSibling;

            divButton.remove();
            divEnd.remove();
            divStart.remove();
            divText.remove();
        }
    </script>

    <script>
        // Select the radio buttons and text inputs
        const tidakAlergi = document.getElementById('tidakAlergi');
        const yaAlergi = document.getElementById('yaAlergi');
        const alergiInput = document.getElementById('alergiKeterangan');
        const tidakEkstravasasi = document.getElementById('tidakEkstravasasi');
        const yaEkstravasasi = document.getElementById('yaEkstravasasi');
        const ekstravasasiInput = document.getElementById('ekstravasasiKeterangan');

        // Function to enable/disable text input based on radio button selection
        function toggleTextInput(radioButton, input) {
            if (radioButton.checked && radioButton.value === 'Ya') {
                input.disabled = false;
            } else {
                input.disabled = true;
            }
        }

        // Add event listeners to the radio buttons
        tidakAlergi.addEventListener('change', () => {
            toggleTextInput(tidakAlergi, alergiInput);
        });

        yaAlergi.addEventListener('change', () => {
            toggleTextInput(yaAlergi, alergiInput);
        });

        tidakEkstravasasi.addEventListener('change', () => {
            toggleTextInput(tidakEkstravasasi, ekstravasasiInput);
        });

        yaEkstravasasi.addEventListener('change', () => {
            toggleTextInput(yaEkstravasasi, ekstravasasiInput);
        });
    </script>
@endsection
