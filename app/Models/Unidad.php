<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;
    protected $fillable = [
         'id'
        ,'unidad'
        ,'edificio'
        ,'piso'
        ,'anexo'
        ,'activo'
        ,'updated_at'
        ,'created_at'
    ];

    public  function inventario(){
        return $this->hasMany(Inventario::class);
    }

    public function usuarios(){
        return $this->hasMany(User::class);
    }

    
}
