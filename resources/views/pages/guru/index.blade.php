@extends('layouts.main')
@section('title', 'Data Guru')
@section('main')
    <fieldset class="bg-white p-4 rounded-2 shadow d-flex flex-column gap-1">
        @session('success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ $value }}
            </div>
        @endsession
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <ol>
                    @foreach ($errors->all() as $error)
                        <li class="p-0">
                            {{ $error }}
                        </li>
                    @endforeach
                </ol>
            </div>
        @endif
        <header class="d-flex justify-content-between align-items-center">
            <span class="fs-2 fw-bold">
                Data Guru
            </span>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Guru
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
            <table class="table table-bordered table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th class="text-start">No</th>
                        <th>Email</th>
                        <th style="width: 30%">Nama</th>
                        <th class="w-25">Foto</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guru as $data)
                        <tr>
                            <td class="text-start"> {{ $loop->iteration }} </td>
                            <td> {{ $data->user->email }} </td>
                            <td> {{ $data->nama }} </td>
                            <td>
                                <img src="{{ $data->file_path }}" class="img-fluid rounded-2" alt="" />
                            </td>
                            <td>
                                <div class="input-group justify-content-center">
                                    <a class="btn btn-sm btn-info" href="{{ route('guru.show', ['guru' => $data->id]) }}">
                                        <i class="bx bx-info-circle"></i>
                                    </a>
                                    <button class="btn btn-sm btn-warning" data-bs-target="#modalEdit-{{ $data->id }}"
                                        data-bs-toggle="modal">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-target="#modalDelete-{{ $data->id }}"
                                        data-bs-toggle="modal">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalEdit-{{ $data->id }}" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
                                role="document">
                                <div class="modal-content">
                                    <form action="{{ route('guru.update', ['guru' => $data->id]) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">
                                                Edit Data Guru {{ $data->nama }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-3">
                                            <div>
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    required autocomplete="off" value="{{ $data->user->email }}">
                                            </div>
                                            <div>
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama" id="nama" class="form-control"
                                                    required autocomplete="off" value="{{ $data->nama }}">
                                            </div>
                                            <div>
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control"
                                                    autocomplete="off" placeholder="JANGAN ISI APABILA TAK INGIN MENGUBAH">
                                            </div>
                                            <div>
                                                <label for="file">File Gambar</label>
                                                <input type="file" name="file_path" id="file" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="submit" class="btn btn-warning">Perbarui</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalDelete-{{ $data->id }}" tabindex="-1"
                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                            aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
                                role="document">
                                <div class="modal-content">
                                    <form action="{{ route('guru.destroy', ['guru' => $data->id]) }}" method="post">
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
                                            <div class="form-check">
                                                <input class="form-check-input" name="is_delete_user" type="checkbox" id="want_delete_user" value="true" />
                                                <label class="form-check-label" for="want_delete_user">Hapus Data User Yg Terkait?</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="is_delete_image" type="checkbox" id="want_delete_image" value="true" />
                                                <label class="form-check-label" for="want_delete_image">Hapus Gambar Yg Terkait?</label>
                                            </div>
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
                                            <span> Email : {{ $data->user->email }} </span> <br>
                                            <span> Nama : {{ $data->nama }} </span> <br>
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

    <div class="modal fade" id="modalCreate" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
            role="document">
            <div class="modal-content">
                <form action="{{ route('guru.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Tambah Data Guru
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
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required
                                autocomplete="off">
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required
                                autocomplete="off">
                        </div>
                        <div>
                            <label for="file">File Gambar</label>
                            <input type="file" name="file_path" id="file" class="form-control" required>
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
