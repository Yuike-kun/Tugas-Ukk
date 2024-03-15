@extends('layouts.main')
@section('title', 'Data User')
@section('main')
    <fieldset class="bg-white p-4 rounded-2 shadow d-flex flex-column gap-1">
        @session('success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ $value }}
            </div>
        @endsession
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                @foreach ($errors->all() as $error)
                    <ul class="m-0">
                        <li> {{ $error }} </li>
                    </ul>
                @endforeach
            </div>
        @endif


        <header class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Data User
            </span>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Users
                    </li>
                </ol>
            </nav>
        </header>
        <div class="d-flex justify-content-md-end justify-content-sm-center">
            <button class="btn btn-primary btn-block" data-bs-target="#modalCreate" data-bs-toggle="modal">
                <i class="bx bx-plus"></i>
                Tambah
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $i->email }}</td>
                            <td>{{ $i->username }}</td>
                            <td>{{ $i->role }}</td>
                            <td>
                                <div class="input-group">
                                    <a class="btn btn-sm btn-info" href="{{ route('user.show', ['user' => $i->id]) }}">
                                        <i class="bx bx-info-circle"></i>
                                    </a>
                                    <button class="btn btn-sm btn-warning" data-bs-target="#modalEdit-{{ $i->id }}"
                                        data-bs-toggle="modal">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-target="#modalDelete-{{ $i->id }}"
                                        data-bs-toggle="modal">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalEdit-{{ $i->id }}" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
                                role="document">
                                <div class="modal-content">
                                    <form action="{{ route('user.update', ['user' => $i->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">
                                                Edit Data User {{ $i->username }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-3">
                                            <div>
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    required autocomplete="off" value="{{ $i->email }}">
                                            </div>
                                            <div>
                                                <label for="username">Username</label>
                                                <input type="text" name="username" id="username" class="form-control"
                                                    required autocomplete="off" value="{{ $i->username }}">
                                            </div>
                                            <div>
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control"
                                                    autocomplete="off"
                                                    placeholder="Kosongkan Apabila Tak ingin Mengubah Password">
                                            </div>
                                            <div>
                                                <label for="role">Role</label>
                                                <select name="role" id="role" class="form-control" required>
                                                    <option selected disabled>
                                                        --Pilih Hak Akses User--
                                                    </option>
                                                    <option @selected($i->role == 'admin') value="admin">Admin</option>
                                                    <option @selected($i->role == 'guru') value="guru">Guru</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="submit" class="btn btn-success">Ubah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalDelete-{{ $i->id }}" tabindex="-1"
                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                            aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
                                role="document">
                                <div class="modal-content">
                                    <form action="{{ route('user.destroy', ['user' => $i->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">
                                                Perhatian!
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-3">
                                            <span> Apakah Anda Yakin ingin menghapus data ini? </span>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#detail" aria-expanded="false" aria-controls="detail">
                                                Lihat Detail <i class="bx bx-down-arrow"></i>
                                            </button>
                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                                                Tidak
                                            </button>
                                            <button type="submit" class="btn btn-danger">Iya</button>
                                        </div>
                                        <div class="collapse p-4 bg-dark text-white" id="detail">
                                            <span> Data yang ingin dihapus </span> <br>
                                            <span> Email : {{ $i->email }} </span> <br>
                                            <span> Username : {{ $i->username }} </span> <br>
                                            <span> Role : {{ $i->role }} </span> <br>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </fieldset>

    <!-- Modal Body -->
    <div class="modal fade" id="modalCreate" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
            role="document">
            <div class="modal-content">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Tambah Data User
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column gap-3">
                        <div>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required
                                autocomplete="off">
                        </div>
                        <div>
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required
                                autocomplete="off">
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required
                                autocomplete="off">
                        </div>
                        <div>
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option selected disabled>
                                    --Pilih Hak Akses User--
                                </option>
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/dataTables/datatables.min.js') }}"></script>

    <script>
        new DataTable('#dataTable');
    </script>
@endsection
