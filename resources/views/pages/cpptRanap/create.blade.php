@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
<div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('ranap/cppt.store', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
  @csrf
  <div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <div class="col-11 d-flex">
        <h5 class="mb-0">Tambah CPPT</h5>
        {{ session()->flash('currentMenu', 'Rawat Inap'); }}
        <a href="{{ route('ranap/permintaan/radiologi.create', $item->queue->id) }}" class="btn btn-success btn-sm mx-2">+ Permintaan Radiologi</a>
        <a href="{{ route('permintaan/laboratorium/patologi/anatomik.create', $item->queue->id) }}" class="btn btn-success btn-sm">+ Permintaan Labor PA</a>
        <a href="{{ route('ranap/laboratorium/request.index', $item->queue->id) }}" class="btn btn-success btn-sm mx-2">+ Permintaan Labor PK</a>
      </div>
      <button type="button" class="btn btn-success btn-sm" onclick="history.back()">Kembali</button>
    </div>

    <div class="card-body">
      @can('cppt tipe')
      <div class="mb-3">
        <h6>Tipe Cppt</h6>
        <select class="form form-select form-control" id="tipe_cppt" name="tipe_cppt" @required(true)>
            @foreach ($tipeCppts as $tipe)
              <option value="{{ $tipe ?? '' }}" {{ ($tipe == 'NON SBAR') ? 'selected' : '' }}>{{ $tipe ?? '' }}</option>
            @endforeach
          </select>
      </div>
      @endcan
      <div class="mb-3">
        <h6>Tanggal</h6>
            <div class="col-md-10">
              <input class="form-control" type="datetime-local" value="{{ $today }}" name="tanggal" id="html5-datetime-local-input" />
            </div>
      </div>
      <div class="mb-3">
        <h6>Profesional Pemberi Asuhan (PPA)</h6>
        <input type="text" class="form-control" id="floatingInput" value="{{ Auth::user()->name }} ({{ Auth::user()->staff_id }})" aria-describedby="floatingInputHelp" readonly/>
      </div>
      <div class="mb-3">
        <h6>Hasil Pemerikasaan, Analisa dan Tindak Lanjut Subjective, Objective, Asesmen, Planning (SOAP) / ADIME <br>
          <span class="fs-6">Tulis, Baca, Konfirmasi (TULBAKON) (dituliskan dengan format SOAP, disertai dengan sasaran / target yang terukur, evaluasi hasil tata laksana dituliskan didalam asesmen, harap
            bubuhkan nama dan paraf pada setiap akhir catatan)</span>
        </h6>
        @can('cppt format soap')
          <div id="soap">
            <div class="soap">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="subjective">Subjective (S):</label>
                <div class="col-sm-9">
                  <input type="text" class="form form-control" id="subjective" name="subjective[]">
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-sm btn-dark" onclick="addForm(this)"><i class="bx bx-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="soap">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="objective">Objective (O):</label>
                <div class="col-sm-9">
                  <input type="text" class="form form-control" id="objective" value="" name="objective[]">
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-sm btn-dark" onclick="addForm(this)"><i class="bx bx-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="soap">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="asesmen">Asesmen (A):</label>
                <div class="col-sm-9">
                  <input type="text" class="form form-control" id="asesmen" name="asesmen[]">
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-sm btn-dark" onclick="addForm(this)"><i class="bx bx-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="soap">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="planning">Planning (P):</label>
                <div class="col-sm-9">
                  <input type="text" class="form form-control" id="planning" name="planning[]">
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-sm btn-dark" onclick="addForm(this)"><i class="bx bx-plus"></i></button>
                </div>
              </div>
            </div>
          </div>  
        @endcan
        @can('cppt format adime')
          <div id="adime">
            <div class="adime">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="assessment">Assesment (A):</label>
                <div class="col-sm-9">
                  <input type="text" class="form form-control" id="assessment" name="assessment[]">
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="adime">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="diagnosa">Diagnosa (D):</label>
                <div class="col-sm-9">
                  <input type="text" class="form form-control" id="diagnosa" value="" name="diagnosa[]">
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="adime">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="intervensi">Intervensi (I):</label>
                <div class="col-sm-9">
                  <input type="text" class="form form-control" id="intervensi" name="intervensi[]">
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="adime">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="monitoring">Monitoring (M):</label>
                <div class="col-sm-9">
                  <input type="text" class="form form-control" id="monitoring" name="monitoring[]">
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                </div>
              </div>
            </div>
            <div class="adime">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="evaluasi">Evaluasi (E):</label>
                <div class="col-sm-9">
                  <input type="text" class="form form-control" id="evaluasi" name="evaluasi[]">
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-sm btn-dark" onclick="addAdime(this)"><i class="bx bx-plus"></i></button>
                </div>
              </div>
            </div>
          </div>
        @endcan
      </div>
      
      @can('cppt serah terima')
      <div class="mb-3">  
        <div class="row">
          <div class="col-2"></div>
          <div class="col-10">
            <input type="radio" class="btn-check" value="0" name="serah_terima" id="danger-outlined" autocomplete="off" @checked(true)>
            <label class="btn btn-sm btn-outline-primary" for="danger-outlined"><i class='bx bx-x'></i> Tanpa Serah Terima</label>
    
            <input type="radio" class="btn-check" value="1" name="serah_terima" id="success-outlined" autocomplete="off" >
            <label class="btn btn-sm btn-outline-warning" for="success-outlined"><i class='bx bx-check'></i> Dengan Serah Terima</label>
          </div>
        </div>          
      </div>
      @endcan

      <div class="mb-3">
        <h6>Instruksi Tenaga Kesehatan termasuk Bedah / Prosedur<br>
          <span class="fs-6">(Intrusksi ditulis dengan rinci dan jelas)</span>
        </h6>
      </div>
      <div class="mb-3">
        <label class="form-label col-sm-2 fw-bold" id="label-kolom">Medical Mentosa:</label>
        <div class="row">
          <div class="col-sm-3">
            <label for="medicine_id" class="form-label">Nama Obat</label>
            <select id="medicine_id_1" name="medicine_id[]" class="form-select form-select-sm" data-allow-clear="true">
              <option selected disabled>Pilih</option>
              @foreach ($data as $obat)
                  @if (old('medicine_id') == $obat->id)
                    <option value="{{ $obat->id }}" selected>{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                  @else
                    <option value="{{ $obat->id }}">{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                  @endif
              @endforeach
            </select>
          </div>
          <div class="col-sm-1">
            <label class="form-label" for="basic-default-name">Jumlah</label>
            <input type="number" class="form-control" name="jumlah[]" id="jumlah" placeholder="0"/>
          </div>
          <div class="col-sm-1">
            <label class="form-label" for="basic-default-name">Aturan</label>
            <input type="text" class="form-control" name="aturan_pakai[]" id="aturan_pakai" placeholder="0x0"/>
          </div>
          <div class="col-sm-2">
            <label for="keterangan" class="form-label">Keterangan Penggunaan</label>
            <select name="keterangan[]" class="form-select form-select-md" data-allow-clear="true">
              <option selected disabled>Pilih</option>
              <option value="Sebelum Makan">Sebelum Makan</option>
              <option value="Sesudah Makan">Sesudah Makan</option>
            </select>
          </div>
          <div class="col-sm-2">
            <label for="category" class="form-label">Digunakan Untuk</label>
            <select name="category[]" class="form-select form-select-md" data-allow-clear="true">
              <option value="Selama Rawatan">Selama Rawatan</option>
              <option value="Pulang">Pulang</option>
            </select>
          </div>
          <div class="col-sm-2">
            <label for="keterangan" class="form-label">Keterangan Lainnya</label>
            <textarea name="other[]" class="form-control" id="other" cols="30" rows="1" placeholder="Tambah Keterangan ..."></textarea>
          </div>
          <div class="col-sm-1 d-flex align-self-center mt-4">
            <button type="button" class="btn btn-sm btn-dark" onclick="tambahResep(this)"><i class="bx bx-plus"></i></button>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label col-sm-2 fw-bold" id="label-kolom">Non Medical Mentosa:</label>
        <textarea class="form-control" id="editor" rows="2" name="intruksi"></textarea>
      </div>
      <div class="mb-3" id="formParafUser">
        <label class="form-label col-sm-2 fw-bold mb-3" id="label-kolom">Tanda Tangan :</label>
        <div class="row mb-3">
          <div class="col-3">
            <img src="" alt=""  id="imgTtdUser" class="border">
            <textarea id="ttd_user" name="ttd_user" style="display: none;"></textarea>
            <button type="button" class="col-12 btn btn-sm btn-dark" onclick="openModal(this)">Tanda Tangan</button>
          </div>
        </div>
      </div>

    </div>
    <div class="mb-3 text-end mx-4">
      <button type="submit" class="btn btn-success btn-sm">Save changes</button>
    </div>
  </div>
</form>

{{--modal create ttd --}}
<div class="modal fade" id="getTtdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalScrollableTitle">Masukkan Password Akun Anda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </button>
          </div>
          <div class="modal-body">
              <div id="signature-pad" class="m-signature-pad">
                  <div class="m-signature-pad--body mb-3">
                    <input type="password" class="form-control form-control-sm" name="password_user">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                  </div>
              
                  <div class="m-signature-pad--footer">
                  <button type="button" class="btn btn-sm btn-secondary" data-action="clear">Clear</button>
                  <button type="button" class="btn btn-sm btn-primary" data-action="save">Save</button>
                  </div>
              </div>
          </div>
        </div>
  </div>
</div>

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
<script>
  let clickCount = 2;
   function tambahResep(element){
     var row = element.closest('.row').parentNode;

     var div = document.createElement('div');
     div.className = 'row';
     div.innerHTML = `
         <div class="col-sm-3">
           <label for="medicine_id" class="form-label">Nama Obat</label>
           <select id="medicine_id_${clickCount}" name="medicine_id[]" class="form-select form-select-sm" data-allow-clear="true">
             <option selected disabled>Pilih</option>
             @foreach ($data as $obat)
                 @if (old('medicine_id') == $obat->id)
                   <option value="{{ $obat->id }}" selected>{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                 @else
                   <option value="{{ $obat->id }}">{{ $obat->kode ?? '' }}/{{ $obat->name ?? '' }}</option>
                 @endif
             @endforeach
           </select>
         </div>
         <div class="col-sm-1">
           <label class="form-label" for="basic-default-name">Jumlah</label>
           <input type="number" class="form-control" name="jumlah[]" id="jumlah" placeholder="0" />
         </div>
         <div class="col-sm-1">
           <label class="form-label" for="basic-default-name">Aturan</label>
           <input type="text" class="form-control" name="aturan_pakai[]" id="aturan_pakai" placeholder="0x0" />
         </div>
         <div class="col-sm-2">
             <label for="keterangan" class="form-label">Keterangan Penggunaan</label>
             <select name="keterangan[]" class="form-select form-select-md" data-allow-clear="true">
               <option selected disabled>Pilih</option>
               <option value="Sebelum Makan">Sebelum Makan</option>
               <option value="Sesudah Makan">Sesudah Makan</option>
             </select>
           </div>
           <div class="col-sm-2">
            <label for="category" class="form-label">Digunakan Untuk</label>
            <select name="category[]" class="form-select form-select-md" data-allow-clear="true">
              <option value="Selama Rawatan">Selama Rawatan</option>
              <option value="Pulang">Pulang</option>
            </select>
          </div>
           <div class="col-sm-2">
             <label for="keterangan" class="form-label">Keterangan Lainnya</label>
             <textarea name="other[]" class="form-control" id="other" cols="30" rows="1" placeholder="Tambah Keterangan ..."></textarea>
           </div>
         <div class="col-sm-1 d-flex align-self-center mt-4">
           <button type="button" class="btn btn-sm btn-danger" onclick="deleteForm(this)"><i class="bx bx-minus"></i></button>
         </div>`;

         row.appendChild(div);
         $('#medicine_id_' + clickCount).select2();
         clickCount++;
   }
</script>

<script>
  function openModal(element){
    $('#getTtdModal').modal('show');
  }

  document.addEventListener('DOMContentLoaded', function(){
    var modal = document.getElementById("getTtdModal");
    var clearBtn = modal.querySelector("[data-action=clear]");
    var saveBtn = modal.querySelector("[data-action=save]");
    var inputPass = modal.querySelector('input[name="password_user"]');
    var inputUserId = modal.querySelector('input[name="user_id"]');
    
    var tipeCppt = document.getElementById('tipe_cppt');
    var formParaf = document.getElementById('formParafUser');

    // function clear input ttd
    clearBtn.addEventListener('click', function(clear){
      clear.preventDefault();
      inputPass.value = '';
    });

    // function save ttd
    saveBtn.addEventListener('click', function(save){
      save.preventDefault();
      $.ajax({
        type : 'get',
        url : "{{ route('ranap/cppt.getTtd') }}",
        data : {
          user_id : inputUserId.value,
          password : inputPass.value,
        },
        success: function(data){
          var newSrc = `{{ Storage::url('${data}') }}`;
          $('#imgTtdUser').attr('src', newSrc);
          $('#ttd_user').val(data);
        }, error: function(jqXHR, textStatus, errorThrown){
          console.log();
          var errorResponse = jqXHR.responseJSON;
          if (errorResponse && errorResponse.error) {
            alert(errorResponse.error)
          }else{
            alert('Terjadi Kesalahan Dalam Pengambilan Data');
          }
        }
      });

      inputPass.value = '';

      $('#getTtdModal').modal('hide');
    });
  });
</script>

@endsection