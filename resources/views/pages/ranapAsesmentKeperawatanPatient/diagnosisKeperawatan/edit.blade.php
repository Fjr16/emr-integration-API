@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
  <div class="card mb-4">
    <div class="card-header m-0">
        <div class="row">
        <div class="col-9">
            <h5 class="mb-0 m-0">Asesmen Perawat <span class="fs-4 fw-bold text-primary">{{ $item->patient->name ?? '' }}</span></h5>
        </div>
        <div class="col-3 m-0 text-end">
          <a href="{{ route('ranap/assesmen/awal/keperawatan.detail', $item->patient_id) }}" class="btn btn-success btn-sm">Kembali</a>
        </div>
        </div>
        <div class="row m-auto mt-2">
          <a href="{{ route('ranap/assesmen/awal/keperawatan.edit', $item->id) }}" class="btn {{ Route::is('ranap/assesmen/awal/keperawatan.edit*') ? 'btn-primary' : '' }} border btn-sm col-3">Status Fisik</a>
          <a href="{{ route('ranap/asesmen/skrining/resiko/jatuh.edit', $item->id) }}" class="btn {{ Route::is('ranap/asesmen/skrining/resiko/jatuh.edit*') ? 'btn-primary' : '' }} border btn-sm col-3">Skrining Resiko Jatuh</a>
          <a href="{{ route('ranap/asesmen/diagnosis/keperawatan.edit', $item->id) }}" class="btn {{ Route::is('ranap/asesmen/diagnosis/keperawatan.edit*') ? 'btn-primary' : '' }} border btn-sm col-3">Diagnosis Keperawatan</a>
          <a href="{{ route('ranap/asesmen/rencana/asuhan.edit', $item->id) }}" class="btn {{ Route::is('ranap/asesmen/rencana/asuhan.edit*') ? 'btn-primary' : '' }} border btn-sm col-3">Rencana Asuhan</a>
        </div>
    </div>

    <div class="card-body">
      <h6 class="text-center bg-dark text-white py-2">DIAGNOSIS KEPERAWATAN</h6>
      <form action="{{ route('ranap/asesmen/diagnosis/keperawatan.store', $item->queue_id) }}" method="POST">
        @csrf
        <div class="row mb-3">
            @php
            if ($ansietas != null) {
                $diagnosa = $ansietas->diagnosa;
            } else {
                $diagnosa = null;
            }
            @endphp
          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" name="diagnosis-keperawatan[]" value="Ansietas" {{$diagnosa == 'Ansietas' ? 'checked' : ''}} id="defaultCheck1" />
            <label class="form-check-label" for="defaultCheck1">
              Ansietas
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            @foreach ($bdAnsietas as $bd)
            @php
                $detail = $detailAnsietas->where('name', $bd)->first();
                if ($detail != null) {
                    $checked = 'checked';
                } else {
                    $checked = null;
                }
            @endphp
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{$bd}}" {{$checked}} name="ansietas[]" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                {{ $bd }}
              </label>
            </div>
            @endforeach
          </div>
          @php
            if ($nyeriAkut != null) {
                $diagnosa = $nyeriAkut->diagnosa;
            } else {
                $diagnosa = null;
            }
            @endphp
          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="Nyeri Akut" {{$diagnosa == 'Nyeri Akut' ? 'checked' : ''}} name="diagnosis-keperawatan[]" id="defaultCheck1" />
            <label class="form-check-label" for="defaultCheck1">
              Nyeri Akut
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            @foreach ($bdNyeriAkut as $bd)
            @php
                $detail = $detailNyeriAkut->where('name', $bd)->first();
                if ($detail != null) {
                    $checked = 'checked';
                } else {
                    $checked = null;
                }
            @endphp
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{$bd}}" {{$checked}} name="nyeri-akut[]" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                {{ $bd }}
              </label>
            </div>
            @endforeach
          </div>
          @php
            if ($nyeriKronis != null) {
                $diagnosa = $nyeriKronis->diagnosa;
            } else {
                $diagnosa = null;
            }
            @endphp
          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="Nyeri Kronis" {{$diagnosa == 'Nyeri Kronis' ? 'checked' : ''}} name="diagnosis-keperawatan[]" id="defaultCheck1" />
            <label class="form-check-label" for="defaultCheck1">
              Nyeri Kronis
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            @foreach ($bdNyeriKronis as $bd)
            @php
                $detail = $detailNyeriKronis->where('name', $bd)->first();
                if ($detail != null) {
                    $checked = 'checked';
                } else {
                    $checked = null;
                }
            @endphp
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{$bd}}" {{$checked}} name="nyeri-kronis[]" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                {{ $bd }}
              </label>
            </div>
            @endforeach
          </div>
          @php
            if ($gangguanMobilitasFisik != null) {
                $diagnosa = $gangguanMobilitasFisik->diagnosa;
            } else {
                $diagnosa = null;
            }
            @endphp
          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="Gangguan Mobilitas Fisik" {{$diagnosa == 'Gangguan Mobilitas Fisik' ? 'checked' : ''}} name="diagnosis-keperawatan[]" id="defaultCheck1" />
            <label class="form-check-label" for="defaultCheck1">
              Gangguan Mobilitas Fisik
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            @foreach ($bdFisik as $bd)
            @php
                $detail = $detailGangguanMobilitasFisik->where('name', $bd)->first();
                if ($detail != null) {
                    $checked = 'checked';
                } else {
                    $checked = null;
                }
            @endphp
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{$bd}}" {{$checked}} name="gangguan-mobilitas-fisik[]" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                {{ $bd }}
              </label>
            </div>
            @endforeach
          </div>
          @php
            if ($nausea != null) {
                $diagnosa = $nausea->diagnosa;
            } else {
                $diagnosa = null;
            }
            @endphp
          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="Nausea" {{$diagnosa == 'Nausea' ? 'checked' : ''}} name="diagnosis-keperawatan[]" id="defaultCheck1" />
            <label class="form-check-label" for="defaultCheck1">
              Nausea
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            @foreach ($bdNausea as $bd)
            @php
                $detail = $detailNausea->where('name', $bd)->first();
                if ($detail != null) {
                    $checked = 'checked';
                } else {
                    $checked = null;
                }
            @endphp
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{$bd}}" {{$checked}} name="nausea[]" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
               {{$bd}}
              </label>
            </div>
            @endforeach
          </div>
          @php
            if ($risikoPendarahan != null) {
                $diagnosa = $risikoPendarahan->diagnosa;
            } else {
                $diagnosa = null;
            }
            @endphp
          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="Risiko Pendarahan" {{$diagnosa == 'Risiko Pendarahan' ? 'checked' : ''}} name="diagnosis-keperawatan[]" id="defaultCheck1" />
            <label class="form-check-label" for="defaultCheck1">
              Risiko Pendarahan
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            @foreach ($bdPendarahan as $bd)
            @php
                $detail = $detailRisikoPendarahan->where('name', $bd)->first();
                if ($detail != null) {
                    $checked = 'checked';
                } else {
                    $checked = null;
                }
            @endphp
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{$bd}}" {{$checked}} name="risiko-pendarahan[]" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                {{ $bd }}
              </label>
            </div>
            @endforeach
          </div>
          @php
            if ($lainnya != null) {
                $diagnosa = $lainnya->diagnosa;
            } else {
                $diagnosa = '';
            }
            @endphp
          <div class="col-sm-3 form-check">
            <div class="d-flex align-items-center">
              <label class="form-control-label col-sm-4" for="lainnya">Lainnya</label>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="lainnya" value="{{$diagnosa}}" name="diagnosis-lainnya" placeholder="" aria-describedby="floatingInputHelp" />
              </div>
            </div>
          </div>
          <div class="col-sm-1 mx-4">
            <p class="fw-bold mx-4">b.d.</p>
          </div>
          <div class="col-sm-4">
            @foreach ($detailLainnya as $detail)
                <div id="" class="row py-1">
                    <input class="form-control form-control-sm mx-3" style="max-width: 300px" value="{{$detail->name}}" name="lainnya[]" type="text" aria-label=".form-control-sm example">
                </div>
            @endforeach
            <div id="input-container1" class="row py-1">
                <input class="form-control form-control-sm mx-3" style="max-width: 300px" value="" name="lainnya[]" type="text" aria-label=".form-control-sm example">
                <a class="btn btn-sm btn-dark text-white" style="max-width: 40px" onclick="addInput('input-container1')">+</a>
            </div>
          </div>
        </div>
        <h6 class="text-center bg-dark text-white py-2">MASALAH KEPERAWATAN</h6>
        <div class="row mb-3">
          <div class="col-sm-4 ">
            <div class="mx-2">
              @foreach ($masalahKeperawatan as $keperawatan)
              @php
                  $detail = $detailMasalahKeperawatan->where('diagnosa', $keperawatan)->first();
                  if ($detail != null) {
                    $checked = 'checked';
                  } else {
                    $checked = null;
                  }
              @endphp
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$keperawatan}}" {{$checked}} name="masalah-keperawatan[]" id="defaultCheck1" />
                <label class="form-check-label" for="defaultCheck1">
                  {{ $keperawatan }}
                </label>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
      </form>
    </div>
</div>

@endsection
