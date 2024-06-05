@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
<div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('ranap/alih/rawat.store', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
  @csrf
  <div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <div class="col-11 d-flex">
        <h5 class="mb-0">Alih Rawat</h5>
      </div>
      <button type="button" class="btn btn-success btn-sm" onclick="history.back()">Kembali</button>
    </div>

    <div class="card-body">
      {{-- <div class="mb-3">
        <h6>Tanggal</h6>
            <div class="col-md-10">
              <input class="form-control" type="datetime-local" value="{{ $today }}" name="tanggal" id="html5-datetime-local-input" />
            </div>
      </div> --}}
      <div class="row mb-3">
        <div class="col-6">
          <h6>Dokter Penanggung Jawab</h6>
          <input type="text" class="form-control" id="floatingInput" value="{{ $item->ranapDpjpPatientDetails->where('status', true)->first()->user->name }} ({{ $item->ranapDpjpPatientDetails->where('status', true)->first()->user->staff_id }})" aria-describedby="floatingInputHelp" readonly/>
        </div>
        <div class="col-6">
          <h6>Alih Rawat Ke</h6>
          <select name="user_id" id="user_id" class="form-select form-control select2" @required(true)>
            <option disabled selected>Pilih</option>
            @foreach ($dokters as $dokter)
              <option value="{{ $dokter->id }}">{{ $dokter->name ?? '' }} ({{ $dokter->staff_id ?? '' }})</option>
            @endforeach
            {{-- @error(old('user_id'))
              <div class="text-danger">
                {{ $message }}
              </div>
            @enderror --}}
          </select>
        </div>
    
      </div>
      <div class="row" id="formParafUser">
        <label class="form-label col-sm-2 fw-bold mb-3" id="label-kolom">Tanda Tangan DPJP :</label>
        <div class="row mb-3">
          <div class="col-3">
            <img src="" alt=""  id="imgTtdUser" class="border">
            <textarea id="ttd_user" name="ttd_user" style="display: none;"></textarea>
            <button type="button" class="col-12 btn btn-sm btn-dark" onclick="openModal(this)">Tanda Tangan</button>
          </div>
        </div>
      </div>

    </div>
    <div class="mb-3 text-start mx-4">
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
  function openModal(element){
    $('#getTtdModal').modal('show');
  }

  document.addEventListener('DOMContentLoaded', function(){
    var modal = document.getElementById("getTtdModal");
    var clearBtn = modal.querySelector("[data-action=clear]");
    var saveBtn = modal.querySelector("[data-action=save]");
    var inputPass = modal.querySelector('input[name="password_user"]');
    var inputUserId = modal.querySelector('input[name="user_id"]');
    
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