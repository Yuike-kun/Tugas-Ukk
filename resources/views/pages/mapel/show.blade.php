@extends('layouts.main')
@section('title', 'Detail Data ' . $mapel->nama)
@section('main')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('mapel.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i>
            Kembali
        </a>
    </div>
    <fieldset class="bg-white rounded-3 shadow p-4 d-flex flex-column gap-1 text-center">
        <span class="fs-2 font-bold"> Data mapel {{ $mapel->nama }} </span>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th class="w-25"> Nama Guru </th>
                        <td> {{ $mapel->guru->nama }} </td>
                    </tr>
                    <tr>
                        <th class="w-25"> Nama Mapel </th>
                        <td> {{ $mapel->nama }} </td>
                    </tr>
                    <tr>
                        <th class="w-25"> Level </th>
                        <td> {{ $mapel->level }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end gap-4">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit-{{ $mapel->id }}">
                <i class="bx bx-edit"></i>
            </button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete-{{ $mapel->id }}">
                <i class="bx bx-trash-alt"></i>
            </button>
        </div>
    </fieldset>

    <div class="modal fade" id="modalEdit-{{ $mapel->id }}" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
            role="document">
            <div class="modal-content">
                <form action="{{ route('mapel.update', ['mapel' => $mapel->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Edit Data Mapel {{ $mapel->nama }}
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
                                <option value="{{ $i->id }}" @selected($mapel->id_guru == $i->id)>
                                    {{ $i->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                required autocomplete="off" value="{{ $mapel->nama }}">
                        </div>
                        <div>
                            <label for="level">Level</label>
                            <select name="level" id="level" class="form-control">
                                <option @selected($mapel->level == 'XII') value="XII">XII</option>
                                <option @selected($mapel->level == 'XI') value="XI">XI</option>
                                <option @selected($mapel->level == 'X') value="X">X</option>
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

    <div class="modal fade" id="modalDelete-{{ $mapel->id }}" tabindex="-1"
        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg modal-fullscreen-md-down"
            role="document">
            <div class="modal-content">
                <form action="{{ route('mapel.destroy', ['mapel' => $mapel->id]) }}" method="post">
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
                        <span> Nama : {{ $mapel->nama }} </span> <br>
                        <span> Level : {{ $mapel->level }} </span> <br>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
