<table class="table">
    <tbody>
        <tr>
            <td colspan="6">
                Riwayat Pemeriksaan Radiologi
            </td>
        </tr>
        <tr></tr>
        <tr>
            <td>Nama / No rm : </td>
            <td colspan="2">{{ $item->patient->name ?? '' }} / {{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
            <td>Tanggal : </td>
            <td colspan="2">{{ $item->tanggal_periksa ?? '' }}</td>
            
        </tr>
        <tr>
            <td>Divalidasi Oleh : </td>
            <td colspan="2">{{ $item->user->name ?? '' }}</td>
            <td>Diagnosa Klinis : </td>
            <td colspan="2">{!! $item->radiologiFormRequest->diagnosa_klinis ?? '' !!}</td>
        </tr>
    </tbody>
</table>

<table class="table" id="example">
    <thead>
        <tr class="text-nowrap bg-secondary">
            <th class="text-center">Tanggal Periksa</th>
            <th class="text-center">No Reg</th>
            <th class="text-center">Petugas Radiologi</th>
            <th class="text-center">Nama Pemeriksaan</th>
            <th class="text-center">Keterangan</th>
            <th class="text-center">Image</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($item->radiologiPatientRequestDetails as $detail) 
            <tr>
                <td class="text-center">{{ $detail->tanggal ?? '' }}</td>
                <td class="text-center">{{ $detail->nomor ?? '' }}</td>
                <td class="text-center">{{ $detail->user->name ?? '' }}</td>
                <td class="text-center">{{ $detail->radiologiFormRequestDetail->radiologiFormRequestMaster->name ?? '' }} <b>{{ $detail->radiologiFormRequestDetail->radiologiFormRequestMasterDetail->name ?? '' }} {{ $detail->radiologiFormRequestDetail->value ?? '' }}</b></td>
                <td class="text-center">{{ $detail->hasil ?? 'Tidak Ada' }}</td>
                <td class="text-center">
                    @if ($detail->image)
                        <a href="{{ Storage::url($detail->image) }}"> Link Hasil Gambar</a>
                    @else
                        Tidak Ada Gambar
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
