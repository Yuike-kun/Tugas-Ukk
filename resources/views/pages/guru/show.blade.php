@extends('layouts.main')
@section('title', 'Detail Data ' . $guru->nama)
@section('main')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('guru.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i>
            Kembali
        </a>
    </div>
    <fieldset class="bg-white rounded-3 shadow p-4 d-flex flex-column gap-1 text-center">
        <span class="fs-2 font-bold"> Data guru {{ $guru->nama }} </span>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th class="w-25"> Email </th>
                        <td> {{ $guru->user->email }} </td>
                    </tr>
                    <tr>
                        <th class="w-25"> Nama </th>
                        <td> {{ $guru->nama }} </td>
                    </tr>
                    <tr>
                        <th class="w-25"> Foto </th>
                        <td> <img src="{{ $guru->file_path }}" style="width: 400px; height: auto"
                                class="img-fluid rounded-2" alt="" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end gap-4">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit-{{ $guru->id }}">
                <i class="bx bx-edit"></i>
            </button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete-{{ $guru->id }}">
                <i class="bx bx-trash-alt"></i>
            </button>
        </div>
    </fieldset>

    <div class="modal fade" id="modalEdit-{{ $guru->id }}" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
            role="document">
            <div class="modal-content">
                <form action="{{ route('guru.update', ['guru' => $guru->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Edit Data Guru {{ $guru->nama }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column gap-3">
                        <div>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required
                                autocomplete="off" value="{{ $guru->user->email }}">
                        </div>
                        <div>
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required
                                autocomplete="off" value="{{ $guru->nama }}">
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" autocomplete="off"
                                placeholder="JANGAN ISI APABILA TAK INGIN MENGUBAH">
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

    <div class="modal fade" id="modalDelete-{{ $guru->id }}" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
            role="document">
            <div class="modal-content">
                <form action="{{ route('guru.destroy', ['guru' => $guru->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Perhatian!
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column gap-3">
                        <span> Apakah Anda Yakin ingin menghapus data ini? </span>
                        <div class="form-check">
                            <input class="form-check-input" name="is_delete_user" type="checkbox" id="want_delete_user"
                                value="true" />
                            <label class="form-check-label" for="want_delete_user">Hapus Data User Yg Terkait?</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="is_delete_image" type="checkbox"
                                id="want_delete_image" value="true" />
                            <label class="form-check-label" for="want_delete_image">Hapus Gambar Yg Terkait?</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#detail"
                            aria-expanded="false" aria-controls="detail">
                            Lihat Detail <i class="bx bx-down-arrow"></i>
                        </button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                            Tidak
                        </button>
                        <button type="submit" class="btn btn-danger">Iya</button>
                    </div>
                    <div class="collapse p-4 bg-dark text-white" id="detail">
                        <span> Data yang ingin dihapus </span> <br>
                        <span> Email : {{ $guru->user->email }} </span> <br>
                        <span> Nama : {{ $guru->nama }} </span> <br>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
