<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiposangre extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','nom_sangre','desc_sangre'];

  
    //Relacion Uno a Uno
    public function docente() {
    
        return $this->hasOne(Docente::class,'id');
        }
    
        //Relacion Uno a Uno
        public function alumno() {
            
        return $this->hasOne(Alumno::class,'id');
        } 

}
