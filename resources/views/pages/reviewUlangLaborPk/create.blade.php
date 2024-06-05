<form action="{{ route('laboratorium/patient/hasil.reviewUlangStore', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin Ingin Melanjutkan ?')">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalScrollableTitle">Review Ulang Laboratorium PK</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <h6>Tanggal</h6>
            <input class="form-control" type="datetime-local" value="{{ $today }}" name="tanggal" id="html5-datetime-local-input" />
          </div>
          <div class="mb-3">
            <h6>Keterangan</h6>
            <textarea class="form-control" id="editor" name="keterangan"></textarea>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark btn-sm">Save changes</button>
        </div>
      </div>
</form>
<script>

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