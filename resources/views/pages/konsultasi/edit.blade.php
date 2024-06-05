@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">

  <div class="d-flex">
    <h4 class="align-self-center m-0">Tarif Konsultasi</h4>
    <a href="{{ route('konsultasi.edit', $item->id) }}" class="btn btn-sm btn-success align-self-center m-0 ms-auto me-2 text-white">Sinkronisasi Ulang</a>
    <form action="{{ route('konsultasi.destroy', $item->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin Mereset data?')">Reset</button>
    </form>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Kategori Pasien</th>
          <th>Tarif Tindakan</th>
          <th>Tarif Pembayaran</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($item->consultingRates as $rate)
          <tr>
            <form action="{{ route('konsultasi.update', $rate->id) }}" method="POST">
              @csrf
              @method('PUT')
            <th class="text-dark" scope="row">{{ $loop->iteration }}</th>
            <td>{{ $rate->patientCategory->name }}</td>
            <td>
                <div class="row">
                    <div class="col-6">
                        <input type="number" class="form-control form-control-sm" name="tindakan" value="{{ $rate->tindakan ?? '0' }}">
                    </div>
                    <div class="col-6">
                        = Rp. {{ number_format($rate->tindakan) }}
                    </div>
                </div>
            </td>
            <td>
                <div class="row">
                    <div class="col-6">
                        <input type="number" class="form-control form-control-sm" name="pembayaran" value="{{ $rate->pembayaran ?? '0' }}">
                    </div>
                    <div class="col-6">
                        = Rp.  {{ number_format($rate->pembayaran) }}
                    </div>
                </div>
            </td>
            <td>
                <button class="btn btn-sm btn-success"><i class='bx bx-save'></i></button>
            </td>
            </form>
          </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection
