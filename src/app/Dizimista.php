<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dizimista extends Model
{
    protected $fillable = [
        'nome',
    ];
    protected $hidden = [
        'atualizado', 'ultima_atualizacao', 'ultimo_atualizador_id'
    ];

}
