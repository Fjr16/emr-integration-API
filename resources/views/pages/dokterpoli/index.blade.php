@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  <div class="d-flex">
    <h4 class="align-self-center m-0">Dokter Poli</h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Poli</th>
          <th class="px-4 w-25">Nama Dokter</th>
          {{-- <th>Kuota</th> --}}
          {{-- <th>Update</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach ($polis as $poli)    
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $poli->name }}</td>
            <td colspan="3">
              <table class="table">
                @foreach ($poli->users as $dokter)
                <form action="{{ route('dokter/poli.update', $dokter->id) }}" method="POST">
                  @method('PUT')
                  @csrf
                  <tr>
                    <td class="w-25">{{ $dokter->name }}</td>
                    {{-- <td style="" class="w-25"><input type="number" name="kuota" value="{{ old('kuota', $dokter->kuota) }}" class="form-control form-control-sm" id="basic-default-name" /></td> --}}
                    {{-- <td class="text-center"><div class=""><button style="margin-right: 60px" class="btn btn-dark btn-sm" type="submit"><i class='bx bx-up-arrow-alt' ></i></button><div class="w-25"></div></div></td> --}}
                  </tr>
                </form>  
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

