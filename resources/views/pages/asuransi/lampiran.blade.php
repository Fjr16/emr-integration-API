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
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pasien</th>
                <th scope="col">Jenis Rawatan</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Tanggal Keluar</th>
                <th scope="col">Total Biaya</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="fw-bold" colspan="6">A. Rawat Jalan</td>
              </tr>
              @foreach ($rawatJalan as $jalan)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $jalan->name }}</td>
                <td>{{ $jalan->category }}</td>
                <td>{{ $jalan->masuk }}</td>
                <td>{{ $jalan->keluar }}</td>
                <td>{{ $jalan->total }}</td>
              </tr>
              @endforeach
              <tr>
                <td class="fw-bold" colspan="6">A. Rawat Inap</td>
              </tr>
              @foreach ($rawatInap as $inap)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $inap->name }}</td>
                <td>{{ $inap->category }}</td>
                <td>{{ $inap->masuk }}</td>
                <td>{{ $inap->keluar }}</td>
                <td>{{ $inap->total }}</td>
              </tr>
              @endforeach
              <tr>
                <td></td>
                <td class="fw-bold">Jumlah</td>
                <td></td>
                <td></td>
                <td></td>
                <td id="angka">{{ $item->asuransiDetailPatient->sum('total') }}</td>
              </tr>
              <tr>
                <td class="fw-bold">Terbilang : </td>
                <td class="fw-bold" id="terbilang" colspan="5"></td>
              </tr>
            </tbody>
          </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        // Fungsi untuk mengonversi angka menjadi teks terbilang dalam bahasa Indonesia
        function terbilang(angka) {
            const satuan = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan"];
            const belasan = ["", "sebelas", "dua belas", "tiga belas", "empat belas", "lima belas", "enam belas", "tujuh belas", "delapan belas", "sembilan belas"];
            const puluhan = ["", "sepuluh", "dua puluh", "tiga puluh", "empat puluh", "lima puluh", "enam puluh", "tujuh puluh", "delapan puluh", "sembilan puluh"];

            if (angka < 10) {
                return satuan[angka];
            } else if (angka < 20) {
                return belasan[angka % 10];
            } else if (angka < 100) {
                return puluhan[Math.floor(angka / 10)] + " " + satuan[angka % 10];
            } else if (angka < 1000) {
                return satuan[Math.floor(angka / 100)] + " ratus " + terbilang(angka % 100);
            } else if (angka < 10000) {
                return terbilang(Math.floor(angka / 1000)) + " ribu " + terbilang(angka % 1000);
            } else if (angka < 1000000) {
                return terbilang(Math.floor(angka / 1000)) + " ribu " + terbilang(angka % 1000);
            } else if (angka < 10000000) {
                return terbilang(Math.floor(angka / 1000000)) + " juta " + terbilang(angka % 1000000);
            } else if (angka < 1000000000) {
                return terbilang(Math.floor(angka / 1000000)) + " juta " + terbilang(angka % 1000000);
            } else {
                return "Angka terlalu besar untuk dikonversi.";
            }
        }

        // Ambil elemen <td> yang berisi angka
        const angkaElement = document.getElementById('angka');
        const angkaText = angkaElement.textContent.trim(); // Ambil teks dan hapus spasi ekstra
        const angka = parseInt(angkaText); // Konversi teks menjadi integer

        // Konversi angka menjadi teks terbilang
        const terbilangText = terbilang(angka) + " rupiah";

        // Masukkan hasil terbilang ke dalam elemen <td> yang sesuai
        const terbilangElement = document.getElementById('terbilang');
        terbilangElement.textContent = terbilangText.charAt(0).toUpperCase() + terbilangText.slice(1); // Capitalize the first letter
    </script>
</body>
</html>