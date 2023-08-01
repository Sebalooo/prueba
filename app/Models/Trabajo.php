<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Trabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id'
        ,'estado'
        ,'tipo_orden'
        ,'prioridad'
        ,'tipo_mantencion'
        ,'fecha_inicio'
        ,'fecha_termino'

    ];


    public function  equipoTrabajos(){
        return  $this->hasMany(EquipoTrabajo::class);
    }

    public function bitacoras(){
        return $this->hasMany(Bitacora::class);
    }


    

    
}
