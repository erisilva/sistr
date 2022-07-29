<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origem extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao'
    ];

    public function trs()
    {
        return $this->hasMany(Tr::class);
    } 
}
