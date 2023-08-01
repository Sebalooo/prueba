<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    use HasFactory;

    protected $fillable = [
         'id'
        ,'nombre'
        ,'serie'
        ,'marca'
        ,'modelo'
        ,'detalle_id'
    ];

    public function detalle(){
        return $this->belongsTo(Detalle::class);
    }
    
    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }

}