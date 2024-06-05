@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="card mb-4">
        <div class="card-header d-flex">
            <div class="col-10 d-flex align-items-center">
                <h5 class="mb-0">Tambah Permintaan Radiologi</h5>
            </div>
            <div class="col-2 text-end">
                <button type="button" class="btn btn-success btn-sm text-end" onclick="history.back()">Kembali</button>
            </div>
        </div>
        <form action="{{ route('radiologi/request.store', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <h6>Asal Ruangan</h6>
                    <input type="text" value="{{ $item->roomDetail->name ?? '' }}" class="form-control" id="floatingInput" placeholder="" aria-describedby="floatingInputHelp" disabled/>
                </div>
                <div class="mb-3">
                    <h6>Diagnosa Klinis</h6>
                    {{-- <input type="text" name="diagnosa_klinis" class="form-control" id="floatingInput" value="{{ $diagnosa ?? '' }}" placeholder="" aria-describedby="floatingInputHelp" /> --}}
                    <textarea name="diagnosa_klinis" id="editor">{{ $item->diagnosa ?? '' }}</textarea>
                </div>
                <div class="row mb-3">
                        @foreach ($data as $item)
                            <div class="col-6">
                                <p class="fw-bold m-0">{{ $item->name ?? '' }} :</p>
                                <div class="mb-3 mx-0">
                                @foreach ($item->radiologiFormRequestMasters->where('isActive', true) as $index => $variabel)
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            @if ($variabel->input_type == 'checkbox')
                                                <input class="form-check-input" type="checkbox" name="data[{{ $variabel->id }}][radiologi_form_request_master_id]" value="{{ $variabel->id }}" id="defaultCheck{{ $variabel->id }}" />
                                            @endif
                                            @if ($variabel->input_type == 'text')
                                                <input type="hidden" name="lainnya[{{ $variabel->id }}][radiologi_form_request_master_id]" value="{{ $variabel->id }}" id="defaultCheck{{ $variabel->id }}" />
                                            @endif
                                            <label class="form-check-label mx-2" for="defaultCheck{{ $variabel->id }}">
                                                {{ $variabel->name ?? '' }}
                                            </label>
                                        </div>

                                        @if ($variabel->input_type == 'text')
                                            <div class="col-4">
                                                <input type="text" class="form-control form-control-sm" name="lainnya[{{ $variabel->id }}][nilai]"/>
                                            </div>
                                        @endif
                                        <div class="col-auto ">
                                            @foreach ($variabel->radiologiFormRequestMasterDetails->where('isActive', true) as $detail)
                                                <input class="form-check-input" type="radio" name="data[{{ $variabel->id }}][radiologi_form_request_master_detail_id]" value="{{ $detail->id }}" id="d{{ $detail->id }}{{ $variabel->id }}"/>
                                                <label class="form-check-label" for="d{{ $detail->id }}{{ $variabel->id }}">{{ $detail->name ?? '' }}</label>
                                             @endforeach
                                        </div>
                                    </div>
                                @endforeach
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

