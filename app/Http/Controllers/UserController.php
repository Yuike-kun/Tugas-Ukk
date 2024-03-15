<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view('pages.user.index', compact('user'));
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
            'username' => 'required',
            'password' => 'required|min:8',
            'role' => 'required|in:guru,admin'
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid);
        }

        
        $valid->validated();
        // dd($valid->safe()->all());
        User::create($valid->safe()->all());
        return to_route('user.index')->with('success', 'Data User Telah Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        return view('pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $valid = Validator::make($request->all(), [
            'email' => 'required|email',
            'username' => 'required',
            'role' => 'required|in:guru,admin',
            'password' => [
                Rule::requiredIf($request->password)
            ]
        ]);

        if ($valid->fails()) {
            return back()->withErrors($valid);
        }

        $valid->validated();
        if ($request->password) {
            User::where('id', $id)->update($valid->safe()->all());
            return to_route('user.index')->with('success', 'Data User Berhasil Diperbaharui');
        }
        User::where('id', $id)->update($valid->safe()->except('password'));
        return to_route('user.index')->with('success', 'Data User Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return to_route('user.index')->with('success', 'Data User Berhasil Dimusnahkan');
    }
}
