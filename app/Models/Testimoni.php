<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'testimoni';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'member',
        'pemesanan'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
