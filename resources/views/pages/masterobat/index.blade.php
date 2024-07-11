@extends('layouts.backend.main')

@section('content')

@if (session()->has('success'))
      <div class="alert alert-success w-100 border mb-5 d-flex justify-content-center position-absolute" style="z-index:99; max-width:max-content;;left: 50%;transform: translate(-50%, -50%);" role="alert">
        {{ session('success') }}
      </div>
  @endif
  <div class="card">
    <div class="card-body">
      <div class="nav-align-top mb-2 shadow-sm">
        <ul class="nav nav-tabs nav-sm nav-fill" role="tablist">
          <li class="nav-item">
            <button id="btn-link" type="button" class="nav-link {{ session('navOn') == 'listObat' ? 'active' : '' }} d-flex justify-content-center"
            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-listObat"
            aria-controls="navs-justified-listObat" aria-selected="false">
            <p class="m-0">Daftar Obat</p>
            </button>
          </li>
          <li class="nav-item">
            <button id="btn-link" type="button" class="nav-link {{ session('navOn') == 'jenisObat' ? 'active' : '' }} d-flex justify-content-center"
            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-jenisObat"
            aria-controls="navs-justified-jenisObat" aria-selected="false">
            <p class="m-0">Jenis Obat</p>
            </button>
          </li>
          <li class="nav-item">
            <button id="btn-link" type="button" class="nav-link {{ session('navOn') == 'golObat' ? 'active' : '' }} d-flex justify-content-center"
            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-golObat"
            aria-controls="navs-justified-golObat" aria-selected="false">
            <p class="m-0">Golongan Obat</p>
            </button>
          </li>
          <li class="nav-item">
            <button id="btn-link" type="button" class="nav-link {{ session('navOn') == 'bentukObat' ? 'active' : '' }} d-flex justify-content-center"
            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-bentukObat"
            aria-controls="navs-justified-bentukObat" aria-selected="false">
            <p class="m-0">Bentuk Sediaan Obat</p>
            </button>
          </li>
          <li class="nav-item">
            <button id="btn-link" type="button" class="nav-link {{ session('navOn') == 'pabrik' ? 'active' : '' }} d-flex justify-content-center"
            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-pabrik"
            aria-controls="navs-justified-pabrik" aria-selected="false">
            <p class="m-0">Pabrik</p>
            </button>
          </li>
          <li class="nav-item">
            <button id="btn-link" type="button" class="nav-link {{ session('navOn') == 'supplier' ? 'active' : '' }} d-flex justify-content-center"
            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-supplier"
            aria-controls="navs-justified-supplier" aria-selected="false">
            <p class="m-0">Supplier</p>
            </button>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade {{ session('navOn') == 'listObat' ? 'show active' : '' }}" id="navs-justified-listObat" role="tabpanel">
            <div class="text-end mb-3">
              <a href="{{ route('farmasi/obat.create') }}" class="btn btn-success ms-auto btn-sm m-0">+ Master Obat</a>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table" id="example">
                <thead>
                  <tr class="text-nowrap bg-dark">
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Sediaan</th>
                    <th>Golongan</th>
                    <th>Satuan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $item) 
                    <tr>
                      <th scope="row" class="text-dark">{{ $loop->iteration }}</th>
                      <td>{{ $item->kode }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->medicineType->name }}</td>
                      <td>{{ $item->medicineForm->name ?? '-' }}</td>
                      <td>{{ $item->medicineCategory->name }}</td>
                      <td>{{ $item->small_unit ?? '-' }}</td>
                      <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('farmasi/obat.edit', $item->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('farmasi/obat.destroy', $item->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                            class="bx bx-trash me-1"></i>Hapus</button>
                                </form>
                            </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade {{ session('navOn') == 'jenisObat' ? 'show active' : '' }}" id="navs-justified-jenisObat" role="tabpanel">
            <div class="text-end mb-3">
                <a href="{{ route('farmasi/obat/jenis.create') }}" class="btn btn-success ms-auto btn-sm m-0">+ Jenis Obat</a>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead>
                  <tr class="text-nowrap bg-dark">
                    <th>No</th>
                    <th>Nama Jenis Obat</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($dataJenis as $item)
                    <tr>
                      <th scope="row" class="text-dark">{{ $loop->iteration }}</th>
                      <td>{{ $item->name }}</td>
                      <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('farmasi/obat/jenis.edit', $item->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('farmasi/obat/jenis.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                            class="bx bx-trash me-1"></i>Hapus</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade {{ session('navOn') == 'golObat' ? 'show active' : '' }}" id="navs-justified-golObat" role="tabpanel">
            <div class="text-end mb-3">
                <a href="{{ route('farmasi/obat/golongan.create') }}" class="btn btn-success ms-auto btn-sm m-0">+ Golongan Obat</a>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead>
                  <tr class="text-nowrap bg-dark">
                    <th>No</th>
                    <th>Nama Golongan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($dataGol as $item)
                    <tr>
                      <th scope="row" class="text-dark">{{ $loop->iteration }}</th>
                      <td>{{ $item->name }}</td>
                      <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('farmasi/obat/golongan.edit', $item->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('farmasi/obat/golongan.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                            class="bx bx-trash me-1"></i>Hapus</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>>
          </div>
          <div class="tab-pane fade {{ session('navOn') == 'bentukObat' ? 'show active' : '' }}" id="navs-justified-bentukObat" role="tabpanel">
            <div class="text-end mb-3">
              <a href="{{ route('farmasi/obat/bentuk.create') }}" class="btn btn-success ms-auto btn-sm m-0">+ Bentuk Sediaan Obat</a>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table" id="example2">
                <thead>
                  <tr class="text-nowrap bg-dark">
                    <th>No</th>
                    <th>Nama Bentuk Sediaan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($dataBentuk as $item)
                    <tr>
                      <th scope="row" class="text-dark">{{ $loop->iteration }}</th>
                      <td>{{ $item->name }}</td>
                      <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('farmasi/obat/bentuk.edit', $item->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('farmasi/obat/bentuk.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                            class="bx bx-trash me-1"></i>Hapus</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade {{ session('navOn') == 'pabrik' ? 'show active' : '' }}" id="navs-justified-pabrik" role="tabpanel">
            <div class="text-end mb-3">
              <a href="{{ route('farmasi/pabrik.create') }}" class="btn btn-success ms-auto btn-sm m-0 ">+ Pabrik</a>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead>
                  <tr class="text-nowrap bg-dark">
                    <th>No</th>
                    <th>Nama Pabrik</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($dataPabrik as $item)
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $item->name }}</td>
                      <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('farmasi/pabrik.edit', $item->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('farmasi/pabrik.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                            class="bx bx-trash me-1"></i>Hapus</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade {{ session('navOn') == 'supplier' ? 'show active' : '' }}" id="navs-justified-supplier" role="tabpanel">
            <div class="text-end mb-3">
              <a href="{{ route('farmasi/supplier.create') }}" class="btn btn-success ms-auto btn-sm m-0 mx-3">+ Tambah Supplier</a>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead>
                  <tr class="text-nowrap bg-dark">
                    <th>No</th>
                    <th>Nama Supplier</th>
                    <th>Alamat</th>
                    <th>Kontak Supplier</th>
                    <th>Contact Person Name</th>
                    <th>Contact Person Phone</th>
                    <th>NPWP</th>
                    <th>No Izin</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($dataSupplier as $item)
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->alamat }}</td>
                      <td>{{ $item->telp }}</td>
                      <td>{{ $item->contact_person_name }}</td>
                      <td>{{ $item->contact_person_phone }}</td>
                      <td>{{ $item->npwp }}</td>
                      <td>{{ $item->no_izin }}</td>
                      <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('farmasi/supplier.edit', $item->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('farmasi/supplier.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                            class="bx bx-trash me-1"></i>Hapus</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection