@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
  <div class="card mb-4">
    <div class="card-header m-0 d-flex">
        <h5 class="mb-0 m-0">Triase</h5>
        {{ session()->flash('active', 'triase') }}
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark ms-auto"><i class="bx bx-left-arrow-alt"></i> Kembali</a>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-6">
          {{-- <h6 class="m-0"> </h6> --}}
          <div class="row">
            <label for="html5-datetime-local-input" class="col-md-3 col-form-label">Tanggal/Jam Masuk :</label>
            <div class="col-md-6">
              <input class="form-control" type="datetime-local" value="{{ $item->tanggal_masuk ?? '' }}" id="html5-datetime-local-input" disabled/>
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>
        <div class="col-6">
          <div class="row">
            <label for="html5-time-input" class="col-md-2 col-form-label ms-auto">Jam Respon :</label>
            <div class="col-md-3">
              <input class="form-control" type="time" value="{{ $item->jam_respon ?? ''}}" id="html5-time-input" disabled/>
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
                <input class="form-check-input" type="radio" value="{{ $in }}" id="cara_masuk{{ $loop->iteration }}" {{ ($item->cara_masuk == $in) ? 'checked' : '' }} style="pointer-events: none;"/>
                <label class="form-check-label">
                  {{ $in ?? '' }}
                </label>
              </div>
              @endforeach
              <div class="row mb-3">
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-sm" name="cara_masuk_input" value="{{ (in_array($item->cara_masuk, $cara_masuk)) ? '' : $item->cara_masuk }}" placeholder="Cara masuk Lainnya" aria-describedby="floatingInputHelp" disabled/>
                </div>
              </div>
            </div>
        </div>
        <div class="col-4">
          <p class="fw-bold m-0 mt-2">Asal Masuk :</p>
            <div class="mb-3 mx-3" id="radio_asal_masuk">
              @foreach ($asal_masuk as $asal)     
              <div class="form-check">
                <input class="form-check-input" type="radio" value="{{ $item->asal_masuk ?? ''  }}" id="asal_masuk{{ $loop->iteration }}" {{ ($item->asal_masuk == $asal) ? 'checked' : '' }} style="pointer-events: none;"/>
                <label class="form-check-label">
                  {{ $asal ?? '' }}
                </label>
              </div>
              @endforeach
              <div class="row mb-3">
                <div class="col-sm-10">
                  <input type="text" class="form-control form-control-sm" value="{{ (in_array($item->asal_masuk, $asal_masuk)) ? '' : $item->asal_masuk }}" placeholder="Asal Masuk Lainnya" aria-describedby="floatingInputHelp" onfocus="clearRadio('radio_asal_masuk')" disabled/>
                </div>
              </div>
            </div>
        </div>
        <div class="col-4">
          <p class="fw-bold m-0 mt-2">Jenis Kasus :</p>
            <div class="mb-3 mx-3">
              @foreach ($jenis_kasus as $kasus)
              <div class="form-check">
                <input class="form-check-input" type="radio" value="{{ $item->jenis_kasus }}" id="jenis_kasus{{ $loop->iteration }}" {{ ($item->jenis_kasus == $kasus) ? 'checked' : '' }} style="pointer-events: none;"/>
                <label class="form-check-label">
                  {{ $kasus ?? '' }}
                </label>
              </div>
              @endforeach
            </div>
        </div>
      </div>
      <hr class="m-0">
      <p class="fw-bold m-0 mt-2">Keluhan Utama :</p>
      <table class="table table-bordered">
        <tr>
          <td rowspan="2">PEMERIKSAAN</td>
          <td colspan="10" class="text-center">SKALA</td>
          <td></td>
        </tr>
        @php
          $skala = $item->igdTriageCheckups->first();
        @endphp
        {{-- @dd($skala->igdTriageScale->name) --}}
        <tr>
          <td colspan="6" class="bg-danger text-center">
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="flexCheckDefault"
                {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 1') ? 'checked' : '' }}
                style="pointer-events: none;"
              />
              <label class="form-check-label">
                <span class="fw-bold text-black">TRIASE 1 <br />
                  (RESUSITASI) <br />0 MENIT</span>
              </label>
            </div>
          </td>
          <td class="bg-warning text-center">
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="flexCheckDefault"
                {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 2') ? 'checked' : '' }}
                style="pointer-events: none;"
              />
              <label class="form-check-label">
                <span class="fw-bold text-black">TRIASE 2 <br />
                  (EMERGENCY) <br />10 MENIT</span>
              </label>
            </div>
          </td>
          <td class="bg-success text-center">
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="flexCheckDefault"
                {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 3') ? 'checked' : '' }}
                style="pointer-events: none;"
              />
              <label class="form-check-label">
                <span class="fw-bold text-black">TRIASE 3 <br />
                  (URGENT) <br />30 MENIT</span>
              </label>
            </div>
          </td>
          <td class="bg-primary text-center">
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="flexCheckDefault"
                {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 4') ? 'checked' : '' }}
                style="pointer-events: none;"
              />
              <label class="form-check-label">
                <span class="fw-bold text-black">TRIASE 4 <br />
                  (LESS URGENT) <br />60 MENIT</span>
              </label>
            </div>
          </td>
          <td class="text-center">
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="flexCheckDefault"
                {{ (strtolower($skala->igdTriageScale->name ?? '') == 'triase 5') ? 'checked' : '' }}
                style="pointer-events: none;"
              />
              <label class="form-check-label">
                <span class="fw-bold text-black">TRIASE 5 <br />
                  (NON URGENT) <br />120 MENIT</span>
              </label>
            </div>
          </td>
          <td class="bg-dark text-light text-center">
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                value=""
                id="flexCheckDefault"
                {{ $item->igdTriageDoa ? 'checked' : '' }}
                style="pointer-events: none;"
              />
              <label class="form-check-label">
                <span class="fw-bold text-black">DEATH ON ARRIVAL <br> (DOA)</span>
              </label>
            </div>
          </td>
        </tr>
        
        {{-- @for ($i = 0; $i<4; $i++) --}}
        @foreach ($categories as $category)    
          <tr>
            <td colspan="6">{{ $category->name ?? '' }}</td>
            @foreach ($skalas as $skala)
              @foreach ($category->igdTriageCheckups->where('igd_triage_scale_id', $skala->id)->groupBy('igd_triage_scale_id') as $index => $checkups)
              @php
                  $jml = $checkups->count();   
              @endphp
              <td>
                <div class="form-check">
                  @for ($j = 0; $j<$jml; $j++)
                  <input
                    class="form-check-input"
                    type="checkbox"
                    value=""
                    id="{{ $checkups[$j]->id }}"
                    {{ (in_array($checkups[$j]->id, $item->igdTriageCheckups->pluck('id')->toArray())) ? 'checked' : '' }}
                    style="pointer-events: none;"
                  />
                  
                  <label class="form-check-label">
                      {{ $checkups[$j]->name ?? '' }}
                  </label>
                  <br>
                  @endfor
                </div>
              </td>
              @endforeach
            @endforeach
            @if ($loop->first)  
            <td rowspan="6">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  value=""
                  id="flexCheckDefault"
                  {{ ($item->igdTriageDoa->kehidupan ?? '' != null) ? 'checked' : '' }}
                  style="pointer-events: none;"
                />
                <label class="form-check-label">
                  tidak ada
                  tanda kehidupan</label
                ><br />
                <input
                  class="form-check-input"
                  type="checkbox"
                  value=""
                  id="flexCheckDefault"
                  {{ ($item->igdTriageDoa->nadi ?? '' != null) ? 'checked' : '' }}
                  style="pointer-events: none;"
                />
                <label class="form-check-label">
                  tidak ada enyut nadi</label
                ><br />
                <input
                  class="form-check-input"
                  type="checkbox"
                  value=""
                  id="flexCheckDefault"
                  {{ ($item->igdTriageDoa->reflek ?? '' != null) ? 'checked' : '' }}
                  style="pointer-events: none;"
                />
                <label class="form-check-label">
                  reflek cahaya (-/-)</label
                ><br />
                <input
                  class="form-check-input"
                  type="checkbox"
                  value=""
                  id="flexCheckDefault"
                  {{ ($item->igdTriageDoa->ekg ?? '' != null) ? 'checked' : '' }}
                  style="pointer-events: none;"
                />
                <label class="form-check-label">
                  ekg flat</label
                ><br />
                <p>jam doa <b>{{ ($item->igdTriageDoa->jam_doa ?? '' != null) ? $item->igdTriageDoa->jam_doa : '.......' }}</b></p>
              </div>
            </td>
            @endif
          </tr>
        @endforeach
      </table>
      <p class="fw-bold">Ket : Pada tingkat kegawatan, berikan tanda centang (√) , pada kolom yang tersedia</p>
      <p class="text-uppercase fw-bold">intervensi dan responsnya <br>tindakan/medikamentosa</p>
      <table class="fw-bold text-uppercase w-100 table table-bordered">
        <tr class="border border-1">
            <td style="width: 20%;">jalan nafas</td>
            <td><input type="text" value="{{ $item->jalan_nafas ?? '' }}" class="form-control" disabled></td>
        </tr>
        <tr class="border border-1">
            <td style="width: 20%;">pernapasan</td>
            <td><input type="text" value="{{ $item->pernapasan ?? '' }}" class="form-control" disabled></td>
        </tr>
        <tr class="border border-1">
            <td style="width: 20%;">sirkulasi</td>
            <td><input type="text" value="{{ $item->sirkulasi ?? '' }}" class="form-control" disabled></td>
        </tr>
        <tr class="border border-1">
            <td style="width: 20%;">disabilitas</td>
            <td><input type="text" value="{{ $item->disabilitas ?? '' }}" class="form-control" disabled></td>
        </tr>
        <tr class="border border-1">
            <td style="width: 20%;">lain-lain</td>
            <td><input type="text" value="{{ $item->lain ?? '' }}" class="form-control" disabled></td>
        </tr>
    </table>

    </div>
  </div>

@endsection