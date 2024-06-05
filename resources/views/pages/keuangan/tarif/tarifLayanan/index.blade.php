@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif

  <div class="card p-3 mt-5">
    <div class="row justify-content-center">
      @foreach ($types as $tipe)
      <a href="{{ route('tarif/layanan.show', $tipe) }}" class="btn btn-success m-1 col-3 btn-sm">{{ $tipe }}</a>
      @endforeach
    </div>
  </div>

<div class="card p-3 mt-5">
  <div class="d-flex">
    <h4 class="align-self-center m-0">MASTER TARIF {{ $type?? '' }}</h4>
    @if (Route::is('tarif/layanan.show'))
    <a href="{{ route('tarif/layanan.create', $type) }}" class="btn btn-success ms-auto btn-sm m-0 mx-3">Tambah Master Tarif</a>
    @endif
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table" id="example">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Type</th>
          <th>Category</th>
          <th>Layanan</th>
          <th>Tarif</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->type }}</td>
            <td>{{ $item->category }}</td>
            <td>{{ $item->layanan }}</td>
            <td>{{ $item->tarif }}</td>
            <td>
              <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                      data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('tarif/layanan.edit', $item->id) }}">
                      <i class='bx bx-edit-alt me-1'></i>
                        Edit
                    </a>
                    <form action="{{ route('tarif/layanan.destroy', $item->id) }}" method="POST">
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

