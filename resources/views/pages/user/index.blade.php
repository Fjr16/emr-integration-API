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
            <button id="btn-link" type="button" class="nav-link {{ session('navUser') == 'dokter' ? 'active' : '' }} d-flex justify-content-center"
            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-dokter"
            aria-controls="navs-justified-dokter" aria-selected="false">
            <p class="m-0">Dokter</p>
            </button>
          </li>
          <li class="nav-item">
            <button id="btn-link" type="button" class="nav-link {{ session('navUser') == 'all' ? 'active' : '' }} d-flex justify-content-center"
            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-all"
            aria-controls="navs-justified-all" aria-selected="false">
            <p class="m-0">Tenaga Medis / Kesehatan (Bukan Dokter)</p>
            </button>
          </li>
          <li class="nav-item">
            <button id="btn-link" type="button" class="nav-link {{ session('navUser') == 'role' ? 'active' : '' }} d-flex justify-content-center"
            role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-role"
            aria-controls="navs-justified-role" aria-selected="false">
            <p class="m-0">Role</p>
            </button>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade {{ session('navUser') == 'all' ? 'show active' : '' }}" id="navs-justified-all" role="tabpanel">
            <div class="text-end mb-3">
              <a href="{{ route('user.create') }}" class="btn btn-success ms-auto btn-sm m-0">+ Tambah Staff</a>
            </div>
            <div class="table-responsive">
              <table class="table text-nowrap" id="example">
                <thead>
                  <tr class="bg-dark">
                    <th>Nama</th>
                    <th>Staff Id</th>
                    <th>NIK</th>
                    <th>Jenis Kelamin</th>
                    <th>Unit / Departemen</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $item) 
                    <tr>
                      <td>{{ $item->name ?? '' }}</td>
                      <td>{{ $item->staff_id ?? '' }}</td>
                      <td>{{ $item->nik ?? '' }}</td>
                      <td>{{ $item->gender ?? '' }}</td>
                      <td>{{ $item->unit->name ?? '' }}</td>
                      <td>{{ $item->email ?? '' }}</td>
                      <td>{{ $item->roles->first()->name ?? '' }}</td>
                      <td>{{ $item->status ?? '' }}</td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                              data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('user.edit', $item->id) }}">
                                  <i class="bx bx-edit-alt me-1"></i>
                                  Edit
                              </a>
                              <form action="{{ route('user.destroy', $item->id) }}" method="POST">
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
          <div class="tab-pane fade {{ session('navUser') == 'dokter' ? 'show active' : '' }}" id="navs-justified-dokter" role="tabpanel">
            <div class="text-end mb-3">
                <a href="{{ route('user.create') }}" class="btn btn-success ms-auto btn-sm m-0">+ Tambah Staff</a>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table text-nowrap" id="example2">
                <thead>
                  <tr class="bg-dark">
                    <th>Nama</th>
                    <th>Staff Id</th>
                    <th>NIK</th>
                    <th>Jenis Kelamin</th>
                    <th>Unit / Departemen</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($dataDokter as $item) 
                  <tr>
                    <td>{{ $item->name ?? '' }}</td>
                    <td>{{ $item->staff_id ?? '' }}</td>
                    <td>{{ $item->nik ?? '' }}</td>
                    <td>{{ $item->gender ?? '' }}</td>
                    <td>{{ $item->unit->name ?? '' }}</td>
                    <td>{{ $item->email ?? '' }}</td>
                    <td>{{ $item->roles->first()->name ?? '' }}</td>
                    <td>{{ $item->status ?? '' }}</td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                            data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('user.edit', $item->id) }}">
                                <i class="bx bx-edit-alt me-1"></i>
                                Edit
                            </a>
                            <form action="{{ route('user.destroy', $item->id) }}" method="POST">
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
          <div class="tab-pane fade {{ session('navUser') == 'role' ? 'show active' : '' }}" id="navs-justified-role" role="tabpanel">
            <div class="text-end mb-3">
              <a href="{{ route('user/role.create') }}" class="btn btn-success btn-sm">Tambah Role</a>
            </div>
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead>
                  <tr class="text-nowrap bg-dark">
                    <th>No</th>
                    <th>Nama Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($dataRole as $item)
                  <tr>
                    <th scope="row" class="text-body">{{ $loop->iteration }}</th>
                    <td>{{ $item->name }}</td>
                    <td class="d-flex">
                      <a href="{{ route('user/role.edit', $item->id) }}" class="btn btn-warning btn-sm mx-2"><i class="bx bx-edit me-2"></i>Edit</a>
                      <form action="{{ route('user/role.destroy', $item->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm"
                              onclick="return confirm('Yakin ingin menghapus data?')"><i
                                  class="bx bx-trash me-2"></i>Hapus</button>
                      </form>
                  </td>
                  </tr>
                  @endforeach
                  </tbody>
              </table>
            </div>>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection