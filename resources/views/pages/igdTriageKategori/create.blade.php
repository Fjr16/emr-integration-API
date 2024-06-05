<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="modalScrollableTitle">Tambah Kategori Pemeriksaan Triase</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
    </button>
  </div>
  <div class="modal-body">
    <form method="POST" action="{{ route('igd/triase/kategori.store') }}">
      @csrf
      <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Kategori</label>
          <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="basic-default-name" required />
          </div>
      </div>
      <div class="row justify-content-end">
          <div class="col-sm-10">
              <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
          </div>
      </div>
    </form>
  </div>
</div>