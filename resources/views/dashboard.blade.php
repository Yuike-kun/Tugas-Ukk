@extends('layouts.main')
@section('title', 'Dashboard')
@section('main')
<div class="    row row-cols-1 row-cols-md-3 row-cols-lg-4 gap-4 justify-content-center align-items-center">
    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h4 class="card-title">Jumlah User</h4>
                <p class="card-text">{{ App\Models\User::get('username')->count() }}</p>
            </div>
            <div class="bg-black text-white rounded-circle d-flex justify-content-center align-items-center p-3">
                <i class="bx bx-user"></i>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h4 class="card-title">Jumlah Mapel</h4>
                <p class="card-text">{{ App\Models\Mapel::get('nama')->count() }}</p>
            </div>
            <div class="bg-black text-white rounded-circle d-flex justify-content-center align-items-center p-3">
                <i class="bx bx-book"></i>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Jumlah Siswa</h4>
            <p class="card-text">{{ App\Models\Siswa::get('nama')->count() }}</p>
        </div>
    </div>
</div>
@endsection
