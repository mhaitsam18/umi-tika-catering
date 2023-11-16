<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.menu.index', [
            'title' => 'Umi Tika Catering | Jadwal Menu',
            'page' => 'menu',
            'menus' => Menu::orderBy('tanggal', 'desc')->get(),
            'pakets' => Paket::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu.create', [
            'title' => 'Umi Tika Catering | Tambah Menu',
            'page' => 'menu',
            'pakets' => Paket::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu' => 'required|string',
            'waktu_makan' => 'required|in:breakfast,lunch,dinner',
            'tanggal' => 'required|date',
            'paket_id' => 'required|exists:paket,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480', // maksimum 20MB
        ]);

        $gambarPath = $request->file('gambar')->store('menu');

        Menu::create([
            'menu' => $request->menu,
            'waktu_makan' => $request->waktu_makan,
            'tanggal' => $request->tanggal,
            'paket_id' => $request->paket_id,
            'gambar' => $gambarPath,
        ]);

        return back()->with('success', 'Menu berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('admin.menu.show', [
            'title' => 'Umi Tika Catering | Detail Menu',
            'page' => 'menu',
            'menu' => $menu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', [
            'title' => 'Umi Tika Catering | Edit Menu',
            'page' => 'menu',
            'menu' => $menu,
            'pakets' => Paket::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'menu' => 'required|string',
            'waktu_makan' => 'required|in:breakfast,lunch,dinner',
            'tanggal' => 'required|date',
            'paket_id' => 'required|exists:paket,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480', // maksimum 20MB
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            Storage::delete($menu->gambar);

            $gambarPath = $request->file('gambar')->store('menu');
        } else {
            $gambarPath = $menu->gambar;
        }

        $menu->update([
            'menu' => $request->menu,
            'waktu_makan' => $request->waktu_makan,
            'tanggal' => $request->tanggal,
            'paket_id' => $request->paket_id,
            'gambar' => $gambarPath,
        ]);

        return back()->with('success', 'Menu berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        // Hapus gambar sebelum menghapus data menu
        Storage::delete($menu->gambar);

        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus');
    }
}
