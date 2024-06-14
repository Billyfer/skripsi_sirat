<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
    $karyawans = Karyawan::with('cabang')->get();
    // dd($karyawans);
    return view('karyawans.index', compact('karyawans'));
    }


    public function create()
    {
    $branches = Branch::all();
    return view('karyawans.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'role' => 'required|in:Karyawan Pusat,Pimpinan Cabang,Karyawan Cabang',
            'cabang_id' => 'nullable|exists:branches,id',
            'email' => 'required|email|unique:karyawans,email',
            'no_wa' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:karyawans,username',
            'password' => 'required|string|min:8',
        ]);

        if ($validatedData['role'] == 'Karyawan Pusat') {
            $validatedData['cabang_id'] = null;
        }

        $validatedData['password'] = Hash::make($validatedData['password']);

        Karyawan::create($validatedData);

        return redirect()->route('karyawans.index')->with('success', 'Karyawan created successfully.');
    }

    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawans.show', compact('karyawan'));
    }

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $branches = Branch::all();
        return view('karyawans.edit', compact('karyawan', 'branches'));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'role' => 'required|in:Karyawan Pusat,Pimpinan Cabang,Karyawan Cabang',
            'cabang_id' => 'nullable|exists:branches,id',
            'email' => 'required|email|unique:karyawans,email,' . $karyawan->id,
            'no_wa' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:karyawans,username,' . $karyawan->id,
            'password' => 'nullable|string|min:8',
        ]);

        if ($validatedData['role'] == 'Karyawan Pusat') {
            $validatedData['cabang_id'] = null;
        }

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $karyawan->update($validatedData);

        return redirect()->route('karyawans.index')->with('success', 'Karyawan updated successfully.');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->route('karyawans.index')->with('success', 'Karyawan deleted successfully.');
    }
}
