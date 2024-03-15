@extends('layouts.main')
@section('title', 'Detail Data ' . $user->username)
@section('main')
{{-- tambahkan fungsi edit dan hapus --}}
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('user.index') }}" class="btn btn-secondary">
        <i class="bx bx-arrow-back"></i>
        Kembali
    </a>
</div>
<fieldset class="bg-white rounded-3 shadow p-4 d-flex flex-column gap-1 text-center">
    <span class="fs-2 font-bold"> Data User {{ $user->username }} </span>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <th class="w-25"> Email </th>
                    <td> {{ $user->email }} </td>
                </tr>
                <tr>
                    <th class="w-25"> Username </th>
                    <td> {{ $user->username }} </td>
                </tr>
                <tr>
                    <th class="w-25"> Role </th>
                    <td> {{ $user->role }} </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end gap-4">
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit-{{ $user->id }}">
            <i class="bx bx-edit"></i>
        </button>
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete-{{ $user->id }}">
            <i class="bx bx-trash-alt"></i>
        </button>
    </div>
</fieldset>

<div class="modal fade" id="modalEdit-{{ $user->id }}" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
        role="document">
        <div class="modal-content">
            <form action="{{ route('user.update', ['user' => $user->id]) }}" method="post">
                @csrf
                @method('put')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Edit Data User {{ $user->username }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-3">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            required autocomplete="off" value="{{ $user->email }}">
                    </div>
                    <div>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            required autocomplete="off" value="{{ $user->username }}">
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
                            <option @selected($user->role == 'admin') value="admin">Admin</option>
                            <option @selected($user->role == 'guru') value="guru">Guru</option>
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

<div class="modal fade" id="modalDelete-{{ $user->id }}" tabindex="-1"
    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
        role="document">
        <div class="modal-content">
            <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="post">
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
                    <span> Email : {{ $user->email }} </span> <br>
                    <span> Username : {{ $user->username }} </span> <br>
                    <span> Role : {{ $user->role }} </span> <br>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
