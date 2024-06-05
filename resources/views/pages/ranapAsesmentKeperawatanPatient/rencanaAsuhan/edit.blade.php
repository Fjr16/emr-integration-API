@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
  <div class="card mb-4">
    <div class="card-header m-0">
        <div class="row">
        <div class="col-9">
            <h5 class="mb-0 m-0">Asesmen Perawat <span class="fs-4 fw-bold text-primary">{{ $item->patient->name ?? '' }}</span></h5>
        </div>
        <div class="col-3 m-0 text-end">
          <a href="{{ route('ranap/assesmen/awal/keperawatan.detail', $item->patient_id) }}" class="btn btn-success btn-sm">Kembali</a>
        </div>
        </div>
        <div class="row m-auto mt-2">
          <a href="{{ route('ranap/assesmen/awal/keperawatan.edit', $item->id) }}" class="btn {{ Route::is('ranap/assesmen/awal/keperawatan.edit*') ? 'btn-primary' : '' }} border btn-sm col-3">Status Fisik</a>
          <a href="{{ route('ranap/asesmen/skrining/resiko/jatuh.edit', $item->id) }}" class="btn {{ Route::is('ranap/asesmen/skrining/resiko/jatuh.edit*') ? 'btn-primary' : '' }} border btn-sm col-3">Skrining Resiko Jatuh</a>
          <a href="{{ route('ranap/asesmen/diagnosis/keperawatan.edit', $item->id) }}" class="btn {{ Route::is('ranap/asesmen/diagnosis/keperawatan.edit*') ? 'btn-primary' : '' }} border btn-sm col-3">Diagnosis Keperawatan</a>
          <a href="{{ route('ranap/asesmen/rencana/asuhan.edit', $item->id) }}" class="btn {{ Route::is('ranap/asesmen/rencana/asuhan.edit*') ? 'btn-primary' : '' }} border btn-sm col-3">Rencana Asuhan</a>
        </div>
    </div>

    <div class="card-body">
      <h6 class="text-center bg-dark text-white py-2">RENCANA ASUHAN</h6>
      <div class="row mb-3">
        <form action="{{ route('ranap/asesmen/rencana/asuhan.store', $item->queue_id) }}" method="POST">
          @csrf
          <div class="col-sm-4 ">
            <div class="mx-2">
              @foreach ($rencanaAsuhan as $asuhan)
              @php
                  $detail = $detailRencanaAsuhan->where('name', $asuhan)->first();
                  if ($detail) {
                    $checked = 'checked';
                  }else {
                    $checked = null;
                  }
              @endphp
              <div class="form-check">
                <input class="form-check-input" type="hidden" value="{{$asuhan}}" name="rencana-asuhan[]" id="defaultCheck1" />
                <input class="form-check-input" type="checkbox" value="{{$asuhan}}" {{$checked}} name="asuhan[]" id="defaultCheck1" />
                <label class="form-check-label" for="defaultCheck1">
                  {{ $asuhan }}
                </label>
              </div>
              @endforeach
            </div>
          </div>


            <div class="row mb-3 text-end">
                @php
                    $format = Carbon\Carbon::parse($asesmentKeperawatanRencanaAsuhan->tanggal ?? '');
                    $date = $format->format('Y-m-d');
                    $time = $format->format('H:i');
                @endphp
                <div class="col-6"></div>
                    <div class="col-2">Padang, Tanggal</div>
                    <div class="col-2"><input type="date" name="date" value="{{$date}}" class="form-control form-control-sm"></div>
                    <div class="col-1">Pukul</div>
                    <div class="col-1"> <input type="time" name="time" value="{{$time}}" class="form-control form-control-sm"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-4"></div>
                    <div class="col-4 text-center">Diriview</div>
                    <div class="col-4"></div>
                </div>
                <div class="row mb-5">
                    <div class="col-4 text-center">Dokter Penanggung Jawab Pelayanan</div>
                    <div class="col-4"></div>
                    <div class="col-4 text-center">Perawat Penanggung Jawan Asuhan</div>
                </div>
                <div class="row mb-5">
                    <div class="col-4 text-center">
                        <img src="{{Storage::url($asesmentKeperawatanRencanaAsuhan->ttddpjp ?? '')}}" alt="" id="ImgTtdDPJP">
                        <textarea id="ttdDPJP" name="ttdDPJP" style="display: none;"></textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModalTtdBottom(this, 'ImgTtdDPJP', 'ttdDPJP')">Tanda
                            Tangan</button>
                    </div>
                    <div class="col-4 text-center">

                    </div>
                    <div class="col-4 text-center">
                        <img src="{{Storage::url($asesmentKeperawatanRencanaAsuhan->ttdppja ?? '')}}" alt="" id="ImgTtdPPJA">
                        <textarea id="ttdPPJA" name="ttdPPJA" style="display: none;"></textarea>
                        <button type="button" class="col-12 btn btn-sm btn-dark"
                            onclick="openModalTtdBottom(this, 'ImgTtdPPJA', 'ttdPPJA')">Tanda
                            Tangan</button>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm" name="namadpjp" value="{{$asesmentKeperawatanRencanaAsuhan->namadpjp ?? ''}}"
                            placeholder="Nama Lengkap">
                    </div>
                    <div class="col-4 text-center"></div>
                    <div class="col-4 text-center">
                        <input type="text" class="form-control form-control-sm" name="namappja" value="{{$asesmentKeperawatanRencanaAsuhan->namappja ?? ''}}"
                            placeholder="Nama Lengkap">
                    </div>
                </div>
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
        </form>
        </div>
      <div class="mb-3">
      </div>
    </div>

