<form action="{{ route('radiologi/patient/queue.store', $item->id) }}" method="POST">
    @csrf
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Atur Jadwal Pemeriksaan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" value="{{ $today }}" class="form-control">
              </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
          </div>
        </div>
      </div>
</form>