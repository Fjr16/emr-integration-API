@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-3 mt-5">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Pilih Kamar Pasien</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Nomor Antrian</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                value="{{ $rawatInap->queue->no_antrian }}" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Nama</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                value="{{ $rawatInap->queue->patient->name }}" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Lantai</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                value="{{ $rawatInap->bed->bedroom->floor->name ?? '----' }}" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Nama Kamar</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                value="{{ $rawatInap->bed->bedroom->name ?? '----' }}" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Nomor Kasur</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                value="{{ $rawatInap->bed->name ?? '----' }}" disabled />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Tipe</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                value="{{ $rawatInap->bed->bedroomType->name ?? '----' }}" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Tanggal Masuk</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                value="{{ $rawatInap->mulai ?? '----' }}" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Tanggal Keluar</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                value="{{ $rawatInap->selesai ?? '----' }}" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Keterangan</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                value="{{ $rawatInap->status ?? '----' }}" disabled />
                        </div>
                    </div>

                </div>
            </div>


            <hr>
            <div class="col-sm-12">
                <table class="table">
                    <thead>
                        <tr class="text-nowrap bg-dark">
                            <th>No</th>
                            <th>Lantai</th>
                            <th>Nama Kamar</th>
                            <th>Tipe</th>
                            <th>Nomor Kasur</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bed as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->bedroom->floor->name }}</td>
                                <td>{{ $item->bedroom->name }}</td>
                                <td>{{ $item->bedroomType->name }}</td>
                                <td>{{ $item->name }}</td>
                                @if ($rawatInap->bed_id == $item->id)
                                    <td>{{ $rawatInap->status }}</td>
                                @else
                                    <td>---</td>
                                @endif

                                <td>{{ $item->isAvailable == '1' ? 'Tersedia' : 'Tidak Tersedia' }}</td>



                                {{-- mengecek apakah dia sudah mengambil kamar atau belum --}}
                                @if ($rawatInap->bed_id)
                                    {{-- jika sudah mengambil kamar  --}}
                                    @if ($rawatInap->bed_id == $item->id)
                                        <td class="text-center">
                                            <a href="{{ route('rawat/inap.cancelKamar', ['id' => $rawatInap->id, 'bed_id' => $item->id]) }}"
                                                class="btn btn-dark btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin membatalkan?')">
                                                <i class='bx bx-x-circle'></i> Batalkan
                                            </a>

                                        </td>
                                    @else
                                        <td class="text-center">
                                            --
                                        </td>
                                    @endif
                                @else
                                    {{-- Jika belum Mengambil kamar  --}}
                                    {{-- jika kamar tersedia --}}
                                    @if ($item->isAvailable == '1')
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalTitipkan{{ $item->id }}"><i
                                                    class='bx bxs-bookmark-plus'></i> Titipkan</button>

                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalMasukKamar{{ $item->id }}"><i
                                                    class='bx bxs-door-open'></i> Masuk</button>

                                        </td>
                                    @else
                                        {{-- jika kamar tidak tersedia --}}
                                        <td class="text-center">
                                            <button class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#modalBookingKamar{{ $item->id }}"><i
                                                    class='bx bx-book-bookmark'></i> Booking</button>
                                        </td>
                                    @endif
                                @endif




                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class=" mt-5 justify-content-end">
                <div class="col-sm-12">
                    <a href="{{ route('rawat/inap.index') }}" class="btn btn-dark btn-sm">
                        Kembali</a>
                </div>
            </div>
        </div>
    </div>

    @foreach ($bed as $item)
        {{-- Masuk Kamar Modal --}}
        <div class="modal fade" id="modalMasukKamar{{ $item->id }}" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-xl" id="showStoreModal">
                <form class="modal-content"
                    action="{{ route('rawat/inap.masuk', ['id' => $rawatInap->id, 'bed_id' => $item->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="backDropModalTitle">Pilih Tanggal Masuk Kamar
                            {{ $item->bedroom->name }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Nomor Antrian</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $rawatInap->queue->no_antrian }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Nama</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $rawatInap->queue->patient->name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Lantai</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $item->bedroom->floor->name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Nama kamar</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $item->bedroom->name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Type</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $item->bedroomType->name }}" disabled />
                            </div>
                        </div>
                        <hr>
                        <small class="text-danger">*Pilih Tanggal Masuk dan keluar</small>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Tanggal Masuk</label>
                            <div class="col-sm-5">
                                <input type="datetime-local" name="mulai" class="form-control form-control-sm"
                                    id="basic-default-name" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Tanggal Keluar</label>
                            <div class="col-sm-5">
                                <input type="datetime-local" name="selesai" class="form-control form-control-sm"
                                    id="basic-default-name" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                            aria-label="Close">Batalkan</button>
                        <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Masuk Kamar END --}}

        {{-- Titipkan Kamar Modal --}}
        <div class="modal fade" id="modalTitipkan{{ $item->id }}" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-xl" id="showStoreModal">
                <form class="modal-content"
                    action="{{ route('rawat/inap.titip', ['id' => $rawatInap->id, 'bed_id' => $item->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="backDropModalTitle">Pilih Tanggal Titip Kamar
                            {{ $item->bedroom->name }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Nomor Antrian</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $rawatInap->queue->no_antrian }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Nama</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $rawatInap->queue->patient->name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Lantai</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $item->bedroom->floor->name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Nama kamar</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $item->bedroom->name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Type</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $item->bedroomType->name }}" disabled />
                            </div>
                        </div>
                        <hr>
                        <small class="text-danger">*Pilih Tanggal Masuk dan keluar</small>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Tanggal Masuk</label>
                            <div class="col-sm-5">
                                <input type="datetime-local" name="mulai" class="form-control form-control-sm"
                                    id="basic-default-name" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Tanggal Keluar</label>
                            <div class="col-sm-5">
                                <input type="datetime-local" name="selesai" class="form-control form-control-sm"
                                    id="basic-default-name" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                            aria-label="Close">Batalkan</button>
                        <button type="submit" class="btn btn-dark btn-sm" name="status_antrian"
                            value="Simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Titip Kamar END --}}


        {{-- Booking Kamar Modal --}}
        <div class="modal fade" id="modalBookingKamar{{ $item->id }}" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-xl" id="showStoreModal">
                <form class="modal-content"
                    action="{{ route('rawat/inap.booking', ['id' => $rawatInap->id, 'bed_id' => $item->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="backDropModalTitle">Pilih Tanggal Booking Kamar
                            {{ $item->bedroom->name }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Nomor Antrian</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $rawatInap->queue->no_antrian }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Nama</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $rawatInap->queue->patient->name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Lantai</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $item->bedroom->floor->name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Nama kamar</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $item->bedroom->name }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Type</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="basic-default-name"
                                    value="{{ $item->bedroomType->name }}" disabled />
                            </div>
                        </div>
                        <hr>
                        <small class="text-danger">*Pilih Tanggal Masuk dan keluar</small>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Tanggal Masuk</label>
                            <div class="col-sm-5">
                                <input type="datetime-local" name="mulai" class="form-control form-control-sm"
                                    id="basic-default-name" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="basic-default-name">Tanggal Keluar</label>
                            <div class="col-sm-5">
                                <input type="datetime-local" name="selesai" class="form-control form-control-sm"
                                    id="basic-default-name" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                            aria-label="Close">Batalkan</button>
                        <button type="submit" class="btn btn-dark btn-sm" name="status_antrian"
                            value="Simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- Booking Kamar END --}}
    @endforeach
@endsection
