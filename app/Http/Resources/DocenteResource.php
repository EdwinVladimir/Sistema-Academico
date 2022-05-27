<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocenteResource extends JsonResource
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
            'dni_doc' => $this->dni_doc,
            'nom_doc' => $this->nom_doc,
            'ape_doc' => $this->ape_doc,
            'instt_docp'=> $this->instt_docp,
            'cobt_doc' => $this-> cobt_doc,
            'lnac_doc' => $this-> lnac_doc,
            'fnac_doc' => $this-> fnac_doc,
            'reparto_id' => $this->reparto_id,
            'reparto_nom'=>$this->reparto()->get(['nom_reparto']),
            'tipogrado_id' => $this->tipogrado_id,
            'tipogrado_nom'=>$this->tipogrado()->get(['nom_grado']),
            'tiposangre_id' => $this->tiposangre_id,
            'tiposangre_nom'=>$this->tiposangre()->get(['nom_sangre']),
            'especialidad_id' => $this->especialidad_id,
            'especialidad_nom'=>$this->especialidad()->get(['nom_especialidad']),     
            'asignadoc'=>$this->asignadoc()->get(),
        ];
    }
}
