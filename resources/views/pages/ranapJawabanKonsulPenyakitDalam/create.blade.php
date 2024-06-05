@extends('layouts.backend.main')

@section('content')
  @if (session()->has('success'))
  <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute"
      style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
      {{ session('success') }}
  </div>
  @endif
  <div class="card p-3 mt-5">
    <h5 class="m-0 my-2 text-uppercase fs-6 fw-bold">
      lembaran konsultasi penyakit dalam (toleransi operasi)
    </h5>
    <p class="text-uppercase text-end fw-bold mt-2">jawaban konsultasi</p>
    <div class="card-body">
      <form action="{{ route('jawaban/konsultasi/penyakit/dalam.store', $item->id) }}" method="POST">
        @csrf
        <!--  -->
        <p class="m-0 d-flex fw-medium">
          Yth. dr
          <span class="mx-2">
            <input type="text" value="{{ $item->ranapPermintaanKonsulPenyakitDalamPatient->user->name ?? '' }}" class="form-control form-control-sm" disabled/>
          </span>
        </p>

        <p class="m-0 d-flex fw-medium">
          membalas konsul TS, dengan ini kami telah memeriksa pasien
          <span class="mx-2">
            <input type="text" value="{{ $item->ranapPermintaanKonsulPenyakitDalamPatient->patient->name ?? '' }}" class="form-control form-control-sm" name="ket_pasien" readonly/>
          </span>
        </p>

        <!--  -->
        <p class="m-1 d-flex fw-bold">
          Penemuan:
        </p>

        <!--  -->
        <div class="mx-1 row fw-bold">
            S:
          <div class="col-10">
            <input type="hidden" name="name_penemuan[]" value="S"/>
            <input type="text" name="value_penemuan[]" class="form-control form-control-sm" />
          </div>
        </div>

        <div class="m-1 fw-bold d-flex">
          O:
          <table class="table-bordered w-100 text-center m-1">
            <tr>
              <th>Keadaan Umum</th>
              <th>Kesadaran</th>
              <th>Tekanan Darah</th>
              <th>Frekuensi Nadi</th>
              <th>Frekuensi Napas</th>
              <th>suhu</th>
              <th>SPO<sub>2</sub></th>
            </tr>

            <tr>
              @foreach ($arrO as $o)
              <td>
                <input type="hidden" name="name_penemuan[]" value="{{ $o }}"/>
                <input class="form-control form-control-sm" name="value_penemuan[]" type="number" />
              </td>
              @endforeach
            </tr>
          </table>
        </div>

        <!--  -->
        <div class="row fw-bold mt-4">
          <div class="col-1">
            THORAX
          </div>
          <div class="col-6">
            <input type="hidden" name="name_penemuan[]" value="THORAX"/>
            <input type="text" name="value_penemuan[]" class="form-control form-control-sm" />
          </div>
        </div>
        <div class="row fw-bold mt-2">
          <div class="col-1">
            ABDOMEN
          </div>
          <div class="col-6">
            <input type="hidden" name="name_penemuan[]" value="ABDOMEN"/>
            <input type="text" name="value_penemuan[]" class="form-control form-control-sm" />
          </div>
        </div>

        <!--  -->
        <div class="container text-center fw-medium mt-5">
          <div class="row row-cols-2 text-start">
            <!-- left -->
            <div class="col mt-5">

              <table class="w-100">
                @foreach ($arrLainnya as $lainnyaName)
                <tr>
                  <td>{{ $lainnyaName }}</td>
                  <td>:</td>
                  <td>
                    <input type="hidden" name="name_lainnya[]" value="{{ $lainnyaName }}"/>
                    <input type="text" name="value_lainnya[]" class="form-control form-control-sm" />
                  </td>
                </tr>
                @endforeach
              </table>
            </div>

            <!-- righr -->
            <!-- skirining covid-19 -->
            <div class="col">
              <p class="fw-bold">Skirining Covid-19</p>
              <table class="w-100">
                @foreach ($arrSkrining as $skrin)
                <tr>
                  <td>{{ $skrin }}</td>
                  <td>:</td>
                  <td>
                    <input type="hidden" name="name_skrin[]" value="{{ $skrin }}"/>
                    <input type="number" name="value_skrin[]" class="form-control form-control-sm" value="0"/>
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="3"><hr /></td>
                </tr>
                <tr>
                  <td>Skor</td>
                  <td>:</td>
                  <td>
                    <input id="total_skor_skrining" type="text" class="form-control form-control-sm" disabled/>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <!--  -->
        <div class="row mb-3">
          <label for="editor" class="form-label">Kesimpulan</label>
          <div class="col-12">
            <textarea name="kesimpulan" id="editor" class="form-control"></textarea>
          </div>
        </div>
        <div class="row">
          <label for="editor" class="form-label">Anjuran</label>
          <div class="col-12">
            <textarea name="anjuran" id="editor1" class="form-control"></textarea>
          </div>
        </div>

        <!--  -->
        <p class="fw-medium mt-5">
          Atas perhatian dan kerjasama diucapkan terima kasih.
        </p>
        <div class="text-end">
          <button type="submit" class="btn btn-sm btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.ready(function(){

    })
  </script>
@endsection
