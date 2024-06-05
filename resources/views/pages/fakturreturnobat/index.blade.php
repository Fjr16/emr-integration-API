@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">RETURN ( PM ( CV.PERDANA MANDIRI ))</h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>Valid</th>
          <th>No</th>
          <th>Faktur</th>
          <th>Tanggal</th>
          <th>Total</th>
          <th>Discount</th>
          <th>Total Kotor</th>
          <th>PPN</th>
          <th>Materai</th>
          <th>Bayar</th>
          <th>Restore</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><i class='bx bx-check'></td>
          <th scope="row">1</th>
          <td>0001234</td>
          <td>21-nov-2022</td>
          <td>34124</td>
          <td>0</td>
          <td>0</td>
          <td>0</td>
          <td>0</td>
          <td>0</td>
          <td>
            <button class="btn">
              <i class='bx bxs-left-arrow-square' ></i>
            </button>
          </td>
        </tr>
        </tbody>
    </table>
  </div>
</div>
@endsection