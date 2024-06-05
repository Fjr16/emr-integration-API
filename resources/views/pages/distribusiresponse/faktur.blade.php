<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faktur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">  
    <style>
      body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        
      }
  
      * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
      }
  
      .page {
        width: 21.59cm;
        min-height: 13.97cm;
        padding: 15mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        position: relative;
      }
  
      .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
      }
      
      td {
        padding-top: 5px;
      }

      .borderhr {
        color: black;
        background-color: black;
        border-color: black;
        height: 5px;
        opacity: 100;
      }
      
  
      @page {
        size: A4;
        margin: 0;
      }
  
      @media print {
  
        html,
        body {
          width: 21.59cm;
          height: 13.97cm;
        }
  
        .page {
          margin: 0;
          border: initial;
          border-radius: initial;
          width: initial;
          min-height: initial;
          box-shadow: initial;
          background: initial;
          page-break-after: always;
        }
      }
    </style>
  </head>
  <body>
    <div class="page">
      <h5 class="text-center mb-3">Faktur Distribusi Obat</h5>
      <hr>
      <table class="mb-3">
        <tbody>
          <tr>
            <td>Dari Unit</td>
            <td>:</td>
            <td>{{ $item->unitCategory->unit->name ?? '' }} - {{ $item->unitCategory->unitCategoryPivot->name ?? '' }}</td>
          </tr>
          <tr>
            <td>Ke Unit</td>
            <td>:</td>
            <td>{{ $item->medicineDistributionRequest->unitCategory->unit->name ?? '' }} - {{ $item->medicineDistributionRequest->unitCategory->unitCategoryPivot->name ?? '' }}</td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ $item->created_at }}</td>
          </tr>
        </tbody>
      </table>
      <table class="table-bordered w-100 mb-3">
        <thead class="text-center">
          <tr>
            <th>No</th>
            <th>Kode Obat</th>
            <th>Nama Obat</th>
            <th>No Batch</th>
            <th>Tanggal Produksi</th>
            <th>Expire</th>
            <th>Qty</th>
            <th>Satuan</th>
            <th>Harga Satuan</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($item->medicineDistributionRequest->medicineDistributionDetails as $detail)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $detail->medicine->kode ?? '' }}</td>
            <td>{{ $detail->medicine->name ?? '' }}</td>
            <td class="text-center">{{ $detail->medicineStok->no_batch }}</td>
            <td class="text-center">{{ $detail->medicineStok->production_date }}</td>
            <td class="text-center">{{ $detail->medicineStok->exp_date }}</td>
            <td class="text-center">{{ $detail->jumlah ?? '' }}</td>
            <td class="text-center">{{ $detail->satuan ?? '' }}</td>
            <td class="text-center">{{ number_format($detail->medicineStok->harga) ?? '' }}</td>
            <?php $total_harga = $detail->medicineStok->harga*$detail->jumlah ?>
            <td class="text-center">{{ number_format($total_harga) }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="row">
        <div class="col-4">
          <p class="text-center">Unit {{ $item->unitCategory->unit->name ?? '' }} - {{ $item->unitCategory->unitCategoryPivot->name ?? '' }}</p>
          <br><br>
          <p><hr></p>
        </div>
        <div class="col-4"></div>
        <div class="col-4">
          <p class="text-center">Unit {{ $item->medicineDistributionRequest->unitCategory->unit->name ?? '' }} - {{ $item->medicineDistributionRequest->unitCategory->unitCategoryPivot->name ?? '' }}</p>
          <br><br>
          <p><hr></p> 
        </div>
      </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>