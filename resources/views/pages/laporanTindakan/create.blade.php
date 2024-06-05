<form action="{{ route('rajal/laporan/tindakan.store') }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
    @csrf
    <div class="modal-content" id="main-modal">
        <div class="modal-header">
          <h5 class="modal-title" id="modalScrollableTitle">Tindakan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <label for="diagnosa" class="col-sm-3 col-form-label">diagnosa</label>
            <div class="col-sm-9">
              <input type="hidden" value="{{ $item->rawatJalanPatient->rawatJalanPoliPatient->id }}" name="rawat_jalan_poli_patient_id">
              <input type="hidden" name="patient_id" value="{{ $item->patient->id }}"/>
              <input type="text" name="diagnosa" class="form-control" id="diagnosa" required />
            </div>
          </div>   
          <div class="row mb-3">
            <label for="defaultFormControlInput" class="form-label col-sm-3">Jenis Tindakan</label>
            <div class="col-sm-9">
              <input type="text" name="jenis_tindakan" class="form-control" id="jenis_tindakan" />

              {{-- <select class="select3modal" id="select3basic" name="action_member_id[]" multiple="multiple" style="width: 100%">
                @foreach ($data as $action)
                    <option value="{{ $action->id }}" @selected(old('action_member_id') == $action->id)>{{ $action->name }}</option>
                @endforeach
              </select> --}}
            </div>
          </div>
          <div class="row mb-3">
            <label for="diagnosa" class="col-sm-3 col-form-label">Lokasi</label>
            <div class="col-sm-9">
              <input type="text" name="lokasi" value="{{ $item->doctorPatient->user->roomDetail->name ?? '' }}" class="form-control" required />
            </div>
          </div> 
          <div class="row mb-3">
            <label for="defaultFormControlInput" class="form-label col-sm-3">Tanggal/Jam tindakan</label>
            <div class="col-sm-9">
              <input type="datetime-local" class="form-control" name="tgl_tindakan" value="{{ $today }}" id="" placeholder="" aria-describedby="floatingInputHelp" />
            </div>
          </div>
  
          <div class="mb-3">
            <label class="form-label">LAPORAN TINDAKAN
            </label>
            <textarea class="form-control" id="editor" name="laporan_tindakan"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">INSTRUKSI PASCA TINDAKAN
            </label>
            <textarea class="form-control" id="editor1" name="intruksi"></textarea>
          </div>
          <div class="mb-3" id="formParafUser">
            <label class="form-label col-sm-2 fw-bold mb-3" id="label-kolom">Tanda Tangan :</label>
            <div class="row mb-3">
              <div class="col-4">
                <img src="" alt=""  id="imgTtdUser" class="border col-12">
                <textarea id="ttd_user" name="ttd_user" style="display: none;"></textarea>
                <button type="button" class="col-12 btn btn-sm btn-dark" onclick="openModal(this)">Tanda Tangan</button>
              </div>
            </div>
          </div>
          
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark btn-sm">Save changes</button>
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
    $(document).ready(function(){
      $(".select3modal").select2({
        dropdownParent: $('#modalScrollable'),
      });

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
        console.log('berhasil');
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
<script>
    // Daftar ID elemen editor
    var editorIds = ['editor', 'editor1'];
  
    // Loop melalui setiap ID editor
    editorIds.forEach(function(editorId) {
      ClassicEditor
        .create(document.querySelector('#' + editorId), {
          toolbar: {
            items: ['|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList'],
          },
          language: 'en',
        })
        .catch(function(error) {
          console.error(error);
        });
    });
</script>
<script>
    function openModal(element){
    $('#getTtdModal').modal('show');
  }
</script>