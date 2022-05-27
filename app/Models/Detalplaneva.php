<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalplaneva extends Model
{
    use HasFactory;

    protected $fillable =  ['id', 'tipoact_acti', 'descrip_detac','poreva_detac','planeva_id'];

    //Relacion Uno a Varios
    public function planevas() {
        
        return $this->belongsTo(Planeva::class, 'planeva_id');
    }

     //Relacion uno a Muchos
     public function evaluacions() {
        
        return $this->hasMany('App\Models\Evaluacion');
    }


}
