@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Tambah Permintaan Laboratorium</h5>
            <button type="button" class="btn btn-sm btn-success" onclick="history.back()" >Kembali</button>
        </div>
        <form action="{{ route('laboratorium/PK/request.store', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row mb-3">
                            <label for="nama_pasien" class="col-form-label col-3">Nama Pasien</label>
                            <div class="col-9">
                                <input class="form-control" type="text" value="{{ $item->patient->name ?? '' }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal_lahir" class="col-form-label col-3">Tanggal Lahir</label>
                            <div class="col-9">
                                <input class="form-control" type="date" value="{{ $item->patient->tanggal_lhr ?? '' }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_rm" class="col-form-label col-3">No RM</label>
                            <div class="col-9">
                                <input class="form-control" type="text" value="{{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}" disabled />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="diagnosa" class="col-form-label col-3">Diagnosa</label>
                            <div class="col-9">
                                <input class="form-control" type="text" name="diagnosa" value="{{ $item->diagnosa ?? '' }}" id="diagnosa" />
                                {{-- <textarea class="form-control" name="diagnosa" id="editor">{!! $diagnosa ?? '' !!}</textarea> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row mb-3">
                            <label for="patient_category_id" class="col-form-label col-3">Tanggungan</label>
                            <div class="col-9">
                                <select name="patient_category_id" class="form-select" id="patient_category_id">
                                    <option disabled selected>Pilih</option>
                                    @foreach ($patientCategories as $tanggungan)
                                    @if (old('patient_category_id', $item->queue->patientCategory->id) == $tanggungan->id)
                                        <option value="{{ $tanggungan->id }}" selected>{{ $tanggungan->name ?? '' }}</option>
                                    @else
                                        <option value="{{ $tanggungan->id }}">{{ $tanggungan->name ?? '' }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="ruang" class="col-form-label col-3">Ruangan</label>
                            <div class="col-9">
                                <input class="form-control" type="text" name="ruang" value="{{ $item->roomDetail->room->name ?? '' }}" readonly/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="detail-ruang" class="col-form-label col-3">Detail Ruangan</label>
                            <div class="col-9">
                                <input class="form-control" type="text" value="{{ $item->roomDetail->name ?? '' }}" disabled/>
                                {{-- <select name="detail_ruang_id" class="form-select" id="detail-ruang">
                                    <option disabled selected>Pilih</option>
                                    <option value="">Ruang Mawar</option>
                                </select> --}}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="laboratorium_request_type_master_id" class="col-form-label col-3">Kategori Permintaan</label>
                            <div class="col-9">
                                <select name="laboratorium_request_type_master_id" class="form-select" id="laboratorium_request_type_master_id">
                                    <option disabled selected>Pilih</option>
                                    @foreach ($types as $type)
                                    @if (old('laboratorium_request_type_master_id', $item->laboratoriumRequestTypeMaster->id) == $type->id)
                                        <option value="{{ $type->id }}" selected>{{ $type->name ?? '' }}</option>
                                    @else
                                        <option value="{{ $type->id }}">{{ $type->name ?? '' }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal" class="col-form-label col-3">Tanggal Pengambilan Sampel</label>
                            <div class="col-9">
                                <input class="form-control" type="date" value="{{ $item->tanggal ?? date('Y-m-d') }}" name="tanggal" id="tanggal" />
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3 mt-4">
                    @foreach ($data as $item)    
                    <div class="col-3">
                        <h5 class="m-0 mb-3 fw-bold">{{ $item->name ?? '' }}</h5>
                        <div class="mb-3 mx-2">
                            @if ($item->laboratoriumRequestMasterVariables)
                                @foreach ($item->laboratoriumRequestMasterVariables as $variabel)
                                <div class="form-check mt-1">
                                    <input type="checkbox" name="laboratorium_request_master_variable_id[]" id="{{ $variabel->id ?? '' }}" value="{{ $variabel->id }}" class="form-check-input" />
                                    <label class="form-check-label m-0" for="{{ $variabel->id ?? '' }}">
                                    {{ $variabel->name ?? '' }}
                                    </label>
                                </div>
                                @endforeach
                            @endif
                            @if ($item->laboratoriumRequestMasters)
                                @foreach ($item->laboratoriumRequestMasters as $subKategori)
                                    <label class="form-check-label mt-2 fw-bold" for="{{ $subKategori->name }}">{{ $subKategori->name ?? '' }}</label><br>
                                    @foreach ($subKategori->laboratoriumRequestMasterVariables as $variabel2)
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="laboratorium_request_master_variable_id[]" id="{{ $variabel2->id ?? '' }}" value="{{ $variabel2->id }}" class="form-check-input" />
                                        <label class="form-check-label m-0" for="{{ $variabel2->id ?? '' }}">
                                        {{ $variabel2->name ?? '' }}
                                        </label>
                                    </div>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection

