<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipocurso extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','nom_curso','desc_curso'];


    //Relacion uno a Muchos
        public function cursos() {
    
        return $this->hasMany('App\Models\Curso');
        }


}