</div>

{{-- modal create ttd --}}
    <div class="modal fade" id="signaturePadModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalScrollableTitle">Signature Pad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div id="signature-pad" class="m-signature-pad">
                        <div class="m-signature-pad--body">
                            <canvas style="border: 3px dashed #ccc"></canvas>
                        </div>

                        <div class="m-signature-pad--footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-action="clear">Clear</button>
                            <button type="button" class="btn btn-sm btn-primary" data-action="save">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let tempElementImage;
        let tempTextArea;

        function openModal(element, iteration) {
            tempElementImage = $(element).closest('#row-ttd-pasien').find('#ttdImage' + iteration);
            tempTextArea = $(element).closest('#row-ttd-pasien').find('#ttd' + iteration);
            $('#signaturePadModal').modal('show');
        }

        function openModalTtdBottom(element, elementImg, elementTextArea) {
            console.log(element.closest('td'));
            tempElementImage = $(element).closest('.row').find('#' + elementImg);
            tempTextArea = $(element).closest('.row').find('#' + elementTextArea);
            $('#signaturePadModal').modal('show');
        }

        document.addEventListener("DOMContentLoaded", function() {
            var wrapper = document.getElementById("signaturePadModal");
            var clearButton = wrapper.querySelector("[data-action=clear]");
            var saveButton = wrapper.querySelector("[data-action=save]");
            var canvas = wrapper.querySelector("canvas");
            var signaturePad;

            // Fungsi untuk mengatur ukuran canvas
            // function resizeCanvas() {
            //     var ratio = window.devicePixelRatio || 1;
            //     canvas.width = canvas.offsetWidth * ratio;
            //     canvas.height = canvas.offsetHeight * ratio;
            //     canvas.getContext("2d").scale(ratio, ratio);

            //     // Reinitialize SignaturePad setelah meresize canvas
            //     signaturePad = new SignaturePad(canvas);
            // }

            // resizeCanvas();

            // Initialize SignaturePad
            // agar library signature pad dapat digunakan pada modal
            signaturePad = new SignaturePad(canvas);

            // Event handler untuk tombol clear
            clearButton.addEventListener("click", function(e) {
                e.preventDefault();
                signaturePad.clear();
            });

            // Event handler untuk tombol save
            // var ttd = document.getElementById('ttd1');
            saveButton.addEventListener("click", function(e) {
                e.preventDefault();
                var signatureData = signaturePad.toDataURL();
                tempElementImage.attr('src', signatureData);
                tempTextArea.val(signatureData);
                // document.getElementById("signature64").value = signatureData;
                signaturePad.clear();

                //close modal
                $('#signaturePadModal').modal('hide');
            });


            // Event listener untuk meresize canvas saat window diubah ukurannya
            // window.addEventListener("resize", resizeCanvas);
        });
    </script>

@endsection
