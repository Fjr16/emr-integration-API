@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
<div class="card p-3 mt-5">
  
  <div class="d-flex">
    <h4 class="align-self-center m-0">Informasi Jadwal Dokter</h4>
  </div>
  <hr class="m-0 mt-2 mb-3">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap bg-dark">
          <th>No</th>
          <th>Poli</th>
          <th>Senin</th>
          <th>Selasa</th>
          <th>Rabu</th>
          <th>Kamis</th>
          <th>Jum'at</th>
          <th>Sabtu</th>
          <th>Minggu</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($polikliniks as $poli)     
          {{-- @foreach ($poli->doctorPolis as $item) --}}
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $poli->name ?? '' }}</td>
            <td>
                @foreach ($poli->doctorPolis as $polidokter)
                  @foreach ($polidokter->doctorSchedules as $dctr)
                    @if ($dctr->day == 'Senin' && $dctr->start_at !== null)
                      {{ $polidokter->user->name }} | Jam {{ $dctr->start_at }} - {{ $dctr->ends_at }}<br>
                    @endif
                  @endforeach
                @endforeach
            </td>
            <td>
              @foreach ($poli->doctorPolis as $polidokter)
                @foreach ($polidokter->doctorSchedules as $dctr)
                  @if ($dctr->day == 'Selasa' && $dctr->start_at !== null)
                    {{ $polidokter->user->name }} | Jam {{ $dctr->start_at }} - {{ $dctr->ends_at }}<br>
                  @endif
                @endforeach
              @endforeach
            </td>
            <td>
              @foreach ($poli->doctorPolis as $polidokter)
                @foreach ($polidokter->doctorSchedules as $dctr)
                  @if ($dctr->day == 'Rabu' && $dctr->start_at !== null)
                    {{ $polidokter->user->name }} | Jam {{ $dctr->start_at }} - {{ $dctr->ends_at }}<br>
                  @endif
                @endforeach
              @endforeach
            </td>
            <td>
              @foreach ($poli->doctorPolis as $polidokter)
                @foreach ($polidokter->doctorSchedules as $dctr)
                  @if ($dctr->day == 'Kamis' && $dctr->start_at !== null)
                    {{ $polidokter->user->name }} | Jam {{ $dctr->start_at }} - {{ $dctr->ends_at }}<br>
                  @endif
                @endforeach
              @endforeach
            </td>
            <td>
              @foreach ($poli->doctorPolis as $polidokter)
                @foreach ($polidokter->doctorSchedules as $dctr)
                  @if ($dctr->day == 'Jumat' && $dctr->start_at !== null)
                    {{ $polidokter->user->name }} | Jam {{ $dctr->start_at }} - {{ $dctr->ends_at }}<br>
                  @endif
                @endforeach
              @endforeach
            </td>
            <td>
              @foreach ($poli->doctorPolis as $polidokter)
                @foreach ($polidokter->doctorSchedules as $dctr)
                  @if ($dctr->day == 'Sabtu' && $dctr->start_at !== null)
                    {{ $polidokter->user->name }} | Jam {{ $dctr->start_at }} - {{ $dctr->ends_at }}<br>
                  @endif
                @endforeach
              @endforeach
            </td>
            <td>
              @foreach ($poli->doctorPolis as $polidokter)
                @foreach ($polidokter->doctorSchedules as $dctr)
                  @if ($dctr->day == 'Minggu' && $dctr->start_at !== null)
                    {{ $polidokter->user->name }} | Jam {{ $dctr->start_at }} - {{ $dctr->ends_at }}<br>
                  @endif
                @endforeach
              @endforeach
            </td>
          </tr>    
          {{-- @endforeach --}}
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection