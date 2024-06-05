@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="mb-5 border alert alert-success w-100 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="mb-4 card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Intervensi Pencegahan Risiko Jatuh
            </h5>
        </div>
        <form action="{{ route('kemoterapi/intervensi/pencegahan/resiko/jatuh.update', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
            @csrf
            <div class="card-body">
                <div class="mb-3 row">
                    <label class="col-10 col-form-label">Tanggal dan jam</label>
                    <div class="col-2">
                        <input class="form-control" type="datetime-local" value="{{ $item->tanggal }}" name="tanggal"/>
                    </div>
                </div>
                <div class="mb-3">
                    @if ($item->kemoterapiMonitoringResikoJatuhPatient->nilai_skor == 'RR')
                        <p class="m-0 fw-bold">Intervensi risiko jatuh rendah (RR)</p>
                    @elseif ($item->kemoterapiMonitoringResikoJatuhPatient->nilai_skor == 'RS')
                        <p class="m-0 fw-bold">Intervensi risiko jatuh sedang (RS)</p>
                    @elseif ($item->kemoterapiMonitoringResikoJatuhPatient->nilai_skor == 'RT')
                        <p class="m-0 fw-bold">Intervensi risiko jatuh tinggi (RT)</p>
                    @endif
                    @foreach ($data as $tindakan)
                        @if ($item->kemoterapiMonitoringResikoJatuhPatient->nilai_skor == 'RR')
                            @if ($loop->iteration == 2 ||$loop->iteration == 3 ||$loop->iteration == 4 ||$loop->iteration == 5)
                                <div class="row">
                                    <div class="col"></div>
                                    <label class="col-10 col-form-label">{{$tindakan['no']}}. {{$tindakan['name']}}</label>
                                    <div class="col-1">
                                        @php
                                            $detail = $details->where('tindakan', $tindakan['name'])->first();
                                            if ($detail != null) {
                                                $detailTindakan = 'checked';
                                            }else{
                                                $detailTindakan = '';
                                            }
                                        @endphp
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox" value="{{$tindakan['name']}}" {{$detailTindakan}} />
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="{{$loop->first ? '' : 'mb-3'}} row">
                                    <label class="col-11 col-form-label">{{ $tindakan['no'] }}. {{ $tindakan['name'] }}</label>
                                    <div class="col-1">
                                        @php
                                            $detail = $details->where('tindakan', $tindakan['name'])->first();
                                            if ($detail != null) {
                                                $detailTindakan = $detail->tindakan;
                                            }else{
                                                $detailTindakan = 'Unknown';
                                            }
                                        @endphp
                                        <div class="form-check">
                                            <input class="text-center form-check-input" name="tindakan[]" type="checkbox" value="{{ $tindakan['name'] }}" {{ $tindakan['name'] == $detailTindakan ? 'checked' : '' }} />
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="mb-3 row">
                                <label class="col-11 col-form-label">{{ $loop->iteration }}. {{ $tindakan }}</label>
                                <div class="col-1">
                                    @php
                                        $detail = $details->where('tindakan', $tindakan)->first();
                                        if ($detail != null) {
                                            $detailTindakan = $detail->tindakan;
                                        }else{
                                            $detailTindakan = 'Unknown';
                                        }
                                    @endphp
                                    <div class="form-check">
                                        <input class="text-center form-check-input" name="tindakan[]" type="checkbox" value="{{ $tindakan }}" {{ $tindakan == $detailTindakan ? 'checked' : '' }} />
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row">
                    <label class="col-3 col-form-label fw-bold">Paraf dan Nama Perawat (Inisial)</label>
                    <div class="col-9">
                        <input class="text-center form-control" type="text" value="{{ Auth::user()->name }}" disabled/>
                    </div>
                </div>
                <div class="mb-3 mt-5 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
