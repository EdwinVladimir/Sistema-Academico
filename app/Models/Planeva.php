<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planeva extends Model
{
    use HasFactory;

    protected $fillable = ['id','docente_id','periodo_id','materia_id','fecent_plaeva'];


    //Relación uno a muchos (Inversa)
    public function docentes(){
    
        return $this->belongsTo(Docente::class,'docente_id','id');
    }

   //Relación uno a muchos (Inversa)
    public function periodos(){
    
        return $this->belongsTo(Periodo::class,'periodo_id','id');
    }


     //Relación uno a muchos (Inversa)
    public function materias(){
    
        return $this->belongsTo(Materia::class,'materia_id','id');
    }
    
    //Relacion uno a Muchos
    public function detalplanevas() {
        
        return $this->hasMany(Detalplaneva::class, 'planeva_id');
    }


}