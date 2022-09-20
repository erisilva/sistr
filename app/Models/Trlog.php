<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trlog extends Model
{
    use HasFactory;

    protected $fillable = [
        'tr_id', 'user_id', 'field', 'oldvalue', 'newvalue'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tr()
    {
        return $this->belongsTo(Tr::class);
    }

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
