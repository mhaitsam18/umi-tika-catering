<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'member';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function testimoni()
    {
        return $this->hasMany(Testimoni::class);
    }
}
