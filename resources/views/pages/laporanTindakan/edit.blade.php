<form action="{{ route('rajal/laporan/tindakan.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalScrollableTitle">Edit Tindakan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <label for="diagnosa" class="col-sm-3 col-form-label">diagnosa</label>
            <div class="col-sm-9">
              <input type="text" name="diagnosa" value="{{ $item->diagnosa ?? '' }}" class="form-control" id="diagnosa" required />
            </div>
          </div>  
          <div class="row mb-3">
            <label for="defaultFormControlInput" class="form-label col-sm-3">Jenis Tindakan</label>
            <div class="col-sm-9">
              <input type="text" name="jenis_tindakan" class="form-control" value="{{ $item->jenis_tindakan ?? '' }}">
            </div>
          </div>
          <div class="row mb-3">
            <label for="diagnosa" class="col-sm-3 col-form-label">Lokasi</label>
            <div class="col-sm-9">
              <input type="text" name="lokasi" value="{{ $item->lokasi ?? '' }}" class="form-control"/>
            </div>
          </div>
          <div class="row mb-3">
            <label for="defaultFormControlInput" class="form-label col-sm-3">Tanggal/Jam tindakan</label>
            <div class="col-sm-9">
              <input type="datetime-local" class="form-control" name="tgl_tindakan" value="{{ $item->tgl_tindakan ?? $today }}" />
            </div>
          </div>
  
          <div class="mb-3">
            <label class="form-label">LAPORAN TINDAKAN
            </label>
            <textarea class="form-control" id="editor" name="laporan_tindakan">{{ $item->laporan_tindakan ?? '' }}</textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">INSTRUKSI PASCA TINDAKAN
            </label>
            <textarea class="form-control" id="editor1" name="intruksi">{{ $item->intruksi ?? '' }}</textarea>
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