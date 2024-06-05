<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">  
    <style>
      body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Times New Roman";
      }
  
      * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
      }
  
      .page {
        width: 210mm;
        min-height: 297mm;
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
          width: 210mm;
          height: 297mm;
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
      <div class="container d-flex justify-content-end">
        <p class="">Padang {{ date_format($item->created_at, 'd F Y')  }}</p>
      </div>
      <table class="w-100">
        <tbody>
          <tr>
            <td>No</td>
            <td>:</td>
            <td class="">{{ $item->no }}</td>
          </tr>
          <tr>
            <td style="width: 180px;">Lamp</td>
            <td>:</td>
            <td>{{ $item->lamp }}</td>
          </tr>
          <tr>
            <td>Hal</td>
            <td>:</td>
            <td>{{ $item->hal }}</td>
          </tr>
        </tbody>
      </table>
      <p class="mt-4">
        kepada <br> Yth.Bapak/Ibu Pimpinan <br> {{ $item->name }} <br> <br> Dengan hormat, <br> <br> 
        Sebelumnya kami dari pihak manajemen Rumah Sakit Khusus Bedah Ropanasuri mengucapkan terima kasih atas kerjasama kita yang sudah terjalin dengan baik selama ini. <br> <br>
        Selanjutnya, kami kirimkan rekapitulasi biaya rawatan dan pengobatan pasien selama periode {{ $item->periode }} dengan total tagihan senilai Rp. <span class="fw-bold">{{ number_format($item->asuransiDetailPatient->sum('total'), 2, ',', '.') }}</span>
      </p>
      <p class="container">PT. Bank Rakyat Indonesia ( BRI ) <br> No. Rek. 2027-01-000047-30-7 <br> a/n  PT. Rumah Sakit Ropanasuri</p>
      <br>
      <p>Demikianlah surat ini kami sampaikan, atas perhatian dan kerja samanya kami ucapkan terima kasih.</p>
      <br>
      <div class="row mt-5">
        <div class="col-6">
          
        </div>
        <div class="col-6">
          <p class="text-center mt-3">
            Hormat Kami, <br> RS Ropanasuri
          </p>
          <img src="ttd.png" class="img-fluid" alt="">
          <p class="fw-bold text-center">
            <u>Alvino Putra S,Tr.Ak</u> 
            <br><span class="fw-light">Manager Keuangan & Akuntansi</span>
          </p>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>