@extends('layouts.main')
@section('title', 'Data Mapel')
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
                Data Mapel
            </span>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Mapel
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
                        <th style="width: 30%">Nama Guru</th>
                        <th style="width: 20%">Nama Mapel</th>
                        <th>Level</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mapel as $data)
                        <tr>
                            <td class="text-start"> {{ $loop->iteration }} </td>
                            <td> {{ $data->guru->nama }} </td>
                            <td> {{ $data->nama }} </td>
                            <td> {{ $data->level }} </td>
                            <td>
                                <div class="input-group justify-content-center">
                                    <a class="btn btn-sm btn-info" href="{{ route('mapel.show', ['mapel' => $data->id]) }}">
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
                                    <form action="{{ route('mapel.update', ['mapel' => $data->id]) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitleId">
                                                Edit Data Mapel {{ $data->nama }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column gap-3">
                                            <div>
                                                <label for="guru">Nama Guru</label>
                                                <select name="id_guru" id="guru" class="form-control">
                                                    <option> --Pilih Guru Yang Telah Ditetapkan </option>
                                                    @foreach ( DB::select('select * from gurus') as $i)
                                                    <option value="{{ $i->id }}" @selected($data->id_guru == $i->id)>
                                                        {{ $i->nama }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama" id="nama" class="form-control"
                                                    required autocomplete="off" value="{{ $data->nama }}">
                                            </div>
                                            <div>
                                                <label for="level">Level</label>
                                                <select name="level" id="level" class="form-control">
                                                    <option @selected($data->level == 'XII') value="XII">XII</option>
                                                    <option @selected($data->level == 'XI') value="XI">XI</option>
                                                    <option @selected($data->level == 'X') value="X">X</option>
                                                </select>
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
                                    <form action="{{ route('mapel.destroy', ['mapel' => $data->id]) }}" method="post">
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
                                            <span> Nama : {{ $data->nama }} </span> <br>
                                            <span> Level : {{ $data->level }} </span> <br>
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
                <form action="{{ route('mapel.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Tambah Data mapel
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column gap-3">
                        <div>
                            <label for="guru">Nama Guru</label>
                            <select name="id_guru" id="guru" class="form-control">
                                <option> --Pilih Guru Yang Telah Ditetapkan </option>
                                @foreach (DB::select('select * from gurus') as $i)
                                <option value="{{ $i->id }}">
                                    {{ $i->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                required autocomplete="off" placeholder="Bahasa Jerman">
                        </div>
                        <div>
                            <label for="level">Level</label>
                            <select name="level" id="level" class="form-control">
                                <option value="XII">XII</option>
                                <option value="XI">XI</option>
                                <option value="X">X</option>
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
