@extends('layouts.backend.main')

@section('content')
@section('content')
  @if (session()->has('success'))
  <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
      {{ session('success') }}
  </div>
@endif

<form action="{{ route('kemoterapi/cppt.update', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
  @csrf
  @method('PUT')
  <div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <div class="col-11 d-flex">
        <h5 class="mb-0">Edit CPPT Kemoterapi</h5>
      </div>
      <button type="button" class="btn btn-success btn-sm" onclick="history.back()">Kembali</button>
    </div>
    <div class="card-body">
      <div class="mb-3">
        <h6>Tanggal</h6>
        <div class="col-md-10">
          <input class="form-control" type="datetime-local" value="{{ $item->tanggal , $today }}" name="tanggal" id="html5-datetime-local-input" />
        </div>
      </div>
      <div class="mb-3">
        <h6>Profesional Pemberi Asuhan (PPA)</h6>
        <input type="text" class="form-control" id="floatingInput" value="{{ $item->user->name ?? '' }} ({{ $item->user->staff_id ?? '' }})" aria-describedby="floatingInputHelp" readonly/>
      </div>
      <div class="mb-3">
        <h6>Hasil Pemerikasaan, Analisa dan Tindak Lanjut Subjective, Objective, Asesmen, Planning (SOAP) / ADIME <br>
          <span class="fs-6">(dituliskan dengan format SOAP, disertai dengan sasaran / target yang terukur, evaluasi hasil tata laksana dituliskan didalam asesmen)</span>
        </h6>
        @can('cppt format soap')          
          <div id="soap">
            <div class="soap">
              @if (empty($newData['subjective']))
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="subjective">Subjective (S):</label>
                <div class="col-sm-9">
                  <input type="text" class="form form-control" id="subjective" name="subjective[]">
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-sm btn-dark" onclick="addForm(this)"><i class="bx bx-plus"></i></button>
                </div>
              </div>
              @else
                @foreach ($newData['subjective'] as $itemSub)    
                <div class="row mb-3">
                  @if ($loop->first)
                    <label class="col-sm-2 col-form-label" for="subjective">Subjective (S):</label>
                  @else
                      <div class="col-sm-2"></div>
                  @endif
                    <div class="col-sm-9">
                      <input type="text" class="form form-control" id="subjective" name="subjective[]" value="{{ $itemSub ?? '' }}">
                    </div>
                  @if ($loop->first)    
                    <div class="col-sm-1">
                      <button type="button" class="btn btn-sm btn-dark" onclick="addForm(this)"><i class="bx bx-plus"></i></button>
                    </div>
                  @endif
                </div>
                @endforeach
              @endif
            </div>
            <div class="soap">
              @if (empty($newData['objective']))
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="objective">Objective (O):</label>
                  <div class="col-sm-9">
                    <input type="text" class="form form-control" id="objective" name="objective[]">
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-sm btn-dark" onclick="addForm(this)"><i class="bx bx-plus"></i></button>
                  </div>
                </div>
              @else     
                @foreach ($newData['objective'] as $itemObj)    
                <div class="row mb-3">
                  @if ($loop->first)
                    <label class="col-sm-2 col-form-label" for="objective">Objective (O):</label>
                  @else
                      <div class="col-sm-2"></div>
                  @endif
                    <div class="col-sm-9">
                      <input type="text" class="form form-control" id="objective" value="{{ $itemObj ?? '' }}" name="objective[]">
                    </div>
                  @if ($loop->first)    
                    <div class="col-sm-1">
                      <button type="button" class="btn btn-sm btn-dark" onclick="addForm(this)"><i class="bx bx-plus"></i></button>
                    </div>
                  @endif
                </div>
                @endforeach
              @endif
            </div>
            <div class="soap">
              @if (empty($newData['asesmen']))
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="asesmen">Asesmen (A):</label>
                  <div class="col-sm-9">
                    <input type="text" class="form form-control" id="asesmen" name="asesmen[]">
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-sm btn-dark" onclick="addForm(this)"><i class="bx bx-plus"></i></button>
                  </div>
                </div>
              @else
                @foreach ($newData['asesmen'] as $itemAss)    
                <div class="row mb-3">
                  @if ($loop->first)
                    <label class="col-sm-2 col-form-label" for="asesmen">Asesmen (A):</label>
                  @else
                    <div class="col-sm-2"></div>
                  @endif
                    <div class="col-sm-9">
                      <input type="text" class="form form-control" id="asesmen" name="asesmen[]" value="{{ $itemAss ?? '' }}">
                    </div>
                  @if ($loop->first)    
                    <div class="col-sm-1">
                      <button type="button" class="btn btn-sm btn-dark" onclick="addForm(this)"><i class="bx bx-plus"></i></button>
                    </div>
                  @endif
                </div>
                @endforeach
              @endif
            </div>
            <div class="soap">
              @if (empty($newData['planning']))
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="planning">Planning (P):</label>
                  <div class="col-sm-9">
                    <input type="text" class="form form-control" id="planning" name="planning[]">
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-sm btn-dark" onclick="addForm(this)"><i class="bx bx-plus"></i></button>
                  </div>
                </div>
              @else
                @foreach ($newData['planning'] as $itemPlan)    
                <div class="row mb-3">
                  @if ($loop->first)
                    <label class="col-sm-2 col-form-label" for="planning">Planning (P):</label>
                  @else
                    <div class="col-sm-2"></div>
                  @endif
                    <div class="col-sm-9">
                      <input type="text" class="form form-control" id="planning" name="planning[]" value="{{ $itemPlan ?? '' }}">
                    </div>
                  @if ($loop->first)    
                    <div class="col-sm-1">
                      <button type="button" class="btn btn-sm btn-dark" onclick="addForm(this)"><i class="bx bx-plus"></i></button>
                    </div>
                  @endif
                </div>
                @endforeach
              @endif
            </div>
          </div>
        @endcan
        @can('cppt format adime')          
          {{-- ADIME --}}
          <div id="adime">
            <div class="adime">
              @if (empty($newData['assessment']))
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="assessment">Assesment (A):</label>
                  <div class="col-sm-9">
                    <input type="text" class="form form-control" id="assessment" name="assessment[]" value="">
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                  </div>
                </div>
              @else
                @foreach ($newData['assessment'] as $itemA)    
                <div class="row mb-3">
                  @if ($loop->first)
                    <label class="col-sm-2 col-form-label" for="assessment">Assesment (A):</label>
                  @else
                      <div class="col-sm-2"></div>
                  @endif
                    <div class="col-sm-9">
                      <input type="text" class="form form-control" id="assessment" name="assessment[]" value="{{ $itemA }}">
                    </div>
                  @if ($loop->first)    
                    <div class="col-sm-1">
                      <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                    </div>
                  @endif
                </div>
                @endforeach
              @endif
            </div>
            <div class="adime">
              @if (empty($newData['diagnosa']))
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="diagnosa">Diagnosa (D):</label>
                  <div class="col-sm-9">
                    <input type="text" class="form form-control" id="diagnosa" value="" name="diagnosa[]" value="">
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                  </div>
                </div>
              @else
                @foreach ($newData['diagnosa'] as $itemDiag)    
                <div class="row mb-3">
                  @if ($loop->first)
                    <label class="col-sm-2 col-form-label" for="diagnosa">Diagnosa (D):</label>
                  @else
                    <div class="col-sm-2"></div>
                  @endif
                    <div class="col-sm-9">
                      <input type="text" class="form form-control" id="diagnosa" name="diagnosa[]" value="{{ $itemDiag ?? '' }}">
                    </div>
                  @if ($loop->first)    
                    <div class="col-sm-1">
                      <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                    </div>
                  @endif
                </div>
                @endforeach
              @endif
            </div>
            <div class="adime">
              @if (empty($newData['intervensi']))
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="intervensi">Intervensi (I):</label>
                  <div class="col-sm-9">
                    <input type="text" class="form form-control" id="intervensi" name="intervensi[]">
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                  </div>
                </div>
              @else
                @foreach ($newData['intervensi'] as $itemInter)    
                <div class="row mb-3">
                  @if ($loop->first)
                    <label class="col-sm-2 col-form-label" for="intervensi">Intervensi (I):</label>
                  @else
                    <div class="col-sm-2"></div>
                  @endif
                    <div class="col-sm-9">
                      <input type="text" class="form form-control" id="intervensi" name="intervensi[]" value="{{ $itemInter ?? '' }}">
                    </div>
                  @if ($loop->first)    
                    <div class="col-sm-1">
                      <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                    </div>
                  @endif
                </div>
                @endforeach
              @endif
            </div>
            <div class="adime">
              @if (empty($newData['monitoring']))
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="monitoring">Monitoring (M):</label>
                  <div class="col-sm-9">
                    <input type="text" class="form form-control" id="monitoring" name="monitoring[]">
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                  </div>
                </div>
              @else
                @foreach ($newData['monitoring'] as $itemMoni)    
                <div class="row mb-3">
                  @if ($loop->first)
                    <label class="col-sm-2 col-form-label" for="monitoring">Monitoring (M):</label>
                  @else
                    <div class="col-sm-2"></div>
                  @endif
                    <div class="col-sm-9">
                      <input type="text" class="form form-control" id="monitoring" name="monitoring[]" value="{{ $itemMoni ?? '' }}">
                    </div>
                  @if ($loop->first)    
                    <div class="col-sm-1">
                      <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                    </div>
                  @endif
                </div>
                @endforeach
              @endif
            </div>
            <div class="adime">
              @if (empty($newData['evaluasi']))
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="evaluasi">Evaluasi (E):</label>
                  <div class="col-sm-9">
                    <input type="text" class="form form-control" id="evaluasi" name="evaluasi[]">
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                  </div>
                </div>
              @else
                @foreach ($newData['evaluasi'] as $itemEva)    
                <div class="row mb-3">
                  @if ($loop->first)
                    <label class="col-sm-2 col-form-label" for="evaluasi">Evaluasi (E):</label>
                  @else
                    <div class="col-sm-2"></div>
                  @endif
                    <div class="col-sm-9">
                      <input type="text" class="form form-control" id="evaluasi" name="evaluasi[]" value="{{ $itemEva ?? '' }}">
                    </div>
                  @if ($loop->first)    
                    <div class="col-sm-1">
                      <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                    </div>
                  @endif
                </div>
                @endforeach
              @endif
            </div>
          </div>
        @endcan
      </div>
      <div class="mb-3">
        <h6>Instruksi Tenaga Kesehatan termasuk Bedah / Prosedur<br>
        <span class="fs-6">(Intrusksi ditulis dengan rinci dan jelas)</span>
        </h6>
        <textarea class="form-control" id="editor" rows="2" name="intruksi">{!! $item->intruksi ?? '' !!}</textarea>
      </div>

    </div>
    <div class="mb-3 text-end mx-4">
      <button type="submit" class="btn btn-success btn-sm">Save changes</button>
    </div>
  </div>
