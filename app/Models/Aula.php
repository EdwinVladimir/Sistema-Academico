<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    use HasFactory;

    protected $fillable = [ 'cod_aul', 'num_aul'];
    
    //Relacion uno a Muchos
    public function horarios() {
    
        return $this->hasMany('App\Models\Horario');
    }

}
