<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
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
