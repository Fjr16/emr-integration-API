@extends('layouts.backend.main')

@section('content')
<div class="card p-3 mt-5">
    <h4 class="">Operasi {{ $patientCategory->id }}</h4>
    <div class="row">
      @foreach ($patientCategories as $category)
        <div class="col-3 mb-3">
          <form action="{{ route('surgery/rates.index', $item->id) }}">
            <input type="number" name="filter" value="{{ $category->id }}" hidden>
            <button class="btn btn-dark btn-sm w-100 @if(request('filter')) {{ $category->id == request('filter') ? 'btn-primary' : '' }} @else {{ $category->id == $patientCategory->id ? 'btn-primary' : '' }} @endif">{{ $category->name }}</button>
          </form>
        </div>
      @endforeach
    </div>
    <hr class="m-0 mt-2 mb-3">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th>THT</th>
            <th>VIP</th>
            <th>VVIP</th>
            <th>Kelas I</th>
            <th>Kelas II</th>
            <th>Kelas III</th>
            <th>Lokal</th>
            <th>Kemoterapi</th>
            <th>One Day Care</th>
            <th>Kelas Utama</th>
            <th>HCU</th>
            <th>Ruang Isolasi</th>
            <th>Bedah Minor</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr>
            <form action="{{ route('surgery/rates.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
              <th scope="row">{{ $item->surgeryCategory->name }}</th>
              <td style="min-width: 150px"><input type="number" name="vip" value="{{ $item->vip ?? '0' }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td style="min-width: 150px"><input type="number" name="vvip" value="{{ $item->vvip ?? '0' }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td style="min-width: 150px"><input type="number" name="kelas1" value="{{ $item->kelas1 ?? '0' }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td style="min-width: 150px"><input type="number" name="kelas2" value="{{ $item->kelas2 ?? '0' }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td style="min-width: 150px"><input type="number" name="kelas3" value="{{ $item->kelas3 ?? '0' }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td style="min-width: 150px"><input type="number" name="lokal" value="{{ $item->lokal ?? '0' }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td style="min-width: 150px"><input type="number" name="kemoterapi" value="{{ $item->kemoterapi ?? '0' }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td style="min-width: 150px"><input type="number" name="onedaycare" value="{{ $item->onedaycare ?? '0' }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td style="min-width: 150px"><input type="number" name="utama" value="{{ $item->utama ?? '0' }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td style="min-width: 150px"><input type="number" name="hcu" value="{{ $item->hcu ?? '0' }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td style="min-width: 150px"><input type="number" name="ruang_isolasi" value="{{ $item->ruang_isolasi ?? '0' }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td style="min-width: 150px"><input type="number" name="bedah_minor" value="{{ $item->bedah_minor ?? '0' }}" class="form-control form-control-sm" id="basic-default-name" /></td>
              <td><button class="btn btn-dark btn-sm"><i class='bx bx-up-arrow-alt' ></i></button></td>
            </form>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection