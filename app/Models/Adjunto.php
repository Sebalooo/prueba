<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjunto extends Model
{
    use HasFactory;

    protected $fillable = [
         'id'
        ,'nombre_original'
        ,'nombre_random'
        ,'fecha_subida'
        ,'razon'
        ,'bitacora_id'
    ];

    public function bitacora(){
        return $this->belongsTo(Bitacora::class);
    }
}
