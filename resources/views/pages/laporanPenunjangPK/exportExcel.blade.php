<style>
    /* CSS untuk tabel */
    table {
        width: 100%;
        border-collapse: collapse;
    }
  
    /* CSS untuk header tabel */
    th {
        background-color: #f2f2f2;
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
  
    /* CSS untuk sel data */
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
  
    /* ... Anda bisa menambahkan CSS lainnya sesuai kebutuhan */
  </style>

<table class="table">
    <tbody>
        <tr>
            <td colspan="4">
                Riwayat Pemeriksaan Laboratorium Patologi Klinik
            </td>
        </tr>
        <tr></tr>
        <tr>
            <td>Nama / No rm : </td>
            <td>{{ $item->patient->name ?? '' }} / {{ implode('-', str_split(str_pad($item->patient->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
            <td>Tanggal Permintaan : </td>
            <td>{{ $item->laboratoriumRequest->created_at->format('Y-m-d') ?? '' }}</td>
            
        </tr>
        <tr>
            <td>No. Reg Labor : </td>
            <td>{{ $item->nomor_reg_lab ?? '' }}</td>
            <td>Petugas Laboratorium : </td>
            <td>{{ $item->user->name ?? '' }}</td>
        </tr>
        <tr>
            <td>Diagnosa Klinis : </td>
            <td>{!! $item->laboratoriumRequest->diagnosa ?? '' !!}</td>
            <td>Tanggal Periksa : </td>
            <td>{{ $item->tanggal_periksa ?? '' }}</td>
        </tr>
    </tbody>
</table>
<table class="table" id="example">
    <thead>
        <tr class="text-nowrap bg-dark">
            <th colspan="2" class="text-center">Nama Pemeriksaan</th>
            <th class="text-center">Hasil</th>
            <th class="text-center">Kondisi Kritis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($item->laboratoriumPatientResultDetails as $detail) 
            <tr>
                <td colspan="2" class="text-center">{{ $detail->laboratoriumRequestMasterVariable->name ?? '' }}</td>
                <td class="text-center">{{ $detail->value ?? '' }}</td>
                <td class="text-center">
                    {{ $detail->kondisi_kritis == true ? 'YA' : 'TIDAK' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
