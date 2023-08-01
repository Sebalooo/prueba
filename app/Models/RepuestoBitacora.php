<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepuestoBitacora extends Model
{
    use HasFactory;

    protected $fillable = [
         'id'
        ,'cantidad'
        ,'fecha'
        ,'bitacora_id'
        ,'repuesto_id'
    ];

    public function repuesto(){
        return $this->belongsTo(Repuesto::class);
    }
    public function bitacora(){
        return $this->belongsTo(Bitacora::class);
    }
}
