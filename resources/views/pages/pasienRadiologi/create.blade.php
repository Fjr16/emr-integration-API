<form action="{{ route('radiologi/patient/hasil.update', $item->id) }}" method="POST" enctype="multipart/form-data">
  @method('PUT')
  @csrf

  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel3">Input Hasil Pemeriksaan ({{ $item->radiologiFormRequestDetail->radiologiFormRequestMaster->name ?? '' }})</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="row mb-3">
        <label for="name" class="col-form-label col-3">Name</label>
        <div class="col-9">
          <input type="text" id="name" value="{{ $item->radiologiPatient->queue->patient->name ?? '' }}" class="form-control" disabled>
        </div>
      </div>
      <div class="row mb-3">
        <label for="usia" class="col-form-label col-3">Usia</label>
        <div class="col-9">
          @php
          $usia = null;
          if($item->radiologiPatient->queue->patient->tanggal_lhr){
            $lahir = $item->radiologiPatient->queue->patient->tanggal_lhr;
            list($thnlhr, $blnlhr, $tgllhr) = explode('-', $lahir);
            //now
            list($thnskrg, $blnskrg, $tglskrg) = explode('-', $today);
  
            $usia = $thnskrg - $thnlhr;
            if($blnskrg < $blnlhr || ($blnskrg == $blnlhr && $tglskrg < $tgllhr)){
              $usia--;
            }
          }
          @endphp
          <input type="text" id="usia" value="{{ $usia ?? '' }}" class="form-control" disabled>
        </div>
      </div>
      <div class="row mb-3">
        <label for="jenis-kelamin" class="col-form-label col-3">Jenis Kelamin</label>
        <div class="col-9">
          <input type="text" id="jenis-kelamin" value="{{ $item->radiologiPatient->queue->patient->jenis_kelamin ?? '' }}" class="form-control" disabled>
        </div>
      </div>
      <div class="row mb-3">
        <label for="norm" class="col-form-label col-3">No RM</label>
        <div class="col-9">
          <input type="text" id="norm" value="{{ implode('-', str_split(str_pad($item->radiologiPatient->queue->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}" class="form-control" disabled>
        </div>
      </div>
      <div class="row mb-3">
        <label for="no_pemeriksaan" class="col-form-label col-3">No Pemeriksaan</label>
        <div class="col-9">
          <input type="text" id="no_pemeriksaan" name="nomor" value="{{ $item->nomor ?? $noRegRad }}" class="form-control"  required readonly>
        </div>
      </div>
      <div class="row mb-3">
        <label for="tanggal" class="col-form-label col-3">Tanggal Pemeriksaan</label>
        <div class="col-9">
          <input type="date" id="tanggal" name="tanggal" value="{{ $item->tanggal ?? $today }}" class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col">
          <label for="" class="form-label">Hasil Pemeriksaan</label>
          <textarea class="form-control" id="ckeditor1" rows="2" name="hasil">{!! $item->hasil ?? '' !!}</textarea>
        </div>
      </div>
      <div class="mb-3">
        <label for="formFileMultiple" class="form-label">Upload File Pemeriksaan</label>
        <input class="form-control" type="file" name="image" id="formFileMultiple" multiple>
        <div class="mt-3 col-sm-12">
          <h6>Gambar Saat Ini:</h6>
          @if ($item->image)
              <img src="{{ Storage::url($item->image) }}" alt="{{ $item->image }}" width="300" height="200">
          @endif
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-success btn-sm">Simpan</button>
    </div>
  </div>
</form>

<script>
   // Daftar ID elemen editor
   var editorIds = ['ckeditor1'];
  
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