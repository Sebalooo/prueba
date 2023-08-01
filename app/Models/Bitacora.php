<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;

    protected $fillable = [
        'id'
        ,'titulo'
        ,'observacion'
        ,'fecha'
        ,'fundador'
        ,'user_id'
        ,'trabajo_id'
       
        
    ];



    public function usuario(){
        return $this->belongsTo(User::class);
    }

    public function trabajo(){
        return $this->belongsTo(Trabajo::class);
    }
}
