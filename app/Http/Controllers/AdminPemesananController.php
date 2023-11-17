<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class AdminPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pemesanan.index', [
            'title' => 'Umi Tika Catering | Pemesanan dan Pembayaran',
            'page' => 'pemesanan',
            'pemesanans' => Pemesanan::latest()->get(),
            'members' => Member::all(),
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemesanan $pemesanan)
    {
        return view('admin.item.index', [
            'title' => 'Umi Tika Catering | Detail Pemesanan',
            'page' => 'pemesanan',
            'pemesanan' => $pemesanan,
            'menus' => Menu::whereDate('tanggal', '>=', now())->get(),
            'items' => Item::where('pemesanan_id', $pemesanan->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $pemesanan->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status Pemesanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemesanan $pemesanan)
    {
        //
    }
}
