<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = [
         'id'
         ,'serie'
         ,'lote'
         ,'serial'
        //,'nombre'
       // ,'descripcion'
       // ,'modelo'
       // ,'marca'
        ,'estado'
        ,'tipo'
        ,'fecha_ingreso'
        ,'fecha_baja'
        ,'unidad_id'
        ,'detalle_id'

    ];

    public function unidad(){
        return $this->belongsTo(Unidad::class);
    }

    public function detalle(){
        return $this->belongsTo(Detalle::class);
    }

    public function equipoTrabajos(){
        return $this->hasMany(EquipoTrabajo::class);
    }

    public function  equipoOrden(){
        return $this->belongsToMany('Trabajo');
    }

}
