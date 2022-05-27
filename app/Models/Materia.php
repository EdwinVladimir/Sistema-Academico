<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Materia extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','nom_mat','nhor_mat'];


    //Relacion uno a Muchos
    public function cursos() {

        return $this->belongsToMany(Curso::class);
    }

    
    //Relacion uno a Muchos
    public function asignadoc() {
    
        return $this->hasMany('App\Models\Asignadoc');
    }   

    //Relacion uno a Muchos
    public function planevas() {
    
        return $this->hasMany('App\Models\Planeva');
    }   

}

