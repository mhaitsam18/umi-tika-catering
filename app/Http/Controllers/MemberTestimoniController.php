<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class MemberTestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
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

    public function getTestimoniByItemId(Item $item)
    {
        $testimoni = null;

        if ($item) {
            $testimoni = Testimoni::where('item_id', $item->id)->first();
        }

        return response()->json(['testimoni' => $testimoni]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Testimoni $testimoni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimoni $testimoni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimoni $testimoni)
    {
        //
    }
}
