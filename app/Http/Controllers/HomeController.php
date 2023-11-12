<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Testimoni;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'title' => 'Umi Tika Catering | Beranda'
        ]);
    }
    public function catering()
    {
        return view('home.catering', [
            'title' => 'Umi Tika Catering | Catering',
            'tanggal' => Menu::distinct('tanggal')->pluck('tanggal')
        ]);
    }
    public function tentangkami()
    {
        return view('home.tentang-kami', [
            'title' => 'Umi Tika Catering | Tentang Kami'
        ]);
    }
    public function testimoni()
    {
        $latestTestimonis = Testimoni::select('member_id', DB::raw('MAX(created_at) as latest_testimoni'))
            ->groupBy('member_id')
            ->latest('latest_testimoni')
            ->get();

        $testimonis = Testimoni::whereIn('id', $latestTestimonis->pluck('id'))->get();

        return view('home.testimoni', [
            'title' => 'Umi Tika Catering | Testimoni',
            'testimonis' => $testimonis
        ]);
    }
}
