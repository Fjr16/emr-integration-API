<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="modalScrollableTitle">Tambah Pemeriksaan Triase</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
    </button>
  </div>
  <div class="modal-body">
    <form method="POST" action="{{ route('igd/triase/pemeriksaan.store') }}">
      @csrf
      <div class="row mb-3">
          <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Pemeriksaan</label>
          <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="basic-default-name" required />
          </div>
      </div>
      <div class="row mb-3">
        <label for="defaultSelect" class="col-sm-2 col-form-label">Kategori Pemeriksaan</label>
        <div class="col-sm-10">
          <select id="defaultSelect" name="igd_triage_category_checkup_id" class="form-select">
            <option selected disabled>Pilih</option>
            @foreach ($kategoris as $kategori)
              <option value="{{ $kategori->id }}">{{ $kategori->name ?? '' }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row mb-3">
        <label for="defaultSelect" class="col-sm-2 col-form-label">Skala Pemeriksaan</label>
        <div class="col-sm-10">
          <select id="defaultSelect" name="igd_triage_scale_id" class="form-select">
            <option selected disabled>Pilih</option>
            @foreach ($skalas as $skala)
              <option value="{{ $skala->id }}">{{ $skala->name ?? '' }}</option>
            @endforeach
          </select>
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