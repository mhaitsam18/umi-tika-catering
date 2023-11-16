<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Menu;
use App\Models\Pemesanan;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class MemberPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('member.pemesanan.index', [
            'title' => 'Umi Tika Catering | Pesanan Saya',
            'pemesanans' => Pemesanan::where('member_id', auth()->user()->member->id)->whereNotIn('status', ['selesai', 'batal'])->get(),
        ]);
    }

    public function getPemesananData()
    {
        $pemesanans = Pemesanan::where('member_id', auth()->user()->member->id)
            ->whereNotIn('status', ['selesai', 'batal'])
            ->get();

        return response()->json(['data' => $pemesanans]);
    }

    public function getPemesananDetails($id)
    {
        $details = Item::where('pemesanan_id', $id)->get();

        return response()->json($details);
    }

    function Testimoni(Request $request)
    {
        $check = Testimoni::where('item_id', $request->item_id)->first();
        if ($check) {
            return response()->json(['errror' => 'Testimoni Telah dikirim sebelumnya']);
        }

        $request->validate([
            'item_id' => 'required|exists:item,id',
            'testimoni' => 'required|string',
        ]);

        Testimoni::create([
            'item_id' => $request->item_id,
            'member_id' => auth()->user()->member->id, // Ganti dengan cara Anda mendapatkan ID member
            'testimoni' => $request->testimoni,
        ]);
        Item::find($request->item_id)->update([
            'testimoni' => $request->testimoni
        ]);
        // return response()->json(['success' => 'Testimoni Berhasil ditambahkan']);
        return back()->with('success', 'Testimoni Berhasil ditambahkan');
    }



    /**
     * Display a listing of the resource.
     */
    public function riwayat()
    {
        return view('member.pemesanan.riwayat', [
            'title' => 'Umi Tika Catering | Riwayat Pemesanan',
            'pemesanans' => Pemesanan::where('member_id', auth()->user()->member->id)->whereIn('status', ['selesai', 'batal'])->get(),
        ]);
    }

    public function getRiwayatData()
    {
        $pemesanans = Pemesanan::where('member_id', auth()->user()->member->id)
            ->whereIn('status', ['selesai', 'batal'])
            ->get();

        return response()->json(['data' => $pemesanans]);
    }

    /**
     * Display a listing of the resource.
     */
    public function keranjang()
    {
        return view('member.pemesanan.keranjang', [
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


    public function checkout(Request $request)
    {
        // Validasi input
        $request->validate([
            'diskon' => 'nullable|numeric',
            'bukti_bayar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480', // maksimum 20MB
        ]);

        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        // Hitung total harga dan total harga diskon
        $totalHarga = 0;
        $totalHargaDiskon = 0;

        foreach ($cart as $item) {
            $totalHarga += $item['price'] * $item['quantity'];
            $totalHargaDiskon += $item['price'] * $item['quantity'];
        }

        // Diskon
        $diskon = $request->input('diskon', 0);

        if ($diskon > 0 && $diskon <= 100) {
            $totalHargaDiskon = $totalHargaDiskon - (($diskon / 100) * $totalHarga);
        }

        // Simpan data pemesanan
        $pemesanan = Pemesanan::create([
            'member_id' => auth()->user()->member->id,
            'diskon' => $diskon,
            'total_harga' => $totalHarga,
            'harga_diskon' => $totalHargaDiskon,
            'bukti_bayar' => $request->file('bukti_bayar') ? $request->file('bukti_bayar')->store('bukti-bayar') : null,
            'status' => 'menunggu konfirmasi',
        ]);

        // Simpan data item
        foreach ($cart as $item) {
            Item::create([
                'pemesanan_id' => $pemesanan->id,
                'menu_id' => $item['menu_id'],
                'jumlah' => $item['quantity'],
                'harga_per_item' => $item['price'],
                'harga_total' => $item['price'] * $item['quantity'],
            ]);
        }

        // Kosongkan keranjang
        session()->forget('cart');

        return redirect()->route('member.pemesanan.index')->with('success', 'Pemesanan berhasil diproses. Terima kasih!');
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
