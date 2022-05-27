<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $fillable = [ 'id','nom_especialidad','desc_especialidad'];

     //Relacion Uno a Uno
     public function docente() {

        return $this->hasOne(Docente::class,'id');
    }

    //Relacion uno a Uno
    public function alumno() {
        
    return $this->hasOne(Alumno::class,'id');

    }

}
