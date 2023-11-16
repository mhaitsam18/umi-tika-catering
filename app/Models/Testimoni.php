<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $table = 'testimoni';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'member',
        'item'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
