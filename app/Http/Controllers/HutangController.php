<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use Illuminate\Http\Request;

class HutangController extends Controller
{
    public function index()
    {
        $hutang = Hutang::all();
        return view('hutang.index', compact('hutang'));
    }

    public function create()
    {
        return view('hutang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'tanggal' => 'required|date',
            'nominal' => 'required|numeric',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        Hutang::create($request->all());

        return redirect()->route('hutang.index')->with('success', 'Hutang berhasil ditambahkan.');
    }

    public function edit(Hutang $hutang)
    {
        return view('hutang.edit', compact('hutang'));
    }

    public function update(Request $request, Hutang $hutang)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'tanggal' => 'required|date',
            'nominal' => 'required|numeric',
            'status' => 'required|in:Lunas,Belum Lunas',
        ]);

        $hutang->update($request->all());

        return redirect()->route('hutang.index')->with('success', 'Hutang berhasil diupdate.');
    }

    public function destroy(Hutang $hutang)
    {
        $hutang->delete();

        return redirect()->route('hutang.index')->with('success', 'Hutang berhasil dihapus.');
    }
}
