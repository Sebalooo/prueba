<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
         'id'
        ,'nombre'
        ,'rut'
        ,'telefono'
        ,'updated_at'
        ,'created_at'
    ];

 
    public function repuestos(){
        return $this->hasMany(Repuesto::class);
    }
    
}
