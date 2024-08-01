@extends('layouts.backend.main')

@section('content')
@if (session()->has('success'))
<div class="alert alert-success d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-check-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">BERHASIL !!</h6>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>{{ session('error') }}</span>
    </div>
</div>
@endif
@if (session()->has('errors'))
<div class="alert alert-danger d-flex" role="alert">
    <span class="alert-icon rounded-circle"><i class='bx bxs-x-circle' style="font-size: 40px"></i></span>
    <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">ERROR !!</h6>
        <span>
        @foreach (session('errors') as $err)
            {{ $err ?? '' }} <br>
        @endforeach
        </span>
    </div>
</div>
@endif

<div class="card mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0 text-uppercase fw-bold">Edit Penjamin</h5>
  </div>
  <div class="card-body">
      <form method="POST" action="{{ route('pasien/category.update', $item->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Penjamin</label>
            <div class="col-sm-10">
                <input type="text" value="{{ $item->name }}" name="name" class="form-control" id="basic-default-name" required />
            </div>
        </div>

         {{-- data setting margin --}}
        <hr>
        <h5 class="text-uppercase fw-bold">Pengaturan Rumus & Margin</h5>
        <div class="card-header">
            <div class="nav-align-top">
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-within-card-link" aria-controls="navs-pills-within-card-link" aria-selected="false"><i class="bx bxs-cog"></i> Farmasi</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-within-card-active" aria-controls="navs-pills-within-card-active" aria-selected="true">Active</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content">
                {{-- <div class="tab-pane fade show active" id="navs-pills-within-card-active" role="tabpanel">
                    <h4 class="card-title">Special active title</h4>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="javascript:void(0)" class="btn btn-primary">Go somewhere</a>
                </div> --}}
                <div class="tab-pane fade show active" id="navs-pills-within-card-link" role="tabpanel">
                    <div class="row mb-3">
                        <h5 class="card-title mb-2 pb-0">Rumus Penjualan</h5>
                        <div class="card-text">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="include_margin_obt" id="includeMargin" value="1" {{ $item->include_margin_obt ? 'checked' : '' }}/>
                                <label class="form-check-label" for="includeMargin">Ditambah Margin keuntungan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="include_pajak_obt" id="includePajak" value="1" {{ $item->include_pajak_obt ? 'checked' : '' }}/>
                                <label class="form-check-label" for="includePajak">Ditambah Pajak per Satuan Obat</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="include_disc_obt" id="includeDiskon" value="1" {{ $item->include_disc_obt ? 'checked' : '' }}/>
                                <label class="form-check-label" for="includeDiskon">Dikurangi Diskon per Satuan Obat</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="card-title">Margin Obat %</h5>
                        <div class="col-sm-4">
                            <div class="input-group input-group-merge">
                                <input type="number" oninput="this.value=this.value.slice(0,3)" name="margin" class="form-control" id="margin" value="{{ $item->margin ?? 0 }}" {{ $item->margin ? '':'disabled' }}/>
                                <span class="input-group-text bg-secondary text-white" id="basic-addon33">%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12 text-start ms-4">
                <button type="submit" class="btn btn-outline-primary">Update</button>
            </div>
        </div>
      </form>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        const checkMargin = document.getElementById('includeMargin');
        const inputMargin = document.getElementById('margin');

        checkMargin.addEventListener('change', function(){
            if (checkMargin.checked) {
                inputMargin.disabled = false;
            }else{
                inputMargin.disabled = true;
                inputMargin.value = 0;
            } 
        });
    });
</script>
@endsection