<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'item';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'pemesanan',
        'menu',
        // 'testimoni',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function testimoni()
    {
        return $this->hasOne(Testimoni::class, 'item_id', 'id');
    }
}
