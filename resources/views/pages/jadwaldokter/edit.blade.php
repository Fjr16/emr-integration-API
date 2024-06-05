@extends('layouts.backend.main')

@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
            style="z-index:99; max-width:max-content; left: 50%; transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-3 mt-3">
        <div class="d-flex mb-3">
            <h4 class="align-self-center m-0">Jadwal Dokter</h4>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="id_dokter">Dokter</label>
            <div class="col-sm-10">
                <select name="id_dokter" id="id_dokter" class="form-select select2" aria-label="Default select example"
                    onchange="updateLinks()">
                    <option selected disabled>Pilih</option>
                    @foreach ($dokters as $dokter)
                        @if (old('id_dokter', $item->id) == $dokter->id)
                            <option value="{{ $dokter->id }}" selected>{{ $dokter->name }} /
                                {{ $dokter->roomDetail->name }}</option>
                        @else
                            <option value="{{ $dokter->id }}">{{ $dokter->name }} / {{ $dokter->roomDetail->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <a id="urlShow" href="" class="btn btn-sm btn-dark">Lihat Jadwal</a>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th>No</th>
                        <th>Hari</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($item->doctorSchedules) != null)
                        <form action="{{ route('dokter/jadwal.update', $item->id) }}" method="POST">
                            @csrf
                            @foreach ($item->doctorSchedules as $jadwal)
                                <tr>
                                    <td scope="row" class="text-dark">{{ $loop->iteration }}</td>
                                    <td>{{ $jadwal->day }}</td>
                                    <input type="hidden" name="days[]" value="{{ $jadwal->day }}">
                                    <td>
                                        <input type="time" name="start_at[]" class="form-control form-control-sm"
                                            value="{{ old('start_at', $jadwal->start_at) }}" />
                                    </td>
                                    <td>
                                        <input type="time" name="ends_at[]" class="form-control form-control-sm"
                                            value="{{ old('ends_at', $jadwal->ends_at) }}" />
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-end border-0 pt-5">
                                    <button class="btn btn-success btn-sm" type="submit">Update</button>
                                </td>
                            </tr>
                        </form>
                    @else
                        <form action="{{ route('dokter/jadwal.store', $item->id) }}" method="POST">
                            @csrf
                            @foreach ($days as $day)
                                <tr>
                                    <th scope="row" class="text-dark">{{ $loop->iteration }}</th>
                                    <td>{{ $day }}</td>
                                    <input type="hidden" name="days[]" value="{{ $day }}">
                                    <td>
                                        <input type="time" name="start_at[]" class="form-control form-control-sm"
                                            value="" />
                                    </td>
                                    <td>
                                        <input type="time" name="ends_at[]" class="form-control form-control-sm"
                                            value="" />
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-end border-0 pt-5">
                                    <button class="btn btn-success btn-sm" type="submit">Update</button>
                                </td>
                            </tr>
                        </form>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function updateLinks() {
            var id = document.getElementById('id_dokter').value;
            document.getElementById("urlShow").setAttribute("href", "{{ route('dokter/jadwal.edit', '') }}/" + id);
        }
    </script>
@endsection
