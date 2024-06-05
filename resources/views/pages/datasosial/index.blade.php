@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Pasien</h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table id="example" class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Kartu / Sosial</th>
          <th>RM</th>
          <th>No</th>
          <th>Norm</th>
          <th>No. Kartu</th>
          <th>Nama</th>
          <th>Tempat / Tgl Lahir</th>
          <th>Sex</th>
          <th>Alamat</th>
          <th>Telp</th>
          <th>Umur</th>
          <th>Riwayat</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
         <tr>
          <td>
            <div class="d-flex justify-content-center">
              <a href="#"><i class='fs-3 bx bx-id-card'></i></a>
              <a href="#" class="mx-3" ><i class='fs-3 bx bx-credit-card-front' ></i></a>
            </div>
          </td>
          <td>
            <a href="#"><i class='fs-3 bx bx-memory-card' ></i></a>
          </td>
          <td>1</td>
          <td>norm</td>
          <td>455666</td>
          <td>ucok</td>
          <td>padang, 05 desember 2000</td>
          <td>laki-laki</td>
          <td>padang</td>
          <td>08123163657</td>
          <td>20</td>
          <td>
            <a href="#"><i class='bx bxs-file-doc' ></i></a>
          </td>
          <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                    data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="">
                        <i class="bx bx-edit-alt me-1"></i>
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