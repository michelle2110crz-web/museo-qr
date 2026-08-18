<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrumento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'nombre_original',
        'familia',
        'origen',
        'historia',
        'caracteristicas',
        'uso_cultural',
        'imagen',
        'video',
        'audio',
        'imagen_baja_resolucion',
        'es_sagrado',
        'tiene_visita_virtual'
    ];
}