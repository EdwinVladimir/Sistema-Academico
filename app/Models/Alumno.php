<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = ['id','dni_al', 'nom_al', 'ape_al', 'fnac_al', 'lnac_al', 'reparto_id','especialidad_id','tiposangre_id','tipogrado_id'];
    
    //Relacion Uno a Uno
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function reparto() {

        return $this->belongsTo(Reparto::class,'reparto_id');
    }
    
    //Relacion Uno a Uno
    public function tiposangre() {
    
        return $this->belongsTo(Tiposangre::class,'tiposangre_id');
    }
    
    //Relacion Uno a Uno
    public function especialidad() {

        return $this->belongsTo(Especialidad::class,'especialidad_id');
    }
    
    //Relacion Uno a Uno
    public function tipogrado() {
    
        return $this->belongsTo(Tipogrado::class,'tipogrado_id');
    }

    //Relacion uno a Muchos
    public function matriculas() {
    
        return $this->hasMany('App\Models\Matricula');
    }

///***********************************************************/    
//      FILTROS  PARA CONSULTAS                              */
    public function scopeFiltername($query, $name) {
        
        if(!empty($name)) {
            return $query->Where('nom_al', 'like', "%$name%");
        }

    }

    public function scopeFilterapel($query, $ape) {
        
        if(!empty($ape)) {
            return $query->orWhere('ape_al','like', "%$ape%");
        }

    }

    public function scopeFilterdni($query, $dni) {
        
        if(!empty($dni)) {
            return $query->orWhere('dni_al', "$dni");
        }

    }
    
    /**eddd
     * * Filter by id
     * @param $vecIds
     * @return Iluminate\Eloquent\Builder
     */
    public function scopeFilterById($query,$vecIds){
        if($vecIds->isNotEmpty()) return $query->whereIn("id",$vecIds);

    }

    /**
     * * Filter where has materias 
     * @param $materia
     * @return Iluminate\Eloquent\Builder
     */
    public function scopeFilterMaterias($query,$alumno){
        if($alumno){
            return $query->whereHas('materias');
        }else{
            return $query->whereDoesntHave('materias');

        }
        
    }

}
