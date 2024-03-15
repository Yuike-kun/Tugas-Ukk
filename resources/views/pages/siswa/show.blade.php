@extends('layouts.main')
@section('title', 'Detail Data ' . $siswa->nama)
@section('main')
{{-- tambahkan fungsi edit dan hapus --}}
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('siswa.index') }}" class="btn btn-secondary">
        <i class="bx bx-arrow-back"></i>
        Kembali
    </a>
</div>
<fieldset class="bg-white rounded-3 shadow p-4 d-flex flex-column gap-1 text-center">
    <span class="fs-2 font-bold"> Data Siswa {{ $siswa->nama }} </span>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th class="w-25"> NIS </th>
                    <td> {{ $siswa->nis }} </td>
                </tr>
                <tr>
                    <th class="w-25"> Nama </th>
                    <td> {{ $siswa->nama }} </td>
                </tr>
                <tr>
                    <th class="w-25"> Kelas </th>
                    <td> {{ $siswa->kelas->nama }} </td>
                </tr>
                <tr>
                    <th class="w-25"> Jenis Kelamin </th>
                    <td> {{ $siswa->jenis_kelamin == "L" ? "Laki Laki" : "Perempuan" }} </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end gap-4">
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit-{{ $siswa->id }}">
            <i class="bx bx-edit"></i>
        </button>
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete-{{ $siswa->id }}">
            <i class="bx bx-trash-alt"></i>
        </button>
    </div>
</fieldset>

<div class="modal fade" id="modalEdit-{{ $siswa->id }}" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
        role="document">
        <div class="modal-content">
            <form action="{{ route('siswa.update', ['siswa' => $siswa->id]) }}" method="post">
                @csrf
                @method('put')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Edit Data Siswa {{ $siswa->nama }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-3">
                    <div>
                        <label for="nis">NIS Siswa</label>
                        <input type="text" name="nis" id="nis" class="form-control"
                            required autocomplete="off" value="{{ $siswa->nis }}">
                    </div>
                    <div>
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                            required autocomplete="off" value="{{ $siswa->nama }}">
                    </div>
                    <div>
                        <label for="jk">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jk" class="form-control"
                            required>
                            <option selected disabled>
                                --Pilih Jenis Kelamin Siswa--
                            </option>
                            <option value="L"
                                {{ $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki - Laki
                            </option>
                            <option value="P"
                                {{ $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
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
                                <option value="{{ $kelas->id }}" @selected($siswa->id_kelas == $kelas->id)>
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

<div class="modal fade" id="modalDelete-{{ $siswa->id }}" tabindex="-1"
    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
        role="document">
        <div class="modal-content">
            <form action="{{ route('siswa.destroy', ['siswa' => $siswa->id]) }}" method="post">
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
                    <span> NIS : {{ $siswa->nis }} </span> <br>
                    <span> Nama : {{ $siswa->nama }} </span> <br>
                    <span> Jenis Kelamin :
                        {{ $siswa->jenis_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }} </span> <br>
                    <span> Kelas : {{ $siswa->kelas->nama }} </span>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
