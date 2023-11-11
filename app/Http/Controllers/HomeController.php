<?php

namespace App\Http\Controllers;

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
            'title' => 'Umi Tika Catering | Catering'
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
        return view('home.testimoni', [
            'title' => 'Umi Tika Catering | Testimoni'
        ]);
    }
}
