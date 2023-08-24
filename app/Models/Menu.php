<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'menu';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'paket'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }
    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
