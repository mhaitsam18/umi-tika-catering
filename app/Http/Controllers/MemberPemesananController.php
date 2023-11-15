<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class MemberPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('member.pemesanan.index', [
            'title' => 'Umi Tika Catering | Keranjang',
        ]);
    }

    public function pilihMenu(Request $request)
    {
        $tanggal = $request->tanggal;
        $tanggalArray = explode(', ', $tanggal);

        return view('member.pemesanan.pilih-menu', [
            'title' => 'Umi Tika Catering | Pilih Menu',
            'menus' => Menu::whereIn('tanggal', $tanggalArray)
                ->orderBy('tanggal')
                ->orderByRaw("FIELD(waktu_makan, 'breakfast', 'lunch', 'dinner')")
                ->get()
        ]);
    }

    public function addToCart(Request $request)
    {
        $menuId = $request->input('menu_id');
        $quantity = $request->input('quantity', 1);

        // Ambil informasi menu berdasarkan ID
        $menu = Menu::find($menuId);

        // Pastikan menu ditemukan
        if (!$menu) {
            abort(404);
        }

        // Tambahkan menu ke dalam keranjang
        $cart = session()->get('cart', []);

        // Jika menu sudah ada di keranjang, tambahkan jumlahnya
        if (isset($cart[$menuId])) {
            $cart[$menuId]['quantity'] += $quantity;
        } else {
            // Jika menu belum ada di keranjang, tambahkan menu baru
            $cart[$menuId] = [
                'menu_id' => $menu->id,
                'menu_name' => $menu->menu,
                'paket' => $menu->paket->nama_paket,
                'tanggal' => $menu->tanggal,
                'waktu_makan' => $menu->waktu_makan,
                'quantity' => $quantity,
                'price' => $menu->paket->harga,
            ];
        }

        // Simpan kembali keranjang ke dalam session
        session(['cart' => $cart]);

        // Redirect kembali ke halaman sebelumnya atau halaman tertentu
        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang.');
    }

    public function updateItem(Request $request)
    {
        $menuId = $request->input('menu_id');
        $quantity = $request->input('quantity', 1);

        // Ambil informasi menu berdasarkan ID
        $menu = Menu::find($menuId);

        // Pastikan menu ditemukan
        if (!$menu) {
            abort(404);
        }

        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        // Periksa apakah menu ada di keranjang
        if (isset($cart[$menuId])) {
            // Update jumlah menu di keranjang
            $cart[$menuId]['quantity'] += $quantity;
            if ($cart[$menuId]['quantity'] == 0) {
                // Hapus menu dari keranjang
                unset($cart[$menuId]);
            }
            // Simpan kembali keranjang ke dalam session
            session(['cart' => $cart]);

            return redirect()->back()->with('success', 'Jumlah item di keranjang berhasil diupdate.');
        }

        return redirect()->back()->with('error', 'Menu tidak ditemukan di keranjang.');
    }

    // Metode untuk menghapus item dari keranjang
    public function removeItem(Request $request)
    {
        $menuId = $request->input('menu_id');

        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        // Periksa apakah menu ada di keranjang
        if (isset($cart[$menuId])) {
            // Hapus menu dari keranjang
            unset($cart[$menuId]);

            // Simpan kembali keranjang ke dalam session
            session(['cart' => $cart]);

            return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
        }

        return redirect()->back()->with('error', 'Menu tidak ditemukan di keranjang.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemesanan $pemesanan)
    {
        //
    }
}
