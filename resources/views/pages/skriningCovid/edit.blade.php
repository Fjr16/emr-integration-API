@extends('layouts.backend.main')

@section('content')

<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Edit Skrining Covid | {{ $item->rawatInapPatient->queue->patient->name }}</h5>
        <button class="btn mx-3 btn-sm btn-success" onclick="history.back();">Back</button>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('skrining/covid.update', $item->id) }}">
            @method('PUT')
            @csrf
            <table class="table">
                <thead>
                    <tr class="text-nowrap bg-dark">
                        <th rowspan="2" class="align-middle" scope="col">No</th>
                        <th rowspan="2" class="align-middle" scope="col">Parameter</th>
                        <th colspan="2" scope="colgroup" class="text-center">Skor</th>
                        <th rowspan="2" class="align-middle" scope="col">Keterangan</th>
                    </tr>
                    <tr class="text-nowrap bg-dark">
                        <th scope="col" class="text-center">Ya</th>
                        <th scope="col" class="text-center">Tidak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                    <tr>
                        <td style="width: 50px;">
                            {{ $data->no }}
                            <input type="hidden" name="no[]" class="form-control" value="{{ $data->no }}">
                        </td>
                        <td style=" width: 400px;">
                            {{ $data->name }}
                            <input type="hidden" name="name[]" class="form-control" value="{{ $data->name }}">
                        </td>
                        <td class="text-center">
                            (5)
                            <input type="radio" name="check{{ $loop->iteration }}" value="Ya" {{ $data->check == 'Ya' ? 'checked' : '' }}>
                        </td>
                        <td class="text-center">
                            <input type="radio" name="check{{ $loop->iteration }}" value="Tidak" {{ $data->check == 'Tidak' ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="text" name="ket[]" class="form-control" value="{{ $data->ket }}">
                        </td>
                    </tr>

                    <?php
                    $details = App\Models\DetailParameterSkriningCovidRanapPatient::where('detail_skrining_covid_ranap_patient_id', $data->id)->get();
                    ?>
                    @if ($loop->iteration == 2)
                    <tr>
                        <td style="width: 50px;">
                        </td>
                        <td style="width: 400px;">
                            <ul>Demam atau suhu tubuh tinggi (T>37,5)</ul>
                        </td>

                        <td class="text-center">
                            <input type="checkbox" name="detail-name[]" value="Demam atau suhu tubuh tinggi (T>37,5)" onchange="handleCheckboxChange(this)" {{ $details->contains('name', 'Demam atau suhu tubuh tinggi (T>37,5)') ? 'checked' : '' }}>
                        </td>
                        <td class="text-center">
                        </td>
                        <td>
                            <!-- <input type="text" name="ket[]" class="form-control" disabled> -->
                            <input type="text" name="detail-ket[]" class="form-control" {{ $details->contains('name', 'Demam atau suhu tubuh tinggi (T>37,5)') ? '' : 'disabled' }} value="{{ $details->contains('name', 'Demam atau suhu tubuh tinggi (T>37,5)') ? $details->where('name', 'Demam atau suhu tubuh tinggi (T>37,5)')->first()->ket : '' }}">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50px;">
                        </td>
                        <td style="width: 400px;">
                            <ul>Batuk dan pilek disertai anosmia</ul>
                        </td>

                        <td class="text-center">
                            <input type="checkbox" name="detail-name[]" value="Batuk dan pilek disertai anosmia" onchange="handleCheckboxChange(this)" {{ $details->contains('name', 'Batuk dan pilek disertai anosmia') ? 'checked' : '' }}>
                        </td>
                        <td class="text-center">
                        </td>

                        <td>
                            <input type="text" name="detail-ket[]" class="form-control" {{ $details->contains('name', 'Batuk dan pilek disertai anosmia') ? '' : 'disabled' }} value="{{ $details->contains('name', 'Batuk dan pilek disertai anosmia') ? $details->where('name', 'Batuk dan pilek disertai anosmia')->first()->ket : '' }}">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50px;">
                        </td>
                        <td style="width: 400px;">
                            <ul>Sesak napas (RR>25x/menit dan/atau saturasi O2<90%) dan nyeri tenggorokan</ul>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="detail-name[]" value="Sesak napas (RR>25x/menit dan/atau saturasi O2<90%) dan nyeri tenggorokan" onchange="handleCheckboxChange(this)" {{ $details->contains('name', 'Sesak napas (RR>25x/menit dan/atau saturasi O2<90%) dan nyeri tenggorokan') ? 'checked' : '' }}>
                        </td>
                        <td class="text-center">
                        </td>
                        <td>
                            <input type="text" name="detail-ket[]" class="form-control" {{ $details->contains('name', 'Sesak napas (RR>25x/menit dan/atau saturasi O2<90%) dan nyeri tenggorokan') ? '' : 'disabled' }} value="{{ $details->contains('name', 'Sesak napas (RR>25x/menit dan/atau saturasi O2<90%) dan nyeri tenggorokan') ? $details->where('name', 'Sesak napas (RR>25x/menit dan/atau saturasi O2<90%) dan nyeri tenggorokan')->first()->ket : '' }}">
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <br>
            <div class="row justify-content-end text-center">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-sm btn-dark">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function handleCheckboxChange(checkbox) {
        var ketInput = checkbox.parentElement.nextElementSibling.nextElementSibling.querySelector('input[name="detail-ket[]"]');
        ketInput.disabled = !checkbox.checked;
    }
</script>
@endsection