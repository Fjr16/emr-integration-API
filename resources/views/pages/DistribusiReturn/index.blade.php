@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Return Obat Dari Unit</h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Nama Unit</th>
          <th>Kategori Unit</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $item->name }}</td>
            <td>
              <table class="table" style="max-width: max-content">
                @foreach ($item->unitCategories as $category)
                <tr>
                  <td>{{ $category->unitCategoryPivot->name }}</td>
                  <td class="text-center">
                    {{ count($category->medicineDistributionRequests->where('status', 'SELESAI')->where('medicineDistributionResponse.isAmprahan', 0)) }}
                    <a href="{{ route('farmasi/obat/distribusi/return.show', $category->id) }}">
                      <i class='bx bxs-file-doc' ></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </table>
            </td>
          </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection