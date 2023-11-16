<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class AdminPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.paket.index', [
            'title' => 'Umi Tika Catering | Data Paket',
            'page' => 'paket',
            'pakets' => Paket::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.paket.create', [
            'title' => 'Umi Tika Catering | Tambah Paket',
            'page' => 'paket'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required',
            'harga' => 'required|numeric'
        ]);

        Paket::create([
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga
        ]);

        return back()->with('success', 'Paket berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        return view('admin.paket.show', [
            'title' => 'Umi Tika Catering | Detail Paket',
            'page' => 'paket',
            'paket' => $paket
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket)
    {
        return view('admin.paket.edit', [
            'title' => 'Umi Tika Catering | Edit Paket',
            'page' => 'paket',
            'paket' => $paket
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paket $paket)
    {
        $request->validate([
            'nama_paket' => 'required',
            'harga' => 'required|numeric'
        ]);

        $paket->update([
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga
        ]);

        return back()->with('success', 'Paket berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paket $paket)
    {
        $paket->delete();

        return back()->with('success', 'Paket berhasil dihapus');
    }
}
