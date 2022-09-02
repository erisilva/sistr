<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregoeiro extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function trs()
    {
        return $this->hasMany(Tr::class);
    } 
}
