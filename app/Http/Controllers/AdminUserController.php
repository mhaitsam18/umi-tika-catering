<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function admin()
    {
        return view('admin.user.admin', [
            'title' => 'Umi Tika Catering | Data Admin',
            'page' => 'admin',
            'admins' => User::where('role', 'admin')->orderBy('name')->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function member()
    {
        return view('admin.user.member', [
            'title' => 'Umi Tika Catering | Data Member',
            'page' => 'member',
            'members' => Member::all()->sortBy(function ($member) {
                return $member->user->name;
            })
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
    public function store(UserRequest $request)
    {
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('foto-profil') : null;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imagePath,
            'role' => $request->role,
        ]);

        if ($request->role == 'member') {
            Member::create([
                'user_id' => $user->id,
                'alamat_kirim' => $request->alamat_kirim,
                'nomor_wa' => $request->nomor_wa,
            ]);
        }

        return back()->with('success', 'Data User ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validate = [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'role' => 'required',
        ];

        if ($request->role == 'member') {
            $validate += [
                'alamat_kirim' => 'required',
                'nomor_wa' => ['required', 'string', 'regex:/^(?:\+62|0)[0-9\s-]+$/'],
            ];
        }

        $request->validate($validate);

        $image = $user->image;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('foto-profil');
            $image = $path;
        }

        $user->update([
            'email' => $request->email,
            'name' => $request->name,
            'image' => $image,
        ]);

        if ($request->role == 'member') {
            $user->member->update([
                'alamat_kirim' => $request->alamat_kirim,
                'nomor_wa' => $request->nomor_wa,
            ]);
        }

        return back()->with('success', 'Data User diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
