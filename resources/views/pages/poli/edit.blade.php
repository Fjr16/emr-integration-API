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
{{-- @dd(session()->all()); --}}
<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0 fw-bold">Edit Poliklinik</h5>
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('poliklinik.update', $item->id) }}">
      @method('PUT')  
      @csrf
        <div class="row mb-3">
            <div class="col-sm-12 mb-4">
                <label class="form-label" for="basic-default-name">Nama</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $item->name ?? '') }}" placeholder="Nama Poli" required />
            </div>
            <div class="col-sm-6">
                <label class="form-label" for="basic-default-name">Kode Poli</label>
                <input type="text" name="kode" class="form-control" id="kode" value="{{ old('kode', $item->kode ?? '') }}" placeholder="Kode Poli" required />
            </div>
            <div class="col-sm-6">
                <label class="form-label" for="basic-default-name">Kode Antrian</label>
                <input type="text" name="kode_antrian" class="form-control" id="kode_antrian" value="{{ old('kode_antrian', $item->kode_antrian ?? '') }}" placeholder="Kode Antrian" required />
            </div>
        </div>
        {{--  --}}
        <hr class="my-4">
        <div class="row mb-2 dinamic-input">
        <h6 class="fw-bold">Jadwal Praktek</h6>
        <div class="col-sm-4">
            <label for="exampleFormControlSelect1" class="form-label">Dokter</label>
            <select class="form-select form-select-sm select2"
                aria-label="Default select example" name="user_id[]" @required(true)>
                <option selected disabled>Pilih</option>
                @foreach ($data as $dt)
                    @if (old('user_id.' . 0, $item->jadwalDokter[0]->user_id ?? '') == $dt->id)
                        <option value="{{ $dt->id }}" selected>{{ $dt->staff_id . ' / ' . $dt->name }}</option>
                    @else
                        <option value="{{ $dt->id }}">{{ $dt->staff_id . ' / ' . $dt->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-sm-2">
            <label class="form-label" for="tarif">Tarif</label>
            <input type="number" name="tarif[]" class="form-control" id="tarif" placeholder="0" value="{{ old('tarif.' . 0, $item->jadwalDokter[0]->tarif ?? '') }}" required />
        </div>
        <div class="col-sm-2">
            <label class="form-label" for="hari">Hari</label>
            <input type="text" name="day[]" class="form-control" id="hari" placeholder="Hari Praktek" value="{{ old('day.' . 0, $item->jadwalDokter[0]->day ?? '') }}" required />
        </div>
        <div class="col-sm-3">
            <label class="form-label" for="jam_praktek">Jam Praktek</label>
            <div class="input-group">
                <input type="time" class="form-control" id="start_at" name="start_at[]" value="{{ old('start_at.' . 0, Carbon\Carbon::parse($item->jadwalDokter[0]->start_at)->format('H:i')) }}" required/>
                <span class="input-group-text bg-secondary text-white" id="basic-addon13">hingga</span>
                <input type="time" class="form-control" id="ends_at" name="ends_at[]" value="{{ old('ends_at.' . 0, Carbon\Carbon::parse($item->jadwalDokter[0]->ends_at)->format('H:i')) }}" required/>
            </div>
        </div>
        <div class="col-sm-1">
            <div class="input-group mt-3 pt-3">
                <button type="button" class="btn btn-sm btn-primary p-1 me-2" onclick="addContent(this)"><i class="bx bx-plus"></i></button>
                <button type="button" class="btn btn-sm btn-danger p-1" onclick="removeInputDinamic(this)"><i class="bx bx-minus"></i></button>
            </div>
        </div>
        </div>
        {{--  --}}
        @if (session('_old_input'))
        @foreach (collect(old('user_id'))->skip(1) as $key => $userId)    
            <div class="row mb-2 dinamic-input">
                <div class="col-sm-4">
                    <select class="form-select form-select-sm select2" aria-label="Default select example" name="user_id[{{ $key }}]" @required(true)>
                        <option selected disabled>Pilih</option>
                        @foreach ($data as $item)
                            @if ($userId == $item->id)
                                <option value="{{ $item->id }}" selected>{{ $item->staff_id . ' / ' . $item->name }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->staff_id . ' / ' . $item->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                    <input type="number" name="tarif[{{ $key }}]" class="form-control" id="tarif{{ $key }}" placeholder="0" value="{{ old('tarif.' . $key) }}" required />
                </div>
                <div class="col-sm-2">
                    <input type="text" name="day[{{ $key }}]" class="form-control" id="hari{{ $key }}" placeholder="Hari Praktek" value="{{ old('day.' . $key) }}" required />
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="time" class="form-control" id="start_at{{ $key }}" name="start_at[{{ $key }}]" value="{{ old('start_at.' . $key) }}" required/>
                        <span class="input-group-text bg-secondary text-white" id="basic-addon13">hingga</span>
                        <input type="time" class="form-control" id="ends_at" name="ends_at[{{ $key }}]" value="{{ old('ends_at.' . $key) }}" required/>
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="input-group pt-1">
                        <button type="button" class="btn btn-sm btn-primary p-1 me-2" onclick="addContent(this)"><i class="bx bx-plus"></i></button>
                        <button type="button" class="btn btn-sm btn-danger p-1" onclick="removeInputDinamic(this)"><i class="bx bx-minus"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
        @else
        @foreach ($item->jadwalDokter->skip(1) as $key => $jd)    
            <div class="row mb-2 dinamic-input">
                <div class="col-sm-4">
                    <select class="form-select form-select-sm select2" aria-label="Default select example" name="user_id[{{ $key }}]" @required(true)>
                        <option selected disabled>Pilih</option>
                        @foreach ($data as $item)
                            @if ($jd->user->id == $item->id)
                                <option value="{{ $item->id }}" selected>{{ $item->staff_id . ' / ' . $item->name }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->staff_id . ' / ' . $item->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                    <input type="number" name="tarif[{{ $key }}]" class="form-control" id="tarif{{ $key }}" placeholder="0" value="{{ $jd->tarif ?? 0 }}" required />
                </div>
                <div class="col-sm-2">
                    <input type="text" name="day[{{ $key }}]" class="form-control" id="hari{{ $key }}" placeholder="Hari Praktek" value="{{ $jd->day ?? '' }}" required />
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="time" class="form-control" id="start_at{{ $key }}" name="start_at[{{ $key }}]" value="{{ Carbon\Carbon::parse($jd->start_at)->format('H:i') ?? '' }}" required/>
                        <span class="input-group-text bg-secondary text-white" id="basic-addon13">hingga</span>
                        <input type="time" class="form-control" id="ends_at" name="ends_at[{{ $key }}]" value="{{ Carbon\Carbon::parse($jd->ends_at)->format('H:i') ?? '00:00' }}" required/>
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="input-group pt-1">
                        <button type="button" class="btn btn-sm btn-primary p-1 me-2" onclick="addContent(this)"><i class="bx bx-plus"></i></button>
                        <button type="button" class="btn btn-sm btn-danger p-1" onclick="removeInputDinamic(this)"><i class="bx bx-minus"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
        {{--  --}}
        <hr class="mb-4">
        <div class="row justify-content-start">
            <div class="col-sm-4 text-start">
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script>
    let counter = 0;
    function addContent(element){
        counter = counter+1;
        var content = `
            <div class="col-sm-4">
                <select class="form-select form-select-sm" aria-label="Default select example" name="user_id[]" id="user_id_${counter}" @required(true)>
                    <option selected disabled>Pilih</option>
                    @foreach ($data as $item)
                        @if (old('user_id') == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->staff_id . ' / ' . $item->name }}</option>
                        @else
                            <option value="{{ $item->id }}">{{ $item->staff_id . ' / ' . $item->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <input type="number" name="tarif[]" class="form-control" id="tarif" placeholder="0" required />
            </div>
            <div class="col-sm-2">
                <input type="text" name="day[]" class="form-control" id="hari" placeholder="Hari Praktek" required />
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="time" class="form-control" id="start_at" name="start_at[]" required/>
                    <span class="input-group-text bg-secondary text-white" id="basic-addon13">hingga</span>
                    <input type="time" class="form-control" id="ends_at" name="ends_at[]" required/>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="input-group pt-1">
                    <button type="button" class="btn btn-sm btn-primary p-1 me-2" onclick="addContent(this)"><i class="bx bx-plus"></i></button>
                    <button type="button" class="btn btn-sm btn-danger p-1" onclick="removeInputDinamic(this)"><i class="bx bx-minus"></i></button>
                </div>
            </div>`;
        dinamicInput(element, content, 'user_id_'+counter, 'Pilih', false);
    }
</script>
@endsection