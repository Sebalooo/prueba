<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
         'id'
        ,'cantidad'
        ,'fecha'
        ,'inventario_id'
        ,'trabajo_id'

    ];

    public function inventario(){
        return $this->belongsTo(Inventario::class);
    }

    public function trabajo(){
        return $this->belongsTo(Trabajo::class);
    }
    
}
