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
@if (session()->has('exceptions'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>
          @foreach (session('exceptions') as $error)
            <li>{{ $error }}</li>
          @endforeach
        </span>
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
<div class="card mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-6 text-start">
                <h5 class="mb-0 fw-bold">Tambah Jadwal</h5>
            </div>
            <div class="col-6 text-end">
                <span class="text-primary text-uppercase fw-bold">{{ ($item->staff_id ?? '') . ' / ' . ($item->name ?? '') }}</span><br>
                <span class="fw-bold text-uppercase fst-italic">{{ $item->poliklinik->name ?? '' }}</span>
            </div>
        </div>
    </div>
    <div class="card-body mt-0">
        <form method="POST" action="{{ route('dokter/jadwal.store', $item->id) }}">
            @csrf
            <hr class="mt-0 mb-3">
            <div class="row mb-2 dinamic-input">
                <div class="col-sm-6">
                    <label class="form-label" for="hari">Hari</label>
                    <select name="day[]" class="form-control" id="hari" required>
                        <option selected disabled>Pilih</option>
                        @foreach ($days as $hr)
                        @if (old('day.' . 0, $item->doctorSchedules[0]->day ?? '') == $hr)
                            <option value="{{ $hr }}" selected>{{ $hr }}</option>
                        @else
                            <option value="{{ $hr }}">{{ $hr }}</option>                            
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <label class="form-label" for="jam_praktek">Jam Praktek</label>
                    <div class="input-group">
                        <input type="time" class="form-control" id="start_at" name="start_at[]" value="{{ old('start_at.' . 0, Carbon\Carbon::parse($item->doctorSchedules[0]->start_at ?? '00:00')->format('H:i')) }}" required/>
                        <span class="input-group-text bg-secondary text-white" id="basic-addon13">hingga</span>
                        <input type="time" class="form-control" id="ends_at" name="ends_at[]" value="{{ old('ends_at.' . 0, Carbon\Carbon::parse($item->doctorSchedules[0]->ends_at ?? '00:00')->format('H:i')) }}" required/>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="input-group mt-3 pt-3">
                        <button type="button" class="btn btn-md btn-primary p-1 me-2" onclick="addContent(this)"><i class="bx bx-plus"></i></button>
                        <button type="button" class="btn btn-md btn-danger p-1" onclick="removeInputDinamic(this)"><i class="bx bx-minus"></i></button>
                    </div>
                </div>
            </div>
            {{--  --}}
            @if (session('_old_input'))
                @foreach (collect(old('day'))->skip(1) as $key => $day)    
                    <div class="row mb-2 dinamic-input">
                        <div class="col-sm-6">
                            <select name="day[{{ $key }}]" class="form-control" id="hari{{ $key }}" required>
                                <option selected disabled>Pilih</option>
                                @foreach ($days as $hr)
                                @if ($day == $hr)
                                    <option value="{{ $hr }}" selected>{{ $hr }}</option>
                                @else
                                    <option value="{{ $hr }}">{{ $hr }}</option>                            
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="time" class="form-control" id="start_at{{ $key }}" name="start_at[{{ $key }}]" value="{{ old('start_at.' . $key) }}" required/>
                                <span class="input-group-text bg-secondary text-white" id="basic-addon13">hingga</span>
                                <input type="time" class="form-control" id="ends_at" name="ends_at[{{ $key }}]" value="{{ old('ends_at.' . $key) }}" required/>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group pt-1">
                                <button type="button" class="btn btn-sm btn-primary p-1 me-2" onclick="addContent(this)"><i class="bx bx-plus"></i></button>
                                <button type="button" class="btn btn-sm btn-danger p-1" onclick="removeInputDinamic(this)"><i class="bx bx-minus"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach ($item->doctorSchedules->skip(1) as $key => $jd)    
                    <div class="row mb-2 dinamic-input">
                        <div class="col-sm-6">
                            <select name="day[{{ $key }}]" class="form-control" id="hari{{ $key }}" required>
                                <option selected disabled>Pilih</option>
                                @foreach ($days as $hr)
                                @if (($jd->day ?? '') == $hr)
                                    <option value="{{ $hr }}" selected>{{ $hr }}</option>
                                @else
                                    <option value="{{ $hr }}">{{ $hr }}</option>                            
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="time" class="form-control" id="start_at{{ $key }}" name="start_at[{{ $key }}]" value="{{ Carbon\Carbon::parse($jd->start_at ?? '00:00')->format('H:i') ?? '' }}" required/>
                                <span class="input-group-text bg-secondary text-white" id="basic-addon13">hingga</span>
                                <input type="time" class="form-control" id="ends_at" name="ends_at[{{ $key }}]" value="{{ Carbon\Carbon::parse($jd->ends_at ?? '00:00')->format('H:i') ?? '00:00' }}" required/>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group pt-1">
                                <button type="button" class="btn btn-sm btn-primary p-1 me-2" onclick="addContent(this)"><i class="bx bx-plus"></i></button>
                                <button type="button" class="btn btn-sm btn-danger p-1" onclick="removeInputDinamic(this)"><i class="bx bx-minus"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            {{--  --}}
            <hr class="mt-5">
            <div class="row justify-content-start mt-4">
                <div class="col-sm-4 text-start">
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function addContent(element){
        var content = `
            <div class="col-sm-6">
                <select name="day[]" class="form-control" id="hari" required>
                    <option selected disabled>Pilih</option>
                    @foreach ($days as $hr)
                        <option value="{{ $hr }}">{{ $hr }}</option>                            
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="time" class="form-control" id="start_at" name="start_at[]" required/>
                    <span class="input-group-text bg-secondary text-white" id="basic-addon13">hingga</span>
                    <input type="time" class="form-control" id="ends_at" name="ends_at[]" required/>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group pt-1">
                    <button type="button" class="btn btn-sm btn-primary p-1 me-2" onclick="addContent(this)"><i class="bx bx-plus"></i></button>
                    <button type="button" class="btn btn-sm btn-danger p-1" onclick="removeInputDinamic(this)"><i class="bx bx-minus"></i></button>
                </div>
            </div>`;
        dinamicInput(element, content, '', 'Pilih', false);
    }
</script>
@endsection