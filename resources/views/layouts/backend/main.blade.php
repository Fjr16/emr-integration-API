<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>RSKB | {{ $title }}</title>
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />

    {{-- Flat Picker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    {{-- Flat Picker --}}

    <style>
        .menu-link:hover {
            color: #161515 !important;
        }
    </style>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">

    <style>
        .btn-success {
            background-color: #49a141 !important;
        }

        #example_filter {
            margin-bottom: 10px !important;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"
        integrity="sha512-01CJ9/g7e8cUmY0DFTMcUw/ikS799FHiOA0eyHsUWfOetgbx/t6oV4otQ5zXKQyIrQGTHSmRVPIgrgLcZi/WMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Helpers -->
    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/assets/js/config.js') }}"></script>
</head>

<body>

    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            /* Untuk Firefox */
        }

        /* table rme */
        .outer-wrapper {
            width: 100% !important;
            border: 1px solid #49a141;
            border-radius: 4px;
            box-shadow: 0px 0px 3px #49a141;
            max-height: fit-content;
        }

        .table-wrapper {

            overflow-y: scroll;
            /* overflow-x: scroll; */
            height: fit-content;
            max-height: 66.4vh;
            margin-top: 22px;
            margin: 15px;
            padding-bottom: 20px;
        }

        /* /table rme */
    </style>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('layouts.backend.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('layouts.backend.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->


                    <!-- Footer -->
                    @include('layouts.backend.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- / Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <script type="text/javascript">
        var radioAya = document.getElementById('radioAya');
        var radioAtidak = document.getElementById('radioAtidak');
        var radioBya = document.getElementById('radioBya');
        var radioBtidak = document.getElementById('radioBtidak');
        var komponen11Checkbox = document.getElementById('komponen11');
        var komponen12Checkbox = document.getElementById('komponen12');
        var komponen13Checkbox = document.getElementById('komponen13');
        var komponen21Checkbox = document.getElementById('komponen21');
        var komponen22Checkbox = document.getElementById('komponen22');
        var komponen23Checkbox = document.getElementById('komponen23');

        function updateKomponenCheckbox() {
            komponen11Checkbox.checked = (radioAtidak.checked && radioBtidak.checked);
            komponen21Checkbox.checked = (radioAtidak.checked && radioBtidak.checked);
            komponen13Checkbox.checked = (radioAya.checked && radioBya.checked);
            komponen23Checkbox.checked = (radioAya.checked && radioBya.checked);
            komponen12Checkbox.checked = (radioAya.checked && radioBtidak.checked || radioAtidak.checked && radioBya
                .checked);
            komponen22Checkbox.checked = (radioAya.checked && radioBtidak.checked || radioAtidak.checked && radioBya
                .checked);
            // komponen12Checkbox.checked = (radioAtidak.checked && radioBya.checked);
        }

        radioAya.addEventListener('change', updateKomponenCheckbox);
        radioAtidak.addEventListener('change', updateKomponenCheckbox);
        radioBya.addEventListener('change', updateKomponenCheckbox);
        radioBtidak.addEventListener('change', updateKomponenCheckbox);
    </script>

    <!-- Core JS -->
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2000);
    </script>

    <script type="text/javascript">
        var kriteriaInputs = document.querySelectorAll('select[name="kriteria[]"]');

        kriteriaInputs.forEach(function(input) {
            input.addEventListener('blur', function() {
                var totalInput = document.querySelector('input[name="total"]');
                var total = 0;

                for (var i = 0; i < kriteriaInputs.length; i++) {
                    var value = parseInt(kriteriaInputs[i].value) || 0;
                    total += value;
                }

                skorASF(total);
                totalInput.value = total;
            });
        });

        function skorASF(total) {
            var mandiri = document.getElementById('mandiri');
            var kRingan = document.getElementById('ketergantungan-ringan');
            var kSedang = document.getElementById('ketergantungan-sedang');
            var kBerat = document.getElementById('ketergantungan-berat');
            var kTotal = document.getElementById('ketergantungan-total');

            mandiri.classList.remove('bg-success');
            kRingan.classList.remove('bg-success');
            kSedang.classList.remove('bg-warning');
            kBerat.classList.remove('bg-danger');
            kTotal.classList.remove('bg-danger');

            if (total >= 0 && total <= 20) {
                kTotal.className = 'bg-danger';
            } else if (total > 20 && total <= 61) {
                kBerat.className = 'bg-danger';
            } else if (total > 61 && total <= 90) {
                kSedang.className = 'bg-warning';
            } else if (total > 90 && total <= 99) {
                kRingan.className = 'bg-success';
            } else if (total == 100) {
                mandiri.className = 'bg-success';
            }
        }
    </script>

    <script type="text/javascript">
        var skriningInputs = document.querySelectorAll('input[name="value_skrin[]"]');
        var totalInput = document.getElementById('total_skor_skrining');

        skriningInputs.forEach(function(input) {
            input.addEventListener('blur', function() {
                var total = 0;

                for (var i = 0; i < skriningInputs.length; i++) {
                    var value = parseInt(skriningInputs[i].value) || 0;
                    total += value;
                }

                totalInput.value = total;
            });
        });
        
    </script>
    <script type="text/javascript">
        var anaks = document.querySelectorAll('.anak');
        var dewasas = document.querySelectorAll('.dewasa');
        var usia = document.getElementById('usia').value;

        if (usia < 18) {
            anaks.forEach(function(element) {
                element.hidden = true;
            });
        } else {
            dewasas.forEach(function(element) {
                element.hidden = true;
            });
        }
    </script>
    <script type="text/javascript">
        var inputHambatanSpiritual = document.getElementById('sehat-hambatan-spiritual');
        var inputKet = document.getElementById('ket-sehat-hambatan-spiritual');
        inputKet.addEventListener('blur', function() {
            if (inputKet.value == '') {
                inputHambatanSpiritual.value = '';
                inputHambatanSpiritual.removeAttribute('name');
            } else {
                inputHambatanSpiritual.value = 'Sehat';
                inputHambatanSpiritual.name = 'sehat';
            }
        });
    </script>

    {{-- signature pad js --}}
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('/assets/js/dashboards-analytics.js') }}"></script>

    {{-- Datatables --}}
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>
        $('#Field1NoOrder').DataTable({
            columnDefs: [
                {
                    orderable: false,
                    target: [0]
                }
            ],
        });
        $('#example').DataTable();
        $('#example2').DataTable();
        $('#example3').DataTable();
    </script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('/assets/vendor/libs/select2/select2.js') }}"></script>
    <script>
        // $(document).ready(function() {
        $('.select2').select2();
        $('.select3').select2();
        $(".select4").select2();
        // });
        for (var i = 0; i <= 20; i++) {
            $("#medicine_id_" + i).select2();
            $("#medicine_id_ranap_" + i).select2();
            $("#user_id_" + i).select2();
            $("#room_detail_id_" + i).select2();
            $("#ruang_tf1_" + i).select2();
            $("#ruang_tf2_" + i).select2();
            $("#ruang_tf3_" + i).select2();
        }
        for (var i = 0; i <= 20; i++) {}
    </script>

    {{-- script disabled untuk view patient --}}
    <script>
        $(document).ready(function() {
            $('#kota_id').attr('disabled', true);
            $('#kecamatan_id').attr('disabled', true);
            $('#desa_id').attr('disabled', true);
        });
    </script>
    {{-- placeholder select checkbox --}}
    <script>
        $(document).ready(function() {
            $('#specialist_id').select2({
                placeholder: "Pilih Spesialis"
            });
        });
    </script>
    {{-- get jumlah in multiple input --}}
    <script>
        $(document).on('change', '#satuan', function() {
            getTotal(this);
        });
    </script>

    <script>
        // Daftar ID elemen editor
        var editorIds = ['editor', 'editor1', 'editor2', 'editor3', 'editor4', 'editor5', 'editor6', 'editor7', 'editor8',
            'editor9'
        ];

        // Loop melalui setiap ID editor
        editorIds.forEach(function(editorId) {
            ClassicEditor
                .create(document.querySelector('#' + editorId), {
                    toolbar: {
                        items: ['|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList'],
                    },
                    language: 'en',
                })
                .catch(function(error) {
                    console.error(error);
                });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#tanggal-lahir", {
            dateFormat: "Y-m-d", // Format tanggal MySQL
            maxDate: "today", // Batasan maksimum tanggal yang dapat dipilih
            // defaultDate: "01-01-1990" // Tanggal default jika input kosong
        });
    </script>

    <script>
        let counter1 = 1;

        function addInput(inputContainerId) {
            const inputContainer = document.getElementById(inputContainerId);
            const newInput = document.createElement('div');
            newInput.className = 'row tambah-input mt-2';
            let inputName = '';
            if (inputContainerId === 'input-container1') {
                counter1++;
                inputName = `lainnya[]`;
            } else if (inputContainerId === 'input-container2') {
                counter1++;
                inputName = `pola-nafas[]`;
            }
            newInput.innerHTML = `
          <input class="form-control form-control-sm mx-3" style="max-width: 300px" name="${inputName}" type="text" aria-label=".form-control-sm example">
          <button class="btn btn-sm btn-danger" style="max-width: 40px" onclick="removeInput(this)">-</button>
        `;
            inputContainer.parentNode.insertBefore(newInput, inputContainer.nextSibling);
        }

        function removeInput(button) {
            const input = button.parentNode;
            input.parentNode.removeChild(input);
        }
    </script>


    {{-- start expand collapse table --}}
    <script>
        $(document).ready(function() {
            // Sembunyikan rincian tambahan saat halaman dimuat
            $('.details-row').hide();

            // Tambahkan event click pada tombol toggle-details
            $('.toggle-details').click(function() {
                // Temukan baris detail terkait
                var detailsRow = $(this).closest('tr').next('.details-row');

                // Toggle tampilan rincian tambahan
                detailsRow.toggle();
            });
        });
    </script>
    {{-- end expand collapse table --}}    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#tanggal-lahir", {
            dateFormat: "Y-m-d", // Format tanggal MySQL
            maxDate: "today", // Batasan maksimum tanggal yang dapat dipilih
            // defaultDate: "01-01-1990" // Tanggal default jika input kosong
        });
    </script>

    @yield('script')

</body>

</html>