</form>

<script>
  function addForm(element){
    var soapClass = element.closest('.soap');
    var elementInput = soapClass.querySelector('input');
    var attrInputName = elementInput.getAttribute('name');
    // console.log(attrInputName);
    var div = document.createElement('div');
    div.className = 'row mb-3';
    div.innerHTML = `
        <div class="col-sm-2"></div>
        <div class="col-sm-9">
          <input type="text" class="form form-control" name="${attrInputName}">
        </div>
        <div class="col-sm-1">
          <button type="button" class="btn btn-sm btn-danger" onclick="deleteForm(this)"><i class="bx bx-minus"></i></button>
        </div>
    `;

    soapClass.appendChild(div);
  }
</script>
<script>
  function addAdime(element){
    var adimeClass = element.closest('.adime');
    var input = adimeClass.querySelector('input');
    var inputName = input.getAttribute('name');
    var div = document.createElement('div');
    div.className = 'row mb-3';
    div.innerHTML = `
        <div class="col-sm-2"></div>
        <div class="col-sm-9">
          <input type="text" class="form form-control" name="${inputName}">
        </div>
        <div class="col-sm-1">
          <button type="button" class="btn btn-sm btn-danger" onclick="deleteForm(this)"><i class="bx bx-minus"></i></button>
        </div>
    `;

    adimeClass.appendChild(div);
  }

</script>

<script>
  function deleteForm(element){
    var row = element.closest('.row');
    row.remove();
  }
</script>
@endsection