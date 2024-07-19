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
    <h4 class="align-self-center m-0">DATA DISTRIBUSI OBAT KE UNIT {{ $unit->name ?? '' }}</h4>
    <a href="{{ route('farmasi/obat/amprahan.create', $unit->id) }}" class="btn btn-dark btn-sm m-0 mx-3">+</a>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Valid</th>
          <th>No</th>
          <th>No Distribusi</th>
          <th>Tanggal Distribusi</th>
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
          <td><i class='bx bx-check'></i></td>
          <th scope="row" class="text-dark">{{ $loop->iteration }}</th>
          <td>{{ $item->no_distribusi ?? '' }}</td>
          <td>{{ $item->tanggal ?? '' }}</td>
          <td>
            @foreach ($item->medicineDistributionDetails as $detail)    
              {{ $detail->medicine->kode ?? '' }} <br>
            @endforeach
          </td>
          <td>
            @foreach ($item->medicineDistributionDetails as $detail)    
              {{ $detail->medicine->name ?? '' }} <br>
            @endforeach
          </td>
          <td>
            @foreach ($item->medicineDistributionDetails as $detail)    
              Rp. {{ number_format($detail->medicineStok->harga ?? '') }} <br>
            @endforeach
          </td>
          <td>
            @foreach ($item->medicineDistributionDetails as $detail)    
              {{ $detail->jumlah ?? '' }} <br>
            @endforeach
          </td>
          <td>
            @foreach ($item->medicineDistributionDetails as $detail)    
              {{ $detail->satuan ?? '' }} <br>
            @endforeach
          </td>
          <td>
            @foreach ($item->medicineDistributionDetails as $detail)    
              Rp. {{ number_format($detail->medicineStok->harga*$detail->jumlah) }} <br>
            @endforeach
          </td>
          <td>
            @foreach ($item->medicineDistributionDetails as $detail)    
              {{ $detail->medicineStok->no_batch ?? ''}} <br>
            @endforeach
          </td>
          <td>
            @foreach ($item->medicineDistributionDetails as $detail)    
              {{ $detail->medicineStok->production_date ?? ''}} <br>
            @endforeach
          </td>
          <td>
            @foreach ($item->medicineDistributionDetails as $detail)    
              {{ $detail->medicineStok->exp_date ?? '' }} <br>
            @endforeach
          </td>
          
          {{-- <td>
            @foreach ($item->medicineDistributionRequest->medicineDistributionDetails as $detail)    
              {{ $detail->medicine->kode ?? '' }}
              {{ $detail->medicine->name ?? '' }}
              Rp. {{ number_format($detail->medicineStok->harga ?? '') }}
              {{ $detail->jumlah ?? '' }}
              {{ $detail->satuan ?? '' }}
              Rp. {{ number_format($detail->medicineStok->harga*$detail->jumlah) }}
              {{ $item->medicineStok->no_batch ?? ''}}
              {{ $item->medicineStok->production_date ?? ''}}
              {{ $item->medicineStok->exp_date ?? '' }}
            @endforeach
          </td> --}}

          <td>{{ $item->status ?? '' }}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                  data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                  <form action="{{ route('farmasi/obat/distribusi.destroy', $item->id) }}" method="POST">
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