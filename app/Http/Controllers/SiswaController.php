<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Siswa::with('kelas')->get();
        return view('pages.siswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'nis' => 'required|min:6',
            'nama' => 'required|min:3',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas' => 'required|numeric'
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid->errors());
        }

        $valid->validated();
        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_kelas' => $request->kelas
        ]);

        return to_route('siswa.index')->with('success','Data Sukses Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        $siswa = $siswa->with('kelas')->firstOrFail();
        return view('pages.siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $valid = Validator::make($request->all(), [
            'nis' => 'required|min:6',
            'nama' => 'required|min:3',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas' => 'required|numeric'
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid);
        }

        $valid->validated();
        $siswa->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_kelas' => $request->kelas
        ]);

        return to_route('siswa.index')->with('success','Data Sukses Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return to_route('siswa.index')->with('success', 'Data Berhasil Dimusnahkan');
    }
}
