<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interaccion extends Model
{
    protected $table = 'interacciones'; 

    protected $fillable = [
        'perro_interesado_id',
        'perro_candidato_id',
        'preferencia'
    ];
}