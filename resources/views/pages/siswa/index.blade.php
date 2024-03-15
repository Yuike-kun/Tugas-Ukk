@extends('layouts.main')
@section('title', 'Data Siswa')
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
                Data Siswa
            </span>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Siswa
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
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $i->nis }}</td>
                            <td>{{ $i->nama }}</td>
                            <td>{{ $i->jenis_kelamin }}</td>
                            <td>{{ $i->kelas->nama }}</td>
                            <td>
                                <div class="input-group">
                                    <a class="btn btn-sm btn-info" href="{{ route('siswa.show', ['siswa' => $i->id]) }}">
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
                                    <form action="{{ route('siswa.update', ['siswa' => $i->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">
                                                Edit Data Siswa {{ $i->nama }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-3">
                                            <div>
                                                <label for="nis">NIS Siswa</label>
                                                <input type="text" name="nis" id="nis" class="form-control"
                                                    required autocomplete="off" value="{{ $i->nis }}">
                                            </div>
                                            <div>
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama" id="nama" class="form-control"
                                                    required autocomplete="off" value="{{ $i->nama }}">
                                            </div>
                                            <div>
                                                <label for="jk">Jenis Kelamin</label>
                                                <select name="jenis_kelamin" id="jk" class="form-control"
                                                    required>
                                                    <option selected disabled>
                                                        --Pilih Jenis Kelamin Siswa--
                                                    </option>
                                                    <option value="L"
                                                        {{ $i->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki - Laki
                                                    </option>
                                                    <option value="P"
                                                        {{ $i->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                                                    </option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="kelas">Kelas</label>
                                                <select name="kelas" id="kelas" class="form-control" required>
                                                    <option selected disabled>
                                                        --Pilih Kelas Siswa--
                                                    </option>
                                                    @foreach (DB::select('select * from kelas') as $kelas)
                                                        <option value="{{ $kelas->id }}" @selected($i->id_kelas == $kelas->id)>
                                                            {{ $kelas->nama }}
                                                        </option>
                                                    @endforeach
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
                                    <form action="{{ route('siswa.destroy', ['siswa' => $i->id]) }}" method="post">
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
                                            <span> NIS : {{ $i->nis }} </span> <br>
                                            <span> Nama : {{ $i->nama }} </span> <br>
                                            <span> Jenis Kelamin :
                                                {{ $i->jenis_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }} </span> <br>
                                            <span> Kelas : {{ $i->kelas->nama }} </span>
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
                <form action="{{ route('siswa.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Tambah Data Siswa
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column gap-3">
                        <div>
                            <label for="nis">NIS Siswa</label>
                            <input type="text" name="nis" id="nis" class="form-control" required
                                autocomplete="off">
                        </div>
                        <div>
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required
                                autocomplete="off">
                        </div>
                        <div>
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jk" class="form-control" required>
                                <option selected disabled>
                                    --Pilih Jenis Kelamin Siswa--
                                </option>
                                <option value="L">Laki - Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control" required>
                                <option selected disabled>
                                    --Pilih Kelas Siswa--
                                </option>
                                @foreach (DB::select('select * from kelas') as $kelas)
                                    <option value="{{ $kelas->id }}">
                                        {{ $kelas->nama }}
                                    </option>
                                @endforeach
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
