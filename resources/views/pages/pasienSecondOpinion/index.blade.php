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
          Daftar Pasien Permintaan Second Opinion
      </h4>
    </div>
    <div class="col-4 text-end">
      <a href="/tambah-second-opinion" class="btn btn-success btn-sm">+ Tambah Permintaan</a>
    </div>
    </form>

  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table id="example" class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>No Rekam Medis</th>
          <th>Nama</th>
          <th>Kategori Pasien</th>
          <th>Diagnosa</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="text-center">
            <a target="blank" href="/show-permintaan-second-opinion" class="btn btn-sm btn-dark">
                <i class='bx bx-printer' ></i>
            </a>
          </td>
        </tr>
        </tbody>
    </table>
  </div>
</div>

@endsection

