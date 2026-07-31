<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table = 'asignaturas';
    protected $primaryKey = 'id';

     protected $fillable = [
        'nombre',
        'codigo',
    ];

    public $timestamps = false;

    public function impartida()
    {
        return $this->hasMany(Horario::class, 'id_asignatura');
    }
}
