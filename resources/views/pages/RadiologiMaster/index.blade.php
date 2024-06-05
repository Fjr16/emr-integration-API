@extends('layouts.backend.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div id="success-message"></div>
    <div class="card mb-4">
        <div class="card-header d-flex">
            <div class="col-4 d-flex align-items-center">
                <h5 class="mb-0">Tambah Variabel Permintaan Radiologi</h5>
            </div>
            <div class="col-8 d-flex">
                <a href="{{ route('rajal/master/tarif/radiologi.index') }}" class="btn btn-success btn-sm ms-auto">+ Tarif Pemeriksaan</a>
                <button type="button" class="btn btn-success btn-sm mx-2" onclick="createCategory()">+ Kategori Pemeriksaan</button>
                <button type="button" class="btn btn-success btn-sm" onclick="createDetail()" >+ Detail Variabel</button>
                {{-- <button type="button" class="btn btn-success btn-sm text-end" onclick="history.back()">Kembali</button> --}}
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('rajal/master/radiologi.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Pemeriksaan</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="basic-default-name" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Kategori Pemeriksaan</label>
                    <div class="col-sm-10">
                    <select class="form-select" id="exampleFormControlSelect1"
                        aria-label="Default select example" name="radiologi_form_request_master_category_id">
                        <option selected disabled>Pilih</option>
                        @foreach ($data as $category)
                            @if (old('radiologi_form_request_master_category_id') == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name ?? '' }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name ?? '' }}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Kode ICD</label>
                    <div class="col-sm-10">
                        <input type="text" name="icd_code" class="form-control" id="basic-default-name" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <input class="form-check-input" type="checkbox" name="input_type" value="text" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Tambah Form Input
                        </label>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="basic-default-name">Variabel Detail</label>
                    <div class="col-sm-10">
                        @foreach ($details as $detail)
                            <input class="form-check-input" type="checkbox" name="radiologi_form_request_master_detail_id[]" value="{{ $detail->id }}" id="checkbox{{ $detail->id }}">
                            <label class="form-check-label" for="checkbox{{ $detail->id }}">
                                {{ $detail->name ?? '' }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="row mb-3 text-end">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                    </div>
                </div>
            </form>

            <div class="card-header d-flex">
                <h5 class="mb-0">Daftar Variabel Permintaan Radiologi</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    @foreach ($data as $item)
                       <div class="col-6">
                         {{-- <p class="fw-bold m-0">{{ $item->name ?? '' }} :</p> --}}
                         <div class="row">
                            <div class="col-8">
                                <h6>{{ $item->name ?? '' }}</h6>
                            </div>
                            <div class="col-4">
                                <div class="text-end d-flex">
                                    <button type="button" class="btn btn-sm btn-dark ms-auto" onclick="editCategory({{ $item->id }})">Edit</button>
                                    <form action="{{ route('rajal/master/category/radiologi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin Ingin Menghapus data ?')">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-sm btn-danger mx-2">
                                          Hapus
                                      </button>
                                    </form>
                                  </div>
                            </div>
                        </div>
                        <div class="row mb-3 mx-3">
                            @foreach ($item->radiologiFormRequestMasters->where('isActive', true) as $variabel)
                                <div class="col-5">
                                    <p class="mb-0">
                                        {{ $variabel->name ?? '' }}
                                    </p>
                                </div>
                                <div class="col-5">
                                    @foreach ($variabel->radiologiFormRequestMasterDetails as $detail)
                                        <small>{{ $loop->first ? '' : ' / '  }}{{ $detail->name ?? '' }}</small>
                                    @endforeach
                                    @if ($variabel->input_type == 'text')
                                        <input type="text" class="form-control form-control-sm "/>
                                    @endif

                                </div>
                                <div class="col-2 d-flex align-self-center">
                                    <button type="button" class="btn btn-sm" onclick="editMasterRadiologi({{ $variabel->id }})"><i class="text-warning bx bx-edit"></i></button>
                                    <form action="{{ route('rajal/master/radiologi.destroy', $variabel->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-sm ms-auto">
                                            <i class="text-danger bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                       </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

     {{-- modal --}}
  <div class="modal fade" id="modalScrollable" tabindex="-1" aria-labelledby="modalScrollableTitle" aria-hidden="true">

  </div>

    <script>
    function createCategory(){
      $.ajax({
        type : 'get',
        url : "{{ URL::route('rajal/master/category/radiologi.create') }}",
        success : function(data){
          var div = document.createElement('div');
          div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
          div.innerHTML = data;
          $('#modalScrollable').html(div);
          $('#modalScrollable').modal('show');
        }
      });
    }
    function editCategory(id){
      $.ajax({
        type : 'get',
        url : "{{ URL::route('rajal/master/category/radiologi.edit', '') }}/"+id,
        success : function(data){
          var div = document.createElement('div');
          div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
          div.innerHTML = data;
          $('#modalScrollable').html(div);
          $('#modalScrollable').modal('show');
        }
      });
    }
    function createDetail(){
      $.ajax({
        type : 'get',
        url : "{{ URL::route('rajal/master/detail/radiologi.create') }}",
        success : function(data){
          var div = document.createElement('div');
          div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
          div.innerHTML = data;
          $('#modalScrollable').html(div);
          $('#modalScrollable').modal('show');
        }
      });
    }
    function editMasterRadiologi(id){
      $.ajax({
        type : 'get',
        url : "{{ URL::route('rajal/master/radiologi.edit', '') }}/"+id,
        success : function(data){
          var div = document.createElement('div');
          div.className = 'modal-dialog modal-lg modal-dialog-scrollable';
          div.innerHTML = data;
          $('#modalScrollable').html(div);
          $('#modalScrollable').modal('show');
        }
      });
    }
    </script>
@endsection

