<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanevaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,    

            'fecent_plaeva' => $this->fecent_plaeva,
                      
            'docente_id' => $this->docente_id,
            'docente'=>$this->docentes()->get(['dni_doc','nom_doc','ape_doc']),

            'periodo_id' => $this->periodo_id,
            'periodo'=>$this->periodos()->get(['ano_per']),

            'materia_id' => $this->materia_id,
            'materia'=>$this->materias()->get(['nom_mat']),

            'detalplaneva'=>$this->detalplanevas()->get(['id','tipoact_acti', 'descrip_detac','poreva_detac','planeva_id']),
            
            'curso_id'=>$this->materias->cursos,
            ];
    }
}


