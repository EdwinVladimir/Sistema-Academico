<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class AlumnoResource extends JsonResource
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
        'dni_al' => $this->dni_al,
        'nom_al' => $this->nom_al,
        'ape_al' => $this->ape_al,
        'fnac_al' => $this->fnac_al,
        'lnac_al' => $this->lnac_al,
        'reparto_id' => $this->reparto_id,
        'reparto_nom'=>$this->reparto()->get(['nom_reparto']),
        'tipogrado_id' => $this->tipogrado_id,
        'tipogrado_nom'=>$this->tipogrado()->get(['nom_grado']),
        'tiposangre_id' => $this->tiposangre_id,
        'tiposangre_nom'=>$this->tiposangre()->get(['nom_sangre']),
        'especialidad_id' => $this->especialidad_id,
        'especialidad_nom'=>$this->especialidad()->get(['nom_especialidad']),
        'matricula'=>$this->matriculas()->get(),
        ];
    }


}
