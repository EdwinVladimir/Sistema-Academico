<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvaluacionResource extends JsonResource
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

            'fecreg_eval' => $this->fecreg_eval,
            'detalplaneva_id' => $this->detalplaneva_id,
            'nota_deteva' => $this->nota_deteva,
            
            'alumno_id' => $this->alumno_id,
            'alumno'=>$this->alumnos()->get(['id','dni_al','nom_al','ape_al']),
            
            'periodo_id' => $this->periodo_id,
            'periodo'=>$this->periodos()->get(['ano_per']),

            'materia_id' => $this->materia_id,
            'materia'=>$this->materias()->get(['nom_mat']),

            'detalplaneva'=>$this->detalplanevas()->get(),

            'curso'=>$this->materias->cursos,


        ];
    }
}


