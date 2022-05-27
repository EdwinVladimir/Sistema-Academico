<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignadoc extends Model
{
    use HasFactory; 
    
    protected $fillable = [
                            'id',
                            'periodo_id',
                            'seccion_id',
                            'materia_id',
                            'docente_id',
                            'aula_id',
                            'curso_id', 
                            'porcentaje_individual', 
                            'porcentaje_grupal', 
                            'porcentaje_actitudinal',
                            'estado',
                        ];    

    //Relación uno a muchos (Inversa)
    public function periodos() {
    
        return $this->belongsTo(Periodo::class,'periodo_id','id');
    }

    //Relación uno a muchos (Inversa)
    public function seccions() {
    
        return $this->belongsTo(Seccion::class,'seccion_id','id');
    }

    //Relación uno a muchos (Inversa)
    public function materias() {
    
        return $this->belongsTo(Materia::class,'materia_id','id');
    }

    //Relación uno a muchos (Inversa)
    public function docentes() {
    
        return $this->belongsTo(Docente::class,'docente_id','id');
    }

    //Relación uno a muchos (Inversa)
    public function aulas() {
    
        return $this->belongsTo(Aula::class,'aula_id','id');
    }

    
    public function scopeFilterDocente($query, $docente_id) {
      
        if(!empty($docente_id)) {
            
            return $query->where('docente_id', "$docente_id");
            
        } 
    
    }

    public function scopeFilterEstado($query, $estado) {
      
        if(!empty($estado)) {
            
            return $query->where('estado', "$estado");
            
        } 
    
    }

    public function scopeFilterpid($query, $id) {
      
        if(!empty($id)) {
            
            return $query->where('periodo_id', "$id");
            
        } 
    
    }

    public function scopeFiltercid($query, $id) {
      
            if(!empty($id)) {
                
                return $query->where('id', "$id");
                
            }  
    
    }
     
    
    public function scopeFilterNpd($query,$name){

        if(!empty($name)) $query->whereHas("docentes",function($query) use($name){
            $query->Where("nom_doc","like","%$name%");
            $query->orWhere("ape_doc","like","%$name%");
            $query->orWhere("dni_doc","like","%n$name%");
        });
    }


}
