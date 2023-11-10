<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'title' => 'Umi Tika Catering | Admin',
            'page' => 'index'
        ]);
    }
    public function profile()
    {
        return view('admin.profile', [
            'title' => 'Umi Tika Catering | Profile',
            'page' => 'profile'
        ]);
    }
}
