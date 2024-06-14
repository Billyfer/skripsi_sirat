<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_cabang' => 'required|string|max:255',
            'kota_kabupaten' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nama_pimpinan' => 'required|string|max:255',
            'nib_cabang' => 'required|string|max:255',
            'pdf_nib' => 'required|file|mimes:pdf|max:2048',
            'pdf_akta_cabang' => 'required|file|mimes:pdf|max:2048',
        ]);

        $pdfNibPath = $request->file('pdf_nib')->store('pdfs', 'public');
        $pdfAktaCabangPath = $request->file('pdf_akta_cabang')->store('pdfs', 'public');

        Branch::create([
            'nama_cabang' => $validatedData['nama_cabang'],
            'kota_kabupaten' => $validatedData['kota_kabupaten'],
            'alamat' => $validatedData['alamat'],
            'nama_pimpinan' => $validatedData['nama_pimpinan'],
            'nib_cabang' => $validatedData['nib_cabang'],
            'pdf_nib' => $pdfNibPath,
            'pdf_akta_cabang' => $pdfAktaCabangPath,
        ]);

        return redirect()->route('branches.index')->with('success', 'Branch created successfully.');
    }

    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches.show', compact('branch'));
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_cabang' => 'required|string|max:255', // 'nama_cabang' => 'Cabang Jakarta Pusat
            'kota_kabupaten' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nama_pimpinan' => 'required|string|max:255',
            'nib_cabang' => 'required|string|max:255',
            'pdf_nib' => 'nullable|file|mimes:pdf|max:2048',
            'pdf_akta_cabang' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $branch = Branch::findOrFail($id);

        if ($request->hasFile('pdf_nib')) {
            $pdfNibPath = $request->file('pdf_nib')->store('pdfs', 'public');
            $branch->pdf_nib = $pdfNibPath;
        }

        if ($request->hasFile('pdf_akta_cabang')) {
            $pdfAktaCabangPath = $request->file('pdf_akta_cabang')->store('pdfs', 'public');
            $branch->pdf_akta_cabang = $pdfAktaCabangPath;
        }

        $branch->update($validatedData);

        return redirect()->route('branches.index')->with('success', 'Branch updated successfully.');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('branches.index')->with('success', 'Branch deleted successfully.');
    }
}
