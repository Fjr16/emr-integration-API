@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Stock Obat</h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Nama</th>
          <th class="text-center">Unit</th>
          <th class="text-center">No Batch</th>
          <th class="text-center">Production Date</th>
          <th class="text-center">Expire Date</th>
          <th class="text-center">Satuan</th>
          <th class="text-center">Total obat</th>
        </tr>
      </thead>
      <tbody>
        @php
          $total_all = 0;
        @endphp
        @foreach ($data as $item)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>
              <table class="mx-auto">
                @foreach ($item->medicineStoks as $ms)
                  <tr>
                    <td>{{ $ms->unit->name }}</td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table class="mx-auto">
                @foreach ($item->medicineStoks as $ms)
                  <tr>
                    <td>{{ $ms->no_batch }}</td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table class="mx-auto">
                @foreach ($item->medicineStoks as $ms)
                  <tr>
                    <td>{{ $ms->production_date }}</td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table class="mx-auto">
                @foreach ($item->medicineStoks as $ms)
                  <tr>
                    <td>{{ $ms->exp_date }}</td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td>
              <table class="mx-auto">
                @foreach ($item->medicineStoks as $ms)
                  <tr>
                    <td>{{ $ms->medicine->small_unit ?? '' }}</td>
                  </tr>
                @endforeach
              </table>
            </td>
            @foreach ($item->medicineStoks as $ms)
              @php
              $total_all += $ms->stok;
              @endphp
            @endforeach
            <td class="text-center">{{ $item->medicineStoks->sum('stok') }}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td class="text-center" colspan="6">Total</td>
          <td class="text-center"></td>
          <td class="text-center">{{ $total_all }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
@endsection