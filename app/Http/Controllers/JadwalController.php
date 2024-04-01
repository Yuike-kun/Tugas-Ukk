<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::with(['kelas','mapel'])
        ->where('id_kelas', session()->get('id_kelas'))
        ->where('hari', session()->get('hari'))
        ->get();
        $kelas = Kelas::where('id', session()->get('id_kelas'))->first();
        $mapel = Mapel::with(['guru'])->get();
        return view('pages.jadwal.index', compact('jadwal','kelas','mapel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $valid = Validator::make($request->all(), [
            'id_kelas' => 'required|numeric',
            'hari' => 'required|string|min:4',
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid);
        }
        $valid->validated();

        session([
            'id_kelas' => $valid->safe()->only('id_kelas'),
            'hari' => $valid->safe()->only('hari')
        ]);

        return to_route('jadwal.index');
    }

    public function store_second(Request $request) : RedirectResponse 
    {
        $valid = Validator::make($request->all(), [
            'id_mapel' => 'required|numeric',
            'jam_mulai' => 'required|numeric',
            'jam_selesai' => 'required|numeric',
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid);
        }
        $valid->validated();

        Jadwal::create([
            'id_kelas' => session()->get('id_kelas')['id_kelas'],
            'id_mapel' => $request->id_mapel,
            'hari' => session()->get('hari')['hari'],
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai
        ]);

        return to_route('jadwal.index')->with('success', 'Data Jadwal Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
    //   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage. your mom gay
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $valid = Validator::make($request->all(), [
            'id_mapel' => 'required|numeric',
            'jam_mulai' => 'required|numeric',
            'jam_selesai' => 'required|numeric',
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid);
        }
        $valid->validated();

        $jadwal->update([
            'id_mapel' => $request->id_mapel,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai
        ]);

        return to_route('jadwal.index')->with('success', 'Data Jadwal Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->deleteOrFail();
        return to_route('jadwal.index')->with('success', 'Data Jadwal Telah Dimusnahkan');
    }
}
