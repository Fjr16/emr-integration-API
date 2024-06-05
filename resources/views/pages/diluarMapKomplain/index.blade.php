@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  <div class="row">
    <div class="col-8">
      <h4 class="align-self-center m-0">
          Daftar Pernyataan Dan Penyelesaian Komplain
      </h4>
    </div>
    <div class="col-4 text-end">
      <a href="/create-komplain" class="btn btn-success btn-sm">+ Tambah Komplain</a>
    </div>
    </form>

  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table id="example" class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Nama</th>
          <th>Status</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>si anu</td>
          <td>Pasien / Pengunjung</td>
          <td class="text-center">
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                    data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a target="blank" class="dropdown-item" href="/show-komplain">
                    <i class='bx bx-printer me-1'></i>
                      Print
                  </a>
                  <a class="dropdown-item" href="">
                    <i class='bx bx-edit-alt me-1'></i>
                      Edit
                  </a>
                  <form action="" method="POST">
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
        </tbody>
    </table>
  </div>
</div>

@endsection

