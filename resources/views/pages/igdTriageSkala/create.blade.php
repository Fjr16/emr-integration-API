  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="modalScrollableTitle">Tambah Skala Triase</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
      </button>
    </div>
    <div class="modal-body">
      <form method="POST" action="{{ route('igd/triase/skala.store') }}">
        @csrf
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Skala</label>
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
      {{-- <hr class="m-0 mt-2 mb-3">
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr class="text-nowrap bg-dark">
              <th>No</th>
              <th>Nama Skala</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $item)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $item->name }}</td>
                <td>
                  <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                          data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                          <form action="{{ route('igd/triase/skala.destroy', $item->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="dropdown-item"
                                  onclick="return confirm('Yakin ingin menghapus data?')"><i
                                      class="bx bx-trash me-1"></i>Hapus</button>
                          </form>
                      </div>
                  </div>
              </td>
              </tr>
              @endforeach
            </tbody>
        </table>
      </div> --}}
    </div>
  </div>
  
    