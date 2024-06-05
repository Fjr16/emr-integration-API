@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Interaksi "Nama Obat"</h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="row mb-3">
    <label for="select2Basic" class="col-sm-2 col-form-label">Obat</label>
    <div class="col-sm-10">
      <select id="select2Basic" class="select2 form-select form-select-lg" data-allow-clear="true">
        <option selected disabled>Pilih</option>
          <option value="1">Tablet</option>
          <option value="2">Cream</option>
          <option value="3">Sirup</option>
      </select>
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-name">Interaksi</label>
    <div class="col-sm-10">
        <input type="text" name="name" class="form-control" id="basic-default-name" value="" required />
    </div>
  </div>
  <div class="row justify-content-end">
    <div class="col-sm-10">
        <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
    </div>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Obat</th>
          <th>Interaksi</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Alapazolam</td>
          <td>meningkatkan level alprazolam dengan mengurangi metabolisme ciprofloxacin</td>
          <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                    data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/edit-interaksi-obat">
                        <i class="bx bx-edit-alt me-1"></i>
                        Edit
                    </a>
                    <form action="" method="POST">
                        @method('DELETE')
                        <button type="submit" class="dropdown-item"
                            onclick="return confirm('Yakin ingin menghapus data?')"><i
                                class="bx bx-trash me-1"></i>Hapus</button>
                    </form>
                </div>
            </div>
          </td>
        </tr>
        </tbody>
    </table>
  </div>
</div>
@endsection