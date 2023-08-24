<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemesanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pemesanan';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'member'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
