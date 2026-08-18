<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'instrumento_id',
        'comentario',
        'leido',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instrumento()
    {
        return $this->belongsTo(Instrumento::class);
    }
}