@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
    <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content; left: 50%; transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="card p-3 mt-3">
    <div class="d-flex mb-3">
        <h4 class="align-self-center m-0">Jadwal Dokter</h4>
    </div>

    @csrf
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="id_dokter">Dokter</label>
        <div class="col-sm-10">
            <select name="id_dokter" id="id_dokter" class="form-select select2" aria-label="Default select example" onchange="getPoli()">
                <option selected disabled>Pilih</option>
                @foreach ($dokters as $dokter)
                    @if (old('id_dokter') == $dokter->id)
                        <option value="{{ $dokter->id }}" selected>{{ $dokter->name }} / {{$dokter->roomDetail->name}}</option>
                    @else
                        <option value="{{ $dokter->id }}">{{ $dokter->name }} / {{$dokter->roomDetail->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
            <a id="urlShow" href="" class="btn btn-sm btn-success">Lihat Jadwal</a>
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
                {{--
                @foreach ($days as $day)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $day }}</td>
                        <td>
                            <input type="time" name="start_at[]" class="form-control form-control-sm" value="" />
                        </td>
                        <td>
                            <input type="time" name="ends_at[]" class="form-control form-control-sm" value="" />
                        </td>
                    </tr>
                @endforeach
                --}}
            </tbody>
        </table>
    </div>
</div>

<script>
    function getPoli(){
        const id = document.getElementById('id_dokter').value;
        fetch(`{{ route('dokter/jadwal.show', '') }}/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById("urlShow").setAttribute("href", `{{ route('dokter/jadwal.edit', '') }}/${data.id}`);
            });
    }
</script>

@endsection
