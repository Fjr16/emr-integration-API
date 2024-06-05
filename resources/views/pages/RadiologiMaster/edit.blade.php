<div class="modal-content">
    <div class="card mb-4">
      <div class="modal-header">
        <h5 class="modal-title" id="modalScrollableTitle">Edit Variabel Pemeriksaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
        </div>
      <div class="modal-body">
          <form method="POST" action="{{ route('rajal/master/radiologi.update', $item->id) }}">
              @csrf
              @method('PUT')
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Pemeriksaan</label>
                  <div class="col-sm-10">
                      <input type="text" name="name" value="{{ $item->name ?? '' }}" class="form-control" id="basic-default-name" required />
                  </div>
              </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-name">Kategori Pemeriksaan</label>
                  <div class="col-sm-10">
                    <select class="form-select" id="exampleFormControlSelect1"
                        aria-label="Default select example" name="radiologi_form_request_master_category_id">
                        <option selected disabled>Pilih</option>
                        @foreach ($categories as $category)
                            @if (old('radiologi_form_request_master_category_id', $item->radiologi_form_request_master_category_id) == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name ?? '' }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name ?? '' }}</option>
                            @endif
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Kode ICD</label>
                    <div class="col-sm-10">
                        <input type="text" name="icd_code" value="{{ $item->icd_code ?? '' }}" class="form-control" id="basic-default-name" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <input class="form-check-input" type="checkbox" name="input_type" value="text" id="flexCheckDefault" {{ $item->input_type == 'text' ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault">
                          Tambah Form Input
                        </label>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Variabel Detail</label>
                    <div class="col-sm-10">
                        @foreach ($details as $detail)    
                            <input class="form-check-input" type="checkbox" name="radiologi_form_request_master_detail_id[]" value="{{ $detail->id }}" id="checkbox{{ $detail->id }}" {{ in_array($detail->id, $item->radiologiFormRequestMasterDetails->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label class="form-check-label" for="checkbox{{ $detail->id }}">
                                {{ $detail->name ?? '' }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark btn-sm">Simpan</button>
                </div>
          </form>
      </div>
    </div>
</div>