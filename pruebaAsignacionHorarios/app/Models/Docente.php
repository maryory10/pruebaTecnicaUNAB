<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'docentes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_completo',
        'correo',
        'fecha_ingreso'
    ];

    public $timestamps = false;

    public function asignaciones()
    {
        return $this->hasMany(Horario::class, 'id_docente');
    }
}
