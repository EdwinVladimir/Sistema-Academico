<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CursoResource extends JsonResource
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
            'cod_cur' => $this->cod_cur,
            'nom_cur' => $this->nom_cur,
            'ejecurso_id' => $this->ejecurso_id,
            'tipocurso_id' => $this->tipocurso_id,  
            'narea_cur' => $this->narea_cur,
            'nhor_cur' => $this->nhor_cur,
            'ejecursos'=>$this->ejecursos()->get(['id','nom_ejecurso']),
            'tipocursos'=>$this->tipocursos()->get(['id','nom_curso']),
            'materia_id' => $this->materias->pluck("id","nom_mat"),
            'materia'=>$this->materias()->get(['id','nom_mat']),
            //'materia2'=> $this->materias->pluck("nom_mat"),
        ];
    }
}
