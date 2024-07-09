@extends('layouts.backend.main')

@section('content')
  @if (session()->has('success'))
  <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
      {{ session('success') }}
  </div>
@endif

<form action="{{ route('rajal/cppt.store', $item->id) }}" method="POST" id="formSOAP">
    @csrf
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <div class="row text-start">
            <h5 class="mb-2">Tambah CPPT</h5>
            <h5 class="mb-0 text-primary">{{ Auth::user()->name }} ({{ Auth::user()->staff_id }})</h5>
          </div>
          <div class="row text-end">
            <h5><span class="text-primary">Tgl.</span> {{ date('Y/m/d') }}</h5>
          </div>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <h5>Subjective, Objective, Asesmen, Planning (SOAP) Dokter</h5>
            <hr class="my-1">
            <div class="row mb-3">
              <div class="row mb-4">
                  <div class="col-sm-6">
                      <label for="subjective" class="form-label">Subjective</label>
                      <textarea name="subjective" id="subjective" class="form-control" rows="10" placeholder="Subjective">{{ "Keluhan: " . session('data.keluhan_utama') . "\r\n" . "Riwayat Penyakit: " . session('data.riw_penyakit_pasien') }}</textarea>
                  </div>
                  <div class="col-sm-6">
                      <label for="objective" class="form-label">Objective</label>
                      <textarea name="objective" id="objective" class="form-control" rows="10" placeholder="Objective">{{ "Keadaan Umum: " . session('data.keadaan_umum') . "\r\n" . "Nadi: " . session('data.nadi') . " bpm\r\n" . "Tekanan Darah: " . session('data.td_sistolik') . " / " . session('data.td_diastolik') . " mmHg\r\n" . "Suhu: " . session('data.suhu') . " °C\r\n" . "Nafas: " . session('data.nafas') . " x/menit\r\n" . "Tinggi Badan: " . session('data.tb') . "\r\n" . "Berat Badan: " . session('data.bb') }}</textarea>
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-6">
                      <label for="asesmen" class="form-label">Assesment</label>
                      <textarea name="asesmen" id="asesmen" class="form-control" rows="10" placeholder="Assesment"></textarea>
                  </div>
                  <div class="col-sm-6">
                      <label for="planning" class="form-label">Planning</label>
                      <textarea name="planning" id="planning" class="form-control" rows="10" placeholder="Planning"></textarea>
                  </div>
              </div>
            </div>
          </div>
          {{-- form hidden ttd --}}
          <div class="row mx-4 text-end align-self-center" id="formParafUser">
              <div class="col-12 text-end mb-0">
                <img src="" alt=""  id="imgTtdUser" class="border" width="170" hidden>
              </div>
              <div class="col-12 text-end mb-0">
                <textarea id="ttd_user" name="ttd_user" style="display: none;"></textarea>
              </div>
          </div>
        </div>
        <div class="mb-3 text-end mx-4">
          <button type="submit" class="btn btn-success btn-sm" onclick="openModal()">Save changes</button>
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

{{-- <script>
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
            <input type="number" class="form-control" name="jumlah[]" id="jumlah" />
          </div>
          <div class="col-sm-2">
            <label class="form-label" for="basic-default-name">Aturan Pakai</label>
            <input type="text" class="form-control" name="aturan_pakai[]" id="aturan_pakai" />
          </div>
          <div class="col-sm-2">
              <label for="keterangan" class="form-label">Keterangan Penggunaan</label>
              <select name="keterangan[]" class="form-select form-select-md" data-allow-clear="true">
                <option selected disabled>Pilih</option>
                <option value="Sebelum Makan">Sebelum Makan</option>
                <option value="Sesudah Makan">Sesudah Makan</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="keterangan" class="form-label">Keterangan Lainnya</label>
              <textarea name="other[]" class="form-control" id="other" cols="30" rows="1"></textarea>
            </div>
          <div class="col-sm-1 d-flex align-self-center mt-4">
            <button type="button" class="btn btn-sm btn-danger" onclick="deleteForm(this)"><i class="bx bx-minus"></i></button>
          </div>`;

          row.appendChild(div);
          $('#medicine_id_' + clickCount).select2();
          clickCount++;
    }
</script> --}}
<script>

  document.addEventListener('DOMContentLoaded', function(){
    var formSubmit = document.getElementById("formSOAP");
    var modal = document.getElementById("getTtdModal");
    var clearBtn = modal.querySelector("[data-action=clear]");
    var saveBtn = modal.querySelector("[data-action=save]");
    var inputPass = modal.querySelector('input[name="password_user"]');
    var inputUserId = modal.querySelector('input[name="user_id"]');
    
    var formParaf = document.getElementById('formParafUser');

    formSubmit.addEventListener('submit', function(formSub){
      formSub.preventDefault();
      $('#getTtdModal').modal('show');
    });

    // function clear input ttd
    clearBtn.addEventListener('click', function(clear){
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
          formSubmit.submit();
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
