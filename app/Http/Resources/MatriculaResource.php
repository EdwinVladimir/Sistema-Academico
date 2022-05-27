<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatriculaResource extends JsonResource
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
            'feins_matri' => $this->feins_matri,

            'periodo_id' => $this->periodo_id,
            'periodo'=>$this->periodos()->get(['ano_per', 'peri_per']),

            'curso_id' => $this->curso_id,
            'curso'=>$this->cursos()->get(['nom_cur']),
            
            'alumno_id' => $this->alumno_id,
            'alumno'=>$this->alumnos()->get(['dni_al','nom_al','ape_al']),

            'seccion_id' => $this->seccion_id,
            'seccion'=>$this->seccions()->get(['cod_sec', 'nom_sec']),

            'promedios_materias'=>$this->promedios_materias()->get(['matricula_id']),

            'materias'=>$this->cursos->materias,

        ];
    }
}
