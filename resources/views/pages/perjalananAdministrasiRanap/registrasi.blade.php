@extends('pages.perjalananAdministrasiRanap.edit')
@section('form')
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('perjalananadministrasi-ranap.update', $data->id) }}">
                @csrf
                @method('PUT')
                {{-- Rekam medis --}}
                <table class="table">
                    <thead>
                        <tr class="text-nowrap bg-dark">
                            <th><input type="hidden" value="{{ $data2->category }}" name="registrasi">{{ $data2->category }}
                            </th>
                            <th></th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data3 as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                @if ($item->name == 'PUASA MULAI JAM')
                                    <td><input type="time" name="rekamMedis[{{ $item->name }}]" class="form-control"
                                            value="{{ $item->value }}" required>
                                    </td>
                                @else
                                    <td><input type="radio" value="ada" name="rekamMedis[{{ $item->name }}]"
                                            {{ $item->value == 'ada' ? 'checked' : '' }} @checked(true)> Ada
                                    </td>
                                    <td><input type="radio" value="tidak" name="rekamMedis[{{ $item->name }}]"
                                            {{ $item->value == 'tidak' ? 'checked' : '' }}> Tidak
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>

                </table>
                {{-- rekam medis end --}}
                <div class="row justify-content-end mt-2">
                    <button type="submit" class="btn btn-sm btn-dark">Save</button>
                </div>

            </form>
        </div>
    </div>
@endsection
