@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
@if (session()->has('danger'))
      <div class="alert alert-danger w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('danger') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">DATA RETURN OBAT DARI UNIT {{ $category->unit->name }} - {{ $category->unitCategoryPivot->name }}</h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Valid</th>
          <th>No</th>
          <th>No Return</th>
          <th>Tanggal Return</th>
          <th>Kode Obat</th>
          <th>Nama Obat</th>
          <th>Harga Satuan</th>
          <th>Jumlah</th>
          <th>Satuan</th>
          <th>Total Harga</th>
          <th>Nomor Batch</th>
          <th>Production Date</th>
          <th>Expire</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
        <tr>
          <td><i class='bx bx-check'></td>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $item->medicineDistribution->no_distribusi }}</td>
          <td>{{ $item->medicineDistribution->tanggal }}</td>
          <td>{{ $item->medicineDistributionRequest->medicine->kode }}</td>
          <td>{{ $item->medicineDistributionRequest->medicine->name }}</td>
          <td>Rp. {{ number_format($item->harga) }}</td>
          <td>{{ $item->medicineDistributionRequest->jumlah }}</td>
          <td>{{ $item->medicineDistributionRequest->satuan }}</td>
          <td>Rp. {{ number_format($item->harga*$item->medicineDistributionRequest->jumlah) }}</td>
          <td>{{ $item->no_batch }}</td>
          <td>{{ $item->production_date }}</td>
          <td>{{ $item->exp_date }}</td>
          <td>{{ $item->medicineDistribution->status }}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                  data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                  <form action="{{ route('farmasi/obat/distribusi/return.destroy', $item->medicineDistribution->id) }}" method="POST">
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
  </div>
</div>
@endsection