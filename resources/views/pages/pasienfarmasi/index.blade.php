@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  <div class="row">
    <div class="col-md-8">
        <h4 class="align-self-center m-0">
            Daftar Resep
            <span class="text text-primary fw-bold">Rawat Jalan ({{ date('d-m-Y') }})</span>
        </h4>
    </div>
    <div class="col-md-3">
      <form action="{{ route('rajal/farmasi/index') }}" method="GET">
          <div class="row">
          <label class="col-form-label col-3"></label>
          <div class="col-9">
              <input type="date" id="tanggal" name="filter" value="{{ request('filter', date('Y-m-d')) }}" class="form-control">
          </div>
          </div>
      </div>
      <div class="col-1">
          <button type="submit" class="btn btn-primary">Filter</button>
      </div>
      </form>
    </div>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="card">
    <div class="card-body">
      <div class="table-responsive text-nowrap pb-5">
        <table class="table mb-5 pb-5">
          <thead>
            <tr class="text-nowrap bg-dark">
              <th class="text-center">Action</th>
              <th>No Antrian</th>
              <th>Nama / No.rm</th>
              <th>Tanggungan</th>
              <th>Jenis Kelamin</th>
              <th>Status Rawatan</th>
              <th>Status Obat</th>
              <th>Tagihan</th>
              <th>Show</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)    
              <tr>
                <td class="text-center" style="width: 9%">
                  @if ($item->status == 'FINISHED')
                      <i class='bx bxs-check-circle text-center text-success' style="font-size: 250%"></i>
                  @elseif($item->status == 'DENIED')
                      <i class='bx bxs-x-circle text-center text-danger' style="font-size: 250%"></i>
                  @else     
                    <div class="btn-group me-4 dropend">
                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class='bx bx-receipt'></i> List
                        </button>
                        <ul class="dropdown-menu">
                          @if ($item->status != 'WAITING')
                            <li> <a class="dropdown-item text-info" href="{{ route('rajal/farmasi/serahkan.obat', encrypt($item->id)) }}"><i class='bx bx-task me-1'></i> Serahkan Obat</a> </li>
                            <li>
                              <hr class="dropdown-divider">
                            </li>
                            <li> <a class="dropdown-item text-success" href="{{ route('rajal/farmasi/create', encrypt($item->id)) }}"><i class="bx bx-edit"></i> Edit</a></li>
                            {{-- <li> <a class="dropdown-item text-danger" href=""><i class="bx bx-x"></i> Batal</a> </li> --}}
                          @else
                            <li> <a class="dropdown-item text-success" href="{{ route('rajal/farmasi/create', encrypt($item->id)) }}"><i class="bx bx-check"></i> Konfirmasi</a> </li>
                            <li> 
                              <form action="{{ route('rajal/farmasi/update.status', encrypt($item->id)) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="dropdown-item text-danger" value="DENIED" name="status"><i class="bx bx-x"></i> Tolak / Revisi</button>
                              </form>
                            </li>
                          @endif
                        </ul>
                    </div>
                  @endif
                </td>
                <td>{{ $item->queue->no_antrian ?? '' }}</td>
                <td>{{ $item->queue->patient->name ?? '' }} / <span class="text-primary">{{ $item->queue->patient->no_rm ?? }}</span></td>
                <td>{{ $item->queue->patientCategory->name ?? '' }}</td>
                <td>{{ $item->queue->patient->jenis_kelamin ?? '' }}</td>
                <td>
                  @if ($item->queue->rawatJalanPoliPatient->status == 'WAITING')                                    
                      <span class="badge bg-danger">BELUM DILAYANI</span>
                  @elseif ($item->queue->rawatJalanPoliPatient->status == 'ONGOING')
                      <span class="badge bg-warning">DALAM PERAWATAN</span>
                  @elseif ($item->queue->rawatJalanPoliPatient->status == 'FINISHED')
                      <span class="badge bg-success">SUDAH DILAYANI</span>
                  @else
                      <span class="badge bg-success">TIDAK DIKETAHUI</span>
                  @endif
                </td>
                <td>
                  @if ($item->status == 'WAITING')                                    
                      <span class="badge bg-warning">PERMINTAAN</span>
                  @elseif ($item->status == 'ONGOING')
                      <span class="badge bg-info">DITERIMA</span>
                  @elseif ($item->status == 'FINISHED')
                      <span class="badge bg-success">SUDAH DIAMBIL</span>
                  @elseif ($item->status == 'DENIED')
                      <span class="badge bg-danger">DITOLAK / REVISI</span>
                  @else
                      <span class="badge bg-success">TIDAK DIKETAHUI</span>
                  @endif
                </td>
                <td>
                  @if ($item->queue->kasirPatient->status == 'WAITING')                                    
                      <span class="badge bg-danger">BELUM BAYAR</span>
                  @elseif ($item->queue->kasirPatient->status == 'FINISHED')
                      <span class="badge bg-success">SUDAH BAYAR</span>
                  @else
                      <span class="badge bg-danger">TIDAK DIKETAHUI</span>
                  @endif
                </td>
                <td><a class="btn btn-sm btn-primary" href="{{ route('rajal/farmasi/show', $item->id) }}"><i class="bx bx-show-alt me-1"></i></a></td>
              </tr>
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

