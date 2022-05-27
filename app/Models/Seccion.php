<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','cod_sec','nom_sec'];

    //Relacion uno a Muchos
    public function asignadoc() {
    
        return $this->hasMany('App\Models\Asignadoc');
    }

    //Relacion uno a Muchos
    public function matriculas() {
    
        return $this->hasMany('App\Models\Matricula');
    }
    
}
