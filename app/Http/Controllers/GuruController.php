<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::with(['user'])->get();
        return view('pages.guru.index', compact('guru'));
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'nama' => 'required',
            'file_path' => 'file|image|max:2048|mimes:png,jpg,jpeg'
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid);
        }

        $valid->validated();

        $file = $request->file_path;
        Storage::disk('local')->put('public/guru/images/' . $file->hashName(), file_get_contents($file));
        $path = Storage::disk('local')->url('public/guru/images/' . $file->hashName());

        Guru::create([
            'nama' => $request->nama,
            'file_path' => $path,
        ]);

        session()->put('id_guru', Guru::where('nama', $request->nama)->first('id')->id);

        User::create([
            'email' => $request->email,
            'username' => $request->nama,
            'password' => $request->password,
            'role' => 'guru'
        ]);

        Guru::where('id', session()->get('id_guru'))->update([
            'id_user' => User::where('username', $request->nama)->first('id')->id
        ]);

        return to_route('guru.index')->with('success', 'Data Guru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        $guru = $guru->with(['user'])->firstOrFail();
        return view('pages.guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        $valid = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required',
            'file_path' => 'file|image|max:2048|mimes:png,jpg,jpeg'
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid);
        }

        $valid->validated();

        $guru->update([
            'nama' => $request->nama,
        ]);

        if ($request->file_path) {
            $file = $request->file_path;
            Storage::disk('local')->put('public/guru/images/' . $file->hashName(), file_get_contents($file));
            $path = Storage::disk('local')->url('public/guru/images/' . $file->hashName());
            $guru->update([
                'file_path' => $path,
            ]);
        }

        User::where('id', $guru->id_user)->update([
            'email' => $request->email,
            'username' => $request->nama
        ]);

        if ($request->password != null) {
            User::where('id', $guru->id_user)->update([
                'password' => bcrypt($request->password),
            ]);
        }

        return to_route('guru.index')->with('success', 'Data Guru Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru, Request $request)
    {
        if ($request->is_delete_user == true) {
            User::where('id', $guru->id_user)->delete();
        }
        if ($request->is_delete_image == true) {
            Storage::delete(Str::after($guru->file_path, '/storage/guru/images/'));
        }
        $guru->delete();
        return to_route('guru.index')->with('success', 'Data Guru Berhasil Dimusnahkan');
    }
}
