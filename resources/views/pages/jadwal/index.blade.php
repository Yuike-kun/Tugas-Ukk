@extends('layouts.main')
@section('title', 'Data Jadwal')
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
                Data Jadwal
            </span>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Jadwal
                    </li>
                </ol>
            </nav>
        </header>
        <div class="d-flex justify-content-md-between justify-content-sm-center">
            <div>
                <span>
                    <b>Kelas : </b> {{ $kelas->nama }}
                    |
                    <b>Hari : </b> {{ session()->get('hari')['hari'] }}
                </span>
            </div>
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
                        <th>Mapel</th>
                        <th>Guru</th>
                        <th>Jam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwal as $i)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $i->mapel->nama }}</td>
                            <td>{{ $i->mapel->guru->nama }}</td>
                            <td>
                                {{ $i->jam_mulai . ' - ' . $i->jam_selesai . ' ' . '(' . ($i->jam_selesai - $i->jam_mulai) . ' Jam Pelajaran' . ')' }}
                            </td>
                            <td>
                                <div class="input-group">
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
                                    <form action="{{ route('jadwal.update', ['jadwal' => $i->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">
                                                Update Data Jadwal
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-3">
                                            <div>
                                                <label for="mapel">Mapel</label>
                                                <select name="id_mapel" id="mapel" class="form-control form-select">
                                                    <option disabled selected> --Pilih Mapel-- </option>
                                                    @foreach ($mapel as $m)
                                                        <option value="{{ $m->id }}" @selected($m->id == $i->id_mapel)>
                                                            {{ $m->guru->nama . '(' . $m->nama . ')' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row row-cols-2">
                                                <div>
                                                    <label for="jam_mulai">Jam Mulai</label>
                                                    <select class="form-control form-select" required name="jam_mulai"
                                                        id="jam_mulai">
                                                        <option disabled selected> --Pilih Jam-- </option>
                                                        @for ($x = 1; $x <= 10; $x++)
                                                            <option value="{{ $x }}"
                                                                @selected($x == $i->jam_mulai)> {{ $x }} </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="jam_selesai">Jam Selesai</label>
                                                    <select class="form-control form-select" required name="jam_selesai"
                                                        id="jam_selesai">
                                                        <option disabled selected> --Pilih Jam-- </option>
                                                        @for ($x = 1; $x <= 10; $x++)
                                                            <option value="{{ $x }}"
                                                                @selected($x == $i->jam_selesai)> {{ $x }} </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalDelete-{{ $i->id }}" tabindex="-1"
                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
                                role="document">
                                <div class="modal-content">
                                    <form action="{{ route('jadwal.destroy', ['jadwal' => $i->id]) }}" method="post">
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
                                            <span> Mapel : {{ $i->mapel->nama }} </span> <br>
                                            <span> Nama : {{ $i->mapel->guru->nama }} </span> <br>
                                            <span> Jam Pelajaran :
                                                {{ $i->jam_mulai . ' - ' . $i->jam_selesai . ' ' . '(' . ($i->jam_selesai - $i->jam_mulai) . ' Jam Pelajaran' . ')' }}
                                            </span> <br>
                                            <span> Kelas : {{ $kelas->nama }} </span>
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
                <form action="{{ route('jadwal.storesecond') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Tambah Data Jadwal
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column gap-3">
                        <div>
                            <label for="mapel">Mapel</label>
                            <select name="id_mapel" id="mapel" class="form-control form-select">
                                <option disabled selected> --Pilih Mapel-- </option>
                                @foreach ($mapel as $m)
                                    <option value="{{ $m->id }}">
                                        {{ $m->guru->nama . '(' . $m->nama . ')' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row row-cols-2">
                            <div>
                                <label for="jam_mulai">Jam Mulai</label>
                                <select class="form-control form-select" required name="jam_mulai" id="jam_mulai">
                                    <option disabled selected> --Pilih Jam-- </option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}"> {{ $i }} </option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label for="jam_selesai">Jam Selesai</label>
                                <select class="form-control form-select" required name="jam_selesai" id="jam_selesai">
                                    <option disabled selected> --Pilih Jam-- </option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}"> {{ $i }} </option>
                                    @endfor
                                </select>
                            </div>
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
