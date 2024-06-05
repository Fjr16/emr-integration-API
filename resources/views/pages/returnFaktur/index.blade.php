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
    <h4 class="align-self-center m-0">DATA FAKTUR RETURN KEPADA ({{ $supplier->name }})</h4>
    <a href="{{ route('farmasi/obat/return/faktur.create', $supplier->id) }}" class="btn btn-dark btn-sm m-0 mx-3">+</a>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Valid</th>
          <th>No</th>
          <th>No Faktur</th>
          <th>Tanggal</th>
          <th>Total Kotor</th>
          <th>PPN</th>
          <th>Discount</th>
          <th>Materai</th>
          <th>Total Bayar</th>
          <th>Status Pembayaran</th>
          <th>Restore</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
        <tr>
          <td><i class='bx bx-check'></td>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $item->no_faktur }}</td>
          <td>{{ $item->tanggal }}</td>
          <td>{{ $item->total_kotor ?? '0' }}</td>
          <td>{{ $item->ppn }}</td>
          <td>{{ $item->diskon }}</td>
          <td>{{ $item->materai }}</td>
          <td>{{ $item->total_bayar ?? '0' }}</td>
          <td>{{ $item->isPaid == 1 ? 'LUNAS' : 'KREDIT' }}</td>
          <td>
            <a href="{{ route('farmasi/obat/return.create', $item->id) }}">
              <i class='bx bxs-right-arrow-square' ></i>
            </a>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                  data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('farmasi/obat/return/faktur.edit', $item->id) }}">
                    <i class='bx bx-edit-alt me-1'></i>
                      Edit
                  </a>
                  <form action="{{ route('farmasi/obat/return/faktur.destroy', $item->id) }}" method="POST">
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