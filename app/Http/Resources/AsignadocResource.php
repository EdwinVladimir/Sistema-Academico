<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AsignadocResource extends JsonResource
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

            'periodo_id' => $this->periodo_id,
            'periodo'=>$this->periodos()->get(['ano_per', 'peri_per']),

            'aula_id' => $this->aula_id,
            'aula'=>$this->aulas()->get(['num_aul']),
            
            'seccion_id' => $this->seccion_id,
            'seccion'=>$this->seccions()->get(['cod_sec', 'nom_sec']),

            'curso_id' => $this->curso_id,
            'curso'=>$this->materias->cursos,

            'materia_id' => $this->materia_id,
            'materia'=>$this->materias()->get(['nom_mat']),

            'docente_id' => $this->docente_id,
            'docente'=>$this->docentes()->get(['dni_doc','nom_doc','ape_doc']),

            'porcentaje_individual' => $this->porcentaje_individual,
            'porcentaje_grupal' => $this->porcentaje_grupal,
            'porcentaje_actitudinal' => $this->porcentaje_actitudinal,

            'estado' => $this->estado,
        ];
    }
}
