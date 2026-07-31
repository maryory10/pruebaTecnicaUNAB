<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';
    protected $primaryKey = 'id';

     protected $fillable = [
        'id_docente',
        'id_asignatura',
        'dia_semana',
        'hora_inicio',
        'hora_fin'
    ];

    public $timestamps = false;

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'id_docente', "id");
    }
}
