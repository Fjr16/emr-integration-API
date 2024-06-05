<form action="{{ route('rajal/prmrj.update', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
  @method('PUT')
    @csrf
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalScrollableTitle">Edit PRMRJ</h5>
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
              <select class="form-select" name="user_id">
                  <option value="{{ $item->user->id ?? '' }}">{{ $item->user->name ?? ''}}</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <h6>Diagnosa Penting
            </h6>
            <textarea class="form-control" id="editor" name="diagnosa_penting">{{ $item->diagnosa_penting ?? '' }}</textarea>
          </div>
          <div class="mb-3">
            <h6>Uraian Klinis Penting
            </h6>
            <textarea class="form-control" id="editor1" name="uraian_klinis">{{ $item->uraian_klinis ?? '' }}</textarea>
          </div>
          <div class="mb-3">
            <h6>Rencana Penting
            </h6>
            <textarea class="form-control" id="editor2" name="rencana_penting">{{ $item->rencana_penting ?? '' }}</textarea>
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