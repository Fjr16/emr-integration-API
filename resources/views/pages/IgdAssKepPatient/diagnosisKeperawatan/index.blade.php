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
            <h5 class="mb-0 m-0">Asesmen Awal Keperawatan <span class="fs-4 fw-bold text-primary">{{ $item->queue->patient->name ?? '' }}</span></h5>
        </div>
        <div class="col-3 m-0 text-end">
          @php
            session()->flash('active', 'asesmenperawat');
          @endphp
          <a href="{{ route('igd/patient/rme.show', $currentIgdPatientId ?? $item->id) }}" class="btn btn-success btn-sm">Kembali</a>
        </div>
        </div>
        <div class="row m-auto mt-2">
          <a href="{{ route('igd/asesmen/status/fisik.index', $item->id) }}" class="btn {{ Route::is('igd/asesmen/status/fisik.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Status Fisik</a>
          <a href="{{ route('igd/asesmen/skrining/resiko/jatuh.index', $item->id) }}" class="btn {{ Route::is('igd/asesmen/skrining/resiko/jatuh.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Skrining Resiko Jatuh</a>
          <a href="{{ route('igd/asesmen/diagnosis/keperawatan.index', $item->id) }}" class="btn {{ Route::is('igd/asesmen/diagnosis/keperawatan.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Diagnosis Keperawatan</a>
          <a href="{{ route('igd/asesmen/rencana/asuhan.index', $item->id) }}" class="btn {{ Route::is('igd/asesmen/rencana/asuhan.index*') ? 'btn-primary' : '' }} border btn-sm col-3">Rencana Asuhan</a>
        </div>
    </div>

    <div class="card-body">
      <h6 class="text-center bg-dark text-white py-2">DIAGNOSIS KEPERAWATAN</h6>
      <form action="{{ route('igd/asesmen/diagnosis/keperawatan.store', $item->id) }}" method="POST">
        @csrf
        <div class="row mb-3">
          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="*) Nyeri Akut / Kronis" name="diagnosis-keperawatan[]" id="*) Nyeri Akut / Kronis " {{ $asesmenDiagnosa->where('diagnosa', '*) Nyeri Akut / Kronis')->first() ? 'checked' : '' }}/>
            <label class="form-check-label" for="*) Nyeri Akut / Kronis ">
              *) Nyeri Akut / Kronis 
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            @php
              $bdna = $asesmenDiagnosa->where('diagnosa', '*) Nyeri Akut / Kronis')->first() ?? '';
            @endphp
            @foreach ($bdNyeriAkut as $bd)
            @php
            $checked = null;
            if ($bdna) {
              $detail = $bdna->igdHubDiagnosisKepAssKepPatients->where('name', $bd)->first();
              if ($detail) {
                  $checked = 'checked';
              }
            }
            @endphp
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{$bd}}" name="nyeri-akut[]" id="{{ $bd }}" {{ $checked }}/>
              <label class="form-check-label" for="{{ $bd }}">
                {{ $bd }}
              </label>
            </div>
            @endforeach
          </div>

          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="Gangguan Mobilitas Fisik" name="diagnosis-keperawatan[]" id="Gangguan Mobilitas Fisik" {{ $asesmenDiagnosa->where('diagnosa', 'Gangguan Mobilitas Fisik')->first() ? 'checked' : '' }} />
            <label class="form-check-label" for="Gangguan Mobilitas Fisik">
              Gangguan Mobilitas Fisik
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
            @php
              $bdf = $asesmenDiagnosa->where('diagnosa', 'Gangguan Mobilitas Fisik')->first() ?? '';
            @endphp
          <div class="col-sm-7">
            @foreach ($bdFisik as $bd)
            @php
            $checked = null;
            if ($bdf) {
              $detail = $bdf->igdHubDiagnosisKepAssKepPatients->where('name', $bd)->first();
              if ($detail) {
                  $checked = 'checked';
              }
            }
            @endphp
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{$bd}}" name="gangguan-mobilitas-fisik[]" id="{{ $bd }}" {{ $checked }}/>
              <label class="form-check-label" for="{{ $bd }}">
                {{ $bd }}
              </label>
            </div>
            @endforeach
          </div>

          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="*) Gangguan Integritas Kulit/jaringan" name="diagnosis-keperawatan[]" id="*) Gangguan Integritas Kulit/jaringan" {{ $asesmenDiagnosa->where('diagnosa', '*) Gangguan Integritas Kulit/jaringan')->first() ? 'checked' : '' }} />
            <label class="form-check-label" for="*) Gangguan Integritas Kulit/jaringan">
              *) Gangguan Integritas Kulit/jaringan
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            @php
              $bdi = $asesmenDiagnosa->where('diagnosa', '*) Gangguan Integritas Kulit/jaringan')->first() ?? '';
            @endphp
            @foreach ($bdIntegritas as $bd)
            @php
            $checked = null;
            if ($bdi) {
              $detail = $bdi->igdHubDiagnosisKepAssKepPatients->where('name', $bd)->first();
              if ($detail) {
                  $checked = 'checked';
              }
            }
            @endphp
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{$bd}}" name="gangguan-integritas-kulit[]" id="{{ $bd }}" {{ $checked }}/>
              <label class="form-check-label" for="{{ $bd }}">
               {{$bd}}
              </label>
            </div>
            @endforeach
          </div>

          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="Retensi Urine" name="diagnosis-keperawatan[]" id="Retensi Urine" {{ $asesmenDiagnosa->where('diagnosa', 'Retensi Urine')->first() ? 'checked' : '' }} />
            <label class="form-check-label" for="Retensi Urine">
              Retensi Urine
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            @php
              $bdu = $asesmenDiagnosa->where('diagnosa', 'Retensi Urine')->first() ?? '';
            @endphp
            @foreach ($bdUrine as $bd)
            @php
            $checked = null;
            if ($bdu) {
              $detail = $bdu->igdHubDiagnosisKepAssKepPatients->where('name', $bd)->first();
              if ($detail) {
                  $checked = 'checked';
              }
            }
            @endphp
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{$bd}}" name="retensi-urine[]" id="{{ $bd }}" {{ $checked }}/>
              <label class="form-check-label" for="{{ $bd }}">
                {{ $bd }}
              </label>
            </div>
            @endforeach
          </div>

          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" name="diagnosis-keperawatan[]" value="Bersihan Jalan Napas Tidak Efektif" id="Bersihan Jalan Napas Tidak Efektif" {{ $asesmenDiagnosa->where('diagnosa', 'Bersihan Jalan Napas Tidak Efektif')->first() ? 'checked' : '' }}/>
            <label class="form-check-label" for="Bersihan Jalan Napas Tidak Efektif">
              Bersihan Jalan Napas Tidak Efektif
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            @php
              $bdjn = $asesmenDiagnosa->where('diagnosa', 'Bersihan Jalan Napas Tidak Efektif')->first() ?? '';
            @endphp
            @foreach ($bdJalanNafas as $bd)
            @php
            $checked = null;
            if ($bdjn) {
              $detail = $bdjn->igdHubDiagnosisKepAssKepPatients->where('name', $bd)->first();
              if ($detail) {
                  $checked = 'checked';
              }
            }
            @endphp
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{$bd}}" name="bersihan-jalan-napas[]" id="{{ $bd }}" {{ $checked }}/>
              <label class="form-check-label" for="{{ $bd }}">
                {{ $bd }}
              </label>
            </div>
            @endforeach
          </div>

          <div class="col-sm-3 form-check mx-4">
            <input class="form-check-input" type="checkbox" value="Pola Napas Tidak Efektif" name="diagnosis-keperawatan[]" id="Pola Napas Tidak Efektif"  {{ $asesmenDiagnosa->where('diagnosa', 'Pola Napas Tidak Efektif')->first() ? 'checked' : '' }}/>
            <label class="form-check-label" for="Pola Napas Tidak Efektif">
              Pola Napas Tidak Efektif
            </label>
          </div>
          <div class="col-sm-1">
            <p class="m-0 fw-bold">b.d.</p>
          </div>
          <div class="col-sm-7">
            @php
              $bdpn = $asesmenDiagnosa->where('diagnosa', 'Pola Napas Tidak Efektif')->first() ?? '';
            @endphp
            @foreach ($bdPolaNafas as $bd)
            @php
            $checked = null;
            if ($bdpn) {
              $detail = $bdpn->igdHubDiagnosisKepAssKepPatients->where('name', $bd)->first();
              if ($detail) {
                  $checked = 'checked';
              }
            }
            @endphp
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{$bd}}" name="pola-nafas[]" id="{{ $bd }}{{ $loop->iteration }}" {{ $checked }}/>
              <label class="form-check-label" for="{{ $bd }}{{ $loop->iteration }}">
                {{ $bd }}
              </label>
            </div>
            @if ($loop->last)
              <div class="col-sm-7">
                @if ($bdpn)    
                  @foreach ($bdpn->igdHubDiagnosisKepAssKepPatients as $i)
                    @if(!in_array($i->name, $bdPolaNafas))
                      <div class="row mb-2">
                          <input class="form-control form-control-sm mx-3" style="max-width: 300px" name="pola-nafas[]" value="{{ $i->name ?? '' }}" type="text" aria-label=".form-control-sm example">
                          <button class="btn btn-sm btn-danger" style="max-width: 40px" onclick="removeInput(this)">-</button>
                      </div>
                    @endif
                  @endforeach
                @endif
                <div id="input-container2" class="row">
                    <input class="form-control form-control-sm mx-3" style="max-width: 300px" name="pola-nafas[]" type="text" aria-label=".form-control-sm example">
                    <a class="btn btn-sm btn-dark text-white" style="max-width: 40px" onclick="addInput('input-container2')">+</a>
                </div>
              </div>
            @endif
            @endforeach
          </div>

          <div class="col-sm-3 mt-3 form-check">
            <div class="d-flex align-items-center">
              <label class="form-control-label col-sm-4" for="lainnya">Lainnya</label>
              @php
                  $lainnyaD = $asesmenDiagnosa->where('diagnosa', '!=', '*) Nyeri Akut / Kronis')->where('diagnosa', '!=', 'Gangguan Mobilitas Fisik')->where('diagnosa', '!=', '*) Gangguan Integritas Kulit/jaringan')->where('diagnosa', '!=', 'Retensi Urine')->where('diagnosa', '!=', 'Bersihan Jalan Napas Tidak Efektif')->where('diagnosa', '!=', 'Pola Napas Tidak Efektif')->first();
              @endphp
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="lainnya" name="diagnosis-lainnya" value="{{ $lainnyaD->diagnosa ?? '' }}" placeholder="" aria-describedby="floatingInputHelp" />
              </div>
            </div>
          </div>
          <div class="col-sm-1 mx-4 mt-3">
            <p class="fw-bold mx-4">b.d.</p>
          </div>
          <div class="col-sm-4 mt-3">
            @if ($lainnyaD)
                @foreach ($lainnyaD->igdHubDiagnosisKepAssKepPatients as $bd)    
                  <div class="row mb-2">
                      <input class="form-control form-control-sm mx-3" style="max-width: 300px" name="lainnya[]" value="{{ $bd->name ?? '' }}" type="text" aria-label=".form-control-sm example">
                      <button class="btn btn-sm btn-danger" style="max-width: 40px" onclick="removeInput(this)">-</button>
                  </div>
                @endforeach
            @endif
            <div id="input-container1" class="row">
                <input class="form-control form-control-sm mx-3" style="max-width: 300px" name="lainnya[]" type="text" aria-label=".form-control-sm example">
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
                $checked = null;
                if ($masalah) {
                  $detail = $masalah->where('diagnosa', $keperawatan)->first();
                  if ($detail) {
                      $checked = 'checked';
                  }
                }
              @endphp
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$keperawatan}}" name="masalah-keperawatan[]" id="{{ $keperawatan }}_{{ $loop->iteration }}" {{ $checked }}/>
                <label class="form-check-label" for="{{ $keperawatan }}_{{ $loop->iteration }}">
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
