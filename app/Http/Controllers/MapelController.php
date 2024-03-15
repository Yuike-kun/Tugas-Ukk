<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = Mapel::with(['guru'])->get();
        return view('pages.mapel.index', compact('mapel'));
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
            'id_guru' => 'required|numeric',
            'nama' => 'required|string',
            'level' => 'required|in:XII,XI,X',
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid);
        }

        $valid->validated();
        Mapel::create($valid->safe()->all());
        
        return to_route('mapel.index')->with('success', 'Data Mapel Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapel $mapel)
    {
        $mapel = $mapel->with(['guru'])->firstOrFail();
        return view('pages.mapel.show',compact('mapel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mapel $mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapel $mapel)
    {
        $valid = Validator::make($request->all(), [
            'id_guru' => 'required|numeric',
            'nama' => 'required|string',
            'level' => 'required|in:XII,XI,X'
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid);
        }

        $valid->validated();
        $mapel->update($valid->safe());
        
        return to_route('mapel.index')->with('success', 'Data Mapel Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return to_route('mapel.index')->with('success', 'Data Mapel Berhasil Dimusnahkan');
    }
}
