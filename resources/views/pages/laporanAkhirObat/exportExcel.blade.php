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
        <td colspan="7">
          Riwayat Penggunaan Obat
        </td>
      </tr>
      <tr></tr>
      <tr>
        <td>Nama / No rm : </td>
        <td colspan="3">{{ $item->name ?? '' }} / {{ implode('-', str_split(str_pad($item->no_rm ?? '', 6, '0', STR_PAD_LEFT), 2)) }}</td>
        <td>Tanggal : </td>
        
        <td colspan="2">{{ isset($data[0]) ? $data[0]->created_at->format('Y/m/d') : '' }}</td>

      </tr>
      <tr>
        <td>No antrian : </td>
        <td colspan="3">{{ $data[0]->rajalFarmasiPatient->rawatJalanPatient->queue->no_antrian ?? '' }}</td>
        <td>Tanggungan : </td>
        <td colspan="2">{{ $data[0]->rajalFarmasiPatient->rawatJalanPatient->queue->patientCategory->name ?? '' }}</td>
      </tr>
  </tbody>
</table>
  <div class="table-responsive text-nowrap">
      <table class="table" id="example">
        <thead>
          <tr class="text-nowrap bg-dark">
            <th class="text-center">Tanggungan Obat</th>
            <th class="text-center">Nama Obat</th>
            <th class="text-center">No Batch</th>
            <th class="text-center">Harga Satuan</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Total Harga</th>
            <th class="text-center">Total Faktur</th>
          </tr>
        </thead>
        <tbody>
          @php
            $total_all = 0;
          @endphp
          @foreach ($data as $invoice)
          @foreach ($invoice->rajalFarmasiObatDetails as $detail)

            <tr>
              <td>{{ $detail->patientCategory->name ?? '' }}</td>
              <td>{{ $detail->medicine->name ?? '' }}</td>
              <td>{{ $detail->medicineStok->no_batch ?? '' }}</td>
              <td>{{ number_format($detail->harga_satuan ?? '' ) }}</td>
              <td>{{ $detail->jumlah ?? '' }}</td>
              <td>{{ number_format($detail->total_harga ?? '') }}</td>
              <td class="text-center">{{ number_format($invoice->grand_total ?? '') }}</td>
              @php
              $total_all += $invoice->grand_total;
              @endphp
            </tr>
          @endforeach
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td class="text-center" colspan="6">Total Akhir</td>
            <td class="text-center">{{ number_format($total_all ?? '0') }}</td>
          </tr>
        </tfoot>
      </table>
  </div>

