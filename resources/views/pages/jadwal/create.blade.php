@extends('layouts.main')
@section('title', 'Memilih Hari dan kelas...')
@section('main')
<form action="{{ route('jadwal.store') }}" method="post">
    @csrf
    <fieldset class="bg-white p-4 rounded-2 shadow d-flex flex-column gap-1">
        <div class="row row-cols-1">
            <label for="kelas">Kelas</label>
            <select name="id_kelas" id="kelas" class="form-control">
                <option disabled selected>
                    --Pilih Kelas--
                </option>
                @foreach (DB::select('select * from kelas') as $kelas)
                    <option value="{{ $kelas->id }}">
                        {{ $kelas->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="row row-cols-1">
            <label for="hari">Hari</label>
            <select name="hari" id="hari" class="form-control">
                <option disabled selected>
                    --Pilih Hari--
                </option>
                <option value="senin">Senin</option>
                <option value="selasa">Selasa</option>
                <option value="rabu">Rabu</option>
                <option value="kamis">Kamis</option>
                <option value="jumat">Jum'at</option>
            </select>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-success"> Kirim </button>
        </div>
    </fieldset>
</form>
@endsection