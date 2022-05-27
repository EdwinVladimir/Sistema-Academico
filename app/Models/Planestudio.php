<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planestudio extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','tit_pla','descrip_pla','curso_id','archi_pla'];


    //Relacion uno a Muchos
    public function cursos() {
    
        return $this->belongsToMany('App\Models\Curso');
        }
        


}

