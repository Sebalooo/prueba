<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;

    protected $fillable = [
             'id'
            ,'nombre'
            ,'marca'
            ,'modelo'
            ,'descripcion'
    ];

    public function repuestos(){
        return $this->hasMany(Repuesto::class);
    }

    public function inventarios(){
        return $this->hasMany(Inventario::class);
    }


}
