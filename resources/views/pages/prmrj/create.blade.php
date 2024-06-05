<form action="{{ route('rajal/prmrj.store') }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalScrollableTitle">PRMRJ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <h6>Tanggal</h6>
                <div class="col-md-10">
                  <input class="form-control" type="datetime-local" value="{{ $today }}" name="tanggal" id="html5-datetime-local-input" />
                </div>
          </div>
          <div class="mb-3">
            <h6>Dokter Penanggung Jawab Pasien (DPJP)</h6>
            <div class="col-sm-12">
              <select class="select3modal" id="select3basic" name="user_id[]" multiple="multiple" style="width: 100%">
                @foreach ($data as $dokter)
                    <option value="{{ $dokter->id }}" @selected(old('user_id', $item->user->id) == $dokter->id)>{{ $dokter->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="mb-3">
            <input type="hidden" value="{{ $item->rawatJalanPatient->rawatJalanPoliPatient->id }}" name="rawat_jalan_poli_patient_id">
            <input type="hidden" value="{{ $item->patient->id }}" name="patient_id">
            <h6>Diagnosa Penting
            </h6>
            <textarea class="form-control" id="editor" name="diagnosa_penting"></textarea>
          </div>
          <div class="mb-3">
            <h6>Uraian Klinis Penting
            </h6>
            <textarea class="form-control" id="editor1" name="uraian_klinis"></textarea>
          </div>
          <div class="mb-3">
            <h6>Rencana Penting
            </h6>
            <textarea class="form-control" id="editor2" name="rencana_penting"></textarea>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark btn-sm">Save changes</button>
        </div>
      </div>
</form>
<script>
  $(document).ready(function(){
    $(".select3modal").select2({
      dropdownParent: $('#modalScrollable'),
    });
  });

   // Daftar ID elemen editor
   var editorIds = ['editor', 'editor1', 'editor2'];
  
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