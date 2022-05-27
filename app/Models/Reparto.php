<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparto extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','nom_reparto','desc_reparto'];


    //Relacion Uno a Uno
  public function docente() {
    
    return $this->hasOne(Docente::class,'id');
    }

    //Relacion Uno a Uno
    public function alumno() {
        
    return $this->hasOne(Alumno::class,'id');
    }    

}
