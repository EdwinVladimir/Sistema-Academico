<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejecurso extends Model
{
    use HasFactory; 
    
    protected $fillable = [ 'id','nom_ejecurso','desc_ejecurso'];
 
    
    //Relacion uno a Muchos
    public function cursos() {
    
    return $this->hasMany('App\Models\Curso');
    }
}
