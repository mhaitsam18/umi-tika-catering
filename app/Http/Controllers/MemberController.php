<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
    }
    public function profile()
    {
        return view('member.profile', [
            'title' => 'Umi Tika Catering | Profile',
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $request->user_id,
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'alamat_kirim' => 'required',
            'nomor_wa' => ['required', 'string', 'regex:/^(?:\+62|0)[0-9\s-]+$/'],
        ]);

        $image = $request->image;
        if ($request->hasFile('image')) {
            // Proses penyimpanan file gambar, misalnya di folder public/images
            $path = $request->file('image')->store('foto-profil');
            $image = $path;
        }

        User::find($request->user_id)->update([
            'email' => $request->email,
            'name' => $request->name,
            'image' => $image
        ]);

        Member::find($request->member_id)->update([
            'alamat_kirim' => $request->alamat_kirim,
            'nomor_wa' => $request->nomor_wa
        ]);

        return back()->with('success', 'Profile diperbarui');
    }
}
