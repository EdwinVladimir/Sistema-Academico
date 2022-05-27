<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','ano_per','peri_per','finic_per','ffin_per'];


    //Relacion uno a Muchos
    public function asignadoc() { 
    
        return $this->hasMany('App\Models\Asignadoc');
    }

    //Relacion uno a Muchos
    public function matriculas() {
    
        return $this->hasMany('App\Models\Matricula');
    }

    //Relacion uno a Muchos
    public function planevas() {
    
        return $this->hasMany('App\Models\Planeva');
    }

    public function evaluaciones() {
    
        return $this->hasMany('App\Models\Evaluacion');
    }

    public function scopeFiltername($query, $idper) {

        if(!empty($idper)) {
            return $query->where('nom_doc', 'like', "%$idper%");
        }
        
    }
        
    /*public function scopeFilterapel($query, $apel) {
        
        if(!empty($apel)) {
            return $query->orwhere('ape_doc', "$apel");
        }
        
    }
    public function scopeFilterdni($query, $dni) {
                
        if(!empty($dni)) {
            return $query->orWhere('dni_doc', "$dni");
        
         }
        
    }*/

}
