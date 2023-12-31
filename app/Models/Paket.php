<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'paket';
    protected $guarded = [
        'id'
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}
