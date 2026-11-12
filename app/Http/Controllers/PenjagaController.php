<?php

namespace App\Http\Controllers;

use App\Models\Penjaga;
use Illuminate\Http\Request;

class PenjagaController extends Controller
{
    public function index()
    {
        $penjaga = Penjaga::orderByDesc('id')->get();
        return view('penjaga.index', compact ('penjaga'));
    }

    public function create()
    {
        return view('penjaga.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'       => 'required|max:100',
            'alamat'     => 'required|max:100',
            'no_telepon' => 'required|max:20',
            'tugas'      => 'required|max:100',
            'area'       => 'required|max:100',
        ]);

        Penjaga::create($data);

        return redirect()->route('penjaga.index')->with('success', 'Data penjaga berhasil ditambahkan.');
    }
     public function edit(Penjaga $penjaga)
    {
        return view('penjaga.edit', compact('penjaga'));
    }

    public function update(Request $request, Penjaga $penjaga)
    {
        $data = $request->validate([
            'nama'       => 'required|max:100',
            'alamat'     => 'required|max:100',
            'no_telepon' => 'required|max:20',
            'tugas'      => 'required|max:100',
            'area'       => 'required|max:100',
        ]);

        $penjaga->update($data);

        return redirect()
            ->route('penjaga.index')
            ->with('success', 'Data penjaga berhasil diperbarui.');
    }
    
    public function destroy(Penjaga $penjaga)
    {
        $penjaga->delete();

        return redirect()
            ->route('penjaga.index')
            ->with('success', 'Data penjaga berhasil dihapus.');
}

}