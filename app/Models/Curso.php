<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    use HasFactory;
    
    protected $fillable = [ 'id','cod_cur', 'nom_cur', 'narea_cur','nhor_cur', 'ejecurso_id', 'tipocurso_id'];  
    
            //Relación uno a muchos (Inversa)
            public function ejecursos(){
    
                return $this->belongsTo(Ejecurso::class,'ejecurso_id','id');
                }
    
            //Relación uno a muchos (Inversa)
            public function tipocursos(){
        
                return $this->belongsTo(Tipocurso::class,'tipocurso_id','id');
                }
    
            //Relacion Muchos a Muchos
            public function materias() {

                return $this->belongsToMany(Materia::class);
            }

            //Relacion Muchos a  Muchos
            public function planeestudios() {

                return $this->hasMany(Planestudio::class);
            }

            //Relacion uno a Muchos
            public function matriculas() {
            
                return $this->hasMany('App\Models\Matricula');
            }

            /**
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
            public function scopeFilterMaterias($query,$materias){
                if($materias){
                    return $query->whereHas('materias');
                }else{
                    return $query->whereDoesntHave('materias');

                }
                
            }
}
